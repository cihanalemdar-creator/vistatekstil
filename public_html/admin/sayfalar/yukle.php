<?php 

$klasor="../yukleme/urunresimleri";
	$dosya_sayi=count($_FILES['dosya']['name']); 
	for($i=0;$i<$dosya_sayi;$i++){ 
		if(!empty($_FILES['dosya']['name'][$i])){ 
		 move_uploaded_file($_FILES['dosya']['tmp_name'][$i],$klasor."/".$_FILES['dosya']['name'][$i]); 
		 $uploadimage = mysql_query(" BURAYA RESMİN KAYDEDİLECEĞİ SORGUYU YAZIN. ");
		} 
	}
	
?>