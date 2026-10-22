<?php
$flag = 0;
if ($_SERVER['REQUEST_METHOD'] !== 'POST'):
	$flag++;
endif;
if (!(isset($_POST['name']) && isset($_POST['pass']))):
	$flag++;
endif;
if ($flag !== 0):
	exit("正しくアクセスしてください");
endif;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>登録</title>
</head>

<body>
	<?php

	if (!(preg_match("/^[a-zA-Z0-9]{2,20}$/", $_POST['name']) && preg_match("/^[a-zA-Z0-9]{6,12}$/", $_POST['pass']))):
	?>
		<p>正しい入力がされていません</p>
		<p><a href='login.php'>ログイン画面に戻る</a></p>
		<?php
		exit();
	endif;

	$link = mysqli_connect("localhost", "root", "");
	if (!$link):
		exit("データベースに接続できません" . mysqli_connect_error());
	endif;
	mysqli_select_db($link, "kaiin");
	mysqli_set_charset($link, "utf8");
	$sql = mysqli_prepare(
		$link,
		"SELECT `pass` FROM `kaiin` WHERE `name`=?"
	);
	mysqli_stmt_bind_param($sql, 's', $_POST['name']);
	mysqli_stmt_execute($sql);
	mysqli_stmt_store_result($sql);
	if (mysqli_stmt_num_rows($sql) != 0): //0件ならユーザー名が存在しない
		mysqli_stmt_bind_result($sql, $pass);
		mysqli_stmt_fetch($sql);
		if ($_POST["pass"] === $pass):
			//ログイン処理や会員ページの移動はここで
		?>
			<p>ログインに成功しました</p>
		<?php else: ?>
			<p>パスワードが違います</p><br>
			<p><a href='login.html'>ログイン画面に戻る</a></p>
		<?php endif;
	else: ?>
		<p>ユーザーが存在しません</p><br>
		<p><a href='login.html'>ログイン画面に戻る</a></p>
	<?php endif;
	mysqli_stmt_close($sql);
	mysqli_close($link);
	?>
</body>

</html>