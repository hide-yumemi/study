<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/7(火)の職業訓練授業ノートです。bodyタグや見出し、段落、各種リンク設定（別タブ・ページ内・特殊リンク）とidの命名ルールについてまとめています。">
    <title>HTMLの基本タグと各種リンク構造 | 職業訓練及び自主学習</title>
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
            <h2>7/7(火) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">HTMLの基本タグの役割、用途に応じた各種リンク設定と、id属性を扱う際のルールについて</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">基本タグの役割</h3>

                <p><strong>■ <code>&lt;body&gt;</code> 〜 <code>&lt;/body&gt;</code></strong><br>
                    HTML要素の子要素。ブラウザの表示画面に映るすべての文字や写真に対し、Web上の意味（文法）を指定していく場所。JavaScriptをこの内部に記述することも可能。ルールから外れた場所に書いた文字や全角スペース・記号も画面に不意に表示されてしまうため注意が必要。</p>

                <p style="margin-top: 15px;"><strong>■ <code>&lt;!-- 〜 --&gt;</code>（コメントアウト）</strong><br>
                    ショートカット： <code>Shift + Alt + A</code> または <code>Ctrl + /</code><br>
                    HTMLファイル内に開発用のメモを残すためのタグ。この中に書かれた記述はブラウザに表示されない。</p>

                <p style="margin-top: 15px;"><strong>■ <code>&lt;h1&gt;</code> 〜 <code>&lt;/h1&gt;</code>（見出しタグ）</strong><br>
                    見出しとして使用する文字や画像を指定する。中の数字が若い（小さい）ほど大見出しとなる。ルールとして、ページ内には <code>&lt;h1&gt;</code> を1つだけ配置し、それ以降の <code>&lt;h2&gt;</code> や <code>&lt;h3&gt;</code> は必要に応じて階層順に使用する。</p>

                <p style="margin-top: 15px;"><strong>■ <code>&lt;p&gt;</code> 〜 <code>&lt;/p&gt;</code>（パラグラフ）</strong><br>
                    文章の「段落」を指定するタグ。</p>

                <p style="margin-top: 15px;"><strong>■ <code>&lt;br&gt;</code>（改行）</strong><br>
                    文中や段落内で強制的に改行を行いたい場合に使用する。Web文章はエリアの右端に達すると自動で改行されるが、右端にアルファベット（英単語）が位置した場合、半角スペース等が現れるまで全体が「1つの英単語」と判定され、横にはみ出してしまうバグが起きる。それを防ぐため、アルファベット開始前にこのタグで対策を行うことがある。</p>

                <p style="margin-top: 15px;"><strong>■ <code>&lt;hr&gt;</code>（水平線）</strong><br>
                    コンテンツ間の区切り線（水平線）をHTML側から出力するタグ。なお、段落を線で囲むなどのデザインはCSSで実装するのが基本となる。</p>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">様々なリンク（aタグ）の設定</h3>

                <p><strong>■ リンクの基本構造</strong><br>
                    <code>&lt;a href="リンク先パス"&gt;リンクテキスト&lt;/a&gt;</code> の形式で、他のページへの移動やアプリ起動を指定する。
                </p>

                <div class="sub-heading">① 新しいタブで開くリンク（外部サイト・PDF等向け）</div>
                <p><code>&lt;a href="パス" target="_blank" rel="noopener noreferrer"&gt;テキスト&lt;/a&gt;</code></p>
                <ul>
                    <li><strong><code>target="_blank"</code>：</strong> 新しいタブでページを開く命令。</li>
                    <li><strong><code>rel="noopener noreferrer"</code>：</strong> セキュリティとプライバシーの安全対策。</li>
                    <li><strong><code>noopener</code>：</strong> リンク元とリンク先のページの接続を安全に切断し、不正なプログラムが実行されるのを防ぐ。</li>
                    <li><strong><code>noreferrer</code>：</strong> 元のページのリンク元情報（リファラ）を新しいページへ渡さないようにする。</li>
                </ul>

                <div class="sub-heading">② ページ内リンク（アンカーリンク）</div>
                <p><code>&lt;a href="#id名"&gt;〜&lt;/a&gt;</code></p>
                <p>ページ内の特定の場所へ瞬時にスクロール移動させたい場合に使用する。移動先となる要素へあらかじめ <code>id属性</code>（例: <code>&lt;p id="〇〇"&gt;</code>）を付与しておくことで連動する。</p>

                <div class="sub-heading">③ 特殊なリンク（メール・電話）</div>
                <ul>
                    <li><strong>メールリンク：</strong> <code>&lt;a href="mailto:メールアドレス"&gt;メールを送る&lt;/a&gt;</code></li>
                    <li><strong>電話リンク：</strong> <code>&lt;a href="tel:電話番号"&gt;電話をかける&lt;/a&gt;</code></li>
                </ul>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">id命名の厳格なルール</h3>
                <p>ページ内リンクやCSS、JavaScriptで要素を指定する際に使う <strong>id名</strong> は、以下のルールを必ず守って作成する。</p>
                <ol>
                    <li>ページ内で必ず<strong>ユニーク（重複しない）</strong>であること。</li>
                    <li>半角英数字、ハイフン（ <code>-</code> ）、アンダースコア（ <code>_</code> ）の組み合わせで作ること。</li>
                    <li>1文字目は絶対に<strong>数字以外（英字）</strong>から始めること。</li>
                    <li><code>top</code> という名前は避ける（ブラウザの標準機能やJavaScriptの処理と誤認・衝突する可能性があるため）。</li>
                </ol>
            </div>

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>