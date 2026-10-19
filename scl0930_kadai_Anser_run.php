<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <title>9/30(水) 課題解答例・実技プログラム実行デモ | ポートフォリオサイト</title>
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
      border: 2px solid #1e3a8a;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 25px;
    }

    .demo-form p {
      font-size: 14px;
      margin-bottom: 12px;
      color: #334155;
    }

    .demo-input-text {
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      width: 140px;
      margin-right: 10px;
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
    }

    .demo-submit-btn:hover {
      background-color: #e07b00;
    }

    .code-headline {
      font-size: 16px;
      font-weight: bold;
      color: #1e3a8a;
      margin-top: 30px;
      margin-bottom: 10px;
      border-left: 5px solid #ff8c00;
      padding-left: 10px;
    }
  </style>
</head>

<body>

  <!-- 共通ヘッダー -->
  <?php include 'header.php'; ?>

  <!-- メインレイアウト -->
  <div class="container">
    <main class="main-content">

      <h2>9/30(水) 課題解答例・プログラム実行デモ</h2>
      <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
        講師が記述した「フォーム送信」と「フォーム受信」の課題コードを、このページ内でリアルタイムに動かして動作確認ができます。画面下部ではそれぞれのソースコードを対比して確認できます。
      </p>
      <p>⚠️実行デモの為、未入力があった場合のエラー時は、このページに戻る設定にしております。</p>

      <!-- ==========================================
                 ルール③：実際の動作確認用入力フォーム（ページ内完結）
                 ========================================== -->
      <form action="scl0930_kadai_Anser_run.php" method="post" class="demo-form">
        <h3 style="font-size: 16px; color: #1e3a8a; margin-bottom: 15px; font-weight: bold;">🖥️ 課題動作確認フォーム</h3>

        <p>
          苗字 <input type="text" name="l_name" class="demo-input-text" placeholder="山田" value="<?php echo isset($_POST['l_name']) ? htmlspecialchars($_POST['l_name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
          名前 <input type="text" name="f_name" class="demo-input-text" placeholder="太郎" value="<?php echo isset($_POST['f_name']) ? htmlspecialchars($_POST['f_name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        </p>

        <p>
          年代
          <label><input type="radio" name="age" value="0" <?php echo (isset($_POST['age']) && $_POST['age'] === '0') ? 'checked' : ''; ?>> ２０代以下</label>
          <label><input type="radio" name="age" value="1" <?php echo (isset($_POST['age']) && $_POST['age'] === '1') ? 'checked' : ''; ?>> ３０代</label>
          <label><input type="radio" name="age" value="2" <?php echo (isset($_POST['age']) && $_POST['age'] === '2') ? 'checked' : ''; ?>> ４０代</label>
          <label><input type="radio" name="age" value="3" <?php echo (isset($_POST['age']) && $_POST['age'] === '3') ? 'checked' : ''; ?>> ５０代以上</label>
        </p>

        <p>
          性別
          <label><input type="radio" name="gender" value="0" <?php echo (isset($_POST['gender']) && $_POST['gender'] === '0') ? 'checked' : ''; ?>> 男</label>
          <label><input type="radio" name="gender" value="1" <?php echo (isset($_POST['gender']) && $_POST['gender'] === '1') ? 'checked' : ''; ?>> 女</label>
          <label><input type="radio" name="gender" value="2" <?php echo (isset($_POST['gender']) && $_POST['gender'] === '2') ? 'checked' : ''; ?>> 回答しない</label>
        </p>

        <p>
          行きたい旅行先
          <label><input type="checkbox" name="trip[]" value="0" <?php echo (isset($_POST['trip']) && in_array('0', $_POST['trip'])) ? 'checked' : ''; ?>> アジア</label>
          <label><input type="checkbox" name="trip[]" value="1" <?php echo (isset($_POST['trip']) && in_array('1', $_POST['trip'])) ? 'checked' : ''; ?>> アメリカ</label>
          <label><input type="checkbox" name="trip[]" value="2" <?php echo (isset($_POST['trip']) && in_array('2', $_POST['trip'])) ? 'checked' : ''; ?>> ヨーロッパ</label>
          <label><input type="checkbox" name="trip[]" value="3" <?php echo (isset($_POST['trip']) && in_array('3', $_POST['trip'])) ? 'checked' : ''; ?>> 南米</label>
          <label><input type="checkbox" name="trip[]" value="4" <?php echo (isset($_POST['trip']) && in_array('4', $_POST['trip'])) ? 'checked' : ''; ?>> その他</label>
        </p>

        <input type="submit" value="送信（PHPを実行）" class="demo-submit-btn">
      </form>

      <div class="demo-label-output">🖥️ 受信側のリアルタイム実行出力結果</div>
      <div class="demo-output-box" style="margin-bottom: 40px; background-color: #ffffff;">
        <?php
        // 講師の受信ロジックをページ内完結用に落とし込み
        if (isset($_POST['l_name']) && isset($_POST['f_name']) && isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['trip']) && strlen($_POST['l_name']) > 0 && strlen($_POST['f_name']) > 0):

          $agearr = array('２０代以下', '３０代', '４０代', '５0代以上');
          $genderarr = array('男', '女', '回答しない');
          $triparr = array('アジア', 'アメリカ', 'ヨーロッパ', '南米', 'その他');
        ?>
          <h4 style="font-size: 15px; color: #16a34a; margin-bottom: 10px; font-weight: bold;">【送信データ表示】</h4>
          <p style="margin-bottom: 5px;">苗字：<strong><?php echo htmlspecialchars($_POST['l_name'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
          <p style="margin-bottom: 5px;">名前：<strong><?php echo htmlspecialchars($_POST['f_name'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
          <p style="margin-bottom: 5px;">年代：<strong><?php echo $agearr[$_POST['age']]; ?></strong></p>
          <p style="margin-bottom: 10px;">性別：<strong><?php echo $genderarr[$_POST['gender']]; ?></strong></p>
          <p style="margin-bottom: 5px; font-weight: bold; color: #1e3a8a;">行きたい旅行先：</p>
          <ul style="padding-left: 20px;">
            <?php foreach ($_POST['trip'] as $value): ?>
              <li><strong><?php echo $triparr[$value]; ?></strong></li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p style="color: #666;">※ 上記のフォームに入力・選択を行い「送信」ボタンを押すと、ここに講師記述の受信ロジックに基づいた結果がリアルタイムに出力されます。</p>
        <?php endif; ?>
      </div>
      <!-- ==========================================
                 ルール③：入力フォームの下に実際のソースコードを表示
                 ========================================== -->
      <div class="code-headline">📄 【送信側】 formsend_renshuu.php のソースコード</div>
      <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
  &lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;フォーム送信&lt;/title&gt;
  &lt;/head&gt;
  &lt;body&gt;
    &lt;h1&gt;入力フォーム&lt;/h1&gt;
    &lt;form action="./formget_renshuu.php" method="post"&gt;
      &lt;p&gt;苗字&lt;input type="text" name="l_name"&gt;
      名前&lt;input type="text" name="f_name"&gt;&lt;/p&gt;
      &lt;p&gt;年代 &lt;input type="radio" name="age" value="0"&gt;２０代以下
      &lt;input type="radio" name="age" value="1"&gt;３０代
      &lt;input type="radio" name="age" value="2"&gt;４０代
      &lt;input type="radio" name="age" value="3"&gt;５０代以上&lt;/p&gt;
      &lt;p&gt;性別 &lt;input type="radio" name="gender" value="0"&gt;男
      &lt;input type="radio" name="gender" value="1"&gt;女
      &lt;input type="radio" name="gender" value="2"&gt;回答しない&lt;/p&gt;
      &lt;p&gt;行きたい旅行先 &lt;input type="checkbox" name="trip[]" value="0"&gt;アジア
      &lt;input type="checkbox" name="trip[]" value="1"&gt;アメリカ
      &lt;input type="checkbox" name="trip[]" value="2"&gt;ヨーロッパ
      &lt;input type="checkbox" name="trip[]" value="3"&gt;南米
      &lt;input type="checkbox" name="trip[]" value="4"&gt;その他&lt;/p&gt;
      &lt;input type="submit" value="送信"&gt;
    &lt;/form&gt;
  &lt;/body&gt;
&lt;/html&gt;</code></pre>

      <div class="code-headline">🖥️ 【受信側】 formget_renshuu.php のソースコード</div>
      <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
  &lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;フォーム受信&lt;/title&gt;
  &lt;/head&gt;
  &lt;body&gt;
    &lt;h1&gt;送信データ表示&lt;/h1&gt;
&lt;?php
  if(isset($_POST['l_name']) &amp;&amp; isset($_POST['f_name']) &amp;&amp; isset($_POST['age']) &amp;&amp; isset($_POST['gender']) &amp;&amp; isset($_POST['trip'])&amp;&amp; strlen($_POST['l_name'])&gt;0 &amp;&amp; strlen($_POST['f_name'])&gt;0):

    $agearr=array('２０代以下','３０代','４０代','５０代以上');
    $genderarr=array('男','女','回答しない');
    $triparr=array('アジア','アメリカ','ヨーロッパ','南米','その他');
?&gt;
    &lt;p&gt;苗字　&lt;?php echo htmlspecialchars($_POST['l_name'],ENT_QUOTES,'UTF-8'); ?&gt;&lt;/p&gt;
    &lt;p&gt;名前　&lt;?php echo htmlspecialchars($_POST['f_name'],ENT_QUOTES,'UTF-8'); ?&gt;&lt;/p>
    &lt;p&gt;&lt;?php echo $agearr[$_POST['age']]; ?&gt;&lt;/p&gt;
    &lt;p&gt;&lt;?php echo $genderarr[$_POST['gender']]; ?&gt;&lt;/p&gt;
&lt;?php
      foreach($_POST['trip'] as $value):
?&gt;
    &lt;p&gt;&lt;?php echo $triparr[$value]; ?&gt;&lt;/p&gt;
&lt;?php
  endforeach;
?&gt;
&lt;?php
  else:
?&gt;
  &lt;p&gt;未入力の項目があります&lt;/p&gt;
  &lt;p&gt;&lt;a href="./formsend_renshuu.php"&gt;入力ページへ&lt;/a&gt;&lt;/p&gt;
&lt;?php
  endif;
?&gt;
  &lt;/body&gt;
&lt;/html&gt;</code></pre>
            <p style="margin-top: 25px;">
                <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>
    </main>
  </div> <!-- .container 終了 -->

  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
<!-- http://localhost/study/scl0930_kadai_Anser.php -->