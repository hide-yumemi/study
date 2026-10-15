<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/28(月) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート共通追加CSSを連携 -->
    <link rel="stylesheet" href="scl_style.css">
    <style>
        /* 記述と出力を1つのセットにするためのコンテナスタイル */
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
        .demo-label-code { font-size: 13px; font-weight: bold; color: #0f172a; margin-bottom: 5px; }
        .demo-label-output { font-size: 13px; font-weight: bold; color: #16a34a; margin: 20px 0 5px; }
        .demo-output-box { background-color: #fafafa; border: 1px dashed #16a34a; border-radius: 8px; padding: 15px; color: #334155; }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            
            <h2>9/28(月) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                プログラムの「記述（ソースコード）」と、サーバー側で実際にPHPを駆動させたブラウザ上での「出力（リアルタイム実行結果）」を1つの画面で対比して確認できます。
            </p>

            <!-- ==========================================
                 テスト1：関数の引数と初期値の設定
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】関数の引数とデフォルト初期値の設定（P108）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>function hello($name, $greeting = 'Hello! '){
    echo $greeting . $name . "&lt;br&gt;";
}
hello('Bob', 'Good Morning! '); // 引数を上書き
hello('Tom');                   // 初期値が代入される</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    function hello($name, $greeting = 'Hello! '){
                        echo "<p>" . $greeting . $name . "</p>";
                    }
                    hello('Bob', 'Good Morning! ');
                    hello('Tom');
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 テスト2：関数の引数の型指定（タイプヒンティング）
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】関数の引数の型指定（array限定制限）（P109）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>function array_output(array $target_array) {
    foreach ($target_array as $value) {
        echo $value . " ";
    }
}
$array = array(1, 2, 3);
array_output($array);</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    function array_output(array $target_array) {
                        foreach ($target_array as $value) {
                            echo $value . " ";
                        }
                    }
                    $array = array(1, 2, 3);
                    echo "<p>";
                    array_output($array);
                    echo "</p>";
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 テスト3：array_map() とコールバック関数
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト3】array_map() による配列要素の一括型キャスト（P110）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$array = array(1, 1.5, "2", true);
$new_array = array_map('strval', $array);
var_dump($new_array); // キャスト後
var_dump($array);     // 元の配列</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $array_data = array(1, 1.5, "2", true);
                    $new_array = array_map('strval', $array_data);
                    ?>
                    <h2>$new_arrayの中身（すべてstring型に変身）：</h2>
                    <pre><?php var_dump($new_array) ?></pre>
                    <h2>元の$arrayの中身（元の型を維持）：</h2>
                    <pre><?php var_dump($array_data)?></pre>
                </div>
            </div>

            <!-- ==========================================
                 テスト4：function_exists() と 可変関数
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト4】function_exists() と 可変関数による動的呼び出し</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>function func_caller($name){
    if(function_exists($name)){
        $name(); // 文字列から関数 foo() を動的実行
    }
}
function foo(){ echo 'foo called'; }
func_caller('foo');</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    function func_caller($name){
                        if(function_exists($name)){
                            echo "<p>";
                            $name();
                            echo "</p>";
                        }
                    }
                    if(!function_exists('foo')){
                        function foo(){
                            echo 'foo called';
                        }
                    }
                    func_caller('foo');
                    ?>
                </div>
            </div>

            <p style="margin-top: 25px;">
                <a href="scl0928.php" class="td-link">➔ 9月28日の授業解説ノート（まとめ）へ戻る</a>
            </p>

        </main>


    </div> <!-- .container -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
