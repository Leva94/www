<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	$dani = true;
	
	if(isset($_POST['nid'], $_SESSION['uID'])  AND is_numeric($_POST['nid']) AND ($_SESSION['uGROUP'] == 1 OR $_SESSION['uGROUP'] == 2)) {
		$nid  = $_POST['nid'];
	} else {
		 $url = $host."news.php?nid=".$nid."&sk=delete&er=1"; header("Location: $url"); exit(); 
	}

	$STH = $DB->prepare("DELETE FROM t_news WHERE n_id='$nid'");
	if($STH->execute()) { 
			$url = $host."news.php?delete=ok"; header("Location: $url"); exit();
	} else {
			$url = $host."news.php?nid=".$nid."&sk=delete&er=2"; header("Location: $url"); 
	} 
