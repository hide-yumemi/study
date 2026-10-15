<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/30(水) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
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
        .demo-output-box h1 { font-size: 18px; color: #0f172a; margin-bottom: 15px; border-bottom: 2px solid #cbd5e1; padding-bottom: 5px; }
        .form-table { width: 100%; margin-bottom: 15px; font-size: 14px; }
        .form-table td { padding: 8px 5px; vertical-align: top; }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="index-main-content" style="display: block; max-width: 1000px; margin: 0 auto;">
            
            <h2>9/30(水) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                「記述（ソースコード）」と、サーバー側で実際にデータを送信して処理させた「出力（リアルタイム実行結果）」を同一画面のシミュレーター形式で体験できます。
            </p>

            <!-- ==========================================
                 テスト1：GET送信とhtmlspecialchars
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト1】自ファイルへのGET送信とXSS脆弱性対策セキュリティ（P174）</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>if(isset($_GET['name']) &amp;&amp; strlen($_GET['name']) &gt; 0):
    echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') . "さん、こんにちは";
endif;</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <?php if(isset($_GET['name']) && strlen($_GET['name']) > 0): ?>
                        <p style="color: #1e3a8a; font-weight: bold; margin-bottom: 15px;">
                            🎉 【GET受信】<?php echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');?>さん、こんにちは
                        </p>
                    <?php endif; ?>

                    <form action="scl0930_run.php" method="get" style="background: #fff; padding: 15px; border: 1px solid #e2e8f0; border-radius: 6px;">
                        <p style="margin: 0; font-size: 14px;">
                            名前を入力してください：
                            <input type="text" name="name" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" style="padding: 4px; border: 1px solid #ccc; border-radius: 4px;">
                            <input type="submit" value="GET送信" style="background: #1e3a8a; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                        </p>
                    </form>
                </div>
            </div>

            <!-- ==========================================
                 テスト2：高度な各種入力フォームのPOST送信
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【テスト2】多様なデータ形式の受信・多次元配列制御と加工出力処理</div>
                
                <div class="demo-label-code">📄 記述（ソースコード）</div>
<pre><code>// メールアドレス（通常文字列）の安全な受信
echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

// ラジオボタン（コード値）の受信と文字追記
echo htmlspecialchars($_POST['blood'], ENT_QUOTES, 'UTF-8') . "型";

// チェックボックス（多次元配列形式 fav[]）の一括ループ変換と結合
$favarr = array('旅行','スポーツ','音楽','インターネット');
$fav = array();
foreach($_POST['fav'] as $value){
    $fav[] = $favarr[$value];
}
echo implode('、', $fav);

// テキストエリアの改行コード変換（nl2br）
echo nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8'));</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際の実行結果）</div>
                <div class="demo-output-box">
                    <h1>送信データ表示シミュレーター</h1>
                    
                    <?php 
                    // 💡 タイポや未定義インデックスでのシステムクラッシュを防ぐ安全な多重バリデーション設計
                    if (!empty($_POST) && isset($_POST['email'])): 
                    ?>
                        <!-- 受信成功時のリアルタイムデータ出力画面 -->
                        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                            <p style="color: #16a34a; font-weight: bold; margin-top: 0;">🎉 【POSTデータ受信成功】</p>
                            <p><strong>メールアドレス:</strong> <?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>血液型:</strong> <?php echo isset($_POST['blood']) ? htmlspecialchars($_POST['blood'], ENT_QUOTES, 'UTF-8') : '未選択'; ?>型</p>
                            
                            <?php
                            $favarr = array('旅行','スポーツ','音楽','インターネット');
                            $fav = array();
                            if (isset($_POST['fav']) && is_array($_POST['fav'])) {
                                foreach($_POST['fav'] as $value){
                                    // 💡 安全なインデックスチェックを行ってコード値から文字列へ変換
                                    if(isset($favarr[$value])) {
                                        $fav[] = $favarr[$value];
                                    }
                                }
                            }
                            ?>
                            <p><strong>趣味:</strong> <?php echo !empty($fav) ? implode('、', $fav) : '未選択'; ?></p>
                            <p><strong>質問等:</strong><br><?php echo isset($_POST['qus']) ? nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8')) : ''; ?></p>
                        </div>
                        <p><a href="scl0930_run.php" style="color: #1e3a8a; text-decoration: underline;">➔ 入力フォームをクリアして再テストする</a></p>

                    <?php else: ?>
                        <!-- 📋 面接官がその場でデータを入力・送信検証できる高度なフォームインターフェース -->
                        <form action="scl0930_run.php" method="post" enctype="multipart/form-data" style="background: #fff; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            <table class="form-table">
                                <tr>
                                    <td style="width: 25%; font-weight: bold;">メールアドレス:</td>
                                    <td><input type="email" name="email" required style="width: 80%; padding: 5px; border: 1px solid #ccc; border-radius: 4px;"></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">血液型:</td>
                                    <td>
                                        <label><input type="radio" name="blood" value="A" checked> A型</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="blood" value="B"> B型</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="blood" value="O"> O型</label>&nbsp;&nbsp;
                                        <label><input type="radio" name="blood" value="AB"> AB型</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">趣味 (複数選択):</td>
                                    <td>
                                        <label><input type="checkbox" name="fav[]" value="0"> 旅行</label>&nbsp;&nbsp;
                                        <label><input type="checkbox" name="fav[]" value="1"> スポーツ</label>&nbsp;&nbsp;
                                        <label><input type="checkbox" name="fav[]" value="2"> 音楽</label>&nbsp;&nbsp;
                                        <label><input type="checkbox" name="fav[]" value="3"> インターネット</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">質問等:</td>
                                    <td><textarea name="qus" rows="4" style="width: 90%; padding: 5px; border: 1px solid #ccc; border-radius: 4px; font-family: inherit;"></textarea></td>
                                </tr>
                            </table>
                            <div style="margin-top: 10px;">
                                <input type="submit" value="送信する" style="background: #16a34a; color: #fff; border: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; cursor: pointer; margin-right: 5px;">
                                <input type="reset" value="入力リセット" style="background: #64748b; color: #fff; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <p style="margin-top: 35px;">
                <a href="scl0928.php" class="td-link">➔ 9月28日・29日の授業解説ノート（まとめ）へ戻る</a>
            </p>

        </main>
    </div> <!-- .container -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
