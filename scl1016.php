<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="10/16(木)の職業訓練授業ノートです。PDO接続時の各属性設定（dbname、host、port）の詳細、静的接続（静的プレースホルダ）による高度なSQLインジェクション対策について解説しています。">
    <title>10/16(木)職業訓練授業：PDO拡張機能の導入とtry-catch例外処理・静的接続のセキュリティ | ポートフォリオサイト</title>
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

            <h1>10/16(木)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">PDOによるデータベース接続仕様、MAMP/XAMPPのポート番号、静的接続と動的接続のセキュリティ差異（参考書P442）</p>

            <!-- 1. DSN（接続文字列）とポート番号の仕様 -->
            <div class="note-section">
                <h3 class="note-title">1. DSN（接続文字列）とポート番号の仕様</h3>
                <p>PDOでデータベースへ接続する際は、サーバーの場所や文字コードの情報を1つの文字列にまとめた <b>DSN（データソース名）</b> を用意します。</p>

                <div class="sub-heading">1-1. DSNに含まれる各パラメータの意味</div>
                <ul>
                    <li><strong>dbname：</strong> 接続対象となるデータベース名（今回は <code>oneline_bbs</code>）を指定します。</li>
                    <li><strong>host：</strong> 接続するサーバーの場所（ホスト名。ローカル環境なら <code>localhost</code>）を指定します。※URLではないため <code>http://</code> などの記述は含めません。レンタルサーバー運用の際は、管理画面等で指定された固有のホスト名を設定します。</li>
                    <li><strong>port：</strong> データベースに接続する際に使用する専用の窓口番号（ポート番号）です。省略した場合は、MySQLのデフォルト番号である <code>3306</code> が自動的に使用されます。</li>
                </ul>

                <div class="sub-heading">⚠️ ポート番号を直接記述するデメリットと環境差</div>
                <p>プログラム内に特定のポート番号を直接書き込んでしまうと、それ以外のポート番号を採用しているデータベース環境へ移行した際にプログラムが動作しなくなる原因になります。</p>
                <ul>
                    <li><strong>XAMPP（Windows等）：</strong> デフォルトのポート番号に <code>3306</code> を採用しているため、プログラム側で記述を省略しても自動取得されて正常に接続できます。</li>
                    <li><strong>MAMP（Mac等）：</strong> デフォルトのポート番号に <code>8889</code> などが割り当てられているケースが多く、環境によって差異があります。</li>
                </ul>
                <p>今回作成した <code>bbs2.php</code> では、どのような環境でも柔軟に自動取得して動くよう、あえてポート指定の記述を省略する設計にしています。</p>
            </div>
            <!-- 2. 静的接続と動的接続のセキュリティ差異 -->
            <div class="note-section">
                <h3 class="note-title">2. 静的接続と動的接続のセキュリティ差異</h3>
                <p>PDO接続時には、文字コードの指定とともに、SQLインジェクション対策を最大限に高めるため「静的接続」への切り替えオプションを指定します。</p>

                <div class="sub-heading">2-1. 静的接続と動的接続（エミュレーション）の違い</div>
                <ul>
                    <li><strong>静的接続（推奨）：</strong> SQLの型（テンプレート）と、バインドする値を完全に別々のタイミングで個別にデータベースサーバーに送信し、サーバー側で安全に組み立てて実行する手法。</li>
                    <li><strong>動的接続（エミュレーション）：</strong> プリペアドステートメントの処理をPHP（プログラム）側で行い、値を含めて手元でSQL文を完成させてからデータベースサーバーへ送信する手法。</li>
                </ul>

                <div class="sub-heading">💡 IPA（情報処理推進機構）の推奨設定</div>
                <p>過去に一部のプログラミング言語において、動的接続でShift_JISを使用した場合にセキュリティホール（SQLインジェクションの脆弱性）が発生した歴史的背景があります。そのため、現在のIPAおよびPHP公式の推奨は以下の2点です：</p>
                <ol>
                    <li>DSN（接続文字列）内で文字コード（<code>charset=utf8</code> または <code>charset=utf8mb4</code>）を明確に指定すること。</li>
                    <li>エミュレーションをオフ（<code>false</code>）にして、厳格な「静的接続」にすること。</li>
                </ol>
            </div>
            <!-- 3. 静的接続を指定する書き方とtry-catch構文 -->
            <div class="note-section">
                <h3 class="note-title">3. 静的接続を指定する書き方とtry-catch構文</h3>
                <p>PDOによるデータベース接続を行う際は、接続失敗時に自動出力される例外（<code>PDOException</code>）を安全に制御するため、<code>try-catch</code> 文の中でオブジェクトを生成します。</p>

                <div class="sub-heading">3-1. オブジェクト生成とエミュレーションの無効化</div>
                <p>静的接続（エミュレーションの無効化）は、<code>new PDO()</code> を実行する際の第4引数に、オプション配列として <code>array(PDO::ATTR_EMULATE_PREPARES =&gt; false)</code> を渡すことで指定します。</p>

                <pre><code>// PDO接続の記述例
\$dbname = 'mysql:host=localhost;dbname=oneline_bbs;charset=utf8';
\$id = 'root';
\$pw = '';

try {
    \$pdo = new PDO(\$dbname, \$id, \$pw, array(PDO::ATTR_EMULATE_PREPARES =&gt; false));
} catch (PDOException \$e) {
    exit('データベース接続失敗。' . \$e-&gt;getMessage());
}</code></pre>

                <div class="sub-heading">3-2. 引数に渡すパラメータの詳細</div>
                <ul>
                    <li><strong>第1引数（サーバー情報）：</strong> <code>'mysql:host=ホスト名;dbname=DB名;charset=文字コード'</code> の形式で指定します。</li>
                    <li><strong>第2引数（ユーザーID）：</strong> データベースへアクセスするためのID（XAMPP初期値は <code>'root'</code>）。</li>
                    <li><strong>第3引数（パスワード）：</strong> 上記ユーザーのパスワード（XAMPP初期値は <code>''</code> 空文字）。</li>
                </ul>
            </div>
            <!-- 4. PDOのプリペアドステートメントと名前付きプレースホルダ -->
            <div class="note-section">
                <h3 class="note-title">4. PDOのプリペアドステートメントと名前付きプレースホルダ</h3>
                <p>PDOでは、ユーザーが入力したデータをテーブルに登録する前に、SQLインジェクション対策（静的接続処理）を行います。</p>

                <div class="sub-heading">4-1. 名前付きプレースホルダ（:名前）の利点</div>
                <p>SQL文の作成時に値を埋め込む場所へ、あらかじめプリペアドステートメント限定の仮の名前（名前付きプレースホルダ：例 <code>:name</code> や <code>:comment</code> など）を記述しておき、その後のbind文で紐付けを行います。</p>
                <p>これにより、mysqliで使っていた「<code>?</code>（ハテナマーク）」を使う方法よりも、後からコードを見返したときにどのカラムにどの値を入れようとしているのかが直感的に理解しやすくなります。</p>

                <div class="sub-heading">4-2. ?（プレースホルダ）を使用する場合の挙動</div>
                <p>PDOでもmysqliと同様に、バインドする値をSQL文中で <code>VALUES (?, ?, ?)</code> とハテナマークで書くことも可能です。この場合、<code>?</code> に対して左から自動的に <code>1, 2, 3...</code> と連番が付与されるため、バインドする時は「1番目の <code>?</code> に値をバインドする」というように、プログラム中には直接書いていない番号を指定して紐付けを行うことになります。</p>
            </div>
            <!-- 5. データのバインド（型指定）と電話番号の0落ち対策 -->
            <div class="note-section">
                <h3 class="note-title">5. データのバインド（型指定）と電話番号の0落ち対策</h3>
                <p>プリペアドステートメント用の変数（通常は <code>$stmt</code>）を用意した後は、各プレースホルダに対して値をバインドする命令を実行します。</p>

                <div class="sub-heading">5-1. bindParam() と bindValue() の明確な違い</div>
                <ul>
                    <li><strong>$stmt-&gt;bindParam()：</strong> バインドする値を「変数」に格納して紐付けます。後から変数の値が変わると、最終的に <code>execute()</code> で実行される瞬間の値も連動して変化します。</li>
                    <li><strong>$stmt-&gt;bindValue()：</strong> バインドする値を直接命令内に記入するか、その時点の値を「固定値」として即座に紐付けます。</li>
                </ul>

                <div class="sub-heading">5-2. データ型（PARAM_STR / PARAM_INT）の制御と注意点</div>
                <p>引数の末尾でデータの型を明示的に指定できます（省略した場合は自動的に文字列型：<code>PDO::PARAM_STR</code> になります）。</p>
                <ul>
                    <li><strong>文字列・小数の場合：</strong> <code>PDO::PARAM_STR</code> を指定します。※PDOには小数を表す個別の型定数がないため、誤差や切り捨てを防ぐために文字列として扱います。</li>
                    <li><strong>整数の場合：</strong> <code>PDO::PARAM_INT</code> を指定します。整数型を指定すると、渡された値が自動的に整数に強制変換されるため、先頭の <code>0</code> や小数点以下は削除（型変換）されます。</li>
                </ul>

                <div class="sub-heading">⚠️ 実務の罠：電話番号を整数型（PARAM_INT）にしてはいけない理由</div>
                <p>電話番号の先頭にある <code>0</code> は、国内通話などを意味する極めて重要な番号です。もし電話番号のカラムに整数型を指定してバインドしてしまうと、先頭の <code>0</code> がすべて自動的に削除（例：<code>090</code> が <code>90</code> に変換）されてしまいます。そのため、実務のサイト構築においては、電話番号は数値ではなく必ず<b>文字列型（PDO::PARAM_STR）</b>のまま扱うのが鉄則です。</p>
            </div>
            <!-- 6. SQL文の実行とオブジェクト型変数の解放 -->
            <div class="note-section">
                <h3 class="note-title">6. SQL文の実行とオブジェクト型変数の解放</h3>
                <p>プレースホルダへのバインドがすべて完了したら、データベースに対して実際のクエリを実行し、終了後は速やかにメモリを明け渡します。</p>

                <div class="sub-heading">6-1. execute() によるクエリの送信</div>
                <pre><code>\$stmt-&gt;execute();</code></pre>
                <p>この命令を実行することで、事前に送信していたSQLのテンプレートに対してバインドされた値が流し込まれ、データベース側で安全に組み立てられて実行されます。</p>

                <div class="sub-heading">6-2. プリペアドステートメントの終了（null代入の仕組み）</div>
                <p>データベースの処理がすべて終わったら、速やかにオブジェクトを終了させるのが基本です。PDOでは、使用していた変数に対して <code>null</code> を代入することで解放を行います。</p>
                <pre><code>\$stmt = null; // プリペアドステートメントの終了
\$pdo = null;  // データベース接続の切断</code></pre>
                <ul>
                    <li>PDOのプリペアドステートメントや接続機能は、内部的に<b>「オブジェクト型」</b>という特殊な形式で動作しています。</li>
                    <li>オブジェクト型の場合、変数（<code>\$stmt</code> や <code>\$pdo</code>）の中には、データそのものではなく、メモリ上に生成された「オブジェクトの実体がある場所（参照）」が記録されています。</li>
                    <li>そのため、この変数に対して <code>null</code> を直接代入して上書きすることで、実体との結びつきが切れ、不要になったオブジェクトがサーバーのメモリ上から完全に削除（解放）される仕組みになっています。</li>
                </ul>
            </div>
            <!-- クイズエリア -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <div class="quiz-box">
                    <p class="quiz-question">Q1. MAMP環境のMySQLデフォルトポート番号（8889など）のように環境による差があるため、今回のプログラム（bbs2.php）のDSN指定において工夫した点はどこですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ポート番号の指定をプログラム内に直接書かずに「省略」し、環境ごとのポート番号を自動取得させて接続させた点。</p>
                            <p style="margin-bottom: 0;">解説： ポート番号を固定値で直接記述してしまうと、異なるポート番号を採用しているデータベース環境に移行した際に、プログラムが一切動かなくなる原因になります。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q2. DSNで文字コードを指定するとともに、PDOオブジェクト生成時のオプション配列に「PDO::ATTR_EMULATE_PREPARES => false」を指定する主な目的は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 プリペアドステートメントのエミュレーション（動的接続）を無効化し、IPAも推奨するより安全な「静的接続」にするため。</p>
                            <p style="margin-bottom: 0;">解説： SQLのテンプレートとバインドする値を別々に送信し、データベースサーバー側で厳密に組み立てることで、SQLインジェクション脆弱性を確実に排除できます。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q3. mysqliで使用していた「?」のプレースホルダと比較して、PDOで導入された「名前付きプレースホルダ（:nameなど）」を使用することの最大のメリットは何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ハテナマークの順番に依存せず、どのカラムにどの変数をバインドしようとしているのかが、後からコードを見返したときに直感的に理解しやすくなる点。</p>
                            <p style="margin-bottom: 0;">解説： 「?」を使用すると左から1, 2, 3...と暗黙の連番で結びつける必要がありますが、名前付きであれば仮の名前で明確に対応付けができます（PDOではどちらの方式もサポートされています）。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q4. 入力フォームから受け取った「電話番号（090...）」のデータをバインドする際、データ型に「PDO::PARAM_INT」を指定してはいけない理由は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 整数型（PARAM_INT）を指定すると値が数値に強制変換され、先頭にある極めて重要な「0」が自動的に削除されてしまうから。</p>
                            <p style="margin-bottom: 0;">解説： 先頭の「0」を保持して型落ちを防ぐために、実務のサイト構築においては、電話番号は整数ではなく必ず文字列型（<code>PDO::PARAM_STR</code>）のまま扱うのが鉄則です。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q5. 処理終了時に「$stmt = null;」や「$pdo = null;」を代入することで、プリペアドステートメントやDB接続が終了（解放）されるのは、これらがどのような形式で動作しているためですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 内部的に「オブジェクト型」という形式で動作しており、変数にnullを代入することでメモリ上にあるオブジェクトの実体（参照）が完全に削除される仕組みだから。</p>
                            <p style="margin-bottom: 0;">解説： 変数の中には実体の場所が記録されているため、nullで上書きして結びつきを断ち切ることで、サーバーの不要なメモリ領域を速やかに明け渡すことができます。</p>
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
