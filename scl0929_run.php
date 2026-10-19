<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>9/29(火) 実技プログラム実行デモ画面 | ポートフォリオサイト</title>
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

        .demo-input-text {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 250px;
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

            <h2>9/29(火) 実技プログラム実行デモ</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                この画面上で直接入力やファイルの選択を行うことで、サーバー側でスーパーグローバル変数（<code>$_GET</code> / <code>$_POST</code> / <code>$_FILES</code>）がどのように動くかをその場でリアルタイムに確認できます。
            </p>

            <!-- ==========================================
                 デモ1：GET送信の受け取り
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ1】$_GET によるURLパラメータの取得（P117）</div>

                <!-- ページ自身（空のaction、またはファイル名指定）に送信 -->
                <form action="scl0929_run.php" method="get" class="demo-form">
                    <label style="font-size: 14px; font-weight: bold;">キーワード(GET): </label>
                    <input type="text" name="keyword" class="demo-input-text" placeholder="検索ワードを入力..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <input type="submit" value="GET送信を実行" class="demo-submit-btn">
                </form>

                <div class="demo-label-code">📄 サーバー側の受信プログラム記述</div>
                <pre><code>if (isset($_GET['keyword'])) {
    echo "検索キーワード: " . htmlspecialchars($_GET['keyword'], ENT_QUOTES, 'UTF-8');
}</code></pre>

                <div class="demo-label-output">🖥️ 出力（実際のリアルタイム実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    if (isset($_GET['keyword']) && strlen($_GET['keyword']) > 0) {
                        echo "<p>フォームから届いたGETデータ: <strong style='color:#1e3a8a;'>" . htmlspecialchars($_GET['keyword'], ENT_QUOTES, 'UTF-8') . "</strong></p>";
                        echo "<p style='font-size: 12px; color: #666; margin-top: 5px;'>URLの末尾に <code>?keyword=〇〇</code> というパラメータが自動で付与されていることを確認してください。</p>";
                    } else {
                        echo "<p style='color: #666;'>上記のフォームに文字を入力して「GET送信を実行」ボタンを押すと、ここに結果が表示されます。</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 デモ2：POST送信と複数チェックボックスの配列受け取り
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ2】$_POST によるデータ取得と複数チェックボックスの二次元配列処理（P177）</div>

                <form action="scl0929_run.php" method="post" class="demo-form">
                    <div style="margin-bottom: 10px;">
                        <label style="font-size: 14px; font-weight: bold;">ユーザー名(POST): </label>
                        <input type="text" name="username" class="demo-input-text" placeholder="お名前を入力..." value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    </div>
                    <div style="font-size: 14px; margin-bottom: 10px;">
                        <span style="font-weight: bold;">趣味（複数選択可能の[]配列指定）:</span><br>
                        <?php
                        $hobbies = array('music' => '音楽', 'sports' => 'スポーツ', 'travel' => '旅行');
                        foreach ($hobbies as $key => $label) {
                            $checked = (isset($_POST['hobby']) && in_array($key, $_POST['hobby'])) ? 'checked' : '';
                            echo "<label style='margin-right: 12px;'><input type='checkbox' name='hobby[]' value='{$key}' {$checked}> {$label}</label>";
                        }
                        ?>
                    </div>
                    <input type="submit" value="POST送信を実行" class="demo-submit-btn" style="background-color: #ff8c00;">
                </form>

                <div class="demo-label-code">📄 サーバー側の受信プログラム記述</div>
                <pre><code>$username = $_POST['username'];
$hobby_array = $_POST['hobby']; // []を付けることで自動的に配列構造に変換される</code></pre>
                <div class="demo-label-output">🖥️ 出力（実際のリアルタイム実行結果）</div>
                <div class="demo-output-box">
                    <?php
                    // データの存在と1文字以上の入力をチェック（P174の基本鉄則）
                    if (isset($_POST['username']) && strlen($_POST['username']) > 0) {
                        $clean_user = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
                        echo "<p>フォームから届いたPOSTデータ: <strong>" . $clean_user . " さん</strong></p>";

                        // チェックボックス（配列）の受け取りチェック
                        if (isset($_POST['hobby']) && is_array($_POST['hobby'])) {
                            echo "<p style='margin-top: 10px; font-weight: bold;'>選択された趣味（ループ展開）:</p><ul>";
                            foreach ($_POST['hobby'] as $value) {
                                $clean_hobby = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                                echo "<li>" . $clean_hobby . " (" . ($clean_hobby === 'music' ? '音楽' : ($clean_hobby === 'sports' ? 'スポーツ' : '旅行')) . ")</li>";
                            }
                            echo "</ul>";

                            echo "<p style='margin-top: 10px;'>内部での連想配列 <code>var_dump()</code> のリアルタイム状態:</p>";
                            echo "<pre style='margin: 5px 0; padding: 10px;'>";
                            var_dump($_POST['hobby']);
                            echo "</pre>";
                        } else {
                            echo "<p style='color: #b91c1c; margin-top: 10px;'>※ 趣味のチェックボックスは一つも選択されていません。</p>";
                        }
                    } else {
                        echo "<p style='color: #666;'>上記のフォームにユーザー名を入力して「POST送信を実行」ボタンを押すと、ここに受信結果と配列データ構造がリアルタイムに表示されます。</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 デモ3：セキュリティ対策（htmlspecialchars のサニタイズ実験）
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ3】サニタイズ（無害化）によるクロスサイトスクリプティング（XSS）対策の比較</div>

                <div class="demo-label-code">📄 セキュリティ実験解説</div>
                <p style="font-size: 13.5px; margin-bottom: 10px; color: #475569;">
                    上記の【デモ2】のフォームのユーザー名入力欄に、悪意あるスクリプトに見立てた文字列（例： <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code> や <code>&lt;h1&gt;文字化け&lt;/h1&gt;</code> ）を入力して送信してみてください。エスケープの重要性が視覚的に確認できます。
                </p>

                <div class="demo-label-output">🖥️ 出力（安全なエスケープと危険な生の比較対比）</div>
                <div class="demo-output-box">
                    <?php
                    if (isset($_POST['username']) && strlen($_POST['username']) > 0) {
                        $raw_user = $_POST['username'];
                        $clean_user = htmlspecialchars($raw_user, ENT_QUOTES, 'UTF-8');

                        echo "<p style='color: #16a34a; font-weight: bold;'>⭕ 安全にサニタイズ（エスケープ）された出力:</p>";
                        echo "<p style='margin-bottom: 15px;'><code>htmlspecialchars()</code> 通過後: <strong style='color:#16a34a;'>" . $clean_user . "</strong></p>";

                        echo "<p style='color: #b91c1c; font-weight: bold;'>❌ 危険な生のままの出力イメージ（もし対策をしなかった場合）:</p>";
                        echo "<p style='font-size:12.5px; color:#666;'>※そのままブラウザに書き出すとタグとして誤認識され、レイアウト崩壊や不正スクリプト実行の原因になります。</p>";
                        // ポートフォリオの安全を維持するため、ここでも実際のタグ実行は str_replace で防ぎつつ、文字列としての対比イメージに留めています
                        $safely_show_raw = str_replace(array('<', '>'), array('&lt;', '&gt;'), $raw_user);
                        echo "<p style='margin-top:5px;'>画面への出力結果（文字としてそのまま解釈される危険な状態）: <code>" . $safely_show_raw . "</code></p>";
                    } else {
                        echo "<p style='color: #666;'>【デモ2】のフォームから送信されると、ここにサニタイズ対策の有無による出力結果の違いが表示されます。</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==========================================
                 デモ4：ファイル送信の受け取り情報（$_FILES）
                 ========================================== -->
            <div class="demo-set-container">
                <div class="demo-set-title">【デモ4】$_FILES によるアップロードファイル情報の詳細取得（P177補足）</div>

                <!-- ファイル送信は method="post" かつ enctype="multipart/form-data" が必須条件 -->
                <form action="scl0929_run.php" method="post" enctype="multipart/form-data" class="demo-form">
                    <label style="font-size: 14px; font-weight: bold;">ファイルを選択: </label>
                    <input type="file" name="user_file" style="font-size: 14px; margin-right: 10px;">
                    <input type="submit" value="ファイル情報解析を実行" class="demo-submit-btn" style="background-color: #16a34a;">
                </form>

                <div class="demo-label-code">📄 サーバー側の受信プログラム記述</div>
                <pre><code>if (isset($_FILES['user_file'])) {
    var_dump($_FILES['user_file']); // 2次元配列として一時領域のパスやファイル名が届く
}</code></pre>

                <div class="demo-label-output">🖥️ 出力（アップロードされたファイルのメタデータ解析）</div>
                <div class="demo-output-box">
                    <?php
                    if (isset($_FILES['user_file']) && $_FILES['user_file']['error'] !== UPLOAD_ERR_NO_FILE) {
                        $file_info = $_FILES['user_file'];

                        echo "<p>ファイルを検知しました。サーバーが受信した <code>\$_FILES</code> の多次元連想配列の解析データは以下の通りです：</p>";
                        echo "<dl class='board-dl' style='margin: 15px 0;'>";
                        echo "<dt>ユーザーPC上での元のファイル名 [name]</dt><dd><code>" . htmlspecialchars($file_info['name'], ENT_QUOTES, 'UTF-8') . "</code></dd>";
                        echo "<dt>ファイルのMIMEタイプ [type]</dt><dd><code>" . htmlspecialchars($file_info['type'], ENT_QUOTES, 'UTF-8') . "</code></dd>";
                        echo "<dt>サーバー上の一時保存先パス [tmp_name]</dt><dd><code>" . htmlspecialchars($file_info['tmp_name'], ENT_QUOTES, 'UTF-8') . "</code></dd>";
                        echo "<dt>ファイルサイズ [size]</dt><dd><strong>" . number_format($file_info['size']) . "</strong> バイト</dd>";
                        echo "<dt>アップロードエラーコード [error]</dt><dd><strong>コード " . $file_info['error'] . "</strong> (※ 0 は正常終了・エラーなし)</dd>";
                        echo "</dl>";

                        if ($file_info['error'] === 0) {
                            echo "<p style='color: #16a34a; font-weight: bold;'>➔ 判定結果: サーバーのテンポラリ領域（一時保管場所）への受信に成功しています！</p>";
                        } else {
                            echo "<p style='color: #b91c1c; font-weight: bold;'>➔ 判定結果: アップロード中にトラブルが発生しました。（エラーコード: " . $file_info['error'] . "）</p>";
                        }
                    } else {
                        echo "<p style='color: #666;'>上記のフォームから任意の画像やテキストファイルを選択して「ファイル情報解析を実行」ボタンを押すと、ここにサーバー内部に届いた詳細データが展開されます。</p>";
                    }
                    ?>
                </div>
            </div>

            <p style="margin-top: 25px;">
                <a href="scl0929.php" class="link-board">➔ 9月29日の授業解説ノート（まとめ）へ戻る</a>
            </p>
            <p style="margin-top: 25px;">
                <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>
        </main>
    </div> <!-- .container 終了 -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>