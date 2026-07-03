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
									<li class="at-active"><span><?php echo dil('İletişim','Contact');?></span></li>
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
			<div class="at-contactusvtwo">
				<section class="at-sectionspace at-bglight at-haslayout">
					<div class="container">
						<div class="row">
							<div class="at-content">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
									<div class="at-colcontact">
										<span class="at-contacticon"><i class="icon-telephone114"></i></span>
										<h2><?php echo dil('Bize Ulaşın','Contact');?></h2>
										<span>Vista Moda Tekstil Reklamcılık San.Tic.Ltd.Şti.</span>
										<span>Cumhuriyet Mahallesi Turgut Özal Bulvarı</span>
										<span>No: 129 Büyükçekmece / İstanbul</span>
										<span>+90 212 880 73 99</span>
										<span>+90 542 389 28 96</span>
										<span><a href="mailto:info@vistatekstil.com">info@vistatekstil.com</a></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="at-haslayout">
					<div class="at-content">
						<div class="at-locationmap">
						<br>						</br>
						<br>						</br>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1505.2047734319044!2d28.61747541029331!3d41.0162950960673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b55f72933d97cb%3A0xa2077abad3134c0a!2sVista%20Moda%20Tekstil!5e0!3m2!1str!2str!4v1691475242945!5m2!1str!2str" width="100%" height="750" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
						<form class="at-formtheme at-formcontacus">
							<div class="at-sectiontitleborder">
								<h2><?php echo dil('İletişim Formu','Contact Form');?></h2>
							</div>
							<fieldset>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
										<div class="form-group">
											<input type="text" name="name" class="form-control" placeholder="<?php echo dil('Adınız Soyadınız','Name And Surname');?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
										<div class="form-group">
											<input type="email" name="emailaddress" class="form-control" placeholder="<?php echo dil('Email Adresiniz','Email');?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
										<div class="form-group">
											<input type="text" name="phonenumber" class="form-control" placeholder="<?php echo dil('Telefon','Telephone');?>">
											
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
										<div class="form-group">
											<textarea name="message" class="form-control" placeholder="<?php echo dil('Mesajınız','Message');?>"></textarea>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
										<button type="button" class="at-btn"><?php echo dil('Gönder','Send');?></button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</section>
			</div>
		</main>
		<!--************************************
				Main End
		*************************************-->
<?php
	include "alt.php";
?>