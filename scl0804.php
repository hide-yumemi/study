<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/4(火)の職業訓練授業ノートです。CSSのborder-radiusプロパティを用いたボックスの角丸表現（正円・楕円）や、個別指定・一括指定の記述ルールをまとめています。">
    <title>8/4(火)職業訓練授業：border-radiusによる角丸表現 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            <h2>8/4(火) 職業訓練授業ノート（CSS編）</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                デザインの幅を広げる <code>border-radius</code> プロパティの構造、正円と楕円の書き分け、ショートハンド（一括指定）の規則性のまとめです。
            </p>

            <!-- セクション1：border-radiusの基本 -->
            <div class="note-section">
                <h3 class="note-title">border-radiusプロパティの基本</h3>
                <p>
                    <code>border-radius</code> プロパティは、ボックス（要素）の四隅の角を丸めるために使用します。
                </p>
                <p>
                    仕組みとしては、**「角の裏側に仮想の円（または楕円）を配置し、その円のフチに沿って角を削り落とす」** というイメージです。そのため、指定する数値は「円の半径」を意味しており、値が大きくなるほど角丸のカーブが緩やか（大きく）になります。
                </p>
                
                <p style="margin-top: 15px;"><strong>■ 個別指定（4つの角の正式名称）</strong></p>
                <p>四隅の角は、それぞれ個別にプロパティ名が用意されています。指定する値には <code>px</code> などの絶対単位のほか、要素のサイズに対する <code>%</code>（パーセント）も使用可能です。</p>
                
                <div class="sub-heading">角の指定位置と名称（時計回り順）</div>
                <ol>
                    <li><strong><code>border-top-left-radius</code>：</strong> 左上の角丸</li>
                    <li><strong><code>border-top-right-radius</code>：</strong> 右上の角丸</li>
                    <li><strong><code>border-bottom-right-radius</code>：</strong> 右下の角丸</li>
                    <li><strong><code>border-bottom-left-radius</code>：</strong> 左下の角丸</li>
                </ol>

                <div class="radius-test" style="margin-top: 20px;">
                    <p><strong>💡 記述例：</strong></p>
                    <ul>
                        <li><code>{ border-top-left-radius: 30px; }</code> ➔ 左上を半径30pxの円で丸める</li>
                        <li><code>{ border-top-left-radius: 40%; }</code> ➔ 要素の幅・高さの40%を半径として丸める</li>
                    </ul>
                </div>
            </div>

            <!-- セクション2：一括指定（正円ショートハンド） -->
            <div class="note-section">
                <h3 class="note-title">一括指定（ショートハンド）の規則性</h3>
                <p><code>border-radius</code> は、半角スペースで区切って複数の値を並べることで、1行で四隅を同時に指定できます。値の数によって適用される場所が変わるルール（規則性）があります。</p>
                
                <div class="sub-heading">① 値が1つの場合（全角一括）</div>
<pre><code>/* 4つの角すべてに同じ値を適用 */
border-radius: 10px;</code></pre>

                <div class="sub-heading">② 値が2つの場合（対角線のセット）</div>
                <p>2本の対角線（左上から右下、右上から左下）のセットで適用されます。</p>
<pre><code>/* 【値1】左上 と 右下 | 【値2】右上 と 左下 */
border-radius: 10px 20px;</code></pre>

                <div class="sub-heading">③ 値が3つの場合（対角線の一方が独立）</div>
<pre><code>/* 左上 | 右上 と 左下（共通） | 右下 */
border-radius: 10px 20px 30px;</code></pre>

                <div class="sub-heading">④ 値が4つの場合（完全独立・時計回り）</div>
                <p>左上からスタートして、時計回りの順番で個別に適用されます。</p>
<pre><code>/* 左上 | 右上 | 右下 | 左下（① ➔ ② ➔ ③ ➔ ④ の順） */
border-radius: 10px 20px 30px 40px;</code></pre>
            </div>

            <!-- セクション3：楕円の指定（スペースとスラッシュの使い分け） -->
            <div class="note-section">
                <h3 class="note-title">高度な表現：楕円（だえん）の指定ルール</h3>
                <p>角を丸める際の仮想円を「真ん丸（正円）」ではなく「歪んだ円（楕円）」にすることで、より有機的でモダンなデザインを表現できます。楕円にするには**「横方向の半径」と「縦方向の半径」の2つの値**が必要です。</p>
                
                <div class="sub-heading">① 個別指定の場合（半角スペース区切り）</div>
                <p>プロパティに対して <code>横の半径 縦の半径</code> の順に半角スペースで区切って指定します。</p>
<pre><code>/* 左上を縦長の楕円にする（縦の半径を大きく） */
border-top-left-radius: 10px 30px;

/* 右上を横長の楕円にする（横の半径を大きく） */
border-top-right-radius: 40px 10px;</code></pre>

                <div class="sub-heading">② 一括指定（ショートハンド）の場合（スラッシュ区切り）</div>
                <p>一括指定で楕円を表現する場合は、<strong><code>横方向の半径群 / 縦方向の半径群</code></strong> のように、スラッシュ（ <code>/</code> ）を使って横と縦の情報を完全に分離して記述します。</p>
<pre><code>/* 全体の角を「横10px / 縦20px」の楕円にする */
border-radius: 10px / 20px;

/* スラッシュの前後でそれぞれ1〜4つの値を組み合わせて複雑な変形も可能 */
border-radius: 10px 20px / 30px 40px;</code></pre>
                
                <p class="note" style="font-size: 13px; color: #b91c1c; background-color: #fff5f5; padding: 10px; border-radius: 6px; margin-top: 15px;">
                    ⚠️<strong>超重要ルール：</strong><br>
                    個別指定プロパティでは楕円の値を<strong>「半角スペース」</strong>で区切りますが、一括指定（<code>border-radius</code> 単体）では<strong>「スラッシュ」</strong>で区切るという文法上の決定的な違いがあります。模試や実戦でも非常に間違えやすいポイントです。
                </p>
            </div>

            <!-- セクション4：実践テクニック（完全に丸い「正円」を作る） -->
            <div class="note-section">
                <h3 class="note-title">実践テクニック：CSSで完璧な「正円（アイコンなど）」を作る方法</h3>
                <p>
                    Webデザインでよく見かける「丸いプロフィール画像」や「丸いボタン」を作るには、ただ大きな数値を指定するだけでは綺麗な円になりません。
                </p>
                <div class="sub-heading">正円を作るための絶対条件</div>
                <ol>
                    <li>丸めたい要素の横幅（<code>width</code>）と高さ（<code>height</code>）の数値を**完全に一致（正方形）**させる。</li>
                    <li><code>border-radius</code> の値を **<code>50%</code>** に指定する。</li>
                </ol>
                <p style="margin-top: 10px;">
                    これにより、正方形の縦横それぞれの中心（50%）から均等に角が削られるため、歪みのない完璧な正円を出力できます。
                </p>
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
