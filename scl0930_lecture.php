<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>授業中の記述</title>
</head>
<body>
<pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
&lt;meta charset="UTF-8"&gt;
&lt;title&gt;HTMLの受け渡しからPHPの受け取り&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;!-- - PHP教科書P174---&gt;
&lt;?php if(isset($_GET['name']) &amp;&amp; strlen($_GET['name'])&gt;0) : ?&gt;
&lt;!-- isset(~)は、～が存在しているか？　strlen(~)は、～の格納された文字の長さを求めている。--&gt;
&lt;p&gt;&lt;?php echo htmlspecialchars($_GET['name'],ENT_QUOTES,'UTF-8');?&gt;さん、こんにちは&lt;/p&gt;
&lt;!--
※ユーザーの入力した文字を表示する時は、htmlspecialchars()を使用してセキュリティ対策
「"」「'」「&lt;」「&gt;」「&amp;」の5つを変換することにより&lt;&gt;の形で作るタグと認識されない

5つをブラウザに表示できる&amp;〜;の形に変換される
「"」 → &amp;quot;
「'」 → 'あるいは&amp;apos;
「&lt;」 → &amp;lt;
「&gt;」 → &amp;gt;
「&amp;」 → &amp;amp;
--&gt;
&lt;?php endif; ?&gt;
&lt;form action="form&amp;htmlspecialchars.php" method="get"&gt;
&lt;!--action先が自ファイルなので、送信すると画面上は更新した時と同様になる
がサーバーとやり取りを行い、phpを実行している--&gt;
&lt;p&gt;
名前を入力してください。:
&lt;input type="text" name="name"&gt;
&lt;input type="submit" value="送信"&gt;
&lt;/p&gt;
&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;


&lt;!-- ===================================================
     ファイル名【reference.html】以下コード
     =================================================== --&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
&lt;meta charset="UTF-8"&gt;
&lt;title&gt;フォーム送信&lt;/title&gt;
&lt;!--
htmlの場合は、実行して渡す。
phpの場合は、そのまま渡す。
今回は、特にhtmlの中身を記載するわけではないため、どちらでもOK
--&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;h1&gt;フォーム送信ページ&lt;/h1&gt;
&lt;form action="./reference_source.php" method="post" enctype="multipart/form-data" target="_blank"&gt;
&lt;!-- ブラウザを別タブで表示させたいため、target="_blank"を追記 --&gt;
&lt;!--
action先は、フォームデータを受け取るphpファイルを指定する。
フォーム内で画像等のファイル送信を行う時は
enctype="multipart/form-data"
を指定する。(指定しないとファイル送信が失敗となってしまう)
--&gt;
メールアドレス:&lt;input type="email" name="email"&gt;&lt;br&gt;
&lt;!--name属性は、phpの変数名で使えない予約語以外で指定 --&gt;

血液型: &lt;input type="radio" name="blood" value="A"&gt;A型
&lt;input type="radio" name="blood" value="B"&gt;B型
&lt;input type="radio" name="blood" value="O"&gt;O型
&lt;input type="radio" name="blood" value="AB"&gt;AB型 &lt;br&gt;
&lt;!--
ラジオボタンは複数の選択肢から一つを選択してもらう
選択されるのはどれか1つなので、name属性は同じに設定する。
ユーザーが入力しないので、サーバーに送信される値をvalueで指定する。
ラジオボタン選択を血液型の他に性別など違う種類の選択肢でも使う場合は、
血液型グループ1つのname属性、性別グループ1つのname属性とでき
name属性を分ければ複数の種類のラジオボタンを設置できる。
--&gt;
趣味:&lt;input type="checkbox" name="fav[]" value="0"&gt;旅行
&lt;input type="checkbox" name="fav[]" value="1"&gt;スポーツ
&lt;input type="checkbox" name="fav[]" value="2"&gt;音楽
&lt;input type="checkbox" name="fav[]" value="3"&gt;インターネット&lt;br&gt;
&lt;!--
checkboxは、複数選択できる形式のため、回答が複数送信される
この時、name属性はバラバラにするのではなく、1つのname属性で配列で受け取る形にする
name属性の値の最後に[]を付けることで、phpに多次元配列として渡される。
value値の考え方は、ラジオボタンと同じ
今回の様に文字数の多い選択項目に関してはコード化してやり取りするのが一般的。
データベース格納時にコード化して格納するものは、ここのvalue値からコードで行う。
削除して追加の場合は、削除する内容のコードを欠番として処理を行う。(使用しない)
データベースとユーザーの入力した内容を一致させる考え方。仲立ちをするPHPで処理伝達
--&gt;
質問等:&lt;textarea name="qus"&gt;&lt;/textarea&gt; &lt;br&gt;
&lt;input type="submit" value="送信"&gt;
&lt;input type="reset" value="入力リセット"&gt;
&lt;!--ボタンのvalue値はボタン上に出る文字--&gt;
&lt;/form&gt;
&lt;/body&gt;
&lt;/html&gt;


&lt;!-- ===================================================
     ファイル名【reference_source.php】以下コード
     =================================================== --&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
&lt;meta charset="UTF-8"&gt;
&lt;title&gt;フォーム受信&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;h1&gt;送信データ表示&lt;/h1&gt;

&lt;!-- 接続確認
&lt;?php var_dump($_POST['email']); ?&gt;
--&gt;

&lt;?php 
// フォームからデータが送信されてきているかチェック（if文の開始）
if (!empty($_POST)): 
?&gt;

&lt;p&gt;メールアドレス: &lt;?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?&gt;&lt;/p&gt;
&lt;p&gt;血液型: &lt;?php echo htmlspecialchars($_POST['blood'], ENT_QUOTES, 'UTF-8'); ?&gt;型&lt;/p&gt;
&lt;!--
血液型はラジオボタンの為、制作側で指定したvalue値が送信される。
ユーザーが入力した文字列ではないので、htmlspecialcharsの設定は不要
また、用意したvalue値は、A,B,O,ABのみなので、画面表示の時に「型」をPHP側で追記している
※ただしセキュリティの観点から、念のためhtmlspecialcharsを入れておくのが安全です
--&gt;

&lt;?php
/*チェックボックスは配列で個数はユーザーのチェックした個数の為、毎回異なる。
それを全件受け取るためforeach文で配列から取り出していく。
今回、value値をコード化しており、コードのまま表示してもユーザーにはわからない。
そのため、コードから各項目の文字列を取得できる配列を用意する*/
$favarr = array('旅行','スポーツ','音楽','インターネット');
//foreachで取得できるコードを使用して、画面表示では$favarr[$value]と配列から該当する文字列を取得する

$fav = array();
if (isset($_POST['fav']) &amp;&amp; is_array($_POST['fav'])) {
    foreach($_POST['fav'] as $value){
        $fav[] = $favarr[$value];
    }
}
//配列favに再度入れなおしてあげる
?&gt;

&lt;p&gt;趣味: &lt;?php echo implode('、', $fav); ?&gt;&lt;/p&gt;
&lt;p&gt;質問等:&lt;br&gt;&lt;?php echo nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8')); ?&gt;&lt;/p&gt;
&lt;!--
textareaに入力された情報は、ユーザーが入力エリアで改行をした部分に半角スペースが入る形で1行で表示される。
これは、ユーザーの改行をphpでは改行コードで受け取りをしており、この改行コードはhtmlで表示する時には半角スペースに置き換わるhtml側の表示ルールから起こっている
これを改行して表示したい場合は、改行コードを&lt;br&gt;で出力するnl2brを使用する。
htmlspecialchars($_POST['qus'],ENT_QUOTES, 'UTF-8')を()内に書いていく
nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8'))の形でechoを行う
--&gt;

&lt;?php
else: // データが送られてきていない場合
?&gt;
&lt;p&gt;未入力の項目があります&lt;/p&gt;
&lt;p&gt;&lt;a href="./formsend.php"&gt;入力ページへ&lt;/a&gt;&lt;/p&gt;
&lt;?php
endif; // if文の終了
?&gt;

&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0930_lecture.php --&gt;</code></pre>
</body>
</html>
