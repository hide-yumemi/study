<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/28(金)の職業訓練授業ノートです。JavaScriptの関数の基本（引数・戻り値）、window.onloadとreadyの違い、イベントオブジェクト、addEventListenerによるイベント駆動制御をまとめています。">
    <title>8/28(金)職業訓練授業：関数の基礎とイベント駆動型プログラミング | ポートフォリオサイト</title>
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
            <h2>8/28(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                特定の処理を再利用する「関数」の設計方法と、ユーザーの操作に応じて処理を動かす「イベントリスナー」の高度な仕組みを深く学びます。
            </p>

            <!-- セクション1：関数の基本概念 -->
            <div class="note-section">
                <h3 class="note-title">1. 関数（Function）の基本構造とメリット</h3>
                <p>
                    JavaScriptにおける**関数**とは、特定の処理（プログラム）をひとまとめにしたブロックのことです。関数内に書かれた命令は、定義しただけでは実行されず、外部から「呼び出された時」に初めて実行されます。
                </p>
<pre><code>// 基本構文
function 関数名(引数1, 引数2, ...) {
    // 実行したいひとまとめの処理
}</code></pre>

                <div class="sub-heading">🤝 引数（ひきすう）とは</div>
                <p>
                    関数を呼び出す側から値を受け取って処理を動かす場合、<code>()</code> の中に関数内部だけで変数として機能する **「仮引数」** を設定しておきます。
                </p>
                <ul>
                    <li><strong>引数なし：</strong> 呼び出すだけで一連の固定処理を動かす。 （例: <code>disp();</code>）</li>
                    <li><strong>引数あり：</strong> 渡す値によって計算結果などを動的に変える。 （例: <code>add(1, 2);</code>）</li>
                </ul>

                <div class="sub-heading">💡 関数を定義するメリットとタイミング</div>
                <ul>
                    <li>プログラム内に制限なく<strong>何個でも作成可能</strong>で、<strong>何回でも再利用（呼び出し）</strong>できる。</li>
                    <li>サイトを開いた瞬間ではなく、ユーザーのクリックやキー入力など**「特定のタイミングで実行したい処理」**は、すべて関数としてカプセル化して定義する。</li>
                </ul>
            </div>

            <!-- セクション2：return文の役割 -->
            <div class="note-section">
                <h3 class="note-title">2. return文（戻り値の返却と処理の強制終了）</h3>
                <p>
                    関数内の <code>return</code> 命令には、プログラムの制御において2つの重要な役割があります。
                </p>
                <ul>
                    <li><strong>① 呼び出し元へ値を戻す（戻り値）：</strong> <code>return 値;</code> と書くと、関数の計算結果などを呼び出し元へパスできます。※戻せる値は1つだけのため、複数返したい場合は**配列**にして戻します。
<pre><code>function add(x, y) {
    return x + y; // 計算結果を戻す
}
let result = add(1, 2); // 💡 変数resultに「3」が代入される</code></pre>
                    </li>
                    <li><strong>② 処理を途中で終了する：</strong> <code>return;</code> と値を持たせずに書くと、それ以降の行の命令を実行することなく、その場で関数を強制終了して脱出させることができます。</li>
                </ul>
            </div>

            <!-- セクション3：ページの読み込みタイミング -->
            <div class="note-section">
                <h3 class="note-title">3. DOM操作に不可欠なページの読み込みタイミング制御</h3>
                <p>
                    通常のプログラムはHTMLを上から順に読み込んで実行しますが、外部CSSや <code>&lt;img&gt;</code> の画像はサーバーへ後から別途要求するため、JavaScriptの実行よりも表示が遅れる特性があります。HTMLの読み込み完了度合いに応じたタイミング制御が、DOMバグを防ぐ鍵です。
                </p>
                <ul>
                    <li><strong><code>window.onload = function(){};</code> 【完全完了】：</strong> HTMLの構造だけでなく、外部CSSや画像（ <code>&lt;img&gt;</code> ）など、**すべての追加ファイルが100%ダウンロード完了した瞬間**に発火します。そのため、実行タイミングとしては最も遅くなります。</li>
                    <li><strong><code>document.ready</code> (jQueryなど) 【DOM構築完了】：</strong> 画像やCSSの読み込み完了を待たず、**HTMLの解析（DOMツリー構造）がブラウザ内に組み上がった瞬間**に最速で即座に実行されます。要素の取得エラーを最速で防ぐ実務のスタンダードです。</li>
                </ul>
            </div>

            <!-- セクション4：イベントとaddEventListener -->
            <div class="note-section">
                <h3 class="note-title">4. イベント駆動と addEventListener の詳細メカニズム</h3>
                <p>ユーザーが画面に対して行ったアクション（クリック、キー入力など）を検知して関数を動かす仕組みを**イベント**と呼びます。</p>
                
                <div class="sub-heading">⚠️ イベント登録時、関数名に カッコ `()` を付けてはいけない理由</div>
                <p><code>要素.onclick = myFunc;</code> のように、登録時は必ず**関数名のみ（カッコなし）**で指定します。
                <br>もし <code>myFunc()</code> と書いてしまうと、**「イベントが発生した時ではなく、サイトを開いてこのコードを読み込んだ瞬間にその場で関数が勝手に実行され、その戻り値が代入されてしまう」**という致命的な誤動作を引き起こすためです。</p>

                <div class="sub-heading">✨ addEventListener によるイベント設定のメリット</div>
                <p>現代の標準である <code>要素.addEventListener("click", 関数名);</code> を用いると、以下の高度な制御が可能になります。</p>
                <ol>
                    <li>1つの要素の同じイベント（例: クリック時）に対して、**複数の異なる処理（関数）を競合させることなく安全に並行登録**できる。</li>
                    <li><code>"click"</code> や <code>"keydown"</code> のように、先頭に <code>on</code> を付けずにスッキリと記述する。</li>
                </ol>

                <div class="sub-heading">📐 第3引数の真偽値（true / false）とイベント伝播（流れ）の順序</div>
                <p><code>&lt;ul&gt;</code> の中に <code>&lt;li&gt;</code> があるような入れ子構造の要素をクリックした際、イベントが親子どちらから順に実行されるかを制御します。</p>
                <ul>
                    <li><strong><code>false</code> （バブリングフェーズ） ※省略時デフォルト：</strong> イベントが**「内側 ➔ 外側」**（ <code>&lt;li&gt;</code> ➔ <code>&lt;ul&gt;</code> ）の順で、泡が湧き上がるように伝わります。一般的にはこれが省略されて使われます。</li>
                    <li><strong><code>true</code> （キャプチャリングフェーズ）：</strong> イベントが**「外側 ➔ 内側」**（ <code>&lt;ul&gt;</code> ➔ <code>&lt;li&gt;</code> ）の順で、外側から捕まえるように実行されます。</li>
                </ul>
            </div>

            <!-- セクション5：イベントオブジェクトとデフォルトキャンセル -->
            <div class="note-section">
                <h3 class="note-title">5. イベントオブジェクトとブラウザ動作の拒否（return false）</h3>
                
                <div class="sub-heading">🎁 自動で渡される「イベントオブジェクト」</div>
                <p>
                    イベントによって関数が呼び出される際、引数を空にしていても、JavaScript側から自動的に**そのイベントに関する詳細な情報（座標や押されたキーのコード）を詰め込んだオブジェクト**が第1引数として渡されます。
                </p>
                <ul>
                    <li>マウスイベント：クリックされた画面上のX・Y座標など</li>
                    <li>キーボードイベント：押されたキーの識別用コード（キーコード）など</li>
                </ul>

                <div class="sub-heading">🚫 既定動作のキャンセル（return false;）</div>
                <p>
                    イベントハンドラ関数内で <code>return false;</code> を実行すると、ブラウザが元から持っている**既定の動作（デフォルトの挙動）を強力に拒否・キャンセル**することができます。
                </p>
                <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 8px; text-align: left; width: 35%;">対象タグ・トリガー</th>
                            <th style="padding: 8px; text-align: left;">キャンセルされるブラウザの既定動作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px;"><code>&lt;a&gt;</code> タグのクリック</td>
                            <td style="padding: 8px;"><code>href</code> に指定されている別サイトや別ページへの「画面遷移」をストップさせる。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px;">フォームの <code>submit</code> ボタン</td>
                            <td style="padding: 8px;"><code>action</code> 先のファイルへの、入力データの「暴発送信」を一時的に差し止める。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px;">画面の右クリック</td>
                            <td style="padding: 8px;">ブラウザ標準の「コンテキストメニュー（メニュー窓）」の表示を禁止する（独自メニューの実装などに使用）。</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- セクション6：スマートな無名関数の記述 -->
            <div class="note-section">
                <h3 class="note-title">6. 現代的な「無名関数（匿名関数）」によるスマートな記述</h3>
                <p>
                    イベントの発生タイミングと、そこで実行したい具体的な処理を、わざわざ外に関数を作らずに**その場に一括で記述する手法**です。
                </p>
<pre><code>// 記述例
要素.onclick = function() {
    // イベント発生時にその場ですぐに動かしたい命令
};

要素.addEventListener("click", function() {
    // addEventListenerでの無名関数の割り当て
});</code></pre>
                <p>
                    この書き方を採用することで、別ファイルや離れた行に関数を探しに行く必要がなくなり、後からコードを見返した際の「可読性」と「メンテナンス性」が劇的に向上するため、現在のフロントエンド実装における絶対的なスタンダードとなっています。
                </p>
            </div>

        </main>

        <!-- 右側：更新履歴 -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
