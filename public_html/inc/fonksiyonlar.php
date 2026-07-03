<?php

function seo_link($link) { // seo için function

$link = trim($link);

$eski = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ','\'','|','/','`','&#39;','&quot;','&',',','.','?','®',')','(','{','}','[',']','"','-','_');

$yeni = array('c','c','g','g','i','i','o','o','s','s','u','u','-','-','','-','','','','','','','','','','','','','','','','-','-');

$seo_link = str_replace($eski,$yeni,$link);

$seo_link = strtolower($seo_link);

return $seo_link;

}





ob_start();

session_start();

$Oturum=@session_id();







function tarih_duzelt($date)

{

    date_default_timezone_set('UTC');

    setlocale(LC_ALL,'tr_TR.UTF-8');

    return strftime('%e %B %Y' , strtotime($date));

}



?>



