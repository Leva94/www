<?php
 include('engine/config.php');
 
 if(isset($_SESSION['uID'])) { header("Location: index.php"); }
 
 $title = "Hometask site. Main page"; 
 if(isset($_GET['sk']) and $_GET['sk']=='reg') {
	$includePage = "reg.php";
 } elseif(isset($_GET['sk']) and $_GET['sk']=='auth') {
	$includePage = "auth.php";
 } else {
	header("Location: $host");
 }
 
 include('engine/template/MAIN.php');
?>