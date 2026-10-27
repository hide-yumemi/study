0<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>変更</title>
</head>

<body>
	<?php
	if ($_SERVER["REQUEST_METHOD"] !== "POST"):
		exit("直接アクセス禁止");
	endif;

	$link = mysqli_connect("localhost", "root", "");
	if (!$link):
		exit("データベースに接続できません" . mysqli_connect_error());
	endif;
	//入力ミスチェック
	if (!(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['tel']) && preg_match("/^[a-zA-Z0-9]{2,20}$/", $_POST['name']) && preg_match("/^[a-zA-Z0-9]{6,12}$/", $_POST['pass']) && preg_match("/^0[1-9][0-9]{8,9}$/", $_POST["tel"]))):
	?>
		<p>正しく入力してください</p>
		<?php
	else:
		mysqli_select_db($link, "kaiin");
		mysqli_set_charset($link, "utf8");

		$sql = mysqli_prepare($link, "SELECT `pass` FROM `kaiin` WHERE `name`=?");
		mysqli_stmt_bind_param($sql, 's', $_POST['name']);
		mysqli_stmt_execute($sql);
		mysqli_stmt_store_result($sql);
		if (mysqli_stmt_num_rows($sql) != 0):
			mysqli_stmt_bind_result($sql, $pass);
			mysqli_stmt_fetch($sql);
			if ($_POST["pass"] === $pass):
				mysqli_stmt_close($sql); //新しいsql文の前に一度stmtをクローズする
				$sql = mysqli_prepare($link, 'UPDATE `kaiin` SET `tel`=? WHERE `name`=?');
				mysqli_stmt_bind_param($sql, 'ss', $_POST['tel'], $_POST['name']);
				mysqli_stmt_execute($sql);
		?>
				<p>変更完了しました</p>
			<?php else: ?>
				<p>パスワードが違います</p>
			<?php
			endif;
		else:
			?>
			<p>ユーザーが存在しません</p>
	<?php
		endif;
		mysqli_stmt_close($sql);
	endif;
	mysqli_close($link);
	?>
	<p><a href='henko.html'>変更画面に戻る</a></p>
</body>

</html>