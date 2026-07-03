<?php

	include "ust.php";

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
									<li><a href="/"><?php echo dil('Anasayfa','Home Page');?></a></li>
									<li class="at-active"><span><?php echo dil('Kurumsal','Corporate');?></span></li>
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
		<main id="at-main" class="at-main at-haslayout">
			<section class="at-sectionspace at-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						
								<?php
									$sorgu = "select* from hakkimizda order by id desc LIMIT 1";
									$listele = $dw->getResults(''.$sorgu.'');
									foreach($listele as $veri){
								?>
							
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="at-textcontent">
											<h2><?php echo dil($veri->baslik, $veri->baslikEN);?></h2>
											<div class="at-description">
												<p><?php echo nl2br(dil($veri->detay, $veri->detayEN));?></p><br><br>
												<img src="logolar.png" />
											</div>
										</div>
									</div>
								</div>
								
								<?php } ?>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!--************************************
				Main End
		*************************************-->

<?php

	include "alt.php";

?>