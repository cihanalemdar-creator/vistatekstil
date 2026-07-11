const { chromium, webkit } = require('playwright');
const fs = require('fs');
const path = require('path');

const origin = process.env.HERO_AUDIT_ORIGIN || 'http://127.0.0.1:8082';
const outputDir = process.env.HERO_AUDIT_OUTPUT
    ? path.resolve(process.env.HERO_AUDIT_OUTPUT)
    : path.resolve(__dirname, '../docs/qa/hero-video');
const chromeExecutable = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
fs.mkdirSync(outputDir, { recursive: true });

const widths = [320, 375, 430, 768, 1024, 1280, 1440];
const routes = [
    { path: '/', locale: 'tr', fileLocale: 'tr' },
    { path: '/en/', locale: 'en', fileLocale: 'eng' },
];

const results = {
    generatedAt: new Date().toISOString(),
    origin,
    responsive: [],
    scenarios: {},
    performance: {},
    browserSupport: {},
    failures: [],
};

function attachDiagnostics(page) {
    const diagnostics = { consoleErrors: [], pageErrors: [], failedRequests: [], requests: [], responses: [] };
    page.on('console', (message) => {
        if (message.type() === 'error') diagnostics.consoleErrors.push(message.text());
    });
    page.on('pageerror', (error) => diagnostics.pageErrors.push(error.message));
    page.on('requestfailed', (request) => diagnostics.failedRequests.push({ url: request.url(), error: request.failure()?.errorText || '' }));
    page.on('request', (request) => diagnostics.requests.push({ url: request.url(), type: request.resourceType(), time: Date.now() }));
    page.on('response', async (response) => {
        const headers = await response.allHeaders().catch(() => ({}));
        diagnostics.responses.push({
            url: response.url(),
            status: response.status(),
            type: response.request().resourceType(),
            contentLength: Number(headers['content-length'] || 0),
        });
    });
    return diagnostics;
}

async function addMetrics(page) {
    await page.addInitScript(() => {
        window.__heroMetrics = { cls: 0, lcp: null };
        try {
            new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) {
                    if (!entry.hadRecentInput) window.__heroMetrics.cls += entry.value;
                }
            }).observe({ type: 'layout-shift', buffered: true });
            new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const entry = entries[entries.length - 1];
                if (entry) {
                    window.__heroMetrics.lcp = {
                        startTime: entry.startTime,
                        size: entry.size,
                        tagName: entry.element ? entry.element.tagName : null,
                        className: entry.element ? entry.element.className : null,
                    };
                }
            }).observe({ type: 'largest-contentful-paint', buffered: true });
        } catch (error) {
            window.__heroMetrics.observerError = error.message;
        }
    });
}

async function readHero(page) {
    return page.evaluate(() => {
        const hero = document.querySelector('.home-hero');
        const video = document.querySelector('.home-hero__video');
        const media = document.querySelector('[data-hero-video]');
        const poster = document.querySelector('.home-hero__poster');
        const play = document.querySelector('.hero-video-control--play');
        const mute = document.querySelector('.hero-video-control--mute');
        const h1 = hero?.querySelector('h1');
        const ctas = hero ? [...hero.querySelectorAll('a')] : [];
        const h1Rect = h1?.getBoundingClientRect();
        const controlsRect = play?.parentElement?.getBoundingClientRect();
        const overlaps = h1Rect && controlsRect
            ? !(h1Rect.right < controlsRect.left || h1Rect.left > controlsRect.right || h1Rect.bottom < controlsRect.top || h1Rect.top > controlsRect.bottom)
            : null;
        return {
            htmlLang: document.documentElement.lang,
            h1Count: document.querySelectorAll('h1').length,
            heroHeight: hero?.getBoundingClientRect().height || 0,
            overflow: document.documentElement.scrollWidth - document.documentElement.clientWidth,
            video: video ? {
                currentSrc: video.currentSrc,
                paused: video.paused,
                muted: video.muted,
                loop: video.loop,
                autoplay: video.autoplay,
                playsInline: video.playsInline,
                readyState: video.readyState,
                currentTime: video.currentTime,
                errorCode: video.error ? video.error.code : null,
                opacity: getComputedStyle(video).opacity,
            } : null,
            mediaClass: media?.className || '',
            posterOpacity: poster ? getComputedStyle(poster).opacity : null,
            playVisible: !!play && !!(play.offsetWidth || play.offsetHeight),
            playLabel: play?.getAttribute('aria-label') || null,
            muteVisible: !!mute && !!(mute.offsetWidth || mute.offsetHeight),
            muteLabel: mute?.getAttribute('aria-label') || null,
            controlsOverlapH1: overlaps,
            ctasVisible: ctas.length >= 2 && ctas.every((cta) => !!(cta.offsetWidth || cta.offsetHeight)),
            metrics: window.__heroMetrics || null,
        };
    });
}

async function waitForAutoplay(page) {
    await page.waitForFunction(() => {
        const video = document.querySelector('.home-hero__video');
        return video && !video.paused && video.currentTime > 0.15;
    }, null, { timeout: 10000 });
}

async function runResponsive(browser) {
    const context = await browser.newContext({ ignoreHTTPSErrors: true });
    const page = await context.newPage();
    const diagnostics = attachDiagnostics(page);
    await addMetrics(page);

    for (const route of routes) {
        for (const width of widths) {
            diagnostics.consoleErrors.length = 0;
            diagnostics.pageErrors.length = 0;
            diagnostics.failedRequests.length = 0;
            const requestStart = diagnostics.requests.length;
            await page.setViewportSize({ width, height: width <= 430 ? 812 : 900 });
            await page.goto(`${origin}${route.path}?qa=${route.locale}-${width}`, { waitUntil: 'domcontentloaded', timeout: 20000 });
            await waitForAutoplay(page);
            const state = await readHero(page);
            const videoRequests = diagnostics.requests.slice(requestStart).filter((request) => /\/hero\/.*\.(webm|mp4)$/.test(request.url));
            const expectedVariant = width <= 767 ? 'mobile' : 'desktop';
            const expectedFile = `${route.fileLocale}-${expectedVariant}`;
            const pass = state.video
                && !state.video.paused
                && state.video.muted
                && state.video.loop
                && state.video.autoplay
                && state.video.playsInline
                && state.video.currentSrc.includes(expectedFile)
                && videoRequests.length <= 1
                && videoRequests.every((request) => !request.url.includes('/public_html/videos/'))
                && state.overflow <= 0
                && state.h1Count === 1
                && state.controlsOverlapH1 === false
                && state.ctasVisible
                && diagnostics.consoleErrors.length === 0
                && diagnostics.pageErrors.length === 0
                && diagnostics.failedRequests.filter((request) => request.error !== 'net::ERR_ABORTED').length === 0;
            const record = {
                locale: route.locale,
                width,
                expectedVariant,
                pass,
                state,
                videoRequests,
                errors: {
                    console: [...diagnostics.consoleErrors],
                    page: [...diagnostics.pageErrors],
                    requests: [...diagnostics.failedRequests],
                },
            };
            results.responsive.push(record);
            if (!pass) results.failures.push({ test: `responsive-${route.locale}-${width}`, record });
            if (route.locale === 'tr' && (width === 375 || width === 1440)) {
                await page.screenshot({ path: path.join(outputDir, `tr-${width}.png`), fullPage: false });
            }
        }
    }
    await context.close();
}

async function runReducedMotion(browser) {
    const context = await browser.newContext({ viewport: { width: 375, height: 812 }, reducedMotion: 'reduce' });
    const page = await context.newPage();
    const diagnostics = attachDiagnostics(page);
    await page.goto(`${origin}/?qa=reduced-motion`, { waitUntil: 'domcontentloaded', timeout: 20000 });
    await page.waitForTimeout(1000);
    const before = await readHero(page);
    const beforeVideoRequests = diagnostics.requests.filter((request) => /\/hero\/.*\.(webm|mp4)$/.test(request.url));
    await page.locator('.hero-video-control--play').press('Enter');
    await waitForAutoplay(page);
    const after = await readHero(page);
    const pass = beforeVideoRequests.length === 0
        && before.video.currentSrc === ''
        && before.posterOpacity === '1'
        && before.playVisible
        && after.video.currentSrc.includes('tr-mobile')
        && !after.video.paused
        && diagnostics.consoleErrors.length === 0
        && diagnostics.pageErrors.length === 0;
    results.scenarios.reducedMotion = { pass, before, after, beforeVideoRequests, diagnostics };
    if (!pass) results.failures.push({ test: 'reduced-motion', record: results.scenarios.reducedMotion });
    await context.close();
}

async function runBlockedAutoplay(browser) {
    const context = await browser.newContext({ viewport: { width: 375, height: 812 } });
    await context.addInitScript(() => {
        Object.defineProperty(HTMLMediaElement.prototype, 'autoplay', { configurable: true, get: () => false, set: () => {} });
        Object.defineProperty(HTMLMediaElement.prototype, 'play', {
            configurable: true,
            value: () => Promise.reject(new DOMException('Autoplay blocked for QA', 'NotAllowedError')),
        });
        new MutationObserver(() => {
            document.querySelectorAll('video[autoplay]').forEach((video) => video.removeAttribute('autoplay'));
        }).observe(document, { childList: true, subtree: true });
    });
    const page = await context.newPage();
    const diagnostics = attachDiagnostics(page);
    await page.goto(`${origin}/?qa=autoplay-blocked`, { waitUntil: 'domcontentloaded', timeout: 20000 });
    await page.waitForTimeout(1200);
    const state = await readHero(page);
    const pass = state.video.paused
        && state.video.muted
        && state.posterOpacity === '1'
        && state.playVisible
        && state.playLabel === 'Videoyu oynat'
        && state.mediaClass.includes('is-autoplay-blocked')
        && diagnostics.consoleErrors.length === 0
        && diagnostics.pageErrors.length === 0;
    results.scenarios.autoplayBlocked = { pass, state, diagnostics };
    if (!pass) results.failures.push({ test: 'autoplay-blocked', record: results.scenarios.autoplayBlocked });
    await context.close();
}

async function runKeyboard(browser) {
    const context = await browser.newContext({ viewport: { width: 1280, height: 800 } });
    const page = await context.newPage();
    const diagnostics = attachDiagnostics(page);
    await page.goto(`${origin}/?qa=keyboard`, { waitUntil: 'domcontentloaded', timeout: 20000 });
    await waitForAutoplay(page);
    const play = page.locator('.hero-video-control--play');
    const mute = page.locator('.hero-video-control--mute');
    await play.focus();
    await play.press('Enter');
    await page.waitForTimeout(150);
    const paused = await readHero(page);
    await play.press('Enter');
    await waitForAutoplay(page);
    await mute.focus();
    await mute.press('Enter');
    await page.waitForTimeout(150);
    const unmuted = await readHero(page);
    const pass = paused.video.paused
        && paused.playLabel === 'Videoyu oynat'
        && !unmuted.video.paused
        && unmuted.video.muted === false
        && unmuted.muteLabel === 'Sesi kapat'
        && diagnostics.consoleErrors.length === 0
        && diagnostics.pageErrors.length === 0;
    results.scenarios.keyboardControls = { pass, paused, unmuted, diagnostics };
    if (!pass) results.failures.push({ test: 'keyboard-controls', record: results.scenarios.keyboardControls });
    await context.close();
}

async function runLowBandwidth(browser) {
    const context = await browser.newContext({ viewport: { width: 375, height: 812 } });
    const page = await context.newPage();
    const diagnostics = attachDiagnostics(page);
    const session = await context.newCDPSession(page);
    await session.send('Network.enable');
    await session.send('Network.emulateNetworkConditions', {
        offline: false,
        latency: 180,
        downloadThroughput: 120000,
        uploadThroughput: 60000,
        connectionType: 'cellular3g',
    });
    await page.goto(`${origin}/?qa=slow-3g`, { waitUntil: 'domcontentloaded', timeout: 30000 });
    await page.waitForTimeout(1800);
    const state = await readHero(page);
    const mediaReady = (state.posterOpacity === '1' && state.video.opacity === '0')
        || (!state.video.paused && state.video.opacity === '1');
    const pass = mediaReady
        && state.playVisible
        && state.ctasVisible
        && state.overflow <= 0
        && diagnostics.consoleErrors.length === 0
        && diagnostics.pageErrors.length === 0;
    results.scenarios.lowBandwidth = { pass, state, diagnostics, profile: { latencyMs: 180, downloadBytesPerSecond: 120000 } };
    if (!pass) results.failures.push({ test: 'low-bandwidth', record: results.scenarios.lowBandwidth });
    await context.close();
}

async function measurePage(browser, reducedMotion, label) {
    const context = await browser.newContext({ viewport: { width: 1440, height: 900 }, reducedMotion });
    const page = await context.newPage();
    const diagnostics = attachDiagnostics(page);
    await addMetrics(page);
    await page.goto(`${origin}/?qa=performance-${label}`, { waitUntil: 'domcontentloaded', timeout: 20000 });
    await page.waitForTimeout(2800);
    const state = await readHero(page);
    const entries = await page.evaluate(() => performance.getEntriesByType('resource').map((entry) => ({
        name: entry.name,
        initiatorType: entry.initiatorType,
        transferSize: entry.transferSize || 0,
        encodedBodySize: entry.encodedBodySize || 0,
        duration: entry.duration,
        startTime: entry.startTime,
    })));
    const initialEntries = entries.filter((entry) => entry.startTime <= 2800);
    const summary = {
        label,
        requestCount: diagnostics.requests.length,
        transferSize: initialEntries.reduce((total, entry) => total + entry.transferSize, 0),
        encodedBodySize: initialEntries.reduce((total, entry) => total + entry.encodedBodySize, 0),
        videoEntries: initialEntries.filter((entry) => /\/hero\/.*\.(webm|mp4)$/.test(entry.name)),
        responseContentLength: diagnostics.responses.reduce((total, response) => total + response.contentLength, 0),
        state,
        diagnostics,
    };
    await context.close();
    return summary;
}

async function runWebKit() {
    try {
        const browser = await webkit.launch({ headless: true });
        const context = await browser.newContext({ viewport: { width: 1280, height: 800 } });
        const page = await context.newPage();
        const diagnostics = attachDiagnostics(page);
        await page.goto(`${origin}/en/?qa=webkit`, { waitUntil: 'domcontentloaded', timeout: 30000 });
        await waitForAutoplay(page);
        const state = await readHero(page);
        const ignoredEngineErrors = diagnostics.pageErrors.filter((message) => message.includes('Temporal.Duration properties'));
        const actionablePageErrors = diagnostics.pageErrors.filter((message) => !message.includes('Temporal.Duration properties'));
        const pass = !state.video.paused
            && state.video.muted
            && state.video.playsInline
            && state.video.currentSrc.includes('eng-desktop')
            && diagnostics.consoleErrors.length === 0
            && actionablePageErrors.length === 0;
        results.browserSupport.webkit = { available: true, pass, state, diagnostics, ignoredEngineErrors, actionablePageErrors };
        if (!pass) results.failures.push({ test: 'webkit', record: results.browserSupport.webkit });
        await browser.close();
    } catch (error) {
        results.browserSupport.webkit = { available: false, pass: null, reason: error.message };
    }
}

(async () => {
    const browser = await chromium.launch({ headless: true, executablePath: chromeExecutable });
    results.browserSupport.chromium = { available: true };
    await runResponsive(browser);
    await runReducedMotion(browser);
    await runBlockedAutoplay(browser);
    await runKeyboard(browser);
    await runLowBandwidth(browser);
    results.performance.posterOnlyBaseline = await measurePage(browser, 'reduce', 'poster-only');
    results.performance.autoplay = await measurePage(browser, 'no-preference', 'autoplay');
    await browser.close();
    await runWebKit();
    results.summary = {
        responsiveChecks: results.responsive.length,
        responsivePasses: results.responsive.filter((record) => record.pass).length,
        totalFailures: results.failures.length,
    };
    fs.writeFileSync(path.join(outputDir, 'audit.json'), JSON.stringify(results, null, 2) + '\n');
    console.log(JSON.stringify(results.summary));
    if (results.failures.length) process.exitCode = 1;
})().catch((error) => {
    console.error(error);
    process.exitCode = 1;
});
