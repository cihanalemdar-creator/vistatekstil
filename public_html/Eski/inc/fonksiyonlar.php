<?php
function seo_link($link) { // seo için function
$link = trim($link);
$eski = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ','\'','|','/','`','&#39;','&quot;','&',',','.','?','®',')','(','{','}','[',']','"');
$yeni = array('c','c','g','g','i','i','o','o','s','s','u','u','-','-','','-','','','','','','','','','','','','','','','');
$seo_link = str_replace($eski,$yeni,$link);
$seo_link = strtolower($seo_link);
return $seo_link;
}


//* Dil
function dil($tr, $en){
    if($_SESSION["dili"] == "tr"){
        return $tr;
    }elseif($_SESSION["dili"] == "en"){
        return $en;
    }else{
        return $tr;
    }
}
ob_start();
session_start();
$Oturum=@session_id();

?>

