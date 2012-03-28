<?php
	include('engine/config.php');
	
	unset($_SESSION['uID']);
	unset($_SESSION['uPASS']);
	unset($_SESSION['uNAME']);
	
	if(session_destroy()) {
		header("Location: $host/index.php");
	}
?>