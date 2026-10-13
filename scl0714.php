<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/14(金)の職業訓練授業ノートです。CSSの基本、class属性、セレクタの優先順位（点数計算ルール）、および文字に関するスタイル指定についてまとめています。">
    <title>CSSの基本構造とクラス属性・スタイルの優先順位 | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    
    <!-- このページをさらに見やすくするための専用埋め込みスタイル -->
    <style>
        .note-section {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }
        .note-title {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: bold;
            border-left: 5px solid #ff8c00; /* オレンジのアクセント縦線 */
            padding-left: 12px;
            margin-bottom: 15px;
            margin-top: 0;
        }
        .note-section p {
            font-size: 15px;
            color: #334155;
            line-height: 1.7;
            margin-bottom: 12px;
        }
        .note-section p:last-child {
            margin-bottom: 0;
        }
        .note-section ul, 
        .note-section ol {
            padding-left: 20px;
            margin: 12px 0;
        }
        .note-section li {
            font-size: 14.5px;
            color: #475569;
            margin-bottom: 8px;
            line-height: 1.6;
        }
        .note-section li strong {
            color: #1e3a8a;
        }
        code {
            font-family: Consolas, Monaco, monospace;
            background-color: #f1f5f9;
            color: #b91c1c;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
        pre {
            background: #f8fafc;
            padding: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            overflow-x: auto;
            font-family: Consolas, Monaco, monospace;
            font-size: 14px;
            line-height: 1.5;
            margin: 15px 0;
            color: #334155;
        }
        .sub-heading {
            font-size: 16px;
            font-weight: bold;
            color: #1e3a8a;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
        }
        /* 優先度ポイント用のバッジ */
        .score-badge {
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            background-color: #1e3a8a;
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            margin-right: 5px;
        }
        .info-box {
            background-color: #f0f4f8;
            border-radius: 6px;
            padding: 15px;
            margin-top: 15px;
            border-left: 4px solid #64748b;
        }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（共通CSSの2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h2>7/14(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">CSSの記述ルール、重要となる適用優先度の計算方法、および文字装飾に関する各種プロパティ</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">CSS（カスケーディングスタイルシート）の基本</h3>
                <p>Webサイトの装飾やデザイン、レイアウトを指定するための言語です。HTMLに適用する方法は主に3つあります。</p>
                <ul>
                    <li><strong>外部ファイル（推奨）：</strong> 拡張子 <code>.css</code> の別ファイルに記述し、HTMLの <code>&lt;head&gt;</code> 内で <code>&lt;link&gt;</code> タグを用いて読み込む。実務ではこの方法が基本となる。</li>
                    <li><strong>head内のstyleタグ：</strong> <code>&lt;head&gt;</code> 内に <code>&lt;style&gt;</code> タグを用意してその中に書く。</li>
                    <li><strong>インライン指定：</strong> HTMLの各タグの属性（ <code>style="..."</code> ）として直接記述する。</li>
                </ul>
                <p style="margin-top: 15px;">※ 外部CSSファイルは必要な数だけ何個でも同時に読み込むことが可能です。</p>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">class（クラス）属性について</h3>
                <p>要素に固有の名前をつける <code>id属性</code> と似ていますが、<code>class属性</code> にはより柔軟なルールがあります。</p>
                <ul>
                    <li><strong>重複の許可：</strong> ページ内のまったく同じクラス名を、複数の異なるタグに何回でも指定できる。</li>
                    <li><strong>複数指定の許可：</strong> 1つのタグに対して、複数の異なるクラス名を同時に付与することができる。</li>
                    <li><strong>記述方法：</strong> <code>&lt;p class="クラス名"&gt;</code> の形で指定する。idと同様に、<strong>「1文字目の数字はNG」</strong> という厳格なルールがある。</li>
                    <li><strong>2つ以上名付ける場合：</strong> クラス名を複数つける時は、<code>class="クラス名1 クラス名2 クラム名3"</code> のように、名前同士を<strong>半角スペース</strong>で区切って記述する。</li>
                </ul>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">CSSが適用される優先度（点数計算ルール）</h3>
                <p>同じ要素に対して複数の異なるスタイルが指定された場合、ブラウザは「セレクタの種類」を点数化し、合計点が高い方を優先して適用します。</p>
                
                <ul>
                    <li><span class="score-badge">1,000点</span> <strong>インライン指定：</strong> HTMLタグ内に <code>style=""</code> 属性として直接書いたもの。</li>
                    <li><span class="score-badge">100点</span> <strong>id名：</strong> <code>#〜</code> の形で指定するセレクタ。</li>
                    <li><span class="score-badge">10点</span> <strong>class名：</strong> <code>.〜</code> の形で指定するセレクタ。</li>
                    <li><span class="score-badge">1点</span> <strong>タグ名：</strong> <code>p</code> や <code>div</code>、<code>li</code> などタグそのもので指定するセレクタ。</li>
                </ul>
                
                <div class="info-box">
                    <p><strong>⚠️ 優先順位の重要ルール:</strong><br>
                    ・組み合わせた指定は、それぞれの点数を足し算した合計点で競います。<br>
                    ・1点のタグセレクタを10個以上組み合わせて（10点分）指定しても、1つのclass名（10点）に勝つことはできません（桁上がりの概念はありません）。<br>
                    ・計算した結果が完全に<strong>同点の場合</strong>は、コード上で<strong>後から読み込まれた方（下に書かれている記述）</strong>が上書きして優先されます。</p>
                </div>

                <div class="sub-heading">■ セレクタの組み合わせと記号の意味</div>
                <p>例えば、以下のようなHTML構造の <code>&lt;li&gt;</code> 要素に対してスタイルを狙い撃ちする場合：</p>
                <pre><code>&lt;nav&gt;
  &lt;ul id="g_navi"&gt;
    &lt;li&gt;メニューA&lt;/li&gt;
    &lt;li&gt;メニューB&lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;</code></pre>

                <ul>
                    <li><strong><code>nav li</code> （半角スペース区切り）：</strong> 「子孫セレクタ」を意味する。nav要素の配下にある（何階層下でも関係なく）すべてのli要素を指定。</li>
                    <li><strong><code>ul &gt; li</code> （ <code>&gt;</code> 区切り）：</strong> 「子セレクタ」を意味する。ul要素の直下（1階層下）にあるli要素のみを指定。</li>
                    <li><strong><code>ul#g_navi &gt; li</code> （続けて記述）：</strong> 「かつ（AND）」を意味する。ul要素であり、なおかつid名が <code>g_navi</code> である要素の、直下にあるli要素を指定。</li>
                </ul>
            </div>
            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">スタイルの指定方法と基本構文</h3>
                <p>CSSは、以下の基本ルールに従って記述します 。</p>
                <pre><code>選択し指定する場所（セレクタ） {
    プロパティ名: 値;
    プロパティ名: 値;
}</code></pre>

                <p><strong>■ 具体例：</strong></p>
                <pre><code>p {
    color: red;
    font-size: 1rem;
}</code></pre>
                <p>➔ pタグの文字の色を「赤」に、文字サイズを「1rem」に指定するという意味になります 。</p>

                <div class="sub-heading">■ HTML側での外部CSS読み込みコード</div>
                <p><code>&lt;link rel="stylesheet" href="CSSファイルへのパス"&gt;</code></p>
                <div class="info-box">
                    <p><strong>⚠️ CSSファイルの超重要ルール:</strong><br>
                    日本語のコメントアウトなどが文字化けするのを防ぐため、CSSファイルの**「1行目の1文字目」**に、必ず以下の文字コード指定を記述するお作法があります 。<br>
                    <code>@charset "UTF-8";</code></p>
                </div>
            </div>

            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">文字に関するスタイル指定（プロパティ）</h3>
                <p>文字のデザインや表示形式を細かく制御するためのプロパティ群です 。</p>

                <div class="sub-heading">① 色の指定（<code>color</code>）</div>
                <p>文字色を変更する際は <code>color</code> プロパティを使用し、値は主に3種類の方法で指定します 。</p>
                <ul>
                    <li><strong>カラーネーム：</strong> <code>red</code>, <code>green</code>, <code>blue</code> などの英語名 。</li>
                    <li><strong>10進数（RGB）：</strong> <code>rgb(255, 0, 0)</code> などの形式 。</li>
                    <li><strong>16進数（HEX）：</strong> <code>#FFFFFF</code> や <code>#000000</code> などのコード 。</li>
                </ul>
                <p>※ 現代のWeb制作現場では、カラーネームと16進数指定を組み合わせて使うのが最も一般的です 。</p>

                <div class="info-box">
                    <p><strong>💡 補足：Webセーフカラー（Web Safe Colors）とは</strong><br>
                    パソコンのスペックが低かった昔、あらゆるブラウザで共通して綺麗に表示できると定めた「216色」の安全な色を指します 。値がすべて <code>0, 51, 102, 153, 204, 255</code> のいずれかの組み合わせで作られます 。<br>
                    ※ 現在は機器の性能が大幅に向上したため、実務で意識して考慮することは非常に稀です 。</p>
                </div>

                <div class="sub-heading">② フォントサイズ（<code>font-size</code>）</div>
                <p>文字の大きさを指定するプロパティです 。単位には様々な種類があります 。</p>
                <ul>
                    <li><code>px</code>（ピクセル）：絶対的なサイズ指定。画面解像度に依存するため、現在はレスポンシブの観点から使用を減らす方向になっています 。</li>
                    <li><code>%</code> / <code>em</code>：親要素の文字サイズを基準とした比較比率 。</li>
                    <li><strong><code>rem</code>（レム）：</strong> htmlタグ（ルート）の文字サイズを基準にした比率計算 。<strong>現代のWebデザインにおける主流の単位</strong>です 。ベースは基本的に「1文字 ＝ 16px」となっています 。</li>
                </ul>

                <div class="info-box">
                    <p><strong>⚠️ 【非推奨】過去の古い手法（フォントサイズ計算のバグ対策）</strong><br>
                    昔は計算を簡単にするために、以下のような設定が流行した時期がありました 。
                    <pre><code>html { font-size: 62.5%; } /* 16px &times; 62.5% = 10px に基準を変更 */
body { font-size: 1.6rem; } /* 10px &times; 1.6 = 16px に戻す */</code></pre>
                    こうすると「1rem ＝ 10px」と換算できるため、1.4remなら14px、2.0remなら20pxと脳内計算しやすいメリットがありました 。しかし、この手法は最新のデバイスやブラウザ環境において**表示のバグを誘発するリスクがあるため、現在は非推奨**となっています 。</p>
                </div>

                <div class="sub-heading">③ 文字の太さ（<code>font-weight</code>）</div>
                <p>文字の太さを変更する <code>font-weight</code> プロパティです 。</p>
                <ul>
                    <li><strong><code>normal</code>（数値表現で 400）：</strong> 通常の太さ（デフォルト） 。</li>
                    <li><strong><code>bold</code>（数値表現で 700）：</strong> 太字表記 。</li>
                </ul>
                <p>※ 日本語フォントは、基本的にこの2種類（細かく対応していても数種類）の太さで表現するのが基本となります 。</p>

                <div class="sub-heading">④ 文字のスタイル・表示形式（<code>font-style</code>）</div>
                <p>文字を斜めにするなどの表現を制御する <code>font-style</code> プロパティです 。</p>
                <ul>
                    <li><code>normal</code>：通常の直立した状態 。</li>
                    <li><code>italic</code>：イタリック体（斜体フォント） 。</li>
                </ul>
                <p>※ 日本語のフォントデータには元々斜体のデータが存在しないものが多いため、主にアルファベット（英単語）をお洒落に区別させたい際に力を発揮します 。</p>
            </div>

        </main>

        <!-- 右側：更新履歴（共通パーツ history.php を呼び出し、右横並びにします） -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
