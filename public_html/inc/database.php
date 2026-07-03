<?php
$db = array(
  "default" => array(
     "database" => "vistateks_taban2",
     "hostname" => "localhost",
     "username" => "vistateks_user2",
     "password" => "qs9TFaZw2",
     "char_set" => "utf8"
  ),
  "secondaryDB" => array(
     "database" => "vistateks_taban2",
     "hostname" => "localhost",
     "username" => "vistateks_user2",
     "password" => "qs9TFaZw2",
     "char_set" => "utf8"
  )
);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '256M');
date_default_timezone_set('Europe/Istanbul'); 

function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip=$_SERVER['REMOTE_ADDR'];  
    }
    return $ip;  
}
$ipadresi = getRealIpAddr();

$gun = date("d");
$ay = date("m");
$yil = date("Y");

session_start();
$Oturum=@session_id();
?>