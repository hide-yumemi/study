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
        <!-- あなたのメインコンテンツ枠をそのまま使用 -->
        <main class="main-content">
            <h2 style="color: #1e3a8a; border-bottom: 2px solid #1e3a8a; padding-bottom: 8px;">DB操作・会員管理システム 動作デモ＆生コード</h2>
            <p style="font-size: 13px; color: #666; margin-bottom: 20px;">※上のタブを切り替えることで、それぞれの「動作デモ画面」と「プログラムコード」が連動して切り替わる。</p>

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