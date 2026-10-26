<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="職業訓練の授業で作成したHTML入力フォームの動作確認と、Flexboxレイアウトに関する重要な注意点（交差軸の引き伸ばし現象）についての解説ノートです。">
  <title>8/3 課題 動作チェック（入力フォーム） | ポートフォリオサイト</title>

  <!-- 共通のベースCSSを読み込み -->
  <link rel="stylesheet" href="style.css">
  <!-- ノート・共通追加CSSを読み込み -->
  <link rel="stylesheet" href="scl_style.css">
  <style>
    /* フォームの見た目を少し整える簡易スタイル（サイトの文字色に最適化） */
    form p {
      margin-bottom: 15px;
    }
    input[type="text"], input[type="password"], input[type="email"], select, textarea {
      padding: 6px;
      border: 1px solid #cbd5e1;
      border-radius: 4px;
      font-size: 14px;
    }
    /* 注意書き（info-box）を赤系のreadmeとして共通CSSの思想で上書き定義 */
    .info-readme {
      background-color: #fff1f2;
      border: 1px solid #fecdd3;
      border-left: 4px solid #f43f5e;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 25px;
    }
    .info-readme p {
      font-size: 14.5px;
      color: #9f1239;
      line-height: 1.6;
      margin: 0;
    }
  </style>
</head>

<body>

  <!-- 共通ヘッダーの呼び出し -->
  <?php include 'header.php'; ?>

  <!-- メインレイアウト -->
  <div class="container">
    <main class="main-content">

      <h2>8/3 課題 動作チェック</h2>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">HTMLによる各種フォーム部品の実装と動作テスト</p>

      <!-- フォーム実物ブロック -->
      <div class="note-section">
        <h3 class="note-title">フォームデモ画面</h3>
        <form action="" method="post" enctype="multipart/form-data">
          <p>名前：<input type="text" name="namae"></p>
          <p>パスワード：<input type="password" name="pass"></p>
          <p>好きな色：<input type="color" name="color"></p>
          <p>血液型：
            <input type="radio" name="blood" value="1">B型
            <input type="radio" name="blood" value="2">AB型
            <input type="radio" name="blood" value="3">O型
            <input type="radio" name="blood" value="4">その他
          </p>
          <p>メールアドレス：<input type="email" name="email" size="40"></p>
          <p>
            居住都道府県：
            <select name="Ken">
              <option value="0">北海道</option>
              <optgroup label="東北">
                <option value="1">青森</option>
                <option value="2">秋田</option>
              </optgroup>
            </select>
          </p>
          <p>
            <textarea name="qus" cols="50" rows="8" placeholder="お問い合わせ内容"></textarea>
          </p>
          <p>写真：<input type="file" name="file"></p>
          <p>
            <input type="submit" value="登録">
            <input type="reset" value="内容消去">
            <input type="button" value="script">
          </p>
          <p><button type="button">click</button></p>
        </form>
      </div>

      <!-- ソースコード表示ブロック -->
      <div class="note-section">
        <h3 class="note-title">ソースコード</h3>
        <pre><code>&lt;form action="" method="post" enctype="multipart/form-data"&gt;
    &lt;p&gt;名前：&lt;input type="text" name="namae"&gt;&lt;/p&gt;
    &lt;p&gt;パスワード：&lt;input type="password" name="pass"&gt;&lt;/p&gt;
    &lt;p&gt;好きな色：&lt;input type="color" name="color"&gt;&lt;/p&gt;
    &lt;p&gt;血液型：
        &lt;input type="radio" name="blood" value="1"&gt;B型
        &lt;input type="radio" name="blood" value="2"&gt;AB型
        &lt;input type="radio" name="blood" value="3"&gt;O型
        &lt;input type="radio" name="blood" value="4"&gt;その他
    &lt;/p&gt;
    &lt;p&gt;メールアドレス：&lt;input type="email" name="email" size="40"&gt;&lt;/p&gt;
    &lt;p&gt;
        居住都道府県：
        &lt;select name="Ken"&gt;
            &lt;option value="0"&gt;北海道&lt;/option&gt;
            &lt;optgroup label="東北"&gt;
                &lt;option value="1"&gt;青森&lt;/option&gt;
                &lt;option value="2"&gt;秋田&lt;/option&gt;
            &lt;/optgroup&gt;
        &lt;/select&gt;
    &lt;/p&gt;
    &lt;p&gt;
        &lt;textarea name="qus" cols="50" rows="8" placeholder="お問い合わせ内容"&gt;&lt;/textarea&gt;
    &lt;/p&gt;
    &lt;p&gt;写真：&lt;input type="file" name="file"&gt;&lt;/p&gt;
    &lt;p&gt;
        &lt;input type="submit" value="登録"&gt;
        &lt;input type="reset" value="内容消去"&gt;
        &lt;input type="button" value="script"&gt;
    &lt;/p&gt;
    &lt;p&gt;&lt;button type="button"&gt;click&lt;/button&gt;&lt;/p&gt;
&lt;/form&gt;</code></pre>
      </div>

      <!-- 戻るリンク -->
      <p style="margin-top: 25px;">
        <a href="0706_0914.php" class="td-link">➔ 授業一覧ページへ戻る</a>
      </p>
    </main>
  </div> <!-- .container -->

  <!-- 右下：トップボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
