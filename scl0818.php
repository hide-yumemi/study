<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/18(火)の職業訓練授業ノートです。JavaScriptのMathオブジェクトを用いた数値処理（切り上げ・切り捨て・四盛五入、乱数取得）、端数計算の注意点、おみくじ・トランプのアルゴリズム演習をまとめています。">
    <title>8/18(火)職業訓練授業：Mathオブジェクトと乱数制御アルゴリズム | ポートフォリオサイト</title>
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
            <h2>8/18(火) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                数学的な数値処理を司る「Mathオブジェクト」の操作方法、確率を等しく制御する乱数計算、および応用アルゴリズムの構築を学びます。
            </p>

            <!-- セクション1：基本的な数値処理プロパティ -->
            <div class="note-section">
                <h3 class="note-title">1. Mathオブジェクトの基本的な数値処理</h3>
                <p>
                    JavaScriptで数値の丸め処理（整数化）を行う場合、主に以下の4つのメソッドを使用します。これらのメソッドは引数に数値以外が渡されると、エラーではなく <code>NaN</code>（Not a Number）を返す性質があるため、バグの発見が遅れやすく注意が必要です。
                </p>
                <ul>
                    <li><strong><code>Math.abs(x)</code>：</strong> 指定した数値の「絶対値」を返します。</li>
                    <li><strong><code>Math.ceil(x)</code>：</strong> 小数点以下を「切り上げ」て整数にします。</li>
                    <li><strong><code>Math.floor(x)</code>：</strong> 小数点以下を「切り捨て」て整数にします。</li>
                    <li><strong><code>Math.round(x)</code>：</strong> 小数点以下を「四捨五入」して整数にします。</li>
                </ul>

                <div class="sub-heading">💡 応用テクニック：任意の桁数で丸める方法</div>
                <p>これらのメソッドは「小数点第〇位で切り捨てる」といった直接の桁指定ができません。そのため、特定の桁数や「100以下切り捨て」などを実現したい場合は、**【掛けて ➔ 丸めて ➔ 割る】** というステップを踏みます。</p>
<pre><code>// 例：円周率（Math.PI）を小数点第二位（3.14）で切り捨てたい場合
let enshu = Math.PI;    // 3.14159265...
enshu *= 100;           // ➔ 314.159265...（残したい桁まで小数点を移動）
enshu = Math.floor(enshu); // ➔ 314（小数点以下を切り捨てる）
enshu /= 100;           // ➔ 3.14（元の倍率に戻す）
console.log(enshu);</code></pre>

                <div class="sub-heading">📊 最大値・最小値の取得</div>
                <p>引数の中に並べられた複数の数値の中から、最大・最小の「値」そのものを抽出します。（※インデックス番号や重複個数は取得できません）</p>
<pre><code>console.log(Math.max(2, 5, 1, 7, 3, 9, 2)); // 出力: 9 (最大値)
console.log(Math.min(1, 5, 0, 3, 7, 0, 2)); // 出力: 0 (最小値)</code></pre>
            </div>

            <!-- セクション2：乱数取得と切り捨ての理由 -->
            <div class="note-section">
                <h3 class="note-title">2. 乱数取得（Math.random）と「切り捨て」を用いる理由</h3>
                <p>
                    <code>Math.random()</code> は、<strong>0以上 1未満（0 〜 0.999999...）</strong>の間の小数をランダムに1つ生成するメソッドです。これを用いて「任意の範囲の整数」を取り出すシステムを構築します。
                </p>
                
                <div class="sub-heading">① 50個の選択肢（0〜49）から1つ取り出す場合</div>
                <p><code>Math.floor(Math.random() * 50)</code> ➔ 掛け算により範囲が <code>0 〜 49.999...</code> になり、これを切り捨てることで <code>0 〜 49</code> の50個の整数が均等に出現します。</p>

                <div class="sub-heading">② 100以上 200未満の中から1つ取得する場合（最小値のスライド）</div>
                <p><code>Math.floor(Math.random() * 100) + 100</code> ➔ 「何個の候補（100個）から選ぶか」を掛け算し、最後に「範囲の最小値（+100）」を加算します。</p>

                <div class="sub-heading">❓ なぜ乱数処理では「切り捨て（floor）」一択なのか？</div>
                <ul>
                    <li><strong>切り上げ（ceil）の場合：</strong> 確率としては極めて低いものの、<code>Math.random()</code> が完全に <code>0</code> を叩き出した時に結果が <code>0</code> になってしまい、想定範囲を外れるため例外処理が必要になります。</li>
                    <li><strong>四捨五入（round）の場合：</strong> 例えば 100倍して丸める際、<code>0</code> になる範囲は「0〜0.499」、<code>1</code> になる範囲は「0.5〜1.499」となり、<strong>両端の数値（最小値と最大値）が出現する確率だけが他の半分に下がってしまう</strong>という致命的な欠陥が発生します。</li>
                    <li><strong>切り捨て（floor）の場合：</strong> すべての数値が割り当てられる範囲（幅）が「0.999...」分で完全に一致するため、**すべての確率が100%均等**になります。</li>
                </ul>
            </div>

            <!-- セクション3：実務での注意点（端数処理エラー） -->
            <div class="note-section">
                <h3 class="note-title">3. 実務開発での注意点：端数処理の累積エラー</h3>
                <p style="font-weight: bold; color: #b91c1c;">
                    POSレジや金融システムなどの計算システムを設計する際、丸め処理を「計算の都度行う」か「最後に一括で行う」かで、結果に深刻なズレ（演算1回につき最大 0.9999...）が生じます。
                </p>
                <p>
                    これはクライアントへの請求金額や売上計算の不一致という重大なトラブルに発展するため、開発開始前に必ずシステム全体、あるいはデータベース側を含めて計算ルールを厳格に統一しておく必要があります。
                </p>
            </div>

            <!-- セクション4：練習問題1（おみくじアルゴリズム） -->
            <div class="note-section">
                <h3 class="note-title">4. 演習1：確率制御おみくじプログラム</h3>
                <p>【確率設定】 大吉: 5%, 吉: 15%, 中吉: 20%, 小吉: 30%, 末吉: 25%, 凶: 5%（計100%）</p>
                
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>💡 自分のコード（不等号 <code>&lt;=</code> 判定）</strong></p>
<pre style="margin-top: 5px;"><code>&lt;script&gt;
let Kuji = Math.floor(Math.random() * 100); // 0~99
if (Kuji &lt;= 4) { console.log("大吉"); } 
else if (Kuji &lt;= 19) { console.log("吉"); } 
else if (Kuji &lt;= 39) { console.log("中吉"); } 
else if (Kuji &lt;= 69) { console.log("小吉"); } 
else if (Kuji &lt;= 94) { console.log("末吉"); } 
else { console.log("凶"); }
&lt;/script&gt;</code></pre>
                    </div>
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>✨ 先生コード（変数への格納と <code>&lt;</code> 判定の統一）</strong></p>
<pre style="margin-top: 5px;"><code>&lt;script&gt;
let KuJi = Math.floor(Math.random() * 100);
let result; // ➔ 後で一括出力するための変数を用意

if (KuJi &lt; 5) { result = "大吉"; } // 5未満
else if (KuJi &lt; 20) { result = "吉"; } // 20未満
else if (KuJi &lt; 40) { result = "中吉"; } 
else if (KuJi &lt; 70) { result = "小吉"; } 
else if (KuJi &lt; 95) { result = "末吉"; } 
else { result = "凶"; }

console.log(result); // 処理の出口を1つにする美しい設計
&lt;/script&gt;</code></pre>
                    </div>
                </div>
            </div>

            <!-- セクション5：練習問題2（トランプアルゴリズム） -->
            <div class="note-section">
                <h3 class="note-title">5. 演習2：トランプの商と余りによるマーク・数値の商算</h3>
                <p>【仕様】 1〜52の乱数から、13枚ずつの4つのマーク（スペード、ハート、クラブ、ダイヤ）と、1〜13のカード番号（11以上はJ, Q, K）を数理的に割り出します。</p>
                
                <div class="sub-heading">💡 自分のコード（1〜52の生成から逆算）</div>
<pre><code>&lt;script&gt;
let card = Math.floor(Math.random() * 52) + 1; // 1~52
let mark = Math.floor((card - 1) / 13);        // 商から 0~3 を算出
let num = ((card - 1) % 13) + 1;               // 余りから 1~13 を算出

let mark_name = "";
let num_display = "";
switch (mark) {
    case 0: mark_name = "スペード"; break;
    case 1: mark_name = "ハート"; break;
    case 2: mark_name = "クラブ"; break;
    case 3: mark_name = "ダイヤ"; break;
}
switch (num) {
    case 11: num_display = "J"; break;
    case 12: num_display = "Q"; break;
    case 13: num_display = "K"; break;
    default: num_display = num; break;
}
console.log(mark_name + "の" + num_display);
&lt;/script&gt;</code></pre>

                <div class="sub-heading">✨ 先生コード（0〜51のインデックスベースによる効率化）</div>
                <p>最初に <code>0 〜 51</code> の状態で割り算（商）を行い、判定が終わった後で <code>card1++</code> してインデックスから実際のカード番号へ補正する、メモリと計算ステップを節約した高度なロジックです。</p>
<pre><code>&lt;script&gt;
let card1 = Math.floor(Math.random() * 52); // 0~51 のベース
let mark1, num1;

// 13で割った「商」で4つのマークを一意に決定
switch (Math.floor(card1 / 13)) {
    case 0: mark1 = "スペード"; break;
    case 1: mark1 = "ハート"; break;
    case 2: mark1 = "クラブ"; break;
    case 3: mark1 = "ダイヤ"; break;
}

card1++; // ここで 1 〜 52 の正規の番号へシフト
num1 = card1 % 13; // 13で割った「余り」をカード数字にする
if (num1 == 0) { 
    num1 = 13; // 13で割り切れる（余り0）の時は、K（13）を指す
}
console.log(mark1 + "の" + num1);
&lt;/script&gt;</code></pre>
            </div>

        </main>


    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
