<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/30(木)の職業訓練授業ノートです。backgroundプロパティの一括指定と複数画像配置、およびHTML tableタグを使った表作成の構造とセル連結のルールについてまとめています。">
    <title>背景グラフィックの高度な制御とテーブル（表）構造の設計ルール | 職業訓練及び自主学習</title>
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
            <h2>7/30(木) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">背景に関するスタイルの一括制御、複数画像のレイヤー管理、およびHTML5における表（テーブル）データの構造設計</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">1. background プロパティ（一括指定・ショートハンド）</h3>
                <p>背景に関する複数の独立したスタイルを、スペース区切りで1行にまとめて指定できる非常に強力なプロパティです。以下の個別プロパティの値を一度に引き受けることができます。</p>
                <ul>
                    <li><code>background-color</code> （背景色）</li>
                    <li><code>background-image</code> （背景画像）</li>
                    <li><code>background-repeat</code> （繰り返しのルール）</li>
                    <li><code>background-position</code> （配置の基準位置）</li>
                    <li><code>background-size</code> （画像の表示サイズ）</li>
                    <li><code>background-attachment</code> （スクロール時の固定挙動）</li>
                    <li><code>background-origin</code> / <code>background-clip</code> （色の描画・適用範囲）</li>
                </ul>
                <div class="info-box">
                    <strong>💡 記述方法の鉄則：</strong><br>
                    複数の値を1行に並べる際は、それぞれの値の間を**半角スペース**で区切って記述します。
                </div>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">2. 背景画像の複数指定と詳細プロパティ</h3>
                <p>現代のCSS設計では、背景に複数の画像を同時に読み込んで「レイヤー（重ね絵）」のように表現することが認められています。</p>
                
                <div class="sub-heading">■ 複数の画像指定（マルチ背景）</div>
                <p>複数の背景画像を指定する際は、それぞれの画像を**カンマ（ <code>,</code> ）**で区切って記述します。</p>
                <div class="demo-box">
                    background-image: url("image1.png"), url("image2.png");
                </div>
                <div class="alert-box" style="background-color: #fff1f2; border-left: 4px solid #f43f5e; padding: 12px; border-radius: 6px; margin: 10px 0; color: #b91c1c; font-weight: bold; font-size: 14px;">
                    ⚠️ 重ね順の絶対ルール：<br>
                    コード上で「先に書いた画像が上（手前）」に重なり、「後に書いた画像が下（奥）」に潜り込む性質を持っています。このルールは <code>background</code> 一括指定で並べる場合も完全に同じです。
                </div>

                <div class="sub-heading">■ background-repeat （背景画像の繰り返し設定）</div>
                <ul>
                    <li><code>no-repeat</code> ： 画像を1枚だけ表示し、繰り返しません。ロゴやアイコンを置く時の基本設定です。</li>
                    <li><code>repeat</code> （初期値） ： 全面（縦方向・横方向の両方）に隙間なくタイル状に繰り返します。</li>
                    <li><code>repeat-x</code> ： 水平方向（X軸・横方向）にのみループを繰り返します。</li>
                    <li><code>repeat-y</code> ： 垂直方向（Y軸・縦方向）にのみループを繰り返します。</li>
                </ul>

                <div class="sub-heading">■ background-position （背景画像の配置位置指定）</div>
                <p>主に <code>no-repeat</code> を指定した画像が、ボックスのどこに位置するかを設定します。指定には数値（px、%）のほか、以下の位置キーワードを組み合わせて指定します。</p>
                <ul>
                    <li><strong>水平方向（横位置）：</strong> <code>left</code> / <code>center</code> / <code>right</code></li>
                    <li><strong>垂直方向（縦位置）：</strong> <code>top</code> / <code>center</code> / <code>bottom</code></li>
                </ul>
                <div class="demo-box">
                    /* 記述例：画像を右下の壁にピッタリ配置する */<br>
                    background-position: right bottom;
                </div>

                <div class="sub-heading">■ background-size （背景画像のサイズ制御）</div>
                <p>画像を拡大・縮小し、背景エリアに対してどのようにフィットさせるかを制御します。特にスマートフォン対応で真価を発揮します。</p>
                <ul>
                    <li><strong><code>contain</code> ：</strong> 画像のアスペクト比（縦横比）を100%完全に維持したまま、画像全体が**ボックスの枠からはみ出さない最大サイズ**まで自動拡大・縮小します。</li>
                    <li><strong><code>cover</code> ：</strong> ボックスの背景エリア全体を**隙間なく100%埋め尽くす**ように、自動で拡大・縮小してフィットさせます。ボックスの比率と画像の比率が合わない場合、画像の一部分が自動的にお外へはみ出してカットされますが、背景を綺麗に埋められるため実務で圧倒的に多用されます。</li>
                </ul>
            </div>
            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">3. HTML5基準：表（テーブル）を作成する正しい構造設計</h3>
                <p>HTMLで表を作るには <code>&lt;table&gt;</code> タグを使用しますが、現代のWeb標準では単にデータを並べるだけでなく、文書の意味を明確にするセマンティックな構造タグを組み合わせる必要があります。</p>
                
                <div class="sub-heading">■ テーブルを構成する主要な構造タグ</div>
                <ul>
                    <li><strong><code>&lt;table&gt;</code> 〜 <code>&lt;/table&gt;</code>：</strong> 表全体の範囲を指定する最外枠の親タグ。</li>
                    <li><strong><code>&lt;caption&gt;</code> 〜 <code>&lt;/caption&gt;</code>：</strong> 表全体の「タイトル（キャプション）」を指定します。<strong>必ずtableタグの直後（1番最初）に配置する</strong>のが厳格な文法ルールです。</li>
                    <li><strong><code>&lt;thead&gt;</code> 〜 <code>&lt;/thead&gt;</code>：</strong> 表の「見出し行（ヘッダー部）」をまとめて指定します。</li>
                    <li><strong><code>&lt;tbody&gt;</code> 〜 <code>&lt;/tbody&gt;</code>：</strong> 表の主役となる「通常のデータ行（ボディ部）」を指定します。</li>
                    <li><strong><code>&lt;tfoot&gt;</code> 〜 <code>&lt;/tfoot&gt;</code>：</strong> 表の最下部にくる「集計・合計行（フッター部）」を指定します。</li>
                </ul>

                <div class="sub-heading">⚠️ 親子関係とセルのルール</div>
                <p><code>&lt;thead&gt;</code>、<code>&lt;tbody&gt;</code>、<code>&lt;tfoot&gt;</code> の直下には、<strong>行を示す <code>&lt;tr&gt;</code>（Table Row）しか子要素として配置できない</strong>という厳格なルールがあります。</p>
                <p>そして、その <code>&lt;tr&gt;</code> の中に、実際のマス目となる以下の2種類の「セル」を配置してデータを完成させます。</p>
                <ul>
                    <li><strong><code>&lt;th&gt;</code> （Table Header）：</strong> 見出しとなるセル。文字が自動で「太字・中央寄せ」になります。基本的に <code>&lt;thead&gt;</code> 内のtrの中で使用します。</li>
                    <li><strong><code>&lt;td&gt;</code> （Table Data）：</strong> 通常のデータを記述するセル。文字は「左寄せ」になります。</li>
                </ul>
<pre><code>&lt;table&gt;
  &lt;caption&gt;売上表&lt;/caption&gt;
  &lt;thead&gt;
    &lt;tr&gt; &lt;th&gt;商品名&lt;/th&gt; &lt;th&gt;価格&lt;/th&gt; &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt; &lt;td&gt;リンゴ&lt;/td&gt; &lt;td&gt;150円&lt;/td&gt; &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">4. 複数のセルを連結する高度な属性（colspan / rowspan）</h3>
                <p>Excelの「セルの結合」と同じように、<code>&lt;th&gt;</code> や <code>&lt;td&gt;</code> タグに対して属性を追加することで、縦や横のマス目をダイナミックに繋ぎ合わせることができます。</p>
                
                <ul>
                    <li><strong>横方向に連結： <code>colspan="連結するマス数"</code></strong><br>
                    Column Span（列の結合）の略です。指定した数値分、**右側に向かって**セルを一体化させます。</li>
                    
                    <li><strong>縦方向に連結： <code>rowspan="連結するマス数"</code></strong><br>
                    Row Span（行の結合）の略です。指定した数値分、**下方向に向かって**セルを一体化させます。</li>
                </ul>
                <div class="info-box">
                    <strong>⚠️ セル連結時の超重要ポイント：</strong><br>
                    例えば、横に2マス分連結（ <code>colspan="2"</code> ）させた場合、そのセル自身が2マス分の横幅を消費することになります。そのため、同じ行の中にある隣の <code>&lt;td&gt;</code> をコード上から**1個削除して間引き算**してあげないと、表の右端が外側にはみ出して崩れてしまうため注意が必要です。
                </div>
            </div>

            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">5. 表をプロっぽく仕上げるCSS制御</h3>
                <p>テーブルのデザインを見やすく整えるために欠かせない、実務で100%使用する重要プロパティです。</p>

                <div class="sub-heading">■ 枠線の二重線バグを防ぐ（<code>border-collapse</code>）</div>
                <p>初期状態（ <code>separate</code> ）のままテーブルの各セルに枠線（border）を引くと、セル同士の間に不自然な隙間が空いてしまい、すべての線が「二重線」になって古臭い見た目になります。</p>
                <p>これを解消するために、**<code>table</code> タグに対して必ず以下の指定を行います。**</p>
                <pre><code>table {
    border-collapse: collapse; /* 💡 隣り合う枠線をガッチャンコして1本の綺麗な線にする */
}</code></pre>

                <div class="sub-heading">■ タイトル（caption）の位置をコントロールする</div>
                <p>表のタイトル（ <code>&lt;caption&gt;</code> ）は標準では表の上に表示されますが、CSSの <strong><code>caption-side: bottom;</code></strong> という命令を使うことで、表の真下（下部）へと綺麗に回り込ませて表示位置を変更することができます。</p>
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
