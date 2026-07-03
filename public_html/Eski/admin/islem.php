<?php
require_once "inc/database.php";
require_once "inc/DW_class.php";
$dw = new DWDB();

$a = $_GET[a];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($a=='GirisYap'):

$kullanici=$_POST["kullanici"];
$sifre=$_POST["sifre"];
$sifrem = sha1(md5($sifre));

if(empty($kullanici) or empty($sifre)) {
?>
<script type="text/javascript">
new PNotify({
	title: 'Bilgilendirme!',
	text: 'Lütfen kullanıcı adı ve şifrenizi girin.',
	type: 'error'
});
</script>	
<?php
} else { 
$kontrol = $dw->getRow('SELECT * FROM yoneticiler WHERE sifre = ? and yonetici = ?', array('bindValues' => array($sifrem,$kullanici)));

$varmi = $dw->numRows(); 

if($varmi>0){
$_SESSION["dijilogin"] = "true";
$_SESSION["yonetici"] = $kullanici;
$_SESSION["yoneticiid"] = $kontrol->id;

$veriler = array(
   'oturum' => $Oturum 
);

$guncelle = $dw->update('yoneticiler', $veriler, array('id = ?'), array($kontrol->id), array('configKey' => 'secondaryDB'));

?>
<script type="text/javascript">
new PNotify({
	title: 'Giriş Başarılı!',
	text: 'Lütfen bekleyin yönlendiriliyorsunuz.',
	type: 'success'
});
</script>	
<script>
	setTimeout(function() { window.location="index.php"}, 3000);
</script>
<?php
} else {
?>
<script type="text/javascript">
new PNotify({
	title: 'Bilgilendirme!',
	text: 'Kullanıcı adı yada şifreniz yanlış. Lütfen tekrar deneyin.',
	type: 'error'
});
</script>	
<?php
}
}

endif;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($a=='SifreUnuttum'):

$email=$_POST["email"];

$kontrol = $dw->getRow('SELECT * FROM yoneticiler WHERE email = ? ', array('bindValues' => array($email)));
$varmi = $dw->numRows(); 
if($varmi>0){
$yenisifre1 = rasgeleSifre(8);	
$yenisifre = sha1(md5($yenisifre1));

$veriler = array(
   'sifre' => $yenisifre,
   'csifre' => $yenisifre1 
);

$sifreguncelle = $dw->update('yoneticiler', $veriler, array('id = ?'), array($kontrol->id), array('configKey' => 'secondaryDB'));

//* Email Gönderim
include "inc/sistem_mail_gonder.php";	
$mesaji='
<b>Sayın '.$kontrol->ad.' '.$kontrol->soyad.'</b><br>
<b>Yeni şifreniz : '.$yenisifre1.'</b>';

$baslik = "Yeni şifre talebi";

mail_gonder($baslik, $email, $kontrol->ad, $kontrol->soyad, $mesaji, $firmacek, $mailcek);

//* Email Gönderim
?>
<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert" style="margin-bottom:0;">
	<i class="mdi mdi-check-all"></i>
	<strong>Şifreniz Yenilendi!</strong><br>
	Yeni şifreniz <?php echo $email; ?> adresine gönderildi..
</div>
<script>
	setTimeout(function() { window.location="giris.php"}, 3000);
</script>
<?php

} else {
?>
<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert" style="margin-bottom:0;">
	<i class="mdi mdi-block-helper"></i>
	<strong>Bilgilendirme!</strong><br>
	Bu e-posta adresi sistemde kayıtlı değildir. Lütfen tekrar deneyin.
</div>
<?php
}

endif;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//* Toplu Resim Ürünler

if($_GET['a']=='FotoCek'):
	if($_GET['id']!=''):
		$deger = intval( $_GET[id] );
		$res = $dw->getResults('SELECT * FROM resimler where urunid = "'.$deger.'" or sessionID = "'.session_id().'" order by sira asc ');
	else:
		$res = $dw->getResults('SELECT * FROM resimler where sessionID = "'.session_id().'" order by sira asc ');
	endif;
	$total_records = $dw->numRows();
	if ($total_records == "0") {
		echo '<li style="list-style:none;width:100%;"><div class="alert alert-danger"><strong>Bilgilendirme!</strong><br>Ürüne ait görsel bulunamadı.<br>Görsel eklemek için yukarıdan görsel seçin.</div></li>';
	} else {
		foreach($res as $read){
	?>
		<li id="item-<?php echo $read->id;?>" style="margin:3px;list-style:none;float:left;border:1px dashed #c0c0c0;padding:10px;cursor:move;width:16.2%;float:left;">
			<div style="width: 100%;float:left;text-align: center;">
				<img src="../yukleme/urunler/<?php echo $read->resim;?>" width="100%" />
				<a href="javascript:void(0);" onclick="ResimDuzenSil(<?php echo $read->id;?>)" class="btn btn-icon btn-danger" style="margin-top:3px;"><i class="fa fa-trash-o" style="margin-right:0px;"></i></a>
			</div>
		</li>
	<?php
		}
	}
endif;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['a']=='ResimDuzenSil') {
	$deger = intval( $_GET[id] );

	$kontrol = $dw->getRow('SELECT * FROM resimler WHERE id = ?', array('bindValues' => array($deger)));

	@unlink("../yukleme/urunler/".$kontrol->kucukresim);	
	@unlink("../yukleme/urunler/".$kontrol->ortaresim);	
	@unlink("../yukleme/urunler/".$kontrol->orta2resim);	
	@unlink("../yukleme/urunler/".$kontrol->resim);

	$sil = $dw->delete('resimler', array('id = ?'), array($deger), array('configKey' => 'secondaryDB'));

	Header("location:".$_SERVER['HTTP_REFERER']."");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['a']=='FotoResimSirala'):



	foreach ($_POST['item'] as $position => $item) :

		$user = array(
		   'sira' => $position
		);
		$guncelle = $dw->update('resimler', $user, array('id = ?'), array($item), array('configKey' => 'secondaryDB'));


	endforeach;

		

endif;

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//* Toplu Resim Projeler

if($_GET['a']=='FotoCek2'):
	if($_GET['id']!=''):
		$deger = intval( $_GET[id] );
		$res = $dw->getResults('SELECT * FROM urunresimler where urunid = "'.$deger.'" or sessionID = "'.session_id().'" order by sira asc ');
	else:
		$res = $dw->getResults('SELECT * FROM urunresimler where sessionID = "'.session_id().'" order by sira asc ');
	endif;
	$total_records = $dw->numRows();
	if ($total_records == "0") {
		echo '<li style="list-style:none;width:100%;"><div class="alert alert-danger"><strong>Bilgilendirme!</strong><br>Ürüne ait görsel bulunamadı.<br>Görsel eklemek için yukarıdan görsel seçin.</div></li>';
	} else {
		foreach($res as $read){
	?>
		<li id="item-<?php echo $read->id;?>" style="margin:3px;list-style:none;float:left;border:1px dashed #c0c0c0;padding:10px;cursor:move;width:16.2%;float:left;">
			<div style="width: 100%;float:left;text-align: center;">
				<img src="../yukleme/urunler/<?php echo $read->resim;?>" width="100%" />
				<a href="javascript:void(0);" onclick="ResimDuzenSil2(<?php echo $read->id;?>)" class="btn btn-icon btn-danger" style="margin-top:3px;"><i class="fa fa-trash-o" style="margin-right:0px;"></i></a>
			</div>
		</li>
	<?php
		}
	}
endif;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['a']=='ResimDuzenSil2') {
	$deger = intval( $_GET[id] );

	$kontrol = $dw->getRow('SELECT * FROM urunresimler WHERE id = ?', array('bindValues' => array($deger)));

	@unlink("../yukleme/urunler/".$kontrol->kucukresim);	
	@unlink("../yukleme/urunler/".$kontrol->ortaresim);	
	@unlink("../yukleme/urunler/".$kontrol->orta2resim);	
	@unlink("../yukleme/urunler/".$kontrol->resim);

	$sil = $dw->delete('urunresimler', array('id = ?'), array($deger), array('configKey' => 'secondaryDB'));

	Header("location:".$_SERVER['HTTP_REFERER']."");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['a']=='FotoResimSirala2'):



	foreach ($_POST['item'] as $position => $item) :

		$user = array(
		   'sira' => $position
		);
		$guncelle = $dw->update('urunresimler', $user, array('id = ?'), array($item), array('configKey' => 'secondaryDB'));


	endforeach;

		

endif;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//* Toplu Resim Referanslar

if($_GET['a']=='FotoCek3'):
	if($_GET['id']!=''):
		$deger = intval( $_GET[id] );
		$res = $dw->getResults('SELECT * FROM resimler3 where urunid = "'.$deger.'" or sessionID = "'.session_id().'" order by sira asc ');
	else:
		$res = $dw->getResults('SELECT * FROM resimler3 where sessionID = "'.session_id().'" order by sira asc ');
	endif;
	$total_records = $dw->numRows();
	if ($total_records == "0") {
		echo '<li style="list-style:none;width:100%;"><div class="alert alert-danger"><strong>Bilgilendirme!</strong><br>Ürüne ait görsel bulunamadı.<br>Görsel eklemek için yukarıdan görsel seçin.</div></li>';
	} else {
		foreach($res as $read){
	?>
		<li id="item-<?php echo $read->id;?>" style="margin:3px;list-style:none;float:left;border:1px dashed #c0c0c0;padding:10px;cursor:move;width:16.2%;float:left;">
			<div style="width: 100%;float:left;text-align: center;">
				<img src="../yukleme/referanslar/<?php echo $read->resim;?>" width="100%" />
				<a href="javascript:void(0);" onclick="ResimDuzenSil(<?php echo $read->id;?>)" class="btn btn-icon btn-danger" style="margin-top:3px;"><i class="fa fa-trash-o" style="margin-right:0px;"></i></a>
			</div>
		</li>
	<?php
		}
	}
endif;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['a']=='ResimDuzenSil3') {
	$deger = intval( $_GET[id] );

	$kontrol = $dw->getRow('SELECT * FROM resimler3 WHERE id = ?', array('bindValues' => array($deger)));

	@unlink("../yukleme/referanslar/".$kontrol->kucukresim);	
	@unlink("../yukleme/referanslar/".$kontrol->ortaresim);	
	@unlink("../yukleme/referanslar/".$kontrol->orta2resim);	
	@unlink("../yukleme/referanslar/".$kontrol->resim);

	$sil = $dw->delete('resimler3', array('id = ?'), array($deger), array('configKey' => 'secondaryDB'));

	Header("location:".$_SERVER['HTTP_REFERER']."");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['a']=='FotoResimSirala3'):



	foreach ($_POST['item'] as $position => $item) :

		$user = array(
		   'sira' => $position
		);
		$guncelle = $dw->update('resimler3', $user, array('id = ?'), array($item), array('configKey' => 'secondaryDB'));


	endforeach;

		

endif;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if($_GET['a']=='cacheTemizle'):

	$files = glob('../cache/*'); 
	foreach($files as $file){ 
	  if(is_file($file))
		unlink($file); 
	}
	echo '<a href="javascript:void(0)" onclick="cacheTemizle();" class="cacheTemizleLink btn btn-primary">Temizle</a>';	
	?>
<script type="text/javascript">
new PNotify({
	title: 'Cache Dosyaları Temizlendi!',
	text: 'Cache dosyaları başarıyla temizlendi..',
	type: 'success'
});
</script>	
	<?php
endif;	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>