<?php
// エラーを画面に表示させる設定（原因特定のため）
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 処理時間を引き延ばす設定（サーバーが許す限り）
set_time_limit(60);

// ==========================================
// 1. InfinityFree データベース接続設定
// ==========================================
$dsn = 'mysql:host=sql210.infinityfree.com;dbname=if0_42505591_bbs;charset=utf8mb4';
$user = 'if0_42505591';
$password = 'Cvp0m9xHZOUL8pZ';

$search_dir = './'; 
$target_extensions = ['php', 'html', 'txt']; 
// 除外リスト（重そうなzipファイルや画像系フォルダは最初から触らせない）
$exclude_files = ['import_files.php', 'search_result.php', '.gitignore', 'header.php', 'meta.php', 'kaiin_system.zip', 'gazou.zip', 'oneline_bbs.zip'];
$exclude_dirs = ['gazou', 'images', 'img']; // 画像フォルダはスキップ

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    exit('データベース接続に失敗しました: ' . $e->getMessage());
}

// ==========================================
// 2. ファイルの自動スキャンとDB登録処理
// ==========================================
if (is_dir($search_dir)) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($search_dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    $inserted_count = 0;

    $sql = "INSERT INTO site_search_index (file_path, title, content) 
            VALUES (:file_path, :title, :content)
            ON DUPLICATE KEY UPDATE title = :title, content = :content";
    $stmt = $pdo->prepare($sql);

    foreach ($files as $file) {
        if ($file->isFile()) {
            $filename = $file->getFilename();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $file_path = $file->getPathname();

            // 画像フォルダなどのパスが含まれている場合はスキップ
            foreach ($exclude_dirs as $dir) {
                if (strpos($file_path, '/' . $dir . '/') !== false) {
                    continue 2;
                }
            }
            
            // 対象の拡張子、かつ除外ファイルでない場合のみ処理
            if (in_array($ext, $target_extensions) && !in_array($filename, $exclude_files)) {
                
                // 1ファイルごとにエラーが起きても処理を止めないように対策
                try {
                    $raw_content = @file_get_contents($file_path);
                    if ($raw_content === false) continue;

                    // あまりに大きいファイル（1MB以上など）はスキップしてサーバーへの負荷を下げる
                    if (filesize($file_path) > 1024 * 1024) continue;
                    
                    // テキスト抽出
                    $clean_content = strip_tags($raw_content);
                    $clean_content = preg_replace('/<\?php.*?\?>/s', '', $clean_content);
                    $clean_content = preg_replace('/\s+/', ' ', $clean_content);
                    $clean_content = trim($clean_content);

                    // データベースへ保存
                    $stmt->bindValue(':file_path', $file_path, PDO::PARAM_STR);
                    $stmt->bindValue(':title', $filename, PDO::PARAM_STR);
                    $stmt->bindValue(':content', $clean_content, PDO::PARAM_STR);
                    $stmt->execute();

                    $inserted_count++;
                } catch (Exception $fileError) {
                    // エラーが出たファイル名を表示して次に進む
                    echo "スキップしたファイル: " . htmlspecialchars($file_path) . " (" . $fileError->getMessage() . ")<br>";
                }
            }
        }
    }

    echo "<h2>インポート処理が終了しました</h2>";
    echo "<p>合計 <strong>{$inserted_count}</strong> 件のファイルをデータベースに登録・更新しました。</p>";
} else {
    echo "指定されたディレクトリが見つかりません。";
}
?>
