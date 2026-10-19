<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/24(金)の職業訓練授業ノートです。floatとclearによる回り込み制御、各種疑似要素（before, after, first-letter, first-line）の装飾、およびレイアウト実習についてまとめています。">
    <title>CSSのfloat・疑似要素の活用とFlexboxによる複数カラムレイアウト | 職業訓練及び自主学習</title>
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
            <h2>7/24(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">floatによる要素の回り込みとclearfixの自動解除、CSSで文字を追加・装飾する各種疑似要素、および複数カラムのレイアウト実践</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">1. フロート（float）とクリア（clear）の原則</h3>
                <p>要素を左右の壁に「浮かせて（フロート）」、後続のコンテンツをその反対側に回り込ませるプロパティです。</p>
                <div class="info-box">
                    <strong>⚠️ 現代のWeb制作におけるfloatの立ち位置：</strong><br>
                    昔はサイト全体の骨組み（2カラムや3カラム）を作るために無理やり多用されていましたが、現在はより優れた <code>Flexbox</code> や <code>Grid</code> が普及したため、全体レイアウトにfloatを使うことはほぼありません。<br>
                    現在は本来の目的である<strong>「ブログ記事の中で、写真の横に文章を綺麗に回り込ませる」</strong>というピンポイントな装飾目的のみで使用されます。
                </div>

                <div class="sub-heading">■ floatを正しく扱うための絶対ルール</div>
                <ul>
                    <li><strong>横並びしたい要素すべてに指定する：</strong> 並べたいボックスすべてに対して <code>float</code> と <code>width</code>（横幅）の2つをセットで指定します。widthを指定しないと、初期値の100%幅で広がってしまい横に並ぶことができません。</li>
                    <li><strong>親ボックスと解除（clear）のセット：</strong> 横並びにする子要素たちを包み込む「親ボックス」が必須となります。floatした子要素は宙に浮いてしまうため、親ボックスが子要素の「高さ」を見失って潰れる重大なバグが起きます。それを防ぐため、親ボックスの最後（ <code>::after</code> ）で必ず <code>clear</code>（フロート解除）を行います。</li>
                </ul>

                <div class="sub-heading">■ プロパティの設定値</div>
                <ul>
                    <li><strong><code>float: left;</code></strong> ➔ 要素が左に浮き、後続の文章や要素は**右側**へと回り込みます。</li>
                    <li><strong><code>float: right;</code></strong> ➔ 要素が右に浮き、後続の文章や要素は**左側**へと回り込みます。</li>
                    <li><strong><code>clear: both;</code></strong> ➔ 左右どちらのフロート状態も完全に終了（解除）させます。実務では、left/rightに関わらず一発で安全に解除できる <code>both</code> が一般的に最も多く使用されます。</li>
                </ul>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">2. 疑似要素（Pseudo-elements）による文字の追加と装飾</h3>
                <p>HTMLのソースコードに直接テキストを書き足すことなく、CSSの力だけで文字を新しく生み出したり、特定の位置だけをピンポイントで装飾できる仕組みです。</p>

                <div class="sub-heading">■ <code>::before</code> と <code>::after</code>（文字やアイコンの追加）</div>
                <ul>
                    <li><strong><code>::before</code>：</strong> 指定した要素の「中身の先頭」に、擬似的なコンテンツを挿入します。</li>
                    <li><strong><code>::after</code>：</strong> 指定した要素の「中身の最後尾」に、擬似的なコンテンツを挿入します。</li>
                    <li><strong><code>content</code> プロパティ：</strong> 挿入する文字や記号は、必ずこの <code>content: "表示したい文字";</code> の中に記述する厳格なルールがあります。</li>
                </ul>

                <p><strong>【記述例】</strong></p>
                <pre><code>/* HTML */
&lt;p class="alert"&gt;締切は明日です。&lt;/p&gt;

/* CSS */
.alert::before {
    content: "【注意！】"; /* CSSの力で文頭に文字を自動追加 */
    color: red;            /* 赤文字にする */
    font-weight: bold;     /* 太字にする */
}</code></pre>
                <p>【実際のブラウザ表示結果】</p>
                <p class="sample-before" style="font-size: 15px; padding-left: 10px;">締切は明日です。</p>

                <div class="sub-heading">■ <code>::first-letter</code> と <code>::first-line</code>（特定位置の装飾）</div>
                <ul>
                    <li><strong><code>::first-letter</code>：</strong> 対象の要素（段落など）の**「1行目の1文字目だけ」**にスタイルを指定します。海外の雑誌のように、小説の冒頭の1文字目だけを巨大化（ドロップキャップ）させるお洒落なデザインで頻繁に使われます。</li>
                    <li><strong><code>::first-line</code>：</strong> 対象の要素の**「1行目全体だけ」**にスタイルを指定します。画面幅が伸び縮みして1行目に入る文字数が変わっても、ブラウザが自動判定して「その時の1行目」の文字色や太さを自動変更してくれます。</li>
                </ul>
                <p>【first-letter の表示サンプル】</p>
                <p class="sample-letter">職業訓練の授業は毎日新しい発見の連続です。HTMLやCSSの文法を基礎からしっかり学ぶことで、裏側の仕組みが分かります。</p>
                <div style="clear: both;"></div>
            </div>
            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">3. 【実技テスト】floatを使用したナビゲーション横並び</h3>
                <p>実際の授業内で、リスト（ <code>li</code> ）を <code>float: left;</code> で浮かせ、親要素で自動解除（clearfix）を行うテストを行いました。その際のソース構造の解説です。</p>

                <div class="sub-heading">■ 実技検証のソースコード</div>
                <p><strong>【HTML記述】</strong></p>
                <pre><code>&lt;nav&gt;
  &lt;ul class="clear-fix"&gt; &lt;!-- 💡親要素に解除用のクラス名「clear-fix」を付与 --&gt;
    &lt;li&gt;■ 会社概要&lt;/li&gt;
    &lt;li&gt;■ 求人情報&lt;/li&gt;
    &lt;li&gt;■ 注意事項&lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;</code></pre>

                <p><strong>【CSS記述】</strong></p>
                <pre><code>/* 子要素のリストを左へ浮かせて横並びにする */
nav &gt; ul &gt; li {
    width: 150px;
    float: left;
    list-style: none;
}

/* 💡【重要】親要素の最後尾に、擬似要素でフロートを安全に自動解除する記述 */
.clear-fix::after {
    display: block;
    content: "";
    clear: both;
}</code></pre>

                <div class="sub-heading">■ 【超重要】プロの必須技術「clearfix（クリアフィックス）」とは</div>
                <p>上記のCSSに出てくる <code>.clear-fix::after</code> の記述は、Web業界で数十年使われている伝統的なバグ回避テクニック（clearfix）です。</p>
                <div class="info-box">
                    <strong>💡 clearfixの仕組み：</strong><br>
                    子要素がすべて <code>float</code> すると、親の <code>ul</code> は中身の「高さ」を計算できなくなり、高さが0pxに潰れてしまいます。その結果、次に続くフッターや関係ない文章が、浮いたリストの裏側に潜り込んで画面がぐちゃぐちゃに崩壊します。<br><br>
                    これを防ぐため、親の <code>::after</code>（中身の最後尾）に、CSSの力で中身が空っぽ（ <code>content: "";</code> ）のブロックの壁（ <code>display: block;</code> ）を自動生成し、そこで <code>clear: both;</code> を発動させます。これにより、HTMLを汚すことなく、親ボックスの中でフロートの回り込みを強制終了させ、高さを正しく保つことができます。
                </div>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">4. 【実技テスト2】floatを用いたメイン・サイドの2カラム構築</h3>
                <p>実際に2つの異なる幅を％で指定し、左右にそれぞれfloatさせてフッターと綺麗に切り離すレイアウト検証のコードです。</p>

                <p><strong>【HTML記述】</strong></p>
                <pre><code>&lt;div id="wrapper"&gt;
  &lt;main class="clear-fix"&gt; &lt;!-- 💡親にclearfixを指定 --&gt;
    &lt;section id="col1"&gt;
      &lt;h2&gt;見出し&lt;/h2&gt;
      &lt;p&gt;テキスト&lt;/p&gt;
    &lt;/section&gt;
    &lt;section id="col2"&gt;
      &lt;h2&gt;見出し2&lt;/h2&gt;
      &lt;ul&gt;
        &lt;li&gt;リスト１&lt;/li&gt;
        &lt;li&gt;リスト２&lt;/li&gt;
      &lt;/ul&gt;
    &lt;/section&gt;
  &lt;/main&gt;
  &lt;footer&gt;
    &lt;p&gt;&lt;small&gt;copyright&lt;/small&gt;&lt;/p&gt;
  &lt;/footer&gt;
&lt;/div&gt;</code></pre>

                <p><strong>【CSS記述】</strong></p>
                <pre><code>div { margin: 0; padding: 0; }
li { list-style: none; }

/* 全体の幅を1000pxにして画面中央に寄せる */
#wrapper {
    width: 1000px;
    margin: 0 auto;
    background: rgba(0, 0, 255, 0.1);
}

/* 親ボックスの横幅を指定 */
main {
    width: 800px;
}

/* メインコンテンツ（左側）を全体の「48%」の幅で左に寄せる */
#col1 {
    width: 48%;
    float: left;
    background: rgba(255, 0, 0, 0.1);
}

/* サイドバー（右側）を全体の「35%」の幅で右に寄せる */
#col2 {
    width: 35%;
    float: right;
    background: rgba(0, 255, 0, 0.1);
}

/* 浮いた2つのボックスのせいでフーターが潜り込まないよう自動解除 */
.clear-fix::after {
    display: block;
    content: "";
    clear: both;
}</code></pre>
            </div>
            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">5. 【課題・実習】3カラムレイアウトの2通りの実装アプローチ</h3>
                <p><strong>【お題】</strong> col1、col2、col3 の3つのボックス（各幅300px）を配置し、全体の総横幅は1000pxとする。すべての要素の間に、きっちり「25px」の隙間（余白）を空けて綺麗に横並びさせなさい。</p>

                <p><strong>【HTML共通構造】</strong></p>
                <pre><code>&lt;main&gt;
  &lt;section id="col1"&gt; &lt;h2&gt;見出し&lt;/h2&gt; &lt;p&gt;テキスト&lt;/p&gt; &lt;/section&gt;
  &lt;section id="col2"&gt; &lt;h2&gt;画像エリア（width: 300px）&lt;/h2&gt; &lt;/section&gt;
  &lt;section id="col3"&gt; &lt;h2&gt;見出し&lt;/h2&gt; &lt;dl&gt;&lt;dt&gt;商品名&lt;/dt&gt;&lt;dd&gt;商品説明&lt;/dd&gt;&lt;/dl&gt; &lt;/section&gt;
&lt;/main&gt;</code></pre>

                <div class="sub-heading">💡 アプローチA： 伝統的な「float」と「margin」で解く場合</div>
                <p>各ボックスに <code>float: left;</code> を指定し、要素の間にだけ隙間が空くように <code>margin-right</code> を緻密に計算して配置します。また、親のmainには高さを保つために <code>class="clear-fix"</code> をつけておく必要があります。</p>
                <pre><code>/* 親ボックスの幅を1000pxに固定 */
main {
    width: 1000px;
}

/* 3つすべてを幅300pxにして左へ寄せる */
#col1, #col2, #col3 {
    width: 300px;
    float: left;
}

/* 1番目と2番目のボックスの「右側」にだけ25pxの隙間を空ける（300&times;3 + 25&times;2 = 1000px） */
#col1, #col2 {
    margin-right: 25px;
}

/* 親要素のclearfixを忘れずに記述 */
main::after {
    display: block;
    content: "";
    clear: both;
}</code></pre>

                <div class="sub-heading">💡 アプローチB： 現代的な「Flexbox」で美しく解く場合（推奨）</div>
                <p>floatのような面倒な個別マージン計算や、clearfixによる解除処理は一切不要になります。親要素に <code>display: flex;</code> を指定し、隙間を空ける専用の <code>gap</code> プロパティを指定するだけで一瞬で完璧に解決します。</p>
                <pre><code>/* 親要素をフレキシブルボックスにして、要素間の隙間を25pxに指定 */
main {
    display: flex;
    width: 1000px;
    gap: 25px; /* 💡 これだけで全ての要素の間に自動で25pxの均等な隙間が空きます！ */
}

/* 各子要素は純粋に幅300pxを指定するだけで並びます */
#col1, #col2, #col3 {
    width: 300px;
}</code></pre>

                <div class="info-box">
                    <strong>📊 プロとしての考察・まとめ：</strong><br>
                    floatを使った場合は、3つの合計幅（900px）と余白2つ（50px）を足した合計が950pxになり、全体の1000pxに対して「右端に50pxの不自然な余白」が余ってしまいます。これを等間隔にするにはマージンを少数点まで細かく計算し直す必要があります。<br><br>
                    それに対し、Flexboxであれば <code>justify-content: space-between;</code> を併用するか、<code>gap</code> を使うことで、余った空き領域をブラウザが自動計算してパーフェクトに美しく引き離してくれます。現代のWebコーディングにおいて、なぜFlexboxが圧倒的に主流なのかがこの実習を通して深く理解できます。
                </div>
            </div>
            <p style="margin-top: 25px;">
                <a href="0706_0914.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>
        </main>

   </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>