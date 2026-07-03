<?php
require_once "inc/database.php";
require_once "inc/DW_class.php";
$dw = new DWDB();

ob_start();

$kontrol = $dw->getRow('SELECT * FROM yoneticiler WHERE oturum = ?', array('bindValues' => array($Oturum)));

$veriler = array(
   'oturum' => '' 
);

$guncelle = $dw->update('yoneticiler', $veriler, array('id = ?'), array($kontrol->id), array('configKey' => 'secondaryDB'));

unset($_SESSION['yonetici']);
unset($_SESSION['dijilogin']);
unset($_SESSION['yoneticiid']);

ob_end_flush();

header("Location:index.php");

?>


