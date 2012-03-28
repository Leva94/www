<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	if(isset($_POST['deleteUID'], $_SESSION['uID']) AND is_numeric($_POST['deleteUID'])
	   AND ($_SESSION['uGROUP'] != 1 OR $_SESSION['uGROUP'] != 2 )) {
		$deleteUID = $_POST['deleteUID'];
	} else {
		$url = $host."users.php?er=3"; header("Location: $url"); exit();
	}

	$STH = $DB->prepare("DELETE FROM t_users WHERE u_id=$deleteUID");
	if($STH->execute()) {
		$url = $host."users.php?st=deleteok";
		header("Location: $url"); exit();
	} else {
		$url = $host."users.php?er=4"; header("Location: $url"); 
	}
?>
