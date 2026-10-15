<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/28(月)の職業訓練授業ノートです。exit/dieによる処理終了、外部ファイルの読み込み(require/include)、関数のデフォルト値、引数の型指定、array_map関数の使い方をまとめています。">
    <title>9/28(月)職業訓練授業：ファイルの読み込み・関数の高度な引数と配列制御 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">
    <!-- クイズ専用CSSを読み込み -->
    <link rel="stylesheet" href="quiz.css">
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">

            <h1>9/28(月)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">制御構造 of 終了・ファイルの読み込み・関数の高度な引数と参照</p>

            <!-- 1. PHPの実行を終了させる（exit / die） -->
            <div class="note-section">
                <h3 class="note-title">1. PHPの実行を終了させる（exit / die）</h3>
                <p>プログラムの処理をその場で強制終了させ、以降の処理を行わずにそこまでの結果をブラウザへ送信するための命令です。どちらも完全に同一の処理（エイリアス）となります。</p>
                <p>括弧 <code>()</code> 内に文字列を指定した場合、その文字を画面に出力してからプログラムを終了します。何も出力しない場合は括弧のみ、または括弧を省略することも可能です。</p>

                <pre><code>&lt;?php
// 文字列を出力して終了するパターン
exit('処理を終了します');
die('エラーが発生したため終了します');

// 何も出力せずに終了するパターン
exit();
die;
?&gt;</code></pre>
            </div>

            <!-- 2. 他のPHPプログラム（外部ファイル）の読み込み -->
            <div class="note-section">
                <h3 class="note-title">2. 他のPHPプログラム（外部ファイル）の読み込み</h3>
                <p>共通の処理（ヘッダーやフッター、データベース接続など）を別ファイルにまとめて複数のページから読み込んだり、1つのシステムを複数人で分担して開発したりする際に使用します。メインとなるファイルから以下の4つの命令を使って読み込みます。</p>

                <div class="sub-heading"> 2-1. _once系（一回だけ読み込む命令）</div>
                <p>同一ファイルを複数回読み込もうとした場合、2回目以降の読み込みは自動的に無視（スキップ）されます。多重定義によるエラーを防ぐために便利です。</p>
                <ul>
                    <li><code>require_once</code> ： 必須ファイルを1回だけ読み込む</li>
                    <li><code>include_once</code> ： 任意のファイルを1回だけ読み込む</li>
                </ul>

                <div class="sub-heading"> 2-2. 通常系（何回でも読み込む命令）</div>
                <p>同じファイルを同じページ内で何回でも読み込むことができます。ループ処理の中でテンプレートファイルを繰り返し読み込む場合などに使用します。</p>
                <ul>
                    <li><code>require</code> ： 必須ファイルを何回でも読み込む</li>
                    <li><code>include</code> ： 任意のファイルを何回でも読み込む</li>
                </ul>

                <div class="sub-heading"> 📐 重要：エラーの重要度と挙動の違い</div>
                <p>指定したファイルが存在しない（読み込めない）場合、エラーの重大度によってその後の処理が変わります。</p>
                <ul>
                    <li><strong>require / require_once：</strong> <strong>Fatal error（致命的エラー）</strong> となり、処理がその場で<strong>強制停止</strong>します。</li>
                    <li><strong>include / include_once：</strong> <strong>Warning（警告）</strong> が出ますが、処理はそれ以降も<strong>続行</strong>されます。</li>
                </ul>
                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>💡 開発時と実運用の使い分け：</strong><br>
                    開発中は、読み込み対象のファイルが未完成（存在しない）状態であっても、単体で他の部分の処理テストを進められるように <code>include</code> を使うことがあります。しかし、実運用では不完全な状態で処理が動き続けると予期せぬバグを招くため、安全のために <code>require</code> を使用するのが一般的です。
                </p>
            </div>

            <!-- 3. 関数の引数（初期値・デフォルト値の設定） -->
            <div class="note-section">
                <h3 class="note-title">3. 関数の引数（初期値・デフォルト値の設定）</h3>
                <p>PHPでは、引数にあらかじめ初期値を指定しておくことで、関数呼び出し時にその引数が渡されなかった場合に自動で初期値を使用させることができます。</p>

                <div class="sub-heading"> 📐 厳格な規則：初期値のある引数は「右側」に設置する</div>
                <p>PHPの関数は、呼び出された際に渡された値を<strong>「左から順番に」</strong> 引数へ割り当てます。そのため、初期値のある引数を左側に置いてしまうと、意図しない割り当てになりエラーの原因となります。</p>
                <pre><code>&lt;?php
// ❌ 間違った書き方（初期値が左側にある）
function greet($name = 'ゲスト', $message) {
    echo "{$name}さん、{$message}";
}
// 関数名('こんにちは'); と呼び出すと、'こんにちは'は$nameに渡され、$messageが空のままとなりエラーになります。

// ⭕ 正しい書き方（初期値は右側に寄せる）
function greet($message, $name = 'ゲスト') {
    echo "{$name}さん、{$message}";
}
greet('こんにちは'); // 「ゲストさん、こんにちは」と出力される
?&gt;</code></pre>
            </div>
            <!-- 4. 関数の引数（型指定 / タイプヒンティング） -->
            <div class="note-section">
                <h3 class="note-title">4. 関数の引数（型指定 / タイプヒンティング）</h3>
                <p>関数に渡される引数のデータ型をあらかじめ指定しておく仕組みです。これにより、意図しない型のデータが渡されて関数が誤作動を起こすのを未然に防ぐことができます。配列処理を行う際などに特によく活用されます。</p>
                <p><strong>書き方：</strong> 型と引数名の間を「半角スペース」で区切って指定します。</p>
                <pre><code>function 関数名(型 $引数名) { 〜 }</code></pre>
                <p><strong>主要な型の一覧：</strong> <code>string</code> （文字列）、 <code>int</code> （整数）、 <code>float</code> （浮動小数点数）、 <code>bool</code> （論理値）、 <code>array</code> （配列）</p>
            </div>

            <!-- 5. array_map() 関数 -->
            <div class="note-section">
                <h3 class="note-title">5. array_map() 関数</h3>
                <p>第2引数に指定した配列のすべての要素に対して、第1引数に指定した関数（コールバック関数）を適用し、加工された新しい配列を返す組み込み関数です。</p>
                <pre><code>&lt;?php
// $arrayの全要素の型を文字列型（string）にした新しい配列$new_arrayを作成する
$array = array(10, 20, 30);
$new_array = array_map('strval', $array); // 結果: ['10', '20', '30']
?&gt;</code></pre>
            </div>

            <!-- 6. コールバック関数と無名関数 -->
            <div class="note-section">
                <h3 class="note-title">6. コールバック関数と無名関数</h3>
                <p><strong>コールバック関数：</strong> 関数の引数として渡され、別の処理の中から後から呼び出されて実行される関数のことです。</p>
                <p><strong>無名関数（匿名関数）：</strong> 名前を持たない使い捨ての関数です。コールバック関数をその場に直接記述する際に便利です。</p>
                <p><code>array_map()</code> のように第1引数にコールバック関数を指定する関数では、引数の中に直接無名関数を書き込んで処理を渡すことができます。</p>
                <pre><code>&lt;?php
// array_map() の引数に直接無名関数を記述して各要素を2倍にする例
$array = array(1, 2, 3);
$result = array_map(function($value){
    return $value * 2;
}, $array); // 結果: [2, 4, 6]
?&gt;</code></pre>
            </div>

            <!-- 7. function_exists() と 可変関数 -->
            <div class="note-section">
                <h3 class="note-title">7. function_exists() と 可変関数</h3>

                <div class="sub-heading"> 7-1. function_exists()</div>
                <p>引数に指定した文字列が、システム内に実際の「関数名」として定義されているかどうかを調べる関数です。存在していれば true、存在していなければ false を返します。</p>

                <div class="sub-heading"> 7-2. 可変関数</div>
                <p>変数名に括弧を付けて <code>$変数名()</code> と記述することで、変数の中に代入されている文字列と同じ名前の関数を動的に実行する方式です。</p>
                <pre><code>&lt;?php
function foo() {
    echo 'foo called';
}
$name = 'foo';
if (function_exists($name)) {
    $name(); // $nameが'foo'に置き換わり、foo() として即時実行される（可変関数）
}
?&gt;</code></pre>
            </div>
            <!-- 8. 参照（リファレンス） -->
            <div class="note-section">
                <h3 class="note-title">8. 参照（リファレンス）</h3>
                <p>メモリ上に保存された1つの同じ値を、複数の異なる変数が共有する仕組みです。変数を参照させるには、代入や引数定義の際に変数名の前に <strong>&amp; （アンパサンド）</strong> を付けます。</p>
                <pre><code>&lt;?php
$a = 1;
$b = &amp;$a; // $bは$aを参照（値を共有）
$b++;    // $bをインクリメントすると、共有している$aの値も変わる
echo $a; // 出力：2
echo $b; // 出力：2
?&gt;</code></pre>

                <div class="sub-heading"> 8-1. 関数での参照渡し（引数）</div>
                <p>関数の引数定義に <code>&amp;</code> を付与すると、関数スコープを超えて、呼び出し側の元の変数を直接操作できます。この場合、 <code>return</code> （戻り値）を使わなくても呼び出し側に結果を反映させることができます。</p>
                <pre><code>&lt;?php
function add_one(&amp;$value) { // 引数を受け取る際に参照に指定
    $value += 1;
}
$a = 10;
add_one($a); // 引数として変数を渡す
echo $a;     // 出力：11 （関数内での加算がそのまま元の変数に反映される）
?&gt;</code></pre>

                <div class="sub-heading"> 8-2. 参照を使わず通常の戻り値（return）で結果を受け取る場合</div>
                <p>参照渡しを使わない通常の方法では、関数内で計算した結果を <code>return</code> で返し、呼び出し側で変数に再代入する必要があります。</p>
                <pre><code>&lt;?php
function add_one2($value) {
    $value += 1;
    return $value;
}
$a = add_one2(10); // 直接数値を引数に指定可能。戻り値を$aに代入する
echo $a;           // 出力：11
?&gt;</code></pre>
            </div>

            <!-- 9. 変数に無名関数を代入する -->
            <div class="note-section">
                <h3 class="note-title">9. 変数に無名関数を代入する</h3>
                <p>無名関数を変数に代入し、その変数を通常の関数と同じように呼び出して使用することができます。これは代入文であるため、 <strong>処理の末尾に必ずセミコロン ; が必要</strong>となる点に注意してください。</p>
                <pre><code>&lt;?php
// 変数に変数を代入する文なので、閉じ括弧の後に「;」が必須
$add = function($v1, $v2) {
    return $v1 + $v2;
};

// 呼び出す時は変数名に$を付けたまま括弧を付ける
$result = $add(5, 3);
echo $result; // 出力：8
?&gt;</code></pre>
            </div>

            <!-- 🧠 復習ミニクイズ（全5問） -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. exit() や die() 命令が実行されると、その後のプログラムの処理はどうなりますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 それ以降は一切処理を行われず、その場で実行を終了してブラウザへ送信される。</p>
                            <p style="margin-bottom: 0;">解説： exit() と die() は完全に同一の処理（終了命令）であり、括弧内に文字列を指定した場合はその文字を出力して強制終了します。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. require で指定した外部ファイルが存在しなかった場合と、include で指定したファイルが存在しなかった場合のエラーの違いは何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 requireはFatalエラー（致命的エラー）となって処理が停止し、includeはWarning（警告）を出すが処理は続行する。</p>
                            <p style="margin-bottom: 0;">解説： 絶対に省略できない重要な共通処理はrequire、ファイルがなくても他の挙動を確認したい場合などはinclude、といった使い分けを行います。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. 引数に初期値（デフォルト値）を設定する場合、初期値を持たない引数と混在するときはどちら側に設置しなければなりませんか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 右側</p>
                            <p style="margin-bottom: 0;">解説： PHPの関数は渡された値を左から順に割り当てていくため、初期値のある引数は必ず「右側」に寄せて設置する必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. 関数の引数で型指定（タイプヒンティング）を行う場合、どのように記述しますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 「型」と「引数名」の間に半角スペースを空けて区切る。</p>
                            <p style="margin-bottom: 0;">解説： function foo(int $num) { ... } のように半角スペース区切りで指定します。これにより、予期せぬ型のデータによる誤作動を防ぐことができます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. 関数定義の引数の前に「&amp;」を付ける（例：&amp;$value）と、通常の引数（値渡し）と比べてどのような違いが生まれますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 メモリ上の同じ値を複数の変数が共有する（参照渡しとなり、関数内での変更が元の変数に直接反映される）。</p>
                            <p style="margin-bottom: 0;">解説： 参照渡しを使うと、関数内で値を書き換えた際に return で値を返さなくても、呼び出し側の元の変数の値が同時に書き換わります。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>