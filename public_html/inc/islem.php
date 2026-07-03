<?php 
ini_set('max_execution_time', 0); 
$dir = './inc/';
require_once $dir."database.php";
require_once $dir."DW_class.php";
$dw = new DWDB();
require_once $dir."kgPager.class.php";






if(isset($_POST['mesajgonder']))
{
strip_tags($adsoyad)=$_POST["adsoyad"];
strip_tags($email=)$_POST["email"];
strip_tags($konu)   =$_POST["konu"];
strip_tags($telefon)=$_POST["telefon"];
strip_tags($mesaj)=$_POST["mesaj"];
strip_tags($gorev)=$_POST["gorev"];

$veri = array(
   'adsoyad' => $adsoyad,
   'email' => $email,
   'konu' => $konu,
   'telefon' => $telefon,
   'mesaj' => $mesaj,
   'gorev' => $gorev
);


$mesajekle = $dw->insert('iletisimformu', $veri, array('configKey' => 'secondaryDB'));

if($mesajekle)
{
 header("Location:iletisim?ekle=ok");
}  else 
   {
      header("Location:iletisim?ekle=no");
   }





}
     








?>