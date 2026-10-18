<?php
//DB接続情報
	$dbname = 'mysql:host=localhost;dbname=oneline_bbs;charset=utf8';
	$id = 'root';
	$pw = '';
	try {
//DB取得処理
		$pdo = new PDO($dbname,$id,$pw,array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch(PDOException $e){
		exit('データベース接続失敗。'.$e->getMessage());
	}
$errors=array();
	if($_SERVER["REQUEST_METHOD"]==="POST"){
		$name=null;
		if(!isset($_POST["name"]) || !strlen($_POST["name"])){
			$errors["name"]="名前を入力してください";
		}else if(strlen($_POST["name"])>40){
			$errors["name"]="名前は４０文字以内で入力してください";
		}else{
			$name=$_POST["name"];
		}
		$comment=null;
		if(!isset($_POST["comment"]) || !strlen($_POST["comment"])){
			$errors["comment"]="ひとことを入力してください";
		}else if(strlen($_POST["comment"])>200){
			$errors["comment"]="ひとことは２００文字以内で入力してください";
		}else{
			$comment=$_POST["comment"];
		}
	$date=date('Y-m-d H:i:s');
	if(count($errors)===0){
		$sql='INSERT INTO `post` (`name`,`comment`,`created_at`) VALUES (:name,:comment,:created_at)';
		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(':name',$name);
		$stmt->bindParam(':comment',$comment);
		$stmt->bindParam(':created_at',$date);
		$stmt->execute();
		$stmt=null;
			header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ひとこと掲示板</title>
</head>
<body>
	<h1>ひとこと掲示板</h1>
	<form action="bbs2.php" method="post">
<?php if (count($errors)): ?>
		<ul>
<?php foreach($errors as $error): ?>
			<li>
<?php echo htmlspecialchars($error,ENT_QUOTES,"UTF-8") ?>
			</li>
<?php endforeach; ?>
		</ul>
<?php endif; ?>
		名前：<input type="text" name="name"><br>
		ひとこと：<input type="text" name="comment"><br>
		<input type="submit" name="submit" value="追加">
	</form>
<?php
		$stmt=$pdo->prepare("SELECT * FROM `post` ORDER BY `created_at` DESC");
		$result=$stmt->execute();
?>
<?php if($result!==false): ?>
	<ul>
<?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
		<li>
<?php echo htmlspecialchars($result["name"],ENT_QUOTES,"UTF-8"); ?>:
<?php echo htmlspecialchars($result["comment"],ENT_QUOTES,"UTF-8"); ?>
-<?php echo htmlspecialchars($result["created_at"],ENT_QUOTES,"UTF-8"); ?>
		</li>
<?php endwhile; ?>
	</ul>
<?php endif ?>
<?php
	$stmt=null;
	$pdo=null;
?>
</body>
</html>
<!-- http://localhost/study/oneline_bbs/bbs2.php -->