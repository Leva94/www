<?php
 include('engine/config.php');
 include('engine/functions/f_news.php');

 if (isset($_GET['nid']) and is_numeric($_GET['nid'])) { $nid = $_GET['nid'];} else { $nid = 0;}
 
 
 $title = "Hometask site. Main page"; 
 $includePage = "indexPage.php";
 include('engine/template/MAIN.php');
?>
