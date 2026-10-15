<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/16(水) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート共通追加CSSを連携 -->
    <link rel="stylesheet" href="scl_style.css">
    <style>
        .demo-set-container { background-color: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 20px; margin: 25px 0 35px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02); }
        .demo-set-title { font-size: 15px; font-weight: bold; color: #1e3a8a; margin-top: 0; margin-bottom: 15px; border-bottom: 2px solid #e2e8f0; padding-bottom: 6px; }
        .demo-label-code { font-size: 13px; font-weight: bold; color: #0f172a; margin-bottom: 5px; }
        .demo-label-output { font-size: 13px; font-weight: bold; color: #16a34a; margin: 20px 0 5px; }
        .demo-output-box { background-color: #fafafa; border: 1px dashed #16a34a; border-radius: 8px; padding: 15px; color: #334155; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <main class="main-content">
            
            <h2>9/16(水) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                プログラムの「記述（ソースコード）」と、サーバー側で実際にPHPを駆動させたブラウザ上での「出力（リアルタイム実行結果）」を1つの画面で対比して確認できます。
            </p>

            <!-- テスト1 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】初期乱数の型と値のデバッグ（var_dump）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>$number = rand(1, 100);
var_dump($number);</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php $number = rand(1, 100); ?>
                    <p>型と値のダンプ：<?php var_dump($number);?></p>
                </div>
            </div>

            <!-- テスト2 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】ランダム数値に対する偶数・奇数のif条件分岐判定</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>$number = rand();
if ($number % 2 == 0){
    echo $number, "は偶数です。", PHP_EOL;
} else {
    echo $number, "は奇数です。", PHP_EOL;
}</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $number = rand();
                    if ($number % 2 == 0){
                        echo "<p>".$number."は偶数です。</p>";
                    } else {
                        echo "<p>".$number."は奇数です。</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- テスト3 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト3】複数データ型変数のvar_dumpデバッグ確認</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>$text = "文字列";
$dob = 0.123;
var_dump($text);
var_dump($dob);</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php $text = "文字列"; $dob = 0.123; ?>
                    <p>文字列のダンプ：<?php var_dump($text);?></p>
                    <p>浮動小数点のダンプ：<?php var_dump($dob);?></p>
                </div>
            </div>

            <p style="margin-top: 25px;"><a href="scl0916.php" class="td-link">➔ 9月16日の授業解説ノート（まとめ）へ戻る</a></p>
        </main>
    </div>
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>
</html>
