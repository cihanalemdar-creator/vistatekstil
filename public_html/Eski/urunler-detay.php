<?php
	include "ust.php";
	$id = intval( $_GET['id'] );    

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
									<?php
										$sorgu = "Select * from urunler WHERE id='$id'";
										$list = $dw->getResults(''.$sorgu.'');
										foreach($list as $row){
										$link = "urunler-detay/".$row->id."/".seo_link($row->baslik).".html";
									?>
									<li><a href="/"><?php echo dil('Anasayfa','Home page');?></a></li>
									<li class="at-active"><span><?php echo dil($row->baslik, $row->baslikEN);?></span></li>
									<?php } ?>
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
					<div class="at-content">
						<div class="at-services at-servicedetail">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pull-right">
								<aside class="at-sidebar">
									<div class="at-widget at-widgetlinking">
										<div class="at-widgetcontent">
											<ul>
												<?php
													$sorgu = "Select * from urunler order by id desc";
													$list = $dw->getResults(''.$sorgu.'');
													foreach($list as $row){
													$link = "urunler-detay/".$row->id."/".seo_link($row->baslik).".html";
												?>
												<li><a href="<?php echo $link;?>"><?php echo dil($row->baslik, $row->baslikEN);?></a></li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</aside>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 pull-left">
								<?php
									$sorgu = "Select * from urunler WHERE id='$id'";
									$list = $dw->getResults(''.$sorgu.'');
									foreach($list as $row){
									$link = "urunler-detay/".$row->id."/".seo_link($row->baslik).".html";
								?>
								<section class="at-servicedetailsection">
											
									<div class="at-content">
										<div>
											
											<?php
												$rsorgu = "Select * from urunresimler WHERE urunid='$id'";
												$rlist = $dw->getResults(''.$rsorgu.'');
												foreach($rlist as $rrow){
											?>
											<div class="at-griditem">
													<a href="yukleme/urunler/<?php echo $rrow->resim;?>" data-fancybox="images">
														<img class="example-image" src="yukleme/urunler/<?php echo $rrow->resim;?>">
													</a>
											</div>
											<?php } ?>
											
										</div>
									</div>
									
									<div class="at-sectiontitleborder" style="margin-top: 50px;">
										<h2><?php echo dil($row->baslik, $row->baslikEN);?></h2>
									</div>
									<div class="at-description">
										<p><?php echo nl2br(dil($row->aciklama, $row->aciklamaEN));?></p>
									</div>
								</section>
								<?php } ?>
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