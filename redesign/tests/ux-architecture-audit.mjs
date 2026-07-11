import { createRequire } from 'node:module';
import { mkdir, writeFile } from 'node:fs/promises';
import path from 'node:path';

const require = createRequire(import.meta.url);
const { chromium, webkit } = require('C:\\Users\\User\\.cache\\codex-runtimes\\codex-primary-runtime\\dependencies\\node\\node_modules\\playwright');

const root = process.cwd();
const baseUrl = 'http://127.0.0.1:8082';
const outputDir = path.join(root, 'redesign', 'docs', 'qa', 'ux-revision');
const screenshotDir = path.join(outputDir, 'screenshots');
const allViewports = [320, 375, 430, 768, 1024, 1280, 1440];
const viewports = process.env.AUDIT_WIDTH ? [Number(process.env.AUDIT_WIDTH)] : allViewports;
const routes = [
  { path: '/', key: 'home', locale: 'tr', sectionNav: false },
  { path: '/kurumsal', key: 'about', locale: 'tr', sectionNav: true },
  { path: '/urunler', key: 'products', locale: 'tr', sectionNav: true },
  { path: '/tasarim', key: 'design', locale: 'tr', sectionNav: true },
  { path: '/koleksiyon/referans', key: 'collection', locale: 'tr', sectionNav: false },
  { path: '/galeri/galerim2', key: 'gallery', locale: 'tr', sectionNav: false },
  { path: '/iletisim', key: 'contact', locale: 'tr', sectionNav: false },
  { path: '/en/', key: 'home', locale: 'en', sectionNav: false },
  { path: '/en/about', key: 'about', locale: 'en', sectionNav: true },
  { path: '/en/products', key: 'products', locale: 'en', sectionNav: true },
  { path: '/en/design', key: 'design', locale: 'en', sectionNav: true },
  { path: '/en/collection', key: 'collection', locale: 'en', sectionNav: false },
  { path: '/en/gallery', key: 'gallery', locale: 'en', sectionNav: false },
  { path: '/en/contact', key: 'contact', locale: 'en', sectionNav: false },
];
const expectedNavigation = {
  tr: ['Ana Sayfa', 'Kurumsal', 'Ürünler', 'Tasarım', 'Koleksiyon', 'Galeri', 'İletişim'],
  en: ['Home', 'About', 'Products', 'Design', 'Collection', 'Gallery', 'Contact'],
};

await mkdir(screenshotDir, { recursive: true });

const failures = [];
const checks = [];
const browserResults = [];
const addCheck = (name, pass, detail = '') => {
  const result = { name, pass: Boolean(pass), detail };
  checks.push(result);
  if (!result.pass) failures.push(result);
};
const slug = (routePath) => routePath === '/' ? 'home' : routePath.replace(/^\//, '').replaceAll('/', '__');
const overlaps = (a, b, tolerance = 1) => a && b
  && a.right > b.left + tolerance && a.left < b.right - tolerance
  && a.bottom > b.top + tolerance && a.top < b.bottom - tolerance;

const chromiumBrowser = await chromium.launch({
  headless: true,
  executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
});

if (process.env.SKIP_MAIN !== '1') for (const width of viewports) {
  process.stdout.write(`viewport ${width}\n`);
  const context = await chromiumBrowser.newContext({ viewport: { width, height: 900 } });
  await context.route(/\.(?:mp4|webm)(?:\?|$)/i, (route) => route.abort());
  const page = await context.newPage();
  page.setDefaultTimeout(5000);
  const runtimeErrors = [];
  page.on('console', (message) => {
    if (message.type() === 'error' && message.text() !== 'Failed to load resource: net::ERR_FAILED') runtimeErrors.push(`console: ${message.text()}`);
  });
  page.on('pageerror', (error) => runtimeErrors.push(`page: ${error.message}`));
  page.on('requestfailed', (request) => {
    const failure = request.failure()?.errorText || '';
    if (!/\.(?:mp4|webm)(?:\?|$)/i.test(request.url()) && failure !== 'net::ERR_ABORTED') runtimeErrors.push(`request: ${request.url()} ${failure}`);
  });
  page.on('response', (response) => {
    if (response.status() >= 400) runtimeErrors.push(`HTTP ${response.status()}: ${response.url()}`);
  });

  for (const route of routes) {
    if (route.locale === 'en' && ![375, 1440].includes(width)) continue;
    runtimeErrors.length = 0;
    const response = await page.goto(`${baseUrl}${route.path}`, { waitUntil: 'domcontentloaded' });
    await page.waitForTimeout(80);

    const audit = await page.evaluate(({ width, expected, isHome, needsSectionNav }) => {
      const isVisible = (element) => Boolean(element && element.getClientRects().length && getComputedStyle(element).visibility !== 'hidden');
      const cleanLabel = (value) => value.replace(/[↗]/g, '').trim();
      const activeSelector = width <= 1180 ? '.mobile-nav__panel nav a[aria-current="page"]' : '.desktop-nav a[aria-current="page"]';
      const navSelector = width <= 1180 ? '.mobile-nav__panel nav a' : '.desktop-nav a';
      const navLabels = Array.from(document.querySelectorAll(navSelector), (link) => cleanLabel(link.textContent));
      const overflow = Array.from(document.querySelectorAll('body *')).filter((element) => {
        if (!isVisible(element) || element.closest('dialog:not([open]), details:not([open])')) return false;
        const style = getComputedStyle(element);
        if (style.position === 'fixed') return false;
        let ancestor = element.parentElement;
        while (ancestor && ancestor !== document.body) {
          const overflowX = getComputedStyle(ancestor).overflowX;
          if (['auto', 'scroll', 'hidden', 'clip'].includes(overflowX)) return false;
          ancestor = ancestor.parentElement;
        }
        const rect = element.getBoundingClientRect();
        return rect.width > 0 && (rect.left < -1 || rect.right > document.documentElement.clientWidth + 1);
      }).slice(0, 8).map((element) => `${element.tagName.toLowerCase()}.${String(element.className).replaceAll(' ', '.')}`);
      const header = document.querySelector('[data-site-header]');
      const breadcrumbs = document.querySelectorAll('.breadcrumb');
      const sectionLinks = Array.from(document.querySelectorAll('.section-navigation a'));
      const missingTargets = sectionLinks.filter((link) => !document.querySelector(link.hash)).map((link) => link.hash);
      const visibleButtons = Array.from(document.querySelectorAll('.button, .header-contact')).filter(isVisible);
      const clippedButtons = visibleButtons.filter((button) => button.scrollWidth > button.clientWidth + 1 || button.scrollHeight > button.clientHeight + 1)
        .map((button) => button.textContent.trim().slice(0, 60));
      return {
        status: document.readyState,
        lang: document.documentElement.lang,
        h1: document.querySelectorAll('h1').length,
        navLabels,
        navMatches: JSON.stringify(navLabels) === JSON.stringify(expected),
        activeCount: document.querySelectorAll(activeSelector).length,
        breadcrumbs: breadcrumbs.length,
        breadcrumbLinks: breadcrumbs[0]?.querySelectorAll('li').length || 0,
        sectionLinks: sectionLinks.length,
        missingTargets,
        overflow,
        scrollOverflow: document.documentElement.scrollWidth - document.documentElement.clientWidth,
        clippedButtons,
        headerPosition: getComputedStyle(header).position,
        expectedBreadcrumb: isHome ? 0 : 1,
        expectedSectionNav: needsSectionNav,
      };
    }, { width, expected: expectedNavigation[route.locale], isHome: route.key === 'home', needsSectionNav: route.sectionNav });

    const prefix = `${width}px ${route.path}`;
    addCheck(`${prefix} HTTP`, response?.status() === 200, String(response?.status()));
    addCheck(`${prefix} runtime`, runtimeErrors.length === 0, runtimeErrors.join(' | '));
    addCheck(`${prefix} language`, audit.lang === route.locale, audit.lang);
    addCheck(`${prefix} one H1`, audit.h1 === 1, String(audit.h1));
    addCheck(`${prefix} navigation`, audit.navMatches && audit.activeCount === 1, `${audit.navLabels.join(', ')}; active=${audit.activeCount}`);
    addCheck(`${prefix} breadcrumb`, audit.breadcrumbs === audit.expectedBreadcrumb && (route.key === 'home' || audit.breadcrumbLinks >= 2), `${audit.breadcrumbs}/${audit.breadcrumbLinks}`);
    addCheck(`${prefix} section navigation`, route.sectionNav ? audit.sectionLinks > 0 && audit.missingTargets.length === 0 : audit.sectionLinks === 0, `${audit.sectionLinks}; missing=${audit.missingTargets.join(',')}`);
    addCheck(`${prefix} horizontal overflow`, audit.scrollOverflow <= 1 && audit.overflow.length === 0, `${audit.scrollOverflow}px; ${audit.overflow.join(', ')}`);
    addCheck(`${prefix} button clipping`, audit.clippedButtons.length === 0, audit.clippedButtons.join(', '));

    if (route.locale === 'tr' && (route.sectionNav || ['gallery', 'contact'].includes(route.key))) {
      await page.evaluate(() => window.scrollTo(0, 750));
      await page.waitForTimeout(120);
      const sticky = await page.evaluate(() => {
        const header = document.querySelector('[data-site-header]');
        const rect = header.getBoundingClientRect();
        return { top: rect.top, height: rect.height, scrolled: header.classList.contains('is-scrolled') };
      });
      addCheck(`${prefix} sticky header`, Math.abs(sticky.top) <= 1 && sticky.scrolled, JSON.stringify(sticky));

      if (route.sectionNav) {
        const targetResult = await page.evaluate(async () => {
          const link = document.querySelector('.section-navigation a');
          const target = document.querySelector(link.hash);
          link.click();
          await new Promise((resolve) => setTimeout(resolve, 180));
          const header = document.querySelector('[data-site-header]').getBoundingClientRect();
          const targetRect = target.getBoundingClientRect();
          return { targetTop: targetRect.top, headerBottom: header.bottom };
        });
        addCheck(`${prefix} anchor offset`, targetResult.targetTop >= targetResult.headerBottom - 1, JSON.stringify(targetResult));
      }

      await page.evaluate(() => window.scrollTo(0, Math.min(1100, document.documentElement.scrollHeight - innerHeight - 180)));
      await page.waitForTimeout(150);
      const floating = await page.evaluate(() => {
        const button = document.querySelector('[data-back-to-top]');
        const stack = button.closest('[data-fixed-controls]');
        const stackStyle = getComputedStyle(stack);
        const buttonStyle = getComputedStyle(button);
        const size = parseFloat(buttonStyle.width) || 48;
        const right = parseFloat(stackStyle.right) || 14;
        const bottom = parseFloat(stackStyle.bottom) || 18;
        const predictedRect = { left: innerWidth - right - size, right: innerWidth - right, top: innerHeight - bottom - size, bottom: innerHeight - bottom };
        const avoidanceVisible = Array.from(document.querySelectorAll('[data-fixed-control-avoid]')).some((element) => {
          const rect = element.getBoundingClientRect();
          return rect.bottom > 0 && rect.top < innerHeight;
        });
        const collisionRisk = Array.from(document.querySelectorAll('[data-fixed-control-collision]')).some((element) => {
          const rect = element.getBoundingClientRect();
          return rect.right > predictedRect.left && rect.left < predictedRect.right && rect.bottom > predictedRect.top && rect.top < predictedRect.bottom;
        });
        if (button.hidden) return { visible: false, avoidanceVisible, collisionRisk, overlaps: [] };
        const buttonRect = button.getBoundingClientRect().toJSON();
        const candidates = Array.from(document.querySelectorAll('.cta-row, .form-submit, .form-field, .privacy-field, .form-details summary, .pagination, .gallery-masonry figcaption, .site-footer'));
        const hits = candidates.filter((candidate) => {
          const rect = candidate.getBoundingClientRect();
          return buttonRect.right > rect.left + 1 && buttonRect.left < rect.right - 1 && buttonRect.bottom > rect.top + 1 && buttonRect.top < rect.bottom - 1;
        }).map((element) => element.className || element.tagName);
        return { visible: true, avoidanceVisible, collisionRisk, overlaps: hits, rect: buttonRect };
      });
      const pageCanScroll = await page.evaluate(() => document.documentElement.scrollHeight > innerHeight + 700);
      addCheck(`${prefix} floating controls`, !pageCanScroll || (floating.visible && floating.overlaps.length === 0) || (!floating.visible && (floating.avoidanceVisible || floating.collisionRisk)), JSON.stringify(floating));

      await page.evaluate(() => window.scrollTo(0, document.documentElement.scrollHeight));
      await page.waitForTimeout(180);
      const footerState = await page.evaluate(() => ({
        hidden: document.querySelector('[data-back-to-top]').hidden,
        footerTop: document.querySelector('[data-site-footer]').getBoundingClientRect().top,
      }));
      addCheck(`${prefix} footer safety`, footerState.hidden, JSON.stringify(footerState));
    }

    if (route.locale === 'tr' && width <= 1180 && ['home', 'contact'].includes(route.key)) {
      await page.evaluate(() => window.scrollTo(0, 0));
      await page.evaluate(() => {
        const summary = document.querySelector('[data-mobile-nav] summary');
        summary.focus();
        summary.click();
      });
      await page.waitForTimeout(100);
      const menu = await page.evaluate(() => {
        const panel = document.querySelector('[data-mobile-menu-panel]');
        const rect = panel.getBoundingClientRect();
        return {
          open: document.querySelector('[data-mobile-nav]').open,
          bodyLocked: document.body.classList.contains('mobile-menu-open') && getComputedStyle(document.body).overflow === 'hidden',
          mainInert: document.querySelector('main').inert,
          focusedInside: panel.contains(document.activeElement),
          links: panel.querySelectorAll('nav a').length,
          insideViewport: rect.left >= -1 && rect.right <= innerWidth + 1 && rect.top >= 0 && rect.bottom <= innerHeight + 1,
          scrollable: rect.scrollHeight <= rect.clientHeight || ['auto', 'scroll'].includes(getComputedStyle(panel).overflowY),
        };
      });
      addCheck(`${prefix} mobile menu`, Object.values(menu).every(Boolean), JSON.stringify(menu));
      await page.keyboard.press('Escape');
      await page.waitForTimeout(50);
      const menuClosed = await page.evaluate(() => !document.querySelector('[data-mobile-nav]').open && document.activeElement === document.querySelector('[data-mobile-nav] summary') && !document.querySelector('main').inert);
      addCheck(`${prefix} mobile menu close`, menuClosed);
    }

    if (route.locale === 'tr' && route.key === 'gallery') {
      await page.evaluate(() => {
        const trigger = document.querySelector('[data-lightbox-item]');
        trigger.focus();
        trigger.click();
      });
      await page.waitForTimeout(100);
      const lightbox = await page.evaluate(() => {
        const dialog = document.querySelector('[data-lightbox]');
        const image = dialog.querySelector('[data-lightbox-image]').getBoundingClientRect();
        const caption = dialog.querySelector('[data-lightbox-description]').getBoundingClientRect();
        const controls = ['[data-lightbox-close]', '[data-lightbox-previous]', '[data-lightbox-next]'].map((selector) => dialog.querySelector(selector).getBoundingClientRect());
        const collision = controls.some((rect) => (rect.right > caption.left && rect.left < caption.right && rect.bottom > caption.top && rect.top < caption.bottom));
        return { open: dialog.open, title: dialog.querySelector('[data-lightbox-title]').textContent.trim(), description: dialog.querySelector('[data-lightbox-description]').textContent.trim(), collision, imageWidth: image.width };
      });
      addCheck(`${prefix} lightbox`, lightbox.open && lightbox.title && lightbox.description && !lightbox.collision && lightbox.imageWidth > 0, JSON.stringify(lightbox));
      const before = await page.locator('[data-lightbox-count]').textContent();
      await page.keyboard.press('ArrowRight');
      const after = await page.locator('[data-lightbox-count]').textContent();
      addCheck(`${prefix} lightbox navigation`, before !== after, `${before} -> ${after}`);
      await page.keyboard.press('Escape');
      await page.waitForTimeout(50);
      addCheck(`${prefix} lightbox focus return`, await page.locator('[data-lightbox-item]').first().evaluate((element) => document.activeElement === element));
    }

    if (route.locale === 'tr' && route.key === 'contact') {
      const form = await page.evaluate(() => ({
        basic: document.querySelectorAll('.quote-form__basic .form-field').length,
        details: document.querySelectorAll('.form-details__grid .form-field').length,
        privacy: document.querySelectorAll('.privacy-field input').length,
        total: document.querySelectorAll('[data-quote-form] input, [data-quote-form] select, [data-quote-form] textarea').length,
        disabled: document.querySelector('.form-submit').disabled,
        detailsInitiallyClosed: !document.querySelector('[data-form-details]').open,
        statusVisible: Array.from(document.querySelectorAll('.form-status')).some((status) => !status.hidden),
      }));
      addCheck(`${prefix} form contract`, form.basic === 7 && form.details === 8 && form.privacy === 1 && form.total === 16 && form.disabled && form.detailsInitiallyClosed && !form.statusVisible, JSON.stringify(form));
      await page.evaluate(() => {
        const summary = document.querySelector('[data-form-details] summary');
        summary.focus();
        summary.click();
      });
      const detailsVisible = await page.locator('.form-details__grid').isVisible();
      addCheck(`${prefix} form accordion`, detailsVisible);
    }

    if (process.env.SKIP_SCREENSHOTS !== '1' && (width === 375 || width === 1440) && route.locale === 'tr') {
      await page.screenshot({ path: path.join(screenshotDir, `${width}-${slug(route.path)}.png`), fullPage: true });
    }
  }

  await context.close();
}

if (process.env.SKIP_AUXILIARY !== '1') {
// Long labels and 200% text rendering are tested separately at the narrowest viewport.
{
  process.stdout.write('long-label-and-zoom\n');
  const context = await chromiumBrowser.newContext({ viewport: { width: 320, height: 900 } });
  await context.route(/\.(?:mp4|webm)(?:\?|$)/i, (route) => route.abort());
  const page = await context.newPage();
  page.setDefaultTimeout(5000);
  await page.goto(`${baseUrl}/`, { waitUntil: 'domcontentloaded' });
  const zoomAudit = await page.evaluate(() => {
    const labels = [
      'Teklif ve Üretim Detaylarını Paylaşın',
      'Tasarım ve Üretim Süreçlerini İnceleyin',
      'Request a Detailed Manufacturing Quotation',
      'Explore Our Apparel Development and Production Process',
    ];
    const buttons = Array.from(document.querySelectorAll('.home-hero .button')).slice(0, 2);
    buttons.forEach((button, index) => { button.querySelector('.button__label').textContent = labels[index]; });
    const fixture = document.createElement('div');
    fixture.className = 'cta-row';
    fixture.innerHTML = `<a class="button button--primary"><span class="button__label">${labels[2]}</span></a><a class="button button--secondary"><span class="button__label">${labels[3]}</span></a>`;
    document.querySelector('.home-hero__copy').append(fixture);
    document.documentElement.style.fontSize = '200%';
    const all = [...buttons, ...fixture.querySelectorAll('.button')];
    return {
      overflow: document.documentElement.scrollWidth - document.documentElement.clientWidth,
      clipped: all.filter((button) => button.scrollWidth > button.clientWidth + 1 || button.scrollHeight > button.clientHeight + 1).map((button) => button.textContent.trim()),
      widths: all.map((button) => ({ text: button.textContent.trim(), width: button.getBoundingClientRect().width, viewport: innerWidth })),
    };
  });
  addCheck('320px 200% text and long CTA labels', zoomAudit.overflow <= 1 && zoomAudit.clipped.length === 0 && zoomAudit.widths.every((item) => item.width <= item.viewport + 1), JSON.stringify(zoomAudit));
  if (process.env.SKIP_SCREENSHOTS !== '1') await page.screenshot({ path: path.join(screenshotDir, '320-home-200-percent-text.png'), fullPage: false });
  await context.close();
}

// Progressive enhancement: fundamental routes and controls remain usable without JavaScript.
{
  process.stdout.write('no-js\n');
  const context = await chromiumBrowser.newContext({ viewport: { width: 375, height: 900 }, javaScriptEnabled: false });
  await context.route(/\.(?:mp4|webm)(?:\?|$)/i, (route) => route.abort());
  const page = await context.newPage();
  page.setDefaultTimeout(5000);
  for (const route of routes.filter((item) => item.locale === 'tr')) {
    const response = await page.goto(`${baseUrl}${route.path}`, { waitUntil: 'domcontentloaded' });
    const noJs = await page.evaluate(({ key, sectionNav }) => ({
      h1: document.querySelectorAll('h1').length,
      nav: document.querySelectorAll('.mobile-nav__panel nav a').length,
      breadcrumb: document.querySelectorAll('.breadcrumb').length,
      sectionLinks: document.querySelectorAll('.section-navigation a').length,
      galleryLinks: document.querySelectorAll('[data-lightbox-item][href]').length,
      paginationLinks: document.querySelectorAll('.pagination a[href], .gallery-filters a[href]').length,
      formControls: document.querySelectorAll('[data-quote-form] input, [data-quote-form] select, [data-quote-form] textarea').length,
      detailsNative: key !== 'contact' || document.querySelector('[data-form-details]')?.tagName === 'DETAILS',
      expectedSectionNav: sectionNav,
    }), { key: route.key, sectionNav: route.sectionNav });
    const pass = response?.status() === 200 && noJs.h1 === 1 && noJs.nav === 7
      && (route.key === 'home' ? noJs.breadcrumb === 0 : noJs.breadcrumb === 1)
      && (route.sectionNav ? noJs.sectionLinks > 0 : noJs.sectionLinks === 0)
      && (route.key !== 'gallery' || (noJs.galleryLinks === 24 && noJs.paginationLinks > 0))
      && (route.key !== 'contact' || (noJs.formControls === 16 && noJs.detailsNative));
    addCheck(`no-JS ${route.path}`, pass, JSON.stringify(noJs));
  }
  await context.close();
}

// Reduced motion keeps content visible and does not force smooth scrolling.
{
  process.stdout.write('reduced-motion\n');
  const context = await chromiumBrowser.newContext({ viewport: { width: 375, height: 900 }, reducedMotion: 'reduce' });
  await context.route(/\.(?:mp4|webm)(?:\?|$)/i, (route) => route.abort());
  const page = await context.newPage();
  page.setDefaultTimeout(5000);
  await page.goto(`${baseUrl}/tasarim`, { waitUntil: 'domcontentloaded' });
  const reduced = await page.evaluate(() => ({
    preference: matchMedia('(prefers-reduced-motion: reduce)').matches,
    hiddenReveal: Array.from(document.querySelectorAll('[data-reveal]')).some((element) => getComputedStyle(element).opacity === '0'),
    scrollBehavior: getComputedStyle(document.documentElement).scrollBehavior,
  }));
  addCheck('reduced motion', reduced.preference && !reduced.hiddenReveal && reduced.scrollBehavior === 'auto', JSON.stringify(reduced));
  await context.close();
}

// WebKit smoke test when the bundled browser is available.
try {
  process.stdout.write('webkit-smoke\n');
  const webkitBrowser = await webkit.launch({ headless: true });
  const context = await webkitBrowser.newContext({ viewport: { width: 375, height: 900 } });
  await context.route(/\.(?:mp4|webm)(?:\?|$)/i, (route) => route.abort());
  const page = await context.newPage();
  page.setDefaultTimeout(5000);
  const errors = [];
  page.on('console', (message) => { if (message.type() === 'error') errors.push(message.text()); });
  page.on('pageerror', (error) => errors.push(error.message));
  const response = await page.goto(`${baseUrl}/`, { waitUntil: 'domcontentloaded' });
  const result = await page.evaluate(() => ({ h1: document.querySelectorAll('h1').length, overflow: document.documentElement.scrollWidth - document.documentElement.clientWidth }));
  addCheck('WebKit mobile smoke', response?.status() === 200 && result.h1 === 1 && result.overflow <= 1 && errors.length === 0, JSON.stringify({ ...result, errors }));
  browserResults.push({ browser: 'WebKit', status: 'tested' });
  await context.close();
  await webkitBrowser.close();
} catch (error) {
  browserResults.push({ browser: 'WebKit', status: 'unavailable', reason: error.message });
}
}

await chromiumBrowser.close();

const report = {
  generatedAt: new Date().toISOString(),
  baseUrl,
  viewports,
  routeCount: routes.length,
  checkCount: checks.length,
  passed: checks.filter((check) => check.pass).length,
  failed: failures.length,
  browsers: [{ browser: 'Chromium/Chrome', status: 'tested' }, ...browserResults],
  failures,
  checks,
};
const reportName = process.env.SKIP_MAIN === '1' ? 'audit-auxiliary.json' : (process.env.AUDIT_WIDTH ? `audit-${process.env.AUDIT_WIDTH}.json` : 'audit.json');
await writeFile(path.join(outputDir, reportName), `${JSON.stringify(report, null, 2)}\n`, 'utf8');
process.stdout.write(`${JSON.stringify({ checkCount: report.checkCount, passed: report.passed, failed: report.failed, browsers: report.browsers, failures }, null, 2)}\n`);
process.exitCode = failures.length ? 1 : 0;
