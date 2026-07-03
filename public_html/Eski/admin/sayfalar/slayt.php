<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Slayt Yönetimi</h2>
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
                    <h5>Slayt Resim Listesi</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
								<th width="45%">Başlık</th>
								<th width="45%">Açıklama</th>
                                <th width="5%">İşlem</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM slayt_resim order by id desc";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=slayt&page='; 
                        $scroll_page = 5; 
                        $per_page = 5000; 
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
                        } else {
                        foreach($list2 as $row){

                        ?>
                            <tr id="item-<?php echo $row->id;?>">
                                <td style="vertical-align: middle;text-align: center;"><?php echo $row->id; ?></td>
								<td style="vertical-align: middle;"><?php echo $row->baslik;?></td>
								<td style="vertical-align: middle;"><?php echo $row->detay;?></td>
								<td style="vertical-align: middle;text-align: center;" class="tooltip-demo">
                               	<a href="?sayfa=slayt&islem=resimsil&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" onclick="return confirm('Resmi silmek istediğinize emin misiniz?');" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?
                        }}
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <form method="post" action="index.php?sayfa=slayt&islem=yuklendi" enctype="multipart/form-data">
            <input class=" form-control" id="cname" name="id" minlength="2" type="hidden" value="<?php echo $veri->id;?>" required />
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Slayt Resim Ekle</h5>
                </div>
                <div class="ibox-content">
                <div class="row">
                    <div class="alert alert-info">
                    <strong>Önemli bilgilendirme!</strong><br>
                        Slaytın bozulmaması ve düzgün görünmesi için 1510px X 881px boyutlu fotoğraf yükleyiniz.<br>
                    </div>

                    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Slayt Resmi</label>
                                <input type="file" name="resimler" id="resimsec" class="filestyle" data-icon="false">
                            </div>
                        </div>
						
						<div class="col-sm-12">
							<div class="form-group">
                                <label class="control-label">Başlık (TR)</label>
                                <input type="text" name="baslik" id="baslik" class="form-control" >
                            </div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
                                <label class="control-label">Başlık (EN)</label>
                                <input type="text" name="baslikEN" id="baslikEN" class="form-control" >
                            </div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
                                <label class="control-label">Başlık 2 (TR)</label>
                                <input type="text" name="baslik2" id="baslik2" class="form-control" >
                            </div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
                                <label class="control-label">Başlık 2 (EN)</label>
                                <input type="text" name="baslik2EN" id="baslik2EN" class="form-control" >
                            </div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
                                <label class="control-label">Açıklama (TR)</label>
                                <input type="text" name="detay" id="detay" class="form-control" >
                            </div>
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
                                <label class="control-label">Açıklama (EN)</label>
                                <input type="text" name="detayEN" id="detayEN" class="form-control" >
                            </div>
						</div>
							
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" type="submit">Slayt Resmini Ekle</button>
        </div>
        </form>
        </div>
    </div>
<?
} else if ( $islem =="yuklendi" )  { 
$Resim=$_POST['resim'];
$baslik=$_POST['baslik'];
$baslikEN=$_POST['baslikEN'];
$baslik2=$_POST['baslik2'];
$baslik2EN=$_POST['baslik2EN'];
$detay=$_POST['detay'];
$detayEN=$_POST['detayEN'];

include_once('inc/class.upload.php');
    $upload = new upload($_FILES['resimler']);
    if ($upload->uploaded){
    $upload->allowed = array('image/*');    
    $upload->file_auto_rename = true;
    $upload->image_resize = true;
    $upload->image_ratio_fill= true;
    $upload->jpeg_quality = 100;

    $upload->image_x = 1510;
    $upload->image_y = 881;

    $upload->process("../yukleme/slayt");
    

    if ($upload->processed){
    $Resim=''.$upload->file_dst_name.'';
    }
    }


$veri = array(

   'resim' => $Resim,
   'baslik' => $baslik,
   'baslikEN' => $baslikEN,
   'baslik2' => $baslik2,
   'baslik2EN' => $baslik2EN,
   'detay' => $detay,
   'detayEN' => $detayEN,
   

);


$MarkaID = $dw->insert('slayt_resim', $veri, array('configKey' => 'secondaryDB'));


?>
<div class="alert alert-success">Slayt Resmi Eklendi!<br>Slayt resmi başarıyla yüklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=slayt">




<?
} else if ( $islem =="resimsil" )  {
$id = intval( $_GET[id] );
$id2 = intval( $_GET[id2] );
$kategoriveri = $dw->getRow('SELECT * FROM slayt_resim WHERE id = ?', array('bindValues' => array($id)));

$sil = $dw->delete('slayt_resim', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));


$sil = '../yukleme/slayt/'.$kategoriveri->resim;
@unlink($sil);   
?>
<div class="alert alert-success">Slayt Resmi Silindi!<br>Slayt resmi silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=slayt">
<?
}
?>            
</div>