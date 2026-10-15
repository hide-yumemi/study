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
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;9/28(月)職業訓練授業&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;p&gt;P108&lt;/p&gt;
&lt;?php
  function hello($name,$greeting = 'Hello!'){
  echo $greeting,$name, PHP_EOL;
}
hello('Bob', 'Good Morning!');
//第2引数にGood Morningを指定したので、hello関数の$greetingの初期値は使われない
hello('Tom');
//引数を1つしか渡していないので、hello関数の$greetingは初期で設定したHello!が代入される

//関数を作成する時は、引数に初期値を設定するかしないかを決める必要がある
//初期値を設定するものとしないものが混在する場合、必ずしないものから順に
//左（前）にしていく。
//後から初期値の有無を変更した場合、既存の関数呼び出しも引数の順番を変えなければ
//ならなくなるので、ミスが発生しやすくなってしまう。
?&gt;

&lt;p&gt;P109&lt;/p&gt;
&lt;?php
// 引数に「array」を指定して、配列しか受け取らない関数を定義する
function array_output(array $target_array) {
    foreach ($target_array as $value) {
        echo $value . PHP_EOL;
    }
}

$array = array(1, 2, 3);
array_output($array); // 正常に動く

// array_output(1); // ここで「配列じゃないよ」というエラー（TypeError）が発生する
?&gt;


&lt;p&gt;P110&lt;/p&gt;
&lt;?php 
//コールバック関数
$array = array(1, 1.5, "2", true,);
$new_array = array_map('strval',$array);
//array_map() 第2引数に指定した配列の各要素を第1引数に指定した関数に
//順番に渡して、実行結果を新しい配列の各要素として格納していく
//strval()　文字列型に変換する関数（教科書P68）
//関数内で呼び出しているので、JS同様（）なしにして関数名を文字列として指定
//'strval'ではなくstrval()と書いてしまった場合、先にstrval関数を実行しようとして
//引数が指定されていないのでｍエラーになる。
//引数がなくてもエラーにならない関数の場合、関数の実行結果がarray_map関数の第1引数となってしまう。
?&gt;

&lt;p&gt;$new_arrayの中身&lt;/p&gt;
&lt;p&gt;&lt;?php var_dump($new_array) ?&gt;&lt;/p&gt;

&lt;p&gt;arrayの中身&lt;/p&gt;
&lt;p&gt;&lt;?php var_dump($array)?&gt;&lt;/p>

&lt;?php
//可変変数（P110～）
function func_caller($name){
  if(function_exists($name)){
    //function_exists(変数) 引数に指定した変数に代入された値が関数だったらtrue
    //関数じゃなかったらfalseになる。
    $name();//foo();に置き換わり即時実行（可変関数）
  }
}
function foo(){
  echo 'foo called' , PHP_EOL;
}
func_caller('foo');
//文字列fooを引数として渡してfunc_caller関数を実行
//
?&gt;
&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0928_lecture.php --&gt;</code></pre>
</body>
</html>
