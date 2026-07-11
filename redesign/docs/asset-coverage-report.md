# Asset Coverage Report

This report inventories every image and video file under `public_html`. The row-level record is in `asset-coverage.csv`.

## Coverage Summary

- Total inventoried media files: **1180**
- Meaningful company/content assets: **313**
- Meaningful assets with no decision: **0**
- Duplicate hash groups: **206**
- Gallery assets exposed through server-rendered pagination: **282**
- Original files changed or deleted: **0**

## Decision Counts

| Decision | Files |
|---|---:|
| `DUPLICATE_DO_NOT_REPEAT` | 10 |
| `INTENTIONALLY_EXCLUDED` | 881 |
| `USE_AS_SUPPORTING_MEDIA` | 1 |
| `USE_IN_ARCHIVE_GALLERY` | 192 |
| `USE_IN_COLLECTION` | 4 |
| `USE_IN_GALLERY` | 49 |
| `USE_IN_PRODUCTION_PAGE` | 15 |
| `USE_IN_PRODUCTS` | 25 |
| `USE_ON_HOMEPAGE; USE_ON_PRODUCTION_PAGE; USE_WITH_POSTER` | 2 |
| `USE_ON_PRIMARY_PAGE` | 1 |

## Folder Counts

| Folder group | Files |
|---|---:|
| `public_html/Eski/admin` | 253 |
| `public_html/Eski/favicon.png` | 1 |
| `public_html/Eski/fonts` | 3 |
| `public_html/Eski/images` | 57 |
| `public_html/Eski/logolar.png` | 1 |
| `public_html/Eski/yukleme` | 92 |
| `public_html/admin/ckeditor` | 34 |
| `public_html/admin/css` | 61 |
| `public_html/admin/font-awesome` | 1 |
| `public_html/admin/fonts` | 1 |
| `public_html/admin/img` | 13 |
| `public_html/admin/js` | 114 |
| `public_html/admin/plupload` | 10 |
| `public_html/assets/fonts` | 6 |
| `public_html/assets/img` | 322 |
| `public_html/cocuk.jpg` | 1 |
| `public_html/en.png` | 1 |
| `public_html/erkek.jpg` | 1 |
| `public_html/favicon.png` | 1 |
| `public_html/kadin.jpg` | 1 |
| `public_html/tr.png` | 1 |
| `public_html/videos/eng.mp4` | 1 |
| `public_html/videos/tr.mp4` | 1 |
| `public_html/yukleme/anasayfa` | 25 |
| `public_html/yukleme/galeri` | 64 |
| `public_html/yukleme/referanslar` | 4 |
| `public_html/yukleme/urunler` | 110 |

## Meaningful Exclusions

These are the content-like files that are intentionally not rendered. Every exclusion has a specific technical or commercial reason.

| File | Reason |
|---|---|
| `public_html/Eski/yukleme/hizmetler/ekipsan_brosur-30.jpg` | Generic industrial PPE photograph is not evidence of Vista garment production. |
| `public_html/Eski/yukleme/hizmetler/FD.png` | Generic equipment render is not tied to Vista's verified garment workflow. |
| `public_html/Eski/yukleme/hizmetler/G099-2.jpg` | Wheelchair product image is unrelated to garment manufacturing and would mislead buyers. |
| `public_html/Eski/yukleme/hizmetler/slider-1.jpg` | Generic machinery image is unrelated to the documented garment process. |
| `public_html/Eski/yukleme/hizmetler/slider-2.jpg` | Generic motor image is unrelated to the documented garment process. |
| `public_html/Eski/yukleme/hizmetler/tersine-muhendislik.jpg` | Engineering diagram is unrelated to Vista's apparel services. |
| `public_html/yukleme/anasayfa/dikim.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/dikim2.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/kesim.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/kesim2.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/model.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/model2.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/tasarim.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |
| `public_html/yukleme/anasayfa/tasarim2.png` | Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement. |

## Video Summary

| File | Resolution | Duration | New use | Loading |
|---|---:|---:|---|---|
| `public_html/videos/tr.mp4` | 1920x1080 | 25.182 s | `/`, `/tasarim` | Poster-first, `preload=none`, no autoplay |
| `public_html/videos/eng.mp4` | 1920x1080 | 25.182 s | `/en/`, `/en/design` | Poster-first, `preload=none`, no autoplay |

## Notes

- `admin`, editor/plugin, theme-demo and generic UI artwork is inventoried but excluded from the public redesign because it is not company content.
- The original image and video files remain untouched in `public_html`.
- WebP thumbnails are separate derivatives under `redesign/assets/media`; originals remain available for detail views.
- Video compression derivatives remain a later optimization item; the current implementation prevents the 18 MB sources from downloading before user interaction.
