<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="10/13(月)の職業訓練授業ノートです。SELECT文によるデータ取得の基本、WHERE句による条件絞り込み、LIKE演算子を用いたあいまい検索、ORDER BYによるソート処理を解説しています。">
    <title>10/13(月)職業訓練授業：SELECT文によるデータ取得とあいまい検索・ソート処理 | ポートフォリオサイト</title>
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

            <h1>10/13(月)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">SELECT文によるデータ抽出の基本、WHERE句とLIKE演算子による高度な検索、ORDER BYによる並び替え、および安全なフェッチ処理</p>

            <!-- 1. ユーザー入力値のエスケープ無毒化（前回の補足） -->
            <div class="note-section">
                <h3 class="note-title">1. ユーザー入力値のエスケープ無毒化（前回の補足）</h3>
                <p>前回のプリペアドステートメントの手法に加えて、授業では <code>mysqli_real_escape_string()</code> 関数を用いた、もう一つの安全なデータ挿入用エスケープ（無毒化）の手法を学習しました。</p>
                <pre><code>\$sql = "INSERT INTO post (name, comment, created_at) VALUES('" . mysqli_real_escape_string(\$link, \$name) . "', '" . mysqli_real_escape_string(\$link, \$comment) . "', '" . date('Y-m-d H:i:s') . "')";</code></pre>
                <ul>
                    <li>悪意あるユーザーが入力欄に変なSQL文を混ぜて送信してきても、この関数を通すことで特殊な記号や命令文字が別の安全なコードに置き換えられ、インジェクション攻撃を完全に無効化します。</li>
                    <li>文字列を結合して <code>VALUES('エスケープ済みの値', 'エスケープ済みの値', '日時')</code> という完全なSQL文を組み立て、<code>mysqli_query()</code> で即座に実行するシンプルな手法です。</li>
                </ul>
            </div>

            <!-- 2. データベースからのデータ取得（SELECT文の基本） -->
            <div class="note-section">
                <h3 class="note-title">2. データベースからのデータ取得（SELECT文の基本）</h3>
                <p>蓄積されたデータを画面に表示するためには、<code>SELECT</code> 文を使用してデータベースに対してデータの取得要求を行います。</p>
                <div class="sub-heading">2-1. 全カラムの取得と必須項目</div>
                <p>特定の列だけを指定して取得することもできますが、すべての項目（列）を一括でまとめて取得する場合は「<code>*</code>（アスタリスク）」を使用します。</p>
                <pre><code>SELECT * FROM テーブル名</code></pre>
                <ul>
                    <li><code>SELECT [取得したいカラム名]</code> と <code>FROM [対象のテーブル名]</code> の2つは、データを取得する上で省略できない必須の記述ルールです。</li>
                    <li>これらをベースとして、必要に応じてデータの「絞り込み条件（WHERE句）」や「並び替え（ORDER BY句）」といった各種オプションを後ろに追加していきます。</li>
                </ul>
            </div>
            <!-- 3. WHERE句による取得行の絞り込みとあいまい検索 -->
            <div class="note-section">
                <h3 class="note-title">3. WHERE句による取得行の絞り込みとあいまい検索</h3>
                <p>特定の条件に一致する行だけをデータベースから抽出したい場合、<code>WHERE</code> 句を使用します。</p>

                <div class="sub-heading">3-1. 比較演算子による条件指定</div>
                <pre><code>WHERE カラム名 比較演算子 値</code></pre>
                <p>「〇〇カラムの値が△△のもの」という指定を行います。使える比較演算子には <code>&lt;</code>, <code>&gt;</code>, <code>&lt;=</code>, <code>&gt;=</code>, <code>=</code>, <code>&lt;&gt;</code>（等しくない）があります。また、<code>AND</code> や <code>OR</code> を使って「50以上かつ100以下（<code>WHERE price &gt;= 50 AND price &lt;= 100</code>）」のように複数条件を組み合わせることも可能です。</p>

                <div class="sub-heading">3-2. LIKE演算子とワイルドカードによる「あいまい検索」</div>
                <p>MySQLデータベースでは、一部分だけが一致しているデータを検索する「あいまい検索」が可能です。<code>LIKE</code> 演算子と以下の特別な記号（ワイルドカード）を組み合わせて指定します。</p>
                <ul>
                    <li><strong>%（パーセント）：</strong> 0文字以上の任意の文字列を表します。</li>
                    <li><strong>_（アンダースコア）：</strong> 任意の1文字（プレースホルダ）を表します。</li>
                </ul>
                <p>【記述の具体例】</p>
                <ul>
                    <li><code>LIKE "%テレビ%"</code> ：文中のどこかに「テレビ」という文字を含む（部分一致検索）</li>
                    <li><code>LIKE "__型テレビ"</code> ：「〇〇型テレビ」のように、前に任意の2文字がある（桁数固定検索）</li>
                    <li><code>LIKE "テレビ_%"</code> ：「テレビ」から始まり、後ろに最低1文字以上ある（前方一致検索）</li>
                </ul>
            </div>

            <!-- 4. ORDER BYによるデータの並び替え（ソート処理） -->
            <div class="note-section">
                <h3 class="note-title">4. ORDER BYによるデータの並び替え（ソート処理）</h3>
                <p>掲示板の書き込みなどをブラウザに表示する際、新しい投稿が一番上に来るようにデータを並び替える必要があります。</p>
                <pre><code>SELECT * FROM post ORDER BY created_at DESC</code></pre>
                <p><code>ORDER BY [対象のカラム名] [並び替え方式]</code> の順に指定します。</p>
                <ul>
                    <li><strong>DESC（降順）：</strong> 値が大きいものから順に並べます。日時の場合は「新しい日時から順（最新順）」、数値の場合は「大きい順」になります。</li>
                    <li><strong>ASC（昇順）：</strong> 値が小さいものから順に並べます。日時の場合は「古い日時から順（過去順）」、数値の場合は「小さい順」になります。（省略した場合は自動的にASCになります）</li>
                </ul>
                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 10px;">
                    ※今回のひとこと掲示板では、最新の書き込みから順に箇条書きリストとしてブラウザ出力させるために <code>ORDER BY created_at DESC</code>（または <code>ORDER BY id DESC</code>）を指定してデータを並び替えています。
                </p>
            </div>
            <!-- 5. データベースへの実行指示とwhileループによる1行ずつの取得 -->
            <div class="note-section">
                <h3 class="note-title">5. データベースへの実行指示とwhileループによる1行ずつの取得</h3>
                
                <div class="sub-heading">5-1. mysqli_query() によるSELECT文の実行</div>
                <pre><code>\$result = mysqli_query(\$link, \$sql);</code></pre>
                <ul>
                    <li>成功した場合、取得された全データはデータベース側の専用領域に保存され、変数 <code>\$result</code> にはその展開場所から<b>データを1行ずつ取り出すための権利（情報）</b>が代入されます。（※失敗時は <code>false</code> が入ります）</li>
                </ul>

                <div class="sub-heading">5-2. mysqli_fetch_assoc() による「フェッチ」処理</div>
                <p>データベースに保存された取得データを、PHP側では <code>while</code> ループを使って1行ずつ切り取る形で取り出します。一気に全件を取り出すとメモリに負荷がかかるため、1件ずつ行うのが鉄則です。</p>
                <pre><code>while (\$post = mysqli_fetch_assoc(\$result)) {
    // 1行ずつの表示処理を行う
}</code></pre>
                <ul>
                    <li><code>mysqli_fetch_assoc()</code> は、データを1行切り取って、カラム名をキーとした連想配列として変数（<code>\$post</code>）に代入します。</li>
                    <li>次の行へ、次の行へと自動で進み、すべてのデータを取り出し終えると自動的に <code>false</code> を戻します。終了時に <code>false</code> になる性質を利用して、whileループを安全に脱出させます。</li>
                </ul>

                <div class="sub-heading">5-3. メモリの解放と接続の切断</div>
                <p>データの取り出しがすべて完了した後は、サーバーのメモリや占有していた接続権をすみやかに解放します。</p>
                <pre><code>mysqli_free_result(\$result); // データベース側のデータ展開場所をクリア
mysqli_close(\$link);        // データベースとの接続を切断</code></pre>
            </div>

            <!-- クイズエリア -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <div class="quiz-box">
                    <p class="quiz-question">Q1. SELECT文で、条件を絞り込まずに対象テーブルから「すべてのカラム（列）」を一括で取得したいときに使用する記号は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 *（アスタリスク）</p>
                            <p style="margin-bottom: 0;">解説： <code>SELECT * FROM post</code> のように記述することで、テーブルに含まれるすべてのカラムのデータを一度にまとめて取得することができます。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q2. WHERE句で、一部分だけが一致しているデータを検索する「あいまい検索」を行う際に、比較演算子（=）の代わりに使用する演算子は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 LIKE 演算子</p>
                            <p style="margin-bottom: 0;">解説： <code>WHERE カラム名 LIKE "値"</code> の形で記述します。完全一致ではなく「〜を含む」といった柔軟な検索画面を構築する際に必須となる命令です。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q3. LIKE演算子と組み合わせて使うワイルドカード（特殊記号）のうち、「0文字以上の任意の文字列」を意味する記号は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 %（パーセント）</p>
                            <p style="margin-bottom: 0;">解説： <code>"%テレビ%"</code> と書けば前後に何文字あっても（0文字でも）ヒットする部分一致になり、<code>"テレビ%"</code> であればテレビから始まる前方一致になります。なお、任意の1文字を表す場合は <code>_</code>（アンダースコア）を使用します。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q4. ORDER BY句でデータを並び替える際、日付の新しい順や、数値の大きい順といった「降順」に指定するためのキーワードは何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 DESC</p>
                            <p style="margin-bottom: 0;">解説： <code>ORDER BY created_at DESC</code> とすることで最新順にソートされます。逆に古い順や数値の小さい順といった「昇順」にしたい場合は <code>ASC</code> を指定します（無指定の場合は自動的に昇順になります）。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q5. SELECT文で取得したデータ群を、全件一気に処理せず、whileループと mysqli_fetch_assoc() を使って「1行ずつ」切り取りながら処理を行うのはなぜですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 膨大なデータを一度にPHP側に読み込ませると、サーバーのメモリ（容量）に過大な負荷がかかってしまうのを防ぐため。</p>
                            <p style="margin-bottom: 0;">解説： 1行取り出しては画面に出力し、終わったら次の1行を読み込むというサイクルを繰り返す（フェッチ処理）ことで、数万件のデータがあってもサーバーに一切負荷をかけずに処理することができます。</p>
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
