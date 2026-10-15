<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/16(水)の職業訓練授業ノートです。PHPのコメントルール、可変変数、乱数(rand/random_int)、文字列出力の違い、データ型とvar_dump、エラーの種類と厳格モード(strict_types)をまとめています。">
    <title>9/16(水)職業訓練授業：変数・乱数・データ型とエラーの深刻度 | ポートフォリオサイト</title>
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

            <h2>9/16(水)職業訓練授業</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">コメントルール・可変変数・乱数・データ型・エラーの深刻度と厳格モード</p>

            <!-- 1. コメントアウトのルール -->
            <div class="note-section">
                <h3 class="note-title">1. コメントアウトのルール</h3>
                <p>PHPファイル（ .php ）の中では、記述する場所（PHPブロックの内側か外側か）によって、コメントの書き方を明確に使い分ける必要があります。</p>

                <div class="sub-heading"> PHPブロック内（ &lt;?php ... ?&gt; の中 ）</div>
                <ul>
                    <li><code>//</code> ： 行末までの1行コメントとして機能します。</li>
                    <li><code>/* ... */</code> ： 複数行をまとめてコメントアウトする際に使用します。</li>
                </ul>

                <div class="sub-heading"> PHPブロック外（HTML領域）</div>
                <ul>
                    <li><code>&lt;!-- ... --&gt;</code> ： 通常のHTMLコメントを使用します。PHPのコメント記号は使えません。</li>
                </ul>
            </div>

            <!-- 2. 変数の基本と「可変変数」 -->
            <div class="note-section">
                <h3 class="note-title">2. 変数の基本と「可変変数」</h3>

                <div class="sub-heading"> 変数の基本ルール</div>
                <p>JavaScriptと違い、 let や const のような<strong>宣言キーワードは不要</strong>です。頭に <code>$</code> から始まる文字列を記述すれば、自動的に変数として認識されます。</p>
                <ul>
                    <li><strong>使える文字：</strong> 英大文字・小文字、数字、アンダースコア（ _ ）。</li>
                    <li>数字から始めることはできません（例： <code>$1num</code> はエラーになります）。</li>
                </ul>

                <div class="sub-heading"> 可変変数（$$）の仕組み</div>
                <p>変数名の指定にさらに変数の値を使用する、PHP独自の仕組みを<strong>可変変数</strong>と呼びます。</p>

                <pre><code>&lt;?php
$var = 1;
$var_name = "var";
echo $$var_name; // 出力結果: 1
?&gt;</code></pre>

                <p><strong>💡 可変変数の処理の流れ</strong></p>
                <p><code>$$var_name</code> は、内部的に「 <code>$</code> ＋ <code>$var_name</code> の中身 」として処理されます。 <code>$var_name</code> の中身は文字列の "var" なので、合体して <code>$var</code> という変数に変化します。結果として <code>$var</code> の値である 1 が画面に出力される仕組みです。</p>
            </div>

            <!-- 3. 乱数の取得（rand と mt_rand） -->
            <div class="note-section">
                <h3 class="note-title">3. 乱数の取得（rand と mt_rand）</h3>
                <p>どちらもランダムな整数（乱数）を取得するための関数です。</p>
                <ul>
                    <li><code>rand()</code> / <code>mt_rand()</code> ： 0 〜 サーバーの最大値（ getrandmax() で取得できる値）まで。</li>
                    <li><code>rand(1, 100)</code> / <code>mt_rand(1, 100)</code> ： 1 〜 100 の中からランダムに取得。</li>
                </ul>

                <div class="sub-heading"> どちらを使用すべきか？</div>
                <p>歴史的に旧来の <code>rand()</code> は精度が低く、古い教材では <code>mt_rand()</code> が推奨されていました。しかし、現在のPHP（7.1以降）では <code>rand()</code> の内部処理も自動的に <code>mt_rand()</code> と同じ高速・高精度な仕組みに置き換わっているため、現代のPHPではどちらを使っても結果やパフォーマンスは同じです。</p>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠ 実務向けの重要補足</strong><br>
                    これらの関数は「暗号学的に安全ではない」ため、パスワード自動生成や決済の抽選など、セキュリティが絡む処理には絶対に使用できません。安全な乱数が必要な場合は <strong>random_int()</strong> を使用します。
                </p>
            </div>

            <!-- 4. 文字列の出力と改行 -->
            <div class="note-section">
                <h3 class="note-title">4. 文字列の出力と改行（echo / PHP_EOL）</h3>

                <div class="sub-heading"> カンマ（ , ）と ドット（ . ）の違い</div>
                <ul>
                    <li><strong>ドット（ . ）：</strong> PHP의 標準的な文字列連結演算子です。場所を選ばずどこでも使用できます。</li>
                    <li><strong>カンマ（ , ）：</strong> echo 文の引数区切りとしてだけ使える特殊な記述方法です。文字列を結合するのではなく「並べて順番に出力する」処理になるため、ドット連結よりも僅かに処理速度が早いと言われています。</li>
                </ul>

                <div class="sub-heading"> PHP_EOL と改行の仕組み</div>
                <p><code>PHP_EOL</code> は、実行しているサーバーのOS環境（WindowsやLinuxなど）に合わせた「正しい改行コード」を自動で出力してくれる定義済みの定数です。</p>

                <p><strong>💡 なぜブラウザの画面で改行されないのか？</strong></p>
                <p>ブラウザはHTMLとして画面を描画するため、ソースコード上の改行（ <code>PHP_EOL</code> ）はただの半角スペース扱いになってしまいます。ブラウザの画面上で改行させたい場合は HTMLの <code>&lt;br&gt;</code> タグを出力する必要があります。（ブラウザの「ページのソースを表示」に切り替えると、しっかりと改行されているのが確認できます）</p>
            </div>

            <!-- 5. データ型とデバッグ -->
            <div class="note-section">
                <h3 class="note-title">5. データ型とデバッグ（var_dump）</h3>
                <p>変数のデータ型（データの種類）や中身の値を詳しく調べるには <strong>var_dump()</strong> 関数を使用します。</p>

                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px; text-align: left;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; width: 25%;">型の名前</th>
                            <th style="padding: 10px; width: 25%;">画面上の表示例</th>
                            <th style="padding: 10px;">概要</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px; font-weight: bold;">整数型</td>
                            <td style="padding: 10px;">int(1)</td>
                            <td style="padding: 10px;">小数点のない数字</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px; font-weight: bold;">浮動小数点型</td>
                            <td style="padding: 10px;">float(1.5)</td>
                            <td style="padding: 10px;">小数点のある数字（古い環境では double と表示）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px; font-weight: bold;">文字列型</td>
                            <td style="padding: 10px;">string(5) "Hello"</td>
                            <td style="padding: 10px;">文字テキスト。括弧内にはバイト数（文字数）が示されます</td>
                        </tr>
                    </tbody>
                </table>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠ 使用上の注意点</strong><br>
                    JavaScriptの console.log() とは異なり、PHPの var_dump() は**ブラウザの画面そのものに直接データ内容を出力**してしまいます。開発中のデバッグ・確認が終わったら、本番環境に残らないよう必ず削除するかコメントアウトしましょう。
                </p>
            </div>

            <!-- 6. PHPのエラーの種類 -->
            <div class="note-section">
                <h3 class="note-title">6. PHPのエラーの種類</h3>
                <p>PHPのエラーにはいくつかのレベル（深刻度）があり、それによってプログラムの挙動が異なります。</p>

                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px; text-align: left;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; width: 25%;">エラー定数</th>
                            <th style="padding: 10px; width: 20%;">深刻度</th>
                            <th style="padding: 10px;">挙動と主な原因</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>E_PARSE</strong></td>
                            <td style="padding: 10px; color: #ef4444; font-weight: bold;">❌ 最悪（実行前）</td>
                            <td style="padding: 10px;"><strong>プログラムが動く前に停止します。</strong><br>セミコロン（ ; ）の忘れ、カッコの閉じ忘れ、タイポなど。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>E_ERROR</strong></td>
                            <td style="padding: 10px; color: #ef4444; font-weight: bold;">❌ 致命的（実行中）</td>
                            <td style="padding: 10px;"><strong>処理の途中で完全にストップします（Fatal Error）。</strong><br>存在しない関数を呼び出した時など。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>E_WARNING</strong></td>
                            <td style="padding: 10px; color: #ff8c00; font-weight: bold;">⚠ 中</td>
                            <td style="padding: 10px;"><strong>処理は止まらず、次の行以降も継続します。</strong><br>外部ファイルの読み込みに失敗した時など。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>E_NOTICE</strong></td>
                            <td style="padding: 10px; color: #64748b;">ℹ 低</td>
                            <td style="padding: 10px;"><strong>処理は止まらず継続します。</strong><br>定義していない変数をいきなり使おうとした時など。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>E_DEPRECATED</strong></td>
                            <td style="padding: 10px; color: #64748b;">⏳ 今後危ない</td>
                            <td style="padding: 10px;"><strong>処理は止まりません。</strong><br>将来のバージョンで廃止される予定の古い機能を使ったときの警告。</td>
                        </tr>
                    </tbody>
                </table>
                <p>※PHP 8以降では、引数の数や型が違うと致命的なエラー（TypeError）で止まるように厳格化されました。</p>

                <div class="sub-heading"> 【深掘り補足】厳格モード（strict_types）とは？</div>
                <p>PHPはもともと型に寛容（ルーズ）な言語です。例えば、整数（ int ）を受け取る関数に文字列の "5" を渡しても、自動変換して動かしてしまいます。しかし、これは思わぬバグを見落とす原因になります。</p>
                <p>ファイルの先頭に <code>declare(strict_types=1);</code> と書くと、<strong>「型を厳格にチェックするモード」</strong> に切り替わり、型が違う場合に TypeError （Fatalエラー）を発生させてその場で処理を止めてくれるようになります。</p>
            </div>

            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. PHPブロックの外側（HTML領域）でコメントアウトをしたい場合、どの記号を使うべき？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 &lt;!-- コメント --&gt; (HTMLのコメントアウト)</p>
                            <p style="margin-bottom: 0;">解説：PHPブロック（ &lt;?php ... ?&gt; ）の外側はただのHTML領域として扱われるため、PHPのコメント記号（ // や /* */ ）は使えず、HTMLのコメント記号を使う必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. PHPで「安全な乱数」を生成し、パスワードやトークン発行に使いたい時に使用する正しい関数は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 random_int()</p>
                            <p style="margin-bottom: 0;">解説： rand() や mt_rand() は暗号学的に安全ではないため、実務でセキュリティが絡む抽選やパスワード生成には使用してはいけません。</p>
                        </div>
                    </details>
                </div>
                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. echo PHP_EOL; を実行した際、ブラウザの画面上では改行されませんでした。その理由は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ブラウザはHTMLとして描画するため、ソース上の改行（PHP_EOL）をスペースとして扱うから。</p>
                            <p style="margin-bottom: 0;">解説：ブラウザの画面上で改行させたい場合は、HTMLタグである &lt;br&gt; を出力する必要があります。 PHP_EOL は「ページのソース表示」をした時のソースコードを改行させるためのものです。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. セミコロン（ ; ）の付け忘れやカッコの閉じ忘れで発生する、プログラム実行前に停止してしまう最も致命的なエラーの種類（エラー定数）は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 E_PARSE （構文エラー / パースエラー）</p>
                            <p style="margin-bottom: 0;">解説：文法ミスがある場合、PHPはプログラムを1行も実行（起動）せずにその時点で停止します。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. ファイルの先頭に declare(strict_types=1); を記述する最大のメリットは？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 「データの型」が違った時にWarningでスルーさせず、Fatalエラー（TypeError）にしてその場で処理を止めることで、思わぬバグを早期発見できる。</p>
                            <p style="margin-bottom: 0;">解説：PHPの自動的な型変換（ルーズさ）を無効化し、開発者が想定外のデータ混入にすぐ気づける安全なコードが書けるようになります。</p>
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