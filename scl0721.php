<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/21(火)の職業訓練授業ノートです。CSSのボックスモデル（margin, padding, border）の仕組み、box-sizingによるサイズ算出、背景色の各種指定方法についてまとめています。">
    <title>CSSボックスモデルの構造（余白・枠線）とサイズ計算のルール | 職業訓練及び自主学習</title>
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
            <h2>7/21(火) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">CSSレイアウトの核となるボックスモデルの構造理解、内外余白の制御、および効率的なサイズ計算手法</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">CSSの基盤：ボックスモデル（Box Model）</h3>
                <p><code>p</code> や <code>h1</code>、リスト（ <code>li</code> ）、各種セクション系のタグなど、ブラウザに表示されるすべての要素は、四角い「箱（ボックス）」の構造を持っています 。この概念をボックスモデルと呼びます 。</p>
                
                <!-- 視覚支援：ユーザーが添付した画像をCSSの入れ子ボックスで擬似再現 -->
                <div class="visual-box-model">
                    <div class="visual-margin-text">⬇ margin（枠線の外側の余白 / 透明）</div>
                    <div class="visual-border">
                        <div class="visual-border-text">⬜ border（境界線となる枠線）</div>
                        <div class="visual-padding-text">⬇ padding（枠線の内側の余白 / 背景色がのる領域）</div>
                        <div class="visual-content">
                            コンテンツ（テキスト・画像等）の表示領域<br>
                            <span style="font-size: 11px; color:#666;">width（横幅） &times; height（高さ）</span>
                        </div>
                    </div>
                </div>

                <div class="sub-heading">■ 各要素の役割と関係</div>
                <ul>
                    <li><strong>コンテンツ表示領域（width / height）：</strong> テキストや画像が実際に表示される一番内側のコア領域 。高さ（height）の初期値は、中の要素に応じた必要最低限の高さ（ <code>auto</code> ）になります 。</li>
                    <li><strong>パディング（padding）：</strong> 枠線の**内側**にある、コンテンツの周りの余白 。背景色や背景画像を指定した場合、このパディングの領域まで色が染まります 。</li>
                    <li><strong>ボーダー（border）：</strong> パディングとマージンの境界線となる**枠線自体**を指します 。</li>
                    <li><strong>マージン（margin）：</strong> 枠線の**外側**にある、隣り合う他の要素との間の余白 。要素同士の距離を離すために使い、背景色はのりません（常に透明） 。</li>
                </ul>

                <div class="sub-heading">■ ボックスサイズの算出方法（<code>box-sizing</code>）</div>
                <p>初期値の状態では、CSSで指定した <code>width</code> は一番内側の「コンテンツ領域の幅」のみを指します 。そのため、枠線（border）やパディング（padding）を足し算すると、要素全体の総横幅が指定サイズよりも外側にはみ出して大きくなってしまいます 。</p>
                <div class="info-box">
                    <p><strong>💡 <code>box-sizing: border-box;</code> の必須化:</strong><br>
                    CSSの一番最初（ユニークセレクタ <code>*</code> など）で <code>box-sizing: border-box;</code> を指定すると、<strong>「widthの数値の中に、paddingとborderの厚みが最初から含まれる」</strong> という計算方法に切り替わります 。これにより、サイズ計算のズレが完全になくなり、スマホサイトなどのレスポンシブ対応が劇的に楽になるため、現在のWeb制作では必須の設定です 。</p>
                </div>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">背景色の指定（rgbaのモダンな記述方法）</h3>
                <p>要素の背景に関するプロパティの使い分けと、透明度の指定ルールです 。</p>
                <ul>
                    <li><strong><code>background-color</code> （単一指定）：</strong> 背景の色「のみ」をピンポイントで指定するプロパティ 。他の背景画像や配置の設定に影響を与えたくない場合に適しています 。</li>
                    <li><strong><code>background</code> （一括指定・ショートハンド）：</strong> 色、画像（url）、位置、サイズ、反復方法などを、スペース区切りで1行にまとめて記述できる便利なプロパティです 。</li>
                </ul>

                <div class="sub-heading">■ 透過（アルファチャンネル）を扱う新しい書き方</div>
                <p>これまでは半透明の色を指定する際、<code>rgba(255, 0, 0, 0.5)</code> のようにカンマ区切りで記述していましたが 、現在のCSSの標準仕様では、以下のような**「カンマなし・スラッシュ区切り」の新しいモダンな記述方法**が推奨されています 。</p>
                <pre><code>/* 最新のRGB透過記述ルール */
div {
    background: rgb(255 0 0 / 0.5); /* 赤色の50%透明 */
}</code></pre>
                <p>※ 背景色は、枠線の内側（パディングとコンテンツのエリア）に適用され、外マージンエリアには絶対に侵入しません 。</p>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">width / height プロパティの特性と単位</h3>
                <ul>
                    <li><strong><code>px</code>, <code>rem</code>, <code>em</code>：</strong> 通常の文字サイズや余白と同様の絶対的・相対的な単位指定 。</li>
                    <li><strong><code>%</code> （パーセンテージ）：</strong> **親ボックスのサイズ**に対する相対的な割合 。</li>
                    <li><strong><code>vw</code> （ビューポート・ウィズ）：</strong> ユーザーが見ている画面（ブラウザ）の横幅全体を <code>100vw</code> とした相対的な単位 。</li>
                    <li><strong><code>vh</code> （ビューポート・ハイト）：</strong> 画面の縦全体の高さを <code>100vh</code> とした相対的な単位 。</li>
                </ul>
                <div class="info-box">
                    <p><strong>💡 単位の応用テクニック:</strong><br>
                    高さ（height）に <code>vh</code> 単位、または横幅と同じ <code>vw</code> 単位を適用してあげることで、スマホなどのあらゆる異なる画面サイズに応じて、比率を崩さずに綺麗な「正方形のボックス」などをCSSだけで作成することができます 。</p>
                </div>
            </div>
            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">物理プロパティ と 論理プロパティ の違い</h3>
                <p>余白（margin / padding）や枠線を指定する方法には、従来の「物理位置」による指定と、現代推奨されている「論理位置」による指定の2通りがあります [1.12]。</p>

                <div class="sub-heading">■ 物理プロパティ（上下左右での指定）</div>
                <p>画面の「上・下・左・右」という絶対的な固定位置に対して余白を指定します [1.12]。実務のコードではまだ多い記述です [1.12]。</p>
                <ul>
                    <li><code>margin-top</code> / <code>padding-left</code> などの指定方法 [1.12]。</li>
                    <li><strong>⚠️ マージンの相殺（重なり）：</strong> 上下に並んだブロック要素同士のマージン（例：上の要素の <code>margin-bottom: 2rem;</code> と下の要素の <code>margin-top: 1rem;</code> ）は、足し算されずに**大きい方の数値の領域へと重なり合って共有される**という、CSS特有の重要な性質（相殺）があります [1.12]。</li>
                </ul>

                <div class="sub-heading">■ 論理プロパティ（文字の流れる方向での指定 ※現代の推奨設定）</div>
                <p>画面の方向ではなく、**文字が流れていく方向（セマンティックな位置）**を基準にして余白を自動計算する新しい方法です [1.12]。</p>
                <ul>
                    <li><strong>インライン方向（Inline）：</strong> 横書きにおける「左から右」など、文字が進んでいく横の方向 [1.12]。</li>
                    <li><strong>ブロック方向（Block）：</strong> 横書きにおける「上から下」など、行が積み重なっていく縦の方向 [1.12]。</li>
                    <li><strong>文字のスタート位置（<code>inline-start</code>）の活用：</strong> <code>margin-inline-start</code> や <code>padding-inline-start</code> と記述すると、文字の書き始め側に余白を作ります [1.12]。通常の横書き（左詰め）なら「左側」に余白がつき、縦書きレイアウトに切り替えた場合は**CSSを書き直すことなく自動的に「上側」の余白へと追従・変化**します [1.12]。国際化（多言語サイト）や高度な設計で推奨されています [1.12]。</li>
                </ul>

                <div class="sub-heading">■ 一括指定（ショートハンド）における記述順のルール</div>
                <p>スペース区切りで値を並べる際、個数によって適用される方向の順番が時計回りで厳格に決まっています [1.12]。</p>
                <ul>
                    <li><code>{ margin: 10px; }</code> ➔ 1個の記述：**四方向すべて**が同じ値 [1.12]。</li>
                    <li><code>{ padding: 10px 20px; }</code> ➔ 2個の記述：**[上・下] [左・右]** の順番 [1.12]。</li>
                    <li><code>{ border-width: 1px 2px 3px; }</code> ➔ 3個の記述：**[上] [左・右] [下]** の順番 [1.12]。</li>
                    <li><code>{ border-style: none solid dashed dotted; }</code> ➔ 4個の記述：**[上] [右] [下] [左]** の順（**時計回り**） [1.12]。</li>
                </ul>
            </div>

            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">枠線（border）の指定とお作法</h3>
                <p>枠線を表示するには、<code>style</code>（種類：実線 <code>solid</code> など）、<code>width</code>（太さ）、<code>color</code>（色）の3つの要素を指定します [1.12]。</p>
                <pre><code>/* 四方向一括指定のショートハンド（値の順番は自由） */
div {
    border: 1px solid #333;
}</code></pre>
                <p>※ 方向を書かないプロパティ（ <code>border-width</code> など）を使用する際は、コードの見落としバグを防ぐために「四方向すべてに同じ値を適用する」のが一般的です [1.12]。</p>

                <div class="sub-heading">■ 過去の名残： <code>img { border: 0; }</code> について</div>
                <p>古いサイトのコード等で稀に見かける <code>img { border: 0; }</code> や <code>border: none;</code> という記述は、HTML4.01の時代に画像にアンカーリンク（ <code>&lt;a&gt;</code> ）を設定すると、ブラウザが勝手に画像の周りに青い太枠線を出してしまっていた仕様を打ち消す（リセットする）ための名残のコードです [1.12]。現代のHTML5環境では書く必要はありません [1.12]。</p>

                <div class="sub-heading">■ <code>&lt;hr&gt;</code>（水平線）の正しい装飾リセットルール</div>
                <p><code>&lt;hr&gt;</code> タグの初期状態の正体は、実は「隙間のない立体的な枠線（border）」そのものです [1.12]。そのため、線の色や太さを変えたい時に普通に <code>color</code> を変えても色が変わらないバグに直面します [1.12]。<br>
                正しく装飾するには、**一度初期の枠線を完全に消去してから、高さ（height）と背景色で引き直す**のがWeb業界の厳格なルールです [1.12]。</p>
                
                <pre><code>/* 例：青い3pxの綺麗な仕切り線を引く正しい記述 */
hr {
    border: none;       /* 1. まず初期の枠線（border）を完全に消し去る */
    height: 3px;        /* 2. 線の太さを height（高さ）として指定する */
    background: blue;   /* 3. 一部ブラウザのバグを防ぐため background（一括指定）で色を塗る */
}</code></pre>
            </div>

            <!-- セクション6 -->
            <div class="note-section">
                <h3 class="note-title">【授業の実技・検証】CSSソースの解説</h3>
                <p>実技の検証コードの中で学んだ、マージンの挙動とパディングの重要特性についてです [1.12]。</p>

                <div class="sub-heading">■ ボックス内の最初の子要素に <code>margin-top</code> を指定した際のバグ</div>
                <p>検証コードにおいて、箱（ <code>section</code> ）の内部にある最初の中見出し（ <code>h3</code> ）に対して <code>margin-top: 2rem;</code> を指定した際、意図した「箱の中での上余白」にならず、親要素（ <code>section</code> ）ごと外側に下にずれてしまう現象が起きました [1.12]。これは親要素と最初の子要素のマージンが突き抜けて共有されてしまう仕様によるものです [1.12]。</p>
                
                <div class="info-box">
                    <p><strong>💡 解決方法と上マージンを使わないプロの風習:</strong><br>
                    ボックス内の最初の中身の上に余白を作りたい時は、子要素にマージンを付けるのではなく、**親要素（外枠の箱）に対して <code>padding-top: 2rem;</code>（内側の余白）を設定して広げる**のが正解です [1.12]。パディングを付与するとマージンの突き抜け共有がブロックされます [1.12]。<br>
                    このような罠や上下の相殺トラブルがあるため、現代のプロの現場では要素の上側に余白を空ける <code>margin-top</code> は極力使わず、余白は基本的に要素の下側に空ける <code>margin-bottom</code> を主軸にしてレイアウトを組み立てる手法（シングルディレクションマージン）が多く使われています [1.12]。</p>
                </div>
                
                <div class="sub-heading">■ 枠線付与時のパディングの重要性</div>
                <p>要素に <code>border</code>（枠線）を付けた際、上下は文字の行高（ <code>line-height</code> ）のおかげで自然な隙間が生まれますが、**左右の文字は枠線と完全にペタッとくっついてしまい、非常に見づらい状態**になってしまいます [1.12]。そのため、枠線を引く要素には必ずセットで <code>padding-left</code> や <code>padding-right</code> を設定し、左右に文字の逃げ道（余白）を作ってあげるのが綺麗なサイトを作るための鉄則です [1.12]。</p>
            </div>

        </main>
   </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
<!-- http://localhost/study/scl0721.php -->
