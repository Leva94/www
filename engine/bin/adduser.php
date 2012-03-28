<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	$dani = true;
	
	if(isset($_POST['login']) AND $_POST['login'] != '') {
		$login = htmlspecialchars(trim($_POST['login']));
		$_SESSION['tmp_login'] = $login;
	} else { $dani = false; }
	
	if(isset($_POST['pass'])  and $_POST['pass']  != '' AND $_POST['pass'] == $_POST['confpass']) {
		$pass  = md5(md5(trim($_POST['pass'])));
		$_SESSION['tmp_pass'] = $pass;
	} else { $dani = false; }
	
	if(isset($_POST['mail']) and (preg_match('|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,6})|is',trim($_POST['mail'])))) {
		$mail = trim($_POST['mail']);
		$_SESSION['tmp_mail'] = $mail;
	} else {$dani = false;}
	
	if(isset($_POST['sex']) and is_numeric($_POST['sex'])) {
		$sex = $_POST['sex'];
		$_SESSION['tmp_sex'] = $sex;
	} else { $dani = false; }
	
	if(isset($_POST['bday']) and is_numeric($_POST['bday'])) {
		$bday = $_POST['bday'];
		$_SESSION['tmp_bday'] = $bday;
	} else { $dani = false; }
	
	if(isset($_POST['bmonth']) and is_numeric($_POST['bmonth'])) {
		$bmonth = $_POST['bmonth'];
		$_SESSION['tmp_bmonth'] = $bmonth;
	} else { $dani = false; }
	
	if(isset($_POST['byear']) and is_numeric($_POST['byear'])) {
		$byear = $_POST['byear'];
		$_SESSION['tmp_byear'] = $byear;
	} else { $dani = false;	}
	
	if(isset($_POST['aboutme'])) {
		$about = htmlspecialchars($_POST['aboutme']);
		$_SESSION['tmp_about'] = $about;
	} else { $dani = false; }
	
	if($dani == false) { 
		$url = $host.'welcome.php?sk=reg&er=1';  
		header("Location: $url");
		exit(); 
	}
	
	// Confirm repeat login or email
	$STH = $DB->prepare("SELECT COUNT(*) AS count FROM t_users WHERE u_login='?' OR u_mail='?'");
	$STH->execute(array($login, $mail));
	$users = $STH->fetchAll();
	
	if($users['count'] != 0) {
		$url = $host.'welcome.php?sk=reg&er=1';  
		header("Location: $url");
		exit(); 
	}
	
	// Add new uder in DB
	$insertData = array($login, $mail, $pass, $sex, $bday, $bmonth, $byear, $about);
	$STH = $DB->prepare("INSERT INTO t_users (u_login, u_mail, u_pass, u_sex, u_bday, u_bmonth, u_byear, u_about, u_group, u_lastvisit) 
								 VALUES (?, ?, ?, ?, ?, ?, ?, ?, 3, NOW())");
	if($STH->execute($insertData)) {
		// Auth new user and create session
		$STH = $DB->query("SELECT u_id, u_pass, u_login, u_group FROM t_users WHERE u_login='$login'");
		
		if($QRow = $STH->fetch()){
			if ($QRow['u_pass']==$pass) {
				$_SESSION['uID']=$QRow['u_id'];
				$_SESSION['uPASS']=$QRow['u_pass'];
				$_SESSION['uNAME']=$QRow['u_login'];
				$_SESSION['uGROUP']=$QRow['u_group'];
			} else { echo 'error'; }
		} else { echo 'erroo2'; }
		
		$url = $host.'index.php';
		header("Location: $url"); exit();
	} else {
		$url = $host.'welcome.php?sk=reg&er=2'; header("Location: $url"); 
	}
