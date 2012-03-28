<?php

	$STH = $DB->query("SELECT * FROM t_language");
	$STH->setFetchMode(PDO::FETCH_ASSOC); 
	
		
	if(isset($_SESSION['uLANG'])) {	
		switch ($_SESSION['uLANG']) {
    		case 'en': 
					   while($lRow = $STH->fetch()) {
					   	$lang[$lRow['l_en']] = $lRow['l_en'];
					   }
     		break;
   			case 'ru': 
					   while($lRow = $STH->fetch()) {
					   	$lang[$lRow['l_en']] = $lRow['l_ru'];
					   }
			break;
			case 'ua': 
					   while($lRow = $STH->fetch()) {
					   	$lang[$lRow['l_en']] = $lRow['l_ua'];
					   }
        	break;
		}  
	}else {
		
		   while($lRow = $STH->fetch()) {
		   	$lang[$lRow['l_en']] = $lRow['l_en'];
		   }
	}

$months = array($lang['January'], $lang['February'], $lang['March'], $lang['April'], $lang['May'], $lang['June'], $lang['July'], $lang['August'], $lang['September'], $lang['October'], $lang['November'], $lang['December']);
