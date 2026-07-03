<?php
	include "ust.php";
	$id = intval( $_GET[id] );    

	$veri2 = $dw->getRow('SELECT * FROM urunler WHERE id = ?', array('bindValues' => array($id)));
?>
		<!--************************************
				Home Slider Start
		*************************************-->
		<div class="at-innerbanner at-innerbannervtwo">
			<div class="at-innerbannerbox">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="at-innerbannercontent">
								<ol class="at-breadcrumb">
									<li><a href="/"><?php echo dil('Anasayfa','Home page');?></a></li>
									<li class="at-active"><span><?php echo dil('Ürünler','Products');?></span></li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--************************************
				Home Slider End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="at-main" class="at-main at-haslayout at-pagespace">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="at-content">
							<div class="at-services at-servicesvone">
								<div class="row">
								
									<?php
										$sorgu = "Select * from urunler order by id asc";
										$list = $dw->getResults(''.$sorgu.'');
										foreach($list as $row){
										$link = "urunler-detay/".$row->id."/".seo_link($row->baslik).".html";
									?>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 pull-left">
										<div class="at-service">
										
											<figure class="at-featureimg">
												<a href="<?php echo $link;?>">
													<img src="yukleme/urunler/<?php echo $row->resim;?>" alt="<?php echo dil($row->baslik, $row->baslikEN);?>">
												</a>
											</figure>
											
											<div class="at-title">
												<h3><a href="<?php echo $link;?>"><?php echo dil($row->baslik, $row->baslikEN);?></a></h3>
											</div>
											<div class="at-description">
												<p>
												
												<?php
													$aciklama=substr($row->aciklama,0,85) . "...";
													$aciklamaen=substr($row->aciklamaEN,0,85) . "...";

													$aciklamam = dil($aciklama, $aciklamaen);

													echo $aciklamam;
												?>
												
												</p>
											</div>
											<a class="at-btnreadmore" href="<?php echo $link;?>"><?php echo dil('Devamı','More');?></a>
										</div>
									</div>
									<?php } ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!--************************************
				Main End
		*************************************-->
<?php
	include "alt.php";
?>