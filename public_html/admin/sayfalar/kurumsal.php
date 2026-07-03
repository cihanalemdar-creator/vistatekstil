
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
        <h2>Kurumsal</h2>
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
                    <h5>Kurumsal Ayarları</h5><!--Ekle Butonu oluşturuluyor.-->
                    <a href="index.php?sayfa=kurumsal&islem=ekle" class="btn btn-success dim pull-right" style="margin-top: -8px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="90%">Kurumsal Başlık</th>
                                <th width="10%">İçeriği Sil</th>
                            </tr>
                            
                            
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM kurumsal order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=kurumsal&page='; 
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
                                <td style="vertical-align: middle;"><?php echo $row->baslik; ?></td>
                                <td style="vertical-align: middle;" class="tooltip-demo">
                                     <a href="?sayfa=kurumsal&islem=duzenle1&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-edit"></i></a>
                                   <a href="?sayfa=kurumsal&islem=sil&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" onclick="return confirm('Bilgileri silmek istediğinize emin misiniz?');" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-times"></i></a><!--Sil butonu oluşturuluyor-->
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
        <form action="index.php?sayfa=kurumsal&islem=eklendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
					<h5>Kurumsal</h5>
				</div>
                <div class="ibox-content">
						<div class="row">						
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Başlık TR</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Başlık EN</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Kısa Açıklama TR (Max. 175 Karakter)</label>
                                    <input type="text" name="kisaaciklama" id="kisaaciklama" class="form-control" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Kısa Açıklama EN (Max. 175 Karakter)</label>
                                    <input type="text" name="kisaaciklamaEN" id="kisaaciklamaEN" class="form-control" required>
                                </div>
                            </div>
						</div>
						
						<div class="row">
						
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Açıklama TR</label>
                                    <textarea name="uzunaciklama" class="form-control ckeditor" style="width:1050px; height:200px;" required></textarea>
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Açıklama EN</label>
                                    <textarea name="uzunaciklamaEN" class="form-control ckeditor" style="width:1050px; height:200px;" required></textarea>
                                </div>
                            </div>
							
						</div>
						
						
						<div class="row">
						
							<div class="col-sm-6">
								<div class="form-group">
								<label class="control-label">Ürün Kapak Resmi</label>
								 <div class="alert alert-info">
									   <strong>Önemli bilgilendirme!</strong><br>
									  Slaytın bozulmaması ve düzgün görünmesi için 350px X 437px boyutlu fotoğraf yükleyiniz.<br>
								 </div>

								<input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false">
								</div>
							</div>
							
						</div>
								                 
                </div>
            </div>
        </div>
        <script src="ckeditor/ckeditor.js"></script>
<script>
var roxyFileman = 'fileman/index.html?integration=ckeditor';
$(function(){
  CKEDITOR.replace( 'editor1',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
});
</script>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" type="submit">Bilgileri Kaydet</button>
        </div>
        </form>
    </div>

<?php 
} else if ( $islem =="eklendi" )  {         // Ekleye tıklandığında çalışacak komut
$baslik=$_POST["baslik"];
$baslikEN=$_POST["baslikEN"];
$kisaaciklama=$_POST["kisaaciklama"];
$kisaaciklamaEN=$_POST["kisaaciklamaEN"];
$uzunaciklama=$_POST["uzunaciklama"];
$uzunaciklamaEN=$_POST["uzunaciklamaEN"];


include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = true;            // Resim eklemek için
$upload->image_ratio_crop = true;				  
$upload->image_background_color = '#e8e8e4';
$upload->image_x = 350;
$upload->image_y = 437;
$upload->process("../yukleme/kurumsal");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}

$veri = array(
    'url' =>  seo_link($baslik),
    'baslik' => $baslik,
	'baslikEN' => $baslikEN,
	'kisaaciklama' => $kisaaciklama,
	'kisaaciklamaEN' => $kisaaciklamaEN,
	'uzunaciklama' => $uzunaciklama,
	'uzunaciklamaEN' => $uzunaciklamaEN,
    'resim' => $Resim,
);


$YoneticiID = $dw->insert('kurumsal', $veri, array('configKey' => 'secondaryDB'));

$user = array(
   'sessionID' => '0',
   'urunid' => $YoneticiID
);

$SID = $Oturum;
$guncelle = $dw->update('urunresimler', $user, array('sessionID = ?'), array($SID), array('configKey' => 'secondaryDB'));   


?>
<div class="alert alert-success">Bilgiler Eklendi!<br>Bilgiler başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=kurumsal">

<? 
}else if ( $islem =="duzenle1" )  {
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM kurumsal WHERE id = ?', array('bindValues' => array($id)));
?>



  <form action="index.php?sayfa=kurumsal&islem=duzenlendi1" method="post" enctype="multipart/form-data">
    <div class="row">
      
            
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Kurumsal</h5>
			</div>
            <div class="ibox-content">
			
						<div class="row">						
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Başlık TR</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" value="<?php echo $veri->baslik;?>" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Başlık EN</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" value="<?php echo $veri->baslikEN;?>" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Kısa Açıklama TR (Max. 175 Karakter)</label>
                                    <input type="text" name="kisaaciklama" id="kisaaciklama" class="form-control" value="<?php echo $veri->kisaaciklama;?>" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Kısa Açıklama EN (Max. 175 Karakter)</label>
                                    <input type="text" name="kisaaciklamaEN" id="kisaaciklamaEN" class="form-control" value="<?php echo $veri->kisaaciklamaEN;?>" required>
                                </div>
                            </div>
						</div>
						
						<div class="row">
						
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Açıklama TR</label>
                                    <textarea name="uzunaciklama" class="form-control ckeditor" style="width:1050px; height:200px;" required><?php echo $veri->uzunaciklama;?></textarea>
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Açıklama EN</label>
                                    <textarea name="uzunaciklamaEN" class="form-control ckeditor" style="width:1050px; height:200px;" required><?php echo $veri->uzunaciklamaEN;?></textarea>
                                </div>
                            </div>
							
						</div>
												
						<div class="row">
							<?
							if (!$veri->resim =="" ) { 
							?>
							<div class="col-sm-4">
								<label>Kapak Resmini Sil</label>
								<div class="form-group">
								  
									<img width="250px" height="250px" src="../yukleme/kurumsal/<?php echo $veri->resim; ?>">
								</div>
								<div class="form-group">
									<a class="btn btn-danger" href="index.php?sayfa=kurumsal&islem=resimsil1&id=<?php echo $veri->id;?>" onclick="return confirm('Resmi silmek istediğinize emin misiniz?');">Resmi Sil</a>
								</div>
							</div>
							<?php  } else { ?> 
							
							<div class="col-sm-4">
								<div class="form-group">
							
								   <input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false">
								</div>
							</div>
							<?php } ?>
														
						</div>
					
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <input type="hidden" name="id" value="<?php echo $veri->id;?>">
            <button class="btn btn-primary" type="submit">Bilgileri Güncelle</button>
           
        </div>
        
    </div>
</form>

<?
}  else if ( $islem =="duzenlendi1" )  {

$id = $_POST[id];
$baslik=$_POST["baslik"];
$baslikEN=$_POST["baslikEN"];
$kisaaciklama=$_POST["kisaaciklama"];
$kisaaciklamaEN=$_POST["kisaaciklamaEN"];
$uzunaciklama=$_POST["uzunaciklama"];
$uzunaciklamaEN=$_POST["uzunaciklamaEN"];

include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = true;            // Resim eklemek için
$upload->image_ratio_crop = true;
$upload->image_background_color = '#e8e8e4';
$upload->image_x = 350;
$upload->image_y = 437;
$upload->process("../yukleme/kurumsal");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}
if ($Resim == "") {
$veri = array(
    'url' =>  seo_link($baslik),
    'baslik' => $baslik,
	'baslikEN' => $baslikEN,
	'kisaaciklama' => $kisaaciklama,
	'kisaaciklamaEN' => $kisaaciklamaEN,
	'uzunaciklama' => $uzunaciklama,
	'uzunaciklamaEN' => $uzunaciklamaEN,
	
);
} else {

$veri = array(
    'url' =>  seo_link($baslik),
    'baslik' => $baslik,
	'baslikEN' => $baslikEN,
	'kisaaciklama' => $kisaaciklama,
	'kisaaciklamaEN' => $kisaaciklamaEN,
	'uzunaciklama' => $uzunaciklama,
	'uzunaciklamaEN' => $uzunaciklamaEN,
    'resim' => $Resim,
);  
}


$guncelle = $dw->update('kurumsal', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));


$user = array(
   'sessionID' => '0',
   'urunid' => $id
);

$SID = $Oturum;
$guncelle = $dw->update('urunresimler', $user, array('sessionID = ?'), array($SID), array('configKey' => 'secondaryDB'));   


$kontrol = $dw->getRow('SELECT * FROM urunresimler WHERE urunid = ?', array('bindValues' => array($id)));
$varmi = $dw->numRows(); 

if ($varmi == 0) {

} else {
$gveri = array(
   'resimvarmi' => '1'
);

$sguncelle = $dw->update('kurumsal', $gveri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));   
}


?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=kurumsal">
<?php } else if ( $islem =="resimsil1" )  {
$id = intval( $_GET[id] );
$kategoriveri = $dw->getRow('SELECT * FROM kurumsal WHERE id = ?', array('bindValues' => array($id)));

$veri = array(
   'resim' => ""
);
$sil = '../yukleme/kurumsal/'.$kategoriveri->resim;
@unlink($sil);  
$guncelle = $dw->update('kurumsal', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=kurumsal&islem=duzenle1&id=<?php echo $id; ?>">



<? 
}  else if ( $islem =="sil" )  {           // Tüm bilgileri siler

$id = intval( $_GET[id] );

$kategoriveri = $dw->getRow('SELECT * FROM kurumsal WHERE id = ?', array('bindValues' => array($id)));
$resimsil = '../yukleme/kurumsal/'.$kategoriveri->resim;
 @unlink($resimsil); 
$sil = $dw->delete('kurumsal', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));

          $rsorgu = "Select * from urunresimler WHERE urunid='$id'";
          $rlist = $dw->getResults(''.$rsorgu.'');
          foreach($rlist as $rrow){
            $resimsil2 = '../yukleme/kurumsal/'.$rrow->resim;
            @unlink($resimsil2); 
            } 
$sil2 = $dw->delete('urunresimler', array('urunid = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Silindi!<br>Bilgiler başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=kurumsal">
<?php
}  else if ( $islem =="tumresimlersil" )  {           // Tüm bilgileri siler

$id = intval( $_GET[id] );


          $rsorgu = "Select * from urunresimler WHERE urunid='$id'";
          $rlist = $dw->getResults(''.$rsorgu.'');
          foreach($rlist as $rrow){
            $resimsil2 = '../yukleme/kurumsal/'.$rrow->resim;
            @unlink($resimsil2); 
            } 
$sil2 = $dw->delete('urunresimler', array('urunid = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Silindi!<br>Bilgiler başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=kurumsal&islem=duzenle1&id=<?php echo $id; ?>">

<? 
}
?>            
</div>