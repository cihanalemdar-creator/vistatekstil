<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2>SEO Yönetimi</h2>
    </div>   
</div>
<div class="wrapper wrapper-content animated fadeInRight">

<?php
$islem = $_GET[islem];
if ( $islem =="" ) {   
    $id = 1;
$vericek = $dw->getRow('SELECT * FROM seoayari WHERE id = ?', array('bindValues' => array($id)));
?>
    <div class="row">
        <form method="post" action="index.php?sayfa=seo&islem=duzenlendi" >
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Site İçi SEO Yönetimi</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Title (Site Başlığı)</label>
                            <input type="text" class="form-control" rows="2" name="title" value="<?php echo $vericek->title;?>" required>
                            </div>
                        </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Author (Site Sahibi veya Firma İsmi)</label>
                    <input type="text" class="form-control" rows="3" name="author" value="<?php echo $vericek->author;?>" required>
                    </div>
                    </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Keywords (Site Anahtar Kelimeleri)</label>                     
                                <textarea type="text"  name="keywords" rows="4" class="form-control" required><?php echo $vericek->keywords;?></textarea>
                            </div>
                        </div>                    

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Description (Site Açıklaması)</label>                     
                                <textarea type="text" name="description" rows="4" class="form-control" required><?php echo $vericek->description;?></textarea>
                            </div>
                        </div>
                       						
						
                </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-right">
            <button class="btn btn-primary" type="submit">SEO Ayarlarını Güncelle</button>
        </div>
        </form>
    </div>

<?php 
} else if ( $islem =="duzenlendi")  {
$id = "1";
$title = $_POST['title'];
$description = $_POST['description'];
$keywords = $_POST['keywords'];
$author = $_POST['author'];




$veri = array(
   'title'       => $title,
   'description' => $description,
   'keywords'    => $keywords,
   'author'      => $author,
); 




$guncelle = $dw->update('seoayari', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
?>
<div class="alert alert-success">SEO Ayarları Güncellendi!<br>SEO ayarları başarıyla güncellendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
<meta http-equiv="refresh" content="2; URL=index.php?sayfa=seo">
<? 


}
?>

</div>