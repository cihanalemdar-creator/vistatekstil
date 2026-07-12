<?php
declare(strict_types=1);

$assets = require __DIR__ . '/assets-manifest.php';

$uiTr = [
    'skip' => 'İçeriğe geç',
    'mainNav' => 'Ana menü',
    'mobileNav' => 'Mobil menü',
    'footerNav' => 'Alt menü',
    'language' => 'Dil seçimi',
    'menu' => 'Menü',
    'contact' => 'İletişime geçin',
    'details' => 'Detayları inceleyin',
    'home' => 'Ana sayfa',
];

$uiEn = [
    'skip' => 'Skip to content',
    'mainNav' => 'Main navigation',
    'mobileNav' => 'Mobile navigation',
    'footerNav' => 'Footer navigation',
    'language' => 'Language selection',
    'menu' => 'Menu',
    'contact' => 'Contact us',
    'details' => 'View details',
    'home' => 'Home',
];

$homeTr = [
    'ui' => $uiTr,
    'meta' => [
        'title' => 'Vista Moda Tekstil | İstanbul Hazır Giyim Üreticisi',
        'description' => 'Vista Moda Tekstil; kadın, erkek ve çocuk giyim koleksiyonları için örme ve dokuma hazır giyim üretimi gerçekleştirir.',
    ],
    'hero' => [
        'eyebrow' => '2019’dan beri İstanbul’da üretim',
        'title' => 'Kadın, erkek ve çocuk hazır giyim üretimi.',
        'lede' => 'Yuvarlak örme ve dokuma ürünler için tasarım desteğinden kalıp ve numuneye, kesimden kalite kontrol ve paketlemeye uzanan doğrudan üretim süreci.',
        'primaryCta' => 'Üretim olanakları',
        'secondaryCta' => 'İletişime geçin',
    ],
    'proof' => [
        'label' => 'Vista Moda Tekstil üretim bilgileri',
        'items' => [
            ['value' => '2019', 'label' => 'Kuruluş yılı'],
            ['value' => '5.000', 'suffix' => 'adet', 'label' => 'Aylık iç üretim kapasitesi'],
            ['value' => '35.000', 'suffix' => 'adet', 'label' => 'Toplam aylık kapasite'],
            ['value' => '100', 'suffix' => 'adet', 'label' => 'Minimum sipariş adedi'],
        ],
        'note' => 'Minimum sipariş adedi, kumaş tedarikçilerinin özel limitlerine göre değişebilir.',
    ],
    'about' => [
        'eyebrow' => 'Vista Moda Tekstil',
        'title' => 'Kumaştan sevkiyat hazırlığına, sürecin merkezindeyiz.',
        'paragraphs' => [
            'Vista Moda Tekstil, 2019 yılında Dilek Akkoyunlu tarafından kurulmuş bir hazır giyim üreticisidir. Kurucumuzun sektörel birikimi ve kaliteye bağlılığı, üretim anlayışımızın temelini oluşturur.',
            'İstanbul’daki ekibimiz; kalıp, numune, kesim, dikim, kalite kontrol ve paketleme aşamalarını planlı bir üretim akışı içinde yürütür.',
        ],
        'link' => 'Şirketi tanıyın',
    ],
    'products' => [
        'eyebrow' => 'Ürün grupları',
        'title' => 'Kadın, erkek ve çocuk hazır giyim',
        'intro' => 'Yuvarlak örme kesim-dikim ve dokuma kumaşlarla; bluz, elbise, ceket, etek, şort ve pantolon gibi farklı ürün gruplarında üretim gerçekleştiriyoruz.',
        'items' => [
            ['key' => 'womenswear', 'title' => 'Kadın giyim', 'text' => 'Bluz, elbise, ceket, etek, şort ve pantolon üretimi.'],
            ['key' => 'menswear', 'title' => 'Erkek giyim', 'text' => 'Örme ve dokuma kumaşlarla farklı ürün ve koleksiyon ihtiyaçları.'],
            ['key' => 'kidswear', 'title' => 'Çocuk giyim', 'text' => 'Koleksiyonun ürün yapısına göre örme ve dokuma çocuk giyim üretimi.'],
        ],
        'link' => 'Ürün gruplarını inceleyin',
    ],
    'capabilities' => [
        'eyebrow' => 'Üretim kabiliyetleri',
        'title' => 'Fikirden bitmiş ürüne uzanan üretim akışı',
        'intro' => 'Her aşama, koleksiyonun teknik gereksinimleri ve üretim planı doğrultusunda ele alınır.',
        'items' => [
            ['number' => '01', 'title' => 'Tasarım ve geliştirme', 'text' => 'Kumaş, desen ve aksesuar seçenekleri koleksiyonun ihtiyacına göre değerlendirilir.'],
            ['number' => '02', 'title' => 'Kalıp ve numune', 'text' => 'Model, kalıp ve ürün detayları hazırlanır; gerektiğinde alternatif çözümler geliştirilir.'],
            ['number' => '03', 'title' => 'Kesim ve dikim', 'text' => 'Kesim ve dikim süreçleri şirket bünyesindeki üretim akışı içinde yürütülür.'],
            ['number' => '04', 'title' => 'Kalite kontrol ve paketleme', 'text' => 'Ürünler teslimat öncesinde kontrol edilir ve sevkiyata uygun şekilde paketlenir.'],
        ],
        'link' => 'Üretim sürecini inceleyin',
    ],
    'process' => [
        'eyebrow' => 'Nasıl çalışıyoruz?',
        'title' => 'Koleksiyon ihtiyacından üretim takibine',
        'items' => [
            ['title' => 'İhtiyacın değerlendirilmesi', 'text' => 'Ürün grubu, model, adet ve hedefler birlikte ele alınır.'],
            ['title' => 'Kumaş ve ürün geliştirme', 'text' => 'Kumaş ve aksesuar seçenekleri teknik ihtiyaçlarla eşleştirilir.'],
            ['title' => 'Kalıp ve numune hazırlığı', 'text' => 'Model detayları netleştirilir ve numune süreci yürütülür.'],
            ['title' => 'Üretim', 'text' => 'Kesim, dikim ve üretim takibi planlanan akışa göre ilerler.'],
            ['title' => 'Kontrol ve paketleme', 'text' => 'Kalite kontrolü tamamlanan ürünler sevkiyata hazırlanır.'],
        ],
    ],
    'markets' => [
        'eyebrow' => 'Çalıştığımız pazarlar',
        'title' => 'İstanbul’dan uluslararası markalara üretim',
        'text' => 'Vista Moda Tekstil; Amerika Birleşik Devletleri, İngiltere, Almanya ve Türkiye’deki markalarla çalışmaktadır.',
        'items' => ['Amerika Birleşik Devletleri', 'İngiltere', 'Almanya', 'Türkiye'],
    ],
    'quality' => [
        'eyebrow' => 'Kalite ve uygunluk',
        'title' => 'Üretimin her aşamasında kontrollü yaklaşım',
        'paragraphs' => [
            'Ürünler, teslimat öncesinde kalite kontrol ekibimiz tarafından denetlenir. Üretim iş ortaklıklarında SEDEX ve BSCI; kumaş tedariğinde ise BCI, GRS, OCS ve Oeko-Tex belgelerine sahip tedarikçilerle çalışma yaklaşımı benimsenir.',
            'Belge ve uygunluk gereksinimleri, her projenin kapsamına göre üretim öncesinde değerlendirilir.',
        ],
        'link' => 'Kurumsal yaklaşımımız',
    ],
    'collection' => [
        'eyebrow' => 'Koleksiyon',
        'title' => 'Bitmiş ürünlerden seçilmiş referanslar',
        'text' => 'Kadın, erkek ve çocuk giyim ile örme ve dokuma ürün çalışmalarından seçilmiş modelleri inceleyin.',
        'link' => 'Koleksiyonu görüntüleyin',
    ],
    'video' => [
        'eyebrow' => 'Üretim süreci',
        'title' => 'Üretim sürecimizi izleyin',
        'text' => 'Tasarım ve modelhaneden kesim, dikim, kalite kontrol ve paketlemeye uzanan çalışma ortamımızdan kısa bir görünüm.',
    ],
    'cta' => [
        'eyebrow' => 'Yeni bir üretim projesi',
        'title' => 'Koleksiyonunuzu birlikte değerlendirelim.',
        'text' => 'Ürün grubu, tahmini adet ve hedef teslim dönemiyle ilgili bilgileri paylaşın; üretim olanaklarını birlikte ele alalım.',
        'button' => 'Vista Moda ile iletişime geçin',
    ],
    'footer' => [
        'summary' => 'Kadın, erkek ve çocuk koleksiyonları için örme ve dokuma hazır giyim üretimi.',
        'contact' => 'İletişim',
        'office' => 'Merkez ofis',
        'factory' => 'Üretim tesisi',
        'pages' => 'Sayfalar',
        'copyright' => 'Tüm hakları saklıdır.',
    ],
];

$homeEn = [
    'ui' => $uiEn,
    'meta' => [
        'title' => 'Vista Moda Tekstil | Garment Manufacturer in Istanbul',
        'description' => 'Vista Moda Tekstil manufactures knit and woven womenswear, menswear and childrenswear collections in Istanbul.',
    ],
    'hero' => [
        'eyebrow' => 'Manufacturing in Istanbul since 2019',
        'title' => 'Womenswear, menswear and childrenswear manufacturing.',
        'lede' => 'A direct production process for circular knit and woven garments, from design support, patterns and samples to cutting, quality control and packing.',
        'primaryCta' => 'Production capabilities',
        'secondaryCta' => 'Contact us',
    ],
    'proof' => [
        'label' => 'Vista Moda Tekstil production facts',
        'items' => [
            ['value' => '2019', 'label' => 'Year founded'],
            ['value' => '5,000', 'suffix' => 'pcs', 'label' => 'Monthly in-house capacity'],
            ['value' => '35,000', 'suffix' => 'pcs', 'label' => 'Total monthly capacity'],
            ['value' => '100', 'suffix' => 'pcs', 'label' => 'Minimum order quantity'],
        ],
        'note' => 'Minimum order quantity may vary where fabric suppliers set specific limits.',
    ],
    'about' => [
        'eyebrow' => 'Vista Moda Tekstil',
        'title' => 'At the centre of the process, from fabric to shipment preparation.',
        'paragraphs' => [
            'Vista Moda Tekstil is a ready-to-wear garment manufacturer founded in 2019 by Dilek Akkoyunlu. Our founder’s industry experience and commitment to quality form the basis of our production approach.',
            'Our Istanbul team manages pattern making, sampling, cutting, sewing, quality control and packing within a planned production workflow.',
        ],
        'link' => 'About the company',
    ],
    'products' => [
        'eyebrow' => 'Product groups',
        'title' => 'Womenswear, menswear and childrenswear',
        'intro' => 'We manufacture circular knit cut-and-sew and woven garments across product groups including blouses, dresses, jackets, skirts, shorts and trousers.',
        'items' => [
            ['key' => 'womenswear', 'title' => 'Womenswear', 'text' => 'Blouses, dresses, jackets, skirts, shorts and trousers.'],
            ['key' => 'menswear', 'title' => 'Menswear', 'text' => 'Knit and woven products developed around different collection requirements.'],
            ['key' => 'kidswear', 'title' => 'Childrenswear', 'text' => 'Knit and woven childrenswear based on the structure of each collection.'],
        ],
        'link' => 'Explore product groups',
    ],
    'capabilities' => [
        'eyebrow' => 'Production capabilities',
        'title' => 'A production workflow from idea to finished garment',
        'intro' => 'Each stage is planned around the technical requirements and production needs of the collection.',
        'items' => [
            ['number' => '01', 'title' => 'Design and development', 'text' => 'Fabric, print and trim options are reviewed against the needs of the collection.'],
            ['number' => '02', 'title' => 'Patterns and sampling', 'text' => 'Patterns and garment details are prepared, with alternatives developed when needed.'],
            ['number' => '03', 'title' => 'Cutting and sewing', 'text' => 'Cutting and sewing are managed within the company’s production workflow.'],
            ['number' => '04', 'title' => 'Quality control and packing', 'text' => 'Garments are inspected before delivery and packed for shipment.'],
        ],
        'link' => 'Explore the production process',
    ],
    'process' => [
        'eyebrow' => 'How we work',
        'title' => 'From collection requirements to production follow-up',
        'items' => [
            ['title' => 'Requirement review', 'text' => 'Product group, styles, quantities and targets are reviewed together.'],
            ['title' => 'Fabric and product development', 'text' => 'Fabric and trim options are matched with technical needs.'],
            ['title' => 'Patterns and samples', 'text' => 'Garment details are defined and the sampling process is managed.'],
            ['title' => 'Production', 'text' => 'Cutting, sewing and production follow-up proceed to the agreed plan.'],
            ['title' => 'Inspection and packing', 'text' => 'Approved garments are prepared for shipment.'],
        ],
    ],
    'markets' => [
        'eyebrow' => 'Markets we serve',
        'title' => 'Manufacturing in Istanbul for international brands',
        'text' => 'Vista Moda Tekstil works with brands based in the United States, the United Kingdom, Germany and Turkey.',
        'items' => ['United States', 'United Kingdom', 'Germany', 'Turkey'],
    ],
    'quality' => [
        'eyebrow' => 'Quality and compliance',
        'title' => 'A controlled approach throughout production',
        'paragraphs' => [
            'Products are inspected by our quality control team before delivery. Our production approach includes working with SEDEX and BSCI-certified partners and sourcing from mills holding BCI, GRS, OCS and Oeko-Tex certifications.',
            'Documentation and compliance requirements are reviewed for the scope of each project before production.',
        ],
        'link' => 'Our company approach',
    ],
    'collection' => [
        'eyebrow' => 'Collection',
        'title' => 'Selected finished-garment references',
        'text' => 'Explore selected styles across womenswear, menswear and childrenswear, including knit and woven product work.',
        'link' => 'View the collection',
    ],
    'video' => [
        'eyebrow' => 'Production process',
        'title' => 'Watch our production process',
        'text' => 'A short look at our working environment, from design and the pattern room through cutting, sewing, quality control and packing.',
    ],
    'cta' => [
        'eyebrow' => 'A new production project',
        'title' => 'Let’s review your collection together.',
        'text' => 'Share the product category, estimated quantity and target delivery period so we can discuss suitable production options.',
        'button' => 'Contact Vista Moda',
    ],
    'footer' => [
        'summary' => 'Knit and woven garment manufacturing for womenswear, menswear and childrenswear collections.',
        'contact' => 'Contact',
        'office' => 'Head office',
        'factory' => 'Production facility',
        'pages' => 'Pages',
        'copyright' => 'All rights reserved.',
    ],
];

$interiorTr = [
    'about' => [
        'meta' => ['title' => 'Kurumsal | Vista Moda Tekstil', 'description' => 'Vista Moda Tekstil’in kuruluşu, üretim yaklaşımı, kapasitesi, pazarları ve sürdürülebilirlik çalışmaları.'],
        'eyebrow' => 'Kurumsal',
        'title' => 'İstanbul’dan dünyaya doğrudan hazır giyim üretimi',
        'intro' => '2019 yılında Dilek Akkoyunlu tarafından kurulan Vista Moda Tekstil; kadın, erkek ve çocuk koleksiyonları için yuvarlak örme kesim-dikim ve dokuma hazır giyim üretir.',
        'sections' => [
            ['title' => 'Vista Tekstil hakkında', 'text' => 'Hazır giyim üreticisi kimliğimizle tasarım desteğinden sevkiyat hazırlığına kadar bütün süreci tek bir plan içinde yönetiriz. Bluz, elbise, ceket, etek, şort ve pantolon dahil farklı ürün gruplarında markaların koleksiyon ihtiyaçlarına cevap veririz.', 'asset' => 'facility'],
            ['title' => 'Kuruluş ve gelişim', 'text' => 'Vista Moda Tekstil, kurucumuz Dilek Akkoyunlu’nun sektör deneyimi ve kalite odaklı yaklaşımıyla 2019’da İstanbul’da kuruldu. Şirketin gelişimi; üretim disiplinini esnek çalışma, açık iletişim ve uzun vadeli iş ortaklığı anlayışıyla birleştiren bir yapı üzerine kuruldu.', 'asset' => 'founder'],
            ['title' => 'Üretim yaklaşımı', 'text' => 'Kalıp hazırlama, numune geliştirme, kesim, dikim, ara kalite kontrol, final kalite kontrol ve paketleme aşamaları şirket bünyesindeki üretim akışında yürütülür. Süreç boyunca teknik gereksinimler, termin planı ve müşteri geri bildirimleri birlikte takip edilir.', 'asset' => 'production'],
            ['title' => 'Tasarım, Ar-Ge ve ürün geliştirme', 'text' => 'Ar-Ge ekibimiz uluslararası kumaş ve hazır giyim fuarlarını, trend analizlerini ve sektörel gelişmeleri izler. Yerel ve uluslararası kumaş, desen ve aksesuar tedarikçileriyle çalışarak koleksiyona uygun alternatifler sunar ve gerekli durumlarda kumaş kalitelerinin geliştirilmesini destekler.', 'asset' => 'design'],
            ['title' => 'Modelhane, kalıp ve numune', 'text' => 'Modelhane ekibimiz modelin teknik detaylarını değerlendirir, kalıpları şirket içinde hazırlar ve hızlı, doğru numune sürecini yönetir. Deneyimli modelistlerimiz uygulanabilirlik, görünüm ve üretim verimliliği için alternatif çözümler geliştirir.', 'asset' => 'sampling'],
            ['title' => 'Kapasite ve esnek üretim', 'text' => 'Aylık iç üretim kapasitemiz 5.000 adet, toplam aylık üretim kapasitemiz 35.000 adettir. Minimum sipariş miktarı 100 adettir; kumaş tedarikçilerinin özel limitleri bu miktarı etkileyebilir. Kumaş minimumları elverdiğinde küçük ve orta ölçekli markalarla farklı adetlerde esnek çalışma yürütürüz.', 'asset' => 'cutting'],
            ['title' => 'Çalıştığımız pazarlar', 'text' => 'Amerika Birleşik Devletleri, İngiltere, Almanya ve Türkiye’deki markalarla çalışıyoruz. Uluslararası projelerde teknik beklentileri, iletişim akışını ve hedef teslim dönemini üretim planının başında netleştiririz.', 'asset' => 'markets'],
            ['title' => 'Kalite, uygunluk ve sürdürülebilirlik', 'text' => 'Üretim iş ortaklıklarımızda SEDEX ve BSCI sertifikalı yapılarla; kumaş tedariğinde BCI, GRS, OCS ve Oeko-Tex belgelerine sahip tedarikçilerle çalışırız. Müşterinin proje kapsamına uygun belge, sürdürülebilir malzeme ve çevre dostu üretim taleplerini üretim öncesinde planlarız.', 'asset' => 'quality'],
            ['title' => 'İş ortaklığı yaklaşımı ve misyon', 'text' => 'Şeffaf iletişim, teslimat disiplinine bağlılık ve sorunlara hızlı çözüm üretmek çalışma biçimimizin temelidir. Misyonumuz; kalite, sürdürülebilirlik ve müşteri memnuniyetini birlikte ele alarak markalarla kalıcı, güvene dayalı küresel iş ortaklıkları kurmaktır.', 'asset' => 'partnership'],
        ],
    ],
    'products' => [
        'meta' => ['title' => 'Ürünler | Vista Moda Tekstil', 'description' => 'Kadın, erkek ve çocuk giyim için örme ve dokuma ürün grupları, model örnekleri ve üretim kapsamı.'],
        'eyebrow' => 'Ürünler',
        'title' => 'Kadın, erkek ve çocuk koleksiyonları için örme ve dokuma ürünler',
        'intro' => 'Ürün kapsamımız, markanın koleksiyon yapısına göre kumaş ve aksesuar değerlendirmesinden kalıp, numune ve seri üretime kadar geliştirilir.',
        'sections' => [
            ['key' => 'womenswear', 'id' => 'kadin-giyim', 'title' => 'Kadın Giyim', 'text' => 'Bluz, elbise, ceket, etek, şort, pantolon, tulum ve takım modellerini koleksiyonun teknik yapısına göre geliştiriyoruz.', 'examples' => ['Bluz ve üst giyim', 'Elbise ve tulum', 'Etek, şort ve pantolon', 'Ceket ve takımlar'], 'context' => 'Yuvarlak örme kesim-dikim ve dokuma kumaş seçenekleriyle çalışılır.'],
            ['key' => 'menswear', 'id' => 'erkek-giyim', 'title' => 'Erkek Giyim', 'text' => 'Tişört, polo, sweatshirt, pantolon, dış giyim ve koleksiyona özel erkek ürünleri için model ve üretim desteği sunuyoruz.', 'examples' => ['Tişört ve polo', 'Sweatshirt ve üst giyim', 'Pantolon ve şort', 'Ceket ve dış giyim'], 'context' => 'Örme ve dokuma ürünler, hedef kullanım ve fiyat yapısına göre planlanır.'],
            ['key' => 'kidswear', 'id' => 'cocuk-giyim', 'title' => 'Çocuk Giyim', 'text' => 'Bebek ve çocuk koleksiyonlarında hareket rahatlığı, ürün detayı ve koleksiyon bütünlüğünü gözeten örme ve dokuma modeller geliştiriyoruz.', 'examples' => ['Bebek tulumu ve takım', 'Tişört ve sweatshirt', 'Elbise ve alt giyim', 'Mont ve dış giyim'], 'context' => 'Kumaş, aksesuar ve ürün detayları çocuk koleksiyonunun teknik gereksinimlerine göre ele alınır.'],
            ['key' => 'knitwear', 'id' => 'orme-urunler', 'title' => 'Örme Ürünler', 'text' => 'Yuvarlak örme kumaşlarla kesim-dikim ürünleri; model, gramaj, yüzey, baskı ve aksesuar ihtiyaçları doğrultusunda geliştiriyoruz.', 'examples' => ['Tişört ve atlet', 'Sweatshirt ve eşofman', 'Elbise ve takımlar', 'Polo ve günlük üst giyim'], 'context' => 'Kumaş kalitesi, tuşe, renk ve baskı alternatifleri numune öncesinde değerlendirilir.'],
            ['key' => 'woven', 'id' => 'dokuma-urunler', 'title' => 'Dokuma Ürünler', 'text' => 'Dokuma koleksiyonlarda kalıp, dikiş detayı, aksesuar ve form bütünlüğünü birlikte ele alan ürün geliştirme ve üretim süreci yürütüyoruz.', 'examples' => ['Bluz ve gömlek', 'Elbise ve tulum', 'Etek ve pantolon', 'Ceket ve dış giyim'], 'context' => 'Kumaş yapısı ve model detayları kesim, dikim ve final görünüm hedefiyle birlikte planlanır.'],
        ],
    ],
    'design' => [
        'meta' => ['title' => 'Tasarım ve Üretim Süreçleri | Vista Moda Tekstil', 'description' => 'Ürün geliştirme, kumaş ve aksesuar, kalıp, numune, kesim, dikim, kalite kontrol ve paketleme süreçleri.'],
        'eyebrow' => 'Tasarım',
        'title' => 'Tasarım ve Üretim Süreçleri',
        'intro' => 'Koleksiyon fikrini teknik olarak üretilebilir bir ürüne dönüştüren süreci; pazar takibinden kumaş seçimine, kalıp ve numuneden final kontrole kadar planlı biçimde yönetiyoruz.',
        'sections' => [
            ['asset' => 'design', 'title' => 'Tasarım ve ürün geliştirme', 'text' => 'Uluslararası fuarları, trend raporlarını ve sektörel gelişmeleri izleyerek koleksiyonun hedef pazarına uygun model ve ürün alternatifleri geliştiririz. Müşterinin yönlendirmeleri, referansları ve teknik ihtiyaçları geliştirme planının temelini oluşturur.'],
            ['asset' => 'fabric', 'title' => 'Kumaş ve aksesuar', 'text' => 'Yerel ve uluslararası kumaş, desen ve aksesuar tedarikçileriyle çalışır; kalite, tuşe, gramaj, renk, baskı ve maliyet dengesini değerlendiririz. Gerekli olduğunda kumaş kalitesini geliştirir ve müşteriye uygulanabilir alternatifler sunarız.'],
            ['asset' => 'pattern', 'title' => 'Kalıp geliştirme', 'text' => 'Modelin formu, ölçüleri, dikiş detayları ve teknik yapısı deneyimli modelistlerimiz tarafından değerlendirilir. Kalıplar şirket içinde hazırlanır; görünüm, uyum ve üretilebilirlik için gerekli düzenlemeler yapılır.'],
            ['asset' => 'sampling', 'title' => 'Modelhane ve numune', 'text' => 'Kumaş ve aksesuarlar netleştikten sonra numune hazırlanır. Numune zamanlaması planlanır, teknik detaylar kontrol edilir ve müşteri geri bildirimleri doğrultusunda revizyonlar hızlı ve doğru biçimde uygulanır.'],
            ['asset' => 'cutting', 'title' => 'Kesim', 'text' => 'Onaylı kalıp ve üretim planına göre serim ve kesim hazırlığı yapılır. Parça yerleşimi, kumaş yönü, model detayları ve üretim adedi kesim öncesinde kontrol edilir.'],
            ['asset' => 'sewing', 'title' => 'Dikim', 'text' => 'Kesilen parçalar modelin operasyon sırasına göre birleştirilir. Üretim sırasında dikiş kalitesi, ölçüler ve kritik ürün detayları ara kontrollerle takip edilir; müşteriyle süreç iletişimi sürdürülür.'],
            ['asset' => 'quality', 'title' => 'Kalite kontrol', 'text' => 'Ara kalite kontrolleri üretim devam ederken yapılır. Final kontrolde ölçü, dikiş, görünüm, aksesuar ve ürün bütünlüğü incelenir; teslimata uygun olmayan noktalar paketleme öncesinde düzeltilir.'],
            ['asset' => 'packing', 'title' => 'Paketleme ve tamamlama', 'text' => 'Kontrolü tamamlanan ürünler müşteri talimatlarına göre ütülenir, etiketlenir, katlanır ve paketlenir. Koli ve sevkiyat hazırlığı hedef teslim dönemine uygun biçimde tamamlanır.'],
        ],
    ],
    'collection' => [
        'meta' => ['title' => 'Koleksiyon | Vista Moda Tekstil', 'description' => 'Kadın, erkek ve çocuk giyim ile örme ve dokuma ürünlerden seçilmiş referans modeller.'],
        'eyebrow' => 'Koleksiyon',
        'title' => 'Bitmiş ürünler ve referans modeller',
        'intro' => 'Kadın, erkek ve çocuk giyim koleksiyonları için geliştirdiğimiz örme ve dokuma ürünlerden seçilmiş bir görünüm.',
        'categories' => ['Kadın giyim', 'Erkek giyim', 'Çocuk giyim', 'Örme', 'Dokuma'],
    ],
    'gallery' => [
        'meta' => ['title' => 'Galeri | Vista Moda Tekstil', 'description' => 'Vista Moda Tekstil tesisi, modelhane, üretim süreçleri, ürün detayları ve arşiv galerisi.'],
        'eyebrow' => 'Galeri',
        'title' => 'Tesis, üretim ve ürün arşivi',
        'intro' => 'Çalışma ortamımızı, modelhane ve üretim aşamalarını, kumaş ve ürün detaylarını geniş görsel arşivimiz üzerinden inceleyin.',
        'filters' => ['all' => 'Tümü', 'facility' => 'Tesis', 'design' => 'Tasarım ve modelhane', 'production' => 'Üretim', 'products' => 'Ürünler', 'archive' => 'Arşiv'],
    ],
    'contact' => [
        'meta' => ['title' => 'İletişim | Vista Moda Tekstil', 'description' => 'Vista Moda Tekstil merkez ofis, üretim tesisi, telefon, e-posta ve üretim talep formu.'],
        'eyebrow' => 'İletişim',
        'title' => 'Yeni üretim projenizi birlikte değerlendirelim',
        'intro' => 'Ürün grubu, model sayısı, tahmini adet ve hedef teslim dönemini paylaşın; ekibimiz üretim kapsamını değerlendirsin.',
        'formTitle' => 'Teklif ve üretim talebi',
        'formIntro' => 'Bu local aşamada form arayüzü ve veri sözleşmesi hazırdır; gerçek e-posta gönderimi henüz etkin değildir.',
        'submit' => 'Gönderim ikinci aşamada etkinleştirilecek',
        'privacy' => 'Paylaştığım bilgilerin üretim talebimin değerlendirilmesi amacıyla işlenmesini kabul ediyorum.',
        'mapTitle' => 'Adresler ve ulaşım',
    ],
];

$interiorEn = [
    'about' => [
        'meta' => ['title' => 'About | Vista Moda Tekstil', 'description' => 'Vista Moda Tekstil company history, manufacturing model, capacity, markets and sustainability approach.'],
        'eyebrow' => 'About',
        'title' => 'Direct garment manufacturing from Istanbul to international markets',
        'intro' => 'Founded in 2019 by Dilek Akkoyunlu, Vista Moda Tekstil manufactures circular-knit cut-and-sew and woven garments for womenswear, menswear and childrenswear collections.',
        'sections' => [
            ['title' => 'About Vista Tekstil', 'text' => 'As a ready-to-wear manufacturer, we manage the complete workflow from design support to shipment preparation within one production plan. Our scope covers product groups including blouses, dresses, jackets, skirts, shorts and trousers.', 'asset' => 'facility'],
            ['title' => 'Foundation and development', 'text' => 'Vista Moda Tekstil was founded in Istanbul in 2019 by Dilek Akkoyunlu, drawing on her industry experience and commitment to quality. The company combines production discipline with flexibility, transparent communication and a long-term partnership approach.', 'asset' => 'founder'],
            ['title' => 'Manufacturing approach', 'text' => 'Pattern preparation, sampling, cutting, sewing, inline inspection, final quality control and packing are managed within our production workflow. Technical requirements, delivery planning and customer feedback are followed throughout the process.', 'asset' => 'production'],
            ['title' => 'Design, R&D and product development', 'text' => 'Our R&D team follows international fabric and garment fairs, trend analysis and industry developments. We work with local and international fabric, print and trim suppliers, propose collection-specific alternatives and support the development of fabric qualities when needed.', 'asset' => 'design'],
            ['title' => 'Pattern room and sampling', 'text' => 'Our pattern room reviews technical garment details, prepares patterns in-house and manages a fast, accurate sampling process. Experienced pattern makers develop alternatives to improve appearance, feasibility and production efficiency.', 'asset' => 'sampling'],
            ['title' => 'Capacity and flexible production', 'text' => 'Monthly in-house production capacity is 5,000 pieces and total monthly capacity is 35,000 pieces. Minimum order quantity is 100 pieces, subject to fabric-supplier limits. Where fabric minimums allow, we work flexibly with small and medium-sized brands across different quantities.', 'asset' => 'cutting'],
            ['title' => 'Markets we serve', 'text' => 'We work with brands in the United States, the United Kingdom, Germany and Turkey. For international projects, technical expectations, communication flow and target delivery periods are defined at the beginning of production planning.', 'asset' => 'markets'],
            ['title' => 'Quality, compliance and sustainability', 'text' => 'Our production network includes SEDEX and BSCI-certified partners, while fabric sourcing includes suppliers holding BCI, GRS, OCS and Oeko-Tex certifications. Project-specific documentation, sustainable material options and environmentally conscious production requests are planned before production.', 'asset' => 'quality'],
            ['title' => 'Partnership approach and mission', 'text' => 'Transparent communication, delivery discipline and fast problem solving are central to how we work. Our mission is to build lasting global partnerships by combining quality, sustainability and customer satisfaction in every production programme.', 'asset' => 'partnership'],
        ],
    ],
    'products' => [
        'meta' => ['title' => 'Products | Vista Moda Tekstil', 'description' => 'Womenswear, menswear and childrenswear product groups across knit and woven garment manufacturing.'],
        'eyebrow' => 'Products',
        'title' => 'Knit and woven products for womenswear, menswear and childrenswear collections',
        'intro' => 'Each product group is developed around the collection, from fabric and trim review through patterns, samples and bulk production.',
        'sections' => [
            ['key' => 'womenswear', 'id' => 'womenswear', 'title' => 'Womenswear', 'text' => 'We develop blouses, dresses, jackets, skirts, shorts, trousers, jumpsuits and coordinated sets around the technical structure of each collection.', 'examples' => ['Blouses and tops', 'Dresses and jumpsuits', 'Skirts, shorts and trousers', 'Jackets and sets'], 'context' => 'Circular-knit cut-and-sew and woven fabric options are available.'],
            ['key' => 'menswear', 'id' => 'menswear', 'title' => 'Menswear', 'text' => 'We support style development and production for T-shirts, polos, sweatshirts, trousers, outerwear and collection-specific menswear products.', 'examples' => ['T-shirts and polos', 'Sweatshirts and tops', 'Trousers and shorts', 'Jackets and outerwear'], 'context' => 'Knit and woven products are planned around target use and commercial positioning.'],
            ['key' => 'kidswear', 'id' => 'childrenswear', 'title' => 'Childrenswear', 'text' => 'For babywear and childrenswear, we develop knit and woven styles with attention to movement, garment details and collection consistency.', 'examples' => ['Baby rompers and sets', 'T-shirts and sweatshirts', 'Dresses and bottoms', 'Jackets and outerwear'], 'context' => 'Fabric, trims and product details are reviewed against the technical needs of the childrenswear collection.'],
            ['key' => 'knitwear', 'id' => 'knit-products', 'title' => 'Knit Products', 'text' => 'We develop circular-knit cut-and-sew garments around style, weight, surface, print and trim requirements.', 'examples' => ['T-shirts and vests', 'Sweatshirts and joggers', 'Dresses and sets', 'Polos and casual tops'], 'context' => 'Fabric quality, hand feel, colour and print alternatives are reviewed before sampling.'],
            ['key' => 'woven', 'id' => 'woven-products', 'title' => 'Woven Products', 'text' => 'Our woven workflow considers pattern, stitch detail, trims and silhouette together throughout product development and production.', 'examples' => ['Blouses and shirts', 'Dresses and jumpsuits', 'Skirts and trousers', 'Jackets and outerwear'], 'context' => 'Fabric structure and garment details are planned around cutting, sewing and the intended final appearance.'],
        ],
    ],
    'design' => [
        'meta' => ['title' => 'Design and Production Process | Vista Moda Tekstil', 'description' => 'Product development, fabric and trims, patterns, sampling, cutting, sewing, quality control and packing.'],
        'eyebrow' => 'Design',
        'title' => 'Design and Production Process',
        'intro' => 'We manage the planned workflow that turns a collection idea into a production-ready garment, from market insight and fabric review to patterns, samples and final inspection.',
        'sections' => [
            ['asset' => 'design', 'title' => 'Design and product development', 'text' => 'We follow international fairs, trend reports and industry developments to develop style and product alternatives for the collection’s target market. Customer direction, references and technical requirements establish the development plan.'],
            ['asset' => 'fabric', 'title' => 'Fabric and trims', 'text' => 'Working with local and international fabric, print and trim suppliers, we review quality, hand feel, weight, colour, print and cost. When required, we support fabric quality development and present practical alternatives.'],
            ['asset' => 'pattern', 'title' => 'Pattern development', 'text' => 'Experienced pattern makers review silhouette, measurements, stitch details and technical construction. Patterns are prepared in-house and adjusted for appearance, fit and production feasibility.'],
            ['asset' => 'sampling', 'title' => 'Pattern room and sampling', 'text' => 'Once fabrics and trims are defined, samples are prepared to an agreed schedule. Technical details are checked and customer feedback is applied quickly and accurately through sample revisions.'],
            ['asset' => 'cutting', 'title' => 'Cutting', 'text' => 'Laying and cutting are prepared against the approved pattern and production plan. Marker placement, fabric direction, garment details and production quantity are checked before cutting.'],
            ['asset' => 'sewing', 'title' => 'Sewing', 'text' => 'Cut components are assembled in the planned operation sequence. Stitch quality, measurements and critical details are followed through inline checks while customer communication continues throughout production.'],
            ['asset' => 'quality', 'title' => 'Quality control', 'text' => 'Inline inspections take place during production. Final inspection covers measurements, stitching, appearance, trims and garment integrity; issues are corrected before packing.'],
            ['asset' => 'packing', 'title' => 'Packing and completion', 'text' => 'Approved garments are pressed, labelled, folded and packed to customer instructions. Carton and shipment preparation are completed in line with the target delivery period.'],
        ],
    ],
    'collection' => [
        'meta' => ['title' => 'Collection | Vista Moda Tekstil', 'description' => 'Selected reference styles across womenswear, menswear, childrenswear, knit and woven garments.'],
        'eyebrow' => 'Collection',
        'title' => 'Finished garments and reference styles',
        'intro' => 'A selected view of knit and woven garments developed for womenswear, menswear and childrenswear collections.',
        'categories' => ['Womenswear', 'Menswear', 'Childrenswear', 'Knit', 'Woven'],
    ],
    'gallery' => [
        'meta' => ['title' => 'Gallery | Vista Moda Tekstil', 'description' => 'Vista Moda Tekstil facility, pattern room, production process, garment details and visual archive.'],
        'eyebrow' => 'Gallery',
        'title' => 'Facility, production and garment archive',
        'intro' => 'Explore our working environment, pattern room, production stages, fabric details and garments through the wider visual archive.',
        'filters' => ['all' => 'All', 'facility' => 'Facility', 'design' => 'Design and pattern room', 'production' => 'Production', 'products' => 'Products', 'archive' => 'Archive'],
    ],
    'contact' => [
        'meta' => ['title' => 'Contact | Vista Moda Tekstil', 'description' => 'Vista Moda Tekstil head office, production facility, phone, email and manufacturing enquiry form.'],
        'eyebrow' => 'Contact',
        'title' => 'Let’s review your next production project',
        'intro' => 'Share the product category, number of styles, estimated quantity and target delivery period so our team can review the manufacturing scope.',
        'formTitle' => 'Quotation and production enquiry',
        'formIntro' => 'The form interface and data contract are ready locally; live email delivery is not enabled at this stage.',
        'submit' => 'Submission will be enabled in phase two',
        'privacy' => 'I agree that the information I provide may be processed to evaluate my production enquiry.',
        'mapTitle' => 'Addresses and directions',
    ],
];

return [
    'pages' => [
        'home' => ['tr' => $homeTr, 'en' => $homeEn],
    ],
    'interiors' => ['tr' => $interiorTr, 'en' => $interiorEn],
    'assets' => $assets,
    'schema' => [
        'organization' => [
            '@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'Vista Moda Tekstil',
            'url' => 'https://www.vistatekstil.com/', 'email' => 'info@vistatekstil.com', 'telephone' => '+90 212 880 73 99',
            'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Cumhuriyet Mah. Turgut Özal Bulvarı No: 129', 'addressLocality' => 'Büyükçekmece', 'addressRegion' => 'İstanbul', 'addressCountry' => 'TR'],
        ],
    ],
];
