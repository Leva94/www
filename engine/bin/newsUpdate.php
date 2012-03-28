<?php
	include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
	
	if(isset($_POST['title'], $_POST['content'], $_POST['title_en'], $_POST['content_en'], $_POST['nid']) 
	   AND $_POST['title'] != '' AND $_POST['content'] != '' AND is_numeric($_POST['nid']) 
	   AND ($_SESSION['uGROUP'] == 1 OR $_SESSION['uGROUP'] == 2)) {
		   
			$nid  = $_POST['nid'];
			$title = htmlspecialchars($_POST['title']);
			$content = htmlspecialchars($_POST['content']);
			$title_en = htmlspecialchars($_POST['title_en']);
			$content_en = htmlspecialchars($_POST['content_en']);
	
	} else {
			$url = $host."news.php?nid=$nid&sk=edit&er=1"; header("Location: $url"); exit();
	}

	$updateRow = array($title, $content, $title_en, $content_en);
	$STH = $DB->prepare("UPDATE t_news SET n_title=?, n_text=?, n_title_en=?, n_text_en=? WHERE n_id=$nid");
	
	if($STH->execute($updateRow)) {
		
		// Очищення рейтингу матеріалу (якщо необхідно)
		if(isset($_POST['raittonull']) AND $_POST['raittonull'] == true AND $_SESSION['uGROUP'] == 1) {
			$STH = $DB->prepare("DELETE FROM t_newsmarks WHERE m_news=$nid");
			if(!$STH->execute()) { $url = $host."news.php?sk=edit&nid=$nid&er=3"; header("Location: $url"); }
		}
			$url = $host."news.php?nid=$nid&st=editok";
			header("Location: $url"); exit();
	} else {
		$url = $host."news.php?sk=edit&nid=$nid&er=2"; header("Location: $url"); 
	}
	
	
	

