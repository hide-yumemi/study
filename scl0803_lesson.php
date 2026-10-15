<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <!-- 💡 ページに合わせて変更 -->
  <meta name="description" content="【ここにページの説明文を記述】">
  <title>【ここにページタイトル】 | ポートフォリオサイト</title>

  <!-- 共通のベースCSSを読み込み -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="scl_style.css">
</head>

<body>

  <!-- 共通ヘッダーの呼び出し -->
  <?php include 'header.php'; ?>

  <!-- メインレイアウト -->
  <div class="container">
    <main class="main-content">

      <h2>8/3 課題 動作チェック</h2>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">htmlでフォーム作成</p>

      <div class="note-section">
        <h3 class="note-title"></h3>
        <form action="" method="post" enctype="multipart/form-data">
          <p>名前:<input type="text" name="namae"></p>
          <p>パスワード：<input type="password" name="pass"></p>
          <p>好きな色：<input type="color" name="color"></p>
          <p>血液型:
            <input type="radio" name="blood" value="1">B型
            <input type="radio" name="blood" value="2">AB型
            <input type="radio" name="blood" value="3">O型
            <input type="radio" name="blood" value="4">その他
          </p>
          <p>メールアドレス：<input type="email" name="email" size="60">
          <p>
            居住都道府県：
            <select name="Ken">
              <option vallue="0">北海道</option>
              <optgroup label="東北">
                <option value="1" selected>青森</option>
                <option value="2" selected>秋田</option>
              </optgroup>
            </select>
          </p>
          <textarea name="qus" cols="50" rows="8" placeholder="お問い合わせ内容"></textarea>
          </p>
          <p>写真：<input type="file" name="file"></p>
          <p><input type="submit" value="登録">
            <input type="reset" value="内容消去">
            <input type="button" value="cript">
          </p>
          <p><button type="button">click></button></p>
          </p>
        </form>
      </div>
      <hr>
<pre><code>
  &lt;form action="" method="post" enctype="multipart/form-data"&gt;
          &lt;p&gt;名前:&lt;input type="text" name="namae"&gt;&lt;/p&gt;
          &lt;p&gt;パスワード：&lt;input type="password" name="pass"&gt;&lt;/p&gt;
          &lt;p&gt;好きな色：&lt;input type="color" name="color"&gt;&lt;/p&gt;
          &lt;p&gt;血液型:
            &lt;input type="radio" name="blood" value="1"&gt;B型
            &lt;input type="radio" name="blood" value="2"&gt;AB型
            &lt;input type="radio" name="blood" value="3"&gt;O型
            &lt;input type="radio" name="blood" value="4"&gt;その他
          &lt;/p&gt;
          &lt;p&gt;メールアドレス：&lt;input type="email" name="email" size="60"&gt;
          &lt;p&gt;
            居住都道府県：
            &lt;select name="Ken"&gt;
              &lt;option vallue="0"&gt;北海道&lt;/option&gt;
              &lt;optgroup label="東北"&gt;
                &lt;option value="1" selected&gt;青森&lt;/option&gt;
                &lt;option value="2" selected&gt;秋田&lt;/option&gt;
              &lt;/optgroup&gt;
            &lt;/select&gt;
          &lt;/p&gt;
          &lt;textarea name="qus" cols="50" rows="8" placeholder="お問い合わせ内容"&gt;&lt;/textarea&gt;
          &lt;/p&gt;
          &lt;p&gt;写真：&lt;input type="file" name="file"&gt;&lt;/p&gt;
          &lt;p&gt;&lt;input type="submit" value="登録"&gt;
            &lt;input type="reset" value="内容消去"&gt;
            &lt;input type="button" value="cript"&gt;
          &lt;/p&gt;
          &lt;p&gt;&lt;button type="button"&gt;click&gt;&lt;/button&gt;&lt;/p&gt;
          &lt;/p&gt;
        &lt;/form&gt;
</code></pre>

    </main>
  </div> <!-- .container -->

  <!-- 右下：トップボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>