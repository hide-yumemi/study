<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/16(木)の職業訓練授業ノートです。font-familyの設定方法、Google Fontsの導入手順、およびfont一括指定（ショートハンド）の絶対ルールについてまとめています。">
    <title>フォントの指定方法とテキスト装飾・一括指定のルール | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./scl_style.css">
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（共通CSSの2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h2>7/16(木) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">font-familyによる表示の統一化、外部Webフォントの導入、およびfontプロパティ一括指定時の厳格なルール</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">font-family プロパティ（フォントの指定方法）</h3>
                <p>Webページに使うフォントの種類（書体）を指定しない場合、閲覧しているユーザーのブラウザの標準設定で表示されてしまいます 。フォントが変わると文字の形や余白の大きさが変わり、デザイン崩れを起こす原因になるため、CSS側で厳格に指定します 。</p>
                
                <div class="sub-heading">■ フォント指定の必須ルール</div>
                <ul>
                    <li><strong>3種以上のフォントを指定する：</strong> Windows用、Mac用、そしてどちらのフォントも内蔵していないパソコン環境用に最低3つの種類を並べて記述する 。</li>
                    <li><strong>総称ファミリー名で締めくくる：</strong> 指定したフォントがすべてPCに入っていなかった場合の最終手段として、末尾にゴシック体なら <code>sans-serif</code>、明朝体なら <code>serif</code> などの総称ファミリー名を書く 。</li>
                    <li><strong>ライセンスの確認：</strong> Google FontsなどのWebフォントを使用する場合は、必ず有料・無料の規約（ライセンス）を確認した上で提供元の指示に従う 。</li>
                </ul>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">Google Fonts の具体的な使い方</h3>
                <p>世界中のモダンなデザイナーに愛用されている、Googleの無料外部Webフォントの導入手順です 。</p>
                <ol>
                    <li><a href="https://google.com" target="_blank" rel="noopener noreferrer">Google Fonts（https://google.com）</a> にアクセスし、好みのフォントを探す 。</li>
                    <li>フォントを選択し、<strong>「GET font」</strong> ➔ <strong>「GET」</strong> ➔ <strong>「embed code」</strong> の順にクリックして進める 。</li>
                    <li>画面に表示された <code>&lt;link&gt;</code> タグ（HTML用コード）をHTMLの <code>&lt;head&gt;</code> 内に貼り付ける 。</li>
                    <li>指定されたフォントファミリーのコード（CSS用コード）を、CSSファイル側の適用したいセレクタに貼り付けることで利用可能になります 。</li>
                </ol>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">font 一括指定（ショートハンド）の絶対ルール</h3>
                <p>文字に関するスタイルを1行の <code>font</code> プロパティにまとめて記述（一括指定）する場合、非常に厳格な文法ルールが存在します 。</p>
                
                <div class="alert-box">
                    ⚠️ 必須条件：【font-size】と【font-family】の2つは絶対に省略できません！どちらか1つでも抜けると、記述したスタイル全体が完全に無効化（無視）されます。
                </div>

                <div class="sub-heading">■ 記述する値の正しい順番</div>
                <p>一括指定する際は、必ず以下の順番通りに値を半角スペースで区切って記述する必要があります 。</p>
                <pre><code>p {
    font: font-style font-variant font-weight font-size/line-height font-family;
}</code></pre>

                <div class="sub-heading">■ 具体的な記述例</div>
                <p><strong>・フルで指定する場合（個別記述を1行に凝縮）</strong></p>
                <pre><code>p { font: italic normal bold 16px/1.7 "Hiragino Sans", sans-serif; }</code></pre>
                
                <p style="margin-top: 20px;"><strong>・実務でよく使われる省略形（サイズ、行高、フォントのみ）</strong></p>
                <p>バラバラに書くと以下のようになりますが、</p>
                <pre><code>p {
    font-size: 1.6rem;
    line-height: 1.7;
    font-family: "Hiragino Sans", sans-serif;
}</code></pre>
                <p>一括指定（ショートハンド）を使うと、以下のようにたった1行ですっきりと記述できます 。</p>
                <pre><code>p { font: 1.6rem/1.7 "Hiragino Sans", sans-serif; }</code></pre>
            </div>
            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">その他のフォント・テキスト関連プロパティ</h3>
                <p>文字の隙間や行の間隔、文章の配置をコントロールして読みやすさを向上させるためのプロパティです 。</p>

                <div class="sub-heading">① <code>font-variant</code>（スモールキャップス）</div>
                <p>アルファベットの小文字の形状を、「小さな大文字（スモールキャップス）」の形へと変更します 。値には <code>small-caps</code> を指定します 。</p>

                <div class="sub-heading">② <code>line-height</code>（行の高さ・上下の余白）</div>
                <p>行の間隔を指定します 。値には「単位なしの倍率（推奨）」、「%」、「rem / em」などが使用可能です 。<br>
                <code>p { line-height: 1.5; }</code> と記述すると、文字サイズに対して1.5倍の行高になり、文字の上下に均等な余白が生まれるため、文章が劇的に読みやすくなります 。</p>

                <div class="sub-heading">③ <code>letter-spacing</code>（文字の間隔）</div>
                <p>「見出し ➔ 見 出 し」のように、文字と文字の間の横の隙間（間隔）を広げることができます 。値には <code>rem</code> や <code>em</code> などの単位を使用しますが、文字サイズに比例して柔軟に連動する <strong><code>em</code> 単位</strong> を使うのが一般的です 。</p>

                <div class="sub-heading">④ <code>text-align</code>（文中の横位置・配置）</div>
                <p><code>h1</code> や <code>p</code> などの**ブロックコンテナ要素のタグ（外側の箱）に対して使用**し、その中にあるインラインコンテンツ（文字など）の水平方向の配置を指定します 。<code>strong</code> などのインライン要素自体に直接指定しても効果はありません 。</p>
                <ul>
                    <li><code>left</code> ： 左寄せ（デフォルト） </li>
                    <li><code>right</code> ： 右寄せ </li>
                    <li><code>center</code> ： 中央寄せ </li>
                    <li><code>justify</code> ： **均等割付**。複数行にわたる長文の左右の端をピシッと綺麗に揃えます 。</li>
                    <li><code>start</code> / <code>end</code> ： その国の言語（文章の書き方）の先頭、または末尾に寄せます 。</li>
                </ul>
            </div>

            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">【授業の実技 検証】の解説</h3>
                <p>授業内の実技で行ったフォントの検証と、CSSの優先度に関する重要な考察のまとめです 。</p>
                
                <div class="sub-heading">■ 実技での表示テスト</div>
                <ul>
                    <li>これは <code>Kaisei Decol</code> というフォント（美しい明朝体風のGoogle Fonts） </li>
                    <li>これは <code>Rampart One</code> というフォント（立体風の影文字デザインのGoogle Fonts） </li>
                    <li>これは <code>{ font-variant: small-caps; }</code> を適用した英字（見た目 ➔ ABCabcの形状変化） </li>
                </ul>

                <div class="sub-heading">■ 【重要考察】一括指定でGoogle Fontsが適用されなかった理由</div>
                <p>授業の実技において、「一括指定（ショートハンド）でフォントを設定したのに、なぜかGoogle Fontsの見た目が反映されずリセットされてしまった」というバグが発生しました 。その理由は、**CSSのセレクタの強さ（適用優先度の点数）**が原因です 。</p>
                
                <div class="info-box">
                    <p><strong>💡 バグの原因と解決メカニズム:</strong><br>
                    別で細かく記述していたGoogle Fontsの指定よりも、後から読み込まれた、または合計点数の高いセレクタの一括指定コードが優先されてしまったため、フォント設定が上書き（上書きリセット）されてしまいました 。<br>
                    優先度が全く同じ場合は、「後から読み込まれたもの」が勝つため、記述する順番を入れ替えるか、セレクタの点数を高くしてあげることでこのバグを解決できます 。</p>
                </div>

                <div class="sub-heading">■ <code>text-align: justify;</code> の検証効果</div>
                <p style="text-align: justify; background-color: #f8fafc; padding: 15px; border-radius: 8px; border: 1px dashed #cbd5e1;">
                    <strong>【実際の見栄えテスト】</strong> この文章ブロックには <code>{ text-align: justify; }</code> が適用されています 。このようにある程度の長さがあるテキストを記述した際、画面の右端と左端がガタガタにならず、定規で引いたようにピシッと綺麗に揃って配置されるのが確認できます 。ポートフォリオサイトの長文でも非常に有効なプロの手法です。
                </p>
            </div>

        </main>

        <!-- 右側：更新履歴（共通パーツ history.php を呼び出し、右横並びにします） -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
