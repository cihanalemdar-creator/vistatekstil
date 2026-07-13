<?php

return [
    'lastModified' => '2026-07-13',
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
                'de' => ['path' => '/de/', 'navigationLabel' => 'Startseite', 'title' => 'Startseite', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/', 'navigationLabel' => 'Inicio', 'title' => 'Inicio', 'publicationStatus' => 'published'],
            ],
        ],
        'about' => [
            'template' => 'about',
            'activeNavigationKey' => 'about',
            'breadcrumb' => true,
            'sectionNavigation' => ['source' => 'interior.sections', 'idField' => 'asset'],
            'locales' => [
                'tr' => ['path' => '/kurumsal', 'navigationLabel' => 'Kurumsal', 'title' => 'Kurumsal', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/about', 'navigationLabel' => 'About', 'title' => 'About', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/unternehmen', 'navigationLabel' => 'Unternehmen', 'title' => 'Unternehmen', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/empresa', 'navigationLabel' => 'Empresa', 'title' => 'Empresa', 'publicationStatus' => 'published'],
            ],
        ],
        'products' => [
            'template' => 'products',
            'activeNavigationKey' => 'products',
            'breadcrumb' => true,
            'sectionNavigation' => ['source' => 'interior.sections', 'idField' => 'id'],
            'locales' => [
                'tr' => ['path' => '/urunler', 'navigationLabel' => 'Ürünler', 'title' => 'Ürünler', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/products', 'navigationLabel' => 'Products', 'title' => 'Products', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/produkte', 'navigationLabel' => 'Produkte', 'title' => 'Produkte', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/productos', 'navigationLabel' => 'Productos', 'title' => 'Productos', 'publicationStatus' => 'published'],
            ],
        ],
        'design' => [
            'template' => 'design',
            'activeNavigationKey' => 'design',
            'breadcrumb' => true,
            'sectionNavigation' => ['source' => 'interior.sections', 'idField' => 'asset'],
            'locales' => [
                'tr' => ['path' => '/tasarim', 'navigationLabel' => 'Tasarım', 'title' => 'Tasarım', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/design', 'navigationLabel' => 'Design', 'title' => 'Design', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/design', 'navigationLabel' => 'Design', 'title' => 'Design', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/diseno', 'navigationLabel' => 'Diseño', 'title' => 'Diseño', 'publicationStatus' => 'published'],
            ],
        ],
        'collection' => [
            'template' => 'collection',
            'activeNavigationKey' => 'collection',
            'breadcrumb' => true,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/koleksiyon/referans', 'navigationLabel' => 'Koleksiyon', 'title' => 'Koleksiyon', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/collection', 'navigationLabel' => 'Collection', 'title' => 'Collection', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/kollektion', 'navigationLabel' => 'Kollektion', 'title' => 'Kollektion', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/coleccion', 'navigationLabel' => 'Colección', 'title' => 'Colección', 'publicationStatus' => 'published'],
            ],
        ],
        'gallery' => [
            'template' => 'gallery',
            'activeNavigationKey' => 'gallery',
            'breadcrumb' => true,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/galeri/galerim2', 'navigationLabel' => 'Galeri', 'title' => 'Galeri', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/gallery', 'navigationLabel' => 'Gallery', 'title' => 'Gallery', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/galerie', 'navigationLabel' => 'Galerie', 'title' => 'Galerie', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/galeria', 'navigationLabel' => 'Galería', 'title' => 'Galería', 'publicationStatus' => 'published'],
            ],
        ],
        'contact' => [
            'template' => 'contact',
            'activeNavigationKey' => 'contact',
            'breadcrumb' => true,
            'sectionNavigation' => false,
            'locales' => [
                'tr' => ['path' => '/iletisim', 'navigationLabel' => 'İletişim', 'title' => 'İletişim', 'publicationStatus' => 'published'],
                'en' => ['path' => '/en/contact', 'navigationLabel' => 'Contact', 'title' => 'Contact', 'publicationStatus' => 'published'],
                'de' => ['path' => '/de/kontakt', 'navigationLabel' => 'Kontakt', 'title' => 'Kontakt', 'publicationStatus' => 'published'],
                'es' => ['path' => '/es/contacto', 'navigationLabel' => 'Contacto', 'title' => 'Contacto', 'publicationStatus' => 'published'],
            ],
        ],
    ],
];
