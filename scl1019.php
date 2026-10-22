<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <title>10/19 職業訓練授業：PDOでのデータ取得と掲示板拡張準備 | ポートフォリオサイト</title>
  <!-- 共通CSS群の連携 -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="scl_style.css">
  <link rel="stylesheet" href="quiz.css">
</head>

<body>
  <!-- 共通ヘッダー -->
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">
      <h2>【10/19】PDOでのデータ取得（fetch）と掲示板の拡張準備</h2>

      <p style="margin-top: 15px; margin-bottom: 25px;">
        <a href="0915_1119.php" class="link-board">← データベース・PHP授業一覧ページへ戻る</a>
      </p>

      <!-- 1. 授業内容まとめセクション -->
      <section class="note-section">
        <h3 class="note-title">本日の講義内容とポイント</h3>
        <p>
          本日は、配布された教材（ひとこと掲示板 bbs / bbs2）の構造を深く紐解きながら、
          <strong>PDOを用いたプリペアドステートメントでのデータ取得（fetch処理）の罠</strong>や、
          今後の課題である「写真投稿機能の追加」に向けたセキュリティ・ファイル名管理について学習しました。
        </p>

        <div class="sub-heading">① プリペアドステートメントの開始とSQLの直接指定</div>
        <p>
          <code>stmt = pdo->prepare("SQL文")</code> のように、<code>prepare()</code> のカッコ内には直接SQL文を記述して構いません。
          INSERT文のようにユーザーの入力値を埋め込む場合は <code>:~</code> （プレースホルダー）によるバインドが必要ですが、
          今回は全件取得でユーザー入力値を使わないため不要となります。
        </p>

        <div class="sub-heading">② ⚠️ fetchColumn() を件数カウントに使う際の重大な罠</div>
        <p>
          <code>execute()</code> の直後に <code>->fetchColumn()</code> を実行すると、データが何件あるかを取得できます。
          しかし、これは<strong>「データ取り出し命令（fetch）」の一種</strong>であるため、件数を調べたと同時に<strong>1件目のデータを内部で取り出して消費</strong>してしまいます。
        </p>
        <p>
          そのため、件数確認をした直後にそのまま全件表示（whileループなど）を行うと、<strong>1件目のデータが画面に表示されなくなってしまう現象</strong>が発生します。
          もし件数を調べた上で全件表示を行いたい場合は、再度SELECT文を実行（再実行）する必要があります。
        </p>

        <div class="sub-heading">③ rowCount() をSELECT文のカウントに使ってはいけない理由</div>
        <p>
          件数カウントとして <code>->rowCount()</code> が紹介されているケースもありますが、これは本来
          INSERT（挿入）、UPDATE（更新）、DELETE（削除）によって<strong>影響を受けた行数をカウントするための命令</strong>です。
          サーバー環境の設定によって取得件数の取り方が異なる（削除されたデータを1件と数えるかどうか等）ため、<strong>SELECT文での使用は公式に非対応</strong>とされています。
        </p>

        <div class="sub-heading">④ 安全なファイル名管理と htmlspecialchars() の最適化</div>
        <p>
          <code>htmlspecialchars(..., ENT_QUOTES)</code> で変換される記号は、
          <code>"</code>（ダブル）、<code>'</code>（シングル）、<code>&gt;</code>（大なり）、<code>&lt;</code>（小なり）、<code>&amp;</code>（アンド）の<strong>5種類</strong>です。
        </p>
        <p>
          プログラム側が自動生成する文字だけで構成され、ユーザーの入力値が一切入り込まないデータにはこの関数を無理に使う必要はありません。
          この原則に基づき、次回実装する「写真投稿機能」では、ユーザーが付けた危険なファイル名をそのまま使わず、
          <strong>日時に基づいた安全なファイル名（例: <code>img20261019141205.jpg</code>）にプログラム側でリネームして保存する</strong>のが鉄則となります。
        </p>
      </section>

      <!-- 2. ソースコードブロックセクション -->
      <section class="note-section">
        <h3 class="note-title">データの正しい取得・カウント手順（コード例）</h3>
        <p>件数を取得してから全件を安全にループ処理で取り出す際、推奨される正しいコードの流れです。</p>
        <pre><code>&lt;?php
// 1. まずは件数カウント専用のSQLを実行
stmt = pdo-&gt;prepare("SELECT COUNT(*) FROM `post`");
\$stmt-&gt;execute();
count = stmt-&gt;fetchColumn(); // 取得件数を変数に代入
\$stmt = null; // プリペアドステートメントを一度終了

// 2. もし登録があれば、本来の全件取得SQLを実行
if (\$count &gt; 0) {
    stmt = pdo-&gt;prepare("SELECT * FROM `post` ORDER BY `created_at` DESC");
    \$stmt-&gt;execute();
    
    // 3. while文と PDO::FETCH_ASSOC を用いて連想配列で1行ずつループ処理
    while (row = stmt-&gt;fetch(PDO::FETCH_ASSOC)) {
        // ここで画面に出力処理（残り0行になると自動的にループ終了）
    }
}

// 4. PDO接続の切断（変数にnullを代入する）
\$stmt = null;
\$pdo = null;
?&gt;</code></pre>
      </section>

      <!-- 3. 明日の課題内容セクション -->
      <section class="note-section" style="border-left: 4px solid #ff8c00;">
        <h3 class="note-title">📝 次回の課題内容：ひとこと掲示板に写真投稿を追加</h3>
        <p>今回の知識を踏まえ、次回（10/20）は以下の条件を満たす写真投稿付き掲示板（<code>gazou</code>テーブル使用）を構築します。</p>
        <ul>
          <li>名前とコメントの入力・バリデーションは従来通り。</li>
          <li>ファイル送信ボタンを1つ追加し、<strong>画像の送信も必須</strong>とする。</li>
          <li>画像サイズは<strong>1,000,000バイト以内</strong>、形式は<strong>jpeg (image/jpeg)</strong>に制限する。</li>
          <li>画像のファイル名は <code>img20261019141205.jpg</code> のように <strong>img ＋ 年月日時分秒</strong> の <code>varchar(21)</code> とする。</li>
          <li>データベースの <code>img</code> カラムには画像のファイル名を保存する。</li>
          <li>出力時は <code>&lt;img src="images/&lt;?php ... ?&gt;" alt="投稿画像" width="100"&gt;</code> として小さく表示する。</li>
        </ul>
      </section>

      <!-- 4. 🧠 復習ミニクイズ（アコーディオン形式） -->
      <section class="quiz-container">
        <h3 class="note-title" style="border-left-color: #16a34a;">🧠 本日の復習ミニクイズ</h3>
        <p style="font-size: 14px; margin-bottom: 15px;">本日の講義内容から、間違いやすいポイントをクイズにしました。クリックで解答・解説が開きます。</p>

        <!-- Q1 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. execute()の直後に \$stmt->fetchColumn() を使って件数を数えた後、そのまま全件表示（fetch）をするとどうなりますか？</p>
          <details class="quiz-details">
            <summary>解答・解説を表示</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：1件目のデータが消失（画面に表示されなく）なる</p>
              <p><code>fetchColumn()</code> は内部的に最初の1行を「取り出して消費」してしまうため、その後のデータ表示処理の段階では2件目からしか残っていなくなってしまいます。</p>
            </div>
          </details>
        </div>

        <!-- Q2 -->
        <div class="quiz-box">
          <p class="quiz-question">Q2. SELECT文で取得したデータの件数を調べる際、 \$stmt->rowCount() を使うのはなぜ望ましくないとされているでしょうか？</p>
          <details class="quiz-details">
            <summary>解答・解説を表示</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：SELECT文では公式に非対応であり、サーバー環境によって動作が異なるため</p>
              <p><code>rowCount()</code> は本来、INSERT・UPDATE・DELETEによって影響を受けた（変更された）行数を返すための関数です。データを引っ張ってくるだけのSELECT文で使用すると、正しくカウントできない環境があるため非推奨です。</p>
            </div>
          </details>
        </div>

        <!-- Q3 -->
        <div class="quiz-box">
          <p class="quiz-question">Q3. ユーザーがアップロードした写真（画像）の元のファイル名をそのまま使わず、日時のファイル名にプログラム側で書き換えて保存するのはなぜですか？</p>
          <details class="quiz-details">
            <summary>解答・解説を表示</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：セキュリティ対策（XSS等の危険記号を完全に排除するため）</p>
              <p>ユーザーが自由に付けたファイル名には、<code>&lt;</code> や <code>"</code> などのプログラムを誤動作させる記号（エスケープが必要な文字）が含まれている危険性があります。システム側で「日時」の安全な文字列にリネームすることで、<code>htmlspecialchars()</code> すら不要な、安全で重複のないファイル管理が可能になります。</p>
            </div>
          </details>
        </div>
      </section>
      <p style="margin-top: 25px;">
        <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
      </p>
    </main>
  </div>

  <!-- ページトップへ戻るボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>

</html>