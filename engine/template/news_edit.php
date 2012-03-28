<? if(isset($_GET['nid']) AND is_numeric($_GET['nid'])) {
		$STH = $DB->query("SELECT * FROM t_news WHERE n_id=$_GET[nid]");
		$newsRow = $STH->fetch();
	} else { echo "<div class='error'>Error</div>"; exit; }
?>

<div id='addNewsBlock'>
	<?php
		
		if(!isset($_SESSION['uID']) OR ($_SESSION['uGROUP'] != 1 AND $_SESSION['uGROUP'] != 2)) {
			echo "<div class='error'>".$lang['Access denied']."</div>";
			exit();
		}
	?>

	<div class='title'><?=$lang['Edit news'];?></div>

	<? if(isset($_GET['er'])) { echo "<div class='error'>".$lang['Data insertion error']."</div>"; }?>

	<form method='post' action='<?=$host.'engine/bin/newsUpdate.php'?>'>
		<table border='0' cellpadding='3' cellspacing='0'>
			<tr>
				<td><b><?=$lang['Theme'];?>*:</b></td>
			</tr>
			<tr>
				<td valign='top'>
					<input type='text' name='title' size='60' style='width: 443px;' value='<? if(isset($newsRow['n_title'])) { echo $newsRow['n_title'];} ?>' />
				</td>
			</tr>
			<tr>
				<td valign='top'><b><?=$lang['Text'];?>:</b></td>
			</tr>
			<tr>
				<td valign='top'>
					
					<textarea name="content" cols='30' rows='18' style="width:500px; height: 400px;">
						<? if(isset($newsRow['n_text'])) { echo $newsRow['n_text'];} ?>
					</textarea>

				</td>
			</tr>
			<tr>
				<td><b><?=$lang['Theme'];?> (en)*:</b></td>
			</tr>
			<tr>
				<td valign='top'>
					<input type='text' name='title_en' size='60' style='width: 443px;' value='<? if(isset($newsRow['n_title_en'])) { echo $newsRow['n_title_en'];} ?>' />
				</td>
			</tr>
			<tr>
				<td valign='top'><b><?=$lang['Text'];?> (en):</b></td>
			</tr>
			<tr>
				<td valign='top'>
					<textarea name="content_en" cols='30' rows='18' style="width:500px; height: 400px;">
						<? if(isset($newsRow['n_text_en'])) { echo $newsRow['n_text_en'];} ?>
					</textarea>
				</td>
			</tr>

			<?php if($_SESSION['uGROUP'] == 1) {
				echo "<tr>
						<td valign='top' align='right'>
							<input type='checkbox' name='raittonull' />Очистити рейтинг
						</td>
					  </tr>";
				}
			?>
						 
			<tr>
				<td>
					<input type='hidden' name='nid' value='<?=$newsRow['n_id']?>' />
				</td>
			</tr>
			<tr>
				<td align='right'><input type='submit' value='<?=$lang['Save'];?>' /></td>
			</tr>	
		</table>
	</form>


	<form method='post' action='engine/bin/newsDelete.php' name='deleteForm'>
		<p><input type='hidden' name='nid' value="<?=$newsRow['n_id']?>" /></p>
		<p><input type='submit' value="<?=$lang['Delete'];?>" /></p>
	</form>

</div>
