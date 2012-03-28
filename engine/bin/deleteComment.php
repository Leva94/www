<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	if(isset($_GET['delcom']) AND is_numeric($_GET['delcom']) AND ($_SESSION['uGROUP'] == 1)) {
		$delCommentID = $_GET['delcom'];
	} else {
		echo "Error"; exit;
	}

	$STH = $DB->prepare("DELETE FROM t_comments WHERE c_id=$delCommentID");
	if($STH->execute()) {
		$ref = $_SERVER['HTTP_REFERER']."&comment=del";
		header("Location: $ref"); exit();
	} else {
		echo "Error"; exit;
	}
?>
