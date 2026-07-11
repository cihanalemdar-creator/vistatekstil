# Vista Tekstil Local Redesign Preview

This folder contains the local-only redesign foundation and homepage vertical slice.

Run from the repository root:

```powershell
C:\xampp\php\php.exe -S 127.0.0.1:8082 redesign/router.php
```

Open:

- Turkish homepage: <http://127.0.0.1:8082/>
- English homepage: <http://127.0.0.1:8082/en/>

Notes:

- Existing `public_html` routes and files are not overwritten by this redesign layer.
- Interior routes render source-based local previews and remain `noindex` until content approval.
- German and Spanish are modeled in the route/status system but require human translation review before publication.
- Temporary visuals are declared in `redesign/data/content.php` and should be replaced before launch.
- Local `/robots.txt` blocks indexing; `/sitemap.xml` contains only pages with `approved` or `published` status.
