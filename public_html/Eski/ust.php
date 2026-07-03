<?php
ini_set('max_execution_time', 0); 
$dir = './inc/';
require_once $dir."database.php";
require_once $dir."DW_class.php";
$dw = new DWDB();
require_once $dir."fonksiyonlar.php"; // fonksiyonlar php sayfasını include ettik
require_once $dir."kgPager.class.php";
  
$iletisimveri = $dw->getRow('SELECT * FROM iletisim WHERE id = ?', array('bindValues' => array(1)))     
?>
<html class="no-js" lang="tr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Vista Tekstil</title>
	<base href="https://www.vistatekstil.com/">
	<meta name="description" content="Tekstilde uzman, Vista Tekstil uzman özverili çalışanları ve müşteri memnuniyeti politikası sayesinde kalite ve istikrarın temsilcisi olmuştur.">
	<meta name="author" content="Noxe Media">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="css/prettyPhoto.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/pogoslider.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css">
	
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
<body class="at-home at-homeone">
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!--************************************
			Loader Start
	*************************************-->
	<div class="lds-roller">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
	<!--************************************
			Loader End
	*************************************-->
	<!--************************************
			Wrapper Start
	*************************************-->
	<div id="at-wrapper" class="at-wrapper">
		<!--************************************
				Header Start
		*************************************-->
		<header id="at-header" class="at-header">
			<div class="container-fluid">
				<div class="row">
					<strong class="at-logo"><a href="index.html"><img src="images/logo.png" alt="company logo here"></a></strong>
					<div class="at-navigationarea">
						<nav id="at-nav" class="at-nav">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#at-navigation" aria-expanded="false">
									<span class="sr-only">Mobil Menü</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div id="at-navigation" class="collapse navbar-collapse at-navigation">
								<ul>
									<li class="menu-item-has-children">
										<a href="index.html"><?php echo dil('Anasayfa','Home Page');?></a></li>
									<li class="menu-item-has-children">
										<a href="hakkimizda.html"><?php echo dil('Kurumsal','Corporate');?></a>
									</li>
									<li class="menu-item-has-children">
										<a href="hizmetlerimiz.html"><?php echo dil('Tasarım - Geliştirme','Design - Development');?></a>
										<ul class="sub-menu">
											<?php
													$sorgu = "Select * from hizmetler order by id desc";
													$list = $dw->getResults(''.$sorgu.'');
													foreach($list as $row){
													$link = "hizmetlerimiz-detay/".$row->id."/".seo_link($row->baslik).".html";
											?>
											<li><a href="<?php echo $link;?>"><?php echo dil($row->baslik, $row->baslikEN);?></a></li>
											<?php } ?>
										</ul>
									</li>
									<li class="menu-item-has-children">
										<a href="urunler.html"><?php echo dil('Ürünler','Products');?></a>
										<ul class="sub-menu">
											<?php
													$sorgu = "Select * from urunler order by id desc";
													$list = $dw->getResults(''.$sorgu.'');
													foreach($list as $row){
													$link = "urunler-detay/".$row->id."/".seo_link($row->baslik).".html";
											?>
											<li><a href="<?php echo $link;?>"><?php echo dil($row->baslik, $row->baslikEN);?></a></li>
											<?php } ?>
										</ul>
									</li>
									<li class="menu-item-has-children">
										<a href="iletisim.html"><?php echo dil('Bize Ulaşın','Contact');?></a>
									</li>
								</ul>
							</div>
						</nav>
						<div class="at-contactsocial">
							<span class="at-contactnumber">
								<i class="icon-telephone114"></i>
								<em>+90 212 880 73 99</em>
							</span>
							<ul class="at-socialicons">
								<li><a href="javascript:;" onclick="tr();"><img src="images/tr.png" style="padding-top: 10px;"></img></a></li>
								<li><a href="javascript:;" onclick="en();"><img src="images/en.png" style="padding-top: 10px;"></img></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>