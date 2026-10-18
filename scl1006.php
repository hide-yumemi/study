<!DOCTYPE html>
<html lang="ja">

<head>
  <title>10/06(火)職業訓練授業：入力フォームとファイル受信処理 | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
</head>

<body>

  <!-- 共通ヘッダーパーツの読み込み -->
  <?php include 'header.php'; ?>

  <!-- メインレイアウトコンテナ -->
  <div class="container">
    <main class="main-content">

      <h1>10/06(火)職業訓練授業</h1>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">フォームから送信された複数データの複合バリデーションと条件判定フラグの制御技術</p>

      <!-- 1. 問題内容 -->
      <div class="note-section">
        <h3 class="note-title">📋 課題：フォーム画面の実装要件</h3>
        <p><strong>【問題】</strong> ホワイトボードに提示された以下のレイアウト（UI仕様）を満たす入力フォーム、および送信されたデータを安全に受信・処理するプログラムを作成しなさい。</p>

        <!-- 授業のホワイトボード写真を綺麗に配置するコンテナ -->
        <div class="board-figure">
          <img src="./images/20261006_kadai.jpg" alt="10/06 課題内容ホワイトボード" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
          <div class="board-figcaption">ホワイトボードに描かれたUI設計・仕様</div>
        </div>
      </div>

      <!-- 2. 注意点・解説 -->
      <div class="note-section">
        <h3 class="note-title">⚠️ 実装における重要注意点</h3>

        <div class="sub-heading">1. フォームのファイル送信設定（enctype）</div>
        <p>提出ファイル（<code>type="file"</code>）をサーバーへ正しく転送するためには、HTML側の<code>&lt;form&gt;</code>タグに必ず<strong><code>enctype="multipart/form-data"</code></strong>を記述する必要があります。これを忘れると、PHP側でファイルを受け取る<code>$_FILES</code>が空になってしまいます。</p>

        <div class="sub-heading">2. フラグ反転（$flag = !$flag;）の罠</div>
        <p>今回の課題では「ファイルサイズ超過」と「ファイル形式（拡張子）違い」の<strong>2つのエラーチェックを同時に並列で判定</strong>しています。</p>
        <p>過去のカリキュラムで行ったような、状態をひっくり返す論理否定（<code>$flag = !$flag;</code>）による反転処理を使ってしまうと、<strong>「サイズも形式も両方エラーだった場合」にtrueがfalseへ反転して戻ってしまい、エラーを見落とすバグ</strong>に繋がります。</p>
        <p>そのため、本実装ではエラーを検知した時点で直接<strong><code>$flag = true;</code></strong>を代入して固定する手法を取っています。</p>

        <div class="sub-heading">3. 先生の別解テクニック：カウントアップ方式</div>
        <p>ホワイトボードで紹介されたスマートな別解として、初期値を<code>$flag = 0;</code>とし、エラーが起きるたびに<code>$flag++;</code>とカウントアップする方法があります。これにより以下のメリットが得られます：</p>
        <ul>
          <li>PHPの特性上、<code>0</code>は<code>false</code>、<code>0以外</code>は<code>true</code>として条件式で扱えるため、最後の判定コードがスマートになります。</li>
          <li>「何個のエラーが蓄積しているか」を数値として保持できるため、詳細なエラー文を出したい時に応用が効きます。</li>
        </ul>
      </div>

      <!-- 4. 復習ミニクイズ（全3問） -->
      <div class="quiz-container">
        <h3 class="note-title" style="border-left-color: #1e3a8a;">本日の復習ミニクイズ（全3問）</h3>
        <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

        <!-- クイズ1 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. 複数のエラー判定を連続して行う際、<code>$flag = !$flag;</code> による反転処理を採用すると発生する「致命的な問題（バグ）」は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 エラーが「偶数個」重なったときに、エラーなし（false）の状態に戻ってしまうバグ</p>
              <p style="margin-bottom: 0;">解説： 1つ目のエラーで <code>false → true</code> に変化しますが、2つ目のエラーで再度反転して <code>true → false</code> に戻ってしまいます。これによって、エラーを検知できない致命的なバグが生まれるため、上書き代入（<code>$flag = true;</code>）を行う必要があります。</p>
            </div>
          </details>
        </div>

        <!-- クイズ2 -->
        <div class="quiz-box">
          <p class="quiz-question">Q2. エラー判定を「数値のカウントアップ方式（<code>$flag++</code>）」にした場合、最後のif文で <code>if($flag)</code> と記述するだけで正しく条件分岐ができる理由は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 PHPでは「0」がfalse、それ以外の数値はすべてtrueとして自動判定されるため</p>
              <p style="margin-bottom: 0;">解説： 初期値を <code>0</code> としておき、エラーの数だけ <code>1, 2...</code> と増やすことで、最後の判定を <code>if($flag)</code> とするだけで「エラーが1個以上蓄積している（true）」という意味に評価させることができます。</p>
            </div>
          </details>
        </div>

        <!-- クイズ3 -->
        <div class="quiz-box">
          <p class="quiz-question">Q3. 今回の課題のように、ファイル（画像データ）をフォーム経由で安全にサーバーへ送信するために、<code>&lt;form&gt;</code> タグに指定し忘れてはならない属性は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 enctype="multipart/form-data"</p>
              <p style="margin-bottom: 0;">解説： ファイルのバイナリデータを正常に転送するための必須属性です。この記述がないと、サーバー側はファイルの中身を受け取ることができず、処理がすべて失敗してしまいます。</p>
            </div>
          </details>
        </div>
      </div> <!-- .quiz-container 終了 -->

    </main>
  </div> <!-- .container 終了 -->

  <!-- 共通右下トップボタン -->
  <a href="#" class="top-button">▲ TOP</a>

</body>

</html>
<!-- http://localhost/study/scl1006.php -->