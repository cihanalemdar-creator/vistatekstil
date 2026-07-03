<?php 
ini_set('max_execution_time', 0); 
require_once 'inc/database.php';
require_once 'inc/DW_class.php';
require_once 'inc/class.upload.php';
$dw = new DWDB();
$Oturum=@session_id();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * upload.php
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */
// HTTP headers for no cache etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Settings
$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
$targetDir = '../yukleme/referanslar';

$cleanupTargetDir = true; // Remove old files
$maxFileAge = 6 * 3600; // Temp file age in seconds

// 5 minutes execution time
@set_time_limit(6 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Get parameters
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

// Clean the fileName for security reasons
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

// Make sure the fileName is unique but only if chunking is disabled
if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);
	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;
	$fileName = $fileName_a . '_' . $count . $fileName_b;
}
$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
// Create target dir
if (!file_exists($targetDir))
	@mkdir($targetDir);
// Remove old temp files	
if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
} else
	die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7777
		 $handle = new Upload($_FILES['file']);
		  if ($handle->uploaded) {
			  list($w,$h) = getimagesize($handle->file_src_pathname);

				  $handle->file_new_name_body   = 'b_'.rand(1111111,99999999);
				  $handle->image_resize         = true;
				  $handle->image_x              = 900;
				  $handle->image_y              = 900;
				  $handle->image_ratio_fill      = false;
				  $handle->image_convert = 'jpg';
				  $handle->jpeg_quality = 100;
				  $handle->image_convert = 'jpg';
				  $handle->allowed = array('image/*');	
				  $handle->process('../yukleme/referanslar/');
				  $BRS = $handle->file_dst_name;

		 }
		$deger = intval( $_GET[id] );
		$tur = $_GET[tur];




			$resimveri = array(
			   'sira' => 0,
			   'resim' => $BRS,
			   'urunid' => $deger,
			   'sessionID' => $Oturum
			);

			$urunID = $dw->insert('referansresimler', $resimveri, array('configKey' => 'secondaryDB'));
		 

?>

