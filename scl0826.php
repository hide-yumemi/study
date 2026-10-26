<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/26(水)の職業訓練授業ノートです。JavaScriptによるHTML属性の追加・変更・削除、classListを用いた安全なクラス操作、classNameとsplit()によるクラス名の配列化手法をまとめています。">
    <title>8/26(水)職業訓練授業：属性（Attribute）とクラス（classList）の動的操作 | ポートフォリオサイト</title>
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
            <h2>8/26(水) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                ユーザーのアクションに応じて要素の属性を切り替える手法と、CSS設計を壊さない安全なクラス運用の仕組みを学びます。
            </p>

            <!-- セクション1：属性の追加と変更 -->
            <div class="note-section">
                <h3 class="note-title">1. HTML属性の追加と変更（2つのアプローチ）</h3>
                <p>
                    JavaScriptからHTML要素の属性（<code>src</code>, <code>href</code>, <code>id</code> など）を動的に操作するには、用途に応じて2つの手法を使い分けます。
                </p>
                <ul>
                    <li><strong>プロパティ直接指定方式：</strong> <code>要素.属性名 = 値;</code>
                        <br>➔ 属性名がJavaScriptオブジェクトのプロパティ（命令の一部）として扱われます。
                    </li>
                    <li><strong>setAttribute() メソッド方式：</strong> <code>要素.setAttribute("属性名", "値");</code>
                        <br>➔ 属性名を第1引数として「文字列」で指定します。
                    </li>
                </ul>
                <p>
                    ※どちらの手法を使用しても、指定した属性がすでにHTMLにあれば変更（上書き）され、なければ新しく属性が追加されます。
                </p>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    ⚠️<strong>属性操作に潜む2つの落とし穴と注意点</strong><br>
                    1. <strong>入力ミスをしてもエラーが出ない：</strong> 属性名や値をタイポ（打ち間違い）しても、JavaScript側はエラーを検知せず、そのまま架空の属性としてHTMLに追加してしまいます。デバッグ時に見落としやすいため注意が必要です。<br><br>
                    2. <strong>setAttributeによるstyle属性の上書きリスク：</strong> <code>setAttribute("style", "color:red;")</code> のようにスタイル属性を操作する場合、CSSと同じハイフン表記（ケバブケース）の文字列で記述できますが、これを実行すると、元々要素に適用されていたインラインスタイルがすべて上書き消去されます。
                    <br>❌ <code>para.setAttribute("style", "font-size:3rem");</code> ➔ 先に設定した赤文字（color:red）が消えて黒に戻る
                    <br>⭕ <code>para.setAttribute("style", "color:red; font-size:3rem;");</code> ➔ 複数適用する場合はセミコロンで繋ぐ
                </p>
            </div>

            <!-- セクション2：属性の取得・存在確認・削除 -->
            <div class="note-section">
                <h3 class="note-title">2. 属性の取得・存在確認・削除メソッド</h3>
                <p>要素の属性情報を読み込んだり、有無を条件分岐のフラグとして判定したり、不要になった属性を除去するための3大汎用メソッドです。</p>
                <ul>
                    <li><strong>属性値の取得：</strong> <code>const val = 要素.getAttribute("属性名");</code></li>
                    <li><strong>属性の存在確認：</strong> <code>const hasAttr = 要素.hasAttribute("属性名");</code> （結果は <code>true</code> または <code>false</code> で返る）</li>
                    <li><strong>属性の削除：</strong> <code>要素.removeAttribute("属性名");</code></li>
                </ul>
            </div>

            <!-- セクション3：クラス属性（classList）の操作 -->
            <div class="note-section">
                <h3 class="note-title">3. CSS設計を壊さない安全なクラス操作（classList）</h3>
                <p>
                    HTMLのクラスは、1つの要素に半角スペース区切りで複数設定できる特殊な仕様を持っています。そのため、前述の <code>setAttribute("class", "〜")</code> で書き換えると既存のクラスがすべて消滅してしまう危険があります。
                </p>
                <p>
                    これを防ぎ、特定のクラスだけを安全に管理（アドオン・デリート）するために <strong><code>classList</code></strong> APIを使用します。
                </p>

                <div class="sub-heading">📋 classList で実行できる5つの主要処理</div>
                <ul>
                    <li><strong><code>add("クラス名")</code> 【追加】：</strong> 既存のクラスを破壊せず、現在のクラス群の末尾に新しく「+1」する形で安全に追加します。</li>
                    <li><strong><code>remove("クラス名")</code> 【削除】：</strong> 指定したクラスだけを狙い撃ちして要素から除去します。</li>
                    <li><strong><code>toggle("クラス名")</code> 【付け外し】：</strong> 指定したクラスがすでに設定されていれば「削除」し、未設定であれば「追加」する、実務のハンバーガーメニュー等で最も多用されるコマンドです。</li>
                    <li><strong><code>replace("旧クラス", "新クラス")</code> 【変更】：</strong> クラス名を上書き置換します。</li>
                    <li><strong><code>contains("クラス名")</code> 【存在確認】：</strong> クラスが設定されていれば <code>true</code>、なければ <code>false</code> を返します。if文の条件式のトリガーとして重宝します。</li>
                </ul>
            </div>

            <!-- セクション4：className と split() によるクラスの配列化 -->
            <div class="note-section">
                <h3 class="note-title">4. className と split() によるクラス名の配列化手法</h3>
                <p>
                    <code>要素.className;</code> プロパティを使用すると、対象の要素に設定されているすべてのクラス名を、半角スペースで区切られた1つの長い文字列としてそのまま取得できます。（例: <code>"text1 text2 text3"</code>）
                </p>
                <p>
                    しかし、文字列のままだと特定のクラスだけをプログラム（ループ処理など）で個別に精査・操作することが困難です。そこで、文字列を指定文字で分割する <code>split()</code> メソッドを組み合わせます。
                </p>

                <div class="sub-heading">文字列から配列への変換の仕組み</div>
                <pre><code>// 半角スペースで文字列をバラバラに分解し、配列に変換する
const classArray = 要素.className.split(" ");

console.log(classArray[0]); // ➔ 1つ目のクラス名をインデックス番号で個別制御可能に！</code></pre>
                <p style="font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b; margin-top: 10px;">
                    <strong>💡 クラス名を配列化する実務上の最大のメリット</strong><br>
                    文字列から正規の「配列（Array）」に変換することで、JavaScriptの強力な配列専用命令（<code>forEach</code> など）をそのままクラス名群に対して流し込めるようになります。クラス情報を1つずつ精査しながら高度なDOM操作を行う際の、フロントエンドエンジニアの必須テクニックです。
                </p>
            </div>

            <!-- セクション5：実務での実装ユースケース -->
            <div class="note-section">
                <h3 class="note-title">5. 実務でよく見るプロの属性操作ユースケース</h3>

                <div class="sub-heading">🌟 ユースケース①：パスワード入力欄の「隠す・見せる」切り替え</div>
                <p>ログイン画面などでよくある目のアイコンをクリックするとパスワードの伏せ字が解除されるUIは、この属性操作によって実装されています。</p>
                <pre><code>// 属性を password から text へ動的に変更することで入力を可視化させる
if (inputPass.getAttribute("type") === "password") {
    inputPass.setAttribute("type", "text"); // 見せるモードへ
} else {
    inputPass.setAttribute("type", "password"); // 隠すモードへ
}</code></pre>

                <div class="sub-heading">🌟 ユースケース②：バナーやリンク先（href）とテキストの動的変更</div>
                <p>aタグを操作する場合、URL（<code>href</code> 属性）を変更するだけでなく、画面に表示されている「案内文（テキスト文字）」も同時に変更しないとユーザーが混乱するため、<code>innerHTML</code> または <code>textContent</code> とセットで書き換えます。</p>
                <pre><code>const linkElem = document.querySelector("#my-link");

linkElem.setAttribute("href", "https://yahoo.co.jp"); // リンク先の属性書き換え
linkElem.textContent = "Yahooはこちら";               // 表示テキストの書き換え</code></pre>

                <div class="sub-heading">🛠️ スタイルプロパティをピンポイントで安全に変更する現場標準</div>
                <p>
                    <code>setAttribute()</code> による意図しないスタイル上書き消去を防ぐため、特定のプロパティ（文字サイズだけ、等）をピンポイントで変えたい場合は、前回の授業で学んだ直接指定方式（<strong>キャメルケースでの指定</strong>）を用いるのが実務の絶対的なスタンダードです。
                </p>
                <ul>
                    <li><code>para.setAttribute("style", "font-size: 3rem;");</code> ➔ ❌ 既存のスタイルが全消去される危険性あり（ケバブケース）</li>
                    <li><code>para.style.fontSize = "3rem";</code> ➔ ⭕ 既存のデザインを維持したまま、フォントサイズだけを安全に狙い撃ち変更（キャメルケース）</li>
                </ul>
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