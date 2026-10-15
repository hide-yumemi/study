<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/29(水)の職業訓練授業ノートです。positionプロパティ（static, relative, absolute, fixed, sticky）の基本、親基準の絶対配置、およびz-indexによる要素の重ね順のルールについてまとめています。">
    <title>CSS positionプロパティの自由配置とz-indexの重ね順ルール | 職業訓練及び自主学習</title>
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
            <h2>7/29(水) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">要素を指定位置へ自由自在に配置するpositionプロパティの仕組み、および重なりを制御するz-indexの力関係</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">1. position プロパティの概要</h3>
                <p>指定した要素を、通常のHTMLのルールで配置されるはずの「元の位置（流動レイアウト）」から切り離し、狙った位置へ自由に移動・固定させるプロパティです。目的や用途に合わせて5つの値（タイプ）を使い分けます。</p>
                
                <ul>
                    <li><strong><code>static</code> （初期値）：</strong> 特別な配置を行わない通常の表示形式。上下左右の位置指定（topなど）は一切効きません。</li>
                    <li><strong><code>relative</code> （相対配置）：</strong> 本来表示されるはずだった自分自身の元の位置を基準にして、そこから少しずらします。</li>
                    <li><strong><code>absolute</code> （絶対配置）：</strong> 元の位置を完全に無視し、親要素などを基準にして任意のピンポイントな場所に配置します。</li>
                    <li><strong><code>fixed</code> （固定配置）：</strong> 画面（ビューポート）の決まった場所に完全に固定します。スクロールしても画面にくっついたまま動きません。</li>
                    <li><strong><code>sticky</code> （粘着配置）：</strong> 通常通りスクロールしますが、指定した位置（画面の上端など）に達すると、そこにピタッと留まります。</li>
                </ul>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">2. position: absolute; （任意の場所へ絶対配置）</h3>
                <p>本来表示される場所を飛び越えて、任意の自由な場所に移動させます。位置の指定には <code>top</code> / <code>bottom</code> / <code>left</code> / <code>right</code> を組み合わせて、境界線からの距離を数値で指定します。</p>

                <div class="sub-heading">⚠️ 最重要：基準位置（どこを基準に動くか）のルール</div>
                <ul>
                    <li><strong>初期状態：</strong> 周りに何も指定がない状態では、画面全体（ <code>body</code> ）の左上が起点（基準）になります。</li>
                    <li><strong>親要素が基準になる条件：</strong> 親要素の position に、初期値（ <code>static</code> ）以外の値（ <code>relative</code> や <code>absolute</code> ）が指定されている場合は、<strong>その一番近い親要素の枠が「新しい基準の壁」</strong>になります。</li>
                </ul>
                
                <div class="info-box">
                    <p><strong>💡 実務での鉄板組み合わせパターン:</strong><br>
                    デザインが崩れないようにするため、実務では以下のように親子のセットで記述するのが大前提のルールとなっています。<br>
                    1. 基準にしたい**親要素（BOX）**に <code>position: relative;</code> を指定する（移動はさせず、基準の旗を立てるだけ）。<br>
                    2. その中にある**子要素（BOX）**に <code>position: absolute;</code> を指定し、<code>top: 10px; right: 10px;</code> などの位置を指定して親の枠内で動かす。</p>
                </div>
                <p>※ 移動させた先では、要素同士が空間を共有して「重なり合う状態」になります。</p>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">3. z-index プロパティ （要素の重ね順の指定）</h3>
                <p>要素が重なったときの、上下（手前と奥）の順番を整数値で指定します。指定する数値が大きいものほど手前（上）に重なって表示されます。</p>
                <div class="alert-box" style="background-color: #f1f5f9; border-left: 4px solid #64748b; color: #334155;">
                    ※重要： <code>z-index</code> は、 position の値が初期値（ <code>static</code> ）以外の要素にしか絶対に機能しません。
                </div>

                <div class="sub-heading">■ 【超重要】重ね順の力関係（優先ルール表）</div>
                <table class="lesson-table">
                    <thead>
                        <tr>
                            <th style="width: 100px; text-align: center;">強さ・優先度</th>
                            <th style="width: 150px;">必須条件</th>
                            <th>ブラウザ上の表示状態</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;"><span class="rank-badge" style="background-color: #eab308;">🥇 最強</span></td>
                            <td><code>position</code>（static以外）あり<br>＋ <strong>z-index の数値が大きい</strong></td>
                            <td style="font-weight: bold; color: #1e3a8a;">すべての要素の一番手前（上）に最優先で表示される</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;"><span class="rank-badge" style="background-color: #94a3b8;">🥈 強い</span></td>
                            <td><code>position</code>（static以外）あり<br>＋ <strong>z-index の数値が小さい</strong></td>
                            <td>他の浮いている要素たちの間で、数値に応じた中間に表示される</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;"><span class="rank-badge" style="background-color: #b45309;">🥉 普通</span></td>
                            <td><code>position</code>（static以外）あり<br>➔ <strong>z-index の記述なし</strong></td>
                            <td>重なり順はHTMLコードの記述順に依存（コード上で**下に書かれているもの**が手前に重なる）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;"><span class="rank-badge" style="background-color: #ef4444;">❌ 最弱</span></td>
                            <td><code>position</code> が初期値（ <code>static</code> ）</td>
                            <td style="color: #666;"><strong>z-index の記述は完全に無視される（最背面に沈む）</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- セクション3の補足 -->
            <div class="note-section">
                <h3 class="note-title">3-2. 移動しない要素側にも relative を設定する理由</h3>
                <p>元々その場から「動かさない要素A（static）」の上に、「絶対に移動させたい要素B（absolute）」を綺麗に重ねようとした際、要素Bがなぜか下に潜り込んで見えなくなってしまうというバグ（重なりバグ）が起きることがあります。</p>
                <div class="info-box">
                    <strong>💡 潜り込みバグの防ぎ方：</strong><br>
                    原因は、要素Aのpositionが初期値（static）のままだと、重ね順の戦闘力（z-index）がゼロの最弱状態だからです。この潜り込みを防ぐために、<strong>移動させる必要がない要素A側にもあえて <code>position: relative;</code> のみを与えてz-indexの戦闘力を解放</strong>し、重ね順の主導権をきっちりコントロールできるようにするのがプロのセオリーです。
                </div>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">4. position: relative; （本来の場所からずらす相対配置）</h3>
                <p>本来表示される予定だった自分自身の場所を基準（起点）として、上下左右に位置をずらします。最大の特徴は、<strong>「自分が動いた後も、元の表示場所（スペース）がそのままキープされて残る」</strong>という性質です。</p>

                <!-- 💡 ご提示いただいた解説画像をここに美しく組み込みました！ -->
                <div class="sub-heading">■ 【参考視覚資料】Bの箱が本来の場所からズレて重なる表示結果</div>
                <div style="text-align: center; margin: 20px 0; background-color: #f8fafc; padding: 15px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    <img src="img/position-relative.png" alt="position: relativeの配置検証図" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <p style="font-size: 13px; color: #666; margin-top: 8px; margin-bottom: 0;">※Bの箱がズレても元の空間が維持されるため、Cが上に詰め上がらない状態を示す図</p>
                </div>

                <p><strong>【コード記述例】</strong></p>
                <pre><code>/* Bの箱だけを「本来の場所」から移動させる設定 */
.b {
    position: relative; /* 1. 相対配置を有効にする（元の空間をキープ） */
    top: 10px;          /* 2. 本来の位置の上端から、10px下にずらす */
    left: 10px;         /* 3. 本来の位置の左端から、10px右にずらす */
    background-color: lightcoral;
}</code></pre>

                <p><strong>【ブラウザでの表示結果】</strong></p>
                <ul>
                    <li><strong>A と C</strong> は本来の位置にそのまま何も影響を受けずに配置されます。</li>
                    <li><strong>B</strong> だけが、本来あるはずだった場所から、右に10px、下に10pxズレてCの上に重なるように配置されます。</li>
                    <li>元のBの空間（スペース）はしっかりとブラウザにキープされ続けているため、**Cが上に詰まって押し上がってくることはありません**。</li>
                </ul>
            </div>

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
