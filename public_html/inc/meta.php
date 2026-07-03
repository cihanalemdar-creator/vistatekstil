

<?php
$seoveri = $dw->getRow('SELECT * FROM seoayari WHERE id = ?', array('bindValues' => array(1))); 

if ($konum == "genel") {
?>
		<title><?php echo $seoveri->title; ?></title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">

<?php } elseif ($konum == "kurumsal") {
?>
		<title>Kurumsal | Vista Tekstil®</title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">
		 
<?php } elseif ($konum == "tasarim") {
?>
		<title>Tasarım ve Geliştirme | Vista Tekstil®</title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">

<?php } elseif ($konum == "koleksiyon") {
?>
		<title>Koleksiyon | Vista Tekstil®</title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">


<?php } elseif ($konum == "urunler") {
?>
		<title>Ürünler | Vista Tekstil®</title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">

<?php } elseif ($konum == "galeri") {
?>
		<title>Galeri | Vista Tekstil®</title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">


<?php } elseif ($konum == "iletisim") {
?>
		<title>İletişim | Vista Tekstil®</title>
		 <meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   		 <meta name="description" content="<?php echo $seoveri->description; ?>">
   		 <meta name="author" content="Noxe Media">
	

<?php


} elseif ($konum == "urun-detay") {
    $link =trim($_GET["link"]);
    $link=strip_tags($link);
    $veri = $dw->getRow('SELECT * FROM urunler WHERE url = ?', array('bindValues' => array($link))); 
?>
	<title><?php echo $veri->baslik;?> | Vista Tekstil®</title>
	<meta name="description" content="<?php echo strip_tags(substr(($veri->aciklama),0,140)) . "...";?>" />
	<meta name="keywords" content="<?php echo $seoveri->keywords;?>" />
	<meta name="author" content="Noxe Media">

<?php


} elseif ($konum == "urun-kategori") {
    $link =trim($_GET["link"]);
    $link=strip_tags($link);
    $veri = $dw->getRow('SELECT * FROM urunkategoriler WHERE url = ?', array('bindValues' => array($link))); 
?>
	<title><?php echo dil ($veri->urunkategori,$veri->urunkategoriEN);?> | Vista Tekstil®</title>
	<meta name="keywords" content="<?php echo $seoveri->keywords; ?>" />
   	<meta name="description" content="<?php echo $seoveri->description; ?>">
	<meta name="author" content="Noxe Media">

<?php


} elseif ($konum == "galeri-detay") {
    $link =trim($_GET["link"]);
    $link=strip_tags($link);
    $veri = $dw->getRow('SELECT * FROM galeri WHERE url = ?', array('bindValues' => array($link))); 
?>
	<title><?php echo $veri->baslik;?> | Vista Tekstil®</title>
	<meta name="description" content="<?php echo strip_tags(substr(($veri->aciklama),0,140)) . "...";?>" />
	<meta name="keywords" content="<?php echo $seoveri->keywords;?>" />
	<meta name="author" content="Noxe Media">
	
	
	
<?php
} else {
?>
	<title>404 Sayfa Bulunamadı | Vista Tekstil®</title>
	<meta name="description" content="Aradığınız sayfaya ulaşılamıyor. İlgili sayfa güncellenmiş veya silinmiş olabilir. Kontrol etmek için lütfen kategori sekmesine yöneliniz. Teşekkürler." />
	<meta name="keywords" content="<?php echo $seoveri->keywords;?>" />
	<meta name="author" content="Noxe Media">
<?php
}
?>