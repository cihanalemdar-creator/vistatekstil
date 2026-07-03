
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Galeri</h2>
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
                    <h5>Galeri Ayarları</h5><!--Ekle Butonu oluşturuluyor.-->
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="90%">Galeri Başlık</th>
                                <th width="10%">İçeriği Sil</th>
                            </tr>
                            
                            
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM galeri order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=galeri&page='; 
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
                                <td style="vertical-align: middle;">Galeriyi düzenlemek için sağ kısımdaki düzenle butonunu kullanınız</td>
                                <td style="vertical-align: middle;" class="tooltip-demo">
									<a href="?sayfa=galeri&islem=duzenle1&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-edit"></i></a>
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
<script type="text/javascript">

$(document).ready(function(){
    $.ajax({
        type: 'POST', 
        url:'islem.php?a=FotoCek2&id=<?php echo $id;?>',
        data: '',       
        success: function(D) { $("#resim").html(D); } }); 
    });
/////////////////////////////////////////////////////////
function abc2(){
    $.ajax({
        type: 'POST', 
        url:'islem.php?a=FotoCek2&id=<?php echo $id;?>',
        data: '',       
        success: function(D) { $("#resim").html(D); } }); 
    }
/////////////////////////////////////////////////////////
$(document).ready(function(){ 

    $(function() {
        $("ul#resim").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
            $.post("islem.php?a=FotoResimSirala2", order, function(theResponse){
                $("#contentRight").html(theResponse);
            });
        }
        });
    });

});
////////////////////////////////////////////////////////
function ResimDuzenSil2(S) {
    $.ajax({
        type: 'GET', 
        url:'islem.php?a=ResimDuzenSil2&id='+S,
        data: '',       
        success: function(D) { abc2(); } });        
}

</script>

    <div class="row">
        <form action="index.php?sayfa=galeri&islem=eklendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
			
                <div class="ibox-content">
						<div class="row">						
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Galeri Adı TR</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Galeri Adı EN</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" required>
                                </div>
                            </div>
						</div>
						
						<div class="row">
						
							<div class="col-sm-4">
								<div class="form-group">
								<label class="control-label">Galeri Kapak Resmi</label>
								 <div class="alert alert-info">
									   <strong>Önemli bilgilendirme!</strong><br>
									  Slaytın bozulmaması ve düzgün görünmesi için 900px X 900px boyutlu fotoğraf yükleyiniz.<br>
								 </div>

								<input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false">
								</div>
							</div>
							
						</div>
						
						<script type="text/javascript">
                        // Initialize the widget when the DOM is ready
                        $(function() {
                            $("#uploader").plupload({
                                // General settings
                                runtimes : 'html5,flash,silverlight,html4',
                                url : 'uploadislem2.php',

                                // User can upload no more then 20 files in one go (sets multiple_queues to false)
                                max_file_count: 100,
                                
                                chunk_size: '20mb',

                                // Resize images on clientside if we can

                                
                                filters : {
                                    // Maximum file size
                                    max_file_size : '20mb',
                                    // Specify what files to browse for
                                    mime_types: [
                                        {title : "Image files", extensions : "jpg,gif,png"}
                                    ]
                                },

                                // Rename files by clicking on their titles
                                rename: true,
                                
                                // Sort files
                                sortable: true,

                                // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
                                dragdrop: true,

                                // Views to activate
                                views: {
                                    list: true,
                                    thumbs: true, // Show thumbs
                                    active: 'thumbs'
                                },

                                // Flash settings
                                flash_swf_url : 'plupload/Moxie.swf',

                                // Silverlight settings
                                silverlight_xap_url : 'plupload/Moxie.xap'
                            });
                            
                                    // When all files are uploaded submit form
                                    $('#uploader').on('complete', function() {
                                        parent.abc2();  
                                    });
                            
                        });
                        </script>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p>
                                    - Tek seferde birden fazla görsel yüklemek için, <b>Görsel Seçin</b> butonuna bastıktan sonra görsel seçerken <u>Ctrl tuşuna basılı tutun</u>.<br>
                                    - Görsel seçme işlemi bittikten sonra <b>Yüklemeyi Başlatın</b> butonuna tıklayın.
                                    </p>    
                                    <div id="uploader"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-12 resimlerim">
                                    <br>
                                        <ul id="resim" style="padding-left:0px;"></ul>
                                    </div>
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


include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = true;            // Resim eklemek için
$upload->image_ratio_crop = true;				  
$upload->image_background_color = '#e8e8e4';
$upload->image_x = 900;
$upload->image_y = 900;
$upload->process("../yukleme/galeri");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}

$veri = array(
    'url' =>  seo_link($baslik),
    'baslik' => $baslik,
	'baslikEN' => $baslikEN,
	'resim' => $Resim,
	
);


$YoneticiID = $dw->insert('galeri', $veri, array('configKey' => 'secondaryDB'));

$user = array(
   'sessionID' => '0',
   'urunid' => $YoneticiID
);

$SID = $Oturum;
$guncelle = $dw->update('galeriresimler', $user, array('sessionID = ?'), array($SID), array('configKey' => 'secondaryDB')); 

?>
<div class="alert alert-success">Bilgiler Eklendi!<br>Bilgiler başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=galeri">

<? 
}else if ( $islem =="duzenle1" )  {
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM galeri WHERE id = ?', array('bindValues' => array($id)));
?>

<script type="text/javascript">
//* Resimler 
$(document).ready(function(){
    $.ajax({
        type: 'POST', 
        url:'islem.php?a=FotoCek2&id=<?php echo $id;?>',
        data: '',       
        success: function(D) { $("#resim").html(D); } }); 
    });
/////////////////////////////////////////////////////////
function abc2(){
    $.ajax({
        type: 'POST', 
        url:'islem.php?a=FotoCek2&id=<?php echo $id;?>',
        data: '',       
        success: function(D) { $("#resim").html(D); } }); 
    }
/////////////////////////////////////////////////////////
$(document).ready(function(){ 

    $(function() {
        $("ul#resim").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
            $.post("islem.php?a=FotoResimSirala2", order, function(theResponse){
                $("#contentRight").html(theResponse);
            });
        }
        });
    });

});
/////////////////////////////////////////////////////////
function ResimDuzenSil2(S) {
    $.ajax({
        type: 'GET', 
        url:'islem.php?a=ResimDuzenSil2&id='+S,
        data: '',       
        success: function(D) { abc2(); } });        
}
//* Resimler
</script>


  <form action="index.php?sayfa=galeri&islem=duzenlendi1" method="post" enctype="multipart/form-data">
    <div class="row">
      
            
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
			
						<div class="row">						
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Galeri Adı TR</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" value="<?php echo $veri->baslik;?>" required>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="form-group">
                                <label class="control-label">Galeri Adı EN</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" value="<?php echo $veri->baslikEN;?>" required>
                                </div>
                            </div>
						</div>
											
						<div class="row">
							<?
							if (!$veri->resim =="" ) { 
							?>
							<div class="col-sm-2">
								<label>Kapak Resmini Sil</label>
								<div class="form-group">
								  
									<img width="250px" height="250px" src="../yukleme/galeri/<?php echo $veri->resim; ?>">
								</div>
								<div class="form-group">
									<a class="btn btn-danger" href="index.php?sayfa=galeri&islem=resimsil1&id=<?php echo $veri->id;?>" onclick="return confirm('Resmi silmek istediğinize emin misiniz?');">Resmi Sil</a>
								</div>
							</div>
							<?php  } else { ?> 
							
							<div class="col-sm-2">
								<div class="form-group">
							
								   <input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false">
								</div>
							</div>
							<?php } ?>
														
						</div>
						
						<script type="text/javascript">
                        // Initialize the widget when the DOM is ready
                        $(function() {
                            $("#uploader").plupload({
                                // General settings
                                runtimes : 'html5,flash,silverlight,html4',
                                url : 'uploadislem2.php',

                                // User can upload no more then 20 files in one go (sets multiple_queues to false)
                                max_file_count: 100,
                                
                                chunk_size: '20mb',

                                // Resize images on clientside if we can

                                
                                filters : {
                                    // Maximum file size
                                    max_file_size : '20mb',
                                    // Specify what files to browse for
                                    mime_types: [
                                        {title : "Image files", extensions : "jpg,gif,png"}
                                    ]
                                },

                                // Rename files by clicking on their titles
                                rename: true,
                                
                                // Sort files
                                sortable: true,

                                // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
                                dragdrop: true,

                                // Views to activate
                                views: {
                                    list: true,
                                    thumbs: true, // Show thumbs
                                    active: 'thumbs'
                                },

                                // Flash settings
                                flash_swf_url : 'plupload/Moxie.swf',

                                // Silverlight settings
                                silverlight_xap_url : 'plupload/Moxie.xap'
                            });
                            
                                    // When all files are uploaded submit form
                                    $('#uploader').on('complete', function() {
                                        parent.abc2();  
                                    });
                            
                        });
                        </script>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p>
                                    - Tek seferde birden fazla görsel yüklemek için, <b>Görsel Seçin</b> butonuna bastıktan sonra görsel seçerken <u>Ctrl tuşuna basılı tutun</u>.<br>
                                    - Görsel seçme işlemi bittikten sonra <b>Yüklemeyi Başlatın</b> butonuna tıklayın.
                                    </p>    
                                    <div id="uploader"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-12 resimlerim">
                                    <br>
                                        <ul id="resim" style="padding-left:0px;"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
					
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

include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = true;            // Resim eklemek için
$upload->image_ratio_crop = true;
$upload->image_background_color = '#e8e8e4';
$upload->image_x = 900;
$upload->image_y = 900;
$upload->process("../yukleme/galeri");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}
if ($Resim == "") {
$veri = array(
    'url' =>  seo_link($baslik),
    'baslik' => $baslik,
	'baslikEN' => $baslikEN,
	
);
} else {

$veri = array(
    'url' =>  seo_link($baslik),
    'baslik' => $baslik,
	'baslikEN' => $baslikEN,
    'resim' => $Resim,
);  
}


$guncelle = $dw->update('galeri', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));


$user = array(
   'sessionID' => '0',
   'urunid' => $id
);

$SID = $Oturum;
$guncelle = $dw->update('galeriresimler', $user, array('sessionID = ?'), array($SID), array('configKey' => 'secondaryDB'));   


$kontrol = $dw->getRow('SELECT * FROM galeriresimler WHERE urunid = ?', array('bindValues' => array($id)));
$varmi = $dw->numRows(); 

if ($varmi == 0) {

} else {
$gveri = array(
   'resimvarmi' => '1'
);

$sguncelle = $dw->update('galeri', $gveri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));   
}


?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=galeri">
<?php } else if ( $islem =="resimsil1" )  {
$id = intval( $_GET[id] );
$kategoriveri = $dw->getRow('SELECT * FROM galeri WHERE id = ?', array('bindValues' => array($id)));

$veri = array(
   'resim' => ""
);
$sil = '../yukleme/galeri/'.$kategoriveri->resim;
@unlink($sil);  
$guncelle = $dw->update('galeri', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=galeri&islem=duzenle1&id=<?php echo $id; ?>">



<? 
}  else if ( $islem =="sil" )  {           // Tüm bilgileri siler

$id = intval( $_GET[id] );

$kategoriveri = $dw->getRow('SELECT * FROM galeri WHERE id = ?', array('bindValues' => array($id)));
$resimsil = '../yukleme/galeri/'.$kategoriveri->resim;
 @unlink($resimsil); 
$sil = $dw->delete('galeri', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));

          $rsorgu = "Select * from galeriresimler WHERE urunid='$id'";
          $rlist = $dw->getResults(''.$rsorgu.'');
          foreach($rlist as $rrow){
            $resimsil2 = '../yukleme/galeri/'.$rrow->resim;
            @unlink($resimsil2); 
            } 
$sil2 = $dw->delete('galeriresimler', array('urunid = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Silindi!<br>Bilgiler başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=galeri">
<?php
}  else if ( $islem =="tumresimlersil" )  {           // Tüm bilgileri siler

$id = intval( $_GET[id] );


          $rsorgu = "Select * from galeriresimler WHERE urunid='$id'";
          $rlist = $dw->getResults(''.$rsorgu.'');
          foreach($rlist as $rrow){
            $resimsil2 = '../yukleme/galeri/'.$rrow->resim;
            @unlink($resimsil2); 
            } 
$sil2 = $dw->delete('galeriresimler', array('urunid = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Silindi!<br>Bilgiler başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=galeri&islem=duzenle1&id=<?php echo $id; ?>">

<? 
}
?>            
</div>