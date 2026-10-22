<?php
$dir_path = 'kaiin_system/kaiin_system/kaiinpdo/';

$files = [
    'login'   => [
        'title' => '🔑 ログイン処理',
        'filename' => 'log.php',
        'demo' => 'login.html'
    ],
    'delete'  => [
        'title' => '❌ 退会処理',
        'filename' => 'sakuzyo.php',
        'demo' => 'sakuzyo.html'
    ],
    'create'  => [
        'title' => '📝 新規登録処理',
        'filename' => 'touroku.php',
        'demo' => 'kaiinntouroku.html'
    ],
    'csv'     => [
        'title' => '📥 CSV出力',
        'filename' => 'download.php',
        'demo' => 'download.html'
    ],
    'update'  => [
        'title' => '🔄 情報変更処理',
        'filename' => 'henko.php',
        'demo' => 'henko.html'
    ],
];

// 現在選択されているファイルを判定（デフォルトは最初のファイル）
$current_key = isset($_GET['file']) && array_key_exists($_GET['file'], $files) ? $_GET['file'] : 'login';
$current_file = $files[$current_key];

// フォルダ名とファイル名を合体させて、完全なファイルパスを作成
$full_path = $dir_path . $current_file['filename'];
$demo_path = $dir_path . $current_file['demo'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>教材動作デモ ＆ 生コードプレビュー | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ページ大見出しの装飾を集約 */
        .page-title {
            color: #1e3a8a;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 8px;
        }

        .page-desc {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        /* ⚠️ デモ画面用の警告バナー（実務仕様） */
        .demo-warning-banner {
            background-color: #fff5f5;
            /* 薄い赤色の背景 */
            border-left: 6px solid #e11d48;
            /* 左側に太い赤のアクセント線 */
            color: #9f1239;
            /* 濃い赤色の文字 */
            padding: 15px 20px;
            /* 内側の余白 */
            margin-bottom: 25px;
            /* 下のメニューとの隙間 */
            border-radius: 4px;
            /* 角を少し丸く */
            font-size: 14px;
            line-height: 1.6;
        }

        .demo-warning-banner strong {
            color: #e11d48;
            /* 特に強調したいキーワードの色 */
        }

        .demo-warning-banner ul {
            margin-top: 8px;
            padding-left: 20px;
            margin-bottom: 0;
        }

        /* タブメニュー専用の装飾 */
        .code-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
            border-bottom: 2px solid #1e3a8a;
        }

        .code-tabs li {
            margin-bottom: -2px;
        }

        .code-tabs a {
            display: block;
            padding: 10px 20px;
            background-color: #f1f5f9;
            color: #475569;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s;
        }

        .code-tabs a:hover {
            background-color: #e2e8f0;
        }

        .code-tabs .active a {
            background-color: #1e3a8a;
            color: #ffffff;
            border-color: #1e3a8a;
        }

        /* 🌐 動作デモ画面を包む枠 */
        .demo-frame-container {
            background-color: #ffffff;
            border: 2px solid #1e3a8a;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .demo-frame {
            width: 100%;
            height: 150px;
            border: none;
            background-color: #ffffff;
        }

        /* 💻 PHPのハイライト出力を格納するコンテナ */
        .php-highlight-box {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 20px;
            overflow-x: auto;
            font-family: Consolas, Monaco, 'Andale Mono', monospace;
            font-size: 14px;
            line-height: 1.6;
        }

        .php-highlight-box code,
        .php-highlight-box span {
            font-family: Consolas, Monaco, 'Andale Mono', monospace !important;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <main class="main-content">
            <h2 class="page-title">DB操作・会員管理システム 動作デモ＆生コード</h2>
            <p class="page-desc">※上のタブを切り替えることで、それぞれの「動作デモ画面」と「プログラムコード」が連動して切り替わる。</p>

            <!-- ⚠️ 記述を強化した実務仕様の警告アラートエリア -->
            <div class="demo-warning-banner">
                <strong>⚠️ セキュリティに関する重要なお願い</strong><br>
                本画面は職業訓練のアウトプット用デモ画面です。悪意ある第三者への情報漏洩を防ぐため、レンタルサーバー上では<strong>実際の個人情報や、他サイトで普段お使いのID・パスワードは絶対に入力しないでください。</strong>
                <ul>
                    <li>動作テストを行う際は、新規登録画面からテスト用のアカウントを別途作成していただくか、以下のデモ用共通アカウントをご利用ください。</li>
                    <li><strong>【テスト用アカウントの一例】</strong> ID: <code>test_user</code> / PASS: <code>password123</code></li>
                </ul>
            </div>

            <!-- ファイル切り替えタブ -->
            <ul class="code-tabs">
                <?php foreach ($files as $key => $info): ?>
                    <li class="<?= $key === $current_key ? 'active' : '' ?>">
                        <a href="?file=<?= $key ?>"><?= htmlspecialchars($info['title']) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- 1. 🌐 動作デモフォームエリア -->
            <h3 class="note-title">🌐 動作デモフォーム</h3>
            <div class="demo-frame-container">
                <?php if (file_exists($demo_path)): ?>
                    <!-- iframeを使ってHTMLの入力画面をその場で実行させます -->
                    <iframe src="<?= htmlspecialchars($demo_path) ?>" class="demo-frame"></iframe>
                <?php else: ?>
                    <p style="color:red;">デモ用HTMLファイル（<?= htmlspecialchars($demo_path) ?>）が見つかりません。</p>
                <?php endif; ?>
            </div>

            <!-- 2. 💻 ソースコード表示エリア -->
            <h3 class="note-title">💻 サーバー側処理ソースコード（PDO版）</h3>
            <div class="php-highlight-box">
                <p style="font-size: 12px; color: #666; margin-bottom: 10px; border-bottom: 1px dashed #ddd; padding-bottom: 5px;">
                    📄 プレビュー中のPHPファイル: <strong><?= htmlspecialchars($full_path) ?></strong>
                </p>
                <?php
                if (file_exists($full_path)) {
                    highlight_file($full_path);
                } else {
                    echo '<p style="color:red; font-weight:bold;">ファイルが見つかりません。</p>';
                }
                ?>
            </div>
            <p style="margin-top: 30px;">
                <a href="0915_1119.php" class="link-board">➔ データベース・PHP授業一覧ページへ戻る</a>
            </p>
        </main>
    </div>
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>

</html>