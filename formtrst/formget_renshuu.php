<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>フォーム受信</title>
  </head>
  <body>
    <h1>送信データ表示</h1>
<?php
  if(isset($_POST['l_name']) && isset($_POST['f_name']) && isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['trip'])&& strlen($_POST['l_name'])>0 && strlen($_POST['f_name'])>0):

    $agearr=array('２０代以下','３０代','４０代','５０代以上');
    $genderarr=array('男','女','回答しない');
    $triparr=array('アジア','アメリカ','ヨーロッパ','南米','その他');
?>
    <p>苗字　<?php echo htmlspecialchars($_POST['l_name'],ENT_QUOTES,'UTF-8'); ?></p>
    <p>名前　<?php echo htmlspecialchars($_POST['f_name'],ENT_QUOTES,'UTF-8'); ?></p>
    <p><?php echo $agearr[$_POST['age']]; ?></p>
    <p><?php echo $genderarr[$_POST['gender']]; ?></p>
<?php
      foreach($_POST['trip'] as $value):
?>
    <p><?php echo $triparr[$value]; ?></p>
<?php
  endforeach;
?>
<?php
  else:
?>
  <p>未入力の項目があります</p>
  <p><a href="./formsend_renshuu.php">入力ページへ</a></p>
<?php
  endif;
?>
  </body>
</html>