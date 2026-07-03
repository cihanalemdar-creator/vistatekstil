
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h2>Varyant Ekle</h2>
		</div>   
	</div>

	<div class="wrapper wrapper-content animated fadeInRight">

	<?php
		$islem = $_GET[islem];
		if ( $islem =="" ) {  
	?>
	
	<?php 
		} 	
		
		else if ( $islem =="varyantekle" )  {
		$urunid = intval( $_GET[id] ); 
	?>

	<div class="col-md-12">
          <form id="myform" action="index.php?sayfa=urunler&islem=varyanteklendi" method="post" >
            <div class="widget">
              <header class="widget-header">
                <h4 class="widget-title">Varyant Ekle</h4>
              </header><!-- .widget-header -->

              <hr class="widget-separator">
              <div class="widget-body">
               <div class="row">
                 <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Ürün Kodu</label>

                    <input type="text" name="urunkod" id="urunkod" class="form-control"  required="">

                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Ölçü</label>

                    <input type="text" name="olcu" id="olcu" class="form-control"  required="">

                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Kutu İçi Adedi</label>

                    <input type="text" name="adet" id="adet" class="form-control"  required="">

                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Kutu Ölçüsü</label>

                    <input type="text" name="kutuolcu" id="kutuolcu" class="form-control"  required="">

                  </div>
                </div>

              </div>                   

              <input type="hidden" name="urunid" id="urunid" value="<?php echo $urunid;?>" class="form-control"  required="">

              <div class="row">
                <div class="col-lg-12 text-right">
                  <a href="index.php?sayfa=urunler&islem=varyant&id=<?php echo $urunid;?>" class="btn btn-danger">İptal</a>
                  <button class="btn btn-primary btn-kontrol" type="submit">Bilgileri Kaydet</button>

                </div>
              </div>
            </div><!-- .widget-body -->
          </div><!-- .widget -->
        </form>
      </div><!-- END column -->
	  
	<?php  

    } else if ( $islem =="varyanteklendi" )  {


      $urunkod=$_POST["urunkod"];
      $olcu=$_POST["olcu"];
      $adet=$_POST["adet"];
      $kutuolcu=$_POST["kutuolcu"];
      $urunid=$_POST["urunid"];



      $veri = array(
        'urunkod' => $urunkod,
        'olcu' => $olcu,
        'adet' => $adet,
        'kutuolcu' => $kutuolcu,    
        'urun_id'=> $urunid
      );


      $YoneticiID = $dw->insert('varyant', $veri, array('configKey' => 'secondaryDB'));

	?>
	
	  <div class="widget">
        <div class="widget-body">
          <div class="alert alert-success">Veri Eklendi!<br>Veri başarıyla eklendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
        </div>
      </div>

      <meta http-equiv="refresh" content="2; URL=index.php?sayfa=urunler&islem=varyant&id=<?php echo $urunid;?>">
	
	<? 



    } else if ( $islem =="varyantduzenle" )  {

      $urunid = intval( $_GET[urunid] );
      $varyantid = intval($_GET[id]);   
      $veri = $dw->getRow('SELECT * FROM varyant WHERE id = ?', array('bindValues' => array($varyantid)));

    ?>
	
	<!-- DOM dataTable -->

      <div class="col-md-12">
        <form id="myform" action="index.php?sayfa=urunler&islem=varyantduzenlendi" method="post" >
          <div class="widget">
            <header class="widget-header">
              <h4 class="widget-title">Varyant Güncelle</h4>
            </header><!-- .widget-header -->

            <hr class="widget-separator">
            <div class="widget-body">
             <div class="row">
               <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Ürün Kodu</label>

                  <input type="text" name="urunkod" id="urunkod" value="<?php echo $veri->urunkod;?>" class="form-control"  required="">

                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Ölçü</label>

                  <input type="text" name="olcu" id="olcu" value="<?php echo $veri->olcu;?>"  class="form-control"  required="">

                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Kutu İçi Adedi</label>

                  <input type="text" name="adet" id="adet" value="<?php echo $veri->adet;?>"  class="form-control"  required="">

                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Kutu Ölçüsü</label>

                  <input type="text" name="kutuolcu" id="kutuolcu" value="<?php echo $veri->kutuolcu;?>"  class="form-control"  required="">

                </div>
              </div>

            </div>                   
            <input type="hidden" name="urunid" value="<?php echo $urunid;?>">
            <input type="hidden" name="id" id="id" value="<?php echo $veri->id;?>" class="form-control"  required="">

            <div class="row">
              <div class="col-lg-12 text-right">
                <a href="index.php?sayfa=urunler&islem=varyant&id=<?php echo $urunid;?>" class="btn btn-danger">İptal</a>
                <button class="btn btn-primary btn-kontrol" type="submit">Bilgileri Güncelle</button>

              </div>
            </div>
          </div><!-- .widget-body -->
        </div><!-- .widget -->
      </form>
    </div><!-- END column -->
	
	    <?php


  } else if ( $islem =="varyantduzenlendi" )  {

    $urunid = $_POST["urunid"];
    $id = $_POST[id];
    $urunkod=$_POST["urunkod"];
    $olcu=$_POST["olcu"];
    $adet=$_POST["adet"];
    $kutuolcu=$_POST["kutuolcu"];            



    $veri = array(

      'urunkod' => $urunkod,
      'olcu' => $olcu,
      'adet' => $adet,
      'kutuolcu' => $kutuolcu


    );
    $guncelle = $dw->update('varyant', $veri, array('id = ?'), array($id), array('configKey' => 'secondaryDB'));
    ?>


    <div class="widget">
      <div class="widget-body">
        <div class="alert alert-success">Veri Düzenlendi!<br>Veri başarıyla düzenlendi. Lütfen bekleyin yönlendiriliyorsunuz.</div>
      </div>
    </div>

    <meta http-equiv="refresh" content="2; URL=index.php?sayfa=urunler&islem=varyant&id=<?php echo $urunid;?>">



	<? } ?>            
	</div>