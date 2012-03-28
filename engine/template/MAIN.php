<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?=$title?></title>
	<link type='text/css' rel='stylesheet' href="<?=$cssDir.'?'.date("si");?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<?php include('engine/template/lang.php');?>

	<div id='TopBar'>
		<div class="cent">
			<div id='logo'><a href='/' class='logoLink'>Hometask site</a></div>
			<?php include('engine/template/userMenu.php'); ?>
			
			<div class='langchange'>
			  <a href="engine/bin/langChange.php?lang=en" style='color: white;'> 
				<? if(isset($_SESSION['uLANG']) AND $_SESSION['uLANG'] ==  'en') {
					echo '<b>English</b>';} else { echo 'English';}  ?></a>
			  <!--<a href="engine/bin/langChange.php?lang=ru"> 
				<? if($_SESSION['uLANG'] ==  'ru') {echo '<b>Русский</b>';} else { echo 'Русский';} ?></a>-->
			  <a href="engine/bin/langChange.php?lang=ua" style='color: white;'> 
				<? if(isset($_SESSION['uLANG']) AND$_SESSION['uLANG'] ==  'ua') {
					echo '<b>Українська</b>';} else { echo 'Українська';} ?></a>
			</div>
		</div>
	</div>
	<div class='clearfix'></div>
	<div class='cent'>

		<? if(!isset($_GET['sk'])) { if(!isset($_SESSION['uID']) and !isset($_SESSION['uPASS'])) {include('userBlock.php');}} ?>
		<? include($includePage); ?>

	</div>

</body>
</html>
