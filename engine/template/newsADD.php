<div id='addNewsBlock'>

<div class='title'><?=$lang['New news'];?></div>
<? if(isset($_GET['er'])) { echo "<div class='error'>".$lang['Data insertion error']."</div>"; }?>
<? if(!isset($_SESSION['uGROUP']) OR ($_SESSION['uGROUP'] == 0 ) OR ($_SESSION['uGROUP'] > 2)) { 
	echo "<div class='error'>No access</div>"; exit; }  
?>
<table border='0' cellpadding='3' cellspacing='0'>
<form method='post' action='<?=$host.'engine/bin/addnews.php'?>'>
<tr><td width='100'><b><?=$lang['Theme'];?>*:</b><td>
<tr><td valign='top'>
	<input type='text' name='title' size='60' style='width: 443px;' value='<?php if(isset($_SESSION['tmp_title'])) { echo $_SESSION['tmp_title']; } ?>'>
<tr><td valign='top'><b><?=$lang['Text'];?> (ua):</b><td>
<tr><td valign='top'>

<textarea name="content" style="width:500px; height: 400px;">
<?php if(isset($_SESSION['tmp_content'])) { echo $_SESSION['tmp_content'];}?>
</textarea>
        
<tr><td width='100'><b><?=$lang['Theme'];?> (en)*:</b><td>
<tr><td valign='top'>
<input type='text' name='title_en' size='60' style='width: 443px;' value='<?php if(isset($_SESSION['tmp_title'])) { echo $_SESSION['tmp_title_en']; } ?>'>
<tr><td valign='top'><b><?=$lang['Text'];?> (en):</b><td>
<tr><td valign='top'>
		<textarea name="content_en" style="width:500px; height: 400px;">
		<?php if(isset($_SESSION['tmp_content'])) { echo $_SESSION['tmp_content_en'];}?>
		</textarea>




<tr><td align='right'><input type='submit' value='<?=$lang['Add'];?>'>
</form>
</table>

</div>

<?php
	unset($_SESSION['tmp_content']);
	unset($_SESSION['tmp_title']);
	unset($_SESSION['tmp_content_en']);
	unset($_SESSION['tmp_title_en']); 
?>
