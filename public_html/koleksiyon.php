<?php
	$konum = "koleksiyon";
	include "ust2.php";
	
	$link =trim($_GET["link"]);
    $link=strip_tags($link);  
	$veri = $dw->getRow('SELECT * FROM referanslar WHERE url = ?', array('bindValues' => array($link)));
	
    $id = $veri->id;
    $urunid = $veri->id;
?>

	 <div class="breadcumb-wrapper " data-bg-src="yukleme/anasayfa/8.jpg" data-overlay="black" data-opacity="8">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?php echo dil('Koleksiyon','Collection');?></h1>
                <ul class="breadcumb-menu">
                    <li><a href="<?php echo $iletisimveri->baseurl; ?>"><?php echo dil('Anasayfa','Home');?></a></li>
					<li><a href="koleksiyon"><?php echo dil('Koleksiyon','Collection');?></a></li>
                </ul>
            </div>
        </div>
    </div>
	
	<section class="space">
        <div class="container">
		
            <div class="row gy-4">
                
				<?php
					$rsorgu = "Select * from referansresimler WHERE urunid='$id'";
					$rlist = $dw->getResults(''.$rsorgu.'');
					foreach($rlist as $rrow){
				?>
				
				<div class="col-md-6 col-lg-4 cat1">
                    <div class="project-card style-2">
                        <div class="project-img">
                            <img src="yukleme/referanslar/<?php echo $rrow->resim; ?>" alt="image">
                        </div>
                        <div class="project-content">
                            <a href="yukleme/referanslar/<?php echo $rrow->resim; ?>" class="icon-btn popup-image" tabindex="-1"><i class="fa-light fa-arrow-up-right"></i></a>
                        </div>
                    </div>
                </div>				
				
				<?php } ?>
				
            </div>
        </div>
    </section>
	

	

<?php
	include "alt.php"
?>