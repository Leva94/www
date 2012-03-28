<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	if(isset($_POST['login'], $_POST['pass']) AND $_POST['login'] != '' AND $_POST['pass']  != '') {
		$login = $_POST['login'];
		$pass  = md5(md5($_POST['pass']));
	} else {
		 $url = $host.'welcome.php?sk=auth&er=1'; header("Location: $url"); exit(); 
	}
	
	$STH = $DB->query("SELECT u_id, u_pass, u_login, u_group FROM t_users WHERE u_login='$login'");
		
	if($QRow = $STH->fetch()){
		if ($QRow['u_pass']==$pass) {
			$_SESSION['uID']=$QRow['u_id'];
			$_SESSION['uPASS']=$QRow['u_pass'];
			$_SESSION['uNAME']=$QRow['u_login'];
			$_SESSION['uGROUP']=$QRow['u_group'];
			
			// Обноваление поля lastvisit
			$STH = $DB->prepare("UPDATE t_users SET u_lastvisit=NOW() WHERE u_id=$QRow[u_id]");
			if(!$STH->execute()) {
				$url = $host.'welcome.php?sk=auth&er=4'; header("Location: $url");
			} 
			
			header("Location: $_SERVER[HTTP_REFERER]");
		} else {
			$url = $host.'welcome.php?sk=auth&er=2'; header("Location: $url"); 
		}
	} else {
		$url = $host.'welcome.php?sk=auth&er=3'; header("Location: $url"); 
	}
?>
