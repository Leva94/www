<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	$dani = true;
	
	if((isset($_POST['mark'], $_POST['nID'], $_SESSION['uID'])) AND is_numeric($_POST['mark']) AND is_numeric($_POST['nID'])) {
		$mark = $_POST['mark'];
		$uID = $_SESSION['uID'];
		$nID = $_POST['nID']; 
    } else { 
		$url = $host.'news.php?nid='.$nID.'&er=1'; header("Location: $url"); exit();
	}
	
	// Перевірка на повторне голосування
	$STH = $DB->query("SELECT COUNT(*) AS countMarks FROM t_newsmarks WHERE m_uid=$uID AND m_news=$nID");
	$Marks = $STH->fetch($selectRow);
	if($Marks['countMarks'] > 0) { 
		$url = $host.'news.php?nid='.$nID.'&er=2'; header("Location: $url"); exit(); 
	} else {
	
		// Додавання оцінки в базу
		$insertRow = array($uID, $nID, $mark);
		$STH = $DB->prepare("INSERT INTO t_newsmarks (m_uid, m_news, m_mark) VALUES (?, ?, ?)");
										  
		if($STH->execute($insertRow)) {
			$url = $host.'news.php?nid='.$nID.'&mark=add'; header("Location: $url"); exit();
		} else {
			$url = $host.'news.php?nid='.$nID.'&er=3'; header("Location: $url"); exit();
		}
	}
?>
