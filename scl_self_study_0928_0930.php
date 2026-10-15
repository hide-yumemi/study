<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="自主学習用PHP研究ノートです。スーパーグローバル変数(GET/POST)の違い、$_FILESによるファイルアップロード制御、XSS脆弱性を防ぐサニタイズ技術を徹底解説しています。">
  <title>【PHP自主学習】フォーム送受信の仕組みとセキュリティ対策（サニタイズ・ファイル読込） | ポートフォリオサイト</title>
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

  <!-- メインレイアウト（広々とコードに集中できる1カラム仕様） -->
  <div class="container">
    <main class="index-main-content" style="display: block; max-width: 1000px; margin: 0 auto;">

      <h1>【PHP自主学習】フォーム送受信の仕組みとセキュリティ対策</h1>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">受講内容の深掘り研究：スーパーグローバル変数の制御・ファイルアップロード・サニタイズ技術</p>

      <!-- 1. スーパーグローバル変数とHTMLフォームのメソッド属性 -->
      <div class="note-section">
        <h3 class="note-title">1. スーパーグローバル変数とHTMLフォームのメソッド属性</h3>
        <p>PHPでは、HTMLの <code>&lt;form&gt;</code> タグの <code>method</code> 属性（送信方法）に応じて、自動的にデータを取得するための特別な変数が用意されています。これを<strong>スーパーグローバル変数</strong>と呼びます。</p>

        <div class="sub-heading"> 1-1. GET送信（URLパラメータ形式）</div>
        <p>URLの後ろに <code>?名前=値&amp;名前=値</code> という形式（クエリストリング / URLパラメータ）で、HTMLの <code>name</code> 属性と入力値が追加されて送信されます。</p>
        <ul>
          <li><strong>特徴：</strong> 送信データがURLとしてアドレスバーに丸見えになります。</li>
          <li><strong>⚠ 注意点：</strong> パスワードやクレジットカード番号などの個人情報に関わるものは<strong>絶対にGET送信してはいけません</strong>。</li>
          <li><strong>制限：</strong> 送信できる文字数に上限があるため、検索窓のキーワードなど、あまり多くの項目にならないシンプルな処理に使用します。</li>
        </ul>

        <div class="sub-heading"> 1-2. POST送信（リクエストボディ形式）</div>
        <p>データはURLではなく、通信の内部データ（HTTPリクエストボディ）に含まれて送信されます。</p>
        <ul>
          <li><strong>特徴：</strong> 画面上（URL）にはデータが見えません。さらに <code>https://〜</code> で通信を暗号化（SSL/TLS化）することで、経路上の盗聴を確実に防ぐことができます。</li>
          <li><strong>メリット：</strong> 送信できる文字数に実質制限はなく、画像やPDFなどのファイル送信（アップロード）も可能です。</li>
        </ul>
      </div>

      <!-- 2. PHPでのデータ受け取りと連想配列 -->
      <div class="note-section">
        <h3 class="note-title">2. PHPでのデータ受け取りと連想配列</h3>
        <p>HTMLフォームから送信されたデータは、PHP側でそれぞれの送信メソッドに対応した連想配列の中に自動的に格納され、 <code>name</code> 属性値がキー（Key）になります。</p>
        <ul>
          <li><code>$_GET['name属性値']</code> ： <code>method="get"</code> で送られたデータが格納されます。</li>
          <li><code>$_POST['name属性値']</code> ： <code>method="post"</code> で送られたデータが格納されます。</li>
        </ul>

        <div class="sub-heading"> 💡 重要：チェックボックスなどの複数データの受け取り（二次元配列）</div>
        <p>同じ <code>name</code> 属性のデータをまとめて受け取りたい場合、HTML側の <code>name</code> 属性の末尾に必ず <strong>[] （角括弧）</strong> を付与します。</p>
        <p>※ <code>[]</code> を付けずに全く同じ <code>name</code> 属性名を設定してしまうと、後から処理された値によって前の値が上書きされ、最後に選択された1件しか受け取れなくなります。</p>
        <pre><code>// 📋 チェックボックス受け取り時の連想配列の視覚イメージ
$_POST['hobby'][0] ➔ 'music'
$_POST['hobby'][1] ➔ 'sports'</code></pre>
      </div>

      <!-- 3. ファイル送信がある時の受け取り（$_FILES） -->
      <div class="note-section">
        <h3 class="note-title">3. ファイル送信がある時の受け取り（$_FILES）</h3>
        <p>画像やPDFなどのファイルをフォームから送信する場合、HTMLの <code>&lt;form&gt;</code> タグに必ず <code>method="post"</code> と <code>enctype="multipart/form-data"</code> の2つを指定する必要があります。これが無いとファイルデータがサーバーに送信されません。</p>
        <p>アップロードされたファイル情報は、スーパーグローバル変数である二次元配列 <code>$_FILES['name属性値']</code> から取得できます。</p>
        <ul>
          <li><code>$_FILES['inputのname']['tmp_name']</code> ： 一時保存されたファイルへアクセスするためのサーバー上の臨時パス</li>
          <li><code>$_FILES['inputのname']['name']</code> ： ユーザーのPC上での元のファイル名</li>
          <li><code>$_FILES['inputのname']['size']</code> ： ファイルサイズ（<strong>バイト単位</strong>）</li>
          <li><code>$_FILES['inputのname']['type']</code> ： ファイルのMIMEタイプ（例： <code>image/jpeg</code> など）</li>
          <li><code>$_FILES['inputのname']['error']</code> ： アップロードに関するエラーコード（整数）</li>
        </ul>

        <div class="sub-heading"> 🗲 エラーコードの意味一覧</div>
        <ul>
          <li><strong>コード 0 (UPLOAD_ERR_OK)：</strong> 正常終了（アップロード成功）</li>
          <li><strong>コード 1 / 2：</strong> サイズオーバー（1はphp.iniの設定、2はHTML側で指定した最大サイズ超過）</li>
          <li><strong>コード 3 / 4：</strong> 通信障害等による不完全受信（3は一部のみ受信、4はファイルが未選択・送信なし）</li>
          <li><strong>コード 6 / 7 / 8：</strong> サーバー側のトラブル（6は一時フォルダなし、7はディスク書き込み失敗、8は拡張機能による停止）</li>
        </ul>
      </div>
      <!-- 4. データの存在チェックと文字列長の確認 -->
      <div class="note-section">
        <h3 class="note-title">4. データの存在チェックと文字列長の確認</h3>
        <p>ユーザーから送信されたデータを処理する前に、安全のために「データが本当に存在するか」「空文字（文字数が0）ではないか」を必ずチェックします。</p>
        <pre><code>// 📋 存在と文字長を同時に調べる基本構文
if (isset($_GET['name']) &amp;&amp; strlen($_GET['name']) &gt; 0):
    // データが存在し、かつ1文字以上入力されている場合の処理
endif;</code></pre>
        <ul>
          <li><code>isset()</code> ： 指定したキー（データ）が存在しているかどうかを判定します。</li>
          <li><code>strlen() &gt; 0</code> ： 格納された文字列の長さが0文字より大きい（空文字ではない）かを判定します。</li>
        </ul>

        <div class="sub-heading"> ⚠ JavaScriptとの決定的な違い（ショートサーキットの重要性）</div>
        <p>JavaScriptでは、存在しない配列のキーにアクセスしても <code>undefined</code> が返るだけでエラーにはなりませんが、PHPでは存在しないキーに対して直接 <code>strlen()</code> を実行すると、未定義エラー（Warning等）が発生してシステムが汚れてしまいます。</p>
        <p>そのため、PHPでは必ず<strong>「 <code>&amp;&amp;</code> の左側でまず <code>isset()</code> 判定を行い、存在しなければ右側の測定処理をスキップさせる（ショートサーキット）」</strong> という記述順序が絶対の鉄則となります。</p>
      </div>

      <!-- 5. セキュリティ対策：サニタイズ（htmlspecialchars） -->
      <div class="note-section">
        <h3 class="note-title">5. セキュリティ対策：サニタイズ（htmlspecialchars）</h3>
        <p>悪意を持ったユーザーが、入力フォームにJavaScriptなどの悪質なプログラムを入力して送信し、サイトを破壊する攻撃を<strong>クロスサイトスクリプティング（XSS）</strong>と呼びます。</p>
        <p>これを完全に防ぐために、特殊な意味を持つ記号（ <code>"</code> <code>'</code> <code>&lt;</code> <code>&gt;</code> <code>&amp;</code> ）を、ブラウザ上でのただの「安全な文字列」へと変換（エスケープ）する対策をサニタイズ（無害化）と呼び、画面に出力する直前に必ず実行します。</p>

        <div class="sub-heading"> 🔲 htmlspecialchars() の引数とフラグ設定</div>
        <p><code>htmlspecialchars(対象変数, ENT_QUOTES, 'UTF-8');</code></p>
        <ul>
          <li><strong>第2引数に「ENT_QUOTES」を指定する理由：</strong> ダブルクォーテーションだけでなく、<strong>シングルクォーテーションも含めて両方の記号を漏れなく安全な文字列にエスケープする</strong>ためです。セキュリティを強固にするため、実務ではこれ以外の指定は行いません。</li>
        </ul>

        <div class="sub-heading"> 💡 重要：テキストエリアの改行処理（nl2br）との連携順序</div>
        <p>テキストエリアで改行されたデータは、そのまま出力するとHTMLの仕様により半角スペースに化けて1行に繋がってしまいます。改行を維持して表示するには、改行コードを <code>&lt;br&gt;</code> タグに変換する <strong>nl2br() 関数</strong> を使用します。</p>
        <p><strong>実装のネスト順序（プロの鉄則）：</strong><br>
          必ず、エスケープをして安全にした文字列に対して、最後に改行タグを挿入します。そのため、 <code>nl2br(htmlspecialchars(...))</code> という順番で中に書いていくのが正しい構文です。</p>
      </div>

      <!-- 🧠 自主学習・徹底復習ミニクイズ（全10問） -->
      <div class="quiz-container">
        <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 自主学習・徹底復習ミニクイズ（全10問）</h3>
        <p style="margin-bottom: 25px;">フォーム送受信とセキュリティ対策の重要ポイントを全10問のクイズで総復習しましょう。</p>

        <!-- クイズ1〜5：フォームの送受信基礎 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. パスワードやクレジットカード番号などの個人情報を送信する際、GETではなくPOSTを使うべき最大の理由は？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 GETはデータがURLの後ろに丸見えで追加されるのに対し、POSTは通信の内部データとして送られるため画面上に見えなくなるから。</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q2. チェックボックスの複数選択されたデータを、PHP側で上書きさせずに配列として受け取るためにHTML側で必要な記述は？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 name属性値の末尾に「[]（角括弧）」を付けて「name="hobby[]"」のように記述する。</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q3. 実務において、文字数の多い選択項目の値をそのままやり取りせず、value="0" や value="1" のように扱う設計手法を何と呼ぶ？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 項目のコード化（数値化）</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q4. ファイル送信（アップロード）を行うフォームの&lt;form&gt;タグに設定しなければならない「method」と「enctype」の指定値は？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 method="post" と enctype="multipart/form-data"</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q5. アップロードされたファイルの「バイト単位のファイルサイズ」は、$_FILESのどのキーから取得できる？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 $_FILES['inputのname']['size']</p>
            </div>
          </details>
        </div>

        <!-- クイズ6〜10：バリデーションとサニタイズ -->
        <div class="quiz-box">
          <p class="quiz-question">Q6. $_FILESのerrorコードが「0」だった場合、どのようなアップロード状態を意味する？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 正常終了（アップロード成功）</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q7. ユーザーが入力フォームを完全に「未入力」のまま送信した場合、PHP側にはどのようなデータとして届く？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 空の文字列（文字数0の文字列）として受信される。（※キー自体は存在するためissetだけでは未入力判定できない）</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q8. 自由入力欄の値を出力する際、XSS（クロスサイトスクリプティング）脆弱性を防ぐために行う文字列変換処理を何と呼ぶ？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 サニタイズ（エスケープ処理 / 無害化）</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q9. htmlspecialchars() の第2引数に「ENT_QUOTES」を指定する最大の目的は？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 ダブルクォーテーションだけでなく、シングルクォーテーションも含めて両方の記号を確実にエスケープするため。</p>
            </div>
          </details>
        </div>
        <div class="quiz-box">
          <p class="quiz-question">Q10. テキストエリアの出力を「安全（サニタイズ）」かつ「ブラウザ上での正常改行」にするための、正しい関数の組み合わせ順序は？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 nl2br(htmlspecialchars($_POST['qus'], ENT_QUOTES, 'UTF-8'))</p>
            </div>
          </details>
        </div>
      </div> <!-- .quiz-container 終了 -->

    </main>
  </div> <!-- .container -->

  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>