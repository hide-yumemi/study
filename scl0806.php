<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/6(木)の職業訓練授業ノートです。JavaScriptのif文・switch文による条件分岐の基礎から、入れ子(ネスト)構造、重要なブロックスコープの概念、実技検証までをまとめています。">
    <title>8/6(木)職業訓練授業：条件分岐（if / switch）とスコープ | ポートフォリオサイト</title>
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
            <h2>8/6(木) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                プログラムの柔軟な動きを制御する「条件分岐」の書き分けと、変数の寿命を決める「スコープ」の仕組みを深く学びます。
            </p>

            <!-- セクション1：if文の基本とネスト -->
            <div class="note-section">
                <h3 class="note-title">1. if文の基本構文と入れ子（ネスト）構造</h3>
                <p>
                    与えられた条件が <code>true</code>（真）か <code>false</code>（偽）かによって処理を分岐させます。
                </p>
                
                <div class="sub-heading">基本構文</div>
<pre><code>if (判定式1) {
    // 判定式1が true の時の処理
} else if (判定式2) {
    // 判定式1が false で、判定式2が true の時の処理
} else {
    // すべての判定式が false の時の処理
}
// ※実行する命令が1行だけの場合は、波括弧 { } を省略することも可能です。</code></pre>

                <div class="sub-heading">if文の入れ子（ネスト）構造</div>
                <p>
                    <code>else</code> や <code>if</code> のブロックの内部に、さらに別の <code>if</code> 文を記述する構造を「入れ子（ネスト）」と呼びます。
                </p>
<pre><code>if (条件A) {
    // 条件Aが true の処理
} else {
    // 条件Aが false の処理
    if (条件B) {
        // 条件Aが false で、かつ条件Bが true の処理
    } else {
        // 条件Aも条件Bも false の処理
    }
}</code></pre>
                <p style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 10px; border-radius: 6px; margin-top: 10px;">
                    ⚠️<strong>設計上の注意点：</strong><br>
                    ネスト（階層）が深くなりすぎると、コードの可読性（読みやすさ）が劇的に低下し、バグの原因になります。elseブロック内でさらに細かく分岐させたい場合は、ネストに頼らず <code>else if</code> で並列に繋げられないか、あるいは論理演算子（<code>&&</code> や <code>||</code>）で条件をまとめられないかを真っ先に検討するのがスマートなコードを書くコツです。
                </p>
            </div>

            <!-- セクション2：スコープの概念 -->
            <div class="note-section">
                <h3 class="note-title">2. 変数の有効範囲「ブロックスコープ」</h3>
                <p>
                    JavaScript（特に現在の主役である <code>let</code> と <code>const</code>）では、波括弧 <strong><code>{ }</code></strong> で囲まれたブロックが、変数の有効期限・範囲（スコープ）の基準となります。
                </p>
                <ul>
                    <li><strong>ブロックスコープ：</strong> 波括弧 <code>{ }</code> の内部で定義した変数は、そのブロックの中でしか使えません。ブロックを抜けると自動的に消滅（未定義エラー）します。</li>
                    <li><strong>グローバルスコープ：</strong> <code>&lt;script&gt;</code> タグの直下など、ブロックの外側で定義された変数は、プログラム全体からいつでもアクセス可能です。</li>
                </ul>
                <p>
                    変数が必要以上に広い範囲に影響を与えないよう、有効範囲をブロック内に限定することで、意図しないデータの書き換えバグを防止します。（かつての古い <code>var</code> はこのブロックスコープを無視して広範囲に影響を与える性質があったため、現在は不使用とされています）
                </p>
            </div>

            <!-- セクション3：switch-case文 -->
            <div class="note-section">
                <h3 class="note-title">3. switch-case文の構造と利点</h3>
                <p>
                    値の判定が **「<code>===</code>（型まで含めた厳密等価）」の完全一致判定のみ** に限定されている場合に、if文よりもすっきりと高速に多分岐を書くことができる構文です。
                </p>
                
                <div class="sub-heading">主要キーワードの役割</div>
                <ul>
                    <li><strong><code>case 値:</code>：</strong> <code>switch(式)</code> の式と、caseに並べた値が <code>===</code> で一致した（true）場合にその下の処理へと進みます。</li>
                    <li><strong><code>break;</code>：</strong> 処理を実行した後、switchブロックの <code>}</code> から完全に脱出する命令です。**書き忘れると、次のcaseの処理まで続けて勝手に実行されてしまう（フォールスルーという現象）**ため注意が必要です。</li>
                    <li><strong><code>default:</code>：</strong> どのcaseの値とも一致しなかった（すべてfalseだった）場合に実行される、if文でいう <code>else</code> のような受け皿です。</li>
                </ul>

                <div class="sub-heading">caseの連続（連結）テクニック</div>
                <p>「値1、または値2、または値3のとき」と同じ処理を共有させたい場合は、以下のようにcaseを続けて並べます。</p>
<pre><code>switch (dice) {
    case 1:
    case 2:
        console.log("1マス進む"); // 1か2のときに実行される
        break;
    default:
        console.log("入力エラー");
        break;
}</code></pre>
            </div>

            <!-- セクション4：授業内ソースコードの確認 -->
            <div class="note-section">
                <h3 class="note-title">4. 授業内スクリプトと検証（境界値・中間値）</h3>
                
                <div class="sub-heading">実技1：時間判定プログラム（if文・ブロックスコープ検証）</div>
<pre><code>&lt;script&gt;
// 0～23の数値を判定。0～11は「am」、12～23は12を引いて「pm」と表示
let hour = 20;

if (hour &gt;= 0 && hour &lt;= 11) {
    console.log("am" + hour + "時");
} else if (hour &gt;= 12 && hour &lt;= 23) {
    let hour2 = hour - 12; // 💡 letはブロックスコープ
    console.log("pm" + hour2 + "時");
} else {
    console.log("入力エラー");
}

// ⚠️ 注意検証：
// ここでブロックの外側から console.log(hour2); を実行しようとすると、
// hour2は else if のブロック内でしか生きられないため、未定義エラー（ReferenceError）になります。
&lt;/script&gt;</code></pre>

                <p style="margin-top: 15px; font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
                    <strong>🔍 開発者が行うべきテスト検証ルール</strong><br>
                    プログラムが正しく組めているかをテストする際、適当な数値を1つ入れるだけでは不十分です。授業では以下の2つの視点を学びました。<br><br>
                    ・<strong>境界値（きょうかいち）テスト：</strong> 判定の分かれ目となるギリギリの数値（<code>0</code>, <code>11</code>, <code>12</code>, <code>23</code>）や、バグが起きやすい想定外の数値（<code>-1</code>, <code>24</code>）を入力し、ロジックが破綻しないか確認する。<br>
                    ・<strong>中間値テスト：</strong> 範囲内の平均的な数値（<code>6</code> 前後、<code>18</code> 前後）を入力し、通常動作を確認する。
                </p>

                <div class="sub-heading">実技2：サイコロの目判定（switch文 と if文 の書き換え）</div>
                <p>同じ仕様（1・2は1進む、3・4は2進む、5・6は3進む）を、両方の構文で書き換えた比較検証コードです。</p>
                
                <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;">
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>【switch文パターン】</strong></p>
<pre style="margin-top: 5px;"><code>&lt;script&gt;
let dice = 6;
switch (dice) {
    case 1:
    case 2:
        console.log("1マス進む");
        break;
    case 3:
    case 4:
        console.log("2マス進む");
        break;
    case 5:
    case 6:
        console.log("3マス進む");
        break;
    default:
        console.log("入力エラー");
        break;
}
&lt;/script&gt;</code></pre>
                    </div>
                    
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>【if文パターン（論理和 || ）】</strong></p>
<pre style="margin-top: 5px;"><code>&lt;script&gt;
if (dice === 1 || dice === 2) {
    console.log("1マス進む");
} else if (dice === 3 || dice === 4) {
    console.log("2マス進む");
} else if (dice === 5 || dice === 6) {
    console.log("3マス進む");
} else {
    console.log("入力エラー");
}
&lt;/script&gt;</code></pre>
                    </div>
                </div>
            </div>

            <!-- セクション5：課題演習 -->
            <div class="note-section">
                <h3 class="note-title">5. 課題演習・自己解決ログ</h3>
                <p>授業内の理解度チェック課題の考察と実装ロジックです。（※入力値は適切な前提）</p>
                
                <div class="sub-heading">課題1：偶数・奇数の判定</div>
                <p>数値を2で割った「余り（<code>%</code> 演算子）」が <code>0</code> なら偶数、<code>1</code> なら奇数となる特性を利用して判定します。</p>
<pre><code>let num = 7; // 検証用数値
if (num % 2 === 0) {
    console.log("偶数です");
} else {
    console.log("奇数です");
}</code></pre>

                <div class="sub-heading">課題2：うるう年の判定</div>
                <p>以前学んだ万年カレンダーのコアロジックを、論理演算子を駆使して再現します。</p>
<pre><code>let year = 2026;
// 条件1: 400で割り切れる
// 条件2: 4で割り切れて、かつ100で割り切れない
if (year % 400 === 0 || (year % 4 === 0 && year % 100 !== 0)) {
    console.log("うるう年です");
} else {
    console.log("平年です");
}</code></pre>
            </div>

        </main>

        <!-- 右側：更新履歴 -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
