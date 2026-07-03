<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Bilgilerim</h2>
    </div>   
</div>
<div class="wrapper wrapper-content animated fadeInRight">

<?php
$islem = $_GET[islem];
if ( $islem =="" ) {   
$seocek = $dw->getRow('SELECT * FROM yoneticiler WHERE id = ?', array('bindValues' => array($admin->id)));    
?>
    <div class="row">
        <form method="post" action="index.php?sayfa=bilgilerim&islem=duzenlendi" enctype="multipart/form-data">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Bilgileri Güncelle</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Yönetici</label>                     
                                <input type="text"   name="yoneticsssi" disabled rows="3" class="form-control" value="<?php echo $seocek->yonetici;?>" required>
                            </div>
                        </div>
                       
                    

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Şifre</label>
                            <input type="password" class="form-control" rows="3" name="sifre" placeholder="Değiştirilmicekse boş bırakınız.">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                            <input type="text" class="form-control" rows="3" name="email" value="<?php echo $seocek->email;?>"  required>
                            
                            </div>
                        </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Tel</label>
                    <input type="text" class="form-control" rows="3" name="tel" value="<?php echo $seocek->tel;?>" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Ad</label>
                    <input type="text" class="form-control" rows="3" name="ad" value="<?php echo $seocek->ad;?>" required>
                    </div>
                    </div>
                     <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Soyad</label>
                    <input type="text" class="form-control" rows="3" name="soyad" value="<?php echo $seocek->soyad;?>" required>
                    </div>
                    </div>
</div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
        	<input name="id" value="<?php echo $admin->id;?>" type="hidden">
            <button class="btn btn-primary" type="submit">Bilgileri Güncelle</button>
        </div>
        </form>
    </div>

<?php 
} else if ( $islem =="duzenlendi" )  {
$id = $_POST[id];
$sifre1 = $_POST['sifre'];
$sifre = sha1(md5($sifre1));
$email = $_POST['email'];
$tel = $_POST['tel'];
$ad = $_POST['ad'];
$soyad = $_POST['soyad'];

if ($sifre1 == "") {

$veri = array(
   'email' => $email,
   'tel' => $tel,
   'ad' => $ad,
   'soyad' => $soyad
);
	
} else {

$veri = array(
   'sifre' => $sifre,
   'email' => $email,
   'tel' => $tel,
   'ad' => $ad,
   'soyad' => $soyad
);
}

$guncelle = $dw->update('yoneticiler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Yönetici Bilgileri Güncellendi!<br>Yönetici bilgileri başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=bilgilerim">
<? 


}
?>            
</div>