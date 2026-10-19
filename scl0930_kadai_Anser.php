<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="10/2(金)の職業訓練授業ノートです。9/30に実施したWebフォーム課題の振り返りと、講師による模範解答です。">
    <title>10/2(金)職業訓練授業：フォーム課題の総括と模範解答リファレンス | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">
    <!-- クイズ専用CSSを読み込み -->
    <link rel="stylesheet" href="quiz.css">
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">

            <h1>10/2(金)職業訓練授業</h1>
      <!-- ==========================================
                 ルール③：入力フォームの下に実際のソースコードを表示
                 ========================================== -->
      <div class="code-headline"> 【送信側】 formsend_renshuu.php のソースコード</div>
      <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="ja"&gt;
  &lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;フォーム送信&lt;/title&gt;
  &lt;/head&gt;
  &lt;body&gt;
    &lt;h1&gt;入力フォーム&lt;/h1&gt; &lt;!-- ⚠️「動作確認」ではaction先のURLを元のURL先にしてます--&gt;
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

      <div class="code-headline"> 【受信側】 formget_renshuu.php のソースコード</div>
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

        </main>
    </div> <!-- .container 終了 -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
<!-- http://localhost/study/scl1002_kadai_Anser.php -->