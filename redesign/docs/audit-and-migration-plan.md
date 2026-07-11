# Vista Tekstil Redesign Audit and Migration Plan

## A. Baseline Status

- Branch: `codex/vista-redesign-foundation`
- Baseline commits before this phase: `dd556eb Ignore generated local staging preview`, `f107b52 Add current public_html baseline`
- Uncommitted changes at start: `local_php_router.php` from local PHP staging setup
- Existing local PHP preview: `http://127.0.0.1:8081/`
- Existing local routes verified: `/`, `/kurumsal`, `/tasarim`, `/urunler`, `/iletisim`, `/koleksiyon/referans`, `/galeri/galerim2`, `/kategori/erkek-giyim`
- Build scripts: none found
- Lint/type-check scripts: none found
- Live deployment/DNS/hosting changes: none

## B. Current Technical Stack

- Runtime: PHP application, tested locally with XAMPP PHP 8.2.12
- Server: Apache-compatible `.htaccess` in production, PHP built-in server for local preview
- Database layer: custom PDO wrapper in `public_html/inc/DW_class.php`
- Styling: Bootstrap CSS, Font Awesome, Slick, Magnific Popup, large custom `assets/css/style.css`
- JavaScript: jQuery 3.6.0, Bootstrap 5 beta-era JS, Slick, Isotope, CounterUp and other global scripts
- Localization: session-based `dil.php` with Turkish/English switching; no URL-based locale system
- Rendering: server-side PHP includes
- SEO: basic title/meta helper; no canonical, no hreflang, no sitemap, no robots.txt
- Forms: contact form posts to missing `mail.php`

## C. Current Route Map

| Existing URL | Page | Source file | Current scope | Decision | New structure counterpart |
|---|---|---|---|---|---|
| `/` | Home | `public_html/index.php` | hero video, company intro, product categories, capabilities, CTA | `KEEP_URL_AND_REBUILD_PAGE` | `/`, `/en/`, `/de/`, `/es/` |
| `/kurumsal` | About | `public_html/kurumsal.php` | strongest company, capacity, MOQ, market, compliance content | `KEEP_URL_AND_EXPAND_CONTENT` | `/kurumsal`, `/en/about`, `/de/unternehmen`, `/es/empresa` |
| `/urunler` | Products | `public_html/urunler.php` | category grid from DB | `KEEP_URL_AND_REBUILD_PAGE` | `/urunler`, `/en/products`, `/de/produkte`, `/es/productos` |
| `/tasarim` | Design/Production | `public_html/tasarim.php` | design, cutting, sewing, model room; some placeholder text | `KEEP_URL_AND_EXPAND_CONTENT` | `/tasarim`, `/en/production`, `/de/produktion`, `/es/produccion` |
| `/koleksiyon/referans` | Collection | `public_html/koleksiyon.php` | reference/gallery images from DB | `KEEP_AS_LEGACY_ENTRY` | keep as collection/selected work entry |
| `/galeri/galerim2` | Gallery | `public_html/galeri.php` | gallery images from DB | `KEEP_URL_AND_CHANGE_TEMPLATE` | gallery / selected work |
| `/iletisim` | Contact | `public_html/iletisim.php` | contact details, map, form | `KEEP_URL_AND_REBUILD_PAGE` | `/iletisim`, `/en/contact`, `/de/kontakt`, `/es/contacto` |
| dynamic product slugs | Product/category detail | `urun-detay.php`, `urun-kategori.php` | DB-driven detail pages | `REQUIRES_SEO_REVIEW` | keep valid slugs; redirect only after inventory |
| `/admin/*` | Admin | `public_html/admin` | private CMS/admin area | `KEEP_AS_LEGACY_ENTRY` but remove from public deploy surface if replaced | not in public sitemap |
| `/Eski/*` | Legacy old site | `public_html/Eski` | old duplicate site/admin | `REMOVE_WITH_404_OR_410` after backup/review | not in new public site |
| `/504.php` | suspicious PHP | `public_html/504.php` | obfuscated command/upload behavior | `REMOVE_WITH_404_OR_410` | remove/quarantine before deployment |

## D. Existing URL Preservation Table

| Existing URL | Current topic | Recommended action | Final URL | Reason |
|---|---|---|---|---|
| `/` | Turkish homepage | preserve and rebuild | `/` | root Turkish URL already indexed/known |
| `/kurumsal` | company profile | preserve and expand | `/kurumsal` | contains most valuable B2B factual content |
| `/urunler` | product categories | preserve and rebuild | `/urunler` | navigation and SEO value |
| `/tasarim` | design/development/production | preserve and expand | `/tasarim` | existing URL has topical value |
| `/iletisim` | contact | preserve and rebuild | `/iletisim` | conversion route |
| `/galeri/galerim2` | gallery | preserve initially | `/galeri/galerim2` | image/portfolio value; review later |
| `/koleksiyon/referans` | collection/reference | preserve initially | `/koleksiyon/referans` | existing internal nav link |

No bulk redirect to homepage is recommended.

## E. Content Source-of-Truth

| Information | Source | Classification | Notes |
|---|---|---|---|
| Correct public brand should be Vista Tekstil | user brief + current site branding | `EXPLICIT_FACT` | Use consistently; avoid Vista Moda as primary brand label except legal/source context |
| Founded in 2019 by Dilek Akkoyunlu | `kurumsal.php`, footer | `EXPLICIT_FACT` | Preserve |
| Ready-to-wear garment manufacturer | `kurumsal.php`, footer | `EXPLICIT_FACT` | Direct manufacturer positioning |
| Womenswear, menswear, childrenswear | `index.php`, `kurumsal.php` | `EXPLICIT_FACT` | Preserve as product groups |
| Circular knit cut-and-sew and woven garments | `index.php`, `kurumsal.php` | `EXPLICIT_FACT` | Preserve as capability groups |
| Blouses, dresses, jackets, skirts, shorts, trousers | `kurumsal.php` | `EXPLICIT_FACT` | Preserve in product pages |
| Design and development | `tasarim.php` | `EXPLICIT_FACT` | Expand editorially |
| Pattern/model room and sampling | `tasarim.php`, `kurumsal.php` | `EXPLICIT_FACT` | Preserve |
| Cutting, sewing, quality control, packing in-house | `kurumsal.php` | `EXPLICIT_FACT` | Preserve |
| Monthly in-house capacity 5,000 pcs | `kurumsal.php` | `EXPLICIT_FACT` | Use carefully |
| Total monthly capacity 35,000 pcs | `kurumsal.php` | `EXPLICIT_FACT` | Use carefully |
| MOQ 100 units unless fabric supplier limit applies | `kurumsal.php` | `EXPLICIT_FACT` | Preserve with context |
| USA, UK, Germany, Turkey brand markets | `kurumsal.php` | `EXPLICIT_FACT` | Preserve |
| SEDEX/BSCI-certified production partners | `kurumsal.php` | `INCOMPLETE_BUT_USABLE` | Needs document confirmation before final marketing emphasis |
| BCI, GRS, ORC/OCS, Oeko-Tex mills | `kurumsal.php` | `INCOMPLETE_BUT_USABLE` | Keep as reviewable sourcing statement |
| Placeholder cutting/sewing text on `tasarim` | `tasarim.php` | `INCOMPLETE_BUT_USABLE` | Replace with stronger content based on corporate page |

## F. Content Migration Summary

| sourceRoute | sourceSection | originalInformation | classification | newRoute | newSection | plannedTreatment | reason | status |
|---|---|---|---|---|---|---|---|---|
| `/kurumsal` | company copy | 2019 foundation and founder | `EXPLICIT_FACT` | home/about | proof/about | `KEEP` | trust signal | implemented on homepage |
| `/kurumsal` | production paragraph | 5,000 in-house / 35,000 total capacity | `EXPLICIT_FACT` | home/about/production | proof/capacity | `KEEP` | B2B qualification | implemented on homepage |
| `/kurumsal` | MOQ paragraph | MOQ 100, supplier MOQ caveat | `EXPLICIT_FACT` | home/products/RFQ | proof/process | `KEEP` | buyer qualification | implemented on homepage |
| `/kurumsal` | markets | USA, UK, Germany, Turkey | `EXPLICIT_FACT` | home/about | about | `KEEP` | export credibility | implemented on homepage |
| `/tasarim` | design text | design and development importance | `EXPLICIT_FACT` | home/production | capabilities | `REWRITE_AND_STRENGTHEN` | clearer technical language | implemented on homepage |
| `/tasarim` | cutting/sewing placeholders | Loading Content | `INCOMPLETE_BUT_USABLE` | production | capabilities | `EXPAND` | use corporate page detail instead | planned |
| `/iletisim` | form | contact form to missing `mail.php` | `INCOMPLETE_BUT_USABLE` | contact/RFQ | form | `REQUIRES_CONTEXT` | backend must be fixed safely | planned |
| `/galeri/galerim2` | gallery images | production/product imagery | `EXPLICIT_FACT` | gallery/home | asset registry | `REORGANIZE` | classify before reuse | planned |

## G. Asset Summary

| Asset | Type | Current role | Status | New use | Need |
|---|---|---|---|---|---|
| `videos/tr.mp4` | video, 18MB | Turkish hero | `NEEDS_OPTIMIZATION` | possible future hero only after optimization | mobile fallback required |
| `videos/eng.mp4` | video, 18MB | English hero | `NEEDS_OPTIMIZATION` | possible future hero only after optimization | mobile fallback required |
| `yukleme/galeri/b_13240915.jpg` | image | production-room photo | `REPLACE_WHEN_NEW_ASSET_ARRIVES` | temporary homepage hero | replace with a higher-resolution current production image |
| `yukleme/anasayfa/1.jpg`, `2.jpg`, `3.jpg` | images | about collage | `KEEP_CANDIDATE` | about/company sections | review quality/crops |
| `yukleme/urunler/*.jpg` | product images | product/category visuals | `PRODUCT_CANDIDATE` | product grids/gallery | optimize and classify |
| `yukleme/galeri/*.jpg` | gallery images | gallery visuals | `GALLERY_CANDIDATE` | selected work/gallery | optimize and classify |
| `WM logo.pdf` | vector logo source | supplied brand asset | `KEEP_CANDIDATE` | header/footer | exported as a transparent web PNG without altering the artwork |
| old admin/demo assets | mixed | admin/vendor samples | `UNUSED` / `NEEDS_REVIEW` | none | exclude from public deploy |

Pending image fields should support: `available`, `temporary`, `pending`, `needs_review`, `replace_before_launch`.

## H. Proposed Sitemap

- `/` Turkish homepage, preserved
- `/kurumsal` About/company, preserved and expanded
- `/urunler` Product overview, preserved
- `/tasarim` Production/design capabilities, preserved but renamed in nav as Production if approved
- `/kalite-uygunluk` Quality & compliance, new only when content is strong enough
- `/surdurulebilirlik` Sustainability, new only after certificate/document review
- `/galeri/galerim2` Gallery/selected work, preserved initially
- `/koleksiyon/referans` Collection legacy entry, preserved initially
- `/iletisim` Contact/RFQ, preserved

Localized counterparts are defined in `redesign/data/site.php`.

## I. Multilingual Architecture

- Turkish root URLs remain unchanged.
- English uses `/en/...`.
- German uses `/de/...`.
- Spanish uses `/es/...`.
- Locale route map is centralized in `redesign/data/site.php`.
- Only `published` or `approved` pages are included in hreflang and sitemap output. Local tr/en page previews remain switchable for review.
- German and Spanish homepage content is currently `review_required`, so it is not exposed as final language navigation.
- Missing translations fallback to English internally but must not be treated as final publication.

## J. Hreflang Map

| page key | Turkish URL | English URL | German URL | Spanish URL | publication status |
|---|---|---|---|---|---|
| home | `/` | `/en/` | `/de/` | `/es/` | tr/en published; de/es review_required |
| about | `/kurumsal` | `/en/about` | `/de/unternehmen` | `/es/empresa` | draft |
| products | `/urunler` | `/en/products` | `/de/produkte` | `/es/productos` | draft |
| production | `/tasarim` | `/en/production` | `/de/produktion` | `/es/produccion` | draft |
| gallery | `/galeri/galerim2` | `/en/gallery` | `/de/galerie` | `/es/galeria` | draft |
| contact | `/iletisim` | `/en/contact` | `/de/kontakt` | `/es/contacto` | draft |

## K. Internal Linking Map

- Home -> About, Products, Production, Contact
- About -> Production, Quality/Compliance, Contact
- Products -> Product groups, Production, RFQ
- Production -> Products, Quality, Contact
- Gallery -> Products, Production, Contact
- Contact -> Products and Production context for RFQ preparation

## L. Component Architecture

Implemented in the first vertical slice:

- centralized site config
- company/contact data
- localized route map
- publication status model
- asset registry
- SEO/canonical/hreflang helper behavior in render layer
- header, desktop navigation, mobile navigation
- language switcher
- footer
- hero, proof band, editorial company intro, product cards, capability gallery/list, process section, market section, quality section, CTA
- reusable source-based interior page, gallery and contact preview layouts

## M. Files Changed

- `local_php_router.php`: local-only compatibility router for the original PHP site
- `redesign/index.php`: new local redesign renderer
- `redesign/router.php`: PHP built-in server router for redesign preview
- `redesign/data/site.php`: centralized brand, contact, locale, route and navigation config
- `redesign/data/content.php`: source-based homepage content, asset registry and schema
- `redesign/assets/css/styles.css`: new responsive visual foundation
- `redesign/assets/img/vista-moda-tekstil-logo.png`: transparent web export of the supplied PDF logo
- `redesign/docs/audit-and-migration-plan.md`: audit, route, content, asset and migration documentation

## N. Reused Existing Code

- Existing public assets remain in `public_html`.
- The supplied PDF logo is used through a dedicated transparent web export; existing production and product photos are reused through the asset registry.
- Existing URLs are preserved in the route map.
- Existing factual content from `index.php`, `kurumsal.php`, `tasarim.php`, `iletisim.php` is used as content source.

## O. Removed or Replaced Code

- No existing production file was deleted.
- No existing route was removed.
- The new vertical slice does not depend on the old session-based language switcher.

## P. Homepage Content Coverage

- Preserved: manufacturer positioning, founder/year, product categories, knit/woven scope, capabilities, capacity, MOQ, markets, quality/control, sustainability/compliance statements.
- Strengthened: production workflow, category framing, manufacturer positioning, RFQ-oriented CTA.
- Moved/planned: detailed compliance and sustainability should become dedicated pages after document review.
- Requires confirmation: certificate documentation and any final sustainability wording.
- Unsupported claims added: none.

## Q. Pending Images List

| page | section | purpose | orientation | aspect ratio | minimum resolution | current status |
|---|---|---|---|---|---|---|
| home | hero | real factory/production impression | landscape | 16:9 or 4:3 | 1600x900 | temporary |
| home | products | product category examples | mixed | 4:5 / 1:1 | 1200x1500 | pending |
| production | process | cutting/sewing/quality scenes | landscape | 3:2 | 1600x1067 | pending |
| about | company | founder/team/facility | landscape | 3:2 | 1600x1067 | pending |
| gallery | selected work | product and production proof | mixed | varied | 1200px long edge | needs_review |

## R. Test Results

- Existing local PHP routes: passed with HTTP 200 on main routes.
- New redesign PHP lint: passed for `redesign/index.php`, `redesign/router.php`, `redesign/data/site.php`, `redesign/data/content.php`.
- New redesign HTTP checks: `/`, `/en/`, `/kurumsal`, `/en/about`, `/urunler`, `/tasarim`, `/koleksiyon/referans`, `/galeri/galerim2`, `/iletisim`, CSS, logo, `/robots.txt` and `/sitemap.xml` returned their expected responses.
- Unknown redesign route: `/does-not-exist` returned HTTP 404.
- Build: no build script exists.
- Type-check: no TypeScript/tooling exists.
- Responsive checks: visually verified at 320, 375 and 1440 pixels in the in-app browser. No horizontal overflow was detected at 320/375/1440; the mobile menu opens and closes correctly.
- Accessibility: semantic landmarks, skip link, visible focus states, nav labels and non-JS mobile details menu implemented.
- Console: no warnings or errors recorded during the local browser check.
- Broken links: all homepage navigation and local asset links returned HTTP 200. Interior previews remain `noindex` until content approval.

## S. Remaining Risks

- Original project contains critical security risks and secrets; do not push/deploy current `public_html` publicly before remediation.
- Contact backend is broken or incomplete.
- Real database dump is not available locally; minimum seed DB is only for preview.
- German/Spanish translations require human review before publication.
- New images are pending.
- Certificate/sustainability claims should be verified before being emphasized in final copy.

## T. Recommended Next Implementation Phase

1. Build the About page because it contains the most factual B2B substance.
2. Build Production/Capabilities from `/tasarim` plus corporate production details.
3. Build Products with womenswear, menswear, kidswear, knit and woven groupings.
4. Replace Contact with a safe RFQ-ready form plan while preserving `/iletisim`.
5. Build Gallery/Selected Work after asset review.
6. Add sitemap, robots, full hreflang output and redirect map after page publication statuses are approved.
