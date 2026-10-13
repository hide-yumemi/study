<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/28(火)の職業訓練授業ノートです。Gridレイアウトの基本概念、親要素での形状指定、fr単位のルール、子要素（アイテム）の配置方法についてまとめています。">
    <title>CSS Gridレイアウトの基本構造とグリッド線による配置ルール | 職業訓練及び自主学習</title>
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
            <h2>7/28(火) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">Gridレイアウトによる二次元配置の構築、比率を扱う「fr」単位のルール、およびグリッド線を用いた子要素の配置制御</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">1. Grid（グリッド）レイアウトの基本概念</h3>
                <p>Flexboxが「一方向（横並び、または縦並び）」のレイアウトを得意とするのに対し、Gridレイアウトは**「縦と横の二次元（格子状）」**の高度なレイアウトを簡単に実現するためのプロパティです。</p>
                <ul>
                    <li><strong>レイアウトの歴史：</strong> 昔は <code>position</code> や <code>float</code> を複雑に工夫してパズルのように配置していましたが、現在はGridを使うことで直感的な配置管理が可能になりました。</li>
                    <li><strong>設定フロー：</strong> 全体を囲む親要素（コンテナ）に対して <code>display: grid;</code> を指定した上で、方眼紙のマス目を作るようにグリッドの形状（縦・横の数と幅）を指定します。</li>
                </ul>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">2. グリッドの形状指定（親要素の設定）</h3>
                <p>親ボックスに対して、縦横に何マスの部屋を切り分けるかを以下のプロパティで指定します。</p>
                <ul>
                    <li><strong>横幅（列の数と幅）：</strong> <code>grid-template-columns</code></li>
                    <li><strong>縦幅（行の数と幅）：</strong> <code>grid-template-rows</code></li>
                </ul>

                <div class="sub-heading">■ 新しい比率単位「fr（フラクション）」のルール</div>
                <p>Gridレイアウト特有の、**「全体の余白を比率で自動分配する」**非常に便利な相対単位です。</p>
                <ul>
                    <li><strong>比率による分配：</strong> 例えば <code>grid-template-columns: 1fr 2fr 1fr;</code> と記述すると、画面幅に合わせて横幅が「1 ： 2 ： 1」の割合で自動計算され、綺麗な3カラムが作られます。</li>
                    <li><strong>固定値との組み合わせ優先度：</strong> <code>100px 1fr 1fr</code> のようにpxなどの固定値が混ざっている場合は、まず固定値（100px）が最優先でエリアを確保し、**残った余白のエリア**を fr の比率（1：1）で等分に分け合います。</li>
                    <li><strong>縦幅（rows）の設定セオリー：</strong> Webページは上から下へスクロールする構造が基本となるため、縦幅（行）に fr を使うと高さが無限に伸びて計算が狂うことがあります。そのため、縦幅には <code>120px</code> などの固定値を指定するのが実務の一般的なセオリーです。</li>
                </ul>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">3. アイテムの配置指定（子要素の設定）</h3>
                <p>形状を決めたら、子要素（アイテム）を「何番目のマスに置くか」を指定します。考え方のコツは、マス目ではなく**「縦横のグリッド線が何本目から何本目までか」**で範囲を指定する点です。</p>
                <ul>
                    <li><strong>横方向の範囲指定：</strong> <code>grid-column</code></li>
                    <li><strong>縦方向の範囲指定：</strong> <code>grid-row</code></li>
                    <li><strong>記述ルール：</strong> 開始の線と終了の線を**スラッシュ（ <code>/</code> ）**で区切って記述します。（例：1本目の線から3本目の線までの範囲なら <code>1 / 3</code> と指定）</li>
                </ul>

                <div class="sub-heading">■ 余白（gap）の一括指定</div>
                <p>格子状の隙間（余白）を空けるには <code>gap</code> プロパティを使用します。</p>
                <ul>
                    <li><code>gap: 10px;</code> （値が1つ） ➔ 縦・横すべての隙間に10pxが適用。</li>
                    <li><code>gap: 10px 20px;</code> （半角スペース区切り） ➔ **[ 縦の隙間 ] [ 横の隙間 ]** の順で個別に適用されます。</li>
                </ul>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">4. 【実技・動作チェック】A〜Jのグリッド配置演習</h3>
                <p>ご提示いただいた授業内の解説図を元に、縦横4マスのグリッド（計5本のグリッド線）の中でAからJまでの要素を重ねずにピシッと配置した実践コードです。</p>

                <!-- 💡 共有していただいた大切な解説イラストをここに綺麗に埋め込みました！ -->
                <div class="sub-heading">■ 【参考視覚資料】A〜Jのグリッド配置とグリッド線のインデックス図</div>
                <div style="text-align: center; margin: 20px 0; background-color: #f8fafc; padding: 15px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    <img src="img/grid-layout.png" alt="Gridレイアウトの線番号とアイテム配置解説図" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <p style="font-size: 13px; color: #666; margin-top: 8px; margin-bottom: 0;">※縦横5本のグリッド線に囲まれた領域に各要素（A〜J）を配置する設計図</p>
                </div>

                <p><strong>【HTML記述】</strong></p>
                <pre><code>&lt;div id="wrapper"&gt;
  &lt;section id="contener"&gt;
    &lt;div class="item_A"&gt;&lt;p&gt;A&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_B"&gt;&lt;p&gt;B&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_C"&gt;&lt;p&gt;C&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_D"&gt;&lt;p&gt;D&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_E"&gt;&lt;p&gt;E&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_F"&gt;&lt;p&gt;F&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_G"&gt;&lt;p&gt;G&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_H"&gt;&lt;p&gt;H&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_I"&gt;&lt;p&gt;I&lt;/p&gt;&lt;/div&gt;
    &lt;div class="item_J"&gt;&lt;p&gt;J&lt;/p&gt;&lt;/div&gt;
  &lt;/section&gt;
&lt;/div&gt;</code></pre>
                <p><strong>【CSS記述】</strong></p>
                <p style="color: #666; font-size: 13px; margin-bottom: 15px;">※ 提示された解説図の通り、縦横5本のグリッド線を基準に各アイテムの範囲を正確に指定しています。</p>
                <pre><code>#wrapper {
    max-width: 100%; /* スマートフォン等で自動で縮小・最適化させるための設定 */
    margin: 0 auto;
}

/* 親要素（コンテナ）のグリッド形状・余白設定 */
#contener {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr; /* 横方向を均等に4等分 */
    grid-template-rows: 120px 120px 120px 120px; /* 縦幅は1マス120pxで固定 */
    gap: 3px 3px; /* 縦・横の隙間（余白）を3pxに指定 */
}

/* ── 各子要素（アイテム）の配置エリア指定 ── */

/* A：横は1番目〜4番目の線、縦は1番目〜2番目の線 */
.item_A {
    grid-column: 1 / 4;
    grid-row: 1 / 2;
    background-color: rgba(255, 0, 0, 0.5);
}

/* B：横は1番目〜2番目の線、縦は2番目〜5番目の線 */
.item_B {
    grid-column: 1 / 2;
    grid-row: 2 / 5;
    background-color: rgba(0, 255, 0, 0.5);
}

/* C：横は2番目〜3番目の線、縦は2番目〜3番目の線 */
.item_C {
    grid-column: 2 / 3;
    grid-row: 2 / 3;
    background-color: rgba(0, 0, 255, 0.5);
}

/* D：横は2番目〜3番目の線、縦は3番目〜4番目の線 */
.item_D {
    grid-column: 2 / 3;
    grid-row: 3 / 4;
    background-color: rgba(143, 238, 151, 0.5);
}

/* E：横は2番目〜3番目の線、縦は4番目〜5番目の線 */
.item_E {
    grid-column: 2 / 3;
    grid-row: 4 / 5;
    background-color: rgba(234, 179, 8, 0.5);
}

/* F：横は3番目〜4番目の線、縦は2番目〜3番目の線 */
.item_F {
    grid-column: 3 / 4;
    grid-row: 2 / 3;
    background-color: rgba(168, 85, 247, 0.5);
}

/* G：横は3番目〜5番目の線、縦は3番目〜4番目の線 */
.item_G {
    grid-column: 3 / 5;
    grid-row: 3 / 4;
    background-color: rgba(236, 72, 153, 0.5);
}

/* H：横は3番目〜4番目の線、縦は4番目〜5番目の線 */
.item_H {
    grid-column: 3 / 4;
    grid-row: 4 / 5;
    background-color: rgba(20, 184, 166, 0.5);
}

/* I：横は4番目〜5番目の線、縦は1番目〜3番目の線 */
.item_I {
    grid-column: 4 / 5;
    grid-row: 1 / 3;
    background-color: rgba(249, 115, 22, 0.5);
}

/* J：横は4番目〜5番目の線、縦は4番目〜5番目の線 */
.item_J {
    grid-column: 4 / 5;
    grid-row: 4 / 5;
    background-color: rgba(100, 116, 139, 0.5);
}</code></pre>
            </div>

        </main>

        <!-- 右側：更新履歴（共通パーツ history.php を呼び出し、右横並びにします） -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
