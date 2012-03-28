<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	$dani = true;
	if(isset($_POST['text'], $_POST['nid'], $_SESSION['uID'], $_POST['title']) 
	   AND $_POST['text'] != '' AND is_numeric($_POST['nid']) AND is_numeric($_SESSION['uID'])) {
		   $text = htmlspecialchars(trim($_POST['text']));
		   $nid  = $_POST['nid'];
		   $uID = $_SESSION['uID'];
		   $title = htmlspecialchars($_POST['title']);
	}
	if($dani == false) { 
		$url = $host.'news.php?nid='.$nid.'&st=error';
		header("Location: $url"); exit();
	}
	
	$insertRow = array($text, $title);
	$STH = $DB->prepare("INSERT INTO t_comments (c_news, c_text, c_title, c_add_user) VALUES ($nid, ?, ?, $uID)");
		
	if($STH->execute($insertRow)) {
		$url = $host.'news.php?nid='.$nid.'&comment=add';
		header("Location: $url"); exit();
	} else {
		$url = $host.'news.php?nid='.$nid.'&st=error';
		header("Location: $url"); exit();

	}
