# Contact Form UI and Backend Contract

## Current local status

- Route: `/iletisim` and `/en/contact`
- Anchor: `#quote-form`
- Real submission: disabled in this phase
- Fake success behavior: none
- UI states present: required, browser-invalid, disabled, loading class, success container and error container
- Form encoding: `multipart/form-data`

## Payload fields

| Field name | Label | Type | Required |
|---|---|---|---:|
| `name` | Ad Soyad / Full name | text | Yes |
| `company` | Şirket / Marka | text | Yes |
| `country` | Ülke | text | Yes |
| `email` | E-posta | email | Yes |
| `phone` | Telefon / WhatsApp | tel | No |
| `category` | Ürün kategorisi | select | Yes |
| `fabricType` | Örme / Dokuma | select | Yes |
| `quantity` | Tahmini sipariş miktarı | number | Yes |
| `styles` | Model sayısı | number | No |
| `delivery` | Hedef teslim dönemi | text | No |
| `techPack` | Tech pack mevcut mu? | select | No |
| `sample` | Referans numune mevcut mu? | select | No |
| `subject` | Konu | text | Yes |
| `message` | Mesaj | textarea | Yes |
| `file` | Dosya yükleme | file | No |
| `privacy` | Gizlilik onayı | checkbox | Yes |

Accepted UI file extensions: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG and ZIP. Server-side MIME detection, file-size limits, filename sanitization and quarantined storage must be implemented in phase two; browser `accept` values are not a security boundary.

## Required backend behavior

1. Validate CSRF and rate-limit before parsing large files.
2. Validate every required field server-side.
3. Normalize email, phone, country, quantities and yes/no values.
4. Detect MIME type from file content and enforce size/type limits.
5. Store uploads outside the public web root or attach them without creating a public URL.
6. Send to the configured recipient only after all validation passes.
7. Return structured multilingual success/error responses.
8. Log a correlation ID without logging uploaded content or mail credentials.
9. Add bot protection and a honeypot without weakening accessibility.

## Environment keys for phase two

Values are intentionally not created in this phase.

```text
MAIL_TRANSPORT
MAIL_HOST
MAIL_PORT
MAIL_USERNAME
MAIL_PASSWORD
MAIL_ENCRYPTION
MAIL_FROM_ADDRESS
MAIL_FROM_NAME
MAIL_TO_ADDRESS
UPLOAD_MAX_BYTES
UPLOAD_ALLOWED_MIME_TYPES
CSRF_SECRET
RATE_LIMIT_WINDOW_SECONDS
RATE_LIMIT_MAX_REQUESTS
TURNSTILE_SITE_KEY
TURNSTILE_SECRET_KEY
```

`TURNSTILE_*` is optional if another accessible spam-control mechanism is selected. Secrets must stay outside the repository and outside `public_html`.
