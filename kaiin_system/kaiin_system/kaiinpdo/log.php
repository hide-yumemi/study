<?php
	$flag=0;
	if($_SERVER['REQUEST_METHOD']!=='POST'):
		$flag++;
	endif;
	if(!(isset($_POST['name']) && isset($_POST['pass']))):
		$flag++;
	endif;
	if($flag!==0):
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

	if(!(preg_match("/^[a-zA-Z0-9]{2,20}$/",$_POST['name']) && preg_match("/^[a-zA-Z0-9]{6,12}$/",$_POST['pass']))):
?>
	<p>正しい入力がされていません</p>
	<p><a href='login.php'>ログイン画面に戻る</a></p>
<?php
		exit();
	endif;
	
	$dbname = 'mysql:host=localhost;dbname=kaiin;charset=utf8';
	$id = 'root';
	$pw = '';

	try {
		$pdo = new PDO($dbname,$id,$pw,array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch(PDOException $e){
		exit('データベース接続失敗。'.$e->getMessage());
	}
	
	$sql='SELECT `pass` FROM `kaiin` WHERE `name`=:name';
	$stmt = $pdo -> prepare($sql);
	$stmt->bindParam(':name',$_POST["name"]);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);

	if($result):
		if($_POST["pass"]===$result["pass"]):
?>
	<p>ログインに成功しました</p>
<?php
//ログイン処理や会員ページの移動はここで
		else:
?>
	<p>パスワードが違います</p><br>
	<p><a href='login.php'>ログイン画面に戻る</a></p>
<?php
		endif;
	else:
?>
	<p>ユーザーが存在しません</p><br>
	<p><a href='login.php'>ログイン画面に戻る</a></p>
<?php
	endif;
	$stmt=null;
	$pdo=null;
?>
</body>
</html>
