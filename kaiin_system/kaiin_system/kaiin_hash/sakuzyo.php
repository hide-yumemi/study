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
	if(!(isset($_POST['name']) && isset($_POST['pass']) && preg_match("/^[a-zA-Z0-9]{2,20}$/",$_POST['name']) && preg_match("/^[a-zA-Z0-9]{6,12}$/",$_POST['pass']))):
?>
	<p>正しく入力してください</p>
	<p><a href='sakuzyo.html'>前画面に戻る</a></p>
<?php
	else:
		$dbname = 'mysql:host=localhost;dbname=kaiin;charset=utf8';
		$id = 'root';
		$pw = '';

		try {
			$pdo = new PDO($dbname,$id,$pw,array(PDO::ATTR_EMULATE_PREPARES => false));
		}
		catch(PDOException $e){
			exit('データベース接続失敗。'.$e->getMessage());
		}

		$sql='SELECT `pass` FROM `kaiin2` WHERE `name`=:name';
		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(':name',$_POST["name"]);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		if($result):
			if(password_verify($_POST["pass"],$result["pass"])):
				$stmt=null;
				$sql='DELETE FROM `kaiin2` WHERE `name`=:name';
				$stmt = $pdo -> prepare($sql);
				$stmt->bindParam(':name',$_POST["name"]);
				$stmt->execute();
?>
		<p>退会しました</p>
		<p><a href='kaiintouroku.php'>topページへ</a></p>
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
		$stmt=null;
	endif;
	$pdo=null;
?>
</body>
</html>
