<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	$dani = true;
	if(isset($_POST['uGroup'], $_POST['userID']) AND is_numeric($_POST['uGroup']) AND is_numeric($_POST['userID'])) {
		$uGroup = $_POST['uGroup'];
		$userID = $_POST['userID'];
	} else {$dani = false;}
		
	if(!isset($_SESSION['uID']) OR ($_SESSION['uGROUP'] != 1)) {$dani = false;}
	
	if($dani == false) { $url = $host."users.php?er=1"; header("Location: $url"); exit(); }

	$updateRow = array($uGroup, $userID);
	$STH = $DB->prepare("UPDATE t_users SET u_group=? WHERE u_id=?");
		
	if($STH->execute($updateRow)) {
		$url = $host."users.php?st=editok";
		header("Location: $url"); exit();
	} else {
		$url = $host."users.php?er=2"; header("Location: $url"); 
	}
?>
