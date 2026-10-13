<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/6(月)の職業訓練授業ノートです。VSCodeの環境設定やHTML/CSS/JavaScriptの基礎知識をまとめています。">
    <title>7/6(月)職業訓練授業 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./scl_style.css">
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（共通CSSの2カラム構造を適用） -->
    <div class="container">
        <main class="main-content">
            <h2>7/6(月) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">VSCodeの初期設定から、HTML・CSS・JavaScriptの根底にある基本概念のまとめです。</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">VSCodeの配色とテーマ変更</h3>
                <p>ファイル ➔ ユーザー設定 ➔ テーマ から配色を変更できる。</p>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">導入しておくと便利な拡張機能</h3>
                <ol>
                    <li><strong>日本語化 (Japanese Language Pack):</strong> 画面全体をわかりやすい日本語表示にします。</li>
                    <li><strong>HTML CSS Support:</strong> CSS Intellisense for HTML（入力時の予測候補アシスト機能）。</li>
                    <li><strong>Live Server:</strong> ファイルの保存を検知してブラウザを自動リフレッシュします。（歯車から設定を開き、デフォルトブラウザを設定しておくと便利です）</li>
                    <li><strong>Zenkaku:</strong> 全角半角の判断のアシスト（エラーの原因になる全角スペースを可視化します）。</li>
                    <li><strong>Render Line Endings:</strong> 改行コードの区別がつきやすくなるプラグインです。</li>
                    <li><strong>Highlight Matching Tag:</strong> 選択中のタグと対になる閉じタグをハイライト強調します。</li>
                </ol>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">プロジェクト作成手順</h3>
                <ul>
                    <li>新規フォルダ（プロジェクトのルート）作成</li>
                    <li>HTMLファイル（例: <code>index.html</code>）の作成</li>
                    <li>ファイルから<strong>「自動保存（Auto Save）」</strong>にチェックを入れておくと、書き換えの紛失を防げて便利です。</li>
                </ul>
                <p style="margin-top: 15px; font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
                    <strong>💡 ワンポイントヒント：</strong><br>
                    Render Line Endings にチェックを入れて RenderWhitespace を「all」に設定すると、改行やスペースがエディタ上で記号として視覚的に分かりやすくなる。（ファイル ➔ ユーザー設定 ➔ 設定 ➔ テキストエディタ）
                </p>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">HTML文書の基本構造</h3>
                <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
  &lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;題名（ブラウザタブ部分）&lt;/title&gt;
  &lt;/head&gt;
  &lt;body&gt;
    &lt;h1&gt;テキスト&lt;/h1&gt;
    &lt;p&gt;テキスト&lt;/p&gt;
  &lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>

            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">HTML / CSS / JavaScript の基礎知識</h3>
                <p><strong>■ HTMLとは</strong><br>
                    HTML（ハイパーテキストマークアップランゲージ）は、Webサイトに表示する文字や画像に見出し・段落などの構造上の意味をつけて指定していく言語。HTMLのみで表示すると、指定した順に上から下へ縦並び・横書きで表示される。配置や色、サイズなどのデザインは<em>CSS</em>で指定する。</p>

                <p style="margin-top: 15px;"><strong>■ CSSとは</strong><br>
                    CSS（カスケーディングスタイルシート）は、Webサイトのデザインを担当する。基本的にはHTMLと別ファイルにし、拡張子は.cssを使用する。</p>

                <p style="margin-top: 15px;"><strong>■ JavaScriptとは</strong><br>
                    木構造でできているHTMLの構造体に対し、動的な変化をつけるプログラム言語。HTMLは木構造（DOM構造）の為、Webでよく使用される。最近では<b>「Vanilla.js（バニラJS）」</b>と呼ばれることもあり、フレームワーク等を何も手を加えられていない純粋なJavaScriptを指す。</p>
            </div>
            <!-- セクション6 -->
            <div class="note-section">
                <h3 class="note-title">&lt;!DOCTYPE html&gt; と &lt;html lang="ja"&gt; について</h3>
                <p><strong>■ <code>&lt;!DOCTYPE html&gt;</code> について</strong><br>
                    HTML文書のドキュメントタイプの指定。この宣言でHTML5であることを示す。</p>

                <p style="margin-top: 15px;"><strong>■ <code>&lt;html lang="ja"&gt;</code> について</strong><br>
                    <code>&lt;html&gt;</code>～<code>&lt;/html&gt;</code>は木構造で、その内部にHTML文書を作成する。タグの後に付ける <code>lang="ja"</code> のようなものを属性と呼び、そのサイトが何語表示なのかを指定する。例えば、Google翻訳が自動で言語を取得する際この情報を利用している。
                </p>
            </div>

            <!-- セクション7 -->
            <div class="note-section">
                <h3 class="note-title">&lt;head&gt;と&lt;body&gt; の役割</h3>
                <p><code>&lt;html&gt;</code> の子要素は <code>&lt;head&gt;</code>～<code>&lt;/head&gt;</code> と <code>&lt;body&gt;</code>～<code>&lt;/body&gt;</code> のみ。</p>
                <ul>
                    <li><strong>head内：</strong> サイトの定義を行う <code>meta</code>、ページタイトル、スタイル関連（CSS）などを書く。</li>
                    <li><strong>body内：</strong> ブラウザに表示する文字や画像など、実際のコンテンツを書く。</li>
                </ul>
            </div>

            <!-- セクション8 -->
            <div class="note-section">
                <h3 class="note-title">head内の重要な設定（charset と title）</h3>
                <p><strong>■ <code>&lt;meta charset="UTF-8"&gt;</code> について</strong><br>
                    文字コードの指定。ブラウザの設定に応じたコードで変換されるため、指定がないと文字化けの可能性が出てしまう。ブラウザはHTMLを上から順に実行するので、日本語を使用する前に文字コードを指定する。そのため、<code>&lt;head&gt;</code> 内の最初に書くことが多い。</p>

                <p style="margin-top: 15px;"><strong>■ ページタイトルの指定</strong><br>
                    ブラウザのタブ欄に表示される「表示しているページ」のタイトルを <code>&lt;title&gt;</code>～<code>&lt;/title&gt;</code> で指定する。ユーザーにどのサイトにいるかを明示するため、サイト名とページ名を併記することが多い。</p>
            </div>

            <!-- セクション9 -->
            <div class="note-section">
                <h3 class="note-title">HTML内にCSSを書く方法と外部ファイルの読み込み</h3>
                <p><strong>■ HTML内にCSSを書く方法</strong></p>
                <ul>
                    <li>head内にstyleタグ：<code>&lt;head&gt;</code> の子要素として <code>&lt;style&gt;</code>～<code>&lt;/style&gt;</code> を用意し、その中にCSSを記述。</li>
                    <li>各タグに属性として指定。例えば <code>style</code> 属性などで直接指定。</li>
                </ul>
                <p>※ただし、基本的には外部CSSファイルに書き、HTMLからそのファイルを読み込む方法が推奨される。</p>

                <p style="margin-top: 20px;"><strong>■ 外部CSSファイルの読み込み</strong></p>
                <p>外部CSSファイルは <code>&lt;link&gt;</code> タグを使用して読み込む（例: <code>&lt;link rel="stylesheet" href="style.css"&gt;</code>）。</p>
                <ul>
                    <li>CSSファイルは必要な数だけ読み込み可能。</li>
                    <li><code>&lt;link&gt;</code> 1つで読み込めるのは1ファイルなので、複数必要な場合は複数の <code>&lt;link&gt;</code> を使用する。</li>
                    <li>同じサーバーのCSS：相対パスで指定。</li>
                    <li>他サーバーのCSS：httpから始まる絶対パスで指定。</li>
                </ul>

                <p style="margin-top: 20px;"><strong>■ CSS読み込み以外のlinkの例</strong></p>
                <p>ファビコン画像を指定する場合：<code>&lt;link rel="icon" href="パス"&gt;</code>。ここでのパスはファビコン画像への相対パス。</p>
            </div>

            <!-- セクション10 -->
            <div class="note-section">
                <h3 class="note-title">head内で他に指定するmeta設定の例</h3>
                <ul>
                    <li><strong>ビューポート設定：</strong> スマホで横幅サイズを縮小してサイト表示できる機能を制限する際に使用。スマホ・PC共有サイト（レスポンシブサイト）でよく使われる。</li>
                    <li><strong>JavaScriptの読み込み：</strong> ブラウザ表示開始前に実行したいものがある場合、<code>&lt;head&gt;</code> 内に指定する。</li>
                    <li><strong>ページ説明文：</strong> 検索結果のサイト説明文に使用。 <code>&lt;meta name="description" content="説明文"&gt;</code></li>
                    <li><strong>電話番号の自動リンクを防ぐ：</strong> <code>&lt;meta name="format-detection" content="telephone=no"&gt;</code></li>
                    <li><strong>Googleの検索結果に載せるのを拒否：</strong> <code>&lt;meta name="robots" content="noindex,nofollow"&gt;</code>。ポートフォリオサイトなどで使用（検索結果にリンクを載せない設定）。</li>
                </ul>
            </div>

        </main>

        <!-- 右側：更新履歴（共通パーツ history.php を呼び出し、綺麗に右横並びにします） -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>