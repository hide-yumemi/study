<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/20(木)の職業訓練授業ノートです。JavaScriptによるDOM要素の動的取得（getElementById / getElementsByTagNameなど）、HTMLコレクションのループ制御、style属性の変更ルールについてまとめています。">
    <title>8/20(木)職業訓練授業：DOM要素の動的取得とスタイル操作 | ポートフォリオサイト</title>
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
            <h2>8/20(木) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                HTMLの要素をJavaScriptに読み込み、デザインや文字を動的に書き換える「DOM操作」の基礎を深く学びます。
            </p>

            <!-- セクション1：動的取得の概念 -->
            <div class="note-section">
                <h3 class="note-title">1. DOM要素の「動的取得」とは</h3>
                <p>
                    JavaScriptを使ってHTML要素を取得する際、<code>get~</code> 系のメソッドを使うと要素を**動的（ライブ状態）**に追跡することができます。
                </p>
                <p>
                    これは、JavaScriptによって後からHTML内に新しく要素（リスト項目など）が追加された場合でも、事前に取得した要素データの中に自動的に最新の状態が反映され、再取得することなくそのまま操作を続けられる非常に便利な仕組みです。
                </p>
                <p>
                    このため、常に最新の状態を自動で追尾してくれる特性から、取得した要素を格納する変数は書き換えを防ぐために **<code>const</code>（定数）** で宣言するのが現在のモダンなWeb開発の主流となっています。
                </p>
            </div>

            <!-- セクション2：要素を取得する4大メソッド -->
            <div class="note-section">
                <h3 class="note-title">2. 要素を取得する主要メソッドの使い分け</h3>
                <p>HTMLドキュメント全体（<code>document</code>）から探す手法と、特定の要素内からさらに絞り込んで探す手法があります。</p>
                
                <div class="sub-heading">① id名による要素の取得（単一要素）</div>
                <p>ページ内で唯一の要素を狙い撃ちします。最も処理が高速です。</p>
<pre><code>const 定数名 = document.getElementById("id名");</code></pre>

                <div class="sub-heading">② タグ名・クラス名による取得（複数要素 ➔ HTMLコレクション）</div>
                <p>同名の要素が複数存在する可能性があるため、取得結果は単一の要素ではなく、配列のような形をした **「HTMLコレクション（HTMLCollection）」** という形式で丸ごと格納されます。</p>
<pre><code>// 全体から取得
const 定数名 = document.getElementsByTagName("タグ名");
const 定数名 = document.getElementsByClassName("クラス名");

// 💡 応用：事前に取得した特定の要素（親エリア）の中から、さらに絞り込んで子要素を取得する
const areaHead = 取得済みの親要素.getElementsByTagName("h2");</code></pre>

                <div class="sub-heading">③ フォーム要素専用の取得（Name属性）</div>
                <p><code>document.getElementsByName("name値")</code> も使用できますが、フォーム部品を操作する場合は、コードがより簡潔に書ける以下の記述が現場で好まれて使用されます。</p>
<pre><code>const formItem = document.forms.name属性値; // HTMLコレクション形式で取得</code></pre>
            </div>

            <!-- セクション3：HTMLコレクションの扱い方 -->
            <div class="note-section">
                <h3 class="note-title">3. HTMLコレクションの厳密な操作ルール</h3>
                <p>
                    <code>TagName</code> や <code>ClassName</code> で取得した要素は、たとえ画面上に**該当する要素が1つしか存在しなくても配列形式**として扱われます。
                </p>
                
                <div class="sub-heading">❌ 間違えやすいNGコード</div>
<pre><code>const head1 = document.getElementsByTagName("h1");
head1.style.color = "blue"; // ❌ エラーになります（配列全体に直接スタイルは塗れません）</code></pre>

                <div class="sub-heading">⭕ 正しい個別指定コード</div>
                <p>配列と同じように <code>[インデックス番号]</code>（0番から開始）を明示して、要素をピンポイントに指定する必要があります。</p>
<pre><code>head1[0].style.color = "blue"; // ⭕ 最初のh1要素を指定しているので正常動作します</code></pre>

                <div class="sub-heading">🔁 まとめて一括処理する場合は for文 を使用</div>
                <p>CSSのようにすべてのタグへ自動適用はされないため、ループを回して1つずつ処理を施します。</p>
<pre><code>const textItems = document.getElementsByClassName("text");
for (let i = 0; i &lt; textItems.length; i++) {
    textItems[i].style.fontWeight = "bold"; // すべての該当要素を太字に
}</code></pre>
            </div>

            <!-- セクション4：JavaScriptからのスタイル変更 -->
            <div class="note-section">
                <h3 class="note-title">4. JavaScriptからCSSスタイルを変更する文法規則</h3>
                <p>要素のスタイルプロパティを書き換える際は、CSSの文法をJavaScript用に変換して記述します。</p>
                
                <div class="sub-heading">① プロパティ名はハイフンを消して「キャメルケース」</div>
                <ul>
                    <li><code>background-color</code> ➔ <code>style.backgroundColor</code></li>
                    <li><code>list-style</code> ➔ <code>style.listStyle</code></li>
                    <li>⚠️<strong>例外：</strong> <code>float</code> はJavaScriptの予約語と衝突するため、<strong><code>style.cssFloat</code></strong> と指定する必要があります。</li>
                </ul>

                <div class="sub-heading">② スタイルに渡す「値」は必ず文字列としてクォーテーションで囲む</div>
                <p>CSSでのカラー指定（一括指定含む）や単位は、そのまま文字列として代入します。</p>
<pre><code>element.style.background = "rgb(255 0 0 / 0.5)"; // 単位やスペースの記述もそのまま文字化</code></pre>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    ⚠️<strong>スペルミス時の重要な内部仕様</strong><br>
                    例えば <code>style.color</code> を誤って <code>style.calor = "red";</code> と記述した場合、**ブラウザはエラーを出力しません。**<br>
                    JavaScriptの仕様上、「<code>calor</code> という未知の新しいプロパティを新設し、そこに値を代入した」と解釈されるためです。将来CSSに新しいプロパティが追加されてもシステムが停止しないための柔軟な仕様ですが、記述ミスに非常に気づきにくいため開発時は注意深くコードを追う必要があります。
                </p>
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
