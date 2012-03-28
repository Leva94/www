<?php
 include('engine/config.php');
 //include('engine/functions/f_news.php');
 
 $title = "Hometask site. Add news";
 
  if (isset($_GET['nid']) and is_numeric($_GET['nid'])) { $nid = $_GET['nid'];} else { $nid = 0;}
 
 if(isset($_GET['sk']) and $_GET['sk']=='add') {  
	$includePage = "newsADD.php";
 } elseif(isset($_GET['nid']) and isset($_GET['sk']) AND $_GET['sk']=='edit') {
	$includePage = "news_edit.php";
 } elseif(isset($_GET['nid'])) {
	$includePage = "news_view.php";
 } else {
	$includePage = "newsRow.php";
 }
 include('engine/template/MAIN.php');
?>
