<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="10/09(木)の職業訓練授業ノートです。MySQLiを用いたデータベース接続、REQUEST_METHODによるPOST/GET送信の分岐、プリペアドステートメントによるSQLインジェクション対策を解説しています。">
    <title>10/09(木)職業訓練授業：MySQLi接続とプリペアドステートメント（書き込み編） | ポートフォリオサイト</title>
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

            <h1>10/09(木)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">MySQLiデータベース接続の基本、POST/GET送信の処理切り替え、プリペアドステートメントによる安全なデータ挿入（INSERT）</p>

            <!-- 1. MySQLiによるデータベース接続の基本手順 -->
            <div class="note-section">
                <h3 class="note-title">1. MySQLiによるデータベース接続手順</h3>
                <p>PHPからMySQLデータベースへアクセスし、データの追加や取得を行うためには、まずサーバーとデータベースに対して「接続（コネクション）」を確立する必要があります。授業では <code>mysqli</code> 関数を用いた伝統的な接続手法を学びました。</p>

                <div class="sub-heading">1-1. mysqli_connect() 関数によるホスト接続</div>
                <p>データベースサーバーへの接続を開始する関数です。接続に失敗した場合は <code>false</code> が返されます。</p>
                <pre><code>$link = mysqli_connect("localhost", "root", "");</code></pre>
                <p>引数の内容は以下の通りです：</p>
                <ul>
                    <li><strong>第1引数（"localhost"）：</strong> 接続するデータベースのホスト名。ローカル環境（XAMPP）では自身のPCを指すlocalhostを指定します。</li>
                    <li><strong>第2引数（"root"）：</strong> データベースのユーザー名。XAMPPの初期設定では管理者権限を持つ「root」が用意されています。</li>
                    <li><strong>第3引数（""）：</strong> 指定したユーザーのパスワード。XAMPPのデフォルト状態ではrootのパスワードは設定されていないため、空の文字列を指定します。</li>
                </ul>

                <div class="sub-heading">💡 接続エラー時の内部挙動とセキュリティ</div>
                <p>データベースサーバー側が混雑（ビジー状態）していて応答がない場合、関数は <code>false</code> を返します。一方、ユーザー名やパスワードに誤りがある場合は「不正アクセスの疑い」と判定され、システムの安全のため処理が強制終了される仕組みになっています。</p>
                <p>接続が成功すると、変数 <code>$link</code> には「現在正常に接続中であること」をphp内部で保証する情報が格納され、これ以降のすべてのデータベース操作命令において「この $link を使用して処理を行う」という指定をしながら進めることになります。</p>
            <!-- 2. データベースの選択と文字コード設定 -->
            <div class="note-section">
                <h3 class="note-title">2. データベースの選択と文字コード設定</h3>
                
                <div class="sub-heading">2-1. mysqli_select_db() による使用DBの指定</div>
                <p>ホスト（localhost）の中に作成されている複数のデータベースの中から、今回のプログラムで使用する対象を1つに絞り込みます。</p>
                <pre><code>mysqli_select_db(\$link, "oneline_bbs");</code></pre>
                <p>第1引数に接続情報（<code>\$link</code>）、第2引数に使用したいデータベース名（今回は <code>"oneline_bbs"</code>）を指定します。</p>

                <div class="sub-heading">2-2. mysqli_set_charset() による文字コードの同期</div>
                <p>データベースに対して文字を書き込んだり読み込んだりする際に使用する、通信用の文字コードを指定します。</p>
                <pre><code>mysqli_set_charset(\$link, "utf8");</code></pre>
                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 10px;">
                    <strong>💡 文字化けを防ぐ鉄則：</strong> 「PHPファイル自身の保存コード」「MySQLデータベース側の文字コード（照合順序）」そして「この関数での指定」の<b>3箇所の文字コードをすべて完全に一致させる</b>必要があります。これがズレるとブラウザ上で文字化けが発生します。
                </p>
            </div>

            <!-- 3. REQUEST_METHOD による処理の分岐 -->
            <div class="note-section">
                <h3 class="note-title">3. REQUEST_METHOD による処理の分岐</h3>
                <p>プログラムの冒頭で、ユーザーがどのような方法でこのページにアクセスしてきたかを判別し、処理を切り替えます。</p>
                <pre><code>if (\$_SERVER["REQUEST_METHOD"] === "POST") {
    // ユーザーが入力を終えて送信してきた時（書き込み処理を実行）
} else {
    // 通常のリンククリックやURL直接入力によるアクセスの時（表示処理のみ）
}</code></pre>
                <ul>
                    <li><code>\$_SERVER["REQUEST_METHOD"]</code> を調べることで、フォーム経由の <code>"POST"</code> 送信か、通常のアクセスである <code>"GET"</code> 送信かを文字列で取得できます。</li>
                    <li>このif文を設置することで、「フォーム送信ボタンが押された時だけ安全に書き込みを行う」という正確な処理の住み分けが可能になります。</li>
                </ul>
            </div>

            <!-- 4. プリペアドステートメントによるSQLインジェクション対策（手順1〜2） -->
            <div class="note-section">
                <h3 class="note-title">4. プリペアドステートメントによるSQLインジェクション対策</h3>
                <p>不特定多数のユーザーが入力するフォームでは、入力欄に悪意あるSQL文を混ぜて送信し、データベースを不正操作しようとする恐ろしい攻撃（<b>SQLインジェクション</b>）への対策が絶対に不可欠です。安全にデータを挿入するため、授業では「プリペアドステートメント」という確実な防御手法の手順を学びました。</p>

                <div class="sub-heading">手順1：SQL文の骨組み（テンプレート）を用意する</div>
                <p>あらかじめ、値が入る部分をすべて「<code>?</code>（プレースホルダ）」に置き換えたSQLの型を作成し、サーバー側に送信して解析させておきます。</p>
                <pre><code>\(sql = mysqli_prepare(\)link, 'INSERT INTO `post` (`name`,`comment`,`created_at`) VALUES (?,?,?)');</code></pre>
                <p><code>mysqli_prepare()</code> を実行することで、安全な実行命令が準備されます。<code>?</code> の部分には、後から安全に変数の値を結びつけます。</p>

                <div class="sub-heading">手順2：プレースホルダ（?）に変数を結びつける（バインド）</div>
                <p>先ほど用意した「<code>?</code>」に対して、ユーザーの入力値が入った変数を安全に紐付け（バインド）します。</p>
                <pre><code>mysqli_stmt_bind_param(\(sql, 'sss',\)name, \(comment,\)date);</code></pre>
                <p>引数の指定ルールは以下の通りです：</p>
                <ul>
                    <li><strong>第1引数：</strong> <code>mysqli_prepare</code> を代入した変数（<code>\$sql</code>）を指定します。</li>
                    <li><strong>第2引数（'sss'）：</strong> <code>?</code> に入るデータの型を順番に指定します。今回は3つとも「文字列（string）」を挿入するため、sを3つ並べて <code>'sss'</code> と記述します。（※数値の場合は <code>i</code> を指定します）</li>
                    <li><strong>第3引数以降：</strong> 挿入したい変数を、SQLのカラムの並び順通りにコンマ区切りで指定します。<b>（※この関数では、直接値ではなく必ず『変数』で指定しなければならないルールがあります）</b></li>
                </ul>
            </div>
            <!-- 5. プリペアドステートメントの実行と切断（手順3〜4） -->
            <div class="note-section">
                <h3 class="note-title">5. プリペアドステートメントの実行と切断</h3>
                
                <div class="sub-heading">手順3：紐付けたSQL文を実行する</div>
                <p>手順2で値を安全にバインドした状態のSQL文を、データベースに対して実行（挿入）します。</p>
                <pre><code>mysqli_stmt_execute(\$sql);</code></pre>
                <p>この命令を実行した瞬間に、MySQLのテーブルへデータが1件新規登録（INSERT）されます。</p>

                <div class="sub-heading">手順4：ステートメントを終了して閉じる</div>
                <p>プリペアドステートメントは、1つのプログラム中で同時に複数実行することができないルールになっています。次の処理に影響を与えないよう、実行後は速やかにクローズします。</p>
                <pre><code>mysqli_stmt_close(\$sql);</code></pre>

                <div class="sub-heading">5-1. mysqli_close() によるデータベースの即時切断</div>
                <p>データベースの処理がすべて終了したら、待機している他のプログラム（他のユーザーからのアクセス）に処理権を譲るため、接続を速やかに切断します。</p>
                <pre><code>mysqli_close(\$link);</code></pre>
                <p>PHPの実行終了時に自動切断もされますが、ソースコード上で明示的に切断命令を書いておくことで、サイト混雑時のパフォーマンスが大幅に向上します。</p>
            </div>

            <!-- 6. 二重投稿防止（リダイレクト処理） -->
            <div class="note-section">
                <h3 class="note-title">6. 二重投稿防止（リダイレクト処理）とexit()の重要性</h3>
                <p>データを挿入した後、そのまま画面を表示してしまうと、ユーザーがブラウザの「再読み込み（F5キー）」を押した際、全く同じ内容がもう一度送信されて二重投稿になってしまいます。これを防ぐための鉄則を学びました。</p>

                <div class="sub-heading">6-1. header("Location: ...") によるページ移動</div>
                <pre><code>header("Location: http://" . \$_SERVER['HTTP_HOST'] . \$_SERVER['REQUEST_URI']);
exit();</code></pre>
                <ul>
                    <li>データ挿入直後に <code>header()</code> 命令を使い、自分自身のページへ「移動（リダイレクト）」させます。</li>
                    <li>リダイレクトによるアクセスは強制的に <b>GET送信</b> になるため、ページが再読み込みされても <code>if(\$_SERVER["REQUEST_METHOD"] === "POST")</code> の判定を通過せず、二重にデータが書き込まれるのを確実に防止できます。</li>
                    <li><strong>exit() の重要性：</strong> <code>header()</code> による移動命令を出した後も、内部的にはそれ以降のコードを先読みして実行しようと待機しています。無駄な処理やエラーを防ぐため、移動直後は必ず <code>exit()</code>（または <code>die()</code>）を記述してプログラムを強制終了させるのが実務の絶対ルールです。</li>
                </ul>
            </div>

            <!-- クイズエリア -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <div class="quiz-box">
                    <p class="quiz-question">Q1. フォーム送信時以外の通常のリンククリックや、URLの直接入力によるページアクセスは、内部的に何送信（METHOD）として扱われますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 GET送信</p>
                            <p style="margin-bottom: 0;">解説： <code>&lt;form method="post"&gt;</code> を経由しないアクセスは、ブラウザの仕様上すべてGET送信になります。そのため、プログラム側でPOSTかGETかを判別して処理を分けることができます。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q2. プリペアドステートメント（mysqli_prepare）を使ってSQL文を組み立てる際、値が入る部分にあらかじめ記述しておく「?」の記号のことを何と呼びますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 プレースホルダ（または置き換え文字）</p>
                            <p style="margin-bottom: 0;">解説： あらかじめ「?」にした骨組みをデータベース側に解析させておくことで、後から悪意あるプログラムコードが送られてきても「ただの文字列」として安全に処理（SQLインジェクション対策）ができます。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q3. header("Location: ...") でページを移動させた直後に、必ず exit(); を記述しなければならないのはなぜですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 移動命令を出した後もプログラムが先のコードを読み込んで実行しようとしてしまうため、それを確実に強制終了させる必要があるから。</p>
                            <p style="margin-bottom: 0;">解説： exit() を忘れると、移動したはずの裏側で無駄な処理が走り続け、予期せぬエラーやセキュリティ上の脆弱性を生む原因になります。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

            <p style="margin-top: 25px;">
                <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>

        </main>
    </div> <!-- .container 終了 -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
