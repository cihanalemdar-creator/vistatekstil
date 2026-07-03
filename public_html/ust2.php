<?php
ini_set('max_execution_time', 0); 
$dir = './inc/';
require_once $dir."database.php";
require_once $dir."DW_class.php";
$dw = new DWDB();
require_once $dir."fonksiyonlar.php"; // fonksiyonlar php sayfasını include ettik
require_once $dir."kgPager.class.php";
  
$iletisimveri = $dw->getRow('SELECT * FROM iletisim WHERE id = ?', array('bindValues' => array(1))); 
$seoveri = $dw->getRow('SELECT * FROM seoayari WHERE id = ?', array('bindValues' => array(1))); 
?>

<?php
	session_start();
	//* İlk Girişte Dili Session İle Tanımlıyoruz
	if($_SESSION["dili"] == "en"){
	  require_once "diller/en.php";
	  
	}else{
	  require_once "diller/tr.php";
	}
//* İlk Girişte Dili Session İle Tanımlıyoruz

//* Dil için değişkenimiz
	
	function dil($tr= "", $en= ""){
		
		if($_SESSION["dili"] == "en"){
			return $en;
						
		}
		else{
			return $tr;
		}
	}
//* Dil için değişkenimiz
?>
<!doctype html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php require_once $dir."meta.php";  ?>
	<base href="<?php echo $iletisimveri->baseurl; ?>"/>
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="favicon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
	
	<script type="text/javascript">
			function tr(){ 
				$.post('dil.php?lang=tr', function(r){
					window.location.reload();
				});
			}
			function en(){ 
				$.post('dil.php?lang=en', function(r){
					window.location.reload();
				});
			}
	</script>

</head>

<body>

    <div class="preloader ">
        <button class="th-btn style2 preloaderCls"><?php echo dil('Kapat','Cancel Preloader');?> </button>
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div>
    <!--==============================
    Mobile Menu
  ============================== -->
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="<?php echo $iletisimveri->baseurl; ?>">
					<img src="assets/img/logo-2.png" alt="<?php echo $seoveri->title; ?>" title="<?php echo $seoveri->title; ?>">
				</a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <li><a href="<?php echo $iletisimveri->baseurl; ?>"><?php echo dil('Anasayfa','Home');?></a></li>
					<li><a href="kurumsal"><?php echo dil('Kurumsal','About Us');?></a></li>
                    <li><a href="urunler"><?php echo dil('Ürünlerimiz','Products');?></a></li>
					<li><a href="tasarim"><?php echo dil('Tasarım ve Geliştirme','Design and Development');?></a></li>
					<li><a href="koleksiyon/referans"><?php echo dil('Koleksiyon','Collection');?></a></li>
                    <li><a href="galeri/galerim2"><?php echo dil('Galeri','Gallery');?></a></li>
					<li><a href="iletisim"><?php echo dil('İletişim','Contact');?></a></li>
                </ul>
            </div>
        </div>
    </div>
	
    <header class="th-header header-layout1">
        <div class="sticky-wrapper">
		
            <div class="menu-area">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="<?php echo $iletisimveri->baseurl; ?>">
									<img src="assets/img/logo-3.png" alt="<?php echo $seoveri->title; ?>" title="<?php echo $seoveri->title; ?>">
								</a>
                            </div>
                        </div>
                        <div class="col-auto me-xxl-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li><a href="<?php echo $iletisimveri->baseurl; ?>"><?php echo dil('Anasayfa','Home');?></a></li>
									<li><a href="kurumsal"><?php echo dil('Kurumsal','About Us');?></a></li>
									<li><a href="urunler"><?php echo dil('Ürünlerimiz','Products');?></a></li>
									<li><a href="tasarim"><?php echo dil('Tasarım ve Geliştirme','Design and Development');?></a></li>
									<li><a href="koleksiyon/referans"><?php echo dil('Koleksiyon','Collection');?></a></li>
									<li><a href="galeri/galerim2"><?php echo dil('Galeri','Gallery');?></a></li>
									<li><a href="iletisim"><?php echo dil('İletişim','Contact');?></a></li>
                                </ul>
                            </nav>
                            <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="header-button">
                                <div class="header-info">
                                    <a href="javascript:;" onclick="tr();" style="width: 35px;"><img src="tr.png"/></a>
									<a href="javascript:;" onclick="en();" style="width: 35px;"><img src="en.png"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>