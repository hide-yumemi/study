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
  &lt;title&gt;9/29(火)職業訓練授業参考書114P&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
  
&lt;?php
  $add = function($v1, $v2){  //無名関数を変数に代入
  return $v1 + $v2;

  };                          //代入命令なのでセミコロンが必要
  $result = $add(2,5);          //return値を変数で受け取る
//無名関数を変数に代入した場合、この関数の呼び出しは
//変数名（）
//となるため、通常の関数呼び出しと異なり$が必要になる
//その他は通常の関数と同様に扱えるが、この変数名に別の値の代入を
//行わない事が前提となる
$add="test";
var_dump($add);
//上記のように無名関数が代入された変数に通常の値を再代入できてしまう為。
?&gt;
&lt;p&gt;&lt;?php echo $result; ?&gt;&lt;/p&gt;
&lt;?php require '0929load_.php';

//ファイルの指定は相対パスまたは絶対パスで行う
//同一サーバー内であれば、html同様相対パス

      require '0929load_.php';  //2個目
      include '0929load_.php';  //3個目(includeでも同じ結果
      //動きの違いは、指定したファイルがない時のエラーの種類のみ。
      //requireとincludeは_onceを付けると
      include_once '0929load_.php'; //表示されない。
      //同一ファイルの2回目の読み込みを実行しない（エラーなし）
      //ループ処理などで誤って複数回読み込んでしまうのを防いでる。
      //還俗、複数回読み込み前提のファイルを除き_onceを付けるのが推奨されている。

      //存在しないファイルの読み込みエラーを確認する
      
      //require '0929load__error.php';
      //requireでは、warningとFatalエラーの2つが出る。
      //バージョンによって、Fatalのみの場合がある。
      //少なくともFatalが出て処理終了

      //include '0929load__error.php';
      //includeでは、warningが2つ出る
      //バージョンによって、1つになる、
      //いずれにしてもwarningのみなので
      //処理は継続される。
      
//requireとincludeの使い分け

//前者は運用時及び連結テスト最終段階、後者はファイル単体テスト、最初の結合テストまで。
//で運用される事が多い。実用段階でincludeだと読み込みファイル側にトラブル発生時に
//ユーザーの開いている画面に誤作動以降の誤った情報が表示される可能性があり
//requierだと処理が止まる為、誤った情報の表示は防げる。
//同じエラーならば誤情報を出さない方が良いという考え方。
?&gt;

&lt;p&gt;exit前&lt;/p&gt;
&lt;?php
exit();
//exit(もしくはdie)以降はphpだけではなくhtml部分も含めて処理を行わず
//ユーザーのブラウザに送信される。&lt;body&gt;なども消える。
//この事から強制終了時のみ使う命令である。
//不正アクセス疑い、データベースアクセスエラー等の場合に行う。
//（）内に文字を入れると、ブラウザに表示させる事が出来る。
//通常では使用しない為、if文等の分岐で使用する。
//例外として、phpによる命令でほかのページへ強制移動する時は
//移動命令のあとにexitでそれ以降の処理を行わないようにする
//移動先のファイルをユーザーに送るので、移動命令後の処理を読み込むと誤作動を
//起こしてしまうサーバーが存在する為。
?&gt;
&lt;p&gt;exit後&lt;/p&gt;

&lt;hr&gt;
&lt;!-- 💡 フォーム送信のデータ検証用構造もエスケープ化してここに合流させています --&gt;
&lt;?php 
if (isset($_GET['name']) &amp;&amp; strlen($_GET['name']) &gt; 0):
?&gt;
&lt;p&gt;&lt;?php echo htmlspecialchars($_GET['name'],ENT_QUOTES,'UTF-8'); ?&gt;さんこんにちは&lt;/p&gt;
&lt;?php endif; ?&gt;
&lt;form action ="scl0929_run.php" method="get"&gt;
&lt;p&gt;
  名前を入力してください：
  &lt;input type="text" name="name"&gt;
  &lt;input type="submit" value="送信"&gt;
&lt;/p&gt;
&lt;/form&gt;

&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0929_lecture.php --&gt;</code></pre>
</body>
</html>
