<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/10(月)の職業訓練授業ノートです。JavaScriptのfor文の基本構造（初期化式・条件式・更新式）、ループ文（while/do-while）の明確な使い分けの基準、実技検証やアルゴリズム問題（倍々貯金）をまとめています。">
    <title>8/10(月)職業訓練授業：for文の構造とループの使い分け | ポートフォリオサイト</title>
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
            <h2>8/10(月) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                反復処理の標準である「for文」の仕組みを解剖し、状況に応じたループ構文の選択基準、および実践的なアルゴリズムの実装を学びます。
            </p>

            <!-- セクション1：for文の基本構造 -->
            <div class="note-section">
                <h3 class="note-title">1. for文の基本構造と実行メカニズム</h3>
                <p>
                    回数が決まっている繰り返し処理を行う際、最も標準的に使用される構文です。3つの式を1行の中に記述します。
                </p>
                <pre><code>for (初期化式; 条件式; 更新式) {
    // ループ処理（繰り返したい命令）
}</code></pre>

                <div class="sub-heading">各式の役割と特徴</div>
                <ul>
                    <li><strong>初期化式：</strong> ループ開始時に最初の一度だけ実行されます。一般的に <code>let i = 0;</code> のようにカウンター変数を宣言します。ここで宣言された変数は、for文のブロック内 <code>{ }</code> のみを有効範囲とするブロックスコープになります。
                        <br><small>※カウンター変数の名前は、単一ループでは <code>i</code>、2重ループでは <code>j</code>、3重ループでは <code>k</code> を使うのが世界的な慣例（インデックスの略）です。</small>
                    </li>
                    <li><strong>条件式：</strong> 各周回の処理を実行する直前に毎回判定されます。結果が <code>true</code> の間はブロック内の処理を実行し、<code>false</code> になった瞬間にループを終了します。</li>
                    <li><strong>更新式：</strong> ブロック内の処理が終わった直後（次の周へ進む手前）に実行されます。<code>i++</code> などでカウンターの値を増やします。2周目以降は「更新式 ➔ 条件式」の順で処理が流れます。</li>
                </ul>

                <p style="margin-top: 15px; font-size: 14px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px;">
                    <strong>💡 最も美しい基本形（指定回数繰り返す）</strong><br>
                    単純に「X回処理をループさせたい」という場合は、<code>i</code> を <code>0</code> からスタートし、条件式を <code>i &lt; X</code> とする書き方が、配列のインデックス（0番目から開始）とも親和性が高く、業界のデファクトスタンダード（標準）となっています。
                    <br><code>for (let i = 0; i &lt; X; i++) { /* 処理 */ }</code>
                </p>
            </div>

            <!-- セクション2：ループ文の使い分け -->
            <div class="note-section">
                <h3 class="note-title">2. 各種ループ文（while / do-while / for）の最適な選択基準</h3>
                <p>
                    JavaScriptのすべての反復処理は <code>while</code> 文に書き換えることが可能ですが、ソースコードのシンプルさや可読性を保つために、プロの現場では以下の基準で明確に使い分けます。
                </p>
                <ul>
                    <li><strong>for文：</strong> カウンター変数が存在し、「あらかじめ繰り返す回数や終了条件の基準」が数値として決まっている場合に最適です。</li>
                    <li><strong>do-while文：</strong> 終了条件に関わらず「最低でも1回は必ず処理を実行させたい」かつ、途中で <code>break</code> による強制終了を行わないケースに使用します。</li>
                    <li><strong>while文：</strong> 「特定の状態が変化するまで」など、繰り返す回数が事前に全く予想できないケース（ユーザーが正しい値を入力するまで無限に繰り返すなど）に使用します。</li>
                </ul>
            </div>

            <!-- セクション3：実技・動作チェックログ -->
            <div class="note-section">
                <h3 class="note-title">3. 実技：for文の基本検証と構文書き換え</h3>
                <p>授業内で行った各種ループパターンの動作検証と、while文への相互書き換えのログです。</p>

                <div class="sub-heading">① 指定回数の繰り返し（文字列の連続連結）</div>
                <pre><code>&lt;script&gt;
let str = "";
for (let i = 0; i &lt; 5; i++) { // iが 0, 1, 2, 3, 4 と変化
    str += "あ";
}
console.log(str); // 出力結果: "あああああ"
&lt;/script&gt;</code></pre>

                <div class="sub-heading">② 1から10までの合計値を求める（数値を扱うループ）</div>
                <p>このケースでは、カウンターの <code>i</code> を <code>1</code> から始めたほうが、数学的な思考とコードが直感的に一致するため効率的になります。</p>
                <pre><code>&lt;script&gt;
let sum = 0;
for (let i = 1; i &lt;= 10; i++) {
    sum += i;
}
console.log(sum); // 出力結果: 55
&lt;/script&gt;</code></pre>

                <div class="sub-heading">③ for文 ＋ break（1から100まで加算し、3000を超えたら強制終了）</div>
                <pre><code>&lt;script&gt;
let sum2 = 0;
for (let i = 1; i &lt;= 100; i++) {
    sum2 += i;
    if (sum2 &gt; 3000) {
        console.log(i + "を足した時点で3000を超えました");
        break; // 💡 ループを強制終了して脱出
    }
}
console.log("最終的な合計は" + sum2);
&lt;/script&gt;</code></pre>

                <div class="sub-heading">④ 同一仕様をwhile文で表現した場合（相互書き換えの検証）</div>
                <p>同じロジックをwhile文に書き換えると、初期化やカウンターのインクリメントが分散するため、構造的にはfor文の方がスッキリ書けることが実証されます。</p>
                <pre><code>&lt;script&gt;
let sum3 = 0;
let cnt = 1; // カウンター変数を外で定義
while (sum3 &lt;= 3000 && cnt &lt;= 100) {
    sum3 += cnt;
    if (sum3 &gt; 3000) {
        console.log(cnt + "を足した時点で3000を超えました");
        break;
    }
    cnt++; // 更新をブロック内で手動実行
}
console.log("最終的な合計は" + sum3);
&lt;/script&gt;</code></pre>
            </div>

            <!-- セクション4：練習問題（倍々貯金ゲーム） -->
            <div class="note-section">
                <h3 class="note-title">4. 応用演習：倍々貯金ゲームのアルゴリズム解析</h3>
                <p><strong>【問題設定】</strong> 1日目1円、2日目2円、3日目4円…と、毎日前日の倍額を30日間貯金する。ただし総額が100万円を超えた時点で終了し、その日数と総額を出力する。</p>

                <div class="sub-heading">💡 自分のコード（累計を計算するアプローチ）</div>
                <p><code>2 day</code>（累乗演算子）を用いてその日の額を毎回算出し、加算していく直感的なアプローチです。</p>
                <pre><code>&lt;script&gt;
let totalMoney = 0;
let dailyMoney = 1;
for (let day = 1; day &lt;= 30; day++) {
    totalMoney += dailyMoney;
    if (totalMoney &gt; 1000000) {
        console.log(day + "日目で超える");
        break;
    }
    dailyMoney = 1 * 2  day; // 次の日のための累乗計算
}
console.log(totalMoney + "円で終了");
&lt;/script&gt;</code></pre>

                <div class="sub-heading">✨ 先生の解説コード（無駄のない洗練された最適化ロジック）</div>
                <p>重い累乗計算を使わず、既存の変数に対して <strong><code>chokin *= 2;</code></strong> を行うことで処理負荷を下げています。また、30日経過しても100万円に届かなかった場合の「例外処理」が美しく設計されています。</p>
                <pre><code>&lt;script&gt;
let chokin = 1;     // その日の貯金額（初期値1円）
let chokinSum = 0;  // 貯金総額（累計）

for (let i = 1; i &lt;= 30; i++) {
    chokinSum += chokin;
    if (chokinSum &gt; 1000000) {
        console.log(i + "日目で貯金終了"); // 条件達成で即脱出
        break;
    }
    chokin *= 2; // 💡 非常にシンプルに次の日の貯金額を2倍にする
}

// 📌 例外処理：30日経過しても100万円に届かなかった場合の判定を「ループの外」に美しく配置
if (chokinSum &lt;= 1000000) {
    console.log("30日間で貯金終了");
}
console.log("貯金額は" + chokinSum + "円");
&lt;/script&gt;</code></pre>

                <p class="note" style="font-size: 13.5px; color: #e07b00; background-color: #fffbeb; padding: 12px; border-radius: 6px; margin-top: 15px; border-left: 4px solid #ff8c00;">
                    <strong>📐 数学的な裏付けとアルゴリズムの美しさ</strong><br>
                    毎日1円、2円、4円…と倍々に増える幾何級数（等比数列）の総額には、<strong>「その日の貯金額の2倍 － 1」</strong> という美しい数学的規則性（数式構造）が存在します。<br>
                    20日目の貯金額は <code>2 19 = 524,288円</code> であるため、20日目の総額は <code>524,288 × 2 － 1 ＝ 1,048,575円</code> となり、ちょうど<strong>20日目</strong>に100万円を突破することが計算上でも完璧に証明されます。
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