<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/20(木)の職業訓練授業ノートです。JavaScriptによるDOM要素の取得（従来の方法とCSSセレクタ指定の違い）、静的取得と動的取得の実験、innerHTMLとtextContentの使い分け、2重ループを用いたカレンダーの自動生成アルゴリズムを網羅しています。">
    <title>8/21(金)職業訓練授業：DOM操作の発展とカレンダー自動生成ロジック | ポートフォリオサイト</title>
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
            <h2>8/21(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                本日は、JavaScriptからHTMLを操作する「DOM操作」の基礎メソッドから、最新のCSSセレクタを用いた取得手法、そして応用実践としての「カレンダー自動生成アルゴレンダー」までを一挙に学習しました。
            </p>

            <!-- ==========================================
                 テーマ1：DOM要素の取得メソッドとスタイル操作
                 ========================================== -->
            <div class="note-section">
                <h3 class="note-title">1. 従来の要素取得メソッドとスタイル操作の文法</h3>
                <p>
                    JavaScriptを使ってHTML要素を取得する際、従来の <code>get~</code> 系のメソッドを使うと要素を動的（ライブ状態）に追跡することができます。後から要素が追加されても自動で最新の状態を追尾するため、取得した要素を格納する変数は書き換えを防ぐために <code>const</code>（定数） で宣言するのが主流です。
                </p>

                <div class="sub-heading">主要メソッドの使い分けとHTMLコレクション</div>
                <ul>
                    <li><strong><code>document.getElementById("id名")</code>：</strong> ページ内で唯一の要素を狙い撃ちします（単一要素）。</li>
                    <li><strong><code>document.getElementsByTagName("タグ名")</code> / <code>ClassName("クラス名")</code>：</strong> 該当する要素がすべて 「HTMLコレクション（HTMLCollection）」 という配列風の形式で取得されます。1つしか存在しなくても配列形式となるため、操作する際は必ず <code>[0]</code> のようにインデックスを指定するか、<code>for</code> 文でループ処理を行います。</li>
                    <li><strong><code>document.forms.name属性値</code>：</strong> フォーム要素を簡潔に取得する現場定番の記述です。</li>
                </ul>

                <div class="sub-heading">JavaScriptからのスタイル変更ルール</div>
                <p>プロパティ名はハイフンを消して <code>style.backgroundColor</code> のようにキャメルケースで記述し、値は必ず文字列（<code>"red"</code> など）として代入します。※<code>float</code> を指定する場合のみ、予約語との衝突を避けるため <strong><code>style.cssFloat</code></strong> と記述します。</p>
                <p style="font-size: 13px; color: #b91c1c; background-color: #fff5f5; padding: 10px; border-radius: 6px; margin-top: 10px;">
                    ⚠️<strong>スペルミス時の重要な内部仕様：</strong> <code>style.color</code> を誤って <code>style.calor = "red";</code> と記述してもブラウザはエラーを出しません。「calorという未知のプロパティを新設した」と解釈されるためであり、バグの発見が遅れやすいため注意が必要です。
                </p>
            </div>

            <!-- ==========================================
                 テーマ2：CSSセレクタ指定と静的・動的取得の違い
                 ========================================== -->
            <div class="note-section">
                <h3 class="note-title">2. 現代の主流：CSSセレクタによる要素指定（静的取得）</h3>
                <p>
                    現代のJavaScript開発では、CSSと完全に同じ記述（セレクタ）を使って直感的に要素をピンポイントで取得できる <strong><code>querySelector</code></strong> や <strong><code>querySelectorAll</code></strong> が主流となっています。
                </p>
                <pre><code>const col1 = document.querySelector("#col1");        // id指定（単一の要素を直接取得）
const head1 = document.querySelectorAll("h1");       // タグ指定（NodeListを取得）
const col1Para = col1.querySelectorAll("p");        // 特定要素内からさらに絞り込んで取得</code></pre>

                <div class="sub-heading">⚖️ 決定的な違い：動的取得（ライブ） vs 静的取得（スナップショット）</div>
                <p>授業内で行われた、JavaScriptで後からリスト（<code>li</code>）を動的に追加した際の、双方の挙動の違いに関する重要実験のログです。</p>
                <pre><code>const getLi = document.getElementsByTagName("li"); // ➔ 従来の動的取得
const qLi = document.querySelectorAll("li");       // ➔ セレクタによる静的取得

// 【実験】JavaScriptを使って、リストの中に「&lt;li&gt;追加リスト&lt;/li&gt;」を後から1つ割り込ませる
// （結果）
console.log(getLi.length); // 出力: 3 （自動更新され、後からの追加を検知できる！）
console.log(qLi.length);   // 出力: 2 （取得した瞬間の状態のまま固定され、追加を検知できない）</code></pre>
                <ul>
                    <li><strong>HTMLCollection（動的取得）：</strong> 常にHTMLの最新状態と同期する。</li>
                    <li><strong>NodeList（静的取得）：</strong> 検索を実行した「その瞬間」の魚拓（スナップショット）をとるため、後からの変化を反映しない。</li>
                </ul>
            </div>

            <div class="note-section">
                <h3 class="note-title">3. innerHTML と textContent の明確な使い分け</h3>
                <p>取得した要素の中身（文字や子要素）を書き換えたり取得したりする際の、最も頻出するプロパティの仕様差です。</p>
                <ul>
                    <li><strong><code>innerHTML</code>：</strong> 対象要素の中のHTMLタグも含めて構造ごと丸ごと操作します。
                        <br>➔ <code>UList[0].innerHTML</code> の結果：<code>&lt;li&gt;リスト1&lt;/li&gt;&lt;li&gt;リスト2&lt;/li&gt;</code>
                    </li>
                    <li><strong><code>textContent</code>：</strong> HTMLタグはすべて除外され、その中に含まれている純粋な「剥き出しの文字列」だけを抽出・操作します。
                        <br>➔ <code>UList[0].textContent</code> の結果：<code>リスト1 リスト2</code>
                    </li>
                </ul>
            </div>

            <!-- ==========================================
                 テーマ3：ループ（for文）によるカレンダー自動生成
                 ========================================== -->
            <div class="note-section">
                <h3 class="note-title">4. 応用実技：2重ループによるカレンダーテーブルの自動生成</h3>
                <p>
                    JavaScriptの繰り返し処理（for文のネスト構造）を用いて、HTML側の空のテーブル（<code>id="calendar-table"</code>）の中に、縦横の行列をマトリクス状に自動組み立てし、日付を流し込む高度なアルゴリズムです。
                </p>

                <div class="sub-heading">🔄 2重ループの仕組み（5行 × 7列 の構築）</div>
                <p>外側のループ（変数 <code>i</code>）が「週間（行）」を5回繰り返し、内側のループ（変数 <code>j</code>）が「日曜日〜土曜日までの7日間（列）」を繰り返すことで、綺麗なカレンダーの土台が一瞬で出力されます。</p>

                <pre><code>&lt;script&gt;
let tblText = ""; // カレンダーのHTML文字列を溜める変数
let day = 1;      // カレンダーに流し込む日付のカウンター初期値

// 外側ループ: 行（1週間単位）を 5回 繰り返す
for (let i = 0; i &lt; 5; i++) {
    tblText += "&lt;tr&gt;"; // 行の開始
    
    // 内側ループ: 列（曜日・日）を 7回 繰り返す
    for (let j = 0; j &lt; 7; j++) {
        tblText += "&lt;td&gt; " + day + " &lt;/td&gt;"; // マスの中に日付を出力
        day++; // 日付を1つ進める
    }
    
    tblText += "&lt;/tr&gt;"; // 行の終了
}

// 最後に、生成した大量のtr・td文字列を一気にHTMLへ流し込んで画面に描画させる
document.getElementById("calendar-table").innerHTML = tblText;
&lt;/script&gt;</code></pre>
            </div>

            <!-- セクション5：命名規則（ケース）のまとめ -->
            <div class="note-section">
                <h3 class="note-title">5. プログラミングにおける各種命名規則（ケース）</h3>
                <p>定数名やプロパティの指定時に登場する各種命名規則の特徴です。開発現場やチームの規約に合わせて厳格に統一されます。</p>

                <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 14.5px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; width: 25%;">ケース名</th>
                            <th style="padding: 10px; text-align: left; width: 45%;">書き方の特徴</th>
                            <th style="padding: 10px; text-align: left;">具体例（list-style）</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>キャメルケース</strong></td>
                            <td style="padding: 10px;">2つ目以降の単語の頭文字を大文字にする。（ラクダのコブ）</td>
                            <td style="padding: 10px;"><code>listStyle</code></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>パスカルケース</strong></td>
                            <td style="padding: 10px;">単語の頭文字をすべて大文字にする。（アッパーキャメル）</td>
                            <td style="padding: 10px;"><code>ListStyle</code></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>スネークケース</strong></td>
                            <td style="padding: 10px;">単語間をアンダースコア（ <code>_</code> ）で繋ぐ。（ヘビ）</td>
                            <td style="padding: 10px;"><code>list_style</code></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>ケバブケース</strong></td>
                            <td style="padding: 10px;">単語間をハイフン（ <code>-</code> ）で繋ぐ。※CSSの標準記述</td>
                            <td style="padding: 10px;"><code>list-style</code></td>
                        </tr>
                    </tbody>
                </table>
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