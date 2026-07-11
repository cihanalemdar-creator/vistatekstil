<?php
declare(strict_types=1);

return [
    'navigationOrder' => ['home', 'about', 'products', 'design', 'collection', 'gallery', 'contact'],
    'pages' => [
        'home' => [
            'template' => 'home',
            'activeNavigationKey' => 'home',
            'breadcrumb' => false,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/', 'navigationLabel' => 'Ana Sayfa', 'title' => 'Ana Sayfa', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/', 'navigationLabel' => 'Home', 'title' => 'Home', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/', 'navigationLabel' => 'Startseite', 'title' => 'Startseite', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/', 'navigationLabel' => 'Inicio', 'title' => 'Inicio', 'publicationStatus' => 'unavailable'],
            ],
        ],
        'about' => [
            'template' => 'about',
            'activeNavigationKey' => 'about',
            'breadcrumb' => true,
            'sectionNavigation' => ['source' => 'interior.sections', 'idField' => 'asset'],
            'locales' => [
                'tr' => ['path' => '/kurumsal', 'navigationLabel' => 'Kurumsal', 'title' => 'Kurumsal', 'publicationStatus' => 'draft'],
                'en' => ['path' => '/en/about', 'navigationLabel' => 'About', 'title' => 'About', 'publicationStatus' => 'draft'],
                'de' => ['path' => '/de/unternehmen', 'navigationLabel' => 'Unternehmen', 'title' => 'Unternehmen', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/empresa', 'navigationLabel' => 'Empresa', 'title' => 'Empresa', 'publicationStatus' => 'unavailable'],
            ],
        ],
        'products' => [
            'template' => 'products',
            'activeNavigationKey' => 'products',
            'breadcrumb' => true,
            'sectionNavigation' => ['source' => 'interior.sections', 'idField' => 'id'],
            'locales' => [
                'tr' => ['path' => '/urunler', 'navigationLabel' => 'Ürünler', 'title' => 'Ürünler', 'publicationStatus' => 'draft'],
                'en' => ['path' => '/en/products', 'navigationLabel' => 'Products', 'title' => 'Products', 'publicationStatus' => 'draft'],
                'de' => ['path' => '/de/produkte', 'navigationLabel' => 'Produkte', 'title' => 'Produkte', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/productos', 'navigationLabel' => 'Productos', 'title' => 'Productos', 'publicationStatus' => 'unavailable'],
            ],
        ],
        'design' => [
            'template' => 'design',
            'activeNavigationKey' => 'design',
            'breadcrumb' => true,
            'sectionNavigation' => ['source' => 'interior.sections', 'idField' => 'asset'],
            'locales' => [
                'tr' => ['path' => '/tasarim', 'navigationLabel' => 'Tasarım', 'title' => 'Tasarım', 'publicationStatus' => 'draft'],
                'en' => ['path' => '/en/design', 'navigationLabel' => 'Design', 'title' => 'Design', 'publicationStatus' => 'draft'],
                'de' => ['path' => '/de/design', 'navigationLabel' => 'Design', 'title' => 'Design', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/diseno', 'navigationLabel' => 'Diseño', 'title' => 'Diseño', 'publicationStatus' => 'unavailable'],
            ],
        ],
        'collection' => [
            'template' => 'collection',
            'activeNavigationKey' => 'collection',
            'breadcrumb' => true,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/koleksiyon/referans', 'navigationLabel' => 'Koleksiyon', 'title' => 'Koleksiyon', 'publicationStatus' => 'draft'],
                'en' => ['path' => '/en/collection', 'navigationLabel' => 'Collection', 'title' => 'Collection', 'publicationStatus' => 'draft'],
                'de' => ['path' => '/de/kollektion', 'navigationLabel' => 'Kollektion', 'title' => 'Kollektion', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/coleccion', 'navigationLabel' => 'Colección', 'title' => 'Colección', 'publicationStatus' => 'unavailable'],
            ],
        ],
        'gallery' => [
            'template' => 'gallery',
            'activeNavigationKey' => 'gallery',
            'breadcrumb' => true,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/galeri/galerim2', 'navigationLabel' => 'Galeri', 'title' => 'Galeri', 'publicationStatus' => 'draft'],
                'en' => ['path' => '/en/gallery', 'navigationLabel' => 'Gallery', 'title' => 'Gallery', 'publicationStatus' => 'draft'],
                'de' => ['path' => '/de/galerie', 'navigationLabel' => 'Galerie', 'title' => 'Galerie', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/galeria', 'navigationLabel' => 'Galería', 'title' => 'Galería', 'publicationStatus' => 'unavailable'],
            ],
        ],
        'contact' => [
            'template' => 'contact',
            'activeNavigationKey' => 'contact',
            'breadcrumb' => true,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/iletisim', 'navigationLabel' => 'İletişim', 'title' => 'İletişim', 'publicationStatus' => 'draft'],
                'en' => ['path' => '/en/contact', 'navigationLabel' => 'Contact', 'title' => 'Contact', 'publicationStatus' => 'draft'],
                'de' => ['path' => '/de/kontakt', 'navigationLabel' => 'Kontakt', 'title' => 'Kontakt', 'publicationStatus' => 'unavailable'],
                'es' => ['path' => '/es/contacto', 'navigationLabel' => 'Contacto', 'title' => 'Contacto', 'publicationStatus' => 'unavailable'],
            ],
        ],
    ],
];
