<?php
/*
🤖 ファイル名: scl1006_run.php (1/2)
🤖 目的: 10/06 先生の解答例ロジックに基づくバリデーション処理（上下縦並びレイアウト版）
*/

// 変数の初期化
$message = "";
$uploaded_info = [];
$error_message_list = []; // 画面表示用のエラー格納配列
$flag = false;

// フォームが送信されたときの検証・処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // 1. 必須入力および選択項目チェック
  if (!(isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['time']) && isset($_POST['week']) && strlen($_POST['email']) > 0 && strlen($_POST['tel']) > 0)) {
    $error_message_list[] = "未入力の項目があります。すべて入力して送信してください。";
    $flag = true;
  }

  // 2. ファイル送信自体のエラーチェック
  if (isset($_FILES['sendfile']) && $_FILES['sendfile']['error'] != 0) {
    $error_message_list[] = "ファイル送信エラーのため、再送信してください。";
    $flag = true;
  }

  // 3. ファイルのバリデーション（サイズ・形式）
  if (!$flag && isset($_FILES['sendfile'])) {
    // ファイルサイズチェック (1,000,000バイト制限)
    if ($_FILES['sendfile']['size'] > 1000000) {
      $error_message_list[] = "ファイルサイズが大きすぎます。サイズを調整して送信しなおしてください。";
      $flag = true;
    }

    // ファイル形式チェック (image/jpeg のみ許可)
    if ($_FILES['sendfile']['type'] != "image/jpeg") {
      $error_message_list[] = "jpeg（jpg）形式以外の形式のファイルは受付できません。ファイルの種類を確認して送信しなおしてください。";
      $flag = true;
    }
  }

  // 4. すべてのチェックを通過した場合の処理
  if (!$flag) {
    $message = " 送信確認完了（バリデーションをすべて通過しました）";

    // 先生のコード通りの変換用配列
    $timearr = array('9～12', '13～15', '15～17', '17～19');
    $weekarr = array('月', '火', '水', '木', '金');

    // チェックボックスの配列データを成形
    $selected_weeks = [];
    foreach ($_POST['week'] as $value) {
      $selected_weeks[] = $weekarr[$value];
    }

    // 画面表示用のデータセット
    $uploaded_info = [
      'email' => htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'),
      'tel' => htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8'),
      'time' => $timearr[$_POST['time']],
      'week' => implode('、', $selected_weeks),
      'file_name' => htmlspecialchars($_FILES['sendfile']['name'], ENT_QUOTES, 'UTF-8')
    ];
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <title>10/06(火) 動作デモ ＆ 生コードプレビュー | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
  <style>
    /* 縦並びのブロックレイアウト設定 */
    .demo-section {
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 35px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .code-section-bottom {
      background-color: #1e293b;
      color: #f8fafc;
      border-radius: 12px;
      padding: 30px;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* コードプレビューエリアの調整 */
    .code-title {
      font-size: 15px;
      font-weight: bold;
      color: #38bdf8;
      margin-top: 20px;
      margin-bottom: 8px;
      padding-left: 8px;
      border-left: 4px solid #38bdf8;
    }

    .code-section-bottom pre {
      background-color: #0f172a;
      border: 1px solid #334155;
      padding: 15px;
      margin-top: 5px;
      margin-bottom: 15px;
      max-height: 400px;
      overflow-y: auto;
      border-radius: 6px;
    }

    .code-section-bottom code {
      color: #e2e8f0;
      background-color: transparent;
      padding: 0;
      font-size: 13px;
    }

    /* シンプルなフォーム装飾 */
    .form-table {
      width: 100%;
      max-width: 700px;
      margin: 0 auto 20px;
      border-collapse: collapse;
    }

    .form-table td {
      padding: 12px 10px;
      vertical-align: middle;
    }

    .form-table td:first-child {
      width: 180px;
      font-weight: bold;
      color: #1e3a8a;
    }

    .input-text {
      width: 100%;
      max-width: 400px;
      padding: 8px 12px;
      border: 1px solid #cbd5e1;
      border-radius: 6px;
      font-size: 14.5px;
    }

    .input-text:focus {
      outline: none;
      border-color: #ff8c00;
    }

    .radio-check-group {
      display: inline-block;
      margin-right: 15px;
      font-size: 14.5px;
      cursor: pointer;
    }

    .submit-container {
      text-align: center;
      margin-top: 20px;
      padding-top: 15px;
      border-top: 1px dashed #e2e8f0;
    }

    .submit-btn {
      background-color: #ff8c00;
      color: white;
      border: none;
      padding: 10px 40px;
      border-radius: 20px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .submit-btn:hover {
      background-color: #e07b00;
    }

    /* アラート枠 */
    .alert-box {
      max-width: 700px;
      margin: 0 auto 20px;
      padding: 15px;
      border-radius: 8px;
      font-size: 14.5px;
      font-weight: bold;
    }

    .alert-error {
      background-color: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    .alert-success {
      background-color: #dcfce7;
      color: #166534;
      border: 1px solid #86efac;
    }
  </style>
</head>

<body>

  <!-- 共通ヘッダーパーツの読み込み -->
  <?php include 'header.php'; ?>

  <!-- メインレイアウトコンテナ -->
  <div class="container">
    <main class="main-content">

      <h1>10/06(火) 動作確認＆プログラムデモ</h1>

      <!--  すっきりシンプルな動作デモフォーム -->
      <div class="demo-section">
        <h3 class="note-title" style="border-left-color: #ff8c00; margin-bottom: 25px;">🌐 動作デモフォーム</h3>

        <!-- バリデーションの判定結果表示 -->
        <?php if (!empty($message)): ?>
          <div class="alert-box alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (!empty($error_message_list)): ?>
          <div class="alert-box alert-error">
            <?php foreach ($error_message_list as $err) {
              echo $err . "<br>";
            } ?>
          </div>
        <?php endif; ?>

        <!-- シンプルなテーブル配置のフォーム -->
        <form method="post" action="" enctype="multipart/form-data">
          <table class="form-table">
            <tr>
              <td>メールアドレス</td>
              <td><input type="email" name="email" class="input-text" placeholder="example@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></td>
            </tr>
            <tr>
              <td>TEL</td>
              <td><input type="text" name="tel" class="input-text" placeholder="090-1234-5678" value="<?php echo htmlspecialchars($_POST['tel'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></td>
            </tr>
            <tr>
              <td>連絡可能な時間帯</td>
              <td>
                <div class="radio-check-group"><input type="radio" name="time" value="0"> 9～12</div>
                <div class="radio-check-group"><input type="radio" name="time" value="1"> 13～15</div>
                <div class="radio-check-group"><input type="radio" name="time" value="2"> 15～17</div>
                <div class="radio-check-group"><input type="radio" name="time" value="3"> 17～19</div>
              </td>
            </tr>
            <tr>
              <td>連絡希望曜日（複数可）</td>
              <td>
                <div class="radio-check-group"><input type="checkbox" name="week[]" value="0"> 月</div>
                <div class="radio-check-group"><input type="checkbox" name="week[]" value="1"> 火</div>
                <div class="radio-check-group"><input type="checkbox" name="week[]" value="2"> 水</div>
                <div class="radio-check-group"><input type="checkbox" name="week[]" value="3"> 木</div>
                <div class="radio-check-group"><input type="checkbox" name="week[]" value="4"> 金</div>
              </td>
            </tr>
            <tr>
              <td>提出ファイル</td>
              <td><input type="file" name="sendfile" style="font-size: 14px;"></td>
            </tr>
          </table>

          <div class="submit-container">
            <input type="submit" value="送信する" class="submit-btn">
          </div>
        </form>

        <!-- 受信成功時の結果データ表示 -->
        <?php if (!empty($uploaded_info)): ?>
          <div class="board-dl" style="max-width: 700px; margin: 25px auto 0;">
            <h4 style="color: #1e3a8a; font-weight: bold; margin-bottom: 10px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 5px;">📥 送信された内容</h4>
            <p style="font-size: 14px; margin: 5px 0;"><strong>メールアドレス:</strong> <?php echo $uploaded_info['email']; ?></p>
            <p style="font-size: 14px; margin: 5px 0;"><strong>TEL:</strong> <?php echo $uploaded_info['tel']; ?></p>
            <p style="font-size: 14px; margin: 5px 0;"><strong>時間帯:</strong> <?php echo $uploaded_info['time']; ?>時</p>
            <p style="font-size: 14px; margin: 5px 0;"><strong>希望曜日:</strong> 「<?php echo $uploaded_info['week']; ?>」</p>
            <p style="font-size: 14px; margin: 5px 0; color: #166534;"><strong>アップロードファイル名:</strong> <?php echo $uploaded_info['file_name']; ?></p>
          </div>
        <?php endif; ?>
      </div>

      <!-- 【下配置】 先生の解答例のソースコード領域 -->
      <div class="code-section-bottom">
        <h3 style="color: #fff; font-size: 18px; font-weight: bold; border-left: 5px solid #38bdf8; padding-left: 12px; margin: 0;">💻 先生の解答例ソースコード</h3>

        <div class="code-title">📄 1. 送信側フォーム（form1006.php）</div>
        <pre><code><?php
                    $html_code = 'メールアドレス<input type="email" name="email"><br>
TEL<input type="text" name="tel"><br>
連絡可能な時間帯<input type="radio" name="time" value="0">9～12
<input type="radio" name="time" value="1">13～15...
連絡希望曜日<input type="checkbox" name="week[]" value="0">月...
提出ファイル<input type="file" name="sendfile"><br>
<input type="submit" value="送信">';
                    echo htmlspecialchars($html_code, ENT_QUOTES, 'UTF-8');
                    ?></code></pre>

        <div class="code-title">📄 2. 受信処理側（formget1006.php）のエラー判定コア</div>
        <pre><code><?php
                    $php_code = 'if(!(isset($_POST[\'email\']) && isset($_POST[\'tel\']) && isset($_POST[\'time\']) && isset($_POST[\'week\']) && strlen($_POST[\'email\'])>0 && strlen($_POST[\'tel\'])>0)):
    // 未入力時の処理
endif;

$flag=false;
if($_FILES[\'sendfile\'][\'size\'] > 1000000):
    $flag=true;
endif;
if($_FILES[\'sendfile\'][\'type\'] != "image/jpeg"):
    $flag=true;
endif;';
                    echo htmlspecialchars($php_code, ENT_QUOTES, 'UTF-8');
                    ?></code></pre>
      </div>

    </main>
  </div>

  <!-- 共通右下トップボタン -->
  <a href="#" class="top-button">▲ TOP</a>

</body>

</html>