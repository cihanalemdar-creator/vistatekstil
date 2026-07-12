<?php
declare(strict_types=1);

$asset = static function (
    string $src,
    string $altTr,
    string $altEn,
    string $category = 'products',
    ?string $thumbnail = null
): array {
    return [
        'src' => $src,
        'thumbnail' => $thumbnail,
        'category' => $category,
        'status' => 'available',
        'alt' => ['tr' => $altTr, 'en' => $altEn],
    ];
};

$childrenswearDescriptions = [
    ['Siyah biye detaylı çocuk eşofman takımı', 'Black childrenswear tracksuit with contrast piping'],
    ['Kırmızı beyaz çizgili kapüşonlu çocuk takımı', 'Red and white striped hooded childrenswear set'],
    ['Kırmızı kontrast biyeli çocuk ev giyim takımı', 'Red childrenswear lounge set with contrast piping'],
    ['Gri puantiyeli kapüşonlu bebek takımı', 'Grey polka-dot hooded babywear set'],
    ['Siyah beyaz desenli kısa kollu bebek takımı', 'Black and white printed short-sleeve babywear set'],
    ['Bej baskılı bebek üst ve şort takımı', 'Beige printed babywear top and shorts set'],
    ['Zebra desenli kapüşonlu çocuk dış giyim modeli', 'Zebra-print hooded childrenswear outerwear style'],
    ['Siyah beyaz desenli çocuk sweatshirt takımı', 'Black and white printed childrenswear sweatshirt set'],
    ['Sarı puantiyeli çocuk eşofman takımı', 'Yellow polka-dot childrenswear tracksuit'],
    ['Beyaz kolsuz çocuk elbisesi', 'White sleeveless childrenswear dress'],
    ['Doğal tonlarda çizgili çocuk elbisesi', 'Neutral striped childrenswear dress'],
    ['Sarı kolsuz çocuk üst ve şort takımı', 'Yellow sleeveless childrenswear top and shorts set'],
    ['Beyaz peluş kapüşonlu bebek tulumu', 'White fleece hooded babywear romper'],
    ['Beyaz baskılı sweatshirt ve mavi çocuk pantolonu', 'White printed sweatshirt with blue childrenswear trousers'],
    ['Krem sweatshirt ve kahverengi çocuk pantolonu', 'Cream sweatshirt with brown childrenswear trousers'],
    ['Siyah kar desenli çocuk peluş üst giyim modeli', 'Black snow-print childrenswear fleece top'],
    ['Renkli çizgili fermuarlı bebek tulumu', 'Colourful striped zip-front babywear romper'],
    ['Pembe baskılı çocuk tişört ve şort takımı', 'Pink printed childrenswear T-shirt and shorts set'],
    ['Beyaz puantiyeli kolsuz çocuk elbisesi', 'White polka-dot sleeveless childrenswear dress'],
    ['Leopar desenli kapüşonlu bebek tulumu', 'Leopard-print hooded babywear romper'],
    ['Siyah benekli beyaz dolgulu bebek dış giyim tulumu', 'White padded babywear outerwear romper with black spots'],
    ['Pembe baskılı çocuk tişörtü ve siyah etek', 'Pink printed childrenswear T-shirt with black skirt'],
    ['Mavi desenli beyaz çocuk sweatshirt modeli', 'White childrenswear sweatshirt with blue print'],
    ['Taba peluş detaylı çocuk ceketi', 'Tan childrenswear jacket with fleece trim'],
    ['Mavi geometrik desenli çocuk ceket ve pantolon takımı', 'Blue geometric-print childrenswear jacket and trousers set'],
    ['Siyah beyaz desenli kapüşonlu çocuk ceketi', 'Black and white printed hooded childrenswear jacket'],
    ['Beyaz peluş çocuk ceketi', 'White fleece childrenswear jacket'],
    ['Siyah ve gri çocuk spor giyim takımları', 'Black and grey childrenswear sportswear sets'],
    ['Gri ve siyah çocuk eşofman takımları', 'Grey and black childrenswear tracksuits'],
    ['Krem ve kahverengi çocuk üst giyim takımı', 'Cream and brown childrenswear top set'],
    ['Mavi baskılı çocuk eşofman takımı', 'Blue printed childrenswear tracksuit'],
];

$childrenswearGallery = [];
foreach ($childrenswearDescriptions as $index => [$altTr, $altEn]) {
    $name = sprintf('childrenswear-%02d.webp', $index + 1);
    $childrenswearGallery[] = $asset(
        'redesign/assets/media/childrenswear/full/' . $name,
        $altTr,
        $altEn,
        'childrenswear',
        'redesign/assets/media/childrenswear/thumb/' . $name
    );
}

$womenswearDescriptions = [
    ['Metal halka detaylı siyah kadın elbisesi', 'Black womenswear dress with metal ring details'],
    ['Kiremit rengi kolsuz kadın üst ve şort takımı', 'Rust sleeveless womenswear top and shorts set'],
    ['Pudra kısa kollu kadın tulumu', 'Dusty rose short-sleeve womenswear jumpsuit'],
    ['Siyah A kesim kadın eteği', 'Black A-line womenswear skirt'],
    ['Haki kemerli kadın tulumu', 'Olive belted womenswear jumpsuit'],
    ['Ekose askılı kadın midi elbisesi', 'Plaid strappy womenswear midi dress'],
    ['Baskılı kadın tişört ve pantolon ev giyim takımı', 'Printed womenswear T-shirt and trousers lounge set'],
    ['Siyah kolsuz kruvaze kadın elbisesi', 'Black sleeveless wrap womenswear dress'],
    ['Açık mavi çizgili kolsuz kadın bluzu', 'Light blue striped sleeveless womenswear blouse'],
    ['Dantel kadın üst giyim model seçkisi', 'Womenswear lace top style selection'],
    ['Bordo kapüşonlu kadın sweatshirt modeli', 'Burgundy hooded womenswear sweatshirt'],
    ['Sarı dantel kadın üst ve etek takımı', 'Yellow lace womenswear top and skirt set'],
    ['Beyaz baskılı kadın tişört ve pantolon takımı', 'White printed womenswear T-shirt and trousers set'],
    ['Siyah kolsuz yırtmaçlı kadın elbisesi', 'Black sleeveless slit womenswear dress'],
    ['Turkuaz kolsuz rahat kesim kadın elbisesi', 'Turquoise sleeveless relaxed womenswear dress'],
    ['Beyaz düğmeli kolsuz kadın bluzu', 'White button-front sleeveless womenswear blouse'],
    ['Krem dantel askılı kadın üstü', 'Cream lace camisole top'],
    ['Siyah beyaz kontrast yakalı kadın elbisesi', 'Black womenswear dress with contrast white collar'],
    ['Kiremit rengi düğmeli kadın gömlek elbisesi', 'Rust button-front womenswear shirt dress'],
    ['Saks mavi püskül kollu kadın elbisesi', 'Cobalt blue womenswear dress with fringed sleeves'],
    ['Beyaz kolsuz üst ve lacivert kadın şortu', 'White sleeveless top with navy womenswear shorts'],
    ['Bej kemerli kadın gömlek elbisesi', 'Beige belted womenswear shirt dress'],
    ['Taş rengi kemerli kısa kollu kadın elbisesi', 'Stone belted short-sleeve womenswear dress'],
    ['Leopar desenli askılı kadın elbisesi', 'Leopard-print strappy womenswear dress'],
    ['Koyu yeşil büstiyer ve geniş paça kadın pantolon takımı', 'Dark green bustier and wide-leg womenswear trousers set'],
    ['Leopar desenli kadın tulumu', 'Leopard-print womenswear jumpsuit'],
    ['Beyaz kadın bluzu ve bordo etek kombini', 'White womenswear blouse with burgundy skirt'],
    ['Vizon drapeli uzun kollu kadın üstü', 'Taupe draped long-sleeve womenswear top'],
    ['Mavi desenli beyaz kadın ceketi', 'White womenswear jacket with blue print'],
    ['Dekoratif düğmeli beyaz kadın polo üstü', 'White womenswear polo top with decorative buttons'],
    ['Baskılı kadın tişört ve pantolon takımı', 'Printed womenswear T-shirt and trousers set'],
    ['Kahverengi kolsuz geniş paça kadın tulumu', 'Brown sleeveless wide-leg womenswear jumpsuit'],
    ['Kırmızı balıkçı yaka kadın üstü ve siyah etek', 'Red turtleneck womenswear top with black skirt'],
    ['Metal detaylı siyah kısa kadın elbisesi', 'Black short womenswear dress with metal details'],
    ['Çok renkli çizgili kadın yazlık elbisesi', 'Multicolour striped womenswear summer dress'],
    ['Saten çizgili kadın askılı üstü', 'Striped satin womenswear camisole'],
    ['Kahverengi düğmeli kadın maksi eteği', 'Brown button-front womenswear maxi skirt'],
    ['Mavi kısa kollu kadın gömleği', 'Blue short-sleeve womenswear shirt'],
    ['Siyah geniş paça kadın pantolonu', 'Black wide-leg womenswear trousers'],
    ['Beyaz tığ işi kadın plaj elbisesi', 'White crochet womenswear beach dress'],
    ['Püskül detaylı beyaz oversize kadın tişörtü', 'White oversized womenswear T-shirt with fringe detail'],
    ['Dantel detaylı beyaz kadın bluzu', 'White womenswear blouse with lace detail'],
    ['Siyah uzun kollu asimetrik düğmeli kadın elbisesi', 'Black long-sleeve asymmetric button womenswear dress'],
    ['Pudra dantel kadın plaj elbisesi', 'Pale pink lace womenswear beach dress'],
    ['Beyaz dantel kadın takım editoryali', 'White lace womenswear matching-set editorial'],
    ['Bej tığ işi uzun kollu kadın elbisesi', 'Beige crochet long-sleeve womenswear dress'],
    ['Siyah file kadın plaj pantolonu', 'Black mesh womenswear beach trousers'],
    ['Beyaz dantel geniş paça kadın pantolonu', 'White lace wide-leg womenswear trousers'],
    ['Beyaz oversize kapüşonlu kadın sweatshirtü', 'White oversized hooded womenswear sweatshirt'],
    ['Bej büzgü detaylı kadın yazlık takımı', 'Beige gathered womenswear summer set'],
    ['Çok renkli çizgili kadın triko elbisesi', 'Multicolour striped womenswear knit dress'],
    ['Beyaz straplez dantel kadın elbisesi', 'White strapless lace womenswear dress'],
    ['Bordo düğmeli kolsuz kadın yeleği', 'Burgundy button-front sleeveless womenswear vest'],
    ['Koyu kahverengi düğmeli kolsuz kadın yeleği', 'Dark brown button-front sleeveless womenswear vest'],
    ['Gül kurusu fitilli kadın üst ve şort takımı', 'Rose ribbed womenswear top and shorts set'],
    ['Beyaz asimetrik kadın şortu', 'White asymmetric womenswear shorts'],
    ['Mavi beyaz tığ işi kadın plaj takımı', 'Blue and white crochet womenswear beach set'],
    ['Beyaz baskılı kadın tişörtü', 'White printed womenswear T-shirt'],
    ['Bej çizgili kolsuz kadın gömleği', 'Beige striped sleeveless womenswear shirt'],
    ['Beyaz rahat kesim kadın yazlık elbisesi', 'White relaxed womenswear summer dress'],
    ['Siyah puantiyeli beyaz kadın elbisesi', 'White womenswear dress with black polka dots'],
    ['Beyaz kolsuz üst ve pembe kadın şortu', 'White sleeveless top with pink womenswear shorts'],
    ['Lacivert yırtmaçlı kadın maksi elbisesi', 'Navy slit womenswear maxi dress'],
    ['Lacivert boyundan bağlı kadın midi elbisesi', 'Navy halter womenswear midi dress'],
    ['Çok renkli çizgili kolsuz kadın üstü', 'Multicolour striped sleeveless womenswear top'],
    ['Beyaz kısa üst ve kadın pantolon takımı', 'White crop top and womenswear trousers set'],
    ['Şeftali rengi saten kadın gömlek ve şort takımı', 'Peach satin womenswear shirt and shorts set'],
    ['Kırmızı asimetrik kadın üstü ve siyah etek', 'Red asymmetric womenswear top with black skirt'],
    ['Leopar desenli kadın üstü ve beyaz etek', 'Leopard-print womenswear top with white skirt'],
    ['Beyaz kadın üstü ve mavi çizgili pantolon', 'White womenswear top with blue striped trousers'],
    ['Kahverengi kapüşonlu kadın ceketi', 'Brown hooded womenswear jacket'],
    ['Siyah omzu açık kadın üst ve pantolon takımı', 'Black off-shoulder womenswear top and trousers set'],
    ['Pudra kadın gömlek ve şort takımı', 'Pale pink womenswear shirt and shorts set'],
    ['Taba peluş kadın ceketi', 'Camel fleece womenswear jacket'],
    ['Siyah kapüşonlu kadın gömlek ceketi', 'Black hooded womenswear shirt jacket'],
    ['Kırmızı fermuarlı kadın ceketi', 'Red zip-front womenswear jacket'],
    ['Açık mavi kadın sweatshirt ve pantolon takımı', 'Light blue womenswear sweatshirt and trousers set'],
    ['Siyah benekli beyaz kadın peluş ceketi', 'White womenswear fleece jacket with black spots'],
    ['Siyah kısa kollu kadın tulumu', 'Black short-sleeve womenswear jumpsuit'],
    ['Açık mavi kadın yelek ve pantolon takımı', 'Light blue womenswear vest and trousers set'],
    ['Gri ekose kadın ceket ve etek takımı', 'Grey checked womenswear jacket and skirt set'],
    ['Gri desenli kadın hırka ve etek takımı', 'Grey patterned womenswear cardigan and skirt set'],
    ['Siyah kısa paça kadın pantolon kombini', 'Black cropped-trouser womenswear outfit'],
    ['Lacivert kolsuz kadın üst ve geniş paça pantolon takımı', 'Navy sleeveless womenswear top and wide-leg trousers set'],
];

$womenswearGallery = [];
foreach ($womenswearDescriptions as $index => [$altTr, $altEn]) {
    $name = sprintf('womenswear-%02d.webp', $index + 1);
    $womenswearGallery[] = $asset(
        'redesign/assets/media/womenswear/full/' . $name,
        $altTr,
        $altEn,
        'womenswear',
        'redesign/assets/media/womenswear/thumb/' . $name
    );
}

$galleryDetails = [
    'b_13240915.jpg' => ['facility', 'Vista Moda Tekstil uretim alani', 'Vista Moda Tekstil production floor'],
    'b_14591654.jpg' => ['facility', 'Vista Moda Tekstil giris ve karsilama alani', 'Vista Moda Tekstil reception area'],
    'b_20237570.jpg' => ['design', 'Modelhane calisma alani ve prova mankenleri', 'Pattern room workspace and dress forms'],
    'b_24248807.jpg' => ['design', 'Bilgisayar destekli urun gelistirme alani', 'Computer-assisted product development workspace'],
    'b_28701103.jpg' => ['facility', 'Numune ve koleksiyon sergileme alani', 'Sample and collection display area'],
    'b_39668106.jpg' => ['production', 'Kesim ve uretime hazirlik masasi', 'Cutting and production preparation table'],
    'b_50798094.jpg' => ['design', 'Modelhane ve teknik calisma masasi', 'Pattern room and technical work desk'],
    'b_52916166.jpg' => ['production', 'Paketleme icin hazirlanan urunler', 'Garments prepared for packing'],
    'b_53750109.jpg' => ['production', 'Uretimde kumas ve kesim kontrolu', 'Fabric and cutting inspection during production'],
    'b_5591417.jpg' => ['facility', 'Numune odasi ve calisma alani', 'Sample room and workspace'],
    'b_59517866.jpg' => ['design', 'Prova mankeni uzerinde model kontrolu', 'Garment review on a dress form'],
    'b_61281373.jpg' => ['design', 'Prova mankeni uzerinde kalip duzenleme', 'Pattern adjustment on a dress form'],
    'b_66422799.jpg' => ['production', 'Kumas kesim islemi', 'Fabric cutting operation'],
    'b_66672604.jpg' => ['production', 'Dikis makinesinde urun birlestirme', 'Garment assembly on a sewing machine'],
    'b_67315272.jpg' => ['facility', 'Vista Moda Tekstil dis mekan gorunumu', 'Vista Moda Tekstil exterior'],
    'b_77478001.jpg' => ['design', 'Baski ve kumas yuzeyi incelemesi', 'Print and fabric surface review'],
    'b_78176068.jpg' => ['production', 'Urun sonlandirma ve utu islemi', 'Garment finishing and pressing'],
    'b_80220299.jpg' => ['production', 'Endustriyel dikis islemi', 'Industrial sewing operation'],
    'b_81455276.jpg' => ['design', 'Model, kumas ve renk numuneleri', 'Style, fabric and colour samples'],
    'b_89058332.jpg' => ['production', 'Kumas uzerinde baski uygulamasi', 'Print application on fabric'],
    'b_90079895.jpg' => ['facility', 'Vista Moda Tekstil tesis girisi', 'Vista Moda Tekstil facility entrance'],
];

$gallery = [];
foreach (glob(__DIR__ . '/../../public_html/yukleme/galeri/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [] as $file) {
    $name = basename($file);
    [$category, $altTr, $altEn] = $galleryDetails[$name] ?? [
        'products',
        'Vista Moda Tekstil urun ve koleksiyon calismasi',
        'Vista Moda Tekstil garment and collection work',
    ];
    $gallery[] = $asset(
        'public_html/yukleme/galeri/' . $name,
        $altTr,
        $altEn,
        $category,
        'redesign/assets/media/gallery/' . pathinfo($name, PATHINFO_FILENAME) . '.webp'
    );
}

$archiveGallery = [];
foreach (glob(__DIR__ . '/../../public_html/Eski/yukleme/urunler/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [] as $file) {
    $name = basename($file);
    $archiveGallery[] = $asset(
        'public_html/Eski/yukleme/urunler/' . $name,
        'Vista Moda Tekstil eski urun arsivinden referans model',
        'Reference style from the Vista Moda Tekstil garment archive',
        'archive',
        'redesign/assets/media/archive/' . pathinfo($name, PATHINFO_FILENAME) . '.webp'
    );
}

foreach (glob(__DIR__ . '/../../public_html/yukleme/urunler/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [] as $file) {
    $name = basename($file);
    $archiveGallery[] = $asset(
        'public_html/yukleme/urunler/' . $name,
        'Vista Moda Tekstil ürün arşivinden hazır giyim modeli',
        'Garment style from the Vista Moda Tekstil product archive',
        'products',
        'redesign/assets/media/products/' . pathinfo($name, PATHINFO_FILENAME) . '.webp'
    );
}

$homeArchiveNames = [
    '1.jpg', '2.jpg', '3.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg',
    '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', 'customer.png', 'iletisim.jpg', 'tr3.jpg',
];
foreach ($homeArchiveNames as $name) {
    $archiveGallery[] = $asset(
        'public_html/yukleme/anasayfa/' . $name,
        'Vista Moda Tekstil eski ana sayfa görsel arşivi',
        'Vista Moda Tekstil legacy homepage visual archive',
        'archive',
        'redesign/assets/media/home-archive/' . pathinfo($name, PATHINFO_FILENAME) . '.webp'
    );
}

foreach (glob(__DIR__ . '/../../public_html/Eski/yukleme/slayt/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [] as $file) {
    $name = basename($file);
    $archiveGallery[] = $asset(
        'public_html/Eski/yukleme/slayt/' . $name,
        'Vista Moda Tekstil eski slayt arşivi',
        'Vista Moda Tekstil legacy slider archive',
        'archive',
        'redesign/assets/media/legacy-slides/' . pathinfo($name, PATHINFO_FILENAME) . '.webp'
    );
}

foreach (['kadin.jpg', 'erkek.jpg', 'cocuk.jpg'] as $name) {
    $archiveGallery[] = $asset(
        'public_html/' . $name,
        'Vista Moda Tekstil eski ürün kategorisi görseli',
        'Vista Moda Tekstil legacy product-category image',
        'archive'
    );
}

$legacySupport = [
    ['Eski/images/destek.jpg', '00-destek.webp'],
    ['Eski/images/kurumsal.jpg', '01-kurumsal.webp'],
    ['Eski/images/ust.jpg', '02-ust.webp'],
    ['Eski/yukleme/hizmetler/210e6334ce974422bcd9dfcfc4d57a4e.jpg', '03-210e6334ce974422bcd9dfcfc4d57a4e.webp'],
    ['Eski/yukleme/hizmetler/442cc8d8-10c2-444d-a140-53fec7003bb4.jpg', '04-442cc8d8-10c2-444d-a140-53fec7003bb4.webp'],
    ['Eski/yukleme/hizmetler/97fdc5d1-7f9e-4c4e-9e03-3f7a2436.jpg', '05-97fdc5d1-7f9e-4c4e-9e03-3f7a2436.webp'],
    ['Eski/yukleme/hizmetler/GettyImages-505831155-5970f70022fa3a00103a69da.jpg', '06-GettyImages-505831155-5970f70022fa3a00103a69da.webp'],
    ['Eski/yukleme/hizmetler/koleksiyon.jpg', '07-koleksiyon.webp'],
    ['Eski/yukleme/hizmetler/koleksiyon_1.jpg', '08-koleksiyon_1.webp'],
    ['Eski/yukleme/hizmetler/modelhane.jpg', '09-modelhane.webp'],
    ['Eski/yukleme/hizmetler/slasharchitects-Elissa-Stampa-Fashion-Design-Office-22-textile-showroom.jpg', '10-slasharchitects-Elissa-Stampa-Fashion-Design-Office-22-textile-showroom.webp'],
    ['Eski/yukleme/hizmetler/tasarim.jpg', '11-tasarim.webp'],
];
foreach ($legacySupport as [$source, $thumbnail]) {
    $archiveGallery[] = $asset(
        'public_html/' . $source,
        'Vista Moda Tekstil eski kurumsal ve üretim destek görseli',
        'Vista Moda Tekstil legacy company and production supporting image',
        'archive',
        'redesign/assets/media/legacy-support/' . $thumbnail
    );
}

$product = static function (string $name, string $altTr, string $altEn) use ($asset): array {
    return $asset('public_html/yukleme/urunler/' . $name, $altTr, $altEn, 'products');
};

return [
    'hero_factory' => $asset(
        'public_html/yukleme/galeri/b_13240915.jpg',
        'Vista Moda Tekstil uretim alaninda dikim calismasi',
        'Sewing work on the Vista Moda Tekstil production floor',
        'facility'
    ),
    'home_products' => [
        'womenswear' => $womenswearGallery[4],
        'menswear' => $asset('public_html/yukleme/galeri/b_69409616.jpg', 'Lacivert erkek dis giyim urunu', 'Navy menswear outerwear garment'),
        'kidswear' => $childrenswearGallery[8],
    ],
    'process' => [
        'design' => $asset('public_html/yukleme/anasayfa/9.jpg', 'Kumas ve renk kartelasi uzerinde tasarim calismasi', 'Design work with fabric and colour references', 'design'),
        'pattern' => $asset('public_html/yukleme/galeri/b_20237570.jpg', 'Modelhane ve kalip gelistirme alani', 'Pattern room and pattern development area', 'design'),
        'sampling' => $asset('public_html/yukleme/galeri/b_59517866.jpg', 'Prova mankeni uzerinde numune kontrolu', 'Sample review on a dress form', 'design'),
        'cutting' => $asset('public_html/yukleme/galeri/b_66422799.jpg', 'Kumas kesim islemi', 'Fabric cutting operation', 'production'),
        'sewing' => $asset('public_html/yukleme/galeri/b_66672604.jpg', 'Endustriyel dikis islemi', 'Industrial sewing operation', 'production'),
        'quality' => $asset('public_html/yukleme/galeri/b_78176068.jpg', 'Urun son kontrol ve utu islemi', 'Garment final inspection and pressing', 'production'),
        'packing' => $asset('public_html/yukleme/galeri/b_52916166.jpg', 'Paketlemeye hazirlanan urunler', 'Garments prepared for packing', 'production'),
        'fabric' => $asset('public_html/yukleme/galeri/b_81455276.jpg', 'Kumas ve renk numuneleri', 'Fabric and colour samples', 'design'),
    ],
    'products' => [
        'womenswear' => [
            $womenswearGallery[0],
            $womenswearGallery[4],
            $womenswearGallery[13],
            $womenswearGallery[18],
            $womenswearGallery[24],
            $womenswearGallery[66],
        ],
        'menswear' => [
            $product('b_11894314.jpg', 'Baskili erkek tisortu', 'Printed menswear T-shirt'),
            $product('b_18152692.jpg', 'Erkek polo tisortu', 'Menswear polo shirt'),
            $product('b_23548920.jpg', 'Kirmizi erkek fermuarli ust', 'Red menswear zip top'),
            $product('b_49281808.jpg', 'Siyah erkek polo tisortu', 'Black menswear polo shirt'),
            $product('b_5674047.jpg', 'Lacivert erkek dis giyim modeli', 'Navy menswear outerwear style'),
            $product('b_71024668.jpg', 'Siyah erkek pantolonu', 'Black menswear trousers'),
        ],
        'kidswear' => [
            $childrenswearGallery[0],
            $childrenswearGallery[8],
            $childrenswearGallery[13],
            $childrenswearGallery[19],
            $childrenswearGallery[23],
            $childrenswearGallery[24],
        ],
        'knitwear' => [
            $product('b_38099833.jpg', 'Kahverengi orme kadin ustu', 'Brown knit womenswear top'),
            $product('b_45427853.jpg', 'Siyah orme kadin takimi', 'Black knit womenswear set'),
            $product('b_55102590.jpg', 'Yesil erkek orme ustu', 'Green knit menswear top'),
            $product('b_78361866.jpg', 'Baskili pembe kadin tisortu', 'Printed pink womenswear T-shirt'),
        ],
        'woven' => [
            $product('b_20597532.jpg', 'Gri dokuma kadin elbisesi', 'Grey woven womenswear dress'),
            $product('b_27635530.jpg', 'Cizgili dokuma kadin elbisesi', 'Striped woven womenswear dress'),
            $product('b_36689075.jpg', 'Bej dokuma kadin tulumu', 'Beige woven womenswear jumpsuit'),
            $product('b_49384394.jpg', 'Cizgili dokuma kadin gomlegi', 'Striped woven womenswear shirt'),
        ],
    ],
    'collection' => [
        $womenswearGallery[0],
        $womenswearGallery[4],
        $womenswearGallery[13],
        $womenswearGallery[24],
        $womenswearGallery[66],
        $product('b_49281808.jpg', 'Siyah erkek polo tisortu', 'Black menswear polo shirt'),
        $childrenswearGallery[8],
        $childrenswearGallery[23],
        $womenswearGallery[78],
        $childrenswearGallery[24],
        $childrenswearGallery[27],
        $product('b_5674047.jpg', 'Lacivert erkek dis giyim modeli', 'Navy menswear outerwear style'),
    ],
    'gallery' => array_merge($gallery, $womenswearGallery, $childrenswearGallery),
    'archive_gallery' => $archiveGallery,
    'videos' => [
        'tr' => [
            'src' => 'public_html/videos/tr.mp4',
            'poster' => 'public_html/yukleme/galeri/b_13240915.jpg',
            'title' => 'Vista Moda Tekstil uretim sureci',
        ],
        'en' => [
            'src' => 'public_html/videos/eng.mp4',
            'poster' => 'public_html/yukleme/galeri/b_13240915.jpg',
            'title' => 'Vista Moda Tekstil production process',
        ],
    ],
    'hero_videos' => [
        'tr' => [
            'desktop' => [
                'webm' => 'redesign/assets/media/hero/tr-desktop.webm',
                'mp4' => 'redesign/assets/media/hero/tr-desktop.mp4',
                'poster' => 'redesign/assets/media/hero/tr-desktop-poster.webp',
            ],
            'mobile' => [
                'webm' => 'redesign/assets/media/hero/tr-mobile.webm',
                'mp4' => 'redesign/assets/media/hero/tr-mobile.mp4',
                'poster' => 'redesign/assets/media/hero/tr-mobile-poster.webp',
            ],
            'title' => 'Vista Moda Tekstil ana sayfa üretim videosu',
        ],
        'en' => [
            'desktop' => [
                'webm' => 'redesign/assets/media/hero/eng-desktop.webm',
                'mp4' => 'redesign/assets/media/hero/eng-desktop.mp4',
                'poster' => 'redesign/assets/media/hero/eng-desktop-poster.webp',
            ],
            'mobile' => [
                'webm' => 'redesign/assets/media/hero/eng-mobile.webm',
                'mp4' => 'redesign/assets/media/hero/eng-mobile.mp4',
                'poster' => 'redesign/assets/media/hero/eng-mobile-poster.webp',
            ],
            'title' => 'Vista Moda Tekstil homepage production video',
        ],
    ],
    'certifications' => $asset(
        'public_html/Eski/logolar.png',
        'Orijinal sitede kullanılan uygunluk ve malzeme sertifika işaretleri',
        'Compliance and material certification marks used on the original website',
        'supporting'
    ),
];
