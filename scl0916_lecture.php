<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2026/9/16 授業中の記述</title>
</head>
<body>
<pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;9/16(木)職業訓練授業&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;p&gt;PHPスクリプトを実行します&lt;/p&gt;
&lt;?php
/*
サンプルのPHPスクリプトです
*/
$number = rand(1,100); //乱数を取得　（1~100の範囲）
?&gt;　　

&lt;p&gt;&lt;?php var_dump($number);?&gt;&lt;/p&gt;
&lt;?php
 //変数の中身の型と値を出力（確認用）

$number = rand();
if ($number % 2 == 0){
?&gt;
&lt;p&gt;&lt;?php echo $number, "は偶数です。",PHP_EOL; ?&gt;&lt;/p&gt;
&lt;?php }
else{
?&gt;

&lt;p&gt;&lt;?php echo $number, "は奇数です。",PHP_EOL;?&gt;&lt;/p&gt;
&lt;?php }
/*
phpブロック内の改行はhtmlソースに影響しないので、php_EOLで改行指示あしてソースをみやすくする。
phpブロック外の改行はhtmlソース内の改行として書いたものになるので、PHP＿EOLは不要になる。
phpブロック外のタブはソースに反映されるのでphpブロック開始に関してはタブを使用せず
ソースの左恥から書き始める方がソースが見やすくなる。
*/
//IF文のやループ文の途中でもphpブロックを終了・再開による分割は可能。
 $text="文字列";
 $dob=0.123;
?&gt;
  &lt;p&gt;&lt;?php var_dump($text);?&gt;&lt;/p&gt;
  &lt;p&gt;&lt;?php var_dump($dob);?&gt;&lt;/p&gt;
  &lt;p&gt;PHPスクリプトおわり。&lt;/p&gt;
&lt;?php
/*
var?dump()の結果について　P39参考
文字列型のときは、string()の後に文字の中身、()内にはバイト数が出力（全角文字は3バイト）
浮遊小数点型の時は、float()の形で（）内に値が出力。
浮遊小数点は、現在doubleという方式が採用されているが、表示は旧方式のfloatで表示される

型について調べる時デバッグ用関数 var_dump()を使用する。
ただし、javascriptのようなconsole,log()と違い
var dumpはブラウザ上に出力されるので
確認後、削除（コメントアウト）する必要がある。
?&gt;
*/
?&gt;

&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0916_lecture.php --&gt;
&lt;!-- ↑をコピペして外部のブラウザで開いて動作チェック --&gt;

出力してる要素毎にphpで区切る。</code></pre>

</body>
</html>

</code></pre>
</body>
</html>