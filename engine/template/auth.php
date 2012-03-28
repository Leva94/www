<?php
	if(isset($_GET['er'])) {
		echo "<div class='error'>".$lang['Data insertion error']."</div>";
	}
	
	if(isset($_GET['reg'])) {
		echo "<div class='ok'>".$lang['ok_reg_please_enter']."</div>";
	}
?>

<div id='uInfoAuth'>
 <div class='title'><?=$lang['Log in'];?></div>
	<table border='0' cellpadding='3' cellspacing='0' align='center' width='100%'>
	 <form method='post' action='<?=$host.'engine/bin/auth.php'?>'>
	  <tr>
	   <td><?=$lang['Login'];?>:
	  <tr>
	   <td><input type='text' name='login' size='35'>
	  <tr>
	   <td><?=$lang['Password'];?>:
	  <tr>
	   <td><input type='password' name='pass' size='35' >
      <tr>
	   <td align='right'><input type='submit' value='<?=$lang['Enter'];?>'>
	  <tr> 
	   <td align='right'><a href='welcome.php?sk=reg'><?=$lang['Register'];?></a>
      
</td>
</tr>
	</form>
</table>
</div>
