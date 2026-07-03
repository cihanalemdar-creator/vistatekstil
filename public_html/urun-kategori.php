<?php
	$konum = "urun-kategori";
	include "ust2.php";
	
	$link = trim($_GET["link"]);
    $link= strip_tags($link);
	
	$veri = $dw->getRow('SELECT * FROM urunkategoriler WHERE url = ?', array('bindValues' => array($link)));
	$id = $veri->id;
	$kategoriid = $veri->id;
?>

	 <div class="breadcumb-wrapper " data-bg-src="yukleme/anasayfa/8.jpg" data-overlay="black" data-opacity="8">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?php echo dil ($veri->urunkategori,$veri->urunkategoriEN);?></h1>
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

						$sorgu = "Select * from urunler where kategori='$kategoriid'  order by id asc";
                        $list = $dw->getResults(''.$sorgu.'');                 
                        if(!$list)
                          {
                ?>
				
				<div class="alert alert-warning" role="alert" style="padding-bottom: 100px; padding-top: 100px; text-align: center; font-size: 18px; font-weight: 600; color: #f60e0e;">
                           <b><?php echo dil('Bu kategoriye ait ürün bulunamadı!','No products found for this category!');?></b>
						</div>
						
						<?php 
                        } else {

						foreach($list as $row){
                        $link = $row->url;       
                  
				?>
                
				<div class="col-md-6 col-lg-4 cat1">
                    <div class="project-img">
						<a href="<?php echo $link;?>">
							<img src="yukleme/urunler/<?php echo $row->resim; ?>" alt="image">
						</a>
					</div>
					<a href="<?php echo $link;?>">
						<p style="text-align: center; font-size: 22px; font-weight: 500; margin-top: 10px;"><?php echo dil($row->baslik,$row->baslikEN);?></p>
					</a>
                </div>
				
				<?php }} ?>
				
            </div>
        </div>
    </section>

	

<?php
	include "alt.php"
?>