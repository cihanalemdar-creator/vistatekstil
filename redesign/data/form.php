<?php
declare(strict_types=1);

return [
    'labels' => [
        'tr' => [
            'name' => 'Ad Soyad', 'company' => 'Şirket / Marka', 'country' => 'Ülke', 'email' => 'E-posta',
            'phone' => 'Telefon / WhatsApp', 'category' => 'Ürün kategorisi', 'fabricType' => 'Ürünün yapısı',
            'quantity' => 'Tahmini sipariş miktarı', 'styles' => 'Model sayısı', 'delivery' => 'Hedef teslim dönemi',
            'techPack' => 'Tech pack mevcut mu?', 'sample' => 'Referans numune mevcut mu?', 'subject' => 'Konu',
            'message' => 'Mesaj', 'file' => 'Dosya yükleme', 'choose' => 'Seçiniz', 'yes' => 'Evet', 'no' => 'Hayır',
            'knit' => 'Örme', 'woven' => 'Dokuma', 'both' => 'Her ikisi', 'required' => 'Zorunlu alan',
            'details' => 'Ek proje detayları', 'detailsHint' => 'Ülke, ürün yapısı, model ve teknik hazırlık bilgileri',
        ],
        'en' => [
            'name' => 'Full name', 'company' => 'Company / Brand', 'country' => 'Country', 'email' => 'Email',
            'phone' => 'Phone / WhatsApp', 'category' => 'Product category', 'fabricType' => 'Product construction',
            'quantity' => 'Estimated order quantity', 'styles' => 'Number of styles', 'delivery' => 'Target delivery period',
            'techPack' => 'Is a tech pack available?', 'sample' => 'Is a reference sample available?', 'subject' => 'Subject',
            'message' => 'Message', 'file' => 'File upload', 'choose' => 'Select', 'yes' => 'Yes', 'no' => 'No',
            'knit' => 'Knit', 'woven' => 'Woven', 'both' => 'Both', 'required' => 'Required field',
            'details' => 'Additional project details', 'detailsHint' => 'Country, construction, styles and technical preparation',
        ],
        'de' => [
            'name' => 'Vor- und Nachname', 'company' => 'Unternehmen / Marke', 'country' => 'Land', 'email' => 'E-Mail',
            'phone' => 'Telefon / WhatsApp', 'category' => 'Produktgruppe', 'fabricType' => 'Produktkonstruktion',
            'quantity' => 'Geschätzte Bestellmenge', 'styles' => 'Anzahl der Modelle', 'delivery' => 'Gewünschter Lieferzeitraum',
            'techPack' => 'Ist ein Tech Pack vorhanden?', 'sample' => 'Ist ein Referenzmuster vorhanden?', 'subject' => 'Betreff',
            'message' => 'Nachricht', 'file' => 'Datei hochladen', 'choose' => 'Bitte wählen', 'yes' => 'Ja', 'no' => 'Nein',
            'knit' => 'Strick', 'woven' => 'Webware', 'both' => 'Beides', 'required' => 'Pflichtfeld',
            'details' => 'Weitere Projektdetails', 'detailsHint' => 'Land, Konstruktion, Modelle und technische Vorbereitung',
        ],
        'es' => [
            'name' => 'Nombre completo', 'company' => 'Empresa / Marca', 'country' => 'País', 'email' => 'Correo electrónico',
            'phone' => 'Teléfono / WhatsApp', 'category' => 'Categoría de producto', 'fabricType' => 'Construcción del producto',
            'quantity' => 'Cantidad estimada', 'styles' => 'Número de modelos', 'delivery' => 'Periodo de entrega objetivo',
            'techPack' => '¿Dispone de ficha técnica?', 'sample' => '¿Dispone de muestra de referencia?', 'subject' => 'Asunto',
            'message' => 'Mensaje', 'file' => 'Adjuntar archivo', 'choose' => 'Seleccionar', 'yes' => 'Sí', 'no' => 'No',
            'knit' => 'Punto', 'woven' => 'Tejido plano', 'both' => 'Ambos', 'required' => 'Campo obligatorio',
            'details' => 'Detalles adicionales del proyecto', 'detailsHint' => 'País, construcción, modelos y preparación técnica',
        ],
    ],
    'groups' => [
        'basic' => ['name', 'company', 'email', 'category', 'quantity', 'message', 'file'],
        'details' => ['country', 'phone', 'fabricType', 'styles', 'delivery', 'techPack', 'sample', 'subject'],
    ],
    'fields' => [
        'name' => ['type' => 'text', 'required' => true, 'autocomplete' => 'name'],
        'company' => ['type' => 'text', 'required' => true, 'autocomplete' => 'organization'],
        'country' => ['type' => 'text', 'required' => false, 'autocomplete' => 'country-name'],
        'email' => ['type' => 'email', 'required' => true, 'autocomplete' => 'email'],
        'phone' => ['type' => 'tel', 'required' => false, 'autocomplete' => 'tel'],
        'category' => [
            'type' => 'select', 'required' => true,
            'options' => [
                'womenswear' => ['tr' => 'Kadın giyim', 'en' => 'Womenswear', 'de' => 'Damenbekleidung', 'es' => 'Moda mujer'],
                'menswear' => ['tr' => 'Erkek giyim', 'en' => 'Menswear', 'de' => 'Herrenbekleidung', 'es' => 'Moda hombre'],
                'childrenswear' => ['tr' => 'Çocuk giyim', 'en' => 'Childrenswear', 'de' => 'Kinderbekleidung', 'es' => 'Moda infantil'],
            ],
        ],
        'fabricType' => [
            'type' => 'select', 'required' => false,
            'options' => [
                'knit' => ['labelKey' => 'knit'], 'woven' => ['labelKey' => 'woven'], 'both' => ['labelKey' => 'both'],
            ],
        ],
        'quantity' => ['type' => 'number', 'required' => true, 'min' => 1, 'inputmode' => 'numeric'],
        'styles' => ['type' => 'number', 'required' => false, 'min' => 1, 'inputmode' => 'numeric'],
        'delivery' => ['type' => 'text', 'required' => false],
        'techPack' => ['type' => 'select', 'required' => false, 'options' => ['yes' => ['labelKey' => 'yes'], 'no' => ['labelKey' => 'no']]],
        'sample' => ['type' => 'select', 'required' => false, 'options' => ['yes' => ['labelKey' => 'yes'], 'no' => ['labelKey' => 'no']]],
        'subject' => ['type' => 'text', 'required' => false],
        'message' => ['type' => 'textarea', 'required' => true, 'rows' => 6],
        'file' => [
            'type' => 'file',
            'required' => false,
            'accept' => '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.zip',
            'help' => [
                'tr' => 'PDF, DOCX, XLSX, JPG, PNG veya ZIP; en fazla 2 MB',
                'en' => 'PDF, DOCX, XLSX, JPG, PNG or ZIP; up to 2 MB',
                'de' => 'PDF, DOCX, XLSX, JPG, PNG oder ZIP; bis 2 MB',
                'es' => 'PDF, DOCX, XLSX, JPG, PNG o ZIP; hasta 2 MB',
            ],
        ],
    ],
];
