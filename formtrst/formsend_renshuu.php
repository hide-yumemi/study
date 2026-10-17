<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>フォーム送信</title>
  </head>
  <body>
    <h1>入力フォーム</h1>
    <form action="./formget_renshuu.php" method="post">
      <p>苗字<input type="text" name="l_name">
      名前<input type="text" name="f_name"></p>
      <p>年代 <input type="radio" name="age" value="0">２０代以下
      <input type="radio" name="age" value="1">３０代
      <input type="radio" name="age" value="2">４０代
      <input type="radio" name="age" value="3">５０代以上</p>
      <p>性別 <input type="radio" name="gender" value="0">男
      <input type="radio" name="gender" value="1">女
      <input type="radio" name="gender" value="2">回答しない</p>
      <p>行きたい旅行先 <input type="checkbox" name="trip[]" value="0">アジア
      <input type="checkbox" name="trip[]" value="1">アメリカ
      <input type="checkbox" name="trip[]" value="2">ヨーロッパ
      <input type="checkbox" name="trip[]" value="3">南米
      <input type="checkbox" name="trip[]" value="4">その他</p>
      <input type="submit" value="送信">
    </form>
  </body>
</html>
<!-- http://localhost/php_study/formtrst/formsend_renshuu.php -->