<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="10/21(水)の職業訓練授業ノートです。画像ファイル名管理の復習から、PHPのpreg_match()関数を用いた正規表現による全角文字・メールアドレス・複数種必須パスワードの高度なバリデーション技術を解説しています。">
  <title>10/21(水)職業訓練授業：正規表現による高度な入力値バリデーションと画像保存処理 | ポートフォリオサイト</title>
  <!-- 共通ベースCSSの連携 -->
  <link rel="stylesheet" href="style.css">
  <!-- ノート専用CSSの連携 -->
  <link rel="stylesheet" href="scl_style.css">
  <!-- クイズ専用CSSの連携 -->
  <link rel="stylesheet" href="quiz.css">
</head>

<body>
  <!-- 共通ヘッダー -->
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">
      <h1>10/21(水)職業訓練授業</h1>
      <p style="color:#666; font-size: 14px; margin-bottom: 35px;">画像ファイル名作成とサーバー保存、preg_match()を用いた正規表現の基礎、全角文字・メールアドレス・強力なパスワードの判定条件</p>

      <!-- 1. 画像ファイル名作成とサーバー保存の仕様 -->
      <section class="note-section">
        <h3 class="note-title">1. 画像ファイル名作成とサーバー保存の仕様</h3>
        <p>
          前回の課題（ひとこと掲示板の拡張）を踏まえ、教材（<code>gazou_bbs.php</code>）を参考にアップロードされた画像の保存とファイル名管理の設計を整理しました。
        </p>
        <ul>
          <li><strong>ファイル名の自動命名規則：</strong> サーバー側で重複や文字化けを防ぐため、<code>"img." . date('YmdHis') . ".jpg"</code> のように、日時を用いた安全なファイル名をプログラム側で自動生成します。</li>
          <li><strong>データベースとサーバー保存の切り分け：</strong>
            <ul>
              <li>データベースの<code>img</code>カラムには、純粋な<b>「ファイル名のみ」</b>を保存します。</li>
              <li>サーバー側へ実際にファイルを保存（移動）させる時や、ブラウザのHTML上に <code>&lt;img&gt;</code> タグで出力する時は、相対パスの <code>"images/"</code> を手前に結合させて指定を行います。</li>
            </ul>
          </li>
        </ul>
      </section>

      <!-- 2. 正規表現の基礎と preg_match() -->
      <section class="note-section">
        <h3 class="note-title">2. 正規表現の基礎と preg_match()</h3>
        <p>
          会員登録システムなどで、ユーザーが入力した文字の種類や文字数、記述形式が正しいかを厳格にチェックするために <code>preg_match()</code> 関数を用いた<b>「正規表現」</b>の判定を行います。
        </p>

        <div class="sub-heading">2-1. パターン指定の基本記号（デリミタ・アンカー）</div>
        <p>マッチ指定を行う文字列は、全体を <code>/〜/</code> （デリミタ）の形で囲むルールとなっています。</p>
        <ul>
          <li><strong>^（ハット）：</strong> 検索文字列の「1文字目（先頭）」から比較を開始する指定です。<code>/^〜/</code> のように記述します。</li>
          <li><strong>$（ダラー）：</strong> 検索文字列の「最後の文字（末尾）」まで完全に比較する指定です。<code>/〜$/</code> のように記述します。</li>
          <li><strong>/^〜$/ ：</strong> 先頭から末尾まで、<b>文字列のすべてが指定した条件に一致しているか</b>を判定する実務の必須セットです。</li>
        </ul>

        <div class="sub-heading">2-2. 許可する文字数（量指定子）の指定方法</div>
        <p>基本形は <code>[許可する文字]許可する文字数</code> の形で指定します。特定の文字（メールの<code>@</code>など）が必須の場合は、そのまま直接記述します。</p>
        <ul>
          <li><strong>+ ：</strong> 直前の指定文字が<b>1文字以上</b>（必須入力）。</li>
          <li><strong>* ：</strong> 直前の指定文字が<b>0文字以上</b>（空欄も許容）。</li>
          <li><strong>{m} ：</strong> 直前の指定文字がぴったり<b>m文字</b>。</li>
          <li><strong>{m,} ：</strong> 直前の指定文字が最低<b>m文字以上</b>。</li>
          <li><strong>{m,n} ：</strong> 直前の指定文字が<b>m文字からn文字まで</b>（範囲指定）。</li>
        </ul>

        <div class="sub-heading">⚠️ 特殊記号のエスケープ（誤動作防止）</div>
        <p>
          正規表現の中で特別な意味を持つ記号を、「純粋なその文字自体」として扱いたい場合は、手前に <code>\</code>（バックスラッシュ / 環境によっては¥マーク）を付けてエスケープする必要があります。
        </p>
        <p>
          【エスケープが必要な主な記号】： <code>\\</code> , <code>\.</code> , <code>\{</code> , <code>\}</code> , <code>\[</code> , <code>\]</code> , <code>\+</code> , <code>\*</code> , <code>\$</code> , <code>\^</code> , <code>\-</code>
        </p>
      </section>

      <!-- 3. 文字種別の具体的な記述方法 -->
      <section class="note-section">
        <h3 class="note-title">3. 文字種別の具体的な記述方法</h3>
        <p>
          <code>[]</code>（文字クラス）の中に、許可したい文字を区切りなしで連続して記述します。文字コード上で連番になっているものは <code>-</code>（ハイフン）を使って範囲指定が可能です。
        </p>

        <div class="sub-heading">3-1. 1バイト文字（半角英数）の連番指定</div>
        <ul>
          <li>半角小文字英字：<code>[a-z]</code> ／ 半角大文字英字：<code>[A-Z]</code> ／ 半角数字：<code>[0-9]</code></li>
          <li>※小文字と大文字の間には別の記号が挟まっているため、英字全般を指定したい場合は <code>[a-zA-Z]</code> と分けて記述します。</li>
        </ul>

        <div class="sub-heading">3-2. マルチバイト文字（全角文字）と「/u」修飾子</div>
        <p>
          PHPで全角文字（ひらがな、漢字など）を正規表現で扱う場合は、<b>必ずUTF-8形式で処理を行うための「<code>u</code>修飾子」</b>を末尾のデリミタの後ろ（<code>/〜/u</code>）に付与しなければなりません。
        </p>
        <ul>
          <li>全角ひらがな：<code>[ぁ-ん]</code> ／ 全角カタカナ：<code>[ァ-ヶ]</code> ／ 漢字：<code>[一-龠]</code></li>
          <li>全角数字：<code>[０-９]</code> ／ 全角小文字：<code>[ａ-ｚ]</code> ／ 全角大文字：<code>[Ａ-Ｚ]</code></li>
        </ul>

        <!-- 個人メモ反映エリア -->
        <p class="note" style="font-size: 13.5px; color: #16a34a; background-color: #f0fdf4; padding: 12px; border-radius: 6px; margin-top: 10px; border-left: 3px solid #16a34a;">
          <strong>💡 実務の補足（個人メモ）：</strong> 現代のシステム開発では、従来の <code>[一-龠]</code> よりもさらに広い漢字の範囲をカバーする <code>[一-龯]</code> を使ったり、文字種のプロパティを利用して1文字も漢字を漏らさず美しく判定できる <code>\p{Han}</code> 形式（<code>"/^\p{Han}+$/u"</code>）が非常によく使われています。
        </p>

        <div class="sub-heading">3-3. 応用：1バイト文字をすべて拒否する指定（全角専用チェック）</div>
        <p>
          <code>[]</code> 内の先頭に <code>^</code> を書くと<b>「〜以外」</b>という意味の否定表現になります。
        </p>
        <pre><code>\$match = "/^[^ -~]+$/u"; // 1バイト文字（半角スペースから〜まで）以外の文字が1文字以上</code></pre>
        <p>これにより、「半角英数や半角記号をすべてNGとし、全角文字（日本語や全角記号）のみを許可する」という判定が作れます。</p>
      </section>

      <!-- 4. 実務で役立つ実践コード例（メール・パスワード） -->
      <section class="note-section">
        <h3 class="note-title">4. 実務で役立つ実践コード例（メール・パスワード）</h3>

        <div class="sub-heading">4-1. メールアドレスの形式チェック</div>
        <p>「＠の前に半角英数（1字目は記号不可）」「＠の直後はドット以外」「ドメイン部に最低1つ以上のドットを含む」という実務的なチェックを行う正規表現です。</p>
        <pre><code>// メールアドレスの正規表現パターン
\$emailmatch = "/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9\._\-]+$/";</code></pre>

        <div class="sub-heading">4-2. 強力なパスワードチェック（複数条件の組み合わせ必須化）</div>
        <p>「半角英数8〜12文字」という全体の長さに加え、<b>「小文字・大文字・数字がそれぞれ最低1文字以上混ざっていること」</b>を必須にするため、あえて<code>^</code>や<code>$</code>を外した部分一致パターンを複数回掛け合わせて判定を行います。</p>
        <pre><code>// パスワードの複数条件チェック手順
\$pass = "SecurePass123";

if (
    preg_match("/^[a-zA-Z0-9]{8,12}$/", \$pass) && // 1. 全体が半角英数で8〜12文字以内か
    preg_match("/[a-z]+/", \$pass) &&               // 2. どこかに半角小文字英字が1字以上あるか
    preg_match("/[A-Z]+/", \$pass) &&               // 3. どこかに半角大文字英字が1字以上あるか
    preg_match("/[0-9]+/", \$pass)                  // 4. どこかに半角数字が1字以上あるか
) {
    echo "&lt;p&gt;安全なパスワードです。&lt;/p&gt;";
} else {
    echo "&lt;p&gt;パスワードの強度が不足しています（大文字・小文字・数字を組み合わせて8〜12文字）。&lt;/p&gt;";
}</code></pre>
      </section>

      <!-- 5. 復習ミニクイズ（アコーディオン形式） -->
      <section class="quiz-container">
        <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ（全4問）</h3>
        <p style="font-size: 14px; margin-bottom: 15px;">本日学習した正規表現やファイル名管理の重要ポイントをおさらいしましょう。クリックで解答・解説が開きます。</p>

        <!-- Q1 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. 画像付き掲示板において、データベースの「img」カラムには何という情報を保存するのが基本ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：自動生成された「ファイル名のみ」</p>
              <p>データベースには <code>img20261021123456.jpg</code> のような純粋なファイル名のみを保存します。保存先フォルダ名（<code>images/</code>）まで含めて保存してしまうと、将来フォルダ構成が変わった際に変更が困難になるため、パスはプログラム側で後から結合させます。</p>
            </div>
          </details>
        </div>

        <!-- Q2 -->
        <div class="quiz-box">
          <p class="quiz-question">Q2. 正規表現で、文字列の「1文字目（先頭）」から「最後の文字（末尾）」まで全体が完全に一致しているかを判定するために、パターンの先頭と末尾に付与する記号は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：先頭に「^」、末尾に「$」</p>
              <p>文字列全体を厳格に検査する場合は <code>/^パターン$/</code> のように両方の記号（アンカー）を組み合わせます。これがないと、文字列の一部分にだけ該当文字が含まれている場合に誤って通過してしまいます。</p>
            </div>
          </details>
        </div>

        <!-- Q3 -->
        <div class="quiz-box">
          <p class="quiz-question">Q3. PHPの正規表現で、ひらがなや漢字などの全角マルチバイト文字（日本語）を正しく判定させたいとき、パターンの末尾（デリミタの後ろ）に必ず付ける必要があるアルファベットは何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：u （修飾子）</p>
              <p>PHPにおいて全角文字を扱う場合は、パターン全体を <code>/〜/u</code> のように記述してUTF-8モードを明示する必要があります。この <code>u</code> を忘れると、文字化けや意図しない誤判定（マッチ失敗）を引き起こします。</p>
            </div>
          </details>
        </div>

        <!-- Q4 -->
        <div class="quiz-box">
          <p class="quiz-question">Q4. パスワードのチェックで「半角英数8〜12文字」かつ「小文字・大文字・数字の3種すべてを必須」としたい場合、どのような記述方法を取るのが確実ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：全体の文字種・文字数チェック（^と$あり）に加えて、各文字種が1字以上含まれる部分一致（^と$なし）のパターンを論理演算子（&&）で複数掛け合わせる。</p>
              <p>1つの正規表現だけで「3種必須」を表現しようとすると非常に複雑なコード（先読み文脈など）になってしまいます。授業で学んだように、<code>preg_match()</code> を4回に分けて <code>&&</code> で繋ぐ手法が、最もシンプルかつ可読性の高い安全な実装方法です。</p>
            </div>
          </details>
        </div>

        <div class="quiz-box">
          <p class="quiz-question">Q5. 正規表現の文字クラス「[ ]」の「1文字目」に「^」を記述したとき（例: [^ -~]）は、どのような意味に変化しますか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">正解：「〜以外」という意味（指定した文字クラスの否定）</p>
              <p><code>[]</code> の中の一番最初に書く <code>^</code> は否定を意味します。授業で登場した <code>/[^ -~]/</code> の場合、半角スペース（ ）から半角波線（<code>~</code>）までの「すべての1バイト文字（半角英数記号）<b>以外</b>」という意味になり、結果として全角文字（日本語など）だけを許可する強力なフィルターを作ることができます。</p>
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