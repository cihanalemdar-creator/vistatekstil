<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Ürün Kategorileri</h2>
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
                    <h5>Ürün Kategori Ayarlar</h5>
                    <a href="index.php?sayfa=urunkategoriler&islem=ekle" class="btn btn-success dim pull-right" style="margin-top: -8px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="45%">Ürün Kategorileri</th>
                                <th width="10%">İşlem</th>
                            </tr>
                            
                            
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM urunkategoriler order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=urunkategoriler&page='; 
                        $scroll_page = 5; 
                        $per_page = 10; 
                        $current_page = $_GET['page'];
                        $inactive_page_tag = 'id="current_page"';
                        $previous_page_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
                        $next_page_text = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        $first_page_text = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
                        $last_page_text = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>'; 
                        $kgPagerOBJ = & new kgPager();
                        $kgPagerOBJ -> pager_set($pager_url, $total_records, $scroll_page, $per_page, $current_page, $inactive_page_tag, $previous_page_text, $next_page_text, $first_page_text, $last_page_text, $pager_url_last);

                        $list2 = $dw->getResults(''.$sorgu.' LIMIT '.$kgPagerOBJ -> start.", ".$kgPagerOBJ -> per_page.'');
                        if($total_records == 0){
                        ?>
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert" style="margin-top:5px;margin-bottom:5px;">
                                        <strong>Bilgilendirme!</strong><br>
                                        Veri bulunmadı...
                                    </div>

                                </td>
                            </tr>
                        <?php
                        } else {

                        foreach($list2 as $row){
                        ?>
                            <tr id="item-<?php echo $row->id;?>">
                                <td style="vertical-align: middle;"><?php echo $row->urunkategori; ?></td>
								<td style="vertical-align: middle;" class="tooltip-demo">
                                    <a href="?sayfa=urunkategoriler&islem=duzenle&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-edit"></i></a><!--düzenleyi oluşturuyor -->
                                    <a href="?sayfa=urunkategoriler&islem=sil&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" onclick="return confirm('Bilgileri silmek istediğinize emin misiniz?');" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-times"></i></a><!--Silmeyi oluşturur.-->
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
                                Toplam <?php echo $kgPagerOBJ -> total_pages;?> sayfada, <?php echo $total_records;?> veri listeleniyor.<!-- sayfada kaç veri olduğunu gösterir-->
                            </div>
                            <div class="col-sm-7 hidden-xs" >
                                <ul class="pagination pull-right" style="margin:0;">
                                <?
                                echo $kgPagerOBJ -> first_page;
                                echo $kgPagerOBJ -> previous_page;// Önceki sonraki sayfa
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
                                <option value="?sayfa=urunkategoriler&page=<?php echo $yillar;?>" <? if ($yillar == $_GET['page']) { echo "selected"; };?>><?php echo $yillar;?></option>
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
} else if ( $islem =="ekle" )  {
?>

    <div class="row">
        <form action="index.php?sayfa=urunkategoriler&islem=eklendi" method="post" enctype="multipart/form-data"><!-- Ekleye tıklandığında-->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ürün Kategorisi Ekle</h5>
                </div>
                <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Ürün Kategori TR</label>
                                    <input type="text" name="urunkategori" id="urunkategori" class="form-control" required>
                                </div>
                            </div>
							 <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Ürün Kategori EN</label>
                                    <input type="text" name="urunkategoriEN" id="urunkategoriEN" class="form-control" required>
                                </div>
                            </div>
						</div>
						
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
								<label class="control-label">Kategori Kapak Resmi</label>
								 <div class="alert alert-info">
									   <strong>Önemli bilgilendirme!</strong><br>
									  Slaytın bozulmaması ve düzgün görünmesi için 415 px X 245 px boyutlu fotoğraf yükleyiniz.<br>
								 </div>

								<input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false" required="">
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
$urunkategori=$_POST["urunkategori"];
$urunkategoriEN=$_POST["urunkategoriEN"];

include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = true;            // Resim eklemek için
$upload->image_ratio_fill = true;
$upload->image_background_color = '#fff';
$upload->image_x = 415;
$upload->image_y = 245;
$upload->process("../yukleme/urunler");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}

$veri = array(
	'url' =>  seo_link($urunkategori),
	'urunkategori' => $urunkategori,
	'urunkategoriEN' => $urunkategoriEN,
	'resim' => $Resim,   
);

$YoneticiID = $dw->insert('urunkategoriler', $veri, array('configKey' => 'secondaryDB'));

?>
<div class="alert alert-success">Bilgiler Eklendi!<br>Bilgiler başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=urunkategoriler">
<? 
} else if ( $islem =="duzenle" )  {
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM urunkategoriler WHERE id = ?', array('bindValues' => array($id)));
?>

    <div class="row">
        <form action="index.php?sayfa=urunkategoriler&islem=duzenlendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bilgileri Güncelle</h5>
                </div>
                <div class="ibox-content">
												
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Ürün Kategori TR</label>
                                    <input type="text" name="urunkategori" id="urunkategori" class="form-control" value="<?php echo $veri->urunkategori;?>" required>
                                </div>
                            </div>
							
							 <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Ürün Kategori EN</label>
                                    <input type="text" name="urunkategoriEN" id="urunkategoriEN" class="form-control" value="<?php echo $veri->urunkategoriEN;?>" required>
                                </div>
                            </div>
                           
                        </div>
						
						<div class="row">
							
							<?
							if (!$veri->resim =="" ) { 
							?>
							<div class="col-sm-12">
								<label>Ürün Kategori Kapak Resmini Sil</label>
								<div class="form-group">
								  
									<img width="155px" height="92px" src="../yukleme/urunler/<?php echo $veri->resim; ?>">
								</div>
								<div class="form-group">
									<a class="btn btn-danger" href="index.php?sayfa=urunkategoriler&islem=resimsil1&id=<?php echo $veri->id;?>" onclick="return confirm('Resmi silmek istediğinize emin misiniz?');">Resmi Sil</a>
								</div>
							</div>
							<?php  } else { ?> 
							
							<div class="col-sm-12">
								<div class="form-group">
							
								   <input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false" required="">
								</div>
							</div>
							<?php } ?>
						</div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <input type="hidden" name="id" value="<?php echo $veri->id;?>">
            <button class="btn btn-primary" type="submit">Bilgileri Güncelle</button>
        </div>
        </form>
    </div>

<?php
} else if ( $islem =="duzenlendi" )  {
$id = $_POST[id];
$urunkategori=$_POST["urunkategori"];
$urunkategoriEN=$_POST["urunkategoriEN"];

include_once('inc/class.upload.php');
$upload = new upload($_FILES['resimler']);
if ($upload->uploaded){
$upload->allowed = array('image/*'); 
$upload->file_auto_rename = true;
$upload->image_resize = true;            // Resim eklemek için
$upload->image_ratio_fill = true;
$upload->image_background_color = '#fff';
$upload->image_x = 415;
$upload->image_y = 245;
$upload->process("../yukleme/urunler");
    
if ($upload->processed){
$Resim=''.$upload->file_dst_name.'';
}
}
if ($Resim == "") {
$veri = array(
    'url' =>  seo_link($kategori),
    'urunkategori' => $urunkategori,
    'urunkategoriEN' => $urunkategoriEN,
);
} else {

$veri = array(
    'url' =>  seo_link($urunkategori),
    'urunkategori' => $urunkategori,
    'urunkategoriEN' => $urunkategoriEN,
	'resim' => $Resim,
);  
}

$guncelle = $dw->update('urunkategoriler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=urunkategoriler">
<? 
} else if ( $islem =="sil" )  {

$id = intval( $_GET[id] );

$sil = $dw->delete('urunkategoriler', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Silindi!<br>Bilgiler başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=urunkategoriler">

<?php } else if ( $islem =="resimsil1" )  {
$id = intval( $_GET[id] );
$kategoriveri = $dw->getRow('SELECT * FROM urunkategoriler WHERE id = ?', array('bindValues' => array($id)));

$veri = array(
   'resim' => ""
);
$sil = '../yukleme/urunler/'.$kategoriveri->resim;
@unlink($sil);  
$guncelle = $dw->update('urunkategoriler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=urunkategoriler">

<? 
}
?>            
</div>