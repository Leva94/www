<?php
	session_start();
	
	$DB = new PDO('mysql:host=localhost;dbname=hometaskDB','root', 'root');
	$DB->query("set character_set_client='utf8'"); 
 	$DB->query("set character_set_results='utf8'"); 
 	$DB->query("set collation_connection='utf8_general_ci'");
	

	$host = "http://localhost/";
	$cssDir = $host."engine/template/css/design.css";

	if(!isset($_SESSION['uLANG'])) { $_SESSION['uLANG'] = 'en'; }
	

