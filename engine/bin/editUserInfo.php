<?php
include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/engine/functions/profile_func.php');


if(isset($_POST['name'])) { $name = htmlspecialchars($_POST['name']); } else { $name = ''; }
if(isset($_POST['lastname'])) { $lastname = htmlspecialchars($_POST['lastname']); } else { $lastname = ''; }
if(isset($_POST['wmail'])) { $wmail = htmlspecialchars($_POST['wmail']); } else { $wmail = ''; }
if(isset($_POST['aboutme'])) { $aboutme = htmlspecialchars($_POST['aboutme']); } else { $aboutme = ''; }
if(isset($_SESSION['uID'])) { $uID = $_SESSION['uID']; } else { exit;}

// Загрузка аватара
	if (isset($_FILES["avatar"]["tmp_name"]) and $_FILES["avatar"]["tmp_name"] != '') { 
		if($_FILES["avatar"]["size"] > 1024*1024){
			echo ("Аватар превишает допустимый размер");
			exit;
		}
		
		if(is_uploaded_file($_FILES["avatar"]["tmp_name"])) {
			
			$imageinfo = getimagesize($_FILES['avatar']['tmp_name']);
			if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
				$url = $host."user.php?sk=editprofile&edit=error1"; header("Location: $url");  exit();
			} else {
				
				img_resize($_FILES["avatar"]["tmp_name"], $_FILES["avatar"]["tmp_name"], 150, 150);
				$avatarDir = "engine/images/avatars/";
				$avatarName = "a_".uniqid().".jpg";
				$avatarLink = $avatarDir.$avatarName;
				//print($host.$avatarLink);
				$tmp = $_FILES["avatar"]["tmp_name"];
				$adir = $_SERVER['DOCUMENT_ROOT'].'/'.$avatarLink;
				if(!move_uploaded_file($tmp, $adir)) {
					$url = $host."user.php?sk=editprofile&edit=error2"; header("Location: $url");  
					exit();
				}
			
				// Удаления старого аватара
				$STH = $DB->query("SELECT u_avatar AS link FROM t_users WHERE u_id=$uID LIMIT 1");
				$avatar = $STH->fetch();
				if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$avatar['link'])) {
	  				$aLink = $_SERVER['DOCUMENT_ROOT'].'/'.$avatar['link'];
					chmod($aLink, 0777);
					$delAvatar = unlink($aLink);
					if(!$delAvatar) { echo 'Error delete'; exit(); }
				}		
}
				
			
		} else {
			echo("Error upload file"); 
		}
	
	$dataArray = array($wmail, $name, $lastname, $avatarLink, $aboutme, $uID);
	$STH = $DB->prepare("UPDATE t_users SET u_mail=?, u_name=?, u_lastname=?, u_avatar=?, u_about=? WHERE u_id=?");	
	$STH->execute($dataArray);
		
	} else {
	
		$dataArray = array($wmail, $name, $lastname, $aboutme, $uID);
		$STH = $DB->prepare("UPDATE t_users SET u_mail=?, u_name=?, u_lastname=?, u_about=? WHERE u_id=?");	
		$STH->execute($dataArray);
	}
									  
	
	$url = $host."user.php?sk=editprofile&edit=ok";
	header("Location: $url"); exit();

