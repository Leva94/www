<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	if(isset($_GET['lang'])) {
		
		if($_GET['lang'] == 'ua' OR $_GET['lang']=='ru' OR $_GET['lang']=='en') {
			$_SESSION['uLANG'] = $_GET['lang'];
		}
		
	} else {
		
		$_SESSION['uLANG'] = 'en';
		
	}
	
	if(isset($_SERVER['HTTP_REFERER'])) {
		header("location: $_SERVER[HTTP_REFERER]");
	} else {
		header("location: index.php");
	}
