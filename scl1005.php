<!DOCTYPE html>
<html lang="ja">

<head>
    <title>10/05(月)職業訓練授業：$_FILESによるファイルアップロード技術 | ポートフォリオサイト</title>
    <?php include 'meta.php'; ?>
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">

            <h1>10/05(月)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">フォームを利用したファイル（画像）の送信・受信処理とサーバー側バリデーション</p>

            <!-- 1. ファイル送信フォームの必須ルール -->
            <div class="note-section">
                <h3 class="note-title">1. ファイル送信フォームの必須ルール</h3>
                <p>HTMLフォームを使ってファイル（画像など）をサーバーに送信する場合、通常のテキスト送信とは異なる設定が必要です。</p>

                <div class="sub-heading"> enctype="multipart/form-data" の指定</div>
                <p>フォームでファイル送信を行うには、必ず <code>&lt;form&gt;</code> タグに <strong><code>enctype="multipart/form-data"</code></strong> を明記しなければなりません。この指定を忘れて送信した場合、バイナリデータ（ファイル内容）が適切にカプセル化されないため、ファイル送信はすべて失敗します。</p>

                <div class="sub-heading"> type="file" コントロールの仕様</div>
                <p><code>&lt;input type="file"&gt;</code> を使用すると、ブラウザ規定の「ファイル選択ボタン」が表示されます。</p>
                <ul>
                    <li><code>value</code> 属性に「画像選択」などの文字列を指定しても、多くのモダンブラウザではセキュリティやブラウザごとの規定値を優先して表示するため、表記が異なる場合があります。</li>
                    <li>ボタン1つにつき選択できるファイルは<strong>原則1つのみ</strong>です。複数ファイルを同時に送信させたい場合は、送信させたい数だけボタンを設置し、それぞれ受信側で識別できるよう <code>name</code> 属性を個別に分ける必要があります。</li>
                </ul>
            </div>

            <!-- 2. スーパーグローバル変数 $_FILES の構造と一時保管場所 -->
            <div class="note-section">
                <h3 class="note-title">2. スーパーグローバル変数 $_FILES の構造と一時保管場所</h3>
                <p>ユーザーから送信されたファイルデータは、PHP側で <strong><code>$_FILES</code></strong> という2次元の連想配列に格納されます。</p>

                <div class="sub-heading">📂 $_FILES['inputのname']['各キー'] の構造</div>
                <ul>
                    <li><code>['name']</code> ： ユーザー環境における元のファイル名。</li>
                    <li><code>['size']</code> ： ファイルの大きさを表す<strong>バイト数（サイズ）</strong>。</li>
                    <li><code>['type']</code> ： ファイルの種類を識別する<strong>MIMEタイプ</strong>（例：<code>image/jpeg</code>）。</li>
                    <li><code>['error']</code> ： ファイル送信に関する<strong>エラーコード</strong>（正常終了時は <code>0</code>）。</li>
                    <li><code>['tmp_name']</code> ： サーバーにアップロードされたファイルが、一時的に置かれている<strong>テンポラリフォルダ内の保管パス</strong>。</li>
                </ul>

                <div class="sub-heading">⚠ 重要：一時保管先の有効期限（tmp_name の罠）</div>
                <p>テンポラリフォルダに保管された一時ファイルは、<code>&lt;form&gt;</code> の <code>action</code> で指定された <strong>PHPプログラムが実行を終えた瞬間に自動的に消去</strong> されます。そのため、ファイルをサーバー内に永続的に残したい場合は、プログラムが終了する前に移動・保存処理を行わなければなりません。</p>
            </div>

            <!-- 3. 受信側（サーバー側）で行う厳格なバリデーション -->
            <div class="note-section">
                <h3 class="note-title">3. 受信側（サーバー側）で行う厳格なバリデーション</h3>
                <p>ファイルアップロード機能は不正スクリプトを混入されやすいため、正式保存を行う前に厳重な多段階チェック（バリデーション）を挟み、不適格なデータは <code>exit()</code> で強制終了させます。</p>

                <div class="sub-heading">3-1. エラーコード（error）の最優先チェック</div>
                <p>まず <code>$_FILES['file']['error'] != 0</code> であるかを確認します。<code>0</code> 以外はアップロード中のエラーを意味するため、それ以降の処理を行わずにエラーメッセージを出して <code>exit()</code> します。</p>

                <div class="sub-heading">3-2. ファイルサイズ（size）の制限</div>
                <p>サーバー容量の圧迫や予期せぬ負荷を防ぐため、バイト数単位で上限を設けます。授業内では 1,000,000 バイト（約1MB）を超えるファイルを排除するチェックを実装しました。</p>

                <div class="sub-heading">3-3. ファイルの種類（type / MIMEタイプ）の制限</div>
                <p>許可された拡張子（形式）以外を受け付けないように制限します。授業の初期ロジックでは、<code>"image/jpeg"</code> 以外の形式（pngやgif、あるいは悪意あるプログラムファイルなど）を一律で排除する判定処理を施しました。</p>
            </div>

            <!-- 4. 重複回避の自動リネームとmove_uploaded_file() -->
            <div class="note-section">
                <h3 class="note-title">4. 重複回避の自動リネームと move_uploaded_file()</h3>
                <p>チェックをすべて通過した安全な一時ファイルを、最終保存先ディレクトリ（<code>images/</code>など）に永続保存します。</p>

                <div class="sub-heading">💡 永久ループ（while文）を用いた一意のファイル名生成</div>
                <p>ユーザーのつけた元の名前のまま保存すると同名ファイルが上書き消滅してしまうため、<code>date('YmdHis')</code> で年月日時分秒を取得し、<code>img20261005141523.jpg</code> のような重複しづらい一意（ユニーク）な名前を自動作成します。</p>
                <p>さらに安全性を高めるため、<strong><code>while(1)</code></strong> の無限ループの中で <strong><code>file_exists($filename)</code></strong> を行い、「完全に同名ファイルがターゲットディレクトリに存在しない状態」を確実に確保できた段階で <code>break</code> して名前を確定させます。</p>

                <div class="sub-heading"> move_uploaded_file() による正式保存</div>
                <p>名前が確定したら、テンポラリフォルダから正式な保存場所へとファイルを移動させます。</p>
                <p><code>move_uploaded_file($_FILES['file']['tmp_name'], $filename);</code></p>
                <p>この記述を実行することで初めて、サーバー上の指定ディレクトリに画像が書き込まれ、ブラウザから <code>&lt;img&gt;</code> タグなどで閲覧可能な状態になります。</p>
            </div>

            <!--  復習ミニクイズ（全5問） -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;"> 本日の復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習したファイルアップロード処理の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. フォームで画像やファイルを送信する際、&lt;form&gt;タグに指定し忘れるとファイル送信がすべて失敗する必須の属性は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 enctype="multipart/form-data"</p>
                            <p style="margin-bottom: 0;">解説： ファイルのバイナリデータを正常にカプセル化して送信するための必須属性です。指定がないと、単なる文字列（ファイル名だけなど）として扱われ中身が届きません。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. サーバー側に一時保管されたアップロードファイルの「一時的な保管場所のパス」が格納されている$_FILESのキーは何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ['tmp_name']</p>
                            <p style="margin-bottom: 0;">解説： ファイルは一時的にサーバーの設定で定められたテンポラリディレクトリに保存され、その場所の絶対パスが <code>$_FILES['file']['tmp_name']</code> に自動登録されます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. $_FILES['file']['tmp_name']に保管された一時ファイルの「有効期限」はいつまでですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 アクション先（受け取り側）のPHPファイルの実行終了まで</p>
                            <p style="margin-bottom: 0;">解説： 一時保管ファイルの寿命は非常に短く、プログラムの処理が終了した（リクエストが完了した）瞬間に、サーバーから自動的に自動削除されます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. 受信側PHPで、ファイルの正式移動・保存処理を行う前に「最優先」で確認しなければならない$_FILESのキーは何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 ['error']</p>
                            <p style="margin-bottom: 0;">解説： アップロード自体に成功したか（値が0であるか）をまず最初にチェックします。0以外のエラーコードの場合は速やかに処理を中断（exit）する必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. 一時保存フォルダ（tmp_name）から、新しく作成した保存先のディレクトリパス（images/など）へファイルを安全に移動・正式保存する関数は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 move_uploaded_file()</p>
                            <p style="margin-bottom: 0;">解説： アップロードされたファイル専用の移動関数です。通常のファイル移動関数と異なり、フォーム経由で正規にアップロードされた一時ファイルであるかを内部で厳密にチェックした上で移動を行います。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

        </main>
    </div> <!-- .container 終了 -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button">▲ TOP</a>

</body>

</html>
<!-- http://localhost/study/scl1005.php -->