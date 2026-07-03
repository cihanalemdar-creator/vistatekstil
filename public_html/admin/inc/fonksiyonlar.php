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


function getYoutubeEmbedUrl($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}


function tarih_duzelt($date)
{
    date_default_timezone_set('UTC');
    setlocale(LC_ALL,'tr_TR.UTF-8');
    return strftime('%e %B %Y' , strtotime($date));
}


function buildTree($elements,$parentId = 0){

$branch = array();

foreach ($elements as $element) {
        
        if($element->parent_id==$parentId)
        {
            $children =  buildTree($elements, $element->id);

            if($children){
                $element->children = $children;
            }
            else
            {
              $element->children = array();  
            }

            $branch[] = $element;
        }

    }

return $branch;

}


function drawElement($items){
     echo "<ul>";
    foreach ($items as $item) {
        echo "<li>{$item->baslik}</li>";

        if(sizeof($item->children) > 0)
        {
            drawElement($item->children);
        }
    }
    echo "</ul>";



}






?>

