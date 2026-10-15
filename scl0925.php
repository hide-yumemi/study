<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/25(金)の職業訓練授業ノートです。波括弧を使わない代替構文(コロン構文)の使い方や制限、switch文における比較精度の注意点、elseifの記述ルールをまとめています。">
    <title>9/25(金)職業訓練授業：制御構文の応用・代替構文とswitch文の注意点 | ポートフォリオサイト</title>
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
            
            <h2>9/25(金)職業訓練授業</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">制御構文の応用・代替構文（コロン構文）・switch文の注意点・配列のループ処理</p>

            <p style="margin-bottom: 25px;">
                <!-- 💡 24日の実入力コードと同一のため、リンク先を24日分へ直接合流・マッピングさせています -->
                👉 <a href="scl0924_lecture.php" target="_blank" class="td-link">この日の授業内実技コード（生ソース画面）を別タブで開いて丸ごと複製する</a>
                ｜ <a href="scl0924_run.php" class="td-link">動作確認</a>
            </p>

            <!-- 1. 制御構文とブロック文の閉じ構文 -->
            <div class="note-section">
                <h3 class="note-title">1. 制御構文とブロック文の閉じ構文</h3>
                <p>PHPでは、HTMLの中に処理を埋め込む際、通常の波括弧 <code>{ }</code> を使用する以外に、HTML記述を邪魔しないスマートな書き方が用意されています。</p>
                
                <div class="sub-heading"> HTML混在時の通常の書き方（波括弧形式）</div>
<pre><code>&lt;?php if ($display_message) { ?&gt;
    &lt;p&gt;このメッセージは$display_messageがtrueのときにのみ表示されるメッセージです。&lt;/p&gt;
&lt;?php } else { ?&gt;
    &lt;p&gt;このメッセージは$display_messageがfalseのときにのみ表示されるメッセージです。&lt;/p&gt;
&lt;?php } ?&gt;</code></pre>
            </div>

            <!-- 2. 波括弧を使用しない「代替構文（コロン構文）」 -->
            <div class="note-section">
                <h3 class="note-title">2. 波括弧を使用しない「代替構文（コロン構文）」</h3>
                <p>分岐・ループ命令において <code>{ }</code> を使用せず、開始の波括弧 <code>{</code> の代わりに<strong>コロン :</strong> を使い、閉じの波括弧 <code>}</code> の代わりに <strong>end~;</strong> を使用する構文です。</p>
                <p>HTMLとPHPが複雑に入り組むテンプレートファイルなどで、構文の構造が視覚的に分かりやすくなるため非常によく使われます。</p>
                
                <div class="sub-heading"> コロン（:）を用いたif文の代替構文例</div>
<pre><code>&lt;?php if ($display_message): ?&gt;
    &lt;p&gt;条件が一致（true）したときの表示&lt;/p&gt;
&lt;?php else: ?&gt;
    &lt;p&gt;条件が不不一致（false）したときの表示&lt;/p&gt;
&lt;?php endif; ?&gt; // endifでブロックを終了</code></pre>

                <div class="sub-heading"> 代替構文が使用できる制御命令</div>
                <p>この <code>end~;</code> 形式の閉じ方は、以下の主要な制御命令で使用できます。</p>
                <ul>
                    <li><code>if</code> 文 ➔ <code>endif;</code></li>
                    <li><code>switch</code> 文 ➔ <code>endswitch;</code></li>
                    <li><code>while</code> 文 ➔ <code>endwhile;</code></li>
                    <li><code>for</code> 文 ➔ <code>endfor;</code></li>
                    <li><code>foreach</code> 文 ➔ <code>endforeach;</code></li>
                </ul>
                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠ 注意（例外の制限）：</strong><br>
                    <strong>do-while 文にだけは代替構文が用意されていない</strong>ため、使用することができません。これだけは唯一、従来の通常の波括弧 <code>{ }</code> を使用して記述する必要があります。
                </p>
            </div>

            <!-- 3. 多分岐命令（elseif）と switch case 文の注意点 -->
            <div class="note-section">
                <h3 class="note-title">3. 多分岐命令（elseif）と switch case 文の注意点</h3>
                
                <div class="sub-heading"> elseif の半角スペースについて</div>
                <p>JavaScriptなどでは <code>else if</code> と必ず半角スペースを空けて記述しますが、PHPでは <strong>else if と elseif の両方が使用可能</strong>です。半角スペースを空けずにくっつけて書いても文法エラーにはなりません。</p>

                <div class="sub-heading"> switch case 文における比較精度</div>
                <p>PHPの switch case 文は、値の判定を <strong>緩やかな比較 ==</strong> （型を自動変換して比較）で行います。値もデータ型も完全に一致しているか調べる <strong>厳密な比較 ===</strong> を行いたい場合は、 switch文ではなく if 文で実装する必要があります。</p>

                <p><strong>💡 【重要】なぜこの仕様に注意が必要か？</strong></p>
                <p>PHPでは、Webフォームのユーザー入力値（テキストボックスの値など）を処理することが多くあります。ユーザーが半角数字（例： 10 ）だけを入力した場合でも、PHP側には**文字列（ "10" ）として渡される**ため、暗黙の型変換を考慮したプログラム設計が必要になります。</p>
            </div>
            <!-- 4. 配列・連想配列とループ処理 -->
            <div class="note-section">
                <h3 class="note-title">4. 配列・連想配列とループ処理</h3>
                <p>PHPにおいて、データの集合をループ処理する方法は、配列の種類（添字配列と連想配列）によって使い分けるか、もしくは共通の構文を利用します。</p>
                
                <div class="sub-heading"> 連想配列へのアクセス（foreach文）</div>
                <p>連想配列は添字配列（0から始まるインデックス）とは異なり、各要素に対して個別の「キー（文字列など）」を割り当てています。そのため、キーが分からないと目的のデータに直接アクセスできません。</p>
                <p><strong>foreach 文</strong>を使用すると、内部の格納順に従って<strong>キーを指定することなく全データへ順番にアクセス</strong>でき、さらに「キー」と「値」の両方を同時に受け取ることができます。</p>

                <div class="sub-heading"> 添字配列をループさせる2つの方法</div>
                <ul>
                    <li><strong>for文によるループ：</strong> 0から「配列の要素数」未満までカウントアップしてループさせます。要素数は <code>count(配列の変数)</code> で取得します。</li>
                    <li><strong>foreach文によるループ：</strong> 要素の最後まで自動的にループして終了します。PHP内部では添字配列も「数字のキーを持った連想配列」として同一に処理されているため、添字配列に対しても foreach を使用するのが効率的です。</li>
                </ul>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠ 【重要】for文の条件式における注意点（count関数の位置）</strong><br>
                    以下のように、for文の条件式の中に直接 <code>count()</code> を記述してはいけません。<br><br>
                    ❌ <strong>NGな例（パフォーマンスの低下）：</strong><br>
                    <code>for ($i = 0; $i &lt; count($array); $i++): endfor;</code><br>
                    ➔ ループのたびに毎回配列の要素数を数え直す無駄な処理が発生してしまいます。<br><br>
                    ⭕ <strong>OKな例（ベストプラクティス）：</strong><br>
                    <code>$count = count($array);<br>for ($i = 0; $i &lt; $count; $i++): endfor;</code><br>
                    ➔ 必ず<strong>ループの前に一度変数に取得</strong>しておき、その変数を条件式に使用します。
                </p>

                <div class="sub-heading"> foreach文の具体的な使い方（代替構文形式）</div>
                <p><strong>① 値（value）のみを受け取る場合</strong></p>
<pre><code>&lt;?php foreach ($配列変数 as $value): ?&gt;
    // ループごとに $value を使用した処理を記述
&lt;?php endforeach; ?&gt;</code></pre>

                <p><strong>② キー（key）と値（value）の両方を受け取る場合</strong></p>
<pre><code>&lt;?php foreach ($配列変数 as $key =&gt; $value): ?&gt;
    // ループごとに $key と $value の両方を使用可能
&lt;?php endforeach; ?&gt;</code></pre>
            </div>

            <!-- 🧠 復習ミニクイズ（全5問） -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. if文の代替構文（コロン構文）で、ブロックの終了を表す正しいキーワードはどれ？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 endif;</p>
                            <p style="margin-bottom: 0;">解説： 波括弧の代わりにコロン : を使用する代替構文では、if文の終了を endif; で明示します。文末のセミコロンを忘れないようにしましょう。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. 主要な制御命令（if, switch, while, for, foreach）の中で、唯一「代替構文」を使用できないものはどれ？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 do-while 文</p>
                            <p style="margin-bottom: 0;">解説： do-while 文にだけは end~; 形式の代替構文が用意されていません。これだけは通常の波括弧 { } を使用する必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. PHPの switch case 文において、値の一致判定は「==（緩やかな比較）」と「===（厳密な比較）」のどちらで行われる？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 == （緩やかな比較）</p>
                            <p style="margin-bottom: 0;">解説： 型を自動的に変換して比較する == で判定されます。Webの入力値である文字列の数字（"10"）と、プログラム内の数値（10）を同値として扱える利便性がある一方、厳密に判定したい場合は if 文への書き換えが必要です。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. for文を使って配列をループ処理する際、条件式の中に count($array) を直接書くのが望ましくない理由は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ループするたびに配列の要素数を数え直す処理が走り、パフォーマンスが低下するため。</p>
                            <p style="margin-bottom: 0;">解説： 配列の要素が変わらない場合、for文の前に $count = count($array); のように変数へ格納し、その変数をループの条件式に使用するのがベストプラクティスです。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. foreach文で連想配列をループさせ、各要素の「キー」と「値」をどちらも取得したい場合の正しい構文（asの後ろ）は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 as $key => $value</p>
                            <p style="margin-bottom: 0;">解説： foreach ($配列変数 as $key => $value) と記述することで、矢印（ => ）の左側に配列のキー、右側にその値がループごとに代入されます。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

        </main>

        <!-- 右側：共通更新履歴の呼び出し -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
