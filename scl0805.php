<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/5(水)の職業訓練授業ノートです。JavaScriptの変数・定数の定義(var/let/const)、識別子の命名ルール、データ型と型変換、各種演算子の挙動をまとめています。">
    <title>8/5(水)職業訓練授業：JavaScriptの基本概念と演算子 | ポートフォリオサイト</title>
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
            <h2>8/5(水) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                JavaScriptでデータを扱うための根底知識である、変数・定数の使い分け、データ型、そしてバグを防ぐための演算子の挙動についてまとめます。
            </p>

            <!-- セクション1：変数と定数の定義 -->
            <div class="note-section">
                <h3 class="note-title">1. 変数と定数の定義（var / let / const）</h3>
                <p>
                    JavaScriptでデータを一時的に保存する「箱」の宣言方法には3種類の手法があり、その特徴や有効範囲（スコープ）によって厳格に使い分けます。
                </p>
                
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14.5px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left;">宣言文</th>
                            <th style="padding: 10px; text-align: center;">再代入</th>
                            <th style="padding: 10px; text-align: center;">再宣言</th>
                            <th style="padding: 10px; text-align: left;">有効範囲（スコープ）</th>
                            <th style="padding: 10px; text-align: left;">現在の位置づけ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>var</strong></td>
                            <td style="padding: 10px; text-align: center; color: #16a34a;">〇</td>
                            <td style="padding: 10px; text-align: center; color: #16a34a;">〇</td>
                            <td style="padding: 10px;">関数スコープ（広い）</td>
                            <td style="padding: 10px; color: #ef4444;"><strong>古い書き方。</strong> 意図しないバグを生むため原則不使用。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>let</strong></td>
                            <td style="padding: 10px; text-align: center; color: #16a34a;">〇</td>
                            <td style="padding: 10px; text-align: center; color: #ef4444;">❌</td>
                            <td style="padding: 10px;">ブロックスコープ（狭い）</td>
                            <td style="padding: 10px; color: #1e3a8a;"><strong>現在の主役。</strong> 値を後から書き換える変数に使用。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>const</strong></td>
                            <td style="padding: 10px; text-align: center; color: #ef4444;">❌</td>
                            <td style="padding: 10px; text-align: center; color: #ef4444;">❌</td>
                            <td style="padding: 10px;">ブロックスコープ（狭い）</td>
                            <td style="padding: 10px; color: #ff8c00; font-weight: bold;"><strong>最優先。</strong> 再代入しない「定数」に使用。</td>
                        </tr>
                    </tbody>
                </table>

                <p style="font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b; margin-top: 15px;">
                    <strong>💡 実務での重要補足：IE（Internet Explorer）対応の現在</strong><br>
                    古い参考書には「IEではlet/constが使えないためvarを使う」と記載されていますが、<strong>IEのサポートは完全に終了しています。</strong> 現代のWeb開発においてはIEを意識する必要は全くありません。安全でバグの起きにくい <code>let</code> と <code>const</code> を常に選択しましょう。
                </p>

                <div class="sub-heading">コードでの挙動確認</div>
                <pre><code>// 複数変数の同時定義（カンマ区切りで箱だけ用意）
let a, b, c;
console.log(a); // 結果：undefined（箱が空っぽの状態）

// letは再代入が可能
let price = 100;
price = 150; // 〇 上書き成功

// constは再代入不可
const taxRate = 0.1;
taxRate = 0.08; // ❌ エラー：Assignment to constant variable.</code></pre>
            </div>

            <!-- セクション2：識別子（名前付け）のルール -->
            <div class="note-section">
                <h3 class="note-title">2. 識別子（名前付け）のルール</h3>
                <p>変数名や定数名（識別子）を決める際には、エラーを防ぐための絶対的なルールと、業界内で決められている共通ルール（命名規則）があります。</p>
                
                <div class="sub-heading">❌ 絶対NGな命名（構文エラーになります）</div>
                <ul>
                    <li><strong>頭文字に数字を使う：</strong> <code>let 1num;</code> はエラーになります。（〇 <code>let num1;</code>）</li>
                    <li><strong>予約語を使う：</strong> JavaScriptの標準機能として最初から使われている単語（<code>true</code>, <code>false</code>, <code>null</code>, <code>let</code>, <code>if</code> など）は変数名に指定できません。</li>
                </ul>

                <div class="sub-heading">🤝 業界の標準スタイル（命名規則）</div>
                <ul>
                    <li><strong>キャメルケース（camelCase）：</strong> 2つ目以降の単語の頭文字を大文字にする（例：<code>let hyperText;</code>）。<br><small>※用途：変数名、関数名などで最も主流です。</small></li>
                    <li><strong>パスカルケース（PascalCase）：</strong> 1つ目の単語を含むすべての頭文字を大文字にする（例：<code>HyperText</code>）。<br><small>※用途：主に「クラス名」に用いられます。</small></li>
                    <li><strong>スネークケース（snake_case）：</strong> 単語間をアンダースコアで繋ぎ、全て小文字にする。Python等の言語で主流ですが、JavaScriptでは一部を除きあまり使われません。</li>
                </ul>
            </div>

            <!-- セクション3：データ型と型変換 -->
            <div class="note-section">
                <h3 class="note-title">3. データ型（Data Type）と型変換</h3>
                <p>JavaScriptは、プログラムの実行中に状況に応じて自動で型を変換する特性（動的型付け言語）を持っています。</p>
                
                <div class="sub-heading">主要な基本型</div>
                <ul>
                    <li><strong>数値型（Number）：</strong> <code>1</code> や <code>3.14</code> など、計算に使う。</li>
                    <li><strong>文字型（String）：</strong> <code>"1"</code> や <code>'あいう'</code> など、クォーテーションで囲む。</li>
                    <li><strong>ブーリアン型（Boolean）：</strong> <code>true</code>（真）と <code>false</code>（偽）の2値のみ。条件判定に使用。</li>
                    <li><strong>null / undefined：</strong> <code>null</code> は「何も参照していない空の状態」、<code>undefined</code> は「値が未定義の状態」。</li>
                </ul>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    ⚠️<strong>超重要：足し算の罠と型キャスト（型変換）</strong><br>
                    <code>+</code> 演算子は、計算する値の片方が「文字型」であると、全体を数値の計算ではなく**文字列の連結**として処理してしまいます。<br>
                    例： <code>4 + "1"</code> ➔ <strong><code>"41"</code></strong> （文字列型になる）<br><br>
                    これを回避して数値として正しく足し算したい場合、変数の前に <code>+</code> 記号をつけることで、数値型に一瞬でキャスト（強制変換）できます（単項プラス演算子）。<br>
                    例： <code>4 + (+"1")</code> ➔ <strong><code>5</code></strong> （数値型として計算成功）
                </p>

                <div class="sub-heading">計算不能を示す特別な値：NaN（Not a Number）</div>
                <p>
                    文字列を無理やり引き算しようとするなど、不正な計算を行うと <strong><code>NaN</code></strong> が返ります。
                </p>
                <p>
                    注意点として、<strong>NaNは一度発生すると、その後のどんな計算に巻き込んでも結果がすべて強制的にNaNになります。</strong> 原因不明のバグを生みやすいため、ログを確認する際の重要な指標になります。
                </p>
            </div>

            <!-- セクション4：各種演算子の挙動と注意点 -->
            <div class="note-section">
                <h3 class="note-title">4. 各種演算子の挙動と注意点</h3>
                
                <div class="sub-heading">① インクリメント演算子（ ++ / -- ）</div>
                <p>値を1増やす（減らす）演算子ですが、記述を「前」にするか「後」にするかで、他の処理（代入など）へ反映されるタイミングが完全に異なります。</p>
                <ul>
                    <li><strong>後置（ num++ ）：</strong> 現在の値をそのまま処理（代入など）に使用した**後に**、値を1増やします。</li>
                    <li><strong>前置（ ++num ）：</strong> 何よりも先に自身の値を1増やした**後に**、次の処理へ移ります。</li>
                </ul>
<pre><code>let num3 = 1;
let result1 = num3++; // 先に result1 に 1 が入り、そのあとで num3 が 2 になる。

let num4 = 1;
let result2 = ++num4; // 先に num4 が 2 になり、そのあとで result2 に 2 が入る。</code></pre>

                <div class="sub-heading">② 同値演算子（ == と === の違い）</div>
                <p>値を比較する演算子ですが、実務においてはバグを防ぐため**「型まで厳格にチェックする <code>===</code>（厳密等価演算子）の使用」が絶対のルール**です。</p>
                <ul>
                    <li><code>1 == "1"</code> ➔ <strong><code>true</code></strong> （型は違うが、ブラウザが自動変換して同じと判定してしまうため、バグの原因になります）</li>
                    <li><code>1 === "1"</code> ➔ <strong><code>false</code></strong> （数値と文字列のため、型が違うので厳格に弾いてくれます）</li>
                </ul>

                <div class="sub-heading">③ 論理演算子（かつ・または・反転）</div>
                <p>条件分岐（if文など）を網羅する、ベン図のロジックを組み立てる演算子です。</p>
                <ul>
                    <li><strong><code>&&</code> （かつ）：</strong> 左右両方の条件が true であれば true になる。</li>
                    <li><strong><code>||</code> （または）：</strong> 左右どちらか一方でも true であれば true になる。</li>
                    <li><strong><code>!</code> （反転）：</strong> true を false に、false を true にひっくり返す。</li>
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
