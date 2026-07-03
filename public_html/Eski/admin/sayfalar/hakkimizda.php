<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>Hakkımızda</h2>
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
                    <h5>Hakkımızda Ayarları</h5><!--Ekle Butonu oluşturuluyor.-->
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="90%">Başlık</th>
								<th width="10%">İşlem</th>
                            </tr>
                            
                            
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM hakkimizda  order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=hakkimizda&page='; 
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
                                    <a href="?sayfa=hakkimizda&islem=duzenle1&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="fa fa-edit"></i></a>
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
        <form action="index.php?sayfa=hakkimizda&islem=eklendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Başlık Ekle</h5>
                </div>
                <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Başlık (TR)</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control"required>
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Başlık (EN)</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control"required>
                                </div>
                            </div>
                        </div>
						
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (TR)</label>
                                    <textarea name="detay" id="detay" class="form-control" style="width:800px; height:200px;" required></textarea>
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (EN)</label>
                                    <textarea name="detayEN" id="detayEN" class="form-control" style="width:800px; height:200px;" required></textarea>
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
} else if ( $islem =="eklendi" )  {         // Ekleye tıklandığında çalışacak komut
$baslik=$_POST["baslik"];
$baslikEN=$_POST["baslikEN"];
$detay=$_POST["detay"];
$detayEN=$_POST["detayEN"];



$veri = array(
   'baslik' => $baslik,
   'baslikEN' => $baslikEN,
   'detay' => $detay,
   'detayEN' => $detayEN,
 
);

$YoneticiID = $dw->insert('hakkimizda', $veri, array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Eklendi!<br>Bilgiler başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hakkimizda">
<? 
} else if ( $islem =="duzenle1" )  {     // Düzenleye tıklandığında textler oluşur ve içerisine kayıtlı olan veriler gelir.
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM hakkimizda WHERE id = ?', array('bindValues' => array($id)));
?>

    <div class="row">
        <form action="index.php?sayfa=hakkimizda&islem=duzenlendi1" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bilgileri Güncelle</h5>
                </div>
                <div class="ibox-content">
                        <div class="row">
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Başlık (TR)</label>
                                    <input type="text" name="baslik" id="baslik" class="form-control" value="<?php echo $veri->baslik;?>" required>
                                </div>
                            </div>
							
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Başlık (EN)</label>
                                    <input type="text" name="baslikEN" id="baslikEN" class="form-control" value="<?php echo $veri->baslikEN;?>" required>
                                </div>
                            </div>
							
                        </div> 
                       
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (TR)</label>
                                    <textarea name="detay" class="form-control" style="width:800px; height:200px;"><?php echo $veri->detay;?></textarea>
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Detay (EN)</label>
                                    <textarea name="detayEN" class="form-control" style="width:800px; height:200px;"><?php echo $veri->detayEN;?></textarea>
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
        </form>
    </div>


<? 
} else if ( $islem =="duzenle2" )  {     // Düzenleye tıklandığında textler oluşur ve içerisine kayıtlı olan veriler gelir.
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM hakkimizda WHERE id = ?', array('bindValues' => array($id)));
?>

    <div class="row">
        <form action="index.php?sayfa=hakkimizda&islem=duzenlendi2" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bilgileri Güncelle</h5>
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
} else if ( $islem =="duzenlendi1" )  {        // Düzenle dediğinde çalışacak komut
$id = $_POST[id];
$baslik=$_POST["baslik"];
$baslikEN=$_POST["baslikEN"];
$detay=$_POST["detay"];
$detayEN=$_POST["detayEN"];



if ($Resim == "") {
$veri = array(
   'baslik' =>$baslik,
   'baslikEN' =>$baslikEN,
   'detay'=>$detay,
   'detayEN'=>$detayEN,
);
} else {
$veri = array(
   'baslik' =>$baslik,
);
}


$guncelle = $dw->update('hakkimizda', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Bilgiler Güncellendi!<br>Bilgiler başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=hakkimizda">


<? 
}
?>            
</div>