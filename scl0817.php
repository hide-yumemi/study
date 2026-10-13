<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/17(月)の職業訓練授業ノートです。JavaScriptの一次元・多次元配列の基本、リテラル式とオブジェクト式の違い、2重ループを用いた一括代入、pushやspliceメソッドによる要素の増減操作をまとめています。">
    <title>8/17(月)職業訓練授業：配列の基礎と多次元配列・配列操作 | ポートフォリオサイト</title>
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
            <h2>8/17(月) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                データの集合体を効率的に扱う「配列（Array）」の仕組み、多次元構造の制御、そして配列要素を柔軟に変形させる各種メソッドについて学びます。
            </p>

            <!-- セクション1：配列の基本と2種類の記述方法 -->
            <div class="note-section">
                <h3 class="note-title">1. 配列（一次元配列）の概念と2種類の宣言方法</h3>
                <p>
                    配列とは、複数のデータを1つのグループとしてまとめて管理できる**「データの集合体」**です。
                </p>
                <p>
                    配列に格納された各データ（要素）には、自動的に <code>0</code> から始まる連番の**添字（インデックス）**が付与されます。このインデックスを <code>変数名[0]</code> のように指定することで、個々のデータへダイレクトにアクセスできます。
                </p>
                
                <div class="sub-heading">🤝 2種類の記述方法（リテラル式 と オブジェクト式）</div>
                <ul>
                    <li><strong>リテラル式（推奨）：</strong> <code>[ ]</code> を使って直接データを記述する、最も一般的で高速な書き方です。末尾のカンマはあってもなくても自由です。
                        <pre><code>let arr =; // 💡 末尾にカンマをつけた [5, 1, 9, 7,] も文法上認められます</code></pre>
                    </li>
                    <li><strong>オブジェクト式：</strong> <code>new Array()</code> 構文を用いて配列を生成する明示的な書き方です。オブジェクト式の末尾には余分なカンマを記述してはいけません。
                        <pre><code>let arr = new Array(5, 1, 9, 7); // ❌ new Array(5, 1, 9, 7,) は構文エラー</code></pre>
                    </li>
                </ul>

                <div class="sub-heading">コードでの基本挙動確認</div>
<pre><code>&lt;script&gt;
let arr1 = [1, "abc", "あいう"];          // リテラル式
let arr2 = new Array(1, "abc", "あいう"); // オブジェクト式

console.log(arr1[1]);     // 出力: "abc" （1番目の要素にアクセス）
console.log(arr1.length); // 出力: 3 （.lengthプロパティで要素数を取得）
&lt;/script&gt;</code></pre>
            </div>

            <!-- セクション2：値を1つだけ指定したときの罠 -->
            <div class="note-section">
                <h3 class="note-title">2. 【要注意】数値を1つだけ指定した際の両者の挙動の違い</h3>
                <p>
                    配列の初期化時に「数値を1つだけ」指定した場合、どちらの式を使ったかで**全く異なる配列が生成される**というJavaScript特有の重要な仕様があります。
                </p>
                
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14.5px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; width: 35%;">記述方法と例</th>
                            <th style="padding: 10px; text-align: left;">生成される配列の状態（結果）</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><code>let arr = [3];</code><br>（リテラル式）</td>
                            <td style="padding: 10px;">数値の <code>3</code> というデータが1つだけ格納された、**要素数1**の配列になる。<br>➔ <code>[3]</code></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><code>let arr = new Array(3);</code><br>（オブジェクト式）</td>
                            <td style="padding: 10px; color: #b91c1c; font-weight: bold;">中身のデータはすべて未指定（空）のまま、要素数（データを入れる枠枠）だけを「3つ分」事前に確保した配列になる。</td>
                        </tr>
                    </tbody>
                </table>
                
                <p style="font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
                    <strong>💡 オブジェクト式（new Array）の明確な利点</strong><br>
                    「入れるデータの中身は後から決まるけれど、あらかじめ100個分の空の枠枠だけを確保してfor文で回したい」というようなケースにおいて、このオブジェクト式の仕様が非常に威力を発揮します。
                </p>
            </div>

            <!-- セクション3：多次元配列（ネスト構造） -->
            <div class="note-section">
                <h3 class="note-title">3. 多次元配列（二次元配列）の構造とアクセス</h3>
                <p>
                    配列の要素の中に、さらに配列を入れ子（ネスト）にして管理する構造を**多次元配列**と呼びます。エクセルや表組みのような「行」と「列」の概念（二次元配列）を表現するのに多用されます。
                </p>
                <div class="sub-heading">二次元配列の作成パターン比較</div>
                <ul>
                    <li><strong>① 作成時点で中身のデータが確定している場合（リテラル式向き）</strong>
<pre><code>// 2行 × 3列 の二次元配列を視覚的に分かりやすく記述
let nijiArr1 = [, // 0行目
    [1, 8, 6]  // 1行目
];
console.log(nijiArr1[0][1]); // 出力: 2 （0行目の1列目のデータ）</code></pre>
                    </li>
                    <li><strong>② 枠を先に確保して、後から値を代入する場合（オブジェクト式向き）</strong>
<pre><code>let nijiArr2 = new Array(2); // まず「2行分」の空枠を確保
nijiArr2[0] = new Array(9, 2, 4); // 0行目に配列を代入
nijiArr2[1] = new Array(1, 8, 6); // 1行目に配列を代入</code></pre>
                    </li>
                </ul>
            </div>

            <!-- セクション4：ループ処理と一括代入 -->
            <div class="note-section">
                <h3 class="note-title">4. for文（多重ループ）による配列の一括制御</h3>
                <p>配列の要素数（<code>.length</code>）をループの条件式に使用することで、配列全体への一括処理が安全に行えます。</p>
                
                <div class="sub-heading">① 一次元配列へのゼロ一括代入</div>
<pre><code>let arr6 = new Array(10); // 10個の空枠
for (let i = 0; i &lt; arr6.length; i++) {
    arr6[i] = 0; // すべての枠に 0 を代入して初期化
}</code></pre>

                <div class="sub-heading">② 2重ループによる二次元配列（3×3）の一括初期化と全データアクセス</div>
                <p>外側のfor文（インデックス <code>i</code>）で「行」をループさせ、内側のfor文（インデックス <code>j</code>）で「列」をループさせる、アルゴリズムの王道パターンです。</p>
<pre><code>&lt;script&gt;
// 3×3の格子状の配列すべてに 0 を一括代入する
let nijiArr4 = new Array(3);
for (let i = 0; i &lt; nijiArr4.length; i++) {
    nijiArr4[i] = new Array(3); // 各行にさらに3つ分の空枠を作る
    for (let j = 0; j &lt; nijiArr4[i].length; j++) {
        nijiArr4[i][j] = 0; // すべてのマス目を0にする
    }
}

// 多次元配列の全データへ順番にアクセスして出力する
for (let i = 0; i &lt; nijiArr1.length; i++) {
    for (let j = 0; j &lt; nijiArr1[i].length; j++) {
        console.log(nijiArr1[i][j]); // 9, 2, 4, 1, 8, 6 が順に出力される
    }
}
&lt;/script&gt;</code></pre>
            </div>

            <!-- セクション5：配列の要素操作メソッド -->
            <div class="note-section">
                <h3 class="note-title">5. 配列要素を動的に操作するメソッド（push / splice）</h3>
                <p>配列は一度作成した後からでも、メソッドを呼び出すことで中身の数を増やしたり削ったり自由にコントロール可能です。</p>
                
                <div class="sub-heading">✨ push(値1, 値2...) ➔ 末尾への追加</div>
                <p>配列の一番最後（末尾）に、新しい要素を1つ以上追加します。実務でも非常によく使われます。</p>
<pre><code>let strArr = ["a", "b"];
strArr.push("c");      // ➔ ["a", "b", "c"]
strArr.push("d", "e"); // ➔ ["a", "b", "c", "d", "e"] （複数同時追加も可能）</code></pre>

                <div class="sub-heading">✨ splice(開始位置, 削除個数, 挿入する値...) ➔ 万能操作（削除・挿入・置換）</div>
                <p>インデックスの指定位置を狙って、要素の間引き（削除）や、割り込み（挿入）をピンポイントで行う破壊的メソッドです。</p>
<pre><code>&lt;script&gt;
let strArr = ["a", "b", "c", "d"];

// 【挿入】0番目の位置から「0個削除」して、手前に "挿入" という文字を割り込ませる
strArr.splice(0, 0, "挿入"); // ➔ ["挿入", "a", "b", "c", "d"]

// 【削除】3番目の位置から「2個」データを削除する
strArr.splice(3, 2); // ➔ ["挿入", "a", "b"]

// 【置換】4番目の位置から「1個」削除し、代わりに複数の値を差し込む
strArr.splice(4, 1, "挿入1", "挿入2");
&lt;/script&gt;</code></pre>
            </div>

        </main>

        <!-- 右側：更新履歴 -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
