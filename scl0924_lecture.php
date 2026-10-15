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
  &lt;title&gt;9/24(木)職業訓練授業&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;!-- 「参考書P73一番上の構文」 --&gt;
&lt;?php
$age = 15;
$tom = 'Toms is ' . $age . ' years old.';
echo $tom,PHP_EOL;
?&gt;
&lt;!-- 
$tomに代入した文字列中の文字列連結演算子「.」の前後の空白は、
phpでは演算子の前後の空白は無視するというルールから
入れても入れなくても同じ結果になる、
その為、「見やすくする」「小数点と間違わない」為によく半角スペースで空白を開けている。
特に文字列連結では、小数点の問題で開ける事が多い。

$bob='bob is ' . 16. 'years old';

上記にように書いてしまうと、16.の部分の「.」が小数点として扱われ
文字列連結演算子がない状態となり、構文エラー（シンタックスエラー）となる。 --&gt;
&lt;?php
$dbl1 =.2;
$dbl2 =15.;
// $dbl3 =15.23.5; 小数点が2つあると認識される為、構文エラーとなる。
?&gt;
&lt;p&gt;&lt;?php echo $dbl1; ?&gt;&lt;/p&gt;  &lt;!--ブラウザ表示　0.2--&gt;
&lt;p&gt;&lt;?php echo $dbl2 ?&gt;&lt;/p&gt;   &lt;!--ブラウザ表示　15--&gt;
&lt;p&gt;&lt;?php var_dump($dbl2); ?&gt;&lt;/p&gt;

&lt;!-- 
$dbl1は.2の.が小数点として扱われ0.2と出力
$dbl2は15.の.が小数点として扱われ浮動小数点型になるがechoは小数点以下が0の為、表示されず省略され15と出力
 --&gt;

&lt;?php
//宇宙船演算子の確認（&lt;=&gt;）　// &lt;=&gt;の左辺が大きければ1、同じ値なら0、右辺が大きければ-1が$resultに入る。
$num1 =5;  //数値を変動させて、確認する。
$num2 =3;
$result = $num1 &lt;=&gt; $num2;
?&gt;
&lt;p&gt;&lt;?php echo $result; ?&gt;&lt;/p>

&lt;!-- 参考書P83 --&gt;
&lt;?php
$fruits = array(
  'apple',
  'banana',
  'orange',
);
?&gt;
&lt;!-- 
 上記のように改行して書くことが多いが、改行は見やすくするためだけでしなくても問題ない。
改行とタブはこの場所であればプログラム上なかったものとされる。
 --&gt;
&lt;p&gt;&lt;?php var_dump($fruits); ?&gt;&lt;/p&gt;
&lt;?php
$fruits_mixed = array(
  'peach',
  'blueberry',
  'apple' =&gt; 'red',
  'banana' =&gt; 'yellow',
  'orange' =&gt; 'orange'
);
//peachとblueberryはキーを指定していないので、自動的に0からの連番でキーが決まる
//キーに関わらず、格納順が保証され、var_dump等ではその格納順となる。
?&gt;
&lt;p&gt;&lt;?PHP var_dump($fruits_mixed); ?&gt;&lt;/p&gt;
&lt;!-- 
上記のvar_dumpで格納順が保証されているのを確認
vat_dumpで各要素に出てくる型は値の型です。キーの型は出ない
自動付与されたキーは数値。
--&gt;
--------------------------------ここから続き　9/25日～
&lt;?php
//配列に要素を追加
$fruits[]='melon'; 
//[]の中身を未記入のままにすると、値を代入される。
?&gt;
&lt;p&gt;添字配列に要素追加後&lt;/br&gt;&lt;?php var_dump($fruits); ?&gt;&lt;/p&gt;
&lt;?php 
$fruits_mixed[]='melon';
$fruits_mixed['grape']='purple';
//連想配列の場合、キーを指定しない場合は、0～の連番の数字がキーとなり追加
//キーを指定し、そのキーが使われていない場合追加となる
?&gt;
&lt;p&gt;連想配列に要素追加後&lt;/br&gt;&lt;?php var_dump($fruits_mixed); ?&gt;&lt;/p&gt;
&lt;!-- melonはキーを指定せずに追加したので、ここまでに使われている数字キーが1までなので2となる --&gt;


 &lt;?php
 //配列の要素の上書き（再代入）
 //$fruitsの添字番号1をpeachに変更
$fruits[1]='peach';
 ?&gt;
 &lt;p&gt;添字配列の1番目をoeachに変更後&lt;/br&gt;&lt;?php var_dump($fruits) ?&gt;&lt;/p&gt;


 &lt;?php
 //$fruits_mixedのキーgrapeの値をgreenに変更
 $fruits_mixed['grape']='green';
 ?&gt;
 &lt;p&gt;連想配列にキーgrapeび値をgreenに変更&lt;/br&gt;&lt;?php var_dump($fruits_mixed); ?&gt;&lt;/p&gt;
 &lt;!-- 
 配列の要素の追加と値の変更はどちらも代入の形で行う。
 キーを指定しない・指定したキーが存在していない時は追加
 存在しているキーを指定すると値の変更となる。
--&gt;


&lt;?php 
// 配列に要素を挿入
// 連想配列に導入をいう概念はないので、添字配列のみの操作になる。
// 使用する命令も、キーは使用できない
// 添字番号1の後にblueberryを挿入
array_splice($fruits,2,0,'blueberry');
?&gt;
&lt;p&gt;添字配列の1番の次にblueberryを追加後&lt;br&gt;&lt;?php var_dump($fruits); ?&gt;&lt;/p&gt;


&lt;?php
//2個の要素を添字番号2のあとに挿入
array_splice($fruits,3,0,['banana','grape']);
?&gt;
&lt;p&gt;添字配列の2番目の次にbanana,grapeの2個を追加後&lt;br&gt;&lt;?php var_dump($fruits); ?&gt;&lt;/p&gt;
&lt;!-- 
挿入の時は、挿入するものが添字何番からにしたいのか指定する
2つ以上挿入するときは、[値1、値2・・・]の形で値を指定する。
--&gt;


&lt;?php
//配列の分割（要素の削除）
//添字配列の1番peachから3個の要素を$fruits2に分割（$fruitsからは削除）
$fruits2 = array_splice($fruits,1,3);
?&gt;
&lt;p&gt;分割後の$fruits&lt;br&gt;&lt;?php var_dump($fruits); ?&gt;&lt;/p&gt;
&lt;p&gt;分割して新しくできた$fruits2&lt;br&gt;&lt;?php var_dump($fruits2); ?&gt;&lt;/p&gt;
&lt;!-- 添字配列では、元の配列の添字番号は分割で削除された分詰めた番号になる --&gt;

&lt;?php
//連想配列の1=&gt;blueberry,&'apple'=&gt;red,'banana'=&gt;'yellow'の3個を分割し
//$fruits_mixed2とする（$fruits_mixedからは削除）
 $fruits_mixed2=array_splice($fruits_mixed,1,3);
?&gt;

&lt;p&gt;分割後の$fruits_mixed&lt;br&gt;&lt;?php var_dump($fruits_mixed); ?&gt;&lt;/p&gt;
&lt;p&gt;分割して新しくできた$fruits_mixed2&lt;br&gt;&lt;?php var_dump($fruits_mixed2); ?&gt;&lt;/p&gt;
&lt;!-- 
添字と違い連想配列はキーが数字とは限らない
array_spliceで分割開始の数字（今回は1）は、連想配列のキーを添字にしたら何番か
（5個目の要素なら4番）という数字を指定する --&gt;
&lt;?php
//$fruitsをfor文で段落で書き出し
$count = count($fruits); //$fruitsの要素数を取得
for($i=0;$i&lt;$count;$i++):
?&gt;
&lt;P&gt;&lt;?php echo $fruits[$i]; ?&gt;&lt;/P&gt;
&lt;?php endfor; ?&gt;

&lt;?php
//$fruits2をforeach文で段落書き出し
foreach($fruits2 as $value)://$valueに値を取得しながらループ
?&gt;

&lt;p&gt;&lt;?php echo $value; ?&gt;&lt;/p&gt;
&lt;?php endforeach;?&gt;

&lt;!-- 
foreachでキーを取得しない場合、添字配列でも何番かわからないので
ループ内部でif文等により見つかったら脱出というときも添字は不明のままになる
--&gt;

&lt;p&gt;ループ脱出後の$valueは&lt;?php echo $value; ?&gt;&lt;/p&gt;
&lt;!-- 
phpでは繰返し文で指定した$iや$valueといった変数は繰返し文終了後も
 脱出時の値を保持している。
 これはjavascriptのletのスコープ（有効）範囲がブロック{}なのに対し
 phpのスコープは関数と広い為。
  --&gt;

&lt;?php
// $fruits_mixedをforeach使用でキーを取得せずに値のみ取得して段落書き出し
foreach($fruits_mixed as $value)://$valueに値を取得
?&gt;
&lt;p&gt;&lt;?php echo $value; ?&gt;&lt;/p&gt;
&lt;?php endforeach; ?&gt;


&lt;?php 
// $fruits_mixed をforeachでキーと値両方を取得して段落書き出し
foreach($fruits_mixed as $key =&gt; $value):
  //keyにキー、$valueに値を取得
?&gt;

&lt;p&gt;&lt;?php echo $key; ?&gt;=&gt;&lt;?php echo $value; ?&gt;&lt;/p>

&lt;?php endforeach; ?&gt;


&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0924_lecture.php --&gt;
&lt;!-- ↑をコピペして外部のブラウザで開いて動作チェック --&gt;
出力してる要素毎にphpで区切る。</code></pre>
</body>
</html>
