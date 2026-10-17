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
            border-bottom: 2px solid #e2e2f0;
            padding-bottom: 6px;
        }

        .demo-label-code {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 5px;
        }

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

        /* ページ内完結用フォームの調整スタイル */
        .demo-form {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .demo-submit-btn {
            background-color: #1e3a8a;
            color: white;
            border: none;
            padding: 6px 15px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .demo-submit-btn:hover {
            background-color: #112255;
        }
    </style>
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">

            <h2>9/30(水) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                ラジオボタン、チェックボックス（配列処理）、テキストエリアの改行表示など、各コントロールに応じたサーバー側（PHP）の受信・変換ロジックをその場で確認できます。
            </p>

            <!-- 総合入力フォーム（単体完結用に入力を1つに統合） -->
            <form action="scl0930_run.php" method="post" class="demo-form" style="padding: 20px; border: 2px solid #1e3a8a;">
                <h3 style="font-size: 16px; color: #1e3a8a; margin-bottom: 15px;">📝 テスト用入力フォーム</h3>

                <!-- 1. ラジオボタン -->
                <div style="margin-bottom: 15px;">
                    <span style="font-size: 14px; font-weight: bold;">血液型 (ラジオボタン・単一選択):</span><br>
                    <?php
                    $blood_types = array('A', 'B', 'O', 'AB');
                    foreach ($blood_types as $type) {
                        $checked = (isset($_POST['blood']) && $_POST['blood'] === $type) ? 'checked' : '';
                        echo "<label style='margin-right: 12px;'><input type='radio' name='blood' value='{$type}' {$checked}> {$type}型</label>";
                    }
                    ?>
                </div>

                <!-- 2. チェックボックス -->
                <div style="margin-bottom: 15px;">
                    <span style="font-size: 14px; font-weight: bold;">趣味 (チェックボックス・複数選択可・値はコード化):</span><br>
                    <?php
                    $fav_master = array('0' => '旅行', '1' => 'スポーツ', '2' => '音楽', '3' => 'インターネット');
                    foreach ($fav_master as $code => $label) {
                        $checked = (isset($_POST['fav']) && in_array($code, $_POST['fav'])) ? 'checked' : '';
                        echo "<label style='margin-right: 12px;'><input type='checkbox' name='fav[]' value='{$code}' {$checked}> {$label}</label>";
                    }
                    ?>
                </div>

                <!-- 3. テキストエリア -->
                <div style="margin-bottom: 15px;">
                    <label style="font-size: 14px; font-weight: bold;">お問い合わせ・ご質問 (テキストエリア・複数行入力):</label><br>
                    <textarea name="qus" rows="4" style="width: 100%; max-width: 500px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-top: 5px;" placeholder="ここに複数行の文章を入力して、改行の挙動をテストしてください"><?php echo isset($_POST['qus']) ? htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                </div>

                <input type="submit" value="上記の入力内容でPHPを実行" class="demo-submit-btn" style="background-color: #ff8c00; padding: 10px 20px;">
            </form>

            <!-- ==========================================
                 デモ1：ラジオボタンの受信処理
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ1】ラジオボタンの受信処理（固定値のためエスケープ不要論）</div>
                <div class="demo-label-code">📄 サーバー側の受信プログラム記述</div>
                <pre><code>if (isset($_POST['blood'])) {
    echo "血液型：" . $_POST['blood'] . "型"; // 固定値のためhtmlspecialchars不要
}</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際のリアルタイム実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    if (isset($_POST['blood'])) {
                        // 制作側が固定した値（A, B, O, AB）しか送信されないためエスケープなしで出力
                        echo "<p>選択された血液型: <strong>" . $_POST['blood'] . " 型</strong></p>";
                        echo "<p style='font-size: 12px; color: #666; margin-top: 5px;'>※固定値受信のため、この項目には <code>htmlspecialchars()</code> は適用していません。</p>";
                    } else {
                        echo "<p style='color: #666;'>フォームのラジオボタンを選択して送信すると、ここに結果が表示されます。</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 デモ2：チェックボックスの配列受信と変換処理
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ2】チェックボックスの配列受信とコード値（数値）からのデコード変換</div>
                <div class="demo-label-code">📄 サーバー側の受信プログラム記述</div>
                <pre><code>$fav_master = array('0' => '旅行', '1' => 'スポーツ', '2' => '音楽', '3' => 'インターネット');
foreach ($_POST['fav'] as $code) {
    echo $fav_master[$code]; // 送信された数値コードを文字列に変換して出力
}</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際のリアルタイム実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    if (isset($_POST['fav']) && is_array($_POST['fav'])) {
                        // フォーム側と共通のマスタ配列定義
                        $fav_master = array('0' => '旅行', '1' => 'スポーツ', '2' => '音楽', '3' => 'インターネット');

                        echo "<p>送信されたコード（数値配列）の状態: <code>" . implode(', ', $_POST['fav']) . "</code></p>";
                        echo "<p style='margin-top: 8px; font-weight: bold;'>➔ マスタ配列を使って文字列に変換した結果：</p><ul>";

                        foreach ($_POST['fav'] as $code) {
                            // キーが存在するか安全のためにチェック
                            if (array_key_exists($code, $fav_master)) {
                                echo "<li>コード [ " . htmlspecialchars($code, ENT_QUOTES, 'UTF-8') . " ] ➔ <strong>" . $fav_master[$code] . "</strong></li>";
                            }
                        }
                        echo "</ul>";
                    } else {
                        echo "<p style='color: #666;'>フォームの趣味チェックボックスを選択して送信すると、数値コードから文字列へのループ変換結果が表示されます。</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 デモ3：テキストエリアの改行変換（nl2br）とネストの順序
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ3】テキストエリアの改行処理（nl2br）とエスケープ（htmlspecialchars）の順序実験</div>
                <div class="demo-label-code">📄 サーバー側の対策プログラム記述</div>
                <pre><code>// ⭕ 正しいネスト：エスケープした後に改行を変換する
echo nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8'));

// ❌ 間違ったネスト：改行を変換した後にエスケープする（&lt;br&gt;が文字化けする）
echo htmlspecialchars(nl2br($_POST['qus']), ENT_QUOTES, 'UTF-8');</code></pre>

                <div class="demo-label-output">🖥️ 出力（関数を重ねる「順番」による画面表示の対比）</div>
                <div class="demo-output-box">
                    <?php
                    if (isset($_POST['qus']) && strlen($_POST['qus']) > 0) {
                        $raw_qus = $_POST['qus'];

                        echo "<p style='color: #16a34a; font-weight: bold;'>⭕ 正しい順序（nl2br の中に htmlspecialchars）：</p>";
                        echo "<div style='background: #fff; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin: 5px 0 15px;'>";
                        echo nl2br(htmlspecialchars($raw_qus, ENT_QUOTES, 'UTF-8'));
                        echo "</div>";

                        echo "<p style='color: #b91c1c; font-weight: bold;'>❌ 間違った順序（htmlspecialchars の中に nl2br）：</p>";
                        echo "<div style='background: #fff; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin: 5px 0 5px;'>";
                        echo htmlspecialchars(nl2br($raw_qus), ENT_QUOTES, 'UTF-8');
                        echo "</div>";
                        echo "<p style='font-size: 12px; color: #b91c1c;'>※順番を逆にすると、<code>nl2br()</code> が追加した <code>&lt;br /&gt;</code> タグ自体がエスケープされ、画面にそのまま文字として露出してしまいます。</p>";
                    } else {
                        echo "<p style='color: #666;'>フォームのテキストエリアに<strong>改行を入れた複数行の文章</strong>を入力して送信すると、関数の重ね順による見栄えの違いがここにハッキリと現れます。</p>";
                    }
                    ?>
                </div>
            </div>

            <p style="margin-top: 25px;">
                <a href="scl0930.php" class="link-board">➔ 9月30日の授業解説ノート（まとめ）へ戻る</a>
            </p>

        </main>
    </div> <!-- .container 終了 -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>