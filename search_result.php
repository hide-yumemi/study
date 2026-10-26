<?php
// ==========================================
// 1. データベース接続設定（InfinityFree用）
// ==========================================
$dsn = 'mysql:host=sql210.infinityfree.com;dbname=if0_42505591_bbs;charset=utf8mb4';
$user = 'if0_42505591';
$password = 'Cvp0m9xHZOUL8pZ';

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    exit('データベース接続失敗: ' . $e->getMessage());
}

// ユーザーが入力したキーワードの取得
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$results = [];

if ($keyword !== '') {
    // ==========================================
    // 2. 検索特化テーブルからキーワードを探す
    // ==========================================
    // タイトル、またはファイルの中身（content）に一致するものを検索
    $sql = "SELECT * FROM site_search_index WHERE title LIKE :kw OR content LIKE :kw ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':kw', '%' . $keyword . '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>「<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>」の検索結果</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 0 auto; padding: 20px; color: #333; }
        .search-box { margin-bottom: 30px; background: #f9f9f9; padding: 15px; border-radius: 5px; }
        .search-input { padding: 8px; width: 300px; font-size: 14px; }
        .search-btn { padding: 8px 15px; font-size: 14px; cursor: pointer; }
        .search-item { margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
        .search-title { font-size: 1.2em; font-weight: bold; margin-bottom: 5px; }
        .search-title a { color: #0066cc; text-decoration: none; }
        .search-title a:hover { text-decoration: underline; }
        .search-url { color: #228b22; font-size: 0.85em; word-break: break-all; }
        .search-snippet { color: #666; margin-top: 8px; font-size: 0.95em; }
        .match-highlight { background-color: #ffeb3b; font-weight: bold; } /* 検索ワードのハイライト用 */
    </style>
</head>
<body>

    <h1>サイト内検索</h1>
    
    <!-- 検索結果画面にも検索窓を置いておく（再検索しやすくするため） -->
    <div class="search-box">
        <form action="search_result.php" method="GET">
            <input type="text" name="keyword" class="search-input" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>" placeholder="キーワードを入力してください" required>
            <button type="submit" class="search-btn">再検索</button>
        </form>
    </div>

    <h2>「<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>」の検索結果（<?php echo count($results); ?>件）</h2>

    <?php if (empty($results)): ?>
        <p>該当するページが見つかりませんでした。別のキーワードをお試しください。</p>
    <?php else: ?>
        <div class="search-list">
            <?php foreach ($results as $row): ?>
                <?php
                // 画面表示用の抜粋文を作る（前後100文字）
                $snippet = mb_strimwidth($row['content'], 0, 200, '...');
                
                // 検索した文字を黄色くハイライトさせる処理
                $safe_keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
                $display_title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
                $display_snippet = htmlspecialchars($snippet, ENT_QUOTES, 'UTF-8');
                
                if ($keyword !== '') {
                    $highlight = '<span class="match-highlight">' . $safe_keyword . '</span>';
                    $display_title = str_ireplace($safe_keyword, $highlight, $display_title);
                    $display_snippet = str_ireplace($safe_keyword, $highlight, $display_snippet);
                }
                
                // データベース内の「./scl0924.php」といったパスを、そのままリンクに使えるよう調整
                // 頭の「./」を取り除いて通常のURL形式にします
                $clean_url = ltrim($row['file_path'], './');
                ?>
                <div class="search-item">
                    <div class="search-title">
                        <a href="<?php echo htmlspecialchars($clean_url, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo $display_title; ?>
                        </a>
                    </div>
                    <div class="search-url"><?php echo htmlspecialchars($clean_url, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="search-snippet"><?php echo $display_snippet; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <p style="margin-top: 40px;"><a href="index.php">トップページへ戻る</a></p>
</body>
</html>
