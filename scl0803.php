<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/3(月)の職業訓練授業ノートです。HTMLフォームの基本構造（GET/POSTの違い）から、各種インプット属性、選択部品の正しいマークアップ方法をまとめています。">
    <title>8/3 入力フォームの基礎 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="./style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="./scl_style.css">
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            <h2>8/3(月) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                ユーザーからのデータを受け付ける「入力フォーム」の仕組みと、フォームを構成する各部品のマークアップ方法のまとめです。
            </p>

            <!-- セクション1：フォームの基本概念 -->
            <div class="note-section">
                <h3 class="note-title">入力フォームの基本概念</h3>
                <p>
                    入力フォームは、ユーザーに入力や選択をしてもらう場所を作成する機能です。**入力されたデータはHTML単体では受け取ることができません。**
                </p>
                <p>
                    入力データはJavaScriptで動的な処理に使用したり、サーバー側（PHPやJavaなど）に送信してデータベースとやり取りを行うために使用されます。データをサーバーへ送信する場合、入力部品のすべてを <code>&lt;form&gt;</code> タグの子孫要素として設置する必要があります。
                </p>
                
                <p style="margin-top: 15px;"><strong>■ formタグの3大属性</strong></p>
                <ul>
                    <li><strong><code>action</code> 属性：</strong> データの送信先ファイル（パスまたはURL）を指定します。同一サーバー内のファイルへ送信するのが一般的です。</li>
                    <li><strong><code>method</code> 属性：</strong> データの送信方法（<code>get</code> または <code>post</code>）を指定します。</li>
                    <li><strong><code>enctype</code> 属性：</strong> ファイル送信を行う場合は、必ず <code>enctype="multipart/form-data"</code> を指定します。これがないとファイル送信は失敗します。</li>
                </ul>
            </div>

            <!-- セクション2：GET と POST の違い -->
            <div class="note-section">
                <h3 class="note-title">データの送信方法（GET と POST の違い）</h3>
                <p>データの送信形式には、用途に合わせて厳格な使い分けが必要です。</p>
                
                <div class="sub-heading">① GET送信（<code>method="get"</code>）</div>
                <p>URLの後ろに <code>?データ名=値</code> という形で、送信データを付加して送る方法です。</p>
                <ul>
                    <li>送信データがブラウザのURL欄に丸見えになるため、セキュリティ上の問題があります。</li>
                    <li>文字数制限（URLの上限）があるため、大量のデータや画像などは送信できません。</li>
                    <li><strong>用途：</strong> 検索ワードなど、他人に見られても影響のないページ（Google検索など）で使用されます。履歴に残したりブックマークできるメリットがあります。</li>
                </ul>

                <div class="sub-heading">② POST送信（<code>method="post"</code>）</div>
                <p>通信データ内部（メッセージボディ）にデータを包括して見えないように送信する方法です。</p>
                <ul>
                    <li>送信データがURLに表示されないため、<code>https://</code> で通信全体を暗号化することで安全にデータを運べます。</li>
                    <li>文字数の制限が事実上ないため、大量のテキストやファイル送信が可能です。</li>
                    <li><strong>用途：</strong> パスワード、クレジットカード情報、お問い合わせ内容などの**個人情報**は必ずPOSTで送信します。</li>
                </ul>
            </div>

            <!-- セクション3：1行入力欄と主要な属性 -->
            <div class="note-section">
                <h3 class="note-title">1行入力欄（&lt;input&gt;タグ）と重要属性</h3>
                <p>原則として <code>&lt;input&gt;</code> タグは閉じタグを持ちません。<code>type</code> 属性の値を切り替えることで様々な入力欄を出力します。</p>
                
                <p style="margin-top: 15px;"><strong>■ 代表的な type 属性の値</strong></p>
                <ul>
                    <li><code>text</code>：制限のない通常のテキスト入力欄。</li>
                    <li><code>password</code>：入力文字が「●」などの伏せ字になる欄。</li>
                    <li><code>tel</code>：電話番号用。スマホ等で数字キーボードが起動しやすくなります。</li>
                    <li><code>email</code>：メールアドレス用。形式チェックが自動で行われます。</li>
                    <li><code>date</code> / <code>time</code>：クリックするとカレンダーや時計の選択画面が立ち上がります。</li>
                </ul>

                <p style="margin-top: 20px;"><strong>■ フォーム部品に付与する重要な属性</strong></p>
                <ul>
                    <li><strong><code>name</code> 属性【必須】：</strong> サーバー側でデータを受け取るための「名前」です。サーバーには <code>name属性値 と 入力値</code> がセットで届きます。半角英数とアンダースコア（ <code>_</code> ）で命名します。</li>
                    <li><strong><code>required</code> 属性：</strong> 値を持たない属性で、記述するだけで必須入力欄になります。未入力で送信ボタンを押すとブラウザが警告を出します。</li>
                    <li><strong><code>placeholder</code> 属性：</strong> 入力欄にうっすらと表示されるグレーのヒント文字です。ユーザーが入力を始めると自動で消えます。</li>
                    <li><strong><code>size</code> 属性：</strong> 入力欄の横幅を半角文字数単位で指定します（※現在のWeb制作ではCSSで横幅を制御するのが一般的です）。</li>
                </ul>
            </div>

            <!-- セクション4：選択系部品（ラジオボタン・チェックボックス・セレクトボックス） -->
            <div class="note-section">
                <h3 class="note-title">選択系部品のマークアップルール</h3>
                <p>ユーザーが自由入力せず、用意された項目から選ぶ部品の解説です。</p>
                
                <div class="sub-heading">① ラジオボタン（単一選択）</div>
                <p><strong>同一の <code>name</code> 属性値</strong>を持つ <code>&lt;input type="radio"&gt;</code> の中から、ユーザーは1つだけしか選択できません。</p>
                <ul>
                    <li>ユーザーが文字を入力しないため、サーバーに送信したい値をあらかじめ <strong><code>value</code> 属性</strong> で指定しておく必要があります。</li>
                    <li>最初から選択状態にしておきたい項目には <strong><code>checked</code></strong> 属性を付与します。</li>
                </ul>

                <div class="sub-heading">② チェックボックス（複数選択可能）</div>
                <p><code>&lt;input type="checkbox"&gt;</code> を使用します。1つの項目（質問）に対して複数の答えをサーバーに送信することが多いため、PHPなどのプログラム側でデータを受け取りやすいよう、<strong><code>name="hobby[]"</code> のように名前の末尾に <code>[]</code>（配列形式）を付ける</strong>のがルールです。</p>

                <div class="sub-heading">③ セレクトボックス（プルダウン式）</div>
                <p><code>&lt;select&gt;</code> タグの中に、各項目となる <code>&lt;option&gt;</code> タグを並べます。</p>
                <ul>
                    <li>項目をグループ化したい場合は <code>&lt;optgroup&gt;</code> タグで囲います。</li>
                    <li>最初から選択された状態にしたい項目には <strong><code>selected</code></strong> 属性を指定します。</li>
                </ul>
            </div>

            <!-- セクション5：複数行入力と特殊ボタン -->
            <div class="note-section">
                <h3 class="note-title">複数行入力（textarea）とボタン各種</h3>
                
                <p><strong>■ 複数行入力欄（<code>&lt;textarea&gt;</code>）</strong></p>
                <p>閉じタグが存在しますが、タグの間に文章を用意することは稀です（書いた文字は初期値として扱われます）。入力例を表示したい場合は <code>placeholder</code> 属性を利用します。</p>
                <ul>
                    <li>サイズ指定には <code>cols</code>（1行の文字数）と <code>rows</code>（行数）属性がありますが、現在のブラウザではユーザーがドラッグで自由にサイズ変更可能です（CSSの <code>resize: none;</code> で固定も可能）。</li>
                </ul>

                <p style="margin-top: 20px;"><strong>■ 各種ボタン（<code>&lt;button&gt;</code> または <code>&lt;input&gt;</code>）</strong></p>
                <p><code>type</code> 属性の値によってボタンの挙動を制御します。CSSで自由にサイズやデザインを変更できます。</p>
                <ul>
                    <li><code>submit</code>：フォーム内のデータを <code>action</code> 先のファイルへ送信します（デフォルト挙動）。</li>
                    <li><code>reset</code>：フォーム内に入力された内容をすべて初期状態（全消去）に戻します。</li>
                    <li><code>button</code>：そのままでは何も起きません。JavaScriptと連携させて独自の処理を動かす際に使用します。</li>
                </ul>
                
                <p style="margin-top: 15px; font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
                    <strong>💡 実践プロのワンポイント補足：</strong><br>
                    ボタンを作る際、<code>&lt;input type="submit" value="送信"&gt;</code> という書き方もありますが、現在のモダンなWeb制作では <code>&lt;button type="submit"&gt;送信&lt;/button&gt;</code> のようにbuttonタグで囲む書き方が推奨されます。buttonタグを使うと、ボタンの中にアイコン画像（<code>&lt;img&gt;</code>）を入れるなど、デザインの自由度が劇的に上がるためです。
                </p>
            </div>

        </main>

        <!-- 右側：更新履歴 -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
