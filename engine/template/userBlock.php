<div id='uInfo'>
	<b><?=$lang['Hello guest please register or sign up'];?></b>
	<br />
	<form method='post' action='<?=$host.'engine/bin/auth.php'?>' name='authform'>
		<table border='0' cellpadding='3' cellspacing='0' class='centr'>
			<tr>
				<td><?=$lang['Login'];?>
					<input type='text' name='login' />
				</td>
				<td><?=$lang['Password'];?>
					<input type='password' name='pass' />
				</td>
				<td>
					<input type='submit' value="<?=$lang['Enter'];?>" />
				</td>
				<td>
					<a href='welcome.php?sk=reg'><?=$lang['Register'];?></a>
				</td>
			</tr>
		</table>
	</form>
</div>
