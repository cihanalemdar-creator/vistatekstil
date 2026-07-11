import { createRequire } from 'node:module';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';

const require = createRequire(import.meta.url);
const { chromium } = require('C:\\Users\\User\\.cache\\codex-runtimes\\codex-primary-runtime\\dependencies\\node\\node_modules\\playwright');

const root = process.cwd();
const output = path.join(root, 'redesign', 'docs', 'qa', 'ux-revision', 'screenshots-final');
const routes = ['/', '/kurumsal', '/urunler', '/tasarim', '/koleksiyon/referans', '/galeri/galerim2', '/iletisim'];
const widths = [375, 1440];
const slug = (route) => route === '/' ? 'home' : route.replace(/^\//, '').replaceAll('/', '__');

await mkdir(output, { recursive: true });
const browser = await chromium.launch({
  headless: true,
  executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
});

for (const width of widths) {
  const context = await browser.newContext({ viewport: { width, height: 900 }, reducedMotion: 'reduce' });
  await context.route(/\.(?:mp4|webm)(?:\?|$)/i, (route) => route.abort());
  const page = await context.newPage();
  for (const route of routes) {
    await page.goto(`http://127.0.0.1:8082${route}`, { waitUntil: 'domcontentloaded' });
    await page.waitForTimeout(180);
    if (route.includes('galeri')) {
      const height = await page.evaluate(() => document.documentElement.scrollHeight);
      for (let y = 0; y < height; y += 700) {
        await page.evaluate((top) => window.scrollTo(0, top), y);
        await page.waitForTimeout(45);
      }
    }
    await page.evaluate(() => window.scrollTo(0, 0));
    await page.screenshot({ path: path.join(output, `${width}-${slug(route)}.png`), fullPage: true });
  }
  await context.close();
}

await browser.close();
process.stdout.write(`Captured ${routes.length * widths.length} screenshots in ${output}\n`);
