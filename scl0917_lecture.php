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
  &lt;title&gt;9/17(木)職業訓練授業&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;?php
$string1 = 'this is string';
$string2 = "this is string";
$string3 = 'hi,$string2 \r\n';
$string4 = "hi,$string2 \r\n";
?&gt;
&lt;p&gt;シングル&lt;p&gt;
&lt;p&gt;&lt;?php echo $string3; ?&gt;&lt;/p&gt;
&lt;p&gt;ダブル&lt;/p&gt;
&lt;p&gt;&lt;?php echo $string4; ?&gt;&lt;/p&gt;
&lt;?php
$age=15;
echo "${age}years old.",PHP_EOL;  //PHP8.2ver以降は非推奨の書き方の為、${age}は横線が付く
echo "&lt;br&gt;";                      //推奨される記述は{$age} 今は動く。
?&gt;
&lt;?php
$age=15;
$foo=&lt;&lt;&lt;EOI
ヒアドキュメントでは、このように、
複数行にわたる文章をそのまま表記する事ができます。

Tomの年齢は"$age"際です。
EOI;

$foo2=&lt;&lt;&lt;'EOI'
Nowdocでは、終端識別子をシングルクォートで囲みます
複数行にわたる文章をそのまま表記する事ができます。

Tomの年齢は"$age"際です。
この $age は展開されず、$ageのまま出力されます。
EOI;
/*
ヒアドキュメントやNowdocで使用している識別子は、
開始と終了を意味しており、入れ子の形でどれがおわりかわからなくなる形では書かない
その為、同一ファイル内で同じ識別子を何回でも使用できる。
*/
?&gt;  
&lt;h2&gt;ヒアドキュメント&lt;/h2&gt;
&lt;p&gt;&lt;?php echo $foo; ?&gt;&lt;/p&gt;
&lt;h2&gt;Nowdos&lt;/h2&gt;
&lt;p&gt;&lt;?php echo $foo2; ?&gt;&lt;/p>

&lt;h2&gt;nlbr使用でヒアドキュメント&lt;/h2&gt;
&lt;p&gt;&lt;?php echo nl2br($foo); ?&gt;&lt;/p&gt;
&lt;h2&gt;nlbr使用でNowdoc&lt;/h2&gt;
&lt;p&gt;&lt;?php echo nl2br($foo2); ?&gt;&lt;/p&gt;
&lt;!--
ブラウザ表示を考えると、ドキュメントやNowdocで作成したテキストは
nl2br()を使用してブラウザ表示時も改行するようにプログラムする事が多い
--&gt;
&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0917_lecture.php --&gt;
&lt;!-- ↑をコピペして外部のブラウザで開いて動作チェック --&gt;</code></pre>
</body>
</html>
