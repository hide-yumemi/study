<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/29(火) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
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
        <main class="index-main-content" style="display: block; max-width: 1000px; margin: 0 auto;">
            
            <h2>9/29(火) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                プログラムの「記述（ソースコード）」と、サーバー側で実際にPHPを駆動させたブラウザ上での「出力（リアルタイム実行結果）」を1つの画面で対比して確認できます。
            </p>

            <!-- テスト1 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】無名関数の変数代入と再代入による破壊の検証</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>$add = function($v1, $v2){ return $v1 + $v2; };
$result = $add(2,5);
$add = "test"; // 再代入して関数を破壊
var_dump($add);</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    $add_func = function($v1, $v2){ return $v1 + $v2; };
                    $res = $add_func(2,5);
                    $add_func = "test";
                    ?>
                    <p>無名関数の実行結果（2 + 5）：<strong><?php echo $res; ?></strong></p>
                    <p>再代入した変数のダンプ（関数が文字列に変身）：<?php var_dump($add_func); ?></p>
                </div>
            </div>

            <!-- テスト2 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】外部ファイルの複数回読込検証（_onceの効果）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>require '0929load_.php'; // 1回目
require '0929load_.php'; // 2回目
include '0929load_.php'; // 3回目
include_once '0929load_.php'; // 4回目（onceにより自動スキップ）</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    // ※exit()が下部にあるため、検証用の出力をここに安全に並べます
                    if (file_exists('0929load_.php')) {
                        require '0929load_.php';
                        require '0929load_.php';
                        include '0929load_.php';
                        include_once '0929load_.php';
                    } else {
                        echo "0929load_.php が見つかりません。";
                    }
                    ?>
                </div>
            </div>

            <!-- テスト3 -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト3】GET送信フォームのデータ受信とセキュリティ出力（htmlspecialchars）</div>
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>if (isset($_GET['name']) &amp;&amp; strlen($_GET['name']) &gt; 0):
    echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') . "さんこんにちは";
endif;</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php if (isset($_GET['name']) && strlen($_GET['name']) > 0): ?>
                        <p style="color: #1e3a8a; font-weight: bold; font-size: 16px;">
                            🎉 【受信成功】<?php echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8'); ?>さんこんにちは！
                        </p>
                    <?php else: ?>
                        <p style="color: #666;">名前が未送信です。以下のフォームからテスト送信を試せます：</p>
                    <?php endif; ?>

                    <form action="scl0929_run.php" method="get" style="margin-top: 15px; background: #fff; padding: 15px; border: 1px solid #e2e8f0; border-radius: 6px;">
                        <label style="font-size: 14px; font-weight: bold;">名前を入力してください：</label>
                        <input type="text" name="name" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px; margin-right: 5px;">
                        <input type="submit" value="送信" style="background: #16a34a; color: #fff; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">
                    </form>
                </div>
            </div>

            <p style="margin-top: 25px;"><a href="scl0928.php" class="td-link">➔ 9月28日の授業解説ノートへ戻る</a></p>
        </main>
    </div>
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>
</html>
