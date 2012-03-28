<div id='uReg'>
	<div class='title'><?=$lang['New user registration'];?></div>
	
	<? if(isset($_GET['er'])) { echo "<div class='error'>".$lang['Data insertion error']."</div>"; }?>
	
	<div style='margin: 10px 0 10px 30px;'>
		<table border='0' cellpadding='3' cellspacing='0'>
			<form method='post' action='<?=$host.'engine/bin/adduser.php'?>'>
				<tr>
				  <td width='100'><?=$lang['Login'];?>*:
				  <td>
					<? if(!isset($_SESSION['tmp_login']) AND isset($_GET['er'])) { 
						  echo "<input type='text' name='login' size='40' style='border: 1px solid red;' />";
					  } elseif(isset($_SESSION['tmp_login']))  {
						  echo "<input type='text' name='login' size='40' value='".$_SESSION['tmp_login']."' />"; 
					  } else {
						  echo "<input type='text' name='login' size='40' />";   
					  } ?>
					
				<tr>
				  <td><?=$lang['Password'];?>*:
				  <td><input type='password' name='pass' size='40' <? if(isset($_GET['er'])) {echo "style='border: 1px solid red';";} ?> />
				<tr>
				  <td>Repeat <?=$lang['Password'];?>*:
				  <td><input type='password' name='confpass' size='40' <? if(isset($_GET['er'])) {echo "style='border: 1px solid red';";}?> />
				<tr>
				  <td><?=$lang['E-mail'];?>*:
				  <td>
					<? if(!isset($_SESSION['tmp_mail']) AND isset($_GET['er'])) { 
						echo "<input type='text' name='mail' size='40' value='' style='border: 1px solid red;' />";
					} elseif(isset($_SESSION['tmp_mail'])) {
						echo "<input type='text' name='mail' size='40' value='".$_SESSION['tmp_mail']."' />";
					} else {
						echo "<input type='text' name='mail' size='40' value='' />";
					} ?>
					
				<tr>
				  <td><?=$lang['Sex'];?>*:
				  <td <? if(!isset($_SESSION['tmp_sex']) AND isset($_GET['er'])) { echo "style='border-bottom: 1px solid red;'"; }?>>
					<input type='radio' name='sex' value='1' <? if(isset($_SESSION['tmp_sex']) and ($_SESSION['tmp_sex']==1)) { echo 'checked';} ?>><?=$lang['Male'];?>
					<input type='radio' name='sex' value='2' <? if(isset($_SESSION['tmp_sex']) and ($_SESSION['tmp_sex']==2)) { echo 'checked';} ?>><?=$lang['Female'];?>
				<tr>
				  <td><?=$lang['Birthday'];?>: 
				  <td>
					<select name='bday'>
					<?	for($i = 1; $i<=31; ++$i) {
							if(isset($_SESSION['tmp_bday']) and $_SESSION['tmp_bday']==$i) {
								echo "<option value='$i' selected>".$i;
							} else {
								echo "<option value='$i'>".$i;
							}
						}
					?>
					</select>

					<select name='bmonth'>
					<? 
						$i = 0;
						foreach($months as $month){ 
							++$i;
							if(isset($_SESSION['tmp_bmonth']) and $_SESSION['tmp_bmonth']==$i) {
								echo "<option value='".$i."' selected>".$month; 
							} else {
								echo "<option value='".$i."'>".$month; 
							}
						}
					?>
					</select>

					<select name='byear'>
					<? 	for($i = 2012; $i>=1932; --$i) { 
							if(isset($_SESSION['tmp_byear']) and $_SESSION['tmp_byear']==$i) {
								echo "<option value='$i' selected>".$i;
							} else {
								echo "<option value='$i'>".$i;
							}
						}
					?>
					</select>

				<tr>
				  <td><?=$lang['About me'];?>:
				  <td><textarea name='aboutme' cols='39' rows='5'><? if(isset($_SESSION['tmp_about'])) { echo $_SESSION['tmp_about'];} ?></textarea> 
				<tr>
				  <td>
				  <td><input type='submit' value='<?=$lang['Register'];?>'>
			</form>
		</table>
	</div>
</div>

<?php 
	unset($_SESSION['tmp_login']);	unset($_SESSION['tmp_mail']);
	unset($_SESSION['tmp_sex']);	unset($_SESSION['tmp_bday']);	unset($_SESSION['tmp_bmonth']);
	unset($_SESSION['tmp_byear']);	unset($_SESSION['tmp_about']);
?>
