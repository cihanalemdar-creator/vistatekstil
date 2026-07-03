
<style type="text/css">
    .resimlerim ul { width:100%; list-style-type: none; margin:0px; padding:0px; }
    .resimlerim li { float:left; padding:5px; }
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
        background-image: none !important;
        background: #f9f9f9 !important;
    }
    .plupload_header_title {
        font-family: "Titillium Web","Helvetica Neue",Helvetica,Arial,sans-serif;        
    }
    .ui-widget-header {
        background-image: none !important;
        background: #f9f9f9 !important;
        font-family: "Titillium Web","Helvetica Neue",Helvetica,Arial,sans-serif;
    }
    .plupload_view_thumbs .plupload_file {
        border:1px dashed #46464 !important;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Hizmetlerimiz</h2>
    </div>   
</div>

<div class="wrapper wrapper-content animated fadeInRight">

<?php
$islem = $_GET[islem];
if ( $islem =="" ) {  
?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Hizmet Ayarları</h5><!--Ekle Butonu oluşturuluyor.-->
                    <a href="index.php?sayfa=hizmetler&islem=ekle" class="btn btn-success dim pull-right" style="margin-top: -8px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="90%">Hizmet Adı</th><!--Başlık ve İşlem adında ana başlıklar oluşturuluyor.-->
                                <th width="10%">İşlem</th>
                            </tr>
                            
                            
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM hizmetler order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=hizmetler&page='; 
                        $scroll_page = 5; 
                        $per_page = 10; 
                        $current_page = $_GET['page'];
                        $inactive_page_tag = 'id="current_page"';
                        $previous_page_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>';//Önceki sonraki gibi olaylar
                        $next_page_text = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        $first_page_text = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
                        $last_page_text = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>'; 
                        $kgPagerOBJ = & new kgPager();
                        $kgPagerOBJ -> pager_set($pager_url, $total_records, $scroll_page, $per_page, $current_page, $inactive_page_tag, $previous_page_text, $next_page_text, $first_page_text, $last_page_text, $pager_url_last);

                        $list2 = $dw->getResults(''.$sorgu.' LIMIT '.$kgPagerOBJ -> start.", ".$kgPagerOBJ -> per_page.'');
                        if($total_records == 0){
                        ?>
                            <tr>                                    <!--Sayfada hiç bir veri yoksa uyarı veriyor.-->
                                <td colspan="8">
                                    <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert" style="margin-top:5px;margin-bottom:5px;">
                                        <strong>Bilgilendirme!</strong><br>
                                        Veri bulunmadı...
                                    </div>

                                </td>
                            </tr>
                        <?php
                        } else {          //Sayfada veri varsa 

                        foreach($list2 as $row){
                        ?>
                            <tr id="item-<?php echo $row->id;?>">
                                <td style="vertical-align: middle;"><?php echo $row->baslik; ?></td><!--Bu verinin başlığını yazdırıyor-->
                                <td style="vertical-align: middle;" class="tooltip-demo">
                                    <a href="?sayfa=hizmetler&islem=duzenle&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-edit"></i></a>
									<!-- Düzenle butonu oluşturuluyor-->
                                    <a href="?sayfa=hizmetler&islem=sil&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" onclick="return confirm('Bilgileri silmek istediğinize emin misiniz?');" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-times"></i></a><!--Sil butonu oluşturuluyor-->
                                </td>
                            </tr>
                        <?
                        }
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                        <div class="row">
                            <div class="col-sm-4" style="padding-top:5px;">
                                Toplam <?php echo $kgPagerOBJ -> total_pages;?> sayfada, <?php echo $total_records;?> veri listeleniyor.
                            </div>                                                      <!-- Sayfadaki veri sayısını gösteriyor.-->
                            <div class="col-sm-7 hidden-xs" >
                                <ul class="pagination pull-right" style="margin:0;">
                                <?
                                echo $kgPagerOBJ -> first_page;
                                echo $kgPagerOBJ -> previous_page;    // Önceki sonraki sayfa olayları
                                echo $kgPagerOBJ -> page_links;
                                echo $kgPagerOBJ -> next_page;
                                echo $kgPagerOBJ -> last_page;
                                ?>                
                                </ul>
                            </div>
                            <div class="col-sm-1">
                                <script type="text/JavaScript">
                                function MM_jumpMenu2(targ,selObj,restore){ //v3.0
                                  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
                                  if (restore) selObj.selectedIndex=0;
                                }
                                </script>
                                <select name="yil" class="form-control" onchange="MM_jumpMenu2('parent',this,0)" style="width: 100%;">
                                <?php
                                for ($yillar = 1; $yillar <= $kgPagerOBJ -> total_pages ; $yillar++ ) {
                                ?>
                                <option value="?sayfa=yoneticiler&page=<?php echo $yillar;?>" <? if ($yillar == $_GET['page']) { echo "selected"; };?>><?php echo $yillar;?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
<?php 
} else if ( $islem =="ekle" )  {     // Ekleye Tıklandığında
?>


    <div class="row">
        <form action="index.php?sayfa=hizmetler&islem=eklendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Hizmet Ekle</h5>
                </div>
                <div class="ibox-content">
                        
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Hizmet Adı (TR)</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" required>
                                </div>
                            </div>
							
							 <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Hizmet Adı (EN)</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" required>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (TR)</label>
                                    <textarea name="detay" class="form-control ckeditor" style="width:800px; height:200px;" required></textarea>
                                </div>
                            </div>
							
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (EN)</label>
                                    <textarea name="detayEN" class="form-control ckeditor" style="width:800px; height:200px;" required></textarea>
                                </div>
                            </div>
                        </div>
						
						 <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                <label class="control-label">Hizmet Resmi Ekle (850px - 300px)</label>
                                    <input type="file" name="resimler" required="" id="resimsec" class="filestyle" data-icon="false">
                                </div>
                            </div>
                         
							
						</div>
						
				 </div>
                        
                </div>
            </div>
        
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" type="submit">Bilgileri Kaydet</button>
        </div>
        </form>
    </div>

<?php 
} else if ( $islem =="eklendi" )  {       
$baslik=$_POST["baslik"];
$baslikEN=$_POST["baslikEN"];
$detay=$_POST["detay"];
$detayEN=$_POST["detayEN"];


include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = false;            // Resim eklemek için
$upload->image_ratio_crop = false;
$upload->image_x = 850;
$upload->image_y = 300;
$upload->process("../yukleme/hizmetler");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}


$veri = array(
   'baslik' => $baslik,
   'baslikEN' => $baslikEN,
   'detay' => $detay,
   'detayEN' => $detayEN,
   'resim' => $Resim,
);

$YoneticiID = $dw->insert('hizmetler', $veri, array('configKey' => 'secondaryDB'));

$user = array(
   'sessionID' => '0',
   'urunid' => $YoneticiID
);

$SID = $Oturum;
$guncelle = $dw->update('resimler', $user, array('sessionID = ?'), array($SID), array('configKey' => 'secondaryDB'));   


?>
<div class="alert alert-success">Bilgiler Eklendi!<br>Bilgiler başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hizmetler">




<? 	
}

else if ( $islem =="duzenle" )  {
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM hizmetler WHERE id = ?', array('bindValues' => array($id)));
?>

<div class="row">
        <form action="index.php?sayfa=hizmetler&islem=duzenlendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Hizmet Düzenle</h5>
                </div>
                <div class="ibox-content">
                        
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Hizmet Adı (TR)</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" value="<?php echo $veri->baslik;?>" required>
                                </div>
                            </div>
							
							<div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Hizmet Adı (EN)</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" value="<?php echo $veri->baslikEN;?>" required>
                                </div>
                            </div>
                           
                        </div>
						
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (TR)</label>
                                    <textarea name="detay" class="form-control ckeditor" style="width:800px; height:200px;" required><?php echo $veri->detay;?></textarea>
                                </div>
                            </div>
							
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (EN)</label>
                                    <textarea name="detayEN" class="form-control ckeditor" style="width:800px; height:200px;" required><?php echo $veri->detayEN;?></textarea>
                                </div>
                            </div>
							
						</div>
						
						<div class="row">
							 <div class="col-sm-12">
									<div class="form-group">
										<label class="control-label">Hizmet Resmi Ekle (850px - 300px)</label>
										<?
										if ( $veri->resim =="" ) {         // Resim kayıtlı değilse resim ekleme inputu oluşturur
										?>
										<input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false">
										<?
										} else {                   // Eğer resim varsa resmi göster ve sil butonları oluşturur.
										?><br>
										<div style="display: none"><input type="file" class="" name="resimler"></div>   <!-- resim gösterme butonu-->  
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ResimGoster">Göster</button> 
										<a class="btn btn-danger" href="index.php?sayfa=hizmetler&islem=resimsil&id=<?php echo $veri->id;?>" onclick="return confirm('Resmi silmek istediğinize emin misiniz?');">Sil</a><!-- Resim silme butonu-->

										<div class="modal inmodal" id="ResimGoster" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-sm">
											<div class="modal-content animated bounceInRight">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> <!-- Sayfanın köşesindeki çarpı -->
														<h4 class="modal-title">Resim Göster</h4>
													</div>
													<div class="modal-body text-center">
														<img src="../yukleme/hizmetler/<?php echo $veri->resim;?>" width="100%"><!-- Resim-->
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-white" data-dismiss="modal">Kapat</button><!-- Resmi kapat butonu-->
													</div>
												</div>
											</div>
										</div>                                    
										<?
										}
										?>
									</div>
							</div>
						</div>
                 
				 </div>
                        
                </div>
            </div>
        
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <input type="hidden" name="id" value="<?php echo $veri->id;?>">
            <button class="btn btn-primary" type="submit">Güncelle</button>
        </div>
        </form>
    </div>

<?php
} else if ( $islem =="duzenlendi" )  {
$id = $_POST[id];
$baslik=$_POST["baslik"];
$baslikEN=$_POST["baslikEN"];
$detay=$_POST["detay"];
$detayEN=$_POST["detayEN"];


include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = false;            // Resim eklemek için
$upload->image_ratio_crop = false;
$upload->image_x = 850;
$upload->image_y = 300;
$upload->process("../yukleme/hizmetler");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}



if ($Resim == "") {
$veri = array(
   'baslik' => $baslik,
   'baslikEN' => $baslikEN,   
   'detay' => $detay,
   'detayEN' => $detayEN,
);
} else {
$veri = array(
   'baslik' =>$baslik,
   'resim' => $Resim
);
}


$guncelle = $dw->update('hizmetler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Güncellendi!<br>Başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hizmetler">

<? 
} else if ( $islem =="resimsil" )  {   // Resim silme komutu
$id = intval( $_GET[id] );
$kategoriveri = $dw->getRow('SELECT * FROM hizmetler WHERE id = ?', array('bindValues' => array($id)));

$veri = array(
   'resim' => ""
   
);

$guncelle = $dw->update('hizmetler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>

<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hizmetler">


<? 
} else if ( $islem =="resimsil" )  {   // Resim silme komutu
$id = intval( $_GET[id] );
$kategoriveri = $dw->getRow('SELECT * FROM hizmetler WHERE id = ?', array('bindValues' => array($id)));

$veri = array(
   'resim' => ""
   
);

$guncelle = $dw->update('hizmetler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>

<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hizmetler">
<? 
} else if ( $islem =="sil" )  {           // Tüm bilgileri siler

$id = intval( $_GET[id] );

$sil = $dw->delete('hizmetler', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Silindi!<br>Bilgiler başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hizmetler">
<? 
}
?>            
</div>