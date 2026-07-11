# Vista Tekstil Hero Video Revision Report

## Scope and Safety

- Work area: local `redesign` candidate only
- Old reference: `http://127.0.0.1:8081`
- New candidate: `http://127.0.0.1:8082`
- Live deployment, DNS, hosting, mail and `public_html` modifications: **0**
- Navigation, routes, hero copy, CTA destinations and interior page structures changed: **0**
- Original videos retained as source masters and remain in use as user-controlled, `preload="none"` media on Design pages

## A. Video Source Report

### Source masters

| Source | Format | Resolution / FPS | Duration | Size | Status |
|---|---|---:|---:|---:|---|
| `public_html/videos/tr.mp4` | H.264 MP4 + AAC | 1920x1080 / 60 fps | 25.182 s | 18,108,613 B | Unchanged master |
| `public_html/videos/eng.mp4` | H.264 MP4 + AAC | 1920x1080 / 60 fps | 25.182 s | 18,335,318 B | Unchanged master |

SHA-256 after implementation:

- TR: `7F9A3EBC977ADA99E31332C3CB7E8C9C7F4B6F8AE68A03F6E7AF4673FC868F93`
- EN: `AF43BF02DDC09FC5377A2FC61C76BC1B114BC53F110867F4691695E1AC49719F`

### Optimized derivatives

All derivatives are 30 fps, have no audio track and are separate from the source masters. MP4 files use H.264, `yuv420p` and faststart. WebM files use VP9.

| File | Codec | Resolution | Bitrate | Size | Use |
|---|---|---:|---:|---:|---|
| `tr-desktop.webm` | VP9 | 1600x900 | 1,253,218 bps | 3,942,312 B | TR desktop, Chromium-first |
| `tr-desktop.mp4` | H.264 | 1600x900 | 1,468,137 bps | 4,618,515 B | TR desktop, WebKit/fallback |
| `tr-mobile.webm` | VP9 | 720x1280 | 560,984 bps | 1,764,718 B | TR mobile, Chromium-first |
| `tr-mobile.mp4` | H.264 | 720x1280 | 697,861 bps | 2,195,355 B | TR mobile, WebKit/fallback |
| `eng-desktop.webm` | VP9 | 1600x900 | 1,265,556 bps | 3,981,124 B | EN desktop, Chromium-first |
| `eng-desktop.mp4` | H.264 | 1600x900 | 1,481,110 bps | 4,659,328 B | EN desktop, WebKit/fallback |
| `eng-mobile.webm` | VP9 | 720x1280 | 570,185 bps | 1,793,660 B | EN mobile, Chromium-first |
| `eng-mobile.mp4` | H.264 | 720x1280 | 699,534 bps | 2,200,620 B | EN mobile, WebKit/fallback |

Posters:

- Desktop WebP: 1600x900, 4,330 B per locale
- Mobile WebP: 720x1280, 2,420 B per locale
- The poster is preloaded with a media condition; the video itself is not preloaded in reduced-motion or blocked fallback states.

The mobile derivative preserves the complete 16:9 editorial composition in the centre of a 720x1280 canvas. A softened continuation of the same frame fills the portrait background, avoiding destructive centre cropping of the original text and production panels.

Source selection is progressive and single-request:

- Chromium: VP9 WebM
- Safari/WebKit family: H.264 MP4 for reliable playback
- Mobile: only the mobile derivative is assigned
- Desktop: only the desktop derivative is assigned
- The original 18 MB source is never assigned to the homepage hero

## B. Autoplay Test Report

| Environment | Source selected | Autoplay | Muted | Inline | Loop | Fallback |
|---|---|---|---|---|---|---|
| Chrome desktop | Desktop WebM | PASS | PASS | PASS | PASS | PASS |
| Chrome responsive/mobile | Mobile WebM | PASS | PASS | PASS | PASS | PASS |
| WebKit desktop | Desktop H.264 MP4 | PASS | PASS | PASS | PASS | PASS |
| Autoplay blocked simulation | Poster | Block handled | PASS | N/A | N/A | Visible Play video control, no console error |
| Reduced motion | No initial video request | Disabled by preference | PASS | N/A | N/A | Poster and manual Play video control |
| Slow 3G simulation | Mobile WebM | Attempted | PASS | PASS | PASS | Poster/CTA remain usable until playback |

Responsive matrix: Turkish and English homepages at 320, 375, 430, 768, 1024, 1280 and 1440 px. Result: **14/14 PASS**.

The same matrix was repeated against `https://vista-tekstil-preview.vercel.app`. CDN result: **14/14 PASS, 0 failures**. The deployment is `READY` and belongs only to the isolated `vista-tekstil-preview` project.

Assertions included source language, mobile/desktop variant, one video request only, no original master request, one H1, visible CTAs, no H1/control overlap, no horizontal overflow, no console errors and no actionable failed requests.

WebKit emitted one Playwright-Windows engine diagnostic (`Temporal.Duration properties must be finite and of consistent sign`). It was recorded separately as a test-engine issue. The page console remained clean, the H.264 video reached `readyState=4`, and autoplay, muted and inline playback all passed.

## C. Performance Report

The comparison baseline is the same current homepage under `prefers-reduced-motion: reduce`, where only the poster is loaded. It is a measured poster-only control, not an estimate of a historical build.

| Metric | Poster-only control | Autoplay hero | Difference |
|---|---:|---:|---:|
| Initial requests | 12 | 13 | +1 video request |
| Observed response bytes | 1,920,743 B | 5,863,055 B | +3,942,312 B |
| LCP, local Chrome | 1,060 ms | 1,076 ms | +16 ms |
| CLS | 0 | 0 | 0 |

- The added desktop response exactly matches the 3,942,312 B TR desktop WebM.
- The video request began approximately 937 ms after the document request in the measured local run.
- The LCP candidate was the video first frame in the final autoplay run. It appeared at 1,076 ms and did not wait for the 25-second video or complete playback.
- Desktop hero media is 3.94 MB WebM or 4.62 MB MP4, below the 6-8 MB preference.
- Mobile hero media is 1.76 MB WebM or 2.20 MB MP4, below the 2-4 MB preference.
- Mobile/desktop alternatives were never requested together.
- No horizontal overflow and no hero layout shift were measured.
- The Design-page video remains poster-first and user-controlled, so navigating there does not alter homepage source selection.

## D. Accessibility Report

- `autoplay`, `muted`, `loop` and `playsinline` are present in HTML.
- `video.muted`, `video.defaultMuted` and `video.playsInline` are also established before playback.
- `prefers-reduced-motion: reduce` prevents initial source assignment and leaves the poster visible.
- Manual playback from the reduced-motion state passed.
- Play/pause and mute/unmute controls passed keyboard Enter tests.
- Controls have localized `aria-label` and `title` values.
- Sound is always off at initial playback and can only be enabled by user action.
- The autoplay-blocked state keeps hero copy and CTAs visible and provides a labelled Play video button.
- Media failure keeps the poster and does not disable hero links.

## E. Files Changed

Modified:

- `redesign/index.php`
- `redesign/data/assets.php`
- `redesign/assets/css/styles.css`

Added:

- `redesign/assets/js/hero-video.js`
- `redesign/assets/media/hero/tr-desktop.webm`
- `redesign/assets/media/hero/tr-desktop.mp4`
- `redesign/assets/media/hero/tr-desktop-poster.webp`
- `redesign/assets/media/hero/tr-mobile.webm`
- `redesign/assets/media/hero/tr-mobile.mp4`
- `redesign/assets/media/hero/tr-mobile-poster.webp`
- `redesign/assets/media/hero/eng-desktop.webm`
- `redesign/assets/media/hero/eng-desktop.mp4`
- `redesign/assets/media/hero/eng-desktop-poster.webp`
- `redesign/assets/media/hero/eng-mobile.webm`
- `redesign/assets/media/hero/eng-mobile.mp4`
- `redesign/assets/media/hero/eng-mobile-poster.webp`
- `redesign/tools/hero-video-audit.cjs`
- `redesign/docs/qa/hero-video/audit.json`
- `redesign/docs/qa/hero-video/tr-375.png`
- `redesign/docs/qa/hero-video/tr-1440.png`
- `redesign/docs/qa/hero-video-vercel/audit.json`
- `redesign/docs/qa/hero-video-vercel/tr-375.png`
- `redesign/docs/qa/hero-video-vercel/tr-1440.png`
- `redesign/docs/qa/video-contact/tr-contact.jpg`
- `redesign/docs/qa/video-contact/eng-contact.jpg`
- `redesign/docs/qa/video-derivatives/tr-desktop-6s.jpg`
- `redesign/docs/qa/video-derivatives/tr-mobile-6s.jpg`
- `redesign/docs/hero-video-revision-report.md`

## Final Result

**HERO_VIDEO_REVISION_APPROVED_FOR_STAGING_REVIEW**

The homepage hero now autoplays the correct localized, optimized media where browser policy permits. Poster, blocked-autoplay, low-bandwidth and reduced-motion paths remain functional. This is a staging/local approval only and does not authorize live publication.

Review URL: `https://vista-tekstil-preview.vercel.app`

The review deployment sends `X-Robots-Tag: noindex, nofollow, noarchive`, includes page-level `noindex,nofollow`, and serves a `Disallow: /` robots policy.
