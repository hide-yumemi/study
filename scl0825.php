<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/25(火)の職業訓練授業ノートです。JavaScriptによる新しい要素の動的挿入メソッド(insertAdjacentHTML)の仕様、4つの挿入位置、タイポを防ぐ配列化テクニック、動的・静的取得による追加要素への影響実験をまとめています。">
    <title>8/25(火)職業訓練授業：要素の動的挿入と取得メソッドによる挙動の差異実験 | ポートフォリオサイト</title>
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
            <h2>8/25(火) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                指定位置へHTMLをダイレクトに注入する <code>insertAdjacentHTML()</code> の完全マスターと、DOMの追加要素が各種取得メソッドに与える影響の検証です。
            </p>

            <!-- セクション1：insertAdjacentHTMLの基本と位置指定 -->
            <div class="note-section">
                <h3 class="note-title">1. 要素を任意の場所に挿入する insertAdjacentHTML()</h3>
                <p>
                    既存のHTML要素を基準にして、新しいタグ（要素）や文字列を任意の場所にピンポイントで挿入する強力なメソッドです。
                </p>
<pre><code>// 構文
（取得した基準要素）.insertAdjacentHTML(挿入する場所, 'タグを含む挿入したい文字列');</code></pre>

                <div class="sub-heading">📐 4つの挿入位置（引数文字列の規則性）</div>
                <p>場所の指定には英語の組み合わせ（前後の <code>before/after</code> ＋ 開始・終了の <code>begin/end</code>）からなる4つの固定文字列を使用します。</p>
                
                <!-- 視覚的図解ブロック -->
                <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 15px; margin: 15px 0; font-family: monospace; font-size: 14.5px; line-height: 1.8;">
                    <div>🟢 <strong>'beforebegin'</strong> ➔ 【要素の直前（外側）】</div>
                    <div style="color: #1e3a8a; font-weight: bold;">&lt;p id="text"&gt;</div>
                    <div style="padding-left: 20px;">🔵 <strong>'afterbegin'</strong> ➔ 【要素内の先頭（内側）】</div>
                    <div style="padding-left: 20px; color: #64748b;">元のテキストコンテンツ</div>
                    <div style="padding-left: 20px;">🟠 <strong>'beforeend'</strong> ➔ 【要素内の末尾（内側）】</div>
                    <div style="color: #1e3a8a; font-weight: bold;">&lt;/p&gt;</div>
                    <div>🔴 <strong>'afterend'</strong> ➔ 【要素の直後（外側）】</div>
                </div>

                <div class="sub-heading">コード例と最終出力結果</div>
                <p>基準となるHTML： <code>&lt;p id="text"&gt;テキスト&lt;/p&gt;</code> に対し、それぞれを実行した場合のDOMの形状です。</p>
                <ul>
                    <li><code>p.insertAdjacentHTML('beforebegin', '&lt;span&gt;①&lt;/span&gt;');</code><br>➔ <code>&lt;span&gt;①&lt;/span&gt;&lt;p&gt;テキスト&lt;/p&gt;</code></li>
                    <li><code>p.insertAdjacentHTML('afterbegin', '&lt;span&gt;②&lt;/span&gt;');</code><br>➔ <code>&lt;p&gt;&lt;span&gt;②&lt;/span&gt;テキスト&lt;/p&gt;</code></li>
                    <li><code>p.insertAdjacentHTML('beforeend', '&lt;span&gt;③&lt;/span&gt;');</code><br>➔ <code>&lt;p&gt;テキスト&lt;span&gt;③&lt;/span&gt;&lt;/p&gt;</code></li>
                    <li><code>p.insertAdjacentHTML('afterend', '&lt;span&gt;④&lt;/span&gt;');</code><br>➔ <code>&lt;p&gt;テキスト&lt;/p&gt;&lt;span&gt;④&lt;/span&gt;</code></li>
                </ul>
            </div>

            <!-- セクション2：タイポ防止テクニックと代替パターン -->
            <div class="note-section">
                <h3 class="note-title">2. 実務の品質を高めるコーディングテクニック</h3>
                
                <div class="sub-heading">🤝 引数の「タイポ（打ち間違い）」を完全に防ぐ配列化手法</div>
                <p>
                    <code>"beforebegin"</code> などの長い文字列は、コード内で何度も手書きするとスペルミスによるバグを引き起こしがちです。これを防ぐため、あらかじめ場所の指定文字列を配列に格納しておく設計技法を学びました。
                </p>
<pre><code>// 4つのキーワードを配列に定義
let insArr = ["beforebegin", "afterbegin", "beforeend", "afterend"];

// 手書きを避け、配列のインデックスで安全に場所を指示
Ulist[0].insertAdjacentHTML(insArr[0], "&lt;p&gt;リスト前&lt;/p&gt;"); // beforebegin
Ulist[0].insertAdjacentHTML(insArr[2], "&lt;p&gt;リスト後&lt;/p&gt;"); // beforeend</code></pre>

                <div class="sub-heading">💡 補足：createElement の記述パターンとの比較</div>
                <p>
                    要素を動的に生み出すもう1つのアプローチとして、<code>const elem = document.createElement("div");</code> を使う方法があります。これは先にメモリ上に「divの空の器」だけを生成し、その器に対して後から <code>innerHTML</code> や <code>textContent</code> で文章を流し込んでからDOMツリーへ接続する手法で、実務や教材でも非常に多く利用される王道パターンです。
                </p>
            </div>

            <!-- セクション3：実技 動作チェックと核心の実験 -->
            <div class="note-section">
                <h3 class="note-title">3. 実技検証：追加要素に対する「動的」vs「静的」の挙動の差異</h3>
                <p>
                    要素を追加した「後」のタイミングにおいて、従来の get~系（動的オブジェクト）と query~系（静的オブジェクト）で、要素の認識能力にどのような決定的違いが現れるかを検証する重要な実験ログです。
                </p>
                
                <div class="sub-heading">🛠️ 1. 初期状態の取得（この時点ではどちらも同じ要素数 2 を認識）</div>
<pre><code>// 元の構造: &lt;ul&gt;&lt;li&gt;リスト1&lt;/li&gt;&lt;li&gt;リスト2&lt;/li&gt;&lt;/ul&gt;
const Ulist = document.getElementsByTagName("ul"); // 基準ulの取得

const docLi = document.getElementsByTagName("li"); // ➔ 従来の get~（動的取得）
const selLi = document.querySelectorAll("li");       // ➔ 現代の query~（静的取得）

console.log(docLi.length); // 結果：2
console.log(selLi.length); // 結果：2</code></pre>

                <div class="sub-heading">🛠️ 2. insertAdjacentHTMLによる要素の動的追加を実行</div>
<pre><code>let insArr = ["beforebegin", "afterbegin", "beforeend", "afterend"];

Ulist[0].insertAdjacentHTML(insArr[0], "&lt;p&gt;リスト前&lt;/p&gt;");
Ulist[0].insertAdjacentHTML(insArr[1], "&lt;li&gt;リスト先頭&lt;/li&gt;"); // 💡 新しいliを追加
Ulist[0].insertAdjacentHTML(insArr[2], "&lt;li&gt;リスト最後&lt;/li&gt;"); // 💡 新しいliを追加
Ulist[0].insertAdjacentHTML(insArr[3], "&lt;p&gt;リスト後&lt;/p&gt;");</code></pre>

                <div class="sub-heading">🔍 3. 核心：追加完了後のスタイル変更における、認識された数の違い</div>
                <p>デベロッパーツール（F12）で確認すると、追加後の <code>li</code> の総数は物理的に**4つ**に増えています。この状態で両者の変数を使ってループ処理を行うと、デザインの適用範囲に決定的な差が生まれます。</p>
                
                <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;">
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>🔴 動的オブジェクト（docLi）による処理</strong></p>
<pre style="margin-top: 5px;"><code>// 文字色を赤に変更
for (let i = 0; i &lt; docLi.length; i++) {
    docLi[i].style.color = "red";
}
// 📝 結果：
// ライブ状態で追尾しているため、自動で要素数「4」を認識。
// 後から追加された先頭・最後のliも含めた【4個すべて】が赤くなります！</code></pre>
                    </div>
                    
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>🔵 静的オブジェクト（selLi）による処理</strong></p>
<pre style="margin-top: 5px;"><code>// 文字色を青に変更
for (let i = 0; i &lt; selLi.length; i++) {
    selLi[i].style.color = "blue";
}
// 📝 結果：
// 取得した瞬間のスナップショットのまま固定されているため、要素数「2」から更新されません。
// 追加のliは完全に無視され、【元々の2個だけ】が青くなります！</code></pre>
                    </div>
                </div>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px; border-left: 4px solid #b91c1c;">
                    <strong>⚠️ システム設計における超重要結論：</strong><br>
                    「要素をJavaScriptで動的に追加した後に、その要素も含めて一括でイベントを設定したりデザインを変更したい」という仕様の場合、取得タイミングをずらす（追加後に再取得する）コードを書くか、あるいは最初から自動同期してくれる <code>getElementById</code> などの動的オブジェクト（HTMLCollection）を使って定数管理しておかないと、デザインが部分的に崩れる重篤なフロントエンドのバグに直結します。
                </p>
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
