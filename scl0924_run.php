<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/24(木) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート共通追加CSSを連携 -->
    <link rel="stylesheet" href="scl_style.css">
    <style>
        /* 💡 記述と出力を1つのセットにするためのコンテナスタイル */
        .demo-set-container {
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0 35px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }
        .demo-set-title {
            font-size: 15px;
            font-weight: bold;
            color: #1e3a8a;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
        }
        /* 「記述」の見出しと黒板コード枠 */
        .demo-label-code {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 5px;
        }
        /* 「出力」の見出しとリアル実行結果枠 */
        .demo-label-output {
            font-size: 13px;
            font-weight: bold;
            color: #16a34a;
            margin: 20px 0 5px;
        }
        .demo-output-box {
            background-color: #fafafa;
            border: 1px dashed #16a34a;
            border-radius: 8px;
            padding: 15px;
            color: #334155;
        }
        .demo-output-box h2 {
            font-size: 14px;
            color: #475569;
            margin: 10px 0 5px;
            border-left: 3px solid #64748b;
            padding-left: 6px;
        }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            
            <h2>9/24(木) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                プログラムの「記述（ソースコード）」と、サーバー側で実際にPHPを駆動させたブラウザ上での「出力（リアルタイム実行結果）」を1つの画面で対比して確認できます。
            </p>

            <!-- ==========================================
                 テスト1：文字列連結演算と小数点自動解釈
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】文字列連結演算と小数点自動解釈の検証</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$age = 15;
$tom = 'Toms is ' . $age . ' years old.';
echo "&lt;p&gt;" . $tom . "</p>";

$dbl1 = .2;
$dbl2 = 15.;
echo $dbl1;
echo $dbl2;
var_dump($dbl2);</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $age = 15;
                    $tom = 'Toms is ' . $age . ' years old.';
                    echo "<p>" . $tom . "</p>";
                    
                    $dbl1 = .2;
                    $dbl2 = 15.;
                    ?>
                    <p>小数点表現の出力1（.2）：<?php echo $dbl1; ?></p>
                    <p>小数点表現の出力2（15.）：<?php echo $dbl2; ?></p>
                    <p>型と値のダンプ：<?php var_dump($dbl2); ?></p>
                </div>
            </div>

            <!-- ==========================================
                 テスト2：宇宙船演算子の3択比較結果
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】宇宙船演算子（&lt;=&gt;）の3択比較結果</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$num1 = 5;
$num2 = 3;
$result = $num1 &lt;=&gt; $num2;
echo $result;</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $num1 = 5;
                    $num2 = 3;
                    $result = $num1 <=> $num2;
                    ?>
                    <p>5 &lt;=&gt; 3 の結果（左辺が大きいので1）：<strong><?php echo $result; ?></strong></p>
                </div>
            </div>

            <!-- ==========================================
                 テスト3：各種配列の初期状態と自動インデックス
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト3】各種配列の初期状態と自動インデックス（混合配列）</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$fruits = array('apple', 'banana', 'orange');
$fruits_mixed = array('peach', 'blueberry', 'apple' =&gt; 'red', 'banana' =&gt; 'yellow', 'orange' =&gt; 'orange');
var_dump($fruits);
var_dump($fruits_mixed);</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $fruits = array('apple', 'banana', 'orange');
                    $fruits_mixed = array('peach', 'blueberry', 'apple' => 'red', 'banana' => 'yellow', 'orange' => 'orange');
                    ?>
                    <h2>添字配列：</h2>
                    <pre><?php var_dump($fruits); ?></pre>
                    <h2>混合連想配列：</h2>
                    <pre><?php var_dump($fruits_mixed); ?></pre>
                </div>
            </div>
            <!-- ==========================================
                 テスト4：配列要素の追加・上書き・挿入・分割
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト4】配列要素の追加・上書き・挿入・分割（削除）</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$fruits[] = 'melon'; 
$fruits_mixed[] = 'melon';
$fruits_mixed['grape'] = 'purple';
$fruits = 'peach'; // 上書き
$fruits_mixed['grape'] = 'green'; // 上書き
array_splice($fruits, 2, 0, 'blueberry');
array_splice($fruits, 3, 0, ['banana', 'grape']);
$fruits2 = array_splice($fruits, 1, 3); // 分割
$fruits_mixed2 = array_splice($fruits_mixed, 1, 3); // 分割</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $fruits[] = 'melon'; 
                    $fruits_mixed[] = 'melon';
                    $fruits_mixed['grape'] = 'purple';
                    $fruits = 'peach';
                    $fruits_mixed['grape'] = 'green';
                    
                    array_splice($fruits, 2, 0, 'blueberry');
                    array_splice($fruits, 3, 0, ['banana', 'grape']);
                    
                    $fruits2 = array_splice($fruits, 1, 3);
                    $fruits_mixed2 = array_splice($fruits_mixed, 1, 3);
                    ?>
                    <h2>要素操作後のベース添字配列 $fruits：</h2>
                    <pre><?php var_dump($fruits); ?></pre>
                    <h2>分割によって新しくできた配列 $fruits2：</h2>
                    <pre><?php var_dump($fruits2); ?></pre>
                    <h2>要素操作後の連想配列 $fruits_mixed：</h2>
                    <pre><?php var_dump($fruits_mixed); ?></pre>
                    <h2>分割によって新しくできた連想配列 $fruits_mixed2：</h2>
                    <pre><?php var_dump($fruits_mixed2); ?></pre>
                </div>
            </div>

            <!-- ==========================================
                 テスト5：for文 ＆ foreach文によるループ出力
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト5】for文 ＆ foreach文による多パターンループ出力とスコープ検証</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$count = count($fruits);
for($i=0; $i&lt;$count; $i++):
    echo $fruits[$i];
endfor;

foreach($fruits2 as $value):
    echo $value;
endforeach;
echo "ループ脱出後の$valueは" . $value;

foreach($fruits_mixed as $key =&gt; $value):
    echo $key . "=&gt;" . $value;
endforeach;</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <h2>for文による $fruits のループ出力：</h2>
                    <?php
                    $count = count($fruits);
                    for($i=0; $i<$count; $i++):
                        echo "<p>".$fruits[$i]."</p>";
                    endfor;
                    ?>

                    <h2>foreach文による $fruits2 の値のみループ出力：</h2>
                    <?php
                    foreach($fruits2 as $value):
                        echo "<p>".$value."</p>";
                    endforeach;
                    ?>
                    <p><strong>💡 ループ脱出後の $value の保持値：</strong><?php echo $value; ?></p>

                    <h2>foreach文による $fruits_mixed のキーと値の同時出力：</h2>
                    <?php
                    foreach($fruits_mixed as $key => $value):
                        echo "<p>".$key." =&gt; ".$value."</p>";
                    endforeach;
                    ?>
                </div>
            </div>

            <p style="margin-top: 25px;">
                <a href="scl0924.php" class="td-link">➔ 9月24日の授業解説ノート（まとめ）へ戻る</a>
            </p>

        </main>



    </div> <!-- .container -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
