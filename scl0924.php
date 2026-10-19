<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/24(木)の職業訓練授業ノートです。文字列連結の半角スペースの罠、パースエラー対策、排他的論理和(XOR)、宇宙船演算子、混合配列の自動連番ルール、配列要素の操作(array_splice)をまとめています。">
    <title>9/24(木)職業訓練授業：演算子・文字列連結の罠・配列の高度な操作 | ポートフォリオサイト</title>
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

            <h1>9/24(木)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">演算子・文字列連結の罠・配列の高度な操作</p>

            <!-- 1. 演算子の基本 -->
            <div class="note-section">
                <h3 class="note-title">1. 演算子の基本</h3>
                <p>代入演算子、代数演算子、および複合演算子の基本的な挙動は、 <strong>PHPとJavaScriptで共通（同じ）</strong> です。</p>
                <p>※ビット（bit）演算子は実務であまり使用しないため、今回の授業ではスキップします。</p>
            </div>

            <!-- 2. 文字列演算子（重要：半角スペースの罠） -->
            <div class="note-section">
                <h3 class="note-title">2. 文字列演算子（重要：半角スペースの罠）</h3>
                <p>PHPにおける文字列連結は、 echo 文の内部ではカンマ <code>,</code> による連結が可能ですが、その他の場所ではドット <code>.</code> による連結を行います。</p>

                <div class="sub-heading"> ⚠ 半角スペースなしによるパースエラー</div>
                <p>数字（または数値を格納した変数）と <code>.</code> （ドット）を連結させる際、前後に<strong>半角スペースがない状態</strong>だと、プログラムはドットを文字列連結ではなく「小数点（浮動小数点型）」として解釈してしまいます。</p>

                <pre><code>&lt;?php
$age = 15;
$tom = ' Tom is ' . $age . ' years old.'; // ⭕ 正常（Tom is 15 years old）
$tom = ' Tom is ' . $age. ' years old.'; // ❌ Parse error!
// $ageの後に半角スペースが無いため「15.years」という不正な小数と認識されます。
?&gt;</code></pre>

                <div class="sub-heading"> 💡 小数点として認識されるルール</div>
                <ul>
                    <li><strong>前にドット：</strong> <code>.2</code> は <code>0.2</code> と判断される。</li>
                    <li><strong>後にドット：</strong> <code>2.</code> は <code>2.0</code> と判断される（※ブラウザ出力時は末尾の0が省略され <code>2</code> と表示）。</li>
                    <li><strong>前後にドット：</strong> 小数点が2つある状態になり、文法エラー（Parse error）になります。</li>
                </ul>

                <div class="sub-heading"> ✅ 対策：文字列連結として正しく認識させるには</div>
                <p>① <strong>「 . 」の前後に必ず半角スペースを空ける</strong>、または<br>
                    ② <strong>数字を "" や '' で囲んで明示的に文字列化する</strong> のどちらかで対応します。</p>
            </div>
            <!-- 3. 論理演算子 ＆ 比較演算子 -->
            <div class="note-section">
                <h3 class="note-title">3. 論理演算子 ＆ 比較演算子</h3>

                <div class="sub-heading"> 排他的論理和（XOR）</div>
                <p>PHPでは排他的論理和（ <code>xor</code> ）が使えます。<strong>「両辺のどちらか一方のみが true の場合」</strong> に結果が true となります（両方 true、または両方 false の場合は false になります）。</p>

                <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 14px; text-align: center;">
                    <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                        <th style="padding: 8px;">A</th>
                        <th style="padding: 8px;">B</th>
                        <th style="padding: 8px;">結果</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 8px;">0</td>
                        <td style="padding: 8px;">0</td>
                        <td style="padding: 8px; font-weight: bold;">0</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 8px;">0</td>
                        <td style="padding: 8px;">1</td>
                        <td style="padding: 8px;">1</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 8px;">1</td>
                        <td style="padding: 8px;">0</td>
                        <td style="padding: 8px;">1</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 8px;">1</td>
                        <td style="padding: 8px;">1</td>
                        <td style="padding: 8px; font-weight: bold;">0</td>
                    </tr>
                </table>

                <div class="sub-heading"> 比較演算子のバリエーション</div>
                <ul>
                    <li><code>$a != $b</code> または <code>$a &lt;&gt; $b</code> ： 値が等しくない時に true（型は自動変換されます）。</li>
                    <li><code>$a !== $b</code> ： 値、もしくは型のどちらか（あるいは両方）が等しくない時に true。</li>
                </ul>

                <div class="sub-heading"> 宇宙船演算子（ &lt;=&gt; ）</div>
                <p>結果が true/false の2択ではなく、<strong>「1, 0, -1」の3択</strong>で返るのが特徴です。通常の if文 よりも、 switch 文などで条件分岐させる際によく使用されます（型は問いません）。</p>
                <ul>
                    <li>値1 &gt; 値2 のとき： <code>1</code> を返す</li>
                    <li>値1 = 値2 のとき： <code>0</code> を返す</li>
                    <li>値1 &lt; 値2 のとき： <code>-1</code> を返す</li>
                </ul>
            </div>

            <!-- 4. 配列と連想配列 -->
            <div class="note-section">
                <h3 class="note-title">4. 配列と連想配列</h3>
                <ul>
                    <li><strong>添字配列：</strong> 0番目から順番に自動的に番号（添字）が付与される配列。</li>
                    <li><strong>連想配列：</strong> 添字の部分に、任意の文字列などの「キー（Key）」を指定して作成する配列。</li>
                </ul>

                <div class="sub-heading"> 💡 キーの自動連番ルール（混合配列）</div>
                <p>PHPでは、キーを指定する要素と指定しない要素を<strong>同じ配列内に混在（混合配列）</strong> させることができます。キーを指定しなかった要素には、 <strong>それまでに使われた最大の数値キー ＋ 1</strong> の連番キーが自動的に設定されます。</p>

                <pre><code>&lt;?php
$fruits_mixed = array(
    'peach',       // 自動的にキー [0]
    'blueberry',   // 自動的にキー [1]
    'apple'  =&gt; 'red',
    'banana' =&gt; 'yellow',
    'orange' =&gt; 'orange',
    'melon'        // 自動的にキー [2] （それまでの最大数値キー1を引き継いで +1）
);
?&gt;</code></pre>

                <div class="sub-heading"> 🔲 要素 of 追加方法まとめ</div>
                <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 14px;">
                    <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                        <th style="padding: 8px; text-align: left; width: 25%;">配列タイプ</th>
                        <th style="padding: 8px; text-align: left; width: 30%;">追加の書き方</th>
                        <th style="padding: 8px; text-align: left;">挙動</th>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 8px;"><strong>添字配列</strong></td>
                        <td style="padding: 8px;"><code>$a[] = 値;</code></td>
                        <td style="padding: 8px;">末尾に自動連番で要素を追加します。</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td rowspan="2" style="padding: 8px; vertical-align: top;"><strong>連想配列</strong></td>
                        <td style="padding: 8px;"><code>$a[キー] = 値;</code></td>
                        <td style="padding: 8px;">指定したキーが未使用なら新規追加、使用済なら上書きされます。</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 8px;"><code>$a[] = 値;</code></td>
                        <td style="padding: 8px;">キーを指定せず追加。0からの連番数値キーが自動で割り振られます。</td>
                    </tr>
                </table>
            </div>

            <!-- 5. 配列要素の操作（挿入・削除・分割） -->
            <div class="note-section">
                <h3 class="note-title">5. 配列要素の操作（挿入・削除・分割）</h3>
                <ul>
                    <li><strong>挿入：</strong> <code>array_splice()</code> を使用します。 ※ただし、キーの指定が維持できないため、連想配列では基本的に使用しません。</li>
                    <li><strong>削除・分割：</strong> PHPには直接要素をピンポイントで削除する専用関数ではなく、<strong>「配列の分割・切り出し」</strong> を行うことで、残った側を結果として扱い、削除の代わりとします。</li>
                </ul>
                <pre><code>// 🎬 分割・削除の検証例
$fruits_mixed = array('peach', 'blueberry', 'apple'=&gt;'red', 'banana'=&gt;'yellow', 'orange'=&gt;'orange', 'melon');
// 添字2番目から2つの要素を切り出す（元の配列から切り離される）
$result = array_splice($fruits_mixed, 2, 2);</code></pre>
                <p>🔍 配列のデバッグの際は、 <code>var_dump($変数);</code> を使用することで、格納順に「キー・値・データ型」の情報をまとめてブラウザ上に出力して確認できます。</p>
            </div>
            <!-- 6. 多次元配列 ＆ 配列の演算 -->
            <div class="note-section">
                <h3 class="note-title">6. 多次元配列 ＆ 配列の演算</h3>
                <p><strong>多次元配列</strong>の構造や考え方（配列の中にさらに配列が入る階層構造）は、 <strong>JavaScriptと共通（同じ）</strong> です。</p>

                <div class="sub-heading"> 🔲 配列の比較（ == と === の違い ）</div>
                <p>PHPでは配列同士を比較演算子で判定する際、型や値だけでなく「順序」が影響します。</p>
                <pre><code>&lt;?php
$a = array('a' =&gt; 1, 'b' =&gt; 3, 'c' =&gt; 5);
$b = array('a' =&gt; 1, 'c' =&gt; 5, 'b' =&gt; 3); // $aと中身のペアは同じだが順序が違う

var_dump($a == $b);  // ⭕ true (値とキーのセットがすべて一致していれば順序は問わない)
var_dump($a === $b); // ❌ false (値・キーだけでなく「格納順」まで一致していないとダメ)
?&gt;</code></pre>

                <div class="sub-heading"> 🔲 配列の足し算（結合 + 演算子）</div>
                <p><code>$変数a + $変数b</code> とした場合、 <strong>左側の配列（ベース）が最優先</strong>されます。</p>
                <ul>
                    <li>両方の配列に<strong>同じキー</strong>がある場合：左側（ベース）の値が保持され、右側の値は無視（破棄）されます。</li>
                    <li>左側（ベース）にしかないキー：そのまま残ります。</li>
                    <li>右側の配列にしかないキー：ベース配列の**末尾（後ろ）に追加**されます。</li>
                </ul>
                <pre><code>&lt;?php
$a = array('a' =&gt; 1, 'b' =&gt; 3, 'c' =&gt; 5);
$c = array('a' =&gt; 1, 'b' =&gt; 2); // 'b'のキーが重複している

var_dump($a + $c); // 💡 結果: bは左側の $a の値「3」が優先されます。
var_dump($c + $a); // 💡 結果: bは左側の $c の値「2」になり、 $cにない 'c' が末尾に追加されます。
?&gt;</code></pre>
            </div>

            <!-- 🧠 復習ミニクイズ（全5問） -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. 文字列連結で「 $tom = 'Tom ' . $age. ' years'; Sunda 」のように数値の直後にスペースを空けずにドットを書くとパースエラーになる理由は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 PHPプログラムがドット（.）を文字列連結ではなく「小数点（浮動小数点型）」として解釈してしまうため。</p>
                            <p style="margin-bottom: 0;">解説： 数値の直後にスペースなしでドットが続くと、 15.years のような不正な小数を構成しようとしてエラーになります。文字列連結を安全に行うには、ドットの前後に必ず半角スペースを空ける必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. 論理演算子「XOR（排他的論理和）」において、結果が true（1）になるのはどのような条件のとき？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 比較する左右の条件のうち、「どちらか一方のみ」が true のとき。</p>
                            <p style="margin-bottom: 0;">解説： 両方とも true 、または両方とも false の場合は結果が false（0） になります。片方だけが成立している状態を判定したいときに便利な演算子です。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. 宇宙船演算子（ &lt;=&gt; ）において、左辺の値と右辺の値が「完全に等しい」ときに返される数値はどれ？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 0</p>
                            <p style="margin-bottom: 0;">解説： 宇宙船演算子は3択の数値を返します。左辺が大きいときは 1 、左右が等しいときは 0 、右辺が大きいときは -1 が返るため、 switch 文などと組み合わせて細かく分岐させる際に重宝します。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. 混合配列において、キーを指定しなかった要素には自動的にどのようなキーが割り振られるルールになっている？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 それまでにその配列内で使われた「最大の数値キー ＋ 1」の連番数値。</p>
                            <p style="margin-bottom: 0;">解説： キーを指定した連想配列の要素の直後に、キーなしで要素を追加すると、直前の数値インデックスを引き継いで自動的にカウントアップされたキー（連番）が割り当てられます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. 配列の足し算「 $a + $b 」を行った際、両方の配列に全く同じ「キー」が存在していた場合、どちらの値が優先して保持される？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 左側の配列（この場合は $a）の値が最優先で保持される。</p>
                            <p style="margin-bottom: 0;">解説： 配列の結合演算子（ + ）は左側がベースになります。キーが重複した場合は左側の値が残り、右側の配列にある重複キーの値は無視（破棄）されます。右側にしか存在しないキーのみが末尾に追加される仕組みです。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->
            <p style="margin-top: 25px;">
                <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>
        </main>


    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>