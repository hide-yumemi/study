<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>退会</title>
</head>
<body>
<?php
	if($_SERVER["REQUEST_METHOD"]!=="POST"):
		exit("直接アクセス禁止");
	endif;

	$link=mysqli_connect("localhost","root","");
	if(!$link):
		exit("データベースに接続できません".mysqli_connect_error());
	endif;
	if(!(isset($_POST['name']) && isset($_POST['pass'])  && preg_match("/^[a-zA-Z0-9]{2,20}$/",$_POST['name']) && preg_match("/^[a-zA-Z0-9]{6,12}$/",$_POST['pass']))):
?>
	<p>正しく入力してください</p>
	<p><a href='sakuzyo.html'>前画面に戻る</a></p>
<?php
	else:
		mysqli_select_db($link,"kaiin");
		mysqli_set_charset($link,"utf8");
		$sql=mysqli_prepare($link,"SELECT `pass` FROM `kaiin` WHERE `name`=?");
		mysqli_stmt_bind_param($sql,'s',$_POST['name']);
		mysqli_stmt_execute($sql);
		mysqli_stmt_store_result($sql);
		if(mysqli_stmt_num_rows($sql)!=0):
			mysqli_stmt_bind_result($sql,$pass);
			mysqli_stmt_fetch($sql);
			if($_POST["pass"]===$pass):
				mysqli_stmt_close($sql);
				$sql = mysqli_prepare($link,'DELETE FROM `kaiin` WHERE `name`=?');
				mysqli_stmt_bind_param($sql,'s',$_POST['name']);
				mysqli_stmt_execute($sql);
?>
		<p>退会しました</p>
		<p><a href='kaiintouroku.html'>topページへ</a></p>
<?php else: ?>
		<p>パスワードが違います</p><br>
		<p><a href='sakuzyo.html'>前画面に戻る</a></p>
<?php
			endif;
		else:
?>
		<p>ユーザーが存在しません</p><br>
		<p><a href='sakuzyo.html'>前画面に戻る</a></p>
<?php
		endif;
		mysqli_stmt_close($sql);
	endif;
	mysqli_close($link);
?>
</body>
</html>
