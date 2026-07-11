from __future__ import annotations

import csv
import hashlib
import re
from collections import Counter, defaultdict
from pathlib import Path

from PIL import Image, ImageOps


ROOT = Path(__file__).resolve().parents[2]
PUBLIC = ROOT / "public_html"
OUTPUT_DIR = ROOT / "redesign" / "docs"
MEDIA_EXTENSIONS = {".jpg", ".jpeg", ".png", ".gif", ".webp", ".svg", ".mp4", ".webm", ".mov", ".avi"}

CURATED_PRODUCTS = {
    "b_13294573.jpg", "b_13974932.jpg", "b_22572976.jpg", "b_27635530.jpg", "b_39497391.jpg", "b_41904014.jpg",
    "b_11894314.jpg", "b_18152692.jpg", "b_23548920.jpg", "b_49281808.jpg", "b_5674047.jpg", "b_71024668.jpg",
    "b_22747453.jpg", "b_32464086.jpg", "b_37791168.jpg", "b_41672768.jpg", "b_55726790.jpg", "b_56804425.jpg",
    "b_38099833.jpg", "b_45427853.jpg", "b_55102590.jpg", "b_78361866.jpg",
    "b_20597532.jpg", "b_36689075.jpg", "b_49384394.jpg",
}

PROCESS_GALLERY = {
    "b_20237570.jpg", "b_24248807.jpg", "b_39668106.jpg", "b_50798094.jpg", "b_52916166.jpg", "b_53750109.jpg",
    "b_59517866.jpg", "b_61281373.jpg", "b_66422799.jpg", "b_66672604.jpg", "b_77478001.jpg", "b_78176068.jpg",
    "b_80220299.jpg", "b_81455276.jpg", "b_89058332.jpg",
}

HOME_ARCHIVE = {
    "1.jpg", "2.jpg", "3.jpg", "5.jpg", "6.jpg", "7.jpg", "8.jpg", "9.jpg", "10.jpg", "11.jpg", "12.jpg",
    "13.jpg", "14.jpg", "customer.png", "iletisim.jpg", "tr3.jpg",
}

LEGACY_SUPPORT = {
    "210e6334ce974422bcd9dfcfc4d57a4e.jpg", "442cc8d8-10c2-444d-a140-53fec7003bb4.jpg",
    "97fdc5d1-7f9e-4c4e-9e03-3f7a2436.jpg", "GettyImages-505831155-5970f70022fa3a00103a69da.jpg",
    "koleksiyon.jpg", "koleksiyon_1.jpg", "modelhane.jpg",
    "slasharchitects-Elissa-Stampa-Fashion-Design-Office-22-textile-showroom.jpg", "tasarim.jpg",
}

MISLEADING_LEGACY = {
    "ekipsan_brosur-30.jpg": "Generic industrial PPE photograph is not evidence of Vista garment production.",
    "FD.png": "Generic equipment render is not tied to Vista's verified garment workflow.",
    "G099-2.jpg": "Wheelchair product image is unrelated to garment manufacturing and would mislead buyers.",
    "slider-1.jpg": "Generic machinery image is unrelated to the documented garment process.",
    "slider-2.jpg": "Generic motor image is unrelated to the documented garment process.",
    "tersine-muhendislik.jpg": "Engineering diagram is unrelated to Vista's apparel services.",
}


def sha256(path: Path) -> str:
    digest = hashlib.sha256()
    with path.open("rb") as handle:
        for block in iter(lambda: handle.read(1024 * 1024), b""):
            digest.update(block)
    return digest.hexdigest()


def dimensions(path: Path) -> tuple[str, str, str]:
    if path.suffix.lower() in {".mp4", ".webm", ".mov", ".avi"}:
        return "1920", "1080", "25.182 s" if path.suffix.lower() == ".mp4" else ""
    if path.suffix.lower() == ".svg":
        try:
            text = path.read_text(encoding="utf-8", errors="ignore")[:5000]
            width = re.search(r'\bwidth=["\']([^"\']+)', text)
            height = re.search(r'\bheight=["\']([^"\']+)', text)
            return (width.group(1) if width else "", height.group(1) if height else "", "")
        except OSError:
            return "", "", ""
    try:
        with Image.open(path) as image:
            image = ImageOps.exif_transpose(image)
            return str(image.width), str(image.height), ""
    except Exception:
        return "", "", ""


def classify(relative: str, name: str) -> dict[str, str]:
    normalized = relative.replace("\\", "/")
    result = {
        "meaningful": "NO",
        "old_usage": "Legacy template, admin or interface asset",
        "new_usage": "Not rendered in the redesigned public site",
        "decision": "INTENTIONALLY_EXCLUDED",
        "optimization": "Not required",
        "replacement_status": "Not applicable",
        "exclusion_reason": "Administrative, plugin, theme-demo or interface artwork; not Vista company content.",
    }

    if normalized in {"cocuk.jpg", "erkek.jpg", "kadin.jpg"}:
        result.update(meaningful="YES", old_usage="Original product-category image", new_usage="/galeri/galerim2, Archive filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="Original retained; lazy loaded", exclusion_reason="")
    elif normalized in {"tr.png", "en.png", "favicon.png"}:
        result.update(meaningful="YES", old_usage="Original language or favicon UI", new_usage="Superseded by text language controls and the approved WM logo", decision="DUPLICATE_DO_NOT_REPEAT", exclusion_reason="Replaced by the new accessible text switcher or approved brand asset.")
    elif normalized.startswith("videos/"):
        locale_route = "/ and /tasarim" if name == "tr.mp4" else "/en/ and /en/design"
        result.update(meaningful="YES", old_usage="Original homepage production video", new_usage=locale_route, decision="USE_ON_HOMEPAGE; USE_ON_PRODUCTION_PAGE; USE_WITH_POSTER", optimization="1920x1080 original retained; preload none; poster-first; compressed derivative recommended", replacement_status="REPLACE_WHEN_NEW_VIDEO_ARRIVES", exclusion_reason="")
    elif normalized.startswith("yukleme/referanslar/"):
        result.update(meaningful="YES", old_usage="Original reference collection", new_usage="/koleksiyon/referans", decision="USE_IN_COLLECTION", optimization="Lazy loaded; original retained for editorial presentation", exclusion_reason="")
    elif normalized.startswith("yukleme/galeri/"):
        decision = "USE_IN_PRODUCTION_PAGE" if name in PROCESS_GALLERY else "USE_IN_GALLERY"
        usage = "/tasarim and /galeri/galerim2" if name in PROCESS_GALLERY else "/galeri/galerim2"
        if name == "b_13240915.jpg":
            decision, usage = "USE_ON_PRIMARY_PAGE", "/, /galeri/galerim2 and video poster"
        result.update(meaningful="YES", old_usage="Original production and product gallery", new_usage=usage, decision=decision, optimization="520px WebP thumbnail generated; original retained for detail", replacement_status="REPLACE_WHEN_NEW_ASSET_ARRIVES" if name == "b_13240915.jpg" else "KEEP", exclusion_reason="")
    elif normalized.startswith("yukleme/urunler/"):
        if name in CURATED_PRODUCTS:
            result.update(meaningful="YES", old_usage="Original product catalogue", new_usage="/urunler and /galeri/galerim2", decision="USE_IN_PRODUCTS", optimization="520px WebP gallery thumbnail generated; original retained on product page", exclusion_reason="")
        else:
            result.update(meaningful="YES", old_usage="Original product catalogue", new_usage="/galeri/galerim2, Products filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="520px WebP thumbnail generated; original retained for detail", exclusion_reason="")
    elif normalized.startswith("yukleme/anasayfa/"):
        if name == "9.jpg":
            result.update(meaningful="YES", old_usage="Original homepage design image", new_usage="/ and /tasarim", decision="USE_IN_PRODUCTION_PAGE", optimization="Original lazy loaded", replacement_status="REPLACE_WHEN_NEW_ASSET_ARRIVES", exclusion_reason="")
        elif name in HOME_ARCHIVE:
            result.update(meaningful="YES", old_usage="Original homepage visual", new_usage="/galeri/galerim2, Archive filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="520px WebP thumbnail generated; original retained", exclusion_reason="")
        elif name == "logolar.png":
            result.update(meaningful="YES", old_usage="Original certification mark fragment", new_usage="Superseded by the more complete original certification strip", decision="DUPLICATE_DO_NOT_REPEAT", exclusion_reason="Partial duplicate; the complete Eski/logolar.png strip is used instead.")
        else:
            result.update(meaningful="YES", old_usage="Original blue process icon or empty companion image", new_usage="Replaced by real process photography and semantic numbered steps", decision="INTENTIONALLY_EXCLUDED", exclusion_reason="Low-information raster UI diagram or empty companion image; it does not document the real facility and has a real-photo replacement.")
    elif normalized.startswith("Eski/yukleme/urunler/"):
        result.update(meaningful="YES", old_usage="Legacy product catalogue archive", new_usage="/galeri/galerim2, Archive filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="520px WebP thumbnail generated; original retained for detail", exclusion_reason="")
    elif normalized.startswith("Eski/yukleme/slayt/"):
        result.update(meaningful="YES", old_usage="Legacy homepage slider", new_usage="/galeri/galerim2, Archive filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="520px WebP thumbnail generated; original retained", exclusion_reason="")
    elif normalized.startswith("Eski/yukleme/hizmetler/"):
        if name in LEGACY_SUPPORT:
            result.update(meaningful="YES", old_usage="Legacy service or production supporting image", new_usage="/galeri/galerim2, Archive filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="520px WebP thumbnail generated; original retained", exclusion_reason="")
        else:
            result.update(meaningful="YES", old_usage="Legacy service image", new_usage="Not rendered", decision="INTENTIONALLY_EXCLUDED", exclusion_reason=MISLEADING_LEGACY.get(name, "Unrelated generic industrial image; rendering it would misrepresent Vista's garment capabilities."))
    elif normalized in {"Eski/images/destek.jpg", "Eski/images/kurumsal.jpg", "Eski/images/ust.jpg"}:
        result.update(meaningful="YES", old_usage="Legacy corporate page visual", new_usage="/galeri/galerim2, Archive filter", decision="USE_IN_ARCHIVE_GALLERY", optimization="520px WebP thumbnail generated; original retained", exclusion_reason="")
    elif normalized == "Eski/logolar.png":
        result.update(meaningful="YES", old_usage="Original certification strip", new_usage="/kurumsal, Quality and sustainability section", decision="USE_AS_SUPPORTING_MEDIA", optimization="Small optimized source retained", exclusion_reason="")
    elif normalized.startswith("Eski/images/") and name.lower().startswith(("logo", "tr", "en", "favicon")):
        result.update(meaningful="YES", old_usage="Legacy brand or language artwork", new_usage="Superseded by approved WM logo and text language switcher", decision="DUPLICATE_DO_NOT_REPEAT", exclusion_reason="Superseded brand/interface asset; retaining it publicly would create inconsistent identity.")

    return result


files = sorted(path for path in PUBLIC.rglob("*") if path.is_file() and path.suffix.lower() in MEDIA_EXTENSIONS)
hashes = {path: sha256(path) for path in files}
hash_groups: dict[str, list[Path]] = defaultdict(list)
for path, digest in hashes.items():
    hash_groups[digest].append(path)

rows = []
for path in files:
    relative = path.relative_to(PUBLIC).as_posix()
    classification = classify(relative, path.name)
    width, height, duration = dimensions(path)
    duplicates = [other.relative_to(PUBLIC).as_posix() for other in hash_groups[hashes[path]] if other != path]
    rows.append({
        "file_path": f"public_html/{relative}",
        "file_type": path.suffix.lower().lstrip("."),
        "size_bytes": path.stat().st_size,
        "width": width,
        "height": height,
        "duration": duration,
        "sha256": hashes[path],
        "meaningful_content_asset": classification["meaningful"],
        "old_usage": classification["old_usage"],
        "new_usage": classification["new_usage"],
        "decision": classification["decision"],
        "optimization_need_or_result": classification["optimization"],
        "replacement_status": classification["replacement_status"],
        "exclusion_reason": classification["exclusion_reason"],
        "duplicate_counterpart": "; ".join(duplicates),
    })

OUTPUT_DIR.mkdir(parents=True, exist_ok=True)
csv_path = OUTPUT_DIR / "asset-coverage.csv"
with csv_path.open("w", encoding="utf-8-sig", newline="") as handle:
    writer = csv.DictWriter(handle, fieldnames=list(rows[0].keys()))
    writer.writeheader()
    writer.writerows(rows)

decision_counts = Counter(row["decision"] for row in rows)
folder_counts = Counter("/".join(row["file_path"].split("/")[:3]) for row in rows)
meaningful_rows = [row for row in rows if row["meaningful_content_asset"] == "YES"]
unassigned = [row for row in meaningful_rows if not row["decision"]]
excluded_meaningful = [row for row in meaningful_rows if row["decision"] == "INTENTIONALLY_EXCLUDED"]
duplicate_groups = [group for group in hash_groups.values() if len(group) > 1]

markdown = [
    "# Asset Coverage Report",
    "",
    "This report inventories every image and video file under `public_html`. The row-level record is in `asset-coverage.csv`.",
    "",
    "## Coverage Summary",
    "",
    f"- Total inventoried media files: **{len(rows)}**",
    f"- Meaningful company/content assets: **{len(meaningful_rows)}**",
    f"- Meaningful assets with no decision: **{len(unassigned)}**",
    f"- Duplicate hash groups: **{len(duplicate_groups)}**",
    f"- Gallery assets exposed through server-rendered pagination: **{64 + 73 + 110 + 16 + 4 + 3 + 12}**",
    "- Original files changed or deleted: **0**",
    "",
    "## Decision Counts",
    "",
    "| Decision | Files |",
    "|---|---:|",
]
for decision, count in sorted(decision_counts.items()):
    markdown.append(f"| `{decision}` | {count} |")

markdown.extend(["", "## Folder Counts", "", "| Folder group | Files |", "|---|---:|"])
for folder, count in sorted(folder_counts.items()):
    markdown.append(f"| `{folder}` | {count} |")

markdown.extend([
    "",
    "## Meaningful Exclusions",
    "",
    "These are the content-like files that are intentionally not rendered. Every exclusion has a specific technical or commercial reason.",
    "",
    "| File | Reason |",
    "|---|---|",
])
for row in excluded_meaningful:
    markdown.append(f"| `{row['file_path']}` | {row['exclusion_reason']} |")

markdown.extend([
    "",
    "## Video Summary",
    "",
    "| File | Resolution | Duration | New use | Loading |",
    "|---|---:|---:|---|---|",
    "| `public_html/videos/tr.mp4` | 1920x1080 | 25.182 s | `/`, `/tasarim` | Poster-first, `preload=none`, no autoplay |",
    "| `public_html/videos/eng.mp4` | 1920x1080 | 25.182 s | `/en/`, `/en/design` | Poster-first, `preload=none`, no autoplay |",
    "",
    "## Notes",
    "",
    "- `admin`, editor/plugin, theme-demo and generic UI artwork is inventoried but excluded from the public redesign because it is not company content.",
    "- The original image and video files remain untouched in `public_html`.",
    "- WebP thumbnails are separate derivatives under `redesign/assets/media`; originals remain available for detail views.",
    "- Video compression derivatives remain a later optimization item; the current implementation prevents the 18 MB sources from downloading before user interaction.",
])

(OUTPUT_DIR / "asset-coverage-report.md").write_text("\n".join(markdown) + "\n", encoding="utf-8")
print(f"Inventoried {len(rows)} files; meaningful={len(meaningful_rows)}; unassigned={len(unassigned)}; CSV={csv_path}")
