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
	if($_SERVER["REQUEST_METHOD"]==="POST"):
		$name=null;
		if(!isset($_POST["name"]) || !strlen($_POST["name"])):
			$errors["name"]="名前を入力してください";
		elseif(strlen($_POST["name"])>40):
			$errors["name"]="名前は４０文字以内で入力してください";
    else:
			$name=$_POST["name"];
		endif;
	  $comment=null;
		if(!isset($_POST["comment"]) || !strlen($_POST["comment"])):
			$errors["comment"]="ひとことを入力してください";
		elseif(strlen($_POST["comment"])>200):
			$errors["comment"]="ひとことは２００文字以内で入力してください";
    else:
			$comment=$_POST["comment"];
		endif;
//画像が条件に合うか確認
    if($_FILES['file']['error']!=0):
	  	$errors["file"]="ファイル送信エラー";
    elseif($_FILES['file']['size']>1000000):
	  	$errors["file"]="画像のサイズが大きすぎます";
    elseif($_FILES['file']['type'] != "image/jpeg"):
      $errors["file"]="jpegのみ投稿可能です";
    else:
      while(1):
        $filename="img";
        $date=date('YmdHis');
        $filename=$filename . $date . '.jpg';
        if(!file_exists("images/".$filename)):
          break;
        endif;
      endwhile;
    endif;
    $date=date('Y-m-d H:i:s');
    if(count($errors)===0):
// 画像の保存はエラーがなかった時のみ
      move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$filename);
      $sql='INSERT INTO `gazou` (`name`,`comment`,`img`,`created_at`) VALUES (:name,:comment,:img,:created_at)';
      $stmt = $pdo -> prepare($sql);
      $stmt->bindParam(':name',$name);
      $stmt->bindParam(':comment',$comment);
      $stmt->bindParam(':img',$filename);
      $stmt->bindParam(':created_at',$date);
      $stmt->execute();
      $stmt=null;
      header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		endif;
	endif;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ひとこと掲示板</title>
</head>
<body>
	<h1>ひとこと掲示板</h1>
	<form action="gazou_bbs.php" method="post" enctype="multipart/form-data">
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
    投稿画像：<input type="file" name="file"><br>
		<input type="submit" name="submit" value="追加">
	</form>
<?php
		$stmt=$pdo->prepare("SELECT * FROM `gazou` ORDER BY `created_at` DESC");
		$result=$stmt->execute();
?>
<?php if($result!==false): ?>
	<ul>
<?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
		<li>
<?php echo htmlspecialchars($result["name"],ENT_QUOTES,"UTF-8"); ?>:
<?php echo htmlspecialchars($result["comment"],ENT_QUOTES,"UTF-8"); ?>
<img src="images/<?php echo $result["img"]; ?>" alt="投稿画像" width="100">
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
<!-- http://localhost/gazou/gazou_bbs.php -->