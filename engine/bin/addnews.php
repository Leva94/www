<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	$dani = true;
	
	if((isset($_POST['content']) AND isset($_POST['title']) AND $_POST['content'] != '' AND $_POST['title'] != '') AND
	   (isset($_POST['content_en']) AND isset($_POST['title_en']) AND $_POST['content_en'] != '' AND $_POST['title_en'] != '')) {
		  $title = htmlspecialchars($_POST['title']);
		  $title_en = htmlspecialchars($_POST['title_en']);
		  $content  = htmlspecialchars($_POST['content']);
		  $content_en  = htmlspecialchars($_POST['content_en']);  
		  
    } else { 
		$_SESSION['tmp_content'] = $_POST['content'];
		$_SESSION['tmp_title'] = $_POST['title'];
		$_SESSION['tmp_content_en'] = $_POST['content_en'];
		$_SESSION['tmp_title_en'] = $_POST['title_en'];
		
		$dani = false; 
	}
	
	if(isset($_SESSION['uID']) AND is_numeric($_SESSION['uID'])) {$uID = $_SESSION['uID'];} else {$dani = false;}
	
	if($dani == false) { $url = $host.'news.php?sk=add&er=1'; header("Location: $url"); exit(); }
	
	/*
	$insertData = array($login, $mail, $pass, $sex, $bday, $bmonth, $byear, $about);
	$STH = $DB->prepare("INSERT INTO t_users (u_login, u_mail, u_pass, u_sex, u_bday, u_bmonth, u_byear, u_about, u_group) 
								 VALUES (?, ?, ?, ?, ?, ?, ?, ?, 3)");
	if($STH->execute($insertData)) */
	
	$insertData = array($title, $title_en, $content, $content_en);
	$STH = $DB->prepare("INSERT INTO t_news (n_title, n_title_en, n_text, n_text_en, n_add_user) 
								 VALUES (?, ?, ?, ?, $uID)");
									  
	if($STH->execute($insertData)) {
		$STH = $DB->query("SELECT n_id AS nID FROM t_news WHERE n_add_user='$uID' ORDER BY n_id DESC LIMIT 1");
		$IDNews = $STH->fetch();
		$url = $host.'news.php?nid='.$IDNews['nID'].'&st=addok';
		header("Location: $url"); exit();
	} else {
		$url = $host.'news.php?sk=add&er=2'; header("Location: $url"); 
	}
?>
