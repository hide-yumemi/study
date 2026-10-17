<?php
// エラー表示を有効化
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 変数の初期化
$upload_success = false;
$error_message = "";
$debug_info = [];
$filename = "";

// フォームからPOST送信かつファイルデータがある場合のみ受信ロジックを実行
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    
    // デバッグ情報の一時記録（var_dump風に出力するため）
    $debug_info['name'] = $_FILES['file']['name'];
    $debug_info['size'] = $_FILES['file']['size'];
    $debug_info['tmp_name'] = $_FILES['file']['tmp_name'];
    $debug_info['type'] = $_FILES['file']['type'];
    $debug_info['error'] = $_FILES['file']['error'];

    // 1. エラーコードチェック
    if ($_FILES['file']['error'] != 0) {
        $error_message = "ファイル送信エラーの為、再送信してください。";
    } 
    // 2. サイズ制限 (1MB)
    elseif ($_FILES['file']['size'] > 1000000) {
        $error_message = "ファイルが大きすぎます。サイズを調整しなおしてください。";
    } 
    // 3. MIMEタイプ制限 (jpegのみ)
    elseif ($_FILES['file']['type'] !== "image/jpeg") {
        $error_message = "jpeg(jpg)形式以外の形式のファイルは受付できません。ファイルの種類を確認して送信しなおしてください。";
    } 
    // すべてのバリデーションを通過した場合
    else {
        // 保存用ディレクトリの自動チェック
        if (!is_dir('images')) {
            mkdir('images', 0777, true);
        }

        // 重複のないユニークなファイル名生成 (永久ループ処理)
        while (1) {
            $base_path = "images/img";
            $date_str = date('YmdHis');
            $filename = $base_path . $date_str . '.jpg';

            if (!file_exists($filename)) {
                break; // 同名ファイルがなければループ脱出
            }
        }

        // 一時保管場所から正式なフォルダへ移動・保存
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
            $upload_success = true;
        } else {
            $error_message = "サーバー側でのファイルの保存移動に失敗しました。";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <title>10/05(月) 実技プログラム実行デモ | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?> 
  <style>
    /* ページ内完結用フォームの調整スタイル */
    .demo-form {
      background-color: #f8fafc;
      border: 2px solid #1e3a8a;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 25px;
    }
    .demo-input-file {
      padding: 8px;
      border: 1px dashed #cbd5e1;
      border-radius: 6px;
      background-color: #fff;
      margin-bottom: 15px;
      width: 100%;
    }
    .demo-input-text {
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      width: 250px;
      margin-left: 10px;
    }
    .demo-submit-btn {
      background-color: #ff8c00;
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
      font-size: 15px;
      margin-top: 15px;
    }
    .demo-submit-btn:hover {
      background-color: #e07b00;
    }
    .demo-label-output {
      font-size: 13px;
      font-weight: bold;
      color: #16a34a;
      margin: 20px 0 5px;
    }
    .demo-output-box {
      background-color: #ffffff;
      border: 1px dashed #16a34a;
      border-radius: 8px;
      padding: 15px;
      color: #334155;
      margin-bottom: 40px;
    }
    .var-dump-box {
      background-color: #f1f5f9;
      padding: 8px 12px;
      border-radius: 4px;
      font-family: monospace;
      font-size: 13.5px;
      color: #b91c1c;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>

  <!-- 共通ヘッダー -->
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <h2>10/05(月) 課題解答例・プログラム実行デモ</h2>
      <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
        記述した「画像ファイル送信」の入力フォームを使い、送信されたデータの受信状態とサーバー保存ロジックがリアルタイムに対比して確認できるデモ画面です。
      </p>

      <!-- 🖥️ 実際の動作確認用入力フォーム（ページ内完結） -->
      <form action="" method="post" enctype="multipart/form-data" class="demo-form">
        <h3 style="font-size: 16px; color: #1e3a8a; margin-bottom: 15px; font-weight: bold;">🖥️ 画像アップロード動作確認フォーム</h3>
        
        <p style="font-size: 14px; margin-bottom: 5px; font-weight: bold;">アップロードする画像 (JPEG形式のみ/1MB以内):</p>
        <input type="file" name="file" class="demo-input-file" required>
        
        <p style="font-size: 14px;">
          画像のタイトル: 
          <input type="text" name="title" class="demo-input-text" placeholder="例：サンプルの富士山" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
        </p>

        <input type="submit" value="送信（PHPを実行）" class="demo-submit-btn">
      </form>

      <!--  受信側のリアルタイム実行出力結果 -->
      <div class="demo-label-output">🖥️ 受信側のリアルタイム実行出力結果</div>
      <div class="demo-output-box">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($debug_info)): ?>
          <h4 style="font-size: 15px; color: #16a34a; margin-bottom: 15px; font-weight: bold;">【スーパーグローバル変数 $_FILES の中身】</h4>
          
          <p style="margin-bottom: 2px;">① ファイルのオリジナル名 [name]:</p>
          <div class="var-dump-box">string(<?php echo strlen($debug_info['name']); ?>) "<?php echo htmlspecialchars($debug_info['name'], ENT_QUOTES, 'UTF-8'); ?>"</div>

          <p style="margin-bottom: 2px;">② ファイルのサイズ（バイト数） [size]:</p>
          <div class="var-dump-box">int(<?php echo $debug_info['size']; ?>)</div>

          <p style="margin-bottom: 2px;">③ 一時保管先のパス [tmp_name]:</p>
          <div class="var-dump-box">string(<?php echo strlen($debug_info['tmp_name']); ?>) "<?php echo htmlspecialchars($debug_info['tmp_name'], ENT_QUOTES, 'UTF-8'); ?>"</div>

          <p style="margin-bottom: 2px;">④ ファイルのMIMEタイプ [type]:</p>
          <div class="var-dump-box">string(<?php echo strlen($debug_info['type']); ?>) "<?php echo htmlspecialchars($debug_info['type'], ENT_QUOTES, 'UTF-8'); ?>"</div>

          <p style="margin-bottom: 2px;">⑤ エラーコード [error]:</p>
          <div class="var-dump-box">int(<?php echo $debug_info['error']; ?>)</div>

          <hr style="border: 0; border-top: 1px solid #cbd5e1; margin: 20px 0;">

          <!-- エラー発生時の表示 -->
          <?php if (!empty($error_message)): ?>
            <div style="background-color: #fef2f2; border: 1px solid #fca5a5; padding: 15px; border-radius: 6px; color: #b91c1c; font-weight: bold;">
               ⚠️ エラー判定：<?php echo $error_message; ?>
            </div>
          <?php endif; ?>

          <!-- 保存成功時の表示 -->
          <?php if ($upload_success): ?>
            <h4 style="font-size: 15px; color: #1e3a8a; margin-bottom: 10px; font-weight: bold;">【サーバー保存後のレンダリング表示】</h4>
            <p style="margin-bottom: 5px; font-size: 13.5px; color: #475569;">自動生成されたリネームパス: <code><?php echo $filename; ?></code></p>
            <figure class="board-figure" style="margin-top: 10px;">
              <img src="<?php echo $filename; ?>" alt="アップロード画像" style="max-width: 300px; height: auto;">
              <figcaption class="board-figcaption"><?php echo htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'); ?></figcaption>
            </figure>
          <?php endif; ?>

        <?php else: ?>
          <p style="color: #666;">※ 上記のフォームから画像（JPEG形式）を選択し「送信」ボタンを押すと、ここに <code>$_FILES</code> の詳細ダンプ情報と、バリデーション通過後の画像がリアルタイムに出力されます。</p>
        <?php endif; ?>
      </div>

    </main>
  </div>

  <a href="#" class="top-button">▲ TOP</a>

</body>
</html>
