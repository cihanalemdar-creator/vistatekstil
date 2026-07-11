# Vista Moda Tekstil: Eski ve Yeni Sürüm Karşılaştırma Raporu

> Bu belge içerik, navigasyon ve asset revizyonundan önceki aday sürümün tarihsel denetimidir. Güncel revizyon sonrası sonuç `phase-two-implementation-report.md` dosyasındadır ve aşağıdaki eski hükmün yerine geçer.

Tarih: 10 Temmuz 2026  
Referans sürüm: `http://127.0.0.1:8081` (`public_html`)  
Aday sürüm: `http://127.0.0.1:8082` (`redesign`)  
Canlı site: Değiştirilmedi

## Karşılaştırma Yöntemi

- Eski ve yeni sürüm ayrı PHP süreçlerinde aynı anda açık tutuldu.
- Yedi temel route, kaynak kodu ve tarayıcı çıktısı üzerinden eşleştirildi.
- 375, 768, 1024 ve 1440 px viewportlarda aynı yöntemle ekran görüntüsü alındı.
- Soğuk tarayıcı contextleriyle istek sayısı, aktarım boyutu, CSS/JS/görsel/video yükü ve navigation süresi gözlendi.
- 1440 px üzerinde aynı local ortamda CLS ve LCP Performance Observer ile ölçüldü.
- Başlıklar, metin kapsamı, form ve linkler, canonical, hreflang, robots, schema ve alt metinler DOM üzerinden kontrol edildi.
- Türkçe/İngilizce dil geçişi, mobil menü, dahili linkler ve form endpointi işlevsel olarak test edildi.
- Eski local veritabanında `baseurl` ve ana sayfa SEO alanları boş olduğundan nested route görselleri localde bozuldu. Bu alanlarda yalnızca ekran çıktısına değil kaynak dosyalara ve asset envanterine de bakıldı.
- Süreler local/headless gözlemidir; saha verisi veya gerçek mobil ağ sonucu değildir.

## A. Overall Verdict

Yeni sürüm görsel kalite, üretici konumlandırması, mobil kullanım, erişilebilirlik temeli, metadata ve performansta açık biçimde daha iyi. Buna rağmen aday sürüm eski sitenin anlamlı kurumsal ve üretim içeriğinin önemli bir bölümünü taşımıyor; çalışan bir teklif formu yok; Koleksiyon navigasyondan düşmüş; eski kategori ve `.php` URL'leri için redirect bulunmuyor; DE/ES URL'leri İngilizce içeriği yanlış biçimde yayınlıyor; geçici hero görseli final koşulunu karşılamıyor.

**Genel sonuç:** Teknik ve görsel temel daha iyi, fakat içerik ve migration bütünlüğü kanıtlanmış değil.  
**Ağırlıklı puan:** Eski `51/100`, Yeni `72/100`.  
**Karar:** `DO_NOT_REPLACE_OLD_VERSION_YET`

## B. Old Version Strengths

- `/kurumsal` kurucu, Ar-Ge, hızlı numune, kapasite, MOQ, pazarlar, uygunluk, sürdürülebilirlik yaklaşımı, teslimat disiplini ve misyonu tek yerde ayrıntılı anlatıyor.
- `/tasarim` tasarım ve modelhane için daha fazla özgün metin ve dört büyük üretim görseli sunuyor.
- Koleksiyon masaüstü ve mobil ana navigasyonda doğrudan yer alıyor.
- `/urunler` üç ürün kategorisini görsel kartlarla sunmayı amaçlıyor.
- `/iletisim` iki telefon, iki adres, e-posta, form yüzeyi, harita embed'i ve sosyal bağlantı alanını birlikte gösteriyor.
- Footer çalışma saatlerini ve sertifika/standart logolarını görünür kılıyor.
- Eski kurumsal içerik, B2B alıcının yetkinlik ve iş ortaklığı sorularına yeni iç sayfadan daha fazla cevap veriyor.

## C. Old Version Weaknesses

- Ana sayfada H1 yok; local SEO kaydında title ve meta description boş çıktı.
- Canonical, hreflang, sitemap ve structured data yok.
- Dil seçimi aynı URL ve session üzerinden çalışıyor; `html lang` İngilizce seçiminde de `tr` kalıyor. Localde `dil.php` kısa PHP etiketi nedeniyle İngilizceye geçiş çalışmadı.
- Ana sayfa 46 istek ve yaklaşık 21.73 MB aktarım yaptı; bunun 18.11 MB'ı video.
- Yaklaşık 1.50 MB CSS, 360 KB JS, 5 CSS dosyası ve 11 JS dosyası kullanıyor.
- Ölçülen CLS `0.4988`; slider/video ve geç yüklenen bileşenler ciddi yerleşim kayması üretiyor.
- Nested koleksiyon/galeri sayfalarında göreli link ve asset yolları localde kırılıyor; taramada dört dahili 404 bulundu.
- İletişim formu `mail.php` dosyasına POST ediyor ancak bu dosya yok; endpoint `404`.
- Formda iki alan aynı `id="number"` ve `name="number"` değerini kullanıyor; konu alanı telefon tipi ve ayrı bir subject alanı oluşmuyor.
- Formda required durumları, açık hata/success sözleşmesi, CSRF ve spam koruması yok.
- Tasarım sayfasında Kesimhane ve Dikimhane metinleri final içerik yerine “İçerik Yükleniyor...” gösteriyor.
- Birçok görselde alt metin yok veya `img`, `image`, `Icon` gibi anlamsız değerler var.
- Skip link, `main` landmark, açıklanmış dil kontrolü ve görünür focus sistemi yok.
- Sosyal bağlantılar gerçek kurumsal profile değil Facebook/Twitter/LinkedIn ana sayfalarına gidiyor.

## D. New Version Improvements

| Improvement | Affected route | Old limitation | New solution | Evidence | User / SEO benefit |
|---|---|---|---|---|---|
| Açık üretici konumlandırması | `/` | Hero yalnızca ürün gruplarını söylüyor | H1 doğrudan kadın, erkek ve çocuk hazır giyim üretimini tanımlıyor | İlk viewport ve tek H1 | Kullanıcı ne üretildiğini beklemeden anlıyor |
| Kapasite ve MOQ görünürlüğü | `/` | Kurumsal uzun metninde gömülü | 2019, 5.000, 35.000 ve 100 adet ilk ekran sonrasında | Fact strip | B2B ön eleme ve dönüşüm kolaylaşıyor |
| Süreç organizasyonu | `/`, `/tasarim` | Bilgi farklı kartlara ve placeholder alanlara dağılmış | Tasarım, kalıp/numune, kesim/dikim, kontrol/paketleme sıralı | H2/H3 yapısı | Tarama ve konu bütünlüğü güçleniyor |
| Mobil düzen | Tüm route'lar | 375/768'de ağır slider ve büyük kartlar | Sabit header, kontrollü hero, sade `details` menü | 375 ve 320 px'de overflow `0` | Daha hızlı ve öngörülebilir mobil kullanım |
| Görsel hiyerarşi | `/` | Parlak mavi, şablon hissi ve parçalı hero | Gerçek üretim görseli, tek font sistemi, tutarlı renk paleti | Dört viewport karşılaştırması | Kurumsal güven yükseliyor |
| Metadata | Tüm route'lar | Boş/tekrarlı description, eksik ana sayfa title | Route bazlı title ve description | DOM ölçümü | Arama sonucu anlamı iyileşiyor |
| Canonical / hreflang temeli | Tüm route'lar / home | Yok | Canonical her route'ta, home TR/EN/x-default | DOM ölçümü | Çok dilli indeksleme için doğru temel |
| Sitemap temeli | `/sitemap.xml` | Yok | Yalnızca published/approved sayfalar listeleniyor | 200, 630 bayt | Yayın statüsüne bağlı kontrollü indeksleme |
| Structured data | Tüm route'lar | Yok | Organization JSON-LD | Her sayfada bir schema scripti | Kurumsal varlık sinyali |
| Dahili link bütünlüğü | Tüm route'lar | Nested route'larda dört kırık link | Taranan 21 dahili URL'de kırık link yok | Otomatik crawl | UX ve crawl güvenilirliği |
| Erişilebilirlik temeli | Tüm route'lar | Landmark/focus/skip eksik | Skip link, `main`, aria-label, focus-visible, reduced-motion | Kaynak ve DOM | Klavye ve yardımcı teknoloji kullanımı iyileşiyor |
| Performans | `/` | 21.73 MB, 46 istek, video ve JS bağımlılıkları | 1.89 MB, 10 istek, JS yok, local font | Aynı local test | Daha düşük veri kullanımı ve daha hızlı ilk görüntü |
| Layout stability | `/` | CLS 0.4988 | CLS 0 | Aynı observer testi | İçerik sıçraması ortadan kalkıyor |
| Dil URL'leri | TR/EN route'lar | Aynı URL/session, yanlış html lang | Eşdeğer `/en/...` route ve doğru `lang="en"` | `/kurumsal` -> `/en/about` testi | Kullanıcı ve arama motoru dil ayrımı netleşiyor |

## E. New Version Regressions

| Issue | Affected route | Old behavior | New behavior | Why new is worse | Severity | Recommended correction |
|---|---|---|---|---|---|---|
| Kurumsal içerik %79 azaldı | `/kurumsal` | 465 kelime; Ar-Ge, numune, kapasite, uygunluk, sürdürülebilirlik, teslimat ve misyon | 97 kelime ve üç kısa satır | B2B alıcı için kanıt ve ayrıntı kaybı | `HIGH` | Eski doğrulanmış içeriği okunabilir alt bölümlere taşı |
| Tasarım/üretim içeriği ve görselleri zayıfladı | `/tasarim` | 198 kelime, dört büyük görsel, tasarım ve modelhane ayrıntısı | 87 kelime, görsel yok, üç satır | Teknik yetkinlik daha az kanıtlanıyor | `HIGH` | Doğrulanmış tasarım/modelhane metnini ve üretim görsellerini geri ekle |
| Koleksiyon navigasyondan kayboldu | `/koleksiyon/referans` | Desktop/mobile nav ve footer'da bir tık | Hiçbir ana navigasyon veya footer linki yok | Route fiilen orphan oldu | `HIGH` | Koleksiyonu nav/footer'a ekle veya bilinçli redirect kararı ver |
| Koleksiyon ile galeri aynı altı görseli kullanıyor | Koleksiyon, Galeri | Ayrı `referanslar` ve `galeri` asset setleri | İki route aynı görsel dizisini render ediyor | Sayfalar anlamsal olarak ayrışmıyor, duplicate/thin risk oluşuyor | `HIGH` | 4 referans görselini koleksiyona, seçilmiş üretim görsellerini galeriye ayır |
| Galeri kapsamı daraldı | `/galeri/galerim2` | Kaynakta 64 galeri asseti | Yalnızca 6 görsel | Üretim ve ürün kanıtının çoğu görünmez | `HIGH` | Kürasyon, kategori ve optimize edilmiş pagination/lazy grid ekle |
| Ürün sayfası görsellerini kaybetti | `/urunler` | Üç kategori görsel kartı | Yalnızca metin satırları; görseller homepage'e taşındı | Ürün route'u amacına göre daha zayıf | `MEDIUM` | Ana sayfadaki ürün kartlarını veya daha zengin karşılıklarını route'a taşı |
| Teklif formu yok | `/iletisim` | Görünür form vardı fakat endpointi bozuktu | Form hiç yok; yalnız mail/telefon | Web üzerinden yapılandırılmış talep gönderilemiyor | `HIGH` | Gerçek backendli, doğrulamalı, spam korumalı form kur |
| Contact CTA kendi sayfasına dönüyor | `/iletisim` | Form alanına yönelim vardı | CTA tekrar `/iletisim` açıyor | Kullanıcıya yeni aksiyon sunmuyor | `MEDIUM` | CTA'yı forma anchor'a, mailto'ya veya brief akışına bağla |
| Harita kaldırıldı | `/iletisim` | Google Maps embed tanımlıydı | Harita veya harita linki yok | Ziyaret/tesis doğrulama sinyali azaldı | `LOW` | Performans dostu statik harita linki veya on-demand embed ekle |
| Sosyal alan kaldırıldı | Contact/footer | Placeholder sosyal ikonlar vardı | Sosyal link yok | Doğrulanmış hesap varsa güven sinyali kaybı | `LOW` | Yalnız gerçek hesaplar doğrulanırsa geri ekle |
| Eski URL'lere redirect yok | `/kategori/*`, `/*.php`, `/koleksiyon`, `/galeri` | Eski PHP/router URL'leri 200 | Yeni router 404 | Backlink ve indeks değeri kaybedilebilir | `HIGH` | Trafik/log verisine dayalı 301 redirect map yaz |
| DE/ES homepage yanlış yayınlanıyor | `/de/`, `/es/` | Eski sürümde bu URL'ler yok | İngilizce içerik `index,follow`, canonical `/en/` | Indexlenebilir duplicate ve yanlış dil deneyimi | `HIGH` | Çeviri yoksa 404/410 veya kesin noindex; yayınlanacaksa gerçek içerik ve hreflang |
| İç sayfalar launch-ready değil | TR/EN interior | Eski sayfalar INDEX,FOLLOW | Yeni iç sayfalar `noindex,nofollow` ve sitemap dışında | Staging için doğru, canlı replacement için eksik | `HIGH` | İçerik onayından sonra statü, hreflang ve sitemap'i birlikte aç |
| Staging robots tüm siteyi engelliyor | `/robots.txt` | Eski robots dosyası yok | `Disallow: /` | Staging için doğru; canlıya aynen giderse kritik indeksleme kaybı | `CRITICAL` | Environment tabanlı robots çıktısı kur ve canlı checklist'e bağla |
| Hero asset final değil | `/` | Eski video ağır ama geniş format | 900x900 geçici görsel, data dosyasında replacementRequired | Final görsel kalite ve LCP optimizasyon hedefi karşılanmıyor | `HIGH` | Doğrulanmış güncel tesisten en az 2000x1125 optimize görsel üret |
| Galeri/collection yükü yüksek | İki route | Local eski nested assetler kırık olduğundan adil ölçüm yok | Her biri yaklaşık 3.27 MB | Altı görsel için gereksiz yüksek yük | `MEDIUM` | AVIF/WebP varyantları, responsive `srcset` ve thumbnail kullan |

## F. Content Preservation Matrix

| Information | Classification | Old source | New location / state | Finding |
|---|---|---|---|---|
| Şirket tanımı | `PRESERVED_AND_STRENGTHENED` | Home, Kurumsal | Home hero, `/kurumsal` | Üretici kimliği daha doğrudan |
| Kuruluş bilgisi | `PRESERVED` | 2019, Dilek Akkoyunlu | Home, `/kurumsal` | Aynı temel bilgi |
| Tarihçe | `PRESERVED` | Yalnız kuruluş/founder düzeyi | `/kurumsal` intro | Eski sürümde de gerçek timeline yok |
| Ürün kategorileri | `PRESERVED_AND_STRENGTHENED` | Home ve `/urunler` | Home ve `/urunler` | Yapı daha net; ürün route görselleri eksik |
| Kadın ürünleri | `PRESERVED` | Bluz, elbise, ceket, etek, şort, pantolon | Home ve `/urunler` | Liste korunuyor |
| Erkek ürünleri | `PARTIALLY_PRESERVED` | Genel ürün listesi ve örme/dokuma | Home ve `/urunler` | Erkek route metni ürün örneklerini tekrar etmiyor |
| Çocuk ürünleri | `PRESERVED` | Çocuk giyim | Home ve `/urunler` | Örme/dokuma bağlamı eklenmiş |
| Örme ürünler | `PRESERVED_AND_STRENGTHENED` | Yuvarlak örme kesim/dikim | Hero, products, production | İlk ekranda görünür |
| Dokuma ürünler | `PRESERVED_AND_STRENGTHENED` | Kurumsal/home | Hero, products | İlk ekranda görünür |
| Tasarım ve geliştirme | `PARTIALLY_PRESERVED` | Fuarlar, trend raporları, tedarikçiler, kumaş geliştirme | Home, `/tasarim` | Fuar/trend/kumaş geliştirme ayrıntıları kayıp |
| Modelhane | `PARTIALLY_PRESERVED` | Numune zamanlaması, müşteri ilişkileri, alternatifler | Home, `/tasarim` | Temel süreç var, ticari önem ve ayrıntı zayıf |
| Kalıp | `PRESERVED` | Tüm kalıplar içeride hazırlanır | Home, `/tasarim`, `/kurumsal` | Korundu; “tüm” kapsamı daha temkinli yazılmış |
| Numune | `PRESERVED` | Hızlı numune ve doğru gönderim | Home, `/tasarim` | Hız iddiası çıkarılmış, süreç korunmuş |
| Kesim | `PRESERVED_AND_STRENGTHENED` | Home kartı; tasarım sayfasında placeholder | Home process, `/tasarim` | Placeholder yerine anlamlı süreç metni |
| Dikim | `PRESERVED_AND_STRENGTHENED` | Home kartı; tasarım sayfasında placeholder | Home process, `/tasarim` | Placeholder yerine anlamlı süreç metni |
| Kalite kontrol | `PRESERVED_AND_STRENGTHENED` | Kurumsal ve home | Home quality/process, `/tasarim` | Daha görünür ve kontrollü ifade |
| Paketleme | `PRESERVED` | Kurumsal | Home process, `/tasarim`, `/kurumsal` | Korundu |
| Kapasite | `PRESERVED_AND_STRENGTHENED` | Kurumsal uzun metin | Home fact strip, `/kurumsal` | Çok daha kolay bulunuyor |
| MOQ | `PARTIALLY_PRESERVED` | 100; supplier limiti; küçük/orta marka esnekliği | Home fact strip, `/kurumsal` | 100 ve supplier notu var; küçük/orta marka ve “her miktar” söylemi yok |
| Pazarlar | `PRESERVED_AND_STRENGTHENED` | Kurumsal | Home markets, `/kurumsal` | Ayrı görünür bölüm |
| Uygunluk / sertifika ifadeleri | `REQUIRES_REVIEW` | SEDEX/BSCI partner; BCI/GRS/ORC/Oeko-Tex sourcing | Home quality | Yeni dil daha doğru biçimde partner/mill bağlamı kuruyor; OCS/ORC belgesi doğrulanmalı |
| Sürdürülebilirlik ifadeleri | `PARTIALLY_PRESERVED` | Belge sunma, eco talep, etik üretim, misyon | Home quality | Sertifika bağlamı var; yaklaşım ve misyonun çoğu kayıp |
| Merkez adres | `PRESERVED` | Contact/footer | `/iletisim`, footer | Korundu |
| Üretim tesisi adresi | `PRESERVED` | Contact | `/iletisim` | Korundu |
| Telefonlar | `PRESERVED` | İki telefon contact'ta | `/iletisim` | İkisi de korunuyor; footer yalnız ana telefon |
| E-posta | `PRESERVED` | `info@vistatekstil.com` | Contact/footer | Korundu |
| Sosyal medya | `REQUIRES_REVIEW` | Genel platform ana sayfaları | Yok | Gerçek hesap değildi; doğrulanmadan geri eklenmemeli |
| İletişim formu | `MISSING_IN_NEW_VERSION` | Görünür fakat `mail.php` 404 | Yok | Eski fonksiyon çalışmıyor; yeni gerçek çözüm kurmalı |
| Harita | `MISSING_IN_NEW_VERSION` | Google Maps embed | Yok | Adres var, görsel konum yok |
| Galeri içerikleri | `PARTIALLY_PRESERVED` | 64 gallery asseti | 6 asset | Kapsam ciddi biçimde azaldı |
| Koleksiyon içerikleri | `WEAKENED_IN_NEW_VERSION` | 4 ayrı referans asseti | Galeriyle aynı 6 asset | Ayrı koleksiyon kimliği kayıp |
| CTA'lar | `PRESERVED_AND_STRENGTHENED` | Detaylar, telefon, iletişim | Hero ve bölüm CTA'ları | Daha net; contact self-loop düzeltilmeli |
| Çalışma saatleri | `PRESERVED` | Footer | Footer | Korundu |
| Misyon / uzun vadeli iş ortaklığı | `MISSING_IN_NEW_VERSION` | Kurumsal son bölümler | Yok | Doğrulanıp daha kısa bir içerikle geri taşınmalı |
| Şeffaf iletişim / teslimat disiplini | `MISSING_IN_NEW_VERSION` | Kurumsal | Yok | B2B güven sinyali kaybı |
| Ürün görselleri | `MOVED_TO_ANOTHER_PAGE` | `/urunler` görsel kartları | Home “Ürün grupları” | `/urunler` route'u görselsiz kaldı |

## G. Unsupported New Content

- Doğrudan tespit edilen `NEW_UNSUPPORTED_CLAIM` yok. Yeni metinler ağırlıkla eski içerikten daraltılarak üretildi.
- `OCS` ifadesi `REQUIRES_REVIEW`: eski Türkçe/İngilizce metin “ORC (Organic Content Standard)” yazıyor; bu büyük olasılıkla OCS yazım hatasıdır ancak belge görülmeden kesinleştirilmemeli.
- SEDEX/BSCI/BCI/GRS/OCS/Oeko-Tex ifadeleri Vista'nın kendi sertifikası gibi sunulmamalı. Yeni metin partner/tedarikçi bağlamı kurduğu için eskiden daha güvenli, yine de belge ve kullanım hakkı doğrulanmalı.
- Hero görselinin güncel Vista üretim alanı olduğu ve ürün fotoğraflarının yayın hakkı doğrulanmalı.

## H. Route-by-Route Comparison

### `/` -> `/`

| Field | Assessment |
|---|---|
| Old purpose | Video/slider, hizmet kartları, kısa kurumsal tanıtım ve generic CTA |
| New purpose | Üretici konumlandırması, ürünler, süreç, kapasite, pazar, kalite ve dönüşüm |
| Coverage | Old 184 kelime; New 432 kelime |
| Preserved | Şirket tanımı, 2019, ürün grupları, örme/dokuma, telefon/iletişim |
| Strengthened | H1, kapasite, MOQ, üretim akışı, pazarlar, uygunluk, iç linkler |
| Relocated | Eski kart bilgileri yeni process/capabilities bölümlerine dağıtıldı |
| Missing | “Kreatif Çözümler” ve “Çözüm Merkezi” generic sloganları; kayıp anlamlı değil |
| Newly added | Sayısal proof strip ve adımlı çalışma akışı; eski içeriğe dayalı |
| Unsupported | Doğrudan tespit yok |
| Visual | `NEW_BETTER` tüm viewportlarda |
| UX | `NEW_BETTER`; temel bilgi ilk ekranda |
| SEO | `NEW_BETTER`; title, description, H1, canonical, hreflang, schema |
| Final | Ana sayfa açık biçimde daha iyi |

### `/kurumsal` -> `/kurumsal`

| Field | Assessment |
|---|---|
| Old purpose | Ayrıntılı şirket, üretim, kapasite, müşteri, uygunluk, sürdürülebilirlik ve misyon profili |
| New purpose | Kısa şirket özeti ve üç temel iş bilgisi |
| Coverage | Old 465 kelime; New 97 kelime |
| Preserved | Kuruluş, founder, ürün grupları, kapasite, MOQ, pazarlar |
| Strengthened | Başlık ve okunabilir satır yapısı |
| Relocated | Uygunluk home quality'e; ürün/süreç bilgileri home ve `/tasarim`e |
| Missing | Ar-Ge, hızlı numune, tüm kalıplar, small/medium flexibility, şeffaf iletişim, deadline, belge sunma, eco talepler, misyon |
| Newly added | Anlamlı yeni iddia yok; mevcut bilgi sadeleştirildi |
| Unsupported | Yok |
| Visual | Layout `NEW_BETTER`, bilgi yoğunluğu `OLD_BETTER` |
| UX | `OLD_BETTER` for detailed due diligence; New scans faster but answers less |
| SEO | Metadata new better; thin-content risk new worse |
| Final | `HIGH` içerik regresyonu; onaylanamaz |

### `/urunler` -> `/urunler`

| Field | Assessment |
|---|---|
| Old purpose | Üç ürün kategorisini görsel kartlarla listeleme |
| New purpose | Üç kategori ve örme/dokuma kapsamını metinsel özetleme |
| Coverage | Old 68 kelime; New 65 kelime |
| Preserved | Kadın, erkek, çocuk kategorileri |
| Strengthened | Örme/dokuma ve kadın ürün listesi açıklığı |
| Relocated | Üç ürün görseli homepage ürün bölümüne taşındı |
| Missing | Route üzerinde kategori görselleri ve ürün ayrıntı yolu |
| Newly added | Açıklayıcı intro ve kategori metinleri |
| Unsupported | Yok |
| Visual | `OLD_BETTER` route özelinde; homepage kartları new better |
| UX | `MIXED`; bilgi daha açık ama ürün inceleme daha zayıf |
| SEO | New metadata/H1 better; body hâlâ thin |
| Final | Görsel ve içerik derinliği eklenmeli |

### `/tasarim` -> `/tasarim`

| Field | Assessment |
|---|---|
| Old purpose | Tasarım, kesim, dikim ve modelhane için görsel/makale akışı |
| New purpose | Tasarımdan kontrole üç aşamalı üretim özeti |
| Coverage | Old 198 kelime; New 87 kelime |
| Preserved | Tedarikçi seçenekleri, model/kalıp/numune, alternatif çözümler, kesim/dikim/kontrol |
| Strengthened | Kesimhane ve Dikimhane placeholderları anlamlı metne dönüştü |
| Relocated | Bazı süreç bilgileri homepage capabilities/process'e taşındı |
| Missing | Fuarlar, trend raporları, kumaş kalitesi geliştirme, sampling timing önemi ve üretim görselleri |
| Newly added | Kalite kontrol/paketleme ile uçtan uca sıra |
| Unsupported | Yok |
| Visual | `OLD_BETTER` for production proof; typography/layout new better |
| UX | `MIXED`; new daha taranabilir, old daha kanıtlayıcı |
| SEO | Metadata new better; kapsam/medya old better |
| Final | `HIGH` içerik/kanıt regresyonu |

### `/koleksiyon/referans` -> `/koleksiyon/referans`

| Field | Assessment |
|---|---|
| Old purpose | Ayrı referans/koleksiyon seçkisi |
| New purpose | Genel ürün seçkisi |
| Coverage | Old source: 4 referans asseti; New: 6 generic gallery asseti |
| Preserved | Route ve temel koleksiyon fikri |
| Strengthened | Yeni local render teknik olarak çalışıyor |
| Relocated | Yok |
| Missing | Ayrı referans assetleri, navigasyon erişimi, kategori bağlamı |
| Newly added | Galeriyle aynı altı görsel |
| Unsupported | Yok |
| Visual | Local eski asset yolları kırık; çalışan UI açısından `NEW_BETTER` |
| UX | `OLD_BETTER` navigation, `NEW_BETTER` rendering |
| SEO | Same URL preserved; new orphan/thin/duplicate risk |
| Final | `HIGH` regresyon; ayrı içerik ve link gerekli |

### `/galeri/galerim2` -> `/galeri/galerim2`

| Field | Assessment |
|---|---|
| Old purpose | Üretim ve ürün galerisi |
| New purpose | Üretim/modelhane/ürün görsellerinden kısa seçki |
| Coverage | Old asset set 64; New 6 |
| Preserved | Route ve altı mevcut kaynak görsel |
| Strengthened | Grid, alt metinler ve local route sağlam |
| Relocated | Yok |
| Missing | Asset setinin büyük bölümü ve kategori açıklamaları |
| Newly added | Açıklayıcı H1/meta |
| Unsupported | Yok |
| Visual | Local reference kırık; çalışan aday `NEW_BETTER` |
| UX | New daha temiz fakat kapsam yetersiz |
| SEO | Metadata/canonical new better; thin/duplicate content riski |
| Final | Teknik iyileşme, içerik kapsamı regresyonu |

### `/iletisim` -> `/iletisim`

| Field | Assessment |
|---|---|
| Old purpose | İki telefon, e-posta, iki adres, form, map, social |
| New purpose | Doğrudan iletişim kanalları ve iki adres |
| Coverage | Old 113 kelime, 1 form/5 field; New 69 kelime, form yok |
| Preserved | İki telefon, email, merkez/fabrika adresi |
| Strengthened | Bilgi okunabilirliği, tel/mail linkleri, temiz layout |
| Relocated | Çalışma saatleri footer'da |
| Missing | Form, map, social area |
| Newly added | Proje/adet/teslim dönemi odaklı intro |
| Unsupported | Yok |
| Visual | `MIXED`; new daha temiz, old daha tamamlanmış görünür |
| UX | Direct contact new better; quote submission neither works |
| SEO | Metadata/canonical new better; conversion content new worse |
| Final | Working form kurulmadan onaylanamaz |

### Unmatched Old URLs

| Old URL | New status | Required action |
|---|---:|---|
| `/kategori/erkek-giyim` | 404 | `/urunler#erkek-giyim` veya kalıcı kategori route'una 301 |
| `/kategori/kadin-giyim` | 404 | `/urunler#kadin-giyim` veya kalıcı kategori route'una 301 |
| `/kategori/cocuk-giyim` | 404 | `/urunler#cocuk-giyim` veya kalıcı kategori route'una 301 |
| `/kurumsal.php`, `/tasarim.php`, `/urunler.php`, `/iletisim.php` | 404 | İndeks/backlink varsa temiz route'a 301 |
| `/koleksiyon.php`, `/galeri.php` | 404 | Slugged karşılıklarına 301 |
| `/koleksiyon`, `/galeri` | Yeni route yok | Slugged karşılıklarına 301 |
| Eski tekil ürün URL'leri | Local DB'de ürün sayısı 0 | Canlı DB/log auditinden sonra tekil redirect map |

### New URLs Without Distinct Old Counterparts

| New route family | Assessment |
|---|---|
| `/en/`, `/en/about`, `/en/products`, `/en/production`, `/en/collection`, `/en/gallery`, `/en/contact` | Eski session içeriğinin doğru ayrı URL modeline dönüşümü; interior şu an noindex |
| `/de/*`, `/es/*` | Gerçek içerik yok; homepage İngilizce duplicate olarak indexable. Yayınlanmamalı |

## I. UX Task Comparison

| Task | Old steps / clarity / friction | New steps / clarity / friction | Winner | Reason |
|---|---|---|---|---|
| 1. Ne üretildiğini anlamak | Hero yalnız kategori söyler; üretici açıklaması için aşağı kaydırma gerekir | Hero H1 ve lede doğrudan açıklar | `NEW` | İlk viewportta üretici ve ürün kapsamı net |
| 2. Kadın/erkek/çocuk ürünlerini bulmak | Home scroll veya Ürünler nav: 1 aksiyon; kategori kartları görsel | Home scroll veya Ürünler nav: 1 aksiyon; homepage görsel, route metinsel | `MIXED` | New homepage daha iyi, old product route daha görsel |
| 3. Örme/dokuma bilgisini bulmak | Home kurumsal metnine kadar scroll veya Kurumsal sayfasında uzun tarama | Hero lede içinde, 0 ek adım | `NEW` | Bilgi ilk ekranda |
| 4. Üretim sürecini anlamak | Tasarım nav: 1 tık; uzun sayfa, iki placeholder | Homepage'de sıralı süreç; detay route 1 tık | `NEW` | Daha az sürtünme ve daha doğru sıra |
| 5. Kapasite/MOQ bulmak | Kurumsal: 1 tık + uzun metin tarama | Homepage fact strip: 0 tık | `NEW` | Ticari eşik hemen görünür |
| 6. Kalite/uygunluk bulmak | Kurumsal: 1 tık + sayfanın altına ilerleme | Homepage quality bölümüne scroll | `NEW` | Daha görünür ve daha temkinli sertifika dili |
| 7. İletişim bilgilerine ulaşmak | Nav 1 tık; tüm iletişim blokları | Header CTA/nav 1 tık; tel/mail linkleri | `NEW` | Daha temiz, tıklanabilir doğrudan kanallar |
| 8. Teklif talebi göndermek | 1 tık, form doldurma; submit `mail.php` 404 | Web form yok; e-posta istemcisi/telefon gerekli | `NONE` | İki sürüm de web üzerinden başarılı talep gönderemiyor |
| 9. Dili değiştirmek | Flag click; aynı URL/session; local testte çalışmadı, html lang yanlış | Eşdeğer `/en/...`; URL ve html lang doğru | `NEW` | Test edilmiş doğru eşdeğer route |
| 10. Mobil menüyü kullanmak | 1 tap; icon-only kontrol ve ağır layout | 1 tap; açıklanmış summary, overflow 0 | `NEW` | Daha erişilebilir ve stabil |

## Visual and Design Comparison

| Area | Result | Evidence |
|---|---|---|
| Header | `NEW_BETTER` | Daha sade logo ölçeği, daha az görsel gürültü, dört viewportta stabil |
| Desktop navigation | `MIXED` | New daha temiz; old Koleksiyon bağlantısını koruyor, new düşürüyor |
| Mobile navigation | `NEW_BETTER` | 375/768'de daha dengeli; erişilebilir text label ve overflow yok |
| Hero | `NEW_BETTER` | Üretim tesisi, açık H1, CTA ve proof signal; old generic slider/video |
| Typography | `NEW_BETTER` | Local Manrope, daha net hiyerarşi ve daha iyi Türkçe okunabilirlik |
| Section spacing | `MIXED` | Home new dengeli; interior new yer yer aşırı boş ve yetersiz içerikli |
| Content density | `MIXED` | Home new daha zengin; Kurumsal/Tasarım old daha kapsamlı |
| Image quality | `MIXED` | New seçki daha tutarlı; hero 900x900 temporary, old üretim route'unda daha çok görsel |
| Image crop | `NEW_BETTER` | Stabil aspect-ratio ve object-fit; old slider/kart kırılımları daha düzensiz |
| Product presentation | `MIXED` | New homepage daha iyi; `/urunler` old görsel kartlar açısından daha iyi |
| Production presentation | `OLD_BETTER` | `/tasarim` eski sürüm dört süreç görseli gösteriyor; new route görselsiz |
| CTA visibility | `NEW_BETTER` | Hero, section ve header CTA'ları belirgin; contact self-loop istisna |
| Forms | `OLD_BETTER` (visual only) | Old form yüzeyi var; endpoint 404 olduğu için reliability açısından iki sürüm de başarısız |
| Gallery | `MIXED` | New grid çalışıyor ve alt metinli; old kaynak kapsamı çok daha geniş |
| Footer | `MIXED` | New daha temiz; old social/standart görselleri ve daha fazla link taşıyor |
| Language switcher | `NEW_BETTER` | Metin tabanlı, eşdeğer URL, doğru html lang |
| Contact page | `MIXED` | New bilgi sunumu daha iyi; old form/map kapsamı daha geniş |

Viewport özeti:

| Viewport | Header/nav | Hero | Layout | Winner |
|---:|---|---|---|---|
| 375 px | Old büyük mavi menu bloğu; new dengeli logo/menu | New daha açık ve dönüşüm odaklı | New overflow 0 | `NEW` |
| 768 px | Old tablet header şablon hissi; new sade | New gerçek üretim ve güçlü H1 | New fact strip daha iyi devam sinyali | `NEW` |
| 1024 px | Old nav sıkışık; new contact gizleyerek uyum sağlıyor | New bilgi yoğunluğu daha iyi | New stabil | `NEW` |
| 1440 px | Old nav çalışıyor fakat yoğun | New daha profesyonel | Home new; interior content density mixed | `NEW` for home |

## J. SEO Comparison

| SEO area | Old | New | Assessment |
|---|---|---|---|
| URL preservation | Temel TR URL'ler mevcut | Yedi temel TR URL korunuyor | `NEW_BETTER`, ancak legacy redirects eksik |
| Title quality | Homepage local title boş; diğerleri generic | Route bazlı, açıklayıcı | `NEW_BETTER` |
| Meta description | Localde boş/tekrarlı | Route bazlı unique | `NEW_BETTER` |
| H1 usage | Homepage H1 yok; iç sayfalarda bir H1 | Tüm test route'larında bir H1 | `NEW_BETTER` |
| Heading structure | Kart başlıkları var, konu sırası zayıf | H1/H2/H3 konu yapısı belirgin | `NEW_BETTER` |
| Canonical | Yok | Her route'ta var | `NEW_BETTER` |
| Hreflang | Yok | Published home TR/EN/x-default | `NEW_BETTER`, interior yayınında tamamlanmalı |
| Sitemap | 404/yok | Published home URL'leri içeriyor | `NEW_BETTER` |
| Robots.txt | 404/yok; pages INDEX,FOLLOW | Staging `Disallow: /`; status bazlı meta robots | Staging için new better, canlıya aynen çıkamaz |
| Internal linking | Nested route'larda dört 404 | Crawl edilen 21 dahili URL sağlam | `NEW_BETTER`, Koleksiyon orphan istisna |
| Crawlable navigation | Koleksiyon dahil, dil JS tabanlı | Server-rendered linkler, Koleksiyon hariç | `MIXED` |
| Alt text | Route başına yaklaşık 6 eksik/generic | İçerik görselleri açıklayıcı; hero empty alt dekoratif ve doğru | `NEW_BETTER` |
| Structured data | Yok | Organization JSON-LD | `NEW_BETTER` |
| Duplicate content | Diller aynı URL/session, ayrı indexlenemez | TR/EN ayrı; DE/ES yanlış English duplicate | `MIXED`, DE/ES blocker |
| Page depth | Main route'lar 1 tık; Koleksiyon 1 tık | Main route'lar 1 tık; Koleksiyon orphan | `OLD_BETTER` for collection |
| Thin content risk | Kurumsal güçlü; Products/Collection/Gallery zayıf | Home güçlü; tüm interior özellikle Collection/Gallery zayıf | `MIXED`, new interior risk yüksek |
| Redirect requirements | Kendi legacy URL'lerini karşılıyor | Category ve PHP URL'leri 404 | `OLD_BETTER` until redirect map |
| Indexability | Kontrolsüz INDEX,FOLLOW | Staging kontrollü; sadece home published | New architecture better, launch incomplete |

SEO approval blockers:

- `/de/` ve `/es/` İngilizce içeriği `index,follow` ve canonical `/en/` ile sunuyor.
- `/kategori/erkek-giyim`, `/kategori/kadin-giyim`, `/kategori/cocuk-giyim` yeni sürümde 404.
- Legacy `.php`, `/koleksiyon` ve `/galeri` URL'leri için redirect yok.
- Koleksiyon route'u navigasyondan ve footer'dan link almıyor.
- Interior TR/EN sayfalar noindex ve sitemap dışında; bu staging için bilinçli fakat canlı replacement için eksik.
- Global staging robots engeli environment ayrımı olmadan canlıya taşınmamalı.

## K. Technical Comparison

### Runtime and Payload

| Metric | Old home | New home | Difference |
|---|---:|---:|---:|
| HTTP requests | 46 | 10 | -36 |
| Observed transfer | 21,733,001 B | 1,893,255 B | -91.3% |
| CSS transfer | 1,502,626 B | 15,420 B | -99.0% |
| JS transfer | 360,393 B | 0 B | -100% |
| Image transfer | 701,894 B | 1,196,709 B | New static images +494,815 B |
| Video transfer | 18,108,913 B | 0 B | Video removed |
| DOM nodes | 277 | 245 | -32 |
| Observed navigation | 1,451 ms | 201 ms | Local headless observation |
| LCP | 1,036 ms | 328 ms | Local headless observation |
| CLS | 0.4988 | 0 | Major improvement |

### Interior Route Samples

| Route | Old requests / transfer | New requests / transfer | Assessment |
|---|---:|---:|---|
| `/kurumsal` | 42 / 4.00 MB | 6 / 0.31 MB | New much lighter, but content much thinner |
| `/tasarim` | 35 / 4.42 MB | 6 / 0.31 MB | New much lighter, no production images |
| `/iletisim` | 32 / 3.27 MB | 6 / 0.31 MB | New lighter, form/map absent |
| Gallery/Collection | Old local assets broken | 12 / 3.27 MB each | New functional but image optimization required |

| Technical area | Old | New | Result |
|---|---|---|---|
| Build success | Build step yok; key PHP files lint pass | Build step yok; all redesign PHP lint pass | `EQUIVALENT` |
| Runtime errors | Nested collection/gallery asset 404s | Test edilen 7 route'ta console error yok | `NEW_BETTER` |
| Dependencies | Google Fonts, 5 CSS, 11 JS | 1 CSS, 0 JS, 2 local font subset | `NEW_BETTER` |
| Client rendering | PHP SSR fakat menu/slider/language yoğun JS | PHP SSR, menu native details, JS yok | `NEW_BETTER` |
| Responsive behavior | Çalışıyor fakat 1024 nav sıkışık, CLS yüksek | 320/375/768/1024/1440 overflow yok | `NEW_BETTER` |
| Layout shift | Measured CLS 0.4988 | Measured CLS 0 | `NEW_BETTER` |
| Unused code risk | Bootstrap/theme/slider/gallery libraries tüm route'larda | Tek scoped CSS | `NEW_BETTER` |
| Form reliability | UI var, endpoint 404 ve field contract bozuk | Form yok | `EQUIVALENT_FAILURE` |
| Broken links | Dört nested internal 404 | Taranan internal linklerde 0 | `NEW_BETTER` |
| Accessibility | Home H1/main/skip/focus/labels eksik | Landmarks, skip, focus, aria, reduced motion | `NEW_BETTER` |
| Tracking | GA/GTM bulunmadı | GA/GTM bulunmadı | `EQUIVALENT_MISSING` |
| Secrets/deploy scope | DB secret ve admin public tree içinde | Redesign kodunda secret yok; repo hâlâ legacy tree içeriyor | New app better, deployment exclusion required |

Kesin olmayan alanlar:

- Gerçek internet bağlantısında TTFB, CDN/cache, compression ve field Core Web Vitals ölçülmedi.
- Tarayıcı uyumluluğu Edge/Chromium dışında laboratuvar olarak ölçülmedi.
- Canlı mail deliverability ölçülmedi; eski endpoint dosya seviyesinde yok.
- Eski live veritabanındaki ürün detay URL'leri local snapshotta boş olduğu için redirect envanteri canlı log/DB ile tamamlanmalı.

## L. Weighted Scorecard

Puanlar doğrudan verilen ağırlıkların içindedir; toplam 100'dür.

| Criterion | Weight | Old score | New score | Difference | Justification |
|---|---:|---:|---:|---:|---|
| İçerik kapsamı ve doğruluk | 25 | 19 | 15 | -4 | Old corporate/design daha zengin; new home daha iyi fakat interior ciddi eksik |
| Kullanıcı deneyimi ve navigasyon | 15 | 8 | 12 | +4 | New daha açık ve kırık linksiz; Koleksiyon orphan ve contact self-loop puan kırdı |
| Üretici konumlandırması | 10 | 6 | 9 | +3 | New hero ve süreç/proof bölümleri daha doğrudan |
| Mobil deneyim | 10 | 6 | 9 | +3 | New 320/375'te stabil, overflow yok ve daha iyi hiyerarşi |
| SEO ve URL devamlılığı | 15 | 4 | 8 | +4 | New metadata/canonical/schema iyi; redirects, DE/ES ve launch indexability eksik |
| Performans | 10 | 2 | 9 | +7 | Video/JS kaldırıldı, transfer %91 azaldı, CLS 0 |
| Erişilebilirlik | 5 | 2 | 4 | +2 | New landmarks/focus/aria iyi; tam WCAG audit/form yok |
| Görsel kalite ve kurumsal güven | 5 | 2 | 4 | +2 | New home modern; temporary hero ve zayıf interior media puan kırdı |
| Dönüşüm ve iletişim | 5 | 2 | 2 | 0 | Old form bozuk; new form yok ve contact CTA self-loop |
| **Total** | **100** | **51** | **72** | **+21** | Teknik/görsel üstünlük, fakat replacement blockerları devam ediyor |

## M. Required Corrections Before Approval

### P0 - Replacement öncesi zorunlu

1. `/kurumsal` içeriğini eski doğrulanmış bilgileri koruyacak şekilde yeniden yapılandır: Ar-Ge, sampling, pattern-making, flexible production, collaboration, delivery discipline, sustainability context ve mission.
2. `/tasarim` sayfasına doğrulanmış design/modelhane ayrıntılarını ve gerçek üretim görsellerini geri ekle; eski placeholder metinleri geri getirme.
3. Gerçek backendli teklif formu kur: ayrı subject alanı, server validation, CSRF, honeypot/rate limit, başarı/hata durumları, mail log ve privacy consent.
4. Contact CTA self-loop'u kaldır; form anchor veya brief akışına yönlendir.
5. Koleksiyonu ana navigation/footer'a geri ekle veya route'u bilinçli şekilde kaldırıp redirect et.
6. Koleksiyon ve galeriyi ayır: `referanslar` assetlerini Koleksiyon'a, küratörlü üretim/ürün assetlerini Galeri'ye bağla.
7. Eski category, clean, `.php`, `/koleksiyon` ve `/galeri` URL'leri için 301 migration map oluştur; canlı DB/log ile tekil ürün URL'lerini doğrula.
8. DE/ES gerçek çeviri olmadan erişilebilir/indexlenebilir olmamalı. Route'ları 404/410 veya kesin noindex durumuna al.
9. İç sayfalar onaylanana kadar noindex kalsın; yayın anında publication status, sitemap ve hreflang birlikte açılmalı.
10. Staging `Disallow: /` ile canlı robots çıktısını environment bazlı ayır ve release checklist'e test ekle.
11. 900x900 temporary hero yerine doğrulanmış güncel tesis fotoğrafı kullan; minimum 2000x1125 ve responsive AVIF/WebP türevleri üret.
12. Uygunluk/sertifika iddialarını belgeyle doğrula; OCS/ORC terminolojisini netleştir ve markaların logo kullanım izinlerini kontrol et.

### P1 - Onay kalitesi için önemli

1. `/urunler` sayfasına ürün görsellerini ve kategori anchorlarını geri ekle.
2. Galeri/collection görsellerini responsive `srcset`, thumbnail ve modern formatlarla 3.27 MB seviyesinden düşür.
3. Doğrulanmış Google Maps linki veya consent/on-demand embed ekle.
4. Yalnız gerçek kurumsal hesaplar varsa sosyal linkleri ekle.
5. OG image, LocalBusiness/Organization uygunluğu ve page-specific schema ihtiyacını değerlendir.
6. GA4/GTM ve Search Console doğrulamasını privacy/consent planıyla birlikte staging sonrası kur.
7. Firefox, Safari/iOS ve gerçek cihaz klavye/screen reader kontrolü yap.
8. English interior içerikleri Türkçe ile eş kapsamda editoryal kontrolden geçir.

## N. Final Recommendation

**`DO_NOT_REPLACE_OLD_VERSION_YET`**

Yeni sürümün ana sayfası, mobil deneyimi, performansı, erişilebilirlik temeli ve SEO altyapısı eski sürümden belirgin biçimde daha güçlü. Ancak bu üstünlükler replacement onayı için yeterli değil. Kurumsal ve üretim içeriği kaybı, Koleksiyon'un orphan olması, galeri/koleksiyon kapsamının daralması, teklif formunun bulunmaması, redirect planının eksikliği, DE/ES duplicate route'ları, staging indexability durumu ve temporary hero regresyon kabul kriterlerini ihlal ediyor.

P0 maddeleri tamamlanıp aynı karşılaştırma tekrar geçilmeden yeni sürüm canlı sitenin yerine alınmamalıdır.
