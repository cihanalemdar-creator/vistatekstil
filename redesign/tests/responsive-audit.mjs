import { createRequire } from 'node:module';
import { access, mkdir, writeFile } from 'node:fs/promises';
import path from 'node:path';

const require = createRequire(import.meta.url);
const { chromium } = require('C:\\Users\\User\\.cache\\codex-runtimes\\codex-primary-runtime\\dependencies\\node\\node_modules\\playwright');

const root = process.cwd();
const outDir = path.join(root, 'redesign', 'docs', 'qa');
const screenshotDir = path.join(outDir, 'screenshots');
const browser = await chromium.launch({
  headless: true,
  executablePath: 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
});

const viewports = [320, 375, 430, 768, 1024, 1280, 1440];
const routes = ['/', '/kurumsal', '/urunler', '/tasarim', '/koleksiyon/referans', '/galeri/galerim2', '/iletisim'];
const expectedNavigation = ['Ana Sayfa', 'Kurumsal', 'Ürünler', 'Tasarım', 'Koleksiyon', 'Galeri', 'İletişim'];
const results = [];

const slugFor = (route) => route === '/' ? 'home' : route.replace(/^\//, '').replaceAll('/', '__');

async function scrollThrough(page) {
  const height = await page.evaluate(() => document.documentElement.scrollHeight);
  for (let y = 0; y < height; y += 700) {
    await page.evaluate((nextY) => window.scrollTo(0, nextY), y);
    await page.waitForTimeout(20);
  }
  await page.evaluate(() => window.scrollTo(0, 0));
}

for (const width of viewports) {
  const context = await browser.newContext({ viewport: { width, height: 900 }, reducedMotion: 'reduce' });
  const page = await context.newPage();
  const consoleErrors = [];
  const pageErrors = [];
  const failedRequests = [];
  const httpErrors = [];
  page.on('console', (message) => {
    if (message.type() === 'error') consoleErrors.push(message.text());
  });
  page.on('pageerror', (error) => pageErrors.push(error.message));
  page.on('requestfailed', (request) => failedRequests.push(request.url()));
  page.on('response', (response) => {
    if (response.status() >= 400) httpErrors.push(`${response.status()} ${response.url()}`);
  });

  for (const route of routes) {
    const videoRequests = [];
    const responseListener = (response) => {
      if (/\.mp4(?:\?|$)/i.test(response.url())) videoRequests.push(response.url());
    };
    page.on('response', responseListener);

    const response = await page.goto(`http://127.0.0.1:8082${route}`, { waitUntil: 'domcontentloaded' });
    await page.evaluate(() => document.fonts.ready);
    if (width === 375 || width === 1440) await scrollThrough(page);

    const audit = await page.evaluate(({ expectedNavigation, width }) => {
      const visible = (element) => !!element && getComputedStyle(element).display !== 'none' && element.getBoundingClientRect().width > 0;
      const mobileLinks = Array.from(document.querySelectorAll('.mobile-nav__panel nav a')).map((link) => link.textContent.replace('↗', '').trim());
      const desktopLinks = Array.from(document.querySelectorAll('.desktop-nav a')).map((link) => link.textContent.trim());
      const viewportWidth = document.documentElement.clientWidth;
      const overflowElements = Array.from(document.body.querySelectorAll('*')).filter((element) => {
        const style = getComputedStyle(element);
        if (style.position === 'fixed' || style.display === 'none' || element.closest('details:not([open])')) return false;
        let ancestor = element.parentElement;
        while (ancestor) {
          const ancestorStyle = getComputedStyle(ancestor);
          if (['auto', 'scroll', 'hidden', 'clip'].includes(ancestorStyle.overflowX)) return false;
          ancestor = ancestor.parentElement;
        }
        const rect = element.getBoundingClientRect();
        return rect.width > 0 && (rect.right > viewportWidth + 1 || rect.left < -1);
      }).slice(0, 12).map((element) => `${element.tagName.toLowerCase()}.${element.className || ''}`);

      return {
        width,
        clientWidth: viewportWidth,
        scrollWidth: document.documentElement.scrollWidth,
        h1Count: document.querySelectorAll('h1').length,
        htmlLang: document.documentElement.lang,
        desktopNavigationVisible: visible(document.querySelector('.desktop-nav')),
        mobileNavigationVisible: visible(document.querySelector('.mobile-nav')),
        desktopLinks,
        mobileLinks,
        navigationMatches: JSON.stringify(mobileLinks) === JSON.stringify(expectedNavigation),
        brokenImages: Array.from(document.images).filter((image) => image.complete && image.naturalWidth === 0).map((image) => image.currentSrc || image.src),
        overflowElements,
        manrope400: document.fonts.check('400 16px Manrope', 'Çç Ğğ İi Iı Öö Şş Üü'),
        manrope650: document.fonts.check('650 16px Manrope', 'IĞDIR İZMİR ŞİŞLİ ÇORLU GÖRÜŞME ÜRETİM'),
        submitDisabled: document.querySelector('.form-submit')?.disabled ?? null,
        formFieldCount: document.querySelectorAll('.quote-form input, .quote-form select, .quote-form textarea').length,
        galleryItems: document.querySelectorAll('.gallery-masonry figure').length,
      };
    }, { expectedNavigation, width });

    results.push({
      route,
      status: response?.status() ?? null,
      ...audit,
      videoRequestsBeforePlay: videoRequests.length,
      consoleErrors: [...consoleErrors],
      pageErrors: [...pageErrors],
      failedRequests: [...failedRequests],
      httpErrors: [...httpErrors],
    });

    page.off('response', responseListener);
    consoleErrors.length = 0;
    pageErrors.length = 0;
    failedRequests.length = 0;
    httpErrors.length = 0;

    if (width === 375 || width === 1440) {
      const dir = path.join(screenshotDir, `new-${width}`);
      await mkdir(dir, { recursive: true });
      const target = path.join(dir, `${slugFor(route)}.png`);
      try {
        await access(target);
      } catch {
        await page.screenshot({ path: target, fullPage: true });
      }
    }
  }

  await context.close();
}

const comparisonRoutes = routes;
for (const width of [375, 1440]) {
  const context = await browser.newContext({ viewport: { width, height: 900 }, reducedMotion: 'reduce' });
  const page = await context.newPage();
  for (const route of comparisonRoutes) {
    await page.goto(`http://127.0.0.1:8081${route}`, { waitUntil: 'domcontentloaded' });
    await scrollThrough(page);
    const dir = path.join(screenshotDir, `old-${width}`);
    await mkdir(dir, { recursive: true });
    const target = path.join(dir, `${slugFor(route)}.png`);
    try {
      await access(target);
    } catch {
      await page.screenshot({ path: target, fullPage: true });
    }
  }
  await context.close();
}

const videoContext = await browser.newContext({ viewport: { width: 1280, height: 800 } });
const videoPage = await videoContext.newPage();
const videos = [];
for (const route of ['/', '/en/']) {
  await videoPage.goto(`http://127.0.0.1:8082${route}`, { waitUntil: 'domcontentloaded' });
  const metadata = await videoPage.locator('video').evaluate((video) => new Promise((resolve, reject) => {
    const done = () => resolve({
      src: video.currentSrc,
      duration: video.duration,
      width: video.videoWidth,
      height: video.videoHeight,
      preload: video.preload,
      autoplay: video.autoplay,
    });
    if (video.readyState >= 1) return done();
    video.addEventListener('loadedmetadata', done, { once: true });
    video.addEventListener('error', () => reject(new Error('Video metadata could not be loaded')), { once: true });
    video.load();
  }));
  videos.push({ route, ...metadata });
}
await videoContext.close();

await mkdir(outDir, { recursive: true });
await writeFile(path.join(outDir, 'responsive-audit.json'), JSON.stringify({ generatedAt: new Date().toISOString(), results, videos }, null, 2));
await browser.close();

const failures = results.filter((result) =>
  result.status !== 200 ||
  result.h1Count !== 1 ||
  result.scrollWidth > result.clientWidth + 1 ||
  result.brokenImages.length > 0 ||
  result.overflowElements.length > 0 ||
  !result.navigationMatches ||
  !result.manrope400 ||
  !result.manrope650 ||
  result.consoleErrors.length > 0 ||
  result.pageErrors.length > 0 ||
  result.httpErrors.length > 0 ||
  result.videoRequestsBeforePlay > 0
);

console.log(JSON.stringify({ checks: results.length, failures: failures.length, videos, failureSummary: failures }, null, 2));
if (failures.length > 0) process.exitCode = 1;
