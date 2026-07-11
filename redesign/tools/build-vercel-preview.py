from __future__ import annotations

import html
import json
import re
import shutil
import urllib.parse
import urllib.request
from collections import deque
from pathlib import Path


ROOT = Path(__file__).resolve().parents[2]
OUTPUT = ROOT / "redesign" / ".vercel-preview"
LOCAL_ORIGIN = "http://127.0.0.1:8082"

INITIAL_ROUTES = [
    "/", "/kurumsal", "/urunler", "/tasarim", "/koleksiyon/referans", "/galeri/galerim2", "/iletisim",
    "/en/", "/en/about", "/en/products", "/en/design", "/en/collection", "/en/gallery", "/en/contact",
    "/de/", "/de/unternehmen", "/de/produkte", "/de/design", "/de/kollektion", "/de/galerie", "/de/kontakt",
    "/es/", "/es/empresa", "/es/productos", "/es/diseno", "/es/coleccion", "/es/galeria", "/es/contacto",
]

PAGE_PREFIXES = ("/galeri/galerim2", "/en/gallery")
ASSET_EXTENSIONS = {
    ".css", ".js", ".woff", ".woff2", ".ttf", ".otf", ".jpg", ".jpeg", ".png", ".gif", ".webp", ".svg", ".ico", ".mp4", ".webm",
}
ATTRIBUTE_PATTERN = re.compile(r'(?P<name>href|src|poster)="(?P<value>[^"]+)"', re.IGNORECASE)
SRCSET_PATTERN = re.compile(r'srcset="(?P<value>[^"]+)"', re.IGNORECASE)


def normalize_page_url(value: str) -> str | None:
    decoded = html.unescape(value)
    parsed = urllib.parse.urlsplit(decoded)
    if parsed.scheme or parsed.netloc or not parsed.path.startswith("/"):
        return None
    if Path(parsed.path).suffix.lower() in ASSET_EXTENSIONS or parsed.path.startswith("/redesign/assets/") or parsed.path.startswith("/public_html/"):
        return None
    if parsed.path in INITIAL_ROUTES or parsed.path.startswith(PAGE_PREFIXES):
        query = urllib.parse.parse_qs(parsed.query)
        normalized_query = urllib.parse.urlencode({key: values[0] for key, values in sorted(query.items()) if values})
        return parsed.path + ("?" + normalized_query if normalized_query else "")
    return None


def public_url(page_url: str) -> str:
    parsed = urllib.parse.urlsplit(page_url)
    if not parsed.query:
        return parsed.path
    query = urllib.parse.parse_qs(parsed.query)
    category = re.sub(r"[^a-z0-9-]", "", query.get("category", ["all"])[0].lower()) or "all"
    page = max(1, int(query.get("page", ["1"])[0] or "1"))
    return f"{parsed.path.rstrip('/')}/view/{category}/page-{page}"


def output_file(page_url: str) -> Path:
    clean = public_url(page_url)
    if clean == "/":
        return OUTPUT / "index.html"
    if clean.endswith("/"):
        return OUTPUT / clean.lstrip("/") / "index.html"
    return OUTPUT / (clean.lstrip("/") + ".html")


def fetch(page_url: str) -> str:
    request = urllib.request.Request(LOCAL_ORIGIN + page_url, headers={"User-Agent": "Vista-Vercel-Preview-Exporter/1.0"})
    with urllib.request.urlopen(request, timeout=30) as response:
        return response.read().decode("utf-8")


def rewrite_html(source: str, discovered_pages: set[str], asset_paths: set[str]) -> str:
    source = re.sub(r'<meta name="robots" content="[^"]*">', '<meta name="robots" content="noindex,nofollow">', source, flags=re.IGNORECASE)

    def replace_attribute(match: re.Match[str]) -> str:
        name = match.group("name")
        raw_value = match.group("value")
        decoded = html.unescape(raw_value)
        parsed = urllib.parse.urlsplit(decoded)

        page = normalize_page_url(decoded)
        if page:
            discovered_pages.add(page)
            return f'{name}="{html.escape(public_url(page), quote=True)}"'

        if parsed.path.startswith("/") and (Path(parsed.path).suffix.lower() in ASSET_EXTENSIONS or parsed.path.startswith("/redesign/assets/")):
            asset_paths.add(urllib.parse.unquote(parsed.path))
        return match.group(0)

    source = ATTRIBUTE_PATTERN.sub(replace_attribute, source)
    for match in SRCSET_PATTERN.finditer(source):
        for candidate in html.unescape(match.group("value")).split(","):
            asset_path = candidate.strip().split(" ", 1)[0]
            parsed = urllib.parse.urlsplit(asset_path)
            if parsed.path.startswith("/"):
                asset_paths.add(urllib.parse.unquote(parsed.path))
    return source


if OUTPUT.exists():
    resolved = OUTPUT.resolve()
    expected_parent = (ROOT / "redesign").resolve()
    if expected_parent not in resolved.parents or resolved.name != ".vercel-preview":
        raise RuntimeError(f"Refusing to replace unexpected output path: {resolved}")
    shutil.rmtree(resolved)

OUTPUT.mkdir(parents=True)
shutil.copytree(ROOT / "redesign" / "assets", OUTPUT / "redesign" / "assets")

queue = deque(INITIAL_ROUTES)
seen: set[str] = set()
asset_paths: set[str] = set()

while queue:
    page_url = queue.popleft()
    if page_url in seen:
        continue
    seen.add(page_url)
    discovered: set[str] = set()
    rendered = rewrite_html(fetch(page_url), discovered, asset_paths)
    target = output_file(page_url)
    target.parent.mkdir(parents=True, exist_ok=True)
    target.write_text(rendered, encoding="utf-8")
    for discovered_page in sorted(discovered):
        if discovered_page not in seen:
            queue.append(discovered_page)

copied_assets = 0
for asset_path in sorted(asset_paths):
    source = ROOT / asset_path.lstrip("/")
    if not source.is_file():
        raise FileNotFoundError(f"Rendered page references a missing asset: {asset_path}")
    target = OUTPUT / asset_path.lstrip("/")
    if target.exists():
        continue
    target.parent.mkdir(parents=True, exist_ok=True)
    shutil.copy2(source, target)
    copied_assets += 1

(OUTPUT / "robots.txt").write_text("User-agent: *\nDisallow: /\n", encoding="utf-8")
(OUTPUT / "vercel.json").write_text(json.dumps({
    "$schema": "https://openapi.vercel.sh/vercel.json",
    "cleanUrls": True,
    "trailingSlash": False,
    "headers": [{
        "source": "/(.*)",
        "headers": [
            {"key": "X-Robots-Tag", "value": "noindex, nofollow, noarchive"},
            {"key": "X-Content-Type-Options", "value": "nosniff"},
            {"key": "Referrer-Policy", "value": "strict-origin-when-cross-origin"},
            {"key": "Permissions-Policy", "value": "camera=(), microphone=(), geolocation=()"},
        ],
    }],
}, indent=2) + "\n", encoding="utf-8")

manifest = {
    "source": LOCAL_ORIGIN,
    "pages": len(seen),
    "copiedReferencedAssets": copied_assets,
    "totalFiles": sum(1 for path in OUTPUT.rglob("*") if path.is_file()),
    "totalBytes": sum(path.stat().st_size for path in OUTPUT.rglob("*") if path.is_file()),
}
(OUTPUT / "preview-manifest.json").write_text(json.dumps(manifest, indent=2) + "\n", encoding="utf-8")
print(json.dumps(manifest, indent=2))
