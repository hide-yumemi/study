<!DOCTYPE html>
<html lamg="ja">
  <head>
    <meta charset="UTF-8">
    <title>入力フォーム</title>
  </head>
  <body>
    <h1>送信データ</h1>
    <form method="post" action="./formget1006.php" enctype="multipart/form-data">
      メールアドレス<input type="email" name="email"><br>
      TEL<input type="text" name="tel"><br>
      連絡可能な時間帯<input type="radio" name="time" value="0">9～12
      <input type="radio" name="time" value="1">13～15
      <input type="radio" name="time" value="2">15～17
      <input type="radio" name="time" value="3">17～19<br>
      連絡希望曜日<br>　（複数可）　<input type="checkbox" name="week[]" value="0">月
      <input type="checkbox" name="week[]" value="1">火
      <input type="checkbox" name="week[]" value="2">水
      <input type="checkbox" name="week[]" value="3">木
      <input type="checkbox" name="week[]" value="3">金<br>
      提出ファイル<input type="file" name="sendfile"><br>
      <input type="submit" value="送信">
    </form>
  </body>
</html>
<!-- http://localhost/form_renshuu/form1006.php -->