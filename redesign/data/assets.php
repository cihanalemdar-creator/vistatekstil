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
        'womenswear' => $asset('public_html/yukleme/galeri/b_97660069.jpg', 'Siyah kadin elbisesi', 'Black womenswear dress'),
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
            $product('b_13294573.jpg', 'Siyah kadin tulum modeli', 'Black womenswear jumpsuit'),
            $product('b_13974932.jpg', 'Desenli kadin triko kombin', 'Patterned womenswear knit set'),
            $product('b_22572976.jpg', 'Mavi etek modeli', 'Blue womenswear skirt'),
            $product('b_27635530.jpg', 'Cizgili kadin elbisesi', 'Striped womenswear dress'),
            $product('b_39497391.jpg', 'Desenli kadin elbisesi', 'Printed womenswear dress'),
            $product('b_41904014.jpg', 'Desenli dokuma kadin elbisesi', 'Printed woven womenswear dress'),
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
        $asset('public_html/yukleme/referanslar/b_20802295.jpg', 'Baskili orme referans sweatshirt', 'Printed knit reference sweatshirt', 'collection'),
        $asset('public_html/yukleme/referanslar/b_74694600.jpg', 'Siyah referans urun', 'Black reference garment', 'collection'),
        $asset('public_html/yukleme/referanslar/b_91013391.jpg', 'Kadin giyim referans modeli', 'Womenswear reference style', 'collection'),
        $asset('public_html/yukleme/referanslar/kadin.jpg', 'Kadin giyim referans modeli', 'Womenswear reference garment', 'collection'),
        $product('b_27635530.jpg', 'Cizgili kadin elbisesi', 'Striped womenswear dress'),
        $product('b_49281808.jpg', 'Siyah erkek polo tisortu', 'Black menswear polo shirt'),
        $childrenswearGallery[8],
        $childrenswearGallery[23],
        $product('b_41904014.jpg', 'Desenli dokuma kadin elbisesi', 'Printed woven womenswear dress'),
        $childrenswearGallery[24],
        $childrenswearGallery[27],
        $product('b_5674047.jpg', 'Lacivert erkek dis giyim modeli', 'Navy menswear outerwear style'),
    ],
    'gallery' => array_merge($gallery, $childrenswearGallery),
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
