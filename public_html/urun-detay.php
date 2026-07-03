<?php
	$konum = "urun-detay";
	include "ust2.php";
	
	$link =trim($_GET["link"]);
    $link=strip_tags($link);  
	$veri = $dw->getRow('SELECT * FROM urunler WHERE url = ?', array('bindValues' => array($link)));
	
    $id = $veri->id;
    $urunid = $veri->id;
?>

	 <div class="breadcumb-wrapper " data-bg-src="yukleme/anasayfa/8.jpg" data-overlay="black" data-opacity="8">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?php echo dil($veri->baslik,$veri->baslikEN);?></h1>
                <ul class="breadcumb-menu">
                    <li><a href="<?php echo $iletisimveri->baseurl; ?>"><?php echo dil('Anasayfa','Home');?></a></li>
					<li><a href="urunler"><?php echo dil('Ürünlerimiz','Products');?></a></li>
                </ul>
            </div>
        </div>
    </div>
	
	<section class="space">
        <div class="container">
		
            <div class="row gy-4">
			
				<?php
					$rsorgu = "Select * from urunresimler WHERE urunid='$id'";
					$rlist = $dw->getResults(''.$rsorgu.'');
					foreach($rlist as $rrow){
				?>
                
				<div class="col-md-6 col-lg-4 cat1">
                    <div class="project-card style-2">
                        <div class="project-img">
                            <img src="yukleme/urunler/<?php echo $rrow->resim; ?>" alt="image">
                        </div>
                        <div class="project-content">
                            <a href="yukleme/urunler/<?php echo $rrow->resim; ?>" class="popup-image">
								<img src="yukleme/urunler/<?php echo $rrow->resim; ?>" alt="image">
							</a>
                        </div>
                    </div>
                </div>
				
				<?php } ?>
				
				<?php
					$sorgu = "Select * from urunler WHERE id='$urunid'";
					$list = $dw->getResults(''.$sorgu.'');
						foreach($list as $row){
					$link = "category/".$row->id."/".seo_link($row->baslik).".html";
				?>
				
				<div class="col-md-12 col-lg-12 cat1">
					<p style="text-align: center; margin-top: 25px; font-size: 22px;"><?php echo dil($row->aciklama,$row->aciklamaEN);?></p>
				</div>
				
				<?php } ?>
				
            </div>
        </div>
    </section>

	

<?php
	include "alt.php"
?>