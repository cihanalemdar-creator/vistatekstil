<?php
	$konum = "urunler";
	include "ust2.php";
	
	$link = trim($_GET["link"]);
    $link= strip_tags($link);
	
	$veri = $dw->getRow('SELECT * FROM urunler WHERE url = ?', array('bindValues' => array($link)));
	$id = $veri->id;
	$kategoriid = $veri->id;
?>

	 <div class="breadcumb-wrapper " data-bg-src="yukleme/anasayfa/8.jpg" data-overlay="black" data-opacity="8">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?php echo dil('Ürünlerimiz','Products');?></h1>
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
                
					$sorgu = "Select * from urunkategoriler order by id asc";
					$list = $dw->getResults(''.$sorgu.'');
					foreach($list as $row){
					$link = $row->url;	
																	
				?>
                
				<div class="col-md-6 col-lg-4 cat1">
                    <div class="project-card style-2">
                        <div class="project-img">
                            <a href="<?php echo $link;?>" tabindex="-1">
                                <img src="yukleme/urunler/<?php echo $row->resim; ?>" alt="image">
                            </a>
                        </div>
                        <div class="project-content">
                            <a href="<?php echo $link;?>" tabindex="-1"><i class="fa-light fa-arrow-up-right"></i></a>
                            <h4 class="project-title">
								<a href="<?php echo $link;?>"><?php echo dil ($row->urunkategori,$row->urunkategoriEN);?></a>
							</h4>
                        </div>
                    </div>
					<a href="<?php echo $link;?>">
						<p style="text-align: center; font-size: 22px; font-weight: 500; margin-top: 10px;"><?php echo dil ($row->baslik,$row->baslikEN);?></p>
					</a>
                </div>
				
				<?php } ?>
				
            </div>
        </div>
    </section>

	

<?php
	include "alt.php"
?>