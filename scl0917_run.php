<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/17(木) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
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
        .demo-output-box h2 { font-size: 14px; color: #475569; margin: 10px 0 5px; border-left: 3px solid #64748b; padding-left: 6px; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <main class="main-content">
            
            <h2>9/17(木) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                プログラムの「記述（ソースコード）」と、サーバー側で実際にPHPを駆動させたブラウザ上での「出力（リアルタイム実行結果）」を1つの画面で対比して確認できます。
            </p>

            <!-- テスト1 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】シングル vs ダブルクォーテーションの変数展開</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>$string2 = "this is string";
$string3 = 'hi,$string2 \r\n';
$string4 = "hi,$string2 \r\n";
echo $string3;
echo $string4;</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php $string2 = "this is string"; $string3 = 'hi,$string2 \r\n'; $string4 = "hi,$string2 \r\n"; ?>
                    <p><strong>シングル出力：</strong><?php echo $string3; ?></p>
                    <p><strong>ダブル出力：</strong><?php echo $string4; ?></p>
                </div>
            </div>

            <!-- テスト2 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】変数展開の表記（PHP 8.2非推奨検証）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>$age = 15;
echo "${age}years old."; // 非推奨
echo "{$age}years old."; // 推奨</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php $age = 15; ?>
                    <p><?php echo "${age}years old."; ?><br><?php echo "{$age}years old."; ?></p>
                </div>
            </div>

            <!-- テスト3 & 4 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト3 &amp; 4】ヒアドキュメント・Nowdocとnl2br()関数の効果比較</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>$foo = &lt;&lt;&lt;EOI
複数行の文章（変数 $age も展開されます）
EOI;
echo $foo;        // そのまま出力（改行されない）
echo nl2br($foo); // nl2brを通して出力（改行される）</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $foo = "<<<EOI\nヒアドキュメント文章（$age才）\nEOI;";
                    $foo2 = "<<<'EOI'\nNowdoc文章（\$ageは展開されず）\nEOI;";
                    ?>
                    <h2>通常echo（ブラウザ上では横一列に繋がってしまう状態）：</h2>
                    <p><?php echo $foo; ?></p>
                    <h2>nl2br()使用後（エディタの改行通りにブラウザでも綺麗に改行）：</h2>
                    <p><?php echo nl2br($foo); ?></p>
                </div>
            </div>

            <p style="margin-top: 25px;"><a href="scl0917.php" class="td-link">➔ 9月17日の授業解説ノート（まとめ）へ戻る</a></p>
        </main>
        <?php include 'history.php'; ?>
    </div>
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>
</html>
