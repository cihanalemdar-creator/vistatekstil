<?
ob_start();
	session_start();
	$_SESSION["dili"] = $_GET['lang'];
		if ($_GET['lang'] == "tr") {
			$_SESSION["dilikod"] = 1;
		} elseif ($_GET['lang'] == "en") {
			$_SESSION["dilikod"] = 2;
		} elseif ($_GET['lang'] == "ar") {
			$_SESSION["dilikod"] = 3;
		} 
		else {
		$_SESSION["dilikod"] = 1;	
		}

ob_end_flush();
?>