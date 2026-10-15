<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/7(金)の職業訓練授業ノートです。前日の課題解答（うるう年判定のswitch/if書き換え）をはじめ、while文、do-while文によるループ処理の基礎、break文による制御、alert()の挙動をまとめています。">
    <title>8/7(金)職業訓練授業：ループ処理（while / do-while）と制御 | ポートフォリオサイト</title>
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
            <h2>8/7(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
              プログラムに反復処理命令を下す「ループ文（while / do-while）」の完全マスターを目指します。
            </p>

            <!-- セクション1：課題解答レビュー -->
            <div class="note-section">
                <h3 class="note-title">1. 課題解答・解説レビュー</h3>
                <p>授業の理解度チェック課題に対する、実践的な実装パターンとロジックの確認です。</p>
                
                <div class="sub-heading">課題1：偶数・奇数の判定（if文）</div>
                <p>数値を <code>2</code> で割った余りが <code>0</code> であれば偶数、それ以外（<code>1</code>）であれば奇数と判定します。</p>
<pre><code>&lt;script&gt;
let num = 1500;
if (num % 2 === 0) {
    console.log("偶数");
} else {
    console.log("奇数");
}
&lt;/script&gt;</code></pre>

                <div class="sub-heading">課題2：うるう年の判定（応用：switch文による条件判定）</div>
                <p>通常、switch文は値の完全一致（<code>===</code>）にしか使えませんが、<strong><code>switch (true)</code></strong> と記述することで、各 <code>case</code> の中に条件式を書き込むという応用テクニックが使えます。</p>
<pre><code>&lt;script&gt;
let age = 2030;
switch (true) {
    case (age % 400 === 0):
    case (age % 4 === 0 && age % 100 !== 0):
        console.log("うるう年");
        break;
    default:
        console.log("それ以外");
        break;
}
&lt;/script&gt;</code></pre>

                <div class="sub-heading">課題2：if文でスマートに記述する場合（論理の反転）</div>
<pre><code>&lt;script&gt;
let age = 1404;
if (age % 400 === 0 || (age % 4 === 0 && age % 100 !== 0)) {
    console.log("うるう年");
} else {
    console.log("それ以外");
}
// 💡 論理反転の補足知識：
// 「100で割り切れない」という条件は、!(age % 100 == 0) のように、
// 結果の true/false をビックリマーク（ ! ）で反転させることでも表現可能です。
&lt;/script&gt;</code></pre>
            </div>

            <!-- セクション2：while文 -->
            <div class="note-section">
                <h3 class="note-title">2. while文（ループ処理）の基本と無限ループの罠</h3>
                <p>
                    指定した条件式が <code>true</code>（真）である間、ブロック <code>{ }</code> 内の処理を何度も繰り返し実行する構文です。
                </p>
<pre><code>while (判定式) {
    // 条件が true の間、繰り返し実行される処理
}</code></pre>
                
                <p style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 10px; border-radius: 6px; margin-top: 10px;">
                    ⚠️<strong>超重要：無限ループ（無限回数）の回避</strong><br>
                    while文を記述する際は、<strong>「いつか必ず条件式が false になってループが終了する仕組み（カウンターの加算など）」</strong>がブロック内に含まれているかを絶対に確認してください。条件が true のまま固定されると、プログラムが永久に止まらなくなり（無限ループ）、ブラウザがフリーズしたりPCの動作に重大な問題を引き起こします。
                </p>

                <div class="sub-heading">実践でよく使われる `while(true)` と `break` の組み合わせ</div>
                <p>あえて <code>while (1)</code> や <code>while (true)</code> で永久ループを作り、ブロック内部の <code>if</code> 文で終了条件を判定して <strong><code>break;</code></strong> で強制脱出させる構造は、実務の現場でも非常に頻出する綺麗なパターンです。</p>
<pre><code>while (true) {
    // 永久にループする処理
    if (ループを終わらせたい条件) {
        break; // 💡 ループをその場で強制終了し、ブロックから脱出する
    }
}</code></pre>
            </div>

            <!-- セクション3：do-while文 -->
            <div class="note-section">
                <h3 class="note-title">3. do-while文（必ず1回は実行するループ）</h3>
                <p>普通のwhile文は、最初に繰り返すかどうかのチェックを行うため、最初から条件が合わない場合は1度も実行されません。それに対し、<code>do-while</code> 文は**「最初に必ず1回処理を行ってから、継続の条件判定を行う」**という特性を持ちます。</p>
                
                <div class="sub-heading">基本構造</div>
<pre><code>do {
    // 最初に必ず1回は実行され、以後条件が true の間繰り返される処理
} while (継続条件);</code></pre>

                <div class="sub-heading">コードでの挙動確認</div>
<pre><code>&lt;script&gt;
let numC = 0;
do {
    numC++;
} while (false); // 💡 最初から継続条件を「進まない（false）」に設定

console.log(numC); // ➔ 最初の一歩を必ず通るため、結果は「1」になります。
&lt;/script&gt;</code></pre>

                <p style="margin-top: 15px; font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
                    <strong>⚠️ do-while文における記述の落とし穴</strong><br>
                    JavaScriptでは、波括弧 <code>{ }</code> で終わる構文（if文や通常のwhile文）の末尾にはセミコロン（ ; ）は不要です。<br>
                    しかし、do-while文の最後は <code>while (条件);</code> という形式で、中カッコではなく丸カッコで終了します。そのため、<strong>「ここで構文が終わりです」という目印として、末尾に必ずセミコロン（ ; ）を記述するルール</strong>になっているので注意しましょう。
                </p>
            </div>

            <!-- セクション4：alert()の活用 -->
            <div class="note-section">
                <h3 class="note-title">4. アラート表示（alert）と開発デバッグへの応用</h3>
                <p>
                    <code>alert("メッセージ");</code> を実行すると、ブラウザの最前面にポップアップウィンドウが表示され、ユーザーにOKボタンのクリックを求めます。
                </p>
                <ul>
                    <li><strong>プログラムの一時停止効果：</strong> ポップアップが表示されている間、<strong>JavaScriptのすべての処理はバックグラウンドを含めて完全に一時停止</strong>します。ユーザーが「OK」をクリックしてウィンドウを閉じることで、初めて次の行の処理が再開されます。</li>
                    <li><strong>デバッグ（バグ探し）への応用：</strong> 通常はユーザーへの通知に利用しますが、ループ文が意図通りに回っているか、変数の値が途中でどう変わっているかを1ステップずつ目視で確認するための「簡易的なデバッグツール」としても非常に重宝します。</li>
                </ul>
            </div>

            <!-- セクション5：実技・動作チェックログ -->
            <div class="note-section">
                <h3 class="note-title">5. 実技：1から順に足して合計が100を超える瞬間を計算</h3>
                <p>「1 + 2 + 3 + ...」と値を順に加算していき、合計（sum）が100を超えた時点でループを終了させ、その結果を確認する仕様を、2つのアプローチで実装した検証ログです。</p>
                
                <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;">
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>【通常のwhile文アプローチ】</strong></p>
<pre style="margin-top: 5px;"><code>&lt;script&gt;
let num = 1; // 足していく数値
let sum = 0; // 合計をためる箱

while (sum &lt;= 100) { // 合計が100以下の間ループ
    sum += num;       // sum = sum + num と同義
    num++;            // 次に足す数値を+1する
}
console.log(sum); // 結果: 105 (14まで足した時点で100を超えて終了)
console.log(num); // 結果: 15 (ループを抜ける直前にインクリメントされた値)
&lt;/script&gt;</code></pre>
                    </div>
                    
                    <div style="flex: 1; min-width: 280px;">
                        <p><strong>【while(true) と break アプローチ】</strong></p>
<pre style="margin-top: 5px;"><code>&lt;script&gt;
let numA = 1; // 💡 キャメルケース命名
let sumA = 0;

while (true) {
    sumA += numA;
    if (sumA &gt; 100) {
        break; // 💡 合計が100を超えた瞬間にその場で強制終了
    }
    numA++;
}
console.log(sumA); // 結果: 105
console.log(numA); // 最後に足し算された正確な数値（14）が出力される
&lt;/script&gt;</code></pre>
                    </div>
                </div>
            </div>

        </main>

     </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
