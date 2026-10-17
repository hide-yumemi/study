<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/30(水)の職業訓練授業ノートです。ラジオボタンのグループ化、チェックボックスの配列受信と選択項目のコード化、バリデーション、そしてテキストエリアの改行処理（nl2br）とエスケープの順序をまとめています。">
    <title>9/30(水)職業訓練授業：選択系コントロールの処理とテキストエリア改行制御 | ポートフォリオサイト</title>
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

            <h1>9/30(水)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">Webフォームの送信（POST）と各コントロールに応じた受信処理・セキュリティ対策</p>

            <!-- 1. フォーム送信ページの基本構造と注意点 -->
            <div class="note-section">
                <h3 class="note-title">1. フォーム送信ページ（formsend.php）の基本構造</h3>
                <p>ユーザーからのデータをサーバーへ送信するためのHTML構造と、各入力コントロール（属性）の設定方法について解説します。</p>

                <div class="sub-heading">1-1. フォームの基本属性とファイル送信</div>
                <p><code>&lt;form&gt;</code> タグには、送信先を指定する <code>action</code> 属性、送信方法を指定する <code>method</code> 属性を適切に指定します。</p>
                <ul>
                    <li><code>action="formget.php"</code> ： フォームデータを受け取って処理を行うPHPファイルを指定します。</li>
                    <li><code>method="post"</code> ： HTTPのPOSTメソッドを利用してデータを安全に送信します。</li>
                    <li><code>enctype="multipart/form-data"</code> ： フォーム内で画像などのファイルを送信する際に必ず指定します。これを指定しないと、ファイル送信はすべて失敗してしまいます。</li>
                </ul>
                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fef2f2; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠️ 注意：</strong> フォームの部品に指定する <code>name</code> 属性の値は、PHPの変数名として使用できない「予約語」を避けて記述する必要があります。
                </p>

                <div class="sub-heading">1-2. 各フォームコントロール（入力・選択部品）の特徴</div>
                <p>送信するデータの内容に応じて、HTMLのコントロールを正しく使い分ける必要があります。</p>
                <ul>
                    <li><strong>テキストエリア（<code>&lt;textarea&gt;</code>）：</strong> 複数行の文章（質問やお問い合わせ内容など）を入力してもらう場合に使用します。</li>
                    <li><strong>ボタン（<code>&lt;input type="submit"&gt;</code> / <code>&lt;input type="reset"&gt;</code>）：</strong> <code>value</code> 属性に指定した文字列が、実際のボタンの表面に表示されます。</li>
                </ul>
            </div>

            <!-- 2. 選択系コントロール（ラジオボタン・チェックボックス）の処理 -->
            <div class="note-section">
                <h3 class="note-title">2. 選択系コントロール（ラジオボタン・チェックボックス）の処理</h3>
                <p>ラジオボタンやチェックボックスは、ユーザーが文字を直接入力しないため、制作側があらかじめ指定した <code>value</code> 属性の値がサーバーに送信されます。</p>

                <div class="sub-heading">2-1. ラジオボタンの構造と設定</div>
                <p>血液型のように、複数の選択肢から必ず「1つだけ」を選択してもらう場合に使用します。</p>
                <ul>
                    <li>選択されるのはどれか1つのため、同一グループ内において <strong><code>name</code> 属性の値を必ず共通</strong> にします。</li>
                    <li>ユーザーは文字を入力しないため、サーバーへ送信したい値を必ず <code>value</code> 属性で指定します。</li>
                </ul>
                <p><strong>💡 ラジオボタンの複数設置：</strong> 血液型のほかに「性別」など、違う種類の選択肢を同じページに設置したい場合は、血液型グループで1つの <code>name</code> 属性、性別グループで別の <code>name</code> 属性というように分けることで、それぞれ独立したラジオボタンを設置できます。</p>

                <div class="sub-heading">2-2. チェックボックスの構造と配列化（多次元配列での受け取り）</div>
                <p>趣味の選択のように、複数選択（マルチチェック）できる形式の回答は、一度に複数のデータが送信される可能性があります。</p>
                <ul>
                    <li>複数の回答を1つの <code>name</code> 属性でまとめて受け取るため、 <strong><code>name</code> 属性の値の最後に <code>[]</code> （角括弧）を付加</strong> します。</li>
                    <li><code>name="fav[]"</code> のように指定することで、PHP側には <strong>多次元配列（添字配列）</strong> としてデータが渡されます。</li>
                </ul>

                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>✨ 開発のベストプラクティス（選択項目のコード化）：</strong><br>
                    実務では、文字数の多い選択項目をそのままやり取りするのではなく、 <code>value="0"</code> や <code>value="1"</code> のように「コード化（数値化）」して送信するのが一般的です。データベースに格納する際も、このコード化された値を使用します。
                </p>

                <div class="sub-heading">📂 PHP側での配列受信と対応文字列への変換処理</div>
                <p>チェックボックスはユーザーによって選択される個数が毎回異なるため、PHP側では <code>foreach</code> 文を使用してループ処理で全件を取り出します。また、送信されてきたコード（数値）を画面上で分かりやすい文字列に戻すため、対応する対応配列をあらかじめプログラム側で用意しておきます。</p>
                <dl class="board-dl">
                    <dt>$favarr[0]</dt>
                    <dd>'旅行'</dd>
                    <dt>$favarr[1]</dt>
                    <dd>'スポーツ'</dd>
                    <dt>$favarr[2]</dt>
                    <dd>'音楽'</dd>
                    <dt>$favarr[3]</dt>
                    <dd>'インターネット'</dd>
                </dl>
            </div>
            <!-- 3. フォームデータ受信（formget.php）とセキュリティ対策 -->
            <div class="note-section">
                <h3 class="note-title">3. フォームデータ受信（formget.php）とセキュリティ対策</h3>
                <p>ユーザーから送信されたデータを安全かつ正しく処理するための、バリデーションと文字列処理について解説します。</p>

                <div class="sub-heading">3-1. サーバー側（PHP）での厳格な入力チェック</div>
                <p>HTML側でも入力必須（ <code>required</code> 属性など）を設定できますが、<strong>悪意を持ったユーザーはHTMLの制限を簡単に回避して不正なデータを送信できる</strong>ため、必ずPHP側で厳格なチェック（バリデーション）を行います。</p>
                <ul>
                    <li><code>isset($_POST['name属性'])</code> ： <code>$_POST</code> 配列に、指定した name 属性がキーとして存在している（代入されている）かを確認します。</li>
                    <li><code>strlen($_POST['name属性']) &gt; 0</code> ： 文字入力を行う項目は、ユーザーが何も入力しなくても「空の文字列（0文字）」として送信されます。そのため、 <code>strlen()</code> 関数を用いて文字数が0より大きいことを厳格に判定します。</li>
                </ul>

                <div class="sub-heading">3-2. 各コントロールに応じた出力とサニタイズ（安全化）</div>
                <ul>
                    <li><strong>テキスト入力・テキストエリアの出力：</strong> ユーザーが自由に入力できる項目のため、XSS（クロスサイトスクリプティング）脆弱性を防ぐために、必ず <code>htmlspecialchars()</code> を用いてエスケープ処理を施します。</li>
                    <li><strong>ラジオボタン（血液型など）の出力：</strong> 制作側が固定で指定した value 値（例: A, B, O, AB）しか送信されないため、ユーザーによる自由な文字列入力がありません。そのため、この項目には <code>htmlspecialchars()</code> によるエスケープは不要です。</li>
                </ul>

                <div class="sub-heading">📐 重要：テキストエリアの改行処理と「ネストの順序」</div>
                <p><code>&lt;textarea&gt;</code> 内でユーザーが改行した情報は、PHP側では「 <code>\r\n</code> 」などの改行コードとして受信されます。しかし、HTML上では改行コードがただの半角スペースとして扱われるため、そのまま表示すると1行に繋がってしまいます。</p>
                <p>改行を維持して表示するには、改行コードを <code>&lt;br&gt;</code> タグに変換する <strong><code>nl2br()</code> 関数</strong> を使用します。</p>

                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>💡 実装のネスト順序（超重要）：</strong><br>
                    テキストエリアの出力を安全かつ改行対応にするには、<b>「エスケープした後に、改行変換を行う」</b>のが絶対の鉄則です。<br>
                    <code>echo nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8'));</code><br>
                    のように、必ず <code>nl2br()</code> の中に <code>htmlspecialchars()</code> を記述（ネスト）してください。逆にすると、せっかく変換した <code>&lt;br&gt;</code> タグ自体がエスケープされて画面に文字として表示されてしまいます。
                </p>
            </div>

            <!-- 🧠 復習ミニクイズ（全5問） -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. フォームで画像やファイルなどを送信する場合、&lt;form&gt;タグに必ず指定しなければならない属性は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 enctype="multipart/form-data"</p>
                            <p style="margin-bottom: 0;">解説： ファイル送信を行う際は、この属性指定が必須です。指定を忘れるとファイルデータが正しく送信されず、アップロード処理が失敗します。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. ラジオボタンで、複数の選択肢から「1つだけ」を選ばせるようにグループ化するためには、どの属性の値を共通にする必要がありますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 name 属性</p>
                            <p style="margin-bottom: 0;">解説： 同じグループにしたいラジオボタンの name 属性の値をすべて同一にすることで、ブラウザが同一グループと認識し、1つしか選択できない状態を作ることができます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. チェックボックス（checkbox）の複数選択されたデータを、PHP側で配列として受け取るためには、HTML側のname属性の末尾に何を付ける必要がありますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 [] （角括弧・スクエアブラケット）</p>
                            <p style="margin-bottom: 0;">解説： name="fav[]" のように末尾に [] を記述することで、PHPは送信された複数の選択データを多次元配列（添字配列）として自動的に受信してくれます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. ユーザーがテキスト入力を何もせず送信した場合、PHP側ではどのように受信されますか？またそのチェック方法は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 空の文字列（文字数0の文字列）として受信される。チェックには strlen() 関数などを用いる。</p>
                            <p style="margin-bottom: 0;">解説： 未入力でも $_POST 配列のキー自体は存在するため、 isset() だけでは未入力の判定ができません。 strlen($_POST['email']) &gt; 0 などのように、文字数が0より大きいかを併せてチェックする必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. &lt;textarea&gt;内で入力された「改行コード」を、HTML画面上で正しく改行（&lt;br&gt;）として表示するために使用するPHPの関数は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 nl2br() 関数</p>
                            <p style="margin-bottom: 0;">解説： HTMLは文字列中の改行コードを半角スペースとして処理するため、 nl2br() を使って改行コード（ \r\n など）の直前に &lt;br /&gt; タグを挿入する必要があります。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

        </main>
    </div> <!-- .container 終了 -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>