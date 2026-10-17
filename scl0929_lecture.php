<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <title>9/29(火) 授業中の記述（生コード） | ポートフォリオサイト</title>
</head>

<body>
  <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;9/29(火)職業訓練授業：生コード確認&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;!-- 
  【1】スーパーグローバル変数とHTMLフォームのメソッド属性
  教科書 P117 / P177
--&gt;
&lt;h2&gt;1. フォームの送受信テスト&lt;/h2&gt;

&lt;!-- GET送信のフォーム例 --&gt;
&lt;form action="scl0929_run.php" method="get"&gt;
  &lt;label for="search"&gt;検索キーワード(GET): &lt;/label&gt;
  &lt;input type="text" name="keyword" id="search"&gt;
  &lt;input type="submit" value="GETで送信"&gt;
&lt;/form&gt;

&lt;hr&gt;

&lt;!-- POST送信のフォーム例 --&gt;
&lt;form action="scl0929_run.php" method="post"&gt;
  &lt;label for="user"&gt;ユーザー名(POST): &lt;/label&gt;
  &lt;input type="text" name="username" id="user"&gt;
  
  &lt;!-- 【重要】チェックボックスの複数選択（二次元配列化） --&gt;
  &lt;p&gt;趣味を選択してください（複数選択可）:&lt;/p&gt;
  &lt;input type="checkbox" name="hobby[]" value="music" id="hb1"&gt;&lt;label for="hb1"&gt;音楽&lt;/label&gt;
  &lt;input type="checkbox" name="hobby[]" value="sports" id="hb2"&gt;&lt;label for="hb2"&gt;スポーツ&lt;/label&gt;
  &lt;input type="checkbox" name="hobby[]" value="travel" id="hb3"&gt;&lt;label for="hb3"&gt;旅行&lt;/label&gt;
  
  &lt;input type="submit" value="POSTで送信"&gt;
&lt;/form&gt;

&lt;!-- 
  ※注意メモ：
  チェックボックスの name 属性の末尾に「[]」を付け忘れると、
  最後にチェックを入れたデータしかPHP側（$_POST['hobby']）に届かなくなり、
  それより前のデータが上書きされて消えてしまうので必須！
--&gt;

&lt;hr&gt;

&lt;!-- 
  【2】ファイルアップロードフォーム（$_FILES）
  ※ method="post" と enctype="multipart/form-data" の2つが絶対必須条件
--&gt;
&lt;h2&gt;2. ファイル送信のテスト&lt;/h2&gt;
&lt;form action="scl0929_run.php" method="post" enctype="multipart/form-data"&gt;
  &lt;label for="upload-file"&gt;画像ファイルを選択: &lt;/label&gt;
  &lt;input type="file" name="user_file" id="upload-file"&gt;
  &lt;input type="submit" value="ファイルをアップロード"&gt;
&lt;/form&gt;
&lt;!-- 
  【3】データの存在チェックと文字列長の確認（isset &amp; strlen）
  【4】セキュリティ対策（htmlspecialchars）
--&gt;
&lt;?php
// データ受信後の基本処理イメージ
// ① isset() で配列のキーが存在するか確認
// ② strlen() で空文字（0文字入力）でないか確認
// ③ htmlspecialchars() でサニタイズ（XSS無害化）して出力

if (isset($_POST['username']) &amp;&amp; strlen($_POST['username']) &gt; 0) {
    // 完全に安全な状態で出力するためのエスケープ処理（ENT_QUOTES指定）
    $clean_username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    echo "こんにちは、" . $clean_username . "さん！";
} else {
    echo "ユーザー名が入力されていません。";
}

/*
  ▼ 試験対策・実務の補足メモ：
  JavaScriptとは異なり、PHPでは存在しない配列のキー（例：$_GET['name']が無い状態）に
  いきなり strlen() を使うと未定義エラー（Warning/Notice）が出てしまう。
  そのため、&amp;&amp;（論理積）のショートサーキットの性質を利用して、
  「まず左側で isset() を行い、パスしたら右側で長さを測る」という順番が鉄則となる。
*/
?&gt;

&lt;/body&gt;
&lt;/html&gt;</code></pre>
</body>

</html>