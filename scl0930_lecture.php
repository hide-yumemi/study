<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/30(水) 授業中の記述（生コード） | ポートフォリオサイト</title>
</head>

<body>
    <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;9/30(水)職業訓練授業：選択系部品とテキストエリア処理&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;!-- 
  【1】フォーム送信ページの基本構造（formsend.php相当）
  action属性には受信用のファイルを指定。今回は「scl0930_run.php」へ送信
--&gt;
&lt;h2&gt;9/30 実技フォーム送信テスト&lt;/h2&gt;

&lt;form action="scl0930_run.php" method="post"&gt;

  &lt;!-- 
    【2】ラジオボタンのグループ化
    同一グループ内で必ず「name属性の値を共通」にする（P110周辺）
    ユーザーが直接入力しないため、送信したい値をvalue属性に指定する
  --&gt;
  &lt;p&gt;■ 血液型を選択してください（ラジオボタン・単一選択）:&lt;/p&gt;
  &lt;input type="radio" name="blood" value="A" id="b_a"&gt;&lt;label for="b_a"&gt;A型&lt;/label&gt;
  &lt;input type="radio" name="blood" value="B" id="b_b"&gt;&lt;label for="b_b"&gt;B型&lt;/label&gt;
  &lt;input type="radio" name="blood" value="O" id="b_o"&gt;&lt;label for="b_o"&gt;O型&lt;/label&gt;
  &lt;input type="radio" name="blood" value="AB" id="b_ab"&gt;&lt;label for="b_ab"&gt;AB型&lt;/label&gt;

  &lt;br&gt;&lt;br&gt;

  &lt;!-- 
    【3】チェックボックスの配列化（多次元配列での受け取り）
    複数選択（マルチチェック）を1つの名前でまとめて受け取るため、
    name属性値の最後に「[]（角括弧）」を付加する（name="fav[]"）
    実務のベストプラクティスとして、valueは「0」「1」などのコード値（数値）で指定
  --&gt;
  &lt;p&gt;■ 趣味を選択してください（チェックボックス・複数選択可）:&lt;/p&gt;
  &lt;input type="checkbox" name="fav[]" value="0" id="f0"&gt;&lt;label for="f0"&gt;旅行&lt;/label&gt;
  &lt;input type="checkbox" name="fav[]" value="1" id="f1"&gt;&lt;label for="f1"&gt;スポーツ&lt;/label&gt;
  &lt;input type="checkbox" name="fav[]" value="2" id="f2"&gt;&lt;label for="f2"&gt;音楽&lt;/label&gt;
  &lt;input type="checkbox" name="fav[]" value="3" id="f3"&gt;&lt;label for="f3"&gt;インターネット&lt;/label&gt;

  &lt;br&gt;&lt;br&gt;

  &lt;!-- 
    【4】テキストエリア（複数行入力）
    質問やお問い合わせなどを受け取るコントロール。
    閉じタグとの間に不要なスペースや改行を入れると、それが初期値として入力欄に残るので注意
  --&gt;
  &lt;p&gt;■ お問い合わせ・ご質問（テキストエリア・複数行入力）:&lt;/p&gt;
  &lt;textarea name="qus" rows="4" cols="40" placeholder="こちらにメッセージを入力してください"&gt;&lt;/textarea&gt;

  &lt;br&gt;&lt;br&gt;
  &lt;input type="submit" value="送信する"&gt;
  &lt;input type="reset" value="リセット"&gt;
&lt;/form&gt;
&lt;!-- 
  【5】フォームデータ受信（formget.php相当）とセキュリティ・文字列処理
--&gt;
&lt;?php
// ① サーバー側での厳格な入力チェック（バリデーション）
// isset() と strlen() を用いて、空文字（0文字）を回避して厳格に判定する
if (isset($_POST['qus']) &amp;&amp; strlen($_POST['qus']) &gt; 0) {
    
    /* 
      ② テキストエリアの改行処理とサニタイズ（最重要ルール）
      改行コード（\r\n）を &lt;br&gt; タグに変換する nl2br() 関数を使用する。
      
      【ネストの順序の鉄則】：
      必ず htmlspecialchars() でエスケープした後に、 nl2br() で改行変換を行う！
      順序を逆にすると、変換された &lt;br&gt; 自体がエスケープされて画面に文字で表示されてしまう。
    */
    echo "&lt;p&gt;■ 送信されたお問い合わせ内容（安全な表示）：&lt;/p&gt;";
    echo nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8'));
    
} else {
    echo "&lt;p&gt;お問い合わせ内容は未入力です。&lt;/p&gt;";
}

/* 
  ③ ラジオボタンの出力補足：
  制作側が固定した値（A, B, O, AB）しか送信されないためエスケープは不要。
  画面表示時は「型」などの文字列を連結して出力する。
*/
if (isset($_POST['blood'])) {
    echo "&lt;p&gt;血液型：" . $_POST['blood'] . "型&lt;/p&gt;";
}
?&gt;

&lt;/body&gt;
&lt;/html&gt;</code></pre>
</body>

</html>