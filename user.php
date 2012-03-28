<?php
 include('engine/config.php');
 // include('engine/functions/f_news.php');
  
 $title = "Hometask site. User Profile";

 if(isset($_GET['sk']) and $_GET['sk'] == 'editprofile') { 
 	$includePage = "editProfile.php";
 } else {
 	$includePage = "userProfile.php";
 }

 include('engine/template/MAIN.php');
?>
