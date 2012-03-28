<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	$dani = true;
	if(isset($_GET['nid'], $_SESSION['uID']) AND is_numeric($_GET['nid']) AND is_numeric($_SESSION['uID'])) {
		$nID = $_GET['nid'];
		$uID = $_SESSION['uID'];
	} else {
		$url = $host."news.php?nid=".$_GET['nid']."&er=1"; header("Location: $url"); exit(); 
	}

	$delRow = array($uID, $nID);
	$STH = $DB->prepare("DELETE FROM t_newsmarks WHERE m_uid=? AND m_news=?");
		
	if($STH->execute($delRow)) {
		$url = $host."news.php?nid=".$_GET['nid']."&mark=del"; header("Location: $url"); exit(); 
	} else {
		$url = $host."news.php?nid=".$_GET['nid']."&er=2"; header("Location: $url"); exit(); 
	}
?>
