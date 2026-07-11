# Font and Turkish Character Report

## Previous problem

The redesign declared both the Latin and Latin Extended Manrope subsets, but only the basic Latin file was preloaded. With `font-display: swap`, basic Latin characters could render in Manrope before the browser fetched the Turkish glyph subset, while Turkish-specific characters briefly used the fallback stack. That mixed initial render can create visible weight and baseline differences.

The page now preloads both subset files and keeps their `unicode-range` declarations separate. The Latin Extended source covers the Turkish uppercase/lowercase characters, and every visible locale has the correct `<html lang>` value.

## Font files

| File | Role | Declared weights |
|---|---|---|
| `redesign/assets/fonts/manrope-latin.woff2` | Basic Latin, punctuation and dotless `ı` range | 400-800 |
| `redesign/assets/fonts/manrope-latin-ext.woff2` | Latin Extended and Turkish-specific glyphs | 400-800 |

The CSS uses one family and one variable weight range. Synthetic bold is not required for the weights used by the interface.

## Character test

Test string:

```text
Ç ç  Ğ ğ  İ i  I ı  Ö ö  Ş ş  Ü ü
İstanbul’da kadın, erkek ve çocuk giyim üretimi
Tasarım, ölçü, numune, dikim ve kalite kontrol
Örme ve dokuma ürünler için sürdürülebilir çözümler
IĞDIR, İZMİR, ŞİŞLİ, ÇORLU, GÖRÜŞME, ÜRETİM
```

Browser `FontFaceSet.check()` returned `true` for weights `400`, `500`, `600`, `650`, `700`, `750` and `800` with the full Turkish sample.

## Interface coverage

| Surface | Computed family | Computed weight | Result |
|---|---|---:|---|
| Desktop menu | Manrope | 700 | PASS |
| Hero H1 | Manrope | 650 | PASS |
| Uppercase kicker | Manrope | 800 | PASS |
| Form labels | Manrope | 750 | PASS |
| Buttons | Manrope | 750 | PASS |
| Footer/body | Manrope | 400 | PASS |

Mobile menu, numerical indicators, product headings and contact fields inherit the same tested family. Screenshots at 320, 375, 430, 768, 1024, 1280 and 1440 px showed no mixed-glyph weight, baseline shift or fallback flash after the two subsets loaded.

## Locale result

| Locale route | `html lang` | Content behavior |
|---|---|---|
| Turkish | `tr` | Full Turkish content |
| English | `en` | Full English content |
| German | `de` | German preparation page, no English fallback presented as final content |
| Spanish | `es` | Spanish preparation page, no English fallback presented as final content |

Final font result: **PASS**.
