<?php
// URLの「?page=◯◯」を判定して変数に代入（何も指定がない場合は 'home'）
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IT経験が0の私が職業訓練を受講しながら日々プログラミングの自主勉強や授業の内容をアップし、かつポートフォリオとして活用できればと思い立ったサイトです。">
    <title>職業訓練及び自主学習 | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- PHPで別ファイルのヘッダーをここにガッチャンコ（共通読み込み）します -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        
        <!-- メイン表示エリア（URLのパラメータによって中身が自動で切り替わります） -->
        <main class="main-content">
            <?php
            if ($page === 'lesson1') {
                echo '<h2>2026/10/12：HTMLの基礎</h2>';
                echo '<p>ここに授業内容の文章や、習ったコードの解説などを記述します。</p>';
            } elseif ($page === 'lesson2') {
                echo '<h2>2026/10/10：CSSのデザイン</h2>';
                echo '<p>ここにCSSに関する解説や、苦労したポイントなどを記述します。</p>';
            } elseif ($page === 'test1') {
                echo '<h2>第1回テスト問題</h2>';
                echo '<p>ここに定期テストの問題や、自分が解いた回答・解説を記述します。</p>';
            } elseif ($page === 'self1') {
                echo '<h2>JavaScriptの深掘り</h2>';
                echo '<p>自主学習した成果や、ノート、試作したミニプログラムなどをここに記述します。</p>';
            } else {
                // 初期状態の表示（ホーム画面）
                echo '<h2>メイン表示エリア</h2>';
                echo '<p>プルダウンメニューのリンク先をクリックすると、その内容がここに表示されます。</p>';
                echo '<p style="margin-top: 20px; color: #666;">上のメニューから「授業内容」や「自主学習」を選んでみてください。</p>';
            }
            ?>
        </main>

        <!-- 右側：更新履歴（サイズ固定・枠内スクロール） -->
        <aside class="sidebar-history">
            <h3>更新履歴</h3>
            <div class="history-list">
                <p>2026/10/12：サイトを開設しました。</p>
                <p>2026/10/11：メニュー構造を設定。</p>
                <p>2026/10/10：デザイン案を作成。</p>
                <p>2026/10/09：履歴のテスト投稿です。</p>
                <p>2026/10/08：履歴のテスト投稿です。</p>
            </div>
        </aside>
    </div>

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
<!-- http://localhost/study/index.php -->