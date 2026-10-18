<?php
$link=mysqli_connect("localhost","root","");
if(!$link){
	die("データベースに接続できません".mysqli_connect_error());
}
mysqli_select_db($link,"oneline_bbs");
mysqli_set_charset($link,"utf8");
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
		if(count($errors)===0){
			// プリペアドステートメントではないエスケープ手法
			// $sql="INSERT INTO `post` (`name`,`comment`,`created_at`) VALUES ('"
			// .mysqli_real_escape_string($link,$name)."','"
			// .mysqli_real_escape_string($link,$comment)."','"
			// .date('Y-m-d H:i:s')."')";
			// mysqli_query($link,$sql);
			
			$date=date('Y-m-d H:i:s');
			$sql = mysqli_prepare($link,'INSERT INTO `post` 
			(`name`,`comment`,`created_at`) VALUES (?,?,?)');
			mysqli_stmt_bind_param($sql,'sss',$name,$comment,$date);
			mysqli_stmt_execute($sql);
			mysqli_stmt_close($sql);
			
			mysqli_close($link);
			header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
// ページの移動命令後は命令の先読み対応でexit()を行う
// 先読み分を実行しようとしてエラーになるのを防ぐ
			exit();
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
	<form action="bbs.php" method="post">
<?php if (count($errors)): ?>
		<ul class="error_list">
<?php foreach($errors as $error): ?>
			<li>
<?php echo htmlspecialchars($error,ENT_QUOTES,"UTF-8") ?>
			</li>
<?php endforeach; ?>
		</ul>
<?php endif; ?>
		名前：<input type="text" name="name"><br>
		ひとこと：<input type="text" name="comment" size="60"><br>
		<input type="submit" name="submit" value="追加">
	</form>
<?php
	$sql="SELECT * FROM `post` ORDER BY `created_at` DESC";
	$result=mysqli_query($link,$sql);
?>
<?php if($result!==false && mysqli_num_rows($result)): ?>
	<ul>
<?php while($post=mysqli_fetch_assoc($result)): ?>
		<li>
<?php echo htmlspecialchars($post["name"],ENT_QUOTES,"UTF-8"); ?>:
<?php echo htmlspecialchars($post["comment"],ENT_QUOTES,"UTF-8"); ?>
-<?php echo htmlspecialchars($post["created_at"],ENT_QUOTES,"UTF-8"); ?>
		</li>
<?php endwhile; ?>
	</ul>
<?php endif ?>
<?php
	mysqli_free_result($result);
	mysqli_close($link);
?>
</body>
</html>
<!-- http://localhost/study/oneline_bbs/bbs.php -->