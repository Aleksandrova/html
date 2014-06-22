<? if($logged) { ?>

<div style="width: 100%; background-color: yellow;"><?=$msg;?></div>
<form action="" method="post">
<textarea name="content" style="width: 100%; height: 400px;"><?=$content;?></textarea>
<input type="submit" value="Запиши" name="send">

<? } else { ?>
	<form action="" method="post">
		<input type="password" name="psw">
		<input type="submit" value="Влез" name="login">
	</form>
	
<?}?>
