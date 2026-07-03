<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Site Yönetimi</h2>
    </div>   
</div>
<div class="wrapper wrapper-content animated fadeInRight">

<?php
$islem = $_GET[islem];
if ( $islem =="" ) {   
    $id = 1;
$seocek = $dw->getRow('SELECT * FROM iletisim WHERE id = ?', array('bindValues' => array($id)));    
?>

    <div class="row">
        <form method="post" action="index.php?sayfa=iletisim&islem=duzenlendi" enctype="multipart/form-data">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Site Yönetimi</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
					
						<div class="col-sm-12">
                            <div class="form-group">
								<label class="control-label">Site URL <p style="color: #da2626;">(Bu bölümün ayarını değiştirmeyiniz!)</p></label>
								<input type="text" class="form-control" rows="3" name="baseurl" value="<?php echo $seocek->baseurl;?>">
                            </div>
                        </div>
						
						<div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Adres 1</label>                     
                                <textarea type="text"   name="adres" rows="3" class="form-control"><?php echo $seocek->adres;?></textarea>
                            </div>
                        </div>
						
						<div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Adres 2</label>                     
                                <textarea type="text"   name="adres2" rows="3" class="form-control"><?php echo $seocek->adres2;?></textarea>
                            </div>
                        </div> 

						<div class="col-sm-6">
                            <div class="form-group">
								<label class="control-label">Tel 1</label>
								<input type="text" class="form-control" rows="3" name="tel1" value="<?php echo $seocek->tel1;?>">
                            </div>
                        </div>
						
                        <div class="col-sm-6">
                            <div class="form-group">
								<label class="control-label">Tel 2</label>
								<input type="text" class="form-control" rows="3" name="tel2" value="<?php echo $seocek->tel2;?>" >
                            </div>
                        </div>
						
						<div class="col-sm-6">
                            <div class="form-group">
								<label class="control-label">Fax</label>
								<input type="text" class="form-control" rows="3" name="faks" value="<?php echo $seocek->faks;?>">
                            </div>
                        </div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Mail 1</label>
								<input type="text" class="form-control" rows="3" name="mail1" value="<?php echo $seocek->mail1;?>">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Mail 2</label>
								<input type="text" class="form-control" rows="3" name="mail2" value="<?php echo $seocek->mail2;?>" >
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">facebook</label>
								<input type="text" class="form-control" rows="3" name="facebook" value="<?php echo $seocek->facebook;?>" >
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">twitter</label>
								<input type="text" class="form-control" rows="3" name="twitter" value="<?php echo $seocek->twitter;?>" >
							</div>
						</div>
                   
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">instagram</label>
								<input type="text" class="form-control" rows="3" name="instagram" value="<?php echo $seocek->instagram;?>" >
							</div>
						</div>
					
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Linkedin</label>
								<input type="text" class="form-control" rows="3" name="linkedin" value="<?php echo $seocek->linkedin;?>" >
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pinterest</label>
								<input type="text" class="form-control" rows="3" name="pinterest" value="<?php echo $seocek->pinterest;?>" >
							</div>
						</div>
					
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Map</label>
								<textarea name="map" style="width: 100%; height:60px;"><?php echo $seocek->map;?></textarea>
							</div>
						</div>
						
					</div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" type="submit">İletişim Ayarlarını Güncelle</button>
        </div>
        </form>
    </div>

<?php 
} else if ( $islem =="duzenlendi" )  {
$id = "1";

$baseurl = $_POST['baseurl'];
$adres = $_POST['adres'];
$adres2 = $_POST['adres2'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$faks = $_POST['faks'];
$mail1 = $_POST['mail1'];
$mail2 = $_POST['mail2'];
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$instagram = $_POST['instagram'];
$linkedin = $_POST['linkedin'];
$pinterest = $_POST['pinterest'];
$map = $_POST['map'];


 if ($Resim == "") {
$veri = array(
	'baseurl' => $baseurl,
    'adres' => $adres,
	'adres2' => $adres2,
	'tel1' => $tel1,
	'tel2' => $tel2,
	'faks' => $faks,
	'mail1' => $mail1,
	'mail2' => $mail2,
	'facebook' => $facebook,
	'twitter' => $twitter,
	'instagram' => $instagram,
	'linkedin' => $linkedin,
	'pinterest' => $pinterest,
	'map' => $map,
);

} else  {

$veri = array(
	'baseurl' => $baseurl,
    'adres' => $adres,
	'adres2' => $adres2,
	'tel1' => $tel1,
	'tel2' => $tel2,
	'faks' => $faks,
	'mail1' => $mail1,
	'mail2' => $mail2,
	'facebook' => $facebook,
	'twitter' => $twitter,
	'instagram' => $instagram,
	'linkedin' => $linkedin,
	'pinterest' => $pinterest,
	'map' => $map,
); 


}

$guncelle = $dw->update('iletisim', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">İletişim Ayarları Güncellendi!<br>İletişim ayarları başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=iletisim">

<? 
}
?>   

</div>