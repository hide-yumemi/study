<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/31(月)の職業訓練授業ノートです。JavaScriptのthisを用いた関数の共通化、4大マウス座標の基準の違い、キーボードイベントの各種情報取得、フロントエンド・バリデーションのセキュリティ上の注意点をまとめています。">
    <title>8/31(月)職業訓練授業：thisの共通化・イベントオブジェクトの深掘りとフォーム検証 | ポートフォリオサイト</title>
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
            <h2>8/31(月) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                8月最終日。イベント発生源を特定するthisのロジック、各種入力デバイスから詳細情報を引き出す手法、およびWebアプリケーション設計における安全性について学びます。
            </p>

            <!-- セクション1：thisの活用による関数の汎用化 -->
            <div class="note-section">
                <h3 class="note-title">1. thisの活用による関数の共通化（再利用性の向上）</h3>
                <p>
                    イベントによって実行される関数内で <strong><code>this</code></strong> キーワードを使用すると、その関数を複数の異なるHTML要素間で完全に使い回す（汎用化・共通化する）ことが可能になります。
                </p>
                <p>
                    関数内での <code>this</code> は、**「今まさにそのイベントを発生させた張本人の要素（クリックされた要素など）」**を自動的かつ動的に指し示します。これにより、要素の数だけ個別に似たような関数を量産する無駄を完全に排除できます。
                </p>
                
                <div class="sub-heading">💡 実装ロジックの例</div>
<pre><code>&lt;script&gt;
const head1 = document.getElementsByTagName("h1");
const para = document.getElementsByTagName("p");

// 1つに美しく共通化された関数
function changeColor() {
    this.style.color = "red"; // ➔ thisは「実際にクリックされた要素」に変身する
}

// どの要素に対しても同じ関数を使い回して登録可能
head1[0].onclick = changeColor; // h1をクリック ➔ そのh1が赤くなる
para[0].onclick = changeColor;  // pをクリック  ➔ そのpが赤くなる
&lt;/script&gt;</code></pre>

                <div class="sub-heading">⚠️ 実務の落とし穴：this とアロー関数の相性問題</div>
                <p>
                    近年主流のモダンな記述である**アロー関数（ <code>() =&gt; {}</code> ）**の内部では、<code>this</code> の持つ意味が固定化され、イベント発生源ではなく <code>window</code> オブジェクトを指してしまう性質（レキシカルスコープ）があります。
                </p>
                <ul>
                    <li>❌ <code>para.onclick = () =&gt; { this.style.color = "red"; };</code> ➔ 動作しません（windowのスタイルを変えようとするためエラー）</li>
                    <li>⭕ <code>para.onclick = (e) =&gt; { e.currentTarget.style.color = "red"; };</code> ➔ アロー関数を使用する場合は、引数のイベントオブジェクトから <strong><code>e.currentTarget</code></strong> を用いることで安全に同じ処理を実現できます。</li>
                </ul>
            </div>

            <!-- セクション2：マウスイベントにおける4つの座標取得 -->
            <div class="note-section">
                <h3 class="note-title">2. マウスイベントにおける4大座標の基準位置と使い分け</h3>
                <p>
                    クリックやマウス移動時、関数に自動で渡される引数（イベントオブジェクト <code>e</code> ）を解析することで、カーソル位置の正確な座標数値をピクセル単位で取得できます。目的のUIに応じて適切なプロパティを選択します。
                </p>
                
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; width: 25%;">プロパティ名</th>
                            <th style="padding: 10px; text-align: left;">基準となる位置（原点 0, 0 の場所）と特徴</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong><code>e.screenX / e.screenY</code></strong></td>
                            <td style="padding: 10px;">ユーザーが使用している**ディスプレイ画面全体（モニター）の左上**が基準。<br><small>※ブラウザの外側を含むPC全体の絶対位置を測る際に使用します。</small></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong><code>e.clientX / e.clientY</code></strong></td>
                            <td style="padding: 10px;">ブラウザの**ビューポート（現在見えている画面表示領域）の左上**が基準。<br><small>※ページをどれだけスクロールしても、見えている画面内での位置は一定です。</small></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong><code>e.pageX / e.pageY</code></strong></td>
                            <td style="padding: 10px;"><strong>HTMLページ全体の左上</strong>が基準。<br><small>※下にスクロールアウトした隠れている領域のピクセル分も加算して算出されます。</small></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong><code>e.offsetX / e.offsetY</code></strong></td>
                            <td style="padding: 10px;">イベントが発生した**そのターゲット要素自身の枠内の左上**が基準。<br><small>※要素内での相対的なクリック位置（ボタンの真ん中を押した、等）を割り出せます。</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- セクション3：キーボードイベント -->
            <div class="note-section">
                <h3 class="note-title">3. キーボードイベントと取得できる3種の情報</h3>
                <p>キーの押し込みを検知するイベントは、検知範囲や文字変換タイミングの仕様を考慮して選択します。</p>
                <ul>
                    <li><strong><code>onkeydown</code>：</strong> 物理キーが押し込まれた瞬間に発火。文字キー以外（Shift, Tab, Enterなど）の**すべてのキーを完全に検知可能**なため、現場の実務の主戦力です。</li>
                    <li><strong><code>onkeyup</code>：</strong> 押し込まれたキーが「離された瞬間」に発火。
                        <br><small>※重要：<code>onkeydown</code> の時点では入力文字がテキストエリアに反映される直前のため、文字数カウントを行うと1文字遅れて計算されてしまいます。正確な文字数判定を行いたい場合は、文字が完全に確定して指が離れた <strong><code>onkeyup</code></strong> を選択するのが定石です。</small>
                    </li>
                </ul>

                <div class="sub-heading"> e.onkeydown 時にオブジェクトから抽出できる情報</div>
<pre><code>function checkKey(e) {
    console.log(e.code);    // ① 物理キーの位置を返却（例: "KeyA", "ShiftLeft"）
    console.log(e.key);     // ② 入力された文字そのものを返却（例: "A", "a" 大小文字区別あり）
    console.log(e.keyCode); // ③ キー固有の識別番号を数値で返却（すべてのキーがコード数値化）
}</code></pre>
            </div>

            <!-- セクション4：フォーム入力内容の取得とバリデーション -->
            <div class="note-section">
                <h3 class="note-title">4. フォームデータの取得とフロントエンド・バリデーションの限界</h3>
                <p>
                    入力フォームにユーザーが打ち込んだ文字列は、対象要素の <strong><code>.value</code></strong> プロパティを参照することでJavaScript側に簡単に引き出すことができます。
                </p>

                <div class="sub-heading">🤝 プロの実務スタンダード：検証は submit イベントでキャッチする</div>
                <p>単なるボタンのクリックイベントではなく、フォーム全体の送信を監視する <code>onsubmit</code> でバリデーション（入力チェック）を走らせるのが業界標準です。</p>
<pre><code>// フォームの送信（ボタンクリックやEnterキー打鍵）を包括してキャッチ
myForm.onsubmit = function(e) {
    if (inputUser.value === "") {
        alert("ユーザー名を入力してください");
        return false; // ➔ 前回の授業内容：action先へのデータ暴発送信を強力に差し止める
    }
};</code></pre>
                <p>
                    Enterキーでの誤送信チェックも同時に網羅できるため、優れたユーザー入力支援（UX向上）につながります。
                </p>

                <p class="note" style="font-size: 14px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; border-left: 4px solid #b91c1c; margin-top: 15px;">
                    ⚠️<strong>【超重要】セキュリティ設計の境界線（採用面接の必須知識）</strong><br>
                    JavaScriptを用いたバリデーションは、ユーザーにエラーをその場で一瞬で知らせる**「入力支援（サービス）」**としては完璧ですが、**「セキュリティ（防御）」としては全く機能しません。**<br><br>
                    JavaScriptはブラウザ側の設定で簡単に無効化でき、開発者ツールを使えばチェックロジックそのものを悪意ある攻撃者によって一瞬で書き換え・無効化（改ざん）できるためです。不正データや悪意あるスクリプトの混入を完全に防ぐための本チェック・防御機構は、ユーザーの手の届かない安全な領域である**「サーバー側（PHPやデータベースのバックエンド）」で100%実装しなければならない**、というのがWeb業界の絶対的なセキュリティ鉄則です。
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
