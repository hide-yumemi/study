<?php
// DB接続情報
if ($_SERVER['SERVER_NAME'] === 'localhost') {
  $dbname = 'mysql:host=localhost;dbname=oneline_bbs;charset=utf8';
  $id = 'root';
  $pw = '';
} else {
  $dbname = 'mysql:host=://infinityfree.com;dbname=if0_42505591_bbs;charset=utf8';
  $id = 'if0_42505591';
  $pw = 'Cvp0m9xHZOUL8pZ';
}

try {
  $pdo = new PDO($dbname, $id, $pw, array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
  exit('データベース接続失敗。' . $e->getMessage());
}

$errors = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // 名前のバリデーション
  $name = null;
  if (!isset($_POST["name"]) || !strlen($_POST["name"])) {
    $errors["name"] = "名前を入力してください";
  } else if (strlen($_POST["name"]) > 40) {
    $errors["name"] = "名前は４０文字以内で入力してください";
  } else {
    $name = $_POST["name"];
  }

  // ひとことのバリデーション
  $comment = null;
  if (!isset($_POST["comment"]) || !strlen($_POST["comment"])) {
    $errors["comment"] = "ひとことを入力してください";
  } else if (strlen($_POST["comment"]) > 200) {
    $errors["comment"] = "ひとことは２００文字以内で入力してください";
  } else {
    $comment = $_POST["comment"];
  }

  // ---- 画像アップロード処理（必須・サイズ・形式・ファイル名規則） ----
  $image_name = null;

  // 画像が選択されていない、またはアップロードエラーがある場合
  if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
    $errors['image'] = "画像の送信は必須です。写真を選択してください。";
  } else if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $errors['image'] = "ファイルのアップロード中にエラーが発生しました。";
  } else {
    $uploaded_file = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];

    // 1. 画像サイズチェック（1,000,000バイト以内）
    if ($file_size > 1000000) {
      $errors['image'] = "画像サイズは1MB以内でアップロードしてください。";
    }

    // 2. 画像形式チェック（jpeg限定）
    $mime_type = mime_content_type($uploaded_file);
    if ($mime_type !== 'image/jpeg' && $_FILES['image']['type'] !== 'image/jpeg') {
      $errors['image'] = "画像形式はjpegのみアップロード可能です。";
    }

    // エラーがなければ保存処理
    if (!isset($errors['image'])) {
      // 3. ファイル名の命名規則（img + 年月日時分秒 + .jpg）※合計21文字
      $image_name = 'img' . date('YmdHis') . '.jpg';
      $upload_dir = 'uploads/';

      // 画像をuploadsフォルダに移動
      if (!move_uploaded_file($uploaded_file, $upload_dir . $image_name)) {
        $errors['image'] = "画像の保存に失敗しました。";
      }
    }
  }

  $date = date('Y-m-d H:i:s');

  if (count($errors) === 0) {
    // gazouテーブル、imgカラムに保存
    $sql = 'INSERT INTO `gazou` (`name`, `comment`, `img`, `created_at`) VALUES (:name, :comment, :img, :created_at)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':img', $image_name);
    $stmt->bindParam(':created_at', $date);
    $stmt->execute();
    $stmt = null;

    // リダイレクト
    header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <title>写真付きひと言掲示板 | ポートフォリオサイト</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../scl_style.css">

</head>

<body>
  <?php if (file_exists(__DIR__ . '/../header.php')) {
    include __DIR__ . '/../header.php';
  }
  ?>
  <div class="container">
    <main class="main-content">

      <h2>写真付きひと言掲示板 デモ</h2>

      <p style="color: #666; font-size: 14px; margin-bottom: 25px;">指定されたすべての仕様（jpeg限定、100万バイト制限、ファイル名21文字指定、出力サイズ指定）を実装したデモ画面です。 </p>

      <!-- 入力フォームエリア -->
      <div class="demo-set-container">
        <div class="demo-set-title">
          📝 新規投稿フォーム（※写真送信必須）
        </div>

        <?php if (count($errors) > 0): ?>

          <div class="error-list">
            <ul style="margin: 0; padding-left: 20px;">
              　<?php foreach ($errors as $error): ?>
              <li><?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?></li>
            <?php endforeach; ?>
            </ul>
          </div><?php endif; ?>

        <form action="scl1020_run.php" method="post" enctype="multipart/form-data">

          <div class="bbs-form-group"><label for="name">名前</label>
            <input type="text" id="name" name="name" class="bbs-input-text" placeholder="お名前を入力（40文字以内）">
          </div>

          <div class="bbs-form-group"><label for="comment">ひと言</label>
            <input type="text" id="comment" name="comment" class="bbs-input-text" placeholder="メッセージを入力（200文字以内）">
          </div>

          <div class="bbs-form-group"><label for="image">写真を追加（必須 / JPEGのみ / 1MB以内）</label>
            <input type="file" id="image" name="image" accept="image/jpeg">
          </div>

          <div style="margin-top: 20px;"><input type="submit" name="submit" value="メッセージを投稿する" class="bbs-submit-btn"></div>
        </form>
      </div>
      <!-- 表示エリア -->
      <div class="demo-set-container">
        <div class="demo-set-title">
          🖥️ 投稿ログ一覧（最新順）
        </div>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM `gazou` ORDER BY `created_at` DESC");
        $result = $stmt->execute();
        ?>

        <div class="demo-output-box" style="background-color: #f8fafc; border: 1px solid #cbd5e1;">
          <?php if ($result !== false): ?>
            <ul class="post-list">
              <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <li class="post-item">

                  <div class="post-meta">投稿者:
                    <span class="post-name">
                      <?php echo htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8"); ?>
                    </span>| 投稿日時:
                    　<?php echo htmlspecialchars($row["created_at"], ENT_QUOTES, "UTF-8"); ?>
                  </div>

                  <div class="post-comment">
                    　<?php echo htmlspecialchars($row["comment"], ENT_QUOTES, "UTF-8"); ?>
                  </div>

                  <!-- タグ構成（alt="投稿画像" width="100" ）で出力 -->
                  　　<?php if (!empty($row["img"]) && file_exists('uploads/' . $row["img"])): ?>
                  　　<img src="uploads/<?php echo htmlspecialchars($row["img"], ENT_QUOTES, "UTF-8"); ?>" alt="投稿画像" width="100" class="post-image"><?php endif; ?>

                </li>

              <?php endwhile; ?>
            </ul><?php else: ?>
              <p style="text-align: center; color: #64748b;">投稿はまだありません。</p><?php endif; ?>
        </div>
      </div>
      <p style="margin-top: 25px;"><a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a></p>
    </main>
  </div><a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a><?php
                                                                        $stmt = null;
                                                                        $pdo = null;
                                                                        ?>
</body>

</html>