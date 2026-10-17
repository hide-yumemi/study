<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="10/02(金)の職業訓練授業ノートです。$_FILESによるファイルアップロードの構造、一意のファイル名変換、move_uploaded_fileによる正式保存、file_existsによる重複チェック、unlinkによる削除をまとめています。">
  <title>10/02(金)職業訓練授業：$_FILESによるファイルアップロードとサーバー側ファイル操作 | ポートフォリオサイト</title>
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

      <h1>10/02(金)職業訓練授業</h1>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">$_FILESによるファイルアップロードとサーバー側でのファイル操作</p>

      <!-- 1. $_FILESの構造と各キーの詳細 -->
      <div class="note-section">

        <h3 class="note-title">1. $_FILESの構造と各キーの詳細</h3>
        <p>ユーザーからフォーム経由で送信されたファイル（画像やPDFなど）は、PHPのスーパーグローバル変数である二次元の連想配列 <strong>$_FILES</strong> に格納されます。</p>

        <div class="sub-heading"> 🔲 $_FILES['inputのname']['各キー'] の役割</div>
        <ul>
          <li><code>['name']</code> ： ユーザーのPCやスマホにおける<strong>「元のファイル名」</strong>です。</li>
          <li><code>['tmp_name']</code> ： アップロードされたファイルが、サーバー側で一時的に保管されている<strong>「テンポラリフォルダ内のパス」</strong>です。</li>
          <li><code>['size']</code> ： 送信されたファイルの<strong>「バイト単位のサイズ」</strong>です。容量制限の判定に使用します。</li>
          <li><code>['type']</code> ： ファイル形式を表す<strong>「MIMEタイプ（例: image/jpeg）」</strong>です。</li>
        </ul>

        <div class="sub-heading"> ⚠ 最重要：ファイル名重複の回避とデータベース連携</div>
        <p>多数のユーザーからファイルが送信されるため、元のファイル名（<code>['name']</code>）のまま保存すると、同名ファイルが上書きされる危険性があります。そのため、日時や乱数を組み合わせて「<code>202610021308image.jpg</code>」のように<strong>一意（ユニーク）なファイル名に変換して保存</strong>するのが鉄則です。 </p>
        <p>また、<strong>データベースには画像そのものを保存できない</strong>ため、サーバー内に保存した「ファイル名」や「パス」をテキストデータとして保管し、連携させます。</p>
      </div>

      <!-- 2. 正式保存とテンポラリフォルダの扱い -->
      <div class="note-section">
        <h3 class="note-title">2. 正式保存とテンポラリフォルダの扱い</h3>
        <p>一時保管されているテンポラリフォルダ内のファイルは、<code>&lt;form&gt;</code> の <code>action</code> で指定した先のファイルでのみアクセス可能という制限があります。そのため、サーバー内への正式な保存処理は、必ず受け取り側のPHPファイル内で実行する必要があります。</p>

        <div class="sub-heading"> 🎬 move_uploaded_file() 関数によるファイル移動</div>
        <p>テンポラリフォルダから、目的の保存先フォルダへファイルを移動・正式保存する専用関数です。実行しているPHPファイルからの相対パスで保存先を指定します。</p>
        <p><code>move_uploaded_file($_FILES['🎨']['tmp_name'], '保存先のファイルパス');</code></p>
        <ul>
          <li><strong>戻り値による条件分岐：</strong> 処理結果を成功（ <code>true</code> ）または失敗（ <code>false</code> ）で返すため、 <code>if(move_uploaded_file(...))</code> のように条件分岐させてフォルダが存在しない等のエラーハンドリングが可能です。</li>
          <li><strong>上書きの注意点：</strong> 指定した保存先に同名ファイルが既に存在している場合は、警告なしで自動的に<strong>「上書き保存」</strong>となり旧ファイルが消滅します。</li>
        </ul>
      </div>
      <!-- 3. 既存ファイルの重複チェックとファイル名変更 -->
      <div class="note-section">
        <h3 class="note-title">3. 既存ファイルの重複チェックとファイル名変更</h3>
        <p>同名ファイルによる意図しない上書きを防ぐため、事前にファイルがターゲットのフォルダ内に存在するかどうかを確認します。</p>
        <p><code>file_exists('対象ファイルへの相対パス')</code></p>
        <p>指定したファイルがすでに存在していれば <code>true</code> 、存在していなければ <code>false</code> を返します。</p>

        <div class="sub-heading"> 💡 同名の時に保存を中止させる安全な実装例</div>
        <pre><code>if (file_exists("images/" . $filename)) {
    exit('同名のファイルが存在します。時間を置いて再度送信してください。');
}</code></pre>

        <div class="sub-heading"> 💡 while文を使用した自動リネーム（別名切り替え）のループ例</div>
        <pre><code>while (1) {
    // 新しいファイル名を作成する処理
    if (!file_exists("images/" . $new_filename)) {
        break; // 同名ファイルがなければループを抜けて確定
    }
}</code></pre>
      </div>

      <!-- 4. サーバー内ファイルの削除 -->
      <div class="note-section">
        <h3 class="note-title">4. サーバー内ファイルの削除</h3>
        <p>ユーザーが新しい画像に差し替えた際や、不要になった古いファイルをサーバー内から完全に削除して容量を空けたい場合は、以下の関数を使用します。</p>
        <p><code>unlink('削除したいファイルへの相対パス');</code></p>
        <p>この命令を実行するだけで、指定されたファイルの削除が即座に実行されます。一度削除したファイルはプログラムからは復元できないため、パスの指定ミス（必要なファイルを消してしまうバグ）には細心の注意が必要です。</p>
      </div>

      <!-- 🧠 復習ミニクイズ（全5問） -->
      <div class="quiz-container">
        <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
        <p style="margin-bottom: 25px;">今日学習したファイルアップロードとサーバー操作の重要ポイントを確認しましょう。クリックすると正解と解説が表示されます。</p>

        <!-- クイズ1 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. アップロードされたファイルが、サーバー側で一時的に保管されている場所のパスを取得する$_FILESのキーは何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 ['tmp_name']</p>
              <p style="margin-bottom: 0;">解説： ユーザーから送信されたファイルは、まずサーバーの一時保管場所（テンポラリフォルダ）に保存され、そのパスが $_FILES['inputのname']['tmp_name'] に自動格納されます。</p>
            </div>
          </details>
        </div>

        <!-- クイズ2 -->
        <div class="quiz-box">
          <p class="quiz-question">Q2. 一時保存されているファイルを、目的のディレクトリへ正式に移動・保存するために使用する専用の関数は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 move_uploaded_file()</p>
              <p style="margin-bottom: 0;">解説： テンポラリフォルダから正式な保存先へ安全にファイルを移動させる関数です。処理が成功すると true 、失敗すると false の戻り値を返します。</p>
            </div>
          </details>
        </div>

        <!-- クイズ3 -->
        <div class="quiz-box">
          <p class="quiz-question">Q3. ファイルを保存する際、同名のファイルがすでに指定したフォルダに存在しているかどうかを調べる関数は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 file_exists()</p>
              <p style="margin-bottom: 0;">解説： 引数に指定したパスにファイルやディレクトリが実在していれば true 、存在しなければ false を返します。これを使って意図しない上書きを防止します。</p>
            </div>
          </details>
        </div>

        <!-- クイズ4 -->
        <div class="quiz-box">
          <p class="quiz-question">Q4. サーバー内に蓄積された、不要になったファイルを完全に消去するために使用するPHPの関数は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 unlink()</p>
              <p style="margin-bottom: 0;">解説： 引数に削除したいファイルへの正しい相対パスなどを渡すことで、サーバー内の該当ファイルを直接削除することができます。</p>
            </div>
          </details>
        </div>

        <!-- クイズ5 -->
        <div class="quiz-box">
          <p class="quiz-question">Q5. ファイルのMIMEタイプを取得する$_FILESのキーと、利用時に気をつけるべき注意点は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 キーは ['type']。注意点はアプリケーションや拡張子のバージョン違いで共通ではなくなる点。</p>
              <p style="margin-bottom: 0;">解説： Excelの .xls と .xlsx でMIMEタイプが変わるように、バージョンやシステム環境で値が変化することがあるため、厳格なファイル形式の受け入れ判定の際は注意が必要です。</p>
            </div>
          </details>
        </div>
      </div> <!-- .quiz-container 終了 -->

    </main>
  </div> <!-- .container -->

  <!-- 右下：トップボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>