<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/15(火) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
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
            
            <h2>9/15(火) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                プログラムの「記述（ソースコード）」と、サーバー側で実際にPHPを駆動させたブラウザ上での「出力（リアルタイム実行結果）」を1つの画面で対比して確認できます。
            </p>

            <!-- テスト1 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】Hello World 出力</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>echo "Hello World";</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <p><?php echo "Hello World"; ?></p>
                </div>
            </div>

            <!-- テスト2 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】日本語文字化け・ini設定検証</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>echo "ひらがなカタカナ漢字　表示確認";</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <p><?php echo "ひらがなカタカナ漢字　表示確認" ?></p>
                </div>
            </div>

            <!-- テスト3 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト3】タイムゾーン（日本時間）連動検証</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>echo date("Y-m-d:H:i:s");</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <p><?php echo date("Y-m-d:H:i:s"); ?></p>
                </div>
            </div>

            <!-- テスト4 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト4】複数要素の一括echo書き出し</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
                <pre><code>echo "&lt;p&gt;テスト&lt;/p&gt;";
echo "&lt;p&gt;テキストテキスト&lt;/p&gt;";</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    echo "<p>テスト</p>";
                    echo "<p>テキストテキスト</p>";
                    ?>
                </div>
            </div>

            <p style="margin-top: 25px;"><a href="scl0915.php" class="td-link">➔ 9月15日の授業解説ノート（まとめ）へ戻る</a></p>
        </main>
        <?php include 'history.php'; ?>
    </div>
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>
</html>
