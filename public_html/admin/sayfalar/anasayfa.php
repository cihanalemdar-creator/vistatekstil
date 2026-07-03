<div class="row wrapper border-bottom blue-bg page-heading	">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>NoxeMedia Yönetim Paneli</h2>
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
                    <h5>Yöneticiler</h5>
                  
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="30%">Kullanıcı Adı</th>
                                <th width="30%">Adı Soyadı</th>
                                <th width="15%">E-Posta</th>
                                <th width="15%">Tel</th>
                                
                            </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM yoneticiler where id > 1 order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=yoneticiler&page='; 
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
                                <td style="vertical-align: middle;"><?php echo $row->yonetici; ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->ad; ?> <?php echo $row->soyad; ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->email; ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->tel; ?></td>
                                
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
                            </div>
                            <div class="col-sm-7 hidden-xs" >
                                <ul class="pagination pull-right" style="margin:0;">
                                <?
                                echo $kgPagerOBJ -> first_page;
                                echo $kgPagerOBJ -> previous_page;
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
} else if ( $islem =="ekle" )  {
?>

    <div class="row">
        <form action="index.php?sayfa=yoneticiler&islem=eklendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Yönetici Ekle</h5>
                </div>
                <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Kullanıcı Adı</label>
                                    <input type="text" name="kullanici" id="kullanici" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Şifre</label>
                                    <input type="password" name="sifre" id="sifre" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">E-Posta </label>
                                    <input type="text" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Telefon</label>
                                    <input type="text" name="tel" id="tel" class="form-control" maxlength="11" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Adı</label>
                                    <input type="text" name="ad" id="ad" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Soyadı</label>
                                    <input type="text" name="soyad" id="soyad" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                </div>
            </div>
        
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" type="submit">Yönetici Ekle</button>
        </div>
        </form>
    </div>

<?php 
} else if ( $islem =="eklendi" )  {
$kullanici=$_POST["kullanici"];
$sifre1=$_POST["sifre"];
$sifre = sha1(md5($sifre1));
$email=$_POST["email"];
$ad=$_POST["ad"];
$soyad=$_POST["soyad"];
$tel=$_POST["tel"];





$veri = array(
   'yonetici' => $kullanici,
   'sifre' => $sifre ,
   'email' => $email,
   'tel' => $tel,
   'ad' => $ad,
   'soyad' => $soyad
   
);

$YoneticiID = $dw->insert('yoneticiler', $veri, array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Yönetici Eklendi!<br>Yönetici başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=yoneticiler">
<? 
} else if ( $islem =="duzenle" )  {
$id = intval( $_GET[id] );    

$veri = $dw->getRow('SELECT * FROM yoneticiler WHERE id = ?', array('bindValues' => array($id)));
?>

    <div class="row">
        <form action="index.php?sayfa=yoneticiler&islem=duzenlendi" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Yönetici Güncelle</h5>
                </div>
                <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Kullanıcı Adı </label>
                                    <input type="text" name="kullanici" id="kullanici" class="form-control" value="<?php echo $veri->yonetici;?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Şifre</label>
                                    <input type="text" name="sifre" id="sifre" class="form-control" maxlength="11" placeholder="değiştirmek istemiyorsanız boş bırakın">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">E-Posta </label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $veri->email;?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Telefon </label>
                                    <input type="text" name="tel" id="tel" class="form-control" value="<?php echo $veri->tel;?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Adı</label>
                                    <input type="text" name="ad" id="ad" class="form-control" required value="<?php echo $veri->ad;?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Soyadı</label>
                                    <input type="text" name="soyad" id="soyad" class="form-control" required value="<?php echo $veri->soyad;?>">
                                </div>
                            </div>
                        </div>
                          
                        </div>
                </div>
            </div>
        
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <input type="hidden" name="id" value="<?php echo $veri->id;?>">
            <button class="btn btn-primary" type="submit">Yönetici Güncelle</button>
        </div>
        </form>
    </div>

<?php
} else if ( $islem =="duzenlendi" )  {
$id = $_POST[id];
$kullanici=$_POST["kullanici"];
$sifre1=$_POST["sifre"];
$sifre = sha1(md5($sifre1));
$email=$_POST["email"];
$ad=$_POST["ad"];
$soyad=$_POST["soyad"];
$tel=$_POST["tel"];




if ($sifre1 == "") {
$veri = array(
	
   'yonetici' => $kullanici,
   'email' => $email,
   'tel' => $tel,
   'ad' => $ad,
   'soyad' => $soyad,
  
);
} else {
$veri = array(
   'yonetici' => $kullanici,
   'sifre' => $sifre ,
   'email' => $email,
   'tel' => $tel,
   'ad' => $ad,
   'soyad' => $soyad
   
);
}

$guncelle = $dw->update('yoneticiler', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Yönetici Güncellendi!<br>Yönetici başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=yoneticiler">
<? 
} else if ( $islem =="sil" )  {

$id = intval( $_GET[id] );

$sil = $dw->delete('yoneticiler', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Yönetici Silindi!<br>Yönetici başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=yoneticiler">
<? 
} else if ( $islem =="aktiviteler" )  {
?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Yetkili Aktiviteleri</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="20%">Yönetici Adı</th>
                                <th width="45%">İşlem</th>
                                <th width="15%">Tarih</th>
                                <th width="15%">IP Adresi</th>
                                <th width="5%">İşlem</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php
                        $sorgu = "SELECT * FROM yonetici_aktivite order by id desc ";
                        $list1 = $dw->getResults(''.$sorgu.'');
                        $total_records = $dw->numRows();
                        $pager_url = '?sayfa=yoneticiler&islem=aktiviteler&page='; 
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
                                <td style="vertical-align: middle;"><?php echo $row->yoneticim; ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->islem; ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->tarih; ?></td>
                                <td style="vertical-align: middle;"><?php echo $row->ipadresi; ?></td>
                                <td style="vertical-align: middle;" class="tooltip-demo">
                                    <a href="?sayfa=yoneticiler&islem=islemsil&id=<?php echo $row->id; ?>" class="btn btn-sm waves-effect btn-default m-b-5" onclick="return confirm('Aktiviteyi silmek istediğinize eminmisiniz?');" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-times"></i></a>
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
                            </div>
                            <div class="col-sm-7 hidden-xs" >
                                <ul class="pagination pull-right" style="margin:0;">
                                <?
                                echo $kgPagerOBJ -> first_page;
                                echo $kgPagerOBJ -> previous_page;
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
                                <option value="?sayfa=yoneticiler&islem=aktiviteler&page=<?php echo $yillar;?>" <? if ($yillar == $_GET['page']) { echo "selected"; };?>><?php echo $yillar;?></option>
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
} else if ( $islem =="islemsil" )  {

$id = intval( $_GET[id] );

$sil = $dw->delete('yonetici_aktivite', array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">Aktivite Silindi!<br>Aktivite başarıyla silindi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=yoneticiler&islem=aktiviteler">
<? 
}
?>            
</div>