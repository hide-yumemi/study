<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>入力フォーム受信</title>
  </head>
  <body>
    <h1>入力項目表示</h1>
<?php
// 前回はtrue時に処理を、false時にエラーをするif文だった
// 今回はif文の条件部分を!()の形にして判定を判定し、
// 入力がない時にtrueとなりexit()する形にしている
  if(!(isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['time']) && isset($_POST['week']) && strlen($_POST['email'])>0 && strlen($_POST['tel'])>0)):
?>
    <p>未入力の項目があります<br>すべて入力して送信してください</p>
    <p><a href="./form1006.php">送信ページへ</a></p>
<?php
    exit();
  endif;
  if($_FILES['sendfile']['error']!=0):
?>
    <p>ファイル送信エラーのため、再送信してください</p>
    <p><a href="./form1006.php">送信ページへ</a></p>
<?php
    exit();
  endif;
// 前回コメントに書いた、サイズと形式を両方判定してからダメならexit()の形
  $flag=false;
  if($_FILES['sendfile']['size']>1000000):
?>
    <p>ファイルサイズが大きすぎます</p>
    <p>サイズを調整して送信しなおしてください</p>
<?php
    $flag=true;
  endif;
    if($_FILES['sendfile']['type'] != "image/jpeg"):
?>
    <p>jpeg（jpg）形式以外の形式のファイルは受付できません</p>
    <p>ファイルの種類を確認して送信しなおしてください</p>
<?php
    $flag=true;
  endif;
  if($flag):
?>
<p><a href="./form1006.php">送信ページへ</a></p>
<?php
    exit();
  endif;
// ここまでで、入力確認完了

// コードで送信される２項目の変換用配列
  $timearr=array('9～12','13～15','15～17','17～19');
  $weekarr=array('月','火','水','木','金');

// 送信ファイルをimagesフォルダへ
  while(1):
    $filename="images/img";
    $date=date('YmdHis');
    $filename=$filename . $date . '.jpg';
?>
<?php
    if(!file_exists($filename)): 
      break;
    endif;
  endwhile;
  move_uploaded_file($_FILES['sendfile']['tmp_name'],$filename);
?>
    <p>送信された内容</p>
    <p>メールアドレス<?php echo htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8'); ?></p>
    <p>TEL<?php echo htmlspecialchars($_POST['tel'],ENT_QUOTES,'UTF-8'); ?></p>
    <p><?php echo $timearr[$_POST['time']]; ?>時</p>
    <p>
<?php
  foreach($_POST['week'] as $value):
?>
    「<?php echo $weekarr[$value]; ?>」
<?php
 endforeach;
?>
    </p>
    <p><img src="<?php echo $filename; ?>" alt="アップロード画像"></p>
  </body>
</html>