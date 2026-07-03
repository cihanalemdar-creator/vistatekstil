<?php
	$konum = "iletisim";
	include "ust2.php"
?>

	 <div class="breadcumb-wrapper " data-bg-src="yukleme/anasayfa/iletisim.jpg" data-overlay="black" data-opacity="8">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?php echo dil('İletişim','Contact');?></h1>
                <ul class="breadcumb-menu">
                    <li><a href="<?php echo $iletisimveri->baseurl; ?>"><?php echo dil('Anasayfa','Home');?></a></li>
					<li><a href="iletisim"><?php echo dil('İletişim','Contact');?></a></li>
                </ul>
            </div>
        </div>
    </div>
	
	 <div class="space-top" style="margin-bottom: 50px;">
        <div class="container">
            <div class="row gy-40">
                <div class="col-xl-4">
                    <div class="contact-info-wrap">
                        <h3 class="mb-30"><?php echo dil('İletişim','Get In Touch');?></h3>
                        <div class="contact-info">
                            <div class="contact-info_icon">
                                <i class="far fa-phone-volume"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="contact-info_title h6"><?php echo dil('Telefon','Phone');?></h4>
                                <span class="contact-info_text">
                                    <a href="tel:+902128807399">+90 212 880 73 99</a>
                                    <a href="tel:+905423892896">+90 542 389 28 96</a>
                                </span>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="contact-info_icon">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="contact-info_title h6"><?php echo dil('E-Mail','Write Email');?></h4>
                                <span class="contact-info_text">
                                    <a href="mailto:info@vistatekstil.com">info@vistatekstil.com</a>
                                </span>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="contact-info_icon">
                                <i class="far fa-location-dot"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="contact-info_title h6"><?php echo dil('Lokasyon','Location');?></h4>
                                <span class="contact-info_text">
                                    Cumhuriyet Mh. Turgut Özal Blv. No: 129 Büyükçekmece <br>
                                    İstanbul / TÜRKİYE
                                </span>
                            </div>
                        </div>
						
						<div class="contact-info">
                            <div class="contact-info_icon">
                                <i class="far fa-location-dot"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="contact-info_title h6"><?php echo dil('Üretim Fabrikası','Factory Production');?></h4>
                                <span class="contact-info_text">
                                    Zafer Mahallesi 159. Sokak <br>No:2 Kat:2 <br>
									Esenyurt / İstanbul / Turkey
                                </span>
                            </div>
                        </div>
						
                        <h6 class="social-info_title"><?php echo dil('Bizi Takip Edin','Follow Us');?></h6>
                        <div class="th-social style-white">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form action="mail.php" method="POST" class="contact-form3 ajax-contact h-100">
                        <h2 class="form-title h3 mb-30"><?php echo dil('Bize Yazın','Write a Massage');?></h2>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control style-white" name="name" id="name" placeholder="<?php echo dil('Ad Soyad','Full name');?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control style-white" name="email" id="email" placeholder="<?php echo dil('E-Mail','Email Address');?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="tel" class="form-control style-white" name="number" id="number" placeholder="<?php echo dil('Telefon','Phone Number');?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="tel" class="form-control style-white" name="number" id="number" placeholder="<?php echo dil('Konu','Subject');?>">
                            </div>
                            <div class="form-group col-12">
                                <textarea name="message" id="message" cols="30" rows="3" class="form-control style-white" placeholder="<?php echo dil('Mesajınız','Your Message');?>"></textarea>
                            </div>
                            <div class="form-btn col-12">
                                <button class="th-btn"><?php echo dil('Gönder','Send');?> <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <p class="form-messages mb-0 mt-3"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1505.1952928539247!2d28.618382!3d41.01671!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b55f72933d97cb%3A0xa2077abad3134c0a!2sVista%20Moda%20Tekstil!5e0!3m2!1str!2str!4v1702250188669!5m2!1str!2str" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	

	

<?php
	include "alt.php"
?>