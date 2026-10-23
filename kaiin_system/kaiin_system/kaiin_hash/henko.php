<!DOCTYPE html>
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

	//入力ミスチェック
	if (!(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['tel']) && preg_match("/^[a-zA-Z0-9]{2,20}$/", $_POST['name']) && preg_match("/^[a-zA-Z0-9]{6,12}$/", $_POST['pass']) &&  preg_match("/^0[1-9][0-9]{8,9}$/", $_POST["tel"]))):
	?>
		<p>正しく入力してください</p>
		<?php
	else:
		$dbname = 'mysql:host=localhost;dbname=kaiin;charset=utf8';
		$id = 'root';
		$pw = '';

		try {
			$pdo = new PDO($dbname, $id, $pw, array(PDO::ATTR_EMULATE_PREPARES => false));
		} catch (PDOException $e) {
			exit('データベース接続失敗。' . $e->getMessage());
		}

		$sql = 'SELECT `pass` FROM `kaiin2` WHERE `name`=:name';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name', $_POST["name"]);
		$stmt->execute();

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//１件の取得があればパスワードチェック
		if ($result):
			if (password_verify($_POST["pass"], $result["pass"])):
				$stmt = null;
				$sql = 'UPDATE `kaiin2` SET `tel`=:tel WHERE `name`=:name';
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':tel', $_POST["tel"]);
				$stmt->bindParam(':name', $_POST["name"]);
				$stmt->execute();
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
		$stmt = null;
	endif;
	$sql = null;
	?>
	<p><a href='henko.html'>変更画面に戻る</a></p>
</body>

</html>