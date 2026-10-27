<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/29(火)の職業訓練授業ノートです。スーパーグローバル変数（$_GET/$_POST）、複数データの配列受け取り、$_FILESによるファイルアップロード、issetによる存在チェック、htmlspecialcharsによるXSS対策をまとめています。">
    <title>9/29(火)職業訓練授業：スーパーグローバル変数とセキュリティ対策 | ポートフォリオサイト</title>
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

    <!-- メメインレイアウト -->
    <div class="container">
        <main class="main-content">

            <h1>9/29(火)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">スーパーグローバル変数（フォームデータの送受信・ファイルアップロード・セキュリティ）</p>

            <!-- 1. スーパーグローバル変数とHTMLフォームのメソッド属性 -->
            <div class="note-section">
                <h3 class="note-title">1. スーパーグローバル変数とHTMLフォームのメソッド属性</h3>
                <p>PHPでは、HTMLの <code>&lt;form&gt;</code> タグの <code>method</code> 属性（送信方法）に応じて、自動的にデータを取得するための特別な変数が用意されています。これを<b>スーパーグローバル変数</b>と呼びます。</p>

                <div class="sub-heading">1-1. GET送信（URLでデータを送る方法）</div>
                <p>GETで入力データを送信すると、URLの後ろに <code>?名前=値&amp;名前=値</code> という形式（クエリストリング / URLパラメータ）で、HTMLの <code>name</code> 属性と入力値が追加されて送信されます。</p>
                <ul>
                    <li><strong>特徴：</strong> 送信データがURLとしてユーザーに丸見えになります。</li>
                    <li><strong>注意点：</strong> パスワードやクレジットカード番号などの個人情報に関わるものは<b>絶対にGET送信してはいけません</b>。</li>
                    <li><strong>制限：</strong> 送信できる文字数はブラウザやサーバーによって上限が異なるため、検索窓のキーワードなど、あまり多くの項目にならないシンプルな処理に使用します。</li>
                </ul>

                <div class="sub-heading">1-2. POST送信（通信の本体でデータを送る方法）</div>
                <p>POSTの場合、データはURLではなく、通信の内部データ（HTTPリクエストボディ）に含まれて送信されます（IPアドレスやMACアドレスといった内部情報と同様の通信形式）。</p>
                <ul>
                    <li><strong>特徴：</strong> 画面上（URL）にはデータが見えません。さらに <code>https://〜</code> で通信を暗号化（SSL/TLS化）することで、経路上の盗聴を確実に防ぐことができます。</li>
                    <li><strong>メリット：</strong> 送信できる文字数に実質制限はなく、画像やPDFなどのファイル送信（アップロード）も可能です。</li>
                </ul>
            </div>

            <!-- 2. PHPでのデータ受け取りと連想配列 -->
            <div class="note-section">
                <h3 class="note-title">2. PHPでのデータ受け取りと連想配列</h3>
                <p>HTMLフォームから送信されたデータは、PHP側でそれぞれの送信メソッドに対応した連想配列の中に自動的に格納されます。</p>

                <div class="sub-heading">2-1. $_GET［'name属性値'］（P117）</div>
                <p>HTMLの <code>method="get"</code> で送られたデータが格納されます。HTML側で指定した <code>name</code> 属性の文字列が、そのまま連想配列の「キー（Key）」になります。</p>

                <div class="sub-heading">2-2. $_POST［'name属性値'］（P177）</div>
                <p>HTMLの <code>method="post"</code> で送られたデータが格納されます。 <code>$_GET</code> と同様に、 <code>name</code> 属性値をキーとした連想配列としてデータを受け取ります。</p>

                <div class="sub-heading">📐 重要：チェックボックスなどの複数データの受け取り（二次元配列）</div>
                <p>主に入力フォームのチェックボックス（複数の値を選択できる項目）などで同じ <code>name</code> 属性のデータをまとめて受け取りたい場合、HTML側の <code>name</code> 属性の末尾に必ず <code>[]</code> （角括弧）を付与します。</p>
                <p>例： <code>&lt;input type="checkbox" name="hobby[]" value="music"&gt;</code></p>
                <p>PHP側では <code>$_POST['hobby']</code> の中に、 0 から順に自動的に添字（数字のキー）が割り当てられた配列が格納され、結果として<b>二次元配列</b>の構造になります。</p>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fef2f2; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠️ 注意：</strong> もしHTML側で <code>[]</code> を付けずに、複数のチェックボックスに全く同じ <code>name</code> 属性名を指定してしまうと、後から処理された値によって前の値が上書きされてしまい、PHP側では最後に選択された1件しか受け取ることができなくなります。
                </p>

                <div class="sub-heading">📂 チェックボックス受け取り時の連想配列の視覚イメージ</div>
                <dl class="board-dl">
                    <dt>$_POST['hobby'][0]</dt>
                    <dd>'music'</dd>
                    <dt>$_POST['hobby'][1]</dt>
                    <dd>'sports'</dd>
                </dl>

                <div class="sub-heading">2-3. 初心者が陥りやすいポスト・ゲットの記述ミス</div>
                <p>入力フォームが存在しない通常のHTMLリンクをクリックしてサーバーへ要求を出す行為（ページ遷移など）は、すべて内部的に <strong>GET送信</strong>として扱われています。</p>
                <p>HTMLの <code>&lt;form method="post"&gt;</code> と正しく指定しているつもりでも、PHP側でなぜかGETでデータが届いてしまう（またはデータが空になる）というミスが起こることがあります。この原因のほとんどはPHP側のプログラムではなく、 <strong>HTML側（データ送信側）の記述ミス</strong>です。タグの閉じ忘れや綴りミスによってブラウザが <code>&lt;form&gt;</code> タグを正しく認識できず、デフォルトの送信方法であるGET送信にフォールバックしてしまっているため、HTMLコードを最優先で確認する必要があります。</p>
            </div>

            <!-- 3. ファイル送信がある時の受け取り（$_FILES） -->
            <div class="note-section">
                <h3 class="note-title">3. ファイル送信がある時の受け取り（$_FILES）</h3>
                <p>画像やPDFなどのファイルをフォームから送信（アップロード）する場合、HTML側とPHP側で特別な処理が行われます。アップロードされたファイルは、まずサーバー側の<strong>テンポラリフォルダ（一時保存領域）</strong> に一時的な名前で保存されます。</p>
                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-bottom: 15px;">
                    <strong>💡 HTML側の必須ルール：</strong> ファイル送信を行う場合は、HTMLの <code>&lt;form&gt;</code> タグに必ず <code>method="post"</code> と <code>enctype="multipart/form-data"</code> の2つを指定する必要があります。これが無いとファイルデータがサーバーに送信されません。
                </p>
                <pre><code>&lt;!-- upload.html （送信側のHTML） --&gt;
&lt;form action="upload.php" method="post" enctype="multipart/form-data"&gt; //<-決まり文句として覚る
    
    &lt;label for="user-file"&gt;アップロードするファイルを選択：&lt;/label&gt;
    &lt;!-- type="file" でファイル選択ボタンを表示。name属性がPHP側のキーになります --&gt;
    &lt;input type="file" name="upload_image" id="user-file"&gt;
    
    &lt;button type="submit"&gt;サーバーへ送信&lt;/button&gt;
&lt;/form&gt;</code></pre>

                <div class="sub-heading">3-1. PHPで受け取れるファイル情報</div>
                <p>アップロードされたファイルの各種情報は、スーパーグローバル変数である二次元配列 <code>$_FILES['name属性値']</code> から取得できます。</p>
                <dl class="board-dl">
                    <dt>$_FILES['inputのname']['tmp_name']</dt>
                    <dd>一時保存されたファイルへアクセスするための、サーバー上のパス（保存場所）</dd>
                    <dt>$_FILES['inputのname']['name']</dt>
                    <dd>ユーザーのPC上での元のファイル名（フォルダ名・ファイル名）</dd>
                    <dt>$_FILES['inputのname']['size']</dt>
                    <dd>ファイルサイズ（ <strong>バイト単位</strong>）</dd>
                    <dt>$_FILES['inputのname']['type']</dt>
                    <dd>ファイルのMIME（マイム）タイプ（例： image/jpeg など）</dd>
                    <dt>$_FILES['inputのname']['error']</dt>
                    <dd>アップロードに関するエラーコード（整数）</dd>
                </dl>

                <div class="sub-heading">3-2. エラーコードの意味一覧</div>
                <p><code>$_FILES['inputのname']['error']</code> に格納される数値によって、アップロードが成功したか、どのようなトラブルが起きたかを判定できます。</p>
                <ul>
                    <li><strong>コード 0 （UPLOAD_ERR_OK）：</strong> 正常終了（アップロード成功）</li>
                    <li><strong>コード 1 / 2：</strong> サイズオーバー（1はphp.iniの設定、2はHTML側で指定した最大サイズを超えた場合）</li>
                    <li><strong>コード 3 / 4：</strong> 通信障害等により全データを受信しなかった（3は一部のみ受信、4はファイルが未選択・送信されなかった）</li>
                    <li><strong>コード 6 / 7 / 8：</strong> サーバー側のトラブル（6は一時フォルダがない、7はディスク書き込み失敗、8は拡張機能による停止）</li>
                </ul>
            </div>

            <!-- 4. データの存在チェックと文字列長の確認 -->
            <div class="note-section">
                <h3 class="note-title">4. データの存在チェックと文字列長の確認</h3>
                <p>ユーザーから送信されたデータを処理する前に、安全のために「データが本当に存在するか」「空文字（文字数が0）ではないか」をチェックします。</p>

                <pre><code>// 教科書 P174 6.2 記述例
if (isset($_GET['name']) &amp;&amp; strlen($_GET['name']) &gt; 0):
    // データが存在し、かつ1文字以上入力されている場合の処理
endif;</code></pre>

                <div class="sub-heading">4-1. 各関数の仕組みと論理演算子の挙動</div>
                <ul>
                    <li><code>isset($_GET['name'])</code> ： <code>$_GET['name']</code> というキー（データ）が存在しているかどうかを判定します。存在していれば true、存在していなければ（URLパラメータに指定がない、または値がNULLの場合） false を返します。</li>
                    <li><code>strlen($_GET['name']) &gt; 0</code> ： <code>$_GET['name']</code> に格納された文字列の長さ（バイト数）が0より大きいかを判定します。1文字以上あれば true、空文字（0文字）であれば false となります。</li>
                    <li><code>&amp;&amp;</code> （論理積 / かつ）：左右の条件が<strong>両方とも true のときだけ全体が true</strong> になります。</li>
                </ul>

                <div class="sub-heading">📐 JavaScriptとの違い（試験対策の補足）</div>
                <p>JavaScriptでは、存在しない配列のキーにアクセスしようとすると undefined が返るだけでエラーにはなりませんが、PHPでは存在しないキー（例：パラメータにnameがない状態）に対して直接 <code>strlen($_GET['name'])</code> を実行すると、未定義エラー（WarningやNotice）が発生してしまいます。</p>
                <p>そのため、PHPでは必ず<strong>「まず isset() で存在を確認してから、後ろの処理を行う」</strong> という順番が鉄則です（&amp;&amp;の左側がfalseなら、右側の判定はスキップされるショートサーキットの性質を利用しています）。</p>
            </div>

            <!-- 5. セキュリティ対策（htmlspecialchars） -->
            <div class="note-section">
                <h3 class="note-title">5. セキュリティ対策（htmlspecialchars）</h3>
                <p>悪意を持ったユーザーが、入力フォームにJavaScriptなどのプログラム（スクリプト）を入力して送信し、サーバー側や他のユーザーのブラウザに対して攻撃を仕掛けてくるのを防ぐための極めて重要なセキュリティ対策です。この攻撃手法をクロスサイトスクリプティング（XSS）と呼びます。</p>
                <p><strong>【重要な手法】サニタイズ（無害化）</strong><br>特殊な意味を持つ記号（ <code>"</code> , <code>'</code> , <code>&lt;</code> , <code>&gt;</code> , <code>&amp;</code> ）を、HTML上にそのまま出力するとプログラムとして実行されてしまいます。これを防ぐために、ブラウザでただの文字として表示される安全な特殊文字列（ <code>&amp;quot;</code> , <code>&amp;#039;;</code> , <code>&amp;lt;</code> , <code>&amp;gt;</code> , <code>&amp;amp;</code> ）へと変換（エスケープ）します。</p>
                <p><strong>実行のタイミング：</strong> ユーザーの入力文字をブラウザに表示する（echo等で出力する）直前に必ずこの変換を行います。</p>

                <div class="sub-heading">5-1. htmlspecialchars() 関数の引数と設定</div>
                <p>関数を実行する際は、3つの引数を指定して細かく挙動を制御できます。</p>
                <pre><code>htmlspecialchars(第1引数, 第2引数, 第3引数);</code></pre>
                <ul>
                    <li><strong>第1引数（変換対象）：</strong> 変換する文字列が格納された変数を指定します。</li>
                    <li><strong>第2引数（変換フラグ）：</strong> シングルクォーテーションをどのように扱うかを指定します。
                        <ul>
                            <li><code>ENT_QUOTES</code> ：シングルクォーテーションとダブルクォーテーションの<strong>両方を変換する</strong>（実務での推奨値）。</li>
                            <li><code>ENT_COMPAT</code> ：ダブルクォーテーションのみを変換し、シングルクォーテーションは除外して残りの4種を変換する。</li>
                        </ul>
                    </li>
                    <li><strong>第3引数（文字コード）：</strong> 対象の文字列がどの文字コードで書かれているかを指定します。現在のWeb開発では通常 <code>'UTF-8'</code> を指定します。</li>
                </ul>

                <pre><code>// 安全な出力の基本形（実務の定番パターン）
$clean_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
echo $clean_name;</code></pre>
            </div>

            <!-- クイズエリア -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <div class="quiz-box">
                    <p class="quiz-question">Q1. パスワードや個人情報、クレジットカード番号などを送信する際、GETメソッドではなくPOSTメソッドを使用しなければならない理由は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 GETメソッドは送信データがURLの後ろに丸見えの形で追加されてしまうが、POSTメソッドは通信の内部データとして送られるため画面上に見えなくなるから。</p>
                            <p style="margin-bottom: 0;">解説： さらにPOST送信を https://〜 で暗号化（SSL/TLS化）することにより、通信経路上での盗聴を確実に防ぐことができます。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q2. HTMLのフォームで、同じ name 属性（例：hobby）を持つ複数のチェックボックスの値を上書きせずに配列として受け取るには、HTML側でどのように記述する必要がありますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 name属性値の末尾に「[]（角括弧）」を付けて「name="hobby[]"」のように記述する。</p>
                            <p style="margin-bottom: 0;">解説： 末尾に [] を付けると、PHP側で自動的に0番から順にキーが割り当てられ、多次元（二次元）配列としてすべての選択データを受け取ることができます。これを付けないと最後に選んだ1件しか届きません。</p>
                        </div>
                    </details>
                </div>
                <div class="quiz-box">
                    <p class="quiz-question">Q3. ファイル送信（アップロード）を行うフォームを記述する際、HTMLの &lt;form&gt; タグに設定しなければならない2つの必須属性は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 method="post" と enctype="multipart/form-data"</p>
                            <p style="margin-bottom: 0;">解説： ファイルアップロード時は膨大なデータを細切れにして送る必要があるため、暗黙のルールとして必ず method="post" とマルチパートデータ用の enctype 指定が必要になります。GETやenctype無しではファイルは届きません。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q4. PHPで存在しない配列のキー（例：$_GET['age']が無い状態）に対して、いきなり strlen() などの関数を実行しようとするとどうなりますか？また、それを防ぐために事前に使う関数は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 未定義エラー（WarningやNotice）が発生する。これを防ぐために、事前に isset() 関数を使ってデータの存在確認を行います。</p>
                            <p style="margin-bottom: 0;">解説： JavaScriptと違い、PHPは存在しないキーへのアクセスに厳格です。そのため、 if (isset($_GET['age']) &amp;&amp; strlen($_GET['age']) &gt; 0) のように、まず存在を確認してから長さを測る順番を徹底します。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q5. htmlspecialchars() の第2引数に「ENT_QUOTES」を指定すると、どのような挙動になりますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ダブルクォーテーションだけでなく、シングルクォーテーションも含めて両方の記号を安全な文字列にエスケープ（変換）する。</p>
                            <p style="margin-bottom: 0;">解説： ENT_COMPAT ではシングルクォーテーションが変換されずに残ってしまいます。セキュリティをより強固にするため、実務や現在の開発では ENT_QUOTES を指定するのが鉄則となっています。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->
            <p style="margin-top: 25px;">
                <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>
        </main>
    </div> <!-- .container 終了 -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>