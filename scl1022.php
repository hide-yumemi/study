<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="10/22(木)の職業訓練授業ノートです。会員管理システムのフォルダ構造（MySQLi / PDO / ハッシュ暗号化）の差異、DB操作と厳格なバリデーション技術、不正アクセス防御策について解説しています。">
  <title>10/22(木)職業訓練授業：会員管理システムの構築と強固なセキュリティ・バリデーション技術 | ポートフォリオサイト</title>
  <!-- 共通ベースCSSの連携 -->
  <link rel="stylesheet" href="style.css">
  <!-- ノート専用CSSの連携 -->
  <link rel="stylesheet" href="scl_style.css">
  <!-- クイズ専用CSSの連携 -->
  <link rel="stylesheet" href="quiz.css">
  <style>
    /* 🛠️ 10/22ページ専用：会員構造テーブルの最適化スタイル */
    .kaiin-table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 14.5px;
      background-color: #ffffff;
      border: 2px solid #1e3a8a;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .kaiin-table th,
    .kaiin-table td {
      padding: 12px 15px;
      text-align: left;
      border: 1px solid #cbd5e1;
      vertical-align: middle;
      line-height: 1.5;
    }

    .kaiin-table th {
      background-color: #f1f5f9;
      color: #1e3a8a;
      font-weight: bold;
      border-bottom: 2px solid #1e3a8a;
    }

    /* 各列の幅を黄金比で固定し、はみ出しを防止 */
    .kaiin-table th:nth-child(1),
    .kaiin-table td:nth-child(1) {
      width: 15%;
      font-weight: bold;
      color: #1e3a8a;
    }

    /* カラム名 */
    .kaiin-table th:nth-child(2),
    .kaiin-table td:nth-child(2) {
      width: 20%;
      font-family: monospace;
    }

    /* データ型 */
    .kaiin-table th:nth-child(3),
    .kaiin-table td:nth-child(3) {
      width: 30%;
      color: #475569;
    }

    /* 属性・制約 */
    .kaiin-table th:nth-child(4),
    .kaiin-table td:nth-child(4) {
      width: 35%;
      color: #334155;
    }

    /* 説明 */

    /* レスポンシブ対応：画面が狭いときは横スクロールできるように包む */
    .table-responsive {
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      margin-bottom: 20px;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <!-- 共通ヘッダー -->
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">
      <h1>10/22(木)職業訓練授業</h1>
      <p style="color:#666; font-size: 14px; margin-bottom: 35px;">会員管理システム（ログイン・登録・変更・退会・CSV出力）の構造、phpMyAdminでのテーブル構築、不正アクセス対策と重複ユーザー名チェック</p>

      <!-- 1. 会員管理システムの全体設計とフォルダ構造 -->
      <section class="note-section">
        <h3 class="note-title">1. 会員管理システムの全体設計とフォルダ構造</h3>
        <p>
          本日の授業では、実務のWebアプリケーションの基本となる「会員管理システム（<code>kaiin_system</code>）」の構築手順を学習しました。
          教材はプログラムの手法やセキュリティの進化度合いに応じて、以下の<b>3つのフォルダ</b>に段階的に分けられています。
        </p>
        <ul>
          <li><strong>① kaiin フォルダ：</strong> 従来の <code>mysqli</code>（手続き型）の命令を用いて作成された基礎コード。</li>
          <li><strong>② kaiinpdo フォルダ：</strong> IPAも推奨する、より安全な <code>PDO</code>（オブジェクト指向）を用いてリファクタリングされたコード。</li>
          <li><strong>③ kaiin_hash フォルダ：</strong> PDO接続に加え、万が一の漏洩に備えて<b>パスワードをハッシュ化（暗号化）</b>して保存する最も強固な実務仕様コード。</li>
        </ul>

        <div class="sub-heading">📊 実装した主要機能と対応ファイル</div>
        <p>3つのフォルダ内は、それぞれ以下の役割を持つHTMLフロントエンドとPHPバックエンドで構成され、同じデータベースを共有して動作します。</p>
        <ul>
          <li><strong>会員登録（新規入会）：</strong> <code>kaiinntouroku.html</code> ／ <code>touroku.php</code>（ユーザー名・パスワード・TELの登録）</li>
          <li><strong>ログイン処理：</strong> <code>login.html</code> ／ <code>log.php</code>（認証とマイページへの遷移）</li>
          <li><strong>登録情報の変更：</strong> <code>henko.html</code> ／ <code>henko.php</code>（電話番号の変更処理）</li>
          <li><strong>退会（アカウント削除）：</strong> <code>sakuzyo.html</code> ／ <code>sakuzyo.php</code>（論理削除または物理削除処理）</li>
          <li><strong>CSV出力（データ抽出）：</strong> <code>download.html</code> ／ <code>download.php</code>（会員情報をCSVファイルとして一括DL）</li>
        </ul>
      </section>

      <!-- 2. phpMyAdminを用いたデータベースの構築仕様 -->
      <section class="note-section">
        <h3 class="note-title">2. phpMyAdminを用いたデータベースの構築仕様</h3>
        <p>
          会員データを厳格に管理するため、phpMyAdminから新しく <code>kaiin</code> データベースを立ち上げ、同名の <code>kaiin</code> テーブルを以下の構造で設計しました。
        </p>

        <div class="sub-heading">📐 kaiinテーブルのカラム構造（スキーマ）</div>

        <!-- 💻 横スクロールと専用クラスを適用して見やすさを劇的に改善 -->
        <div class="table-responsive">
          <table class="kaiin-table">
            <thead>
              <tr>
                <th>カラム名</th>
                <th>データ型</th>
                <th>属性・制約</th>
                <th>説明</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>id</td>
                <td>INT</td>
                <td>PRIMARY KEY<br>AUTO_INCREMENT</td>
                <td>会員を識別する固有の一意の識別番号。自動連番。</td>
              </tr>
              <tr>
                <td>name</td>
                <td>VARCHAR(20)</td>
                <td>UNIQUE KEY</td>
                <td>ユーザーネーム。<b>重複登録を絶対に許さない一意の制約</b>。</td>
              </tr>
              <tr>
                <td>pass</td>
                <td>VARCHAR(12)</td>
                <td>(可変文字列)</td>
                <td>パスワード。※ハッシュ化の際はデータ長が伸びるため長さの拡張が必要。</td>
              </tr>
              <tr>
                <td>tel</td>
                <td>VARCHAR(11)</td>
                <td>(可変文字列)</td>
                <td>電話番号。先頭の「0」を保持するため、INT型ではなく必ず文字列型。</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p>SQLプレビュー（プレビュー画面）でエラーがないことを注意深く確認し、厳格なインデックス制約とともにテーブルを作成しました。</p>
      </section>

      <!-- 3. プログラムへの不正アクセス（直接アクセス）対策 -->
      <section class="note-section">
        <h3 class="note-title">3. プログラムへの不正アクセス（直接アクセス）対策</h3>
        <p>
          入力フォームを介さず、バックエンド処理プログラム（例：<code>touroku.php</code>）へ直接アクセスしてくる通信を安全に遮断する防御技術を学びました。
        </p>

        <div class="sub-heading">3-1. 悪意のない誤アクセス（履歴や戻るボタン）への対策</div>
        <p>
          HTMLフォームを介さずURLを直接叩いたり、ブラウザの「戻る」でプログラムに再進入すると、通信は<b>GET送信</b>になります。
          本来データ登録はPOST送信で行うため、プログラムの先頭で <code>$_SERVER['REQUEST_METHOD'] !== 'POST'</code> などを検知して処理を弾くことができます。
        </p>

        <div class="sub-heading">3-2. 悪意をもった攻撃アクセス（不正な値のインジェクション）への対策</div>
        <p>
          攻撃者が偽 of POSTデータを自作して送信してきたり、プログラムの隙を突いてSQLを改ざんしようとするケースへの対策は、以下の2重のフィルターで確実に防ぎます。
        </p>
        <ol>
          <li><strong>name属性の存在チェック：</strong> 指定したinputのname属性が正しく送られてきているかを <code>isset()</code> または <code>empty()</code> ではじく。</li>
          <li><strong>値の正当性チェック：</strong> 後述する「正規表現」による形式チェックと、プレースホルダを用いた「プリペアドステートメント（静的バインド）」の組み合わせで、不正なSQL命令の注入を完全に無効化する。</li>
        </ol>
      </section>

      <!-- 4. 実務に即した厳格な正規表現バリデーションとユニークチェック -->
      <section class="note-section">
        <h3 class="note-title">4. 実務に即した厳格な正規表現バリデーションとユニークチェック</h3>
        <p>セキュリティをクリアした値のみをデータベースへ安全に通すため、厳格な形式チェックと事前照会クエリを実行します。</p>

        <div class="sub-heading">4-1. ユーザーネームの形式・長さチェック</div>
        <p>「半角英数字のみ」「2〜20文字の範囲内」に収まっているかを検証します。</p>
        <pre><code>\$namematch = "/^[a-zA-Z0-9]{2,20}$/";</code></pre>

        <div class="sub-heading">4-2. 重複登録を防ぐ事前SELECT照会（ユニーク確認）</div>
        <p>
          ユーザー名（<code>name</code>）はデータベース側でUNIQUE制約をかけていますが、SQL実行時にエラーを発生させるのは不格好です。
          事前に同じ名前がいないかをSELECT文で問い合わせるのが親切な実装設計です。
        </p>
        <pre><code>SELECT id FROM kaiin WHERE name = :name</code></pre>
        <ul>
          <li><strong>取得件数 0件の場合：</strong> まだ使われていない名前のため、安全に <code>INSERT</code>（登録処理）へ進める。</li>
          <li><strong>取得件数 1件の場合：</strong> すでに存在する名前のため、処理を中断して「そのユーザー名は既に使用されています」と画面に警告を戻す。</li>
        </ul>

        <div class="sub-heading">4-3. 電話番号の0落ち・00始まり防止チェック</div>
        <p>日本の一般的な電話番号（10桁または11桁）を正しく検査するための、高度な正規表現の記述方法です。</p>
        <pre><code>\$telmatch = "/^0[1-9][0-9]{8,9}$/";</code></pre>
        <ul>
          <li><code>^0</code> ：必ず先頭の1文字目は「0」から始まる。</li>
          <li><code>[1-9]</code> ：2文字目に「0」が来ることを禁止（市外局番や携帯の2文字目に0は来ないため、<code>000-...</code> などの架空の不正入力を自動遮断）。</li>
          <li><code>[0-9]{8,9}$</code> ：3文字目以降は半角数字が8〜9文字続き、そこでぴったり終了する（全体で10桁または11桁になる設計）。</li>
        </ul>
      </section>

      <!-- 5. 復習ミニクイズ（アコーディオン形式） -->
      <section class="quiz-container">
        <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ（全5問）</h3>
        <p style="font-size: 14px; margin-bottom: 15px;">本日学習した会員システムの設計やセキュリティ対策について、クイズで重要ポイントをおさらいしましょう。</p>

        <!-- Q1 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. 会員管理システムのパスワードを保存する際、「kaiin_hash」フォルダで導入された、セキュリティを最大に高めるための暗号化技術を何と呼びますか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：ハッシュ化（暗号化）</p>
              <p>万が一データベース内の情報が外部に漏洩してしまった場合でも、元のパスワードを第三者に解読されないよう、不可逆な固定長の文字列に変換（ハッシュ化）して保存する手法です。実務のWebサイトでは必須のセキュリティ要件です。</p>
            </div>
          </details>
        </div>

        <!-- Q2 -->
        <div class="quiz-box">
          <p class="quiz-question">Q2. 会員テーブル（kaiin）を設計する際、電話番号（tel）のカラムのデータ型に「INT（整数型）」ではなく「VARCHAR（文字列型）」を採用すべきなのはなぜですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：INT型（数値）にすると、先頭の「0」が自動的に消去（0落ち）されてしまうため</p>
              <p>以前の講義でも学んだ通り、数値を扱う整数型に <code>090...</code> を代入すると、数学的な処理により先頭の 0 が消えて <code>90...</code> に強制変換されてしまいます。日本の電話番号としての正しい文字長を維持するため、必ず文字列型（<code>VARCHAR</code>）で保存します。</p>
            </div>
          </details>
        </div>

        <!-- Q3 -->
        <div class="quiz-box">
          <p class="quiz-question">Q3. ユーザーがフォームを介さず「touroku.php」などの登録処理ファイルに誤って直接アクセス（URL直打ち等）してきた場合、プログラム側ではどのような通信性質を利用して弾くことができますか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：直接アクセスした場合は「GET送信」になるという性質</p>
              <p>正規の入力フォーム（HTML）はデータを送信する際に <code>method="post"</code> と指定しているため、正常な通信は必ずPOSTになります。一方、直接URLを入力したり履歴から入った場合は「GET」になるため、スーパーグローバル変数などを利用して通信方式（メソッド）をチェックすれば、安全にアクセスを拒否できます。</p>

            </div>
          </details>
        </div>

        <!-- Q4 -->
        <div class="quiz-box">
          <p class="quiz-question">Q4. 会員登録処理において、データベースのユーザー名（name）にUNIQUE（ユニーク）制約をかけている場合でも、事前にSELECT文で重複確認を行うのはなぜですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：データベース側のシステムエラーを発生させず、PHP側で安全に制御してユーザーに優しい警告画面を返すため</p>
              <p>重複確認をせずに直接 <code>INSERT</code> すると、DB側が「ユニーク制約違反」としてシステムエラーを吐き、最悪の場合プログラムが強制終了してしまいます。事前にSELECTで件数を調べ、「その名前は既に使われています」とPHP側で画面をコントロールするのがスマートなエラーハンドリングです。</p>
            </div>
          </details>
        </div>

        <!-- Q5 -->
        <div class="quiz-box">
          <p class="quiz-question">Q5. 電話番号の正規表現パターン「/^0[1-9][0-9]{8,9}$/」において、2文字目を「[0-9]」ではなくあえて「[1-9]」と指定している目的は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：先頭が「00」から始まるような、あり得ない不正な電話番号の入力を未然に防ぐため</p>
              <p>日本の市外局番や携帯電話の番号は、<code>03-...</code> や <code>090-...</code> のように、0の次は必ず1〜9の数字が来ます。2文字目に <code>0</code> が来る番号（<code>000-...</code> など）は存在しないため、ここを <code>[1-9]</code> と厳格に縛ることで、機械的なスパムやいたずら入力を強力に遮断できます。</p>
            </div>
          </details>
        </div>
      </section>

      <p style="margin-top: 25px;">
        <a href="0915_1119.php" class="link-board">➔ データベース・PHP授業一覧ページへ戻る</a>
      </p>
    </main>
  </div>
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>

</html>