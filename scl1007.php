<!DOCTYPE html>
<html lang="ja">

<head>
  <title>10/07(水)職業訓練授業：MySQLデータベースの基礎とphpMyAdmin操作 | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
  <style>
    /* 共通CSS(scl_style.css等)の設計を汚さない、手順バッジのみの最小限の拡張 */
    .step-badge {
      display: inline-block;
      background-color: #1e3a8a;
      color: white;
      padding: 3px 10px;
      border-radius: 4px;
      font-size: 13px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .highlight-txt {
      background-color: #fee2e2;
      padding: 2px 5px;
      font-weight: bold;
      color: #b91c1c;
      border-radius: 3px;
    }
  </style>
</head>

<body>

  <!-- 共通ヘッダーパーツの読み込み -->
  <?php include 'header.php'; ?>

  <!-- メインレイアウトコンテナ -->
  <div class="container">
    <main class="main-content">

      <h1>10/07(水)職業訓練授業</h1>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">関係型データベース（RDBMS）の設計思想、主要なデータ型、およびphpMyAdminによるGUI操作技術</p>

      <!-- メインの概要セクション -->
      <div class="note-section">
        <h3 class="note-title">📋 講義：データベース（MySQL）の構築要件</h3>
        <p><strong>【講義概要】</strong> 先生の教材「ひとこと掲示板（oneline_bbs）」を今後の授業で連動させるにあたり、土台となるバックエンドデータベースの作成、およびテーブル構造の設計・構築手順を学びます。</p>
        
        <div class="sub-heading">教材（bbs.php / bbs2.php）の設計上の違いについて</div>
        <p>本カリキュラムの教材では、全く同じ見た目・機能を持つ掲示板を、異なる2つの命令ライブラリを使って実装しています。それぞれのバックエンドの特徴と違いをしっかりと把握しておく必要があります。</p>
        <ul>
          <li><strong>1. bbs.php（mysqli 方式）</strong><br>
          特徴： <code>mysqli_connect</code> や <code>mysqli_prepare</code> などの関数を使用します。MySQLデータベース専用に設計された、昔ながらの直感的な記述方法です。</li>
          <li><strong>2. bbs2.php（PDO 方式）</strong><br>
          特徴： <code>new PDO</code> や <code>$stmt->prepare</code> などのオブジェクト指向の命令を使います。MySQL以外のデータベース（PostgreSQLやSQLiteなど）にも最小限の変更で柔軟に対応できる、現代 of Web開発において広く主流となっている安全な接続手法です。</li>
        </ul>
        <p>※どちらのプログラムも、内部のSQL文では共通して同一のデータベース内にある <code>oneline_bbs.post</code> テーブルを参照しています。そのため、phpMyAdmin側で後述するテーブルを1つ正しく作成すれば、両方のシステムを同時に動かすことができます。</p>

        <div class="board-figure">
          <img src="./img/MySQL_TOP_PAGE.png" alt="10/07 phpMyAdminトップ画面">
          <div class="board-figcaption">管理ツール「phpMyAdmin」の操作画面とリレーション設定</div>
        </div>
      </div>

      <!-- 🛠️ 手順解説セクション -->
      <div class="note-section">
        <h3 class="note-title">🛠️ トップページから新規作成までの流れ</h3>
        <p>phpMyAdminの直感的なグラフィカルインターフェース（GUI）を利用して、データベースの作成からテーブル構造の定義、保存にいたる全ステップの解説です。</p>

        <!-- 手順1 -->
        <div class="sub-heading">
          <span class="step-badge">手順 1</span> 新規データベースの作成開始
        </div>
        <p>phpMyAdminのトップページ左側のデータベースリストにある「新規作成」、もしくは上部メニューの「データベース」タブをクリックして、新しいデータ領域の立ち上げ画面へと移行します。</p>
        <div class="board-figure">
          <img src="./img/MySQL_TOP_PAGE1.png" alt="新規作成手順1">
        </div>

        <!-- 手順2 -->
        <div class="sub-heading">
          <span class="step-badge">手順 2</span> データベース名の入力と照合順序の選択
        </div>
        <p>作成したい任意のデータベース名を入力します。このとき、使用する教材プログラム（<code>bbs.php</code>）の6行目に <code>mysqli_select_db($link, "oneline_bbs");</code> と厳格に指定されているため、データベース名は完全に一致するよう <strong><code>oneline_bbs</code></strong> と入力する必要があります。</p>
        
        <div class="board-dl">
          <dt>💡 知識補足：文字コード「utf8mb4」と「照合順序」の本質</dt>
          <dd>phpMyAdminの管理画面でデータベース名の横に並んでいる選択肢は、<strong>「どの文字コードでデータを安全に保存・検索・並び替えるか」</strong>という重要な通信ルールの一覧です。</dd>
          
          <dt>1. utf8mb4 が意味するもの</dt>
          <dd>「絵文字や複雑な漢字も含めて、世界中のあらゆる文字を文字化けさせずに保存できる仕組み」です。従来のMySQLで使われていた古い <code>utf8</code> 属性は最大3バイトまでの文字しか保存できませんでしたが、<code>utf8mb4</code> は最大4バイトのデータ領域に対応しています。スマートフォンで日常的に利用する「絵文字（😀✨）」や特殊な漢字（「𠮷」など）は4バイトデータであるため、文字化けやエラーを防ぐために現在のシステム開発では必須の指定となっています。</dd>

          <dt>2. 照合順序（_general_ci や _bin などの違い）</dt>
          <dd>文字列の並び替え（ソート）や内部検索を行う際の「比較のルール」を表します。
            <ul>
              <li><strong>utf8mb4_general_ci</strong>：処理が軽くて高速。ただし、「は」と「ば」と「ぱ」を同一視して検索してしまうなど、日本語の厳密な区別が少し苦手。学習目的や一般的な掲示板ではこれを選べば問題ありません。</li>
              <li><strong>utf8mb4_unicode_ci</strong>：国際規格に準拠した正確な比較が可能。ただしアルファベットの大文字・小文字（A と a）を区別しません。</li>
              <li><strong>utf8mb4_bin</strong>：バイナリ（データそのものの2進数数値）で厳格に比較。大文字と小文字（A と a）、ひらがなとカタカナ、濁点・半濁点の有無を完全に別の文字として厳しく区別したい認証システムなどで採用されます。</li>
            </ul>
          </dd>

          <dt>3. プログラム（PHP）側での指定と同期</dt>
          <dd>データベース側で <code>utf8mb4</code> を選択した場合、プログラム側でも「これから文字コードを指定してデータをやり取りする」と同期させる必要があります。教材の <code>bbs.php</code> では、接続直後に <code>mysqli_set_charset($link, "utf8mb4");</code> を指定して文字化けを防ぐ鉄則が組み込まれています。</dd>
        </div>

        <div class="board-figure">
          <img src="./img/MySQL_TOP_PAGE2.png" alt="新規作成手順2">
        </div>

        <!-- 手順3 -->
        <div class="sub-heading">
          <span class="step-badge">手順 3</span> テーブル名とカラム数の指定
        </div>
        <p>データベース領域の作成完了後、データを実際に格納するための表の名前（テーブル名）と、必要となる列の総数（カラム数）を入力します。今回は、テーブル名に <strong><code>post</code></strong>、カラム数に <strong><code>4</code></strong> を指定して実行します。</p>
        <!-- 💡 サイト共通の pre ルール（薄いグレー背景・暗色文字）を汚すインラインの黒背景を完全に排除しました -->
        <div class="board-dl" style="margin-top: 25px; margin-bottom: 25px;">
          <dt>🔍 開発技術：テーブル名とカラム数をプログラムから逆算する方法</dt>
          <dd>事前に仕様書や設計図が手元にない場合でも、配布されたPHPコードの中に記述されている「SQL文（データベースへの命令文）」を注意深く読み解くことで、必要なテーブル構造を100%正確に導き出すことができます。</dd>

          <dt>1. 「テーブル名」の特定方法</dt>
          <dd>プログラム内でデータを読み出す命令（<code>SELECT ... FROM</code>）や、データを追加する命令（<code>INSERT INTO</code>）の<strong>すぐ後ろに記述されている名前</strong>がターゲットとなるテーブル名です。教材（<code>bbs.php</code>）の73行目付近には以下のSQL文が記載されています。
            <!-- 💡 共通CSSが自動適用されるため、文字がクッキリと浮き上がります -->
            <pre><code>$sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";</code></pre>
            <p style="font-size: 13.5px; margin-top: 5px;">➔ 解説： データをどこから取得するかを示す <code>FROM</code> の直後に <code>`post`</code> と指定されているため、作成すべきテーブル名が「<strong>post</strong>」であると一目で判別できます。</p>
          </dd>

          <dt>2. 「カラム数（列の数）」と項目の特定方法</dt>
          <dd>新しくデータを書き込む命令（<code>INSERT INTO</code>）の構造を見ると、カッコ <code>( )</code> の中にカンマ区切りで項目名が並んでいます。教材の34行目付近のコードを確認します。
            <pre><code>$sql = mysqli_prepare($link, 'INSERT INTO `post` (`name`, `comment`, `created_at`) VALUES (?, ?, ?)');</code></pre>
            <p style="font-size: 13.5px; margin-top: 5px; margin-bottom: 5px;">➔ 解説： カッコの中に <code>name</code>、<code>comment</code>、<code>created_at</code> という3つのデータ項目が並んでいます。また、HTMLの表示部分（81行目付近）を見ても同様にこの3つの名前が使用されています。</p>
            <pre><code>echo htmlspecialchars($post["name"], ENT_QUOTES, "UTF-8");
echo htmlspecialchars($post["comment"], ENT_QUOTES, "UTF-8");
echo htmlspecialchars($post["created_at"], ENT_QUOTES, "UTF-8");</code></pre>
            <p style="font-size: 13.5px; margin-top: 8px;"><strong>💡 なぜ指定するカラム数は「4」になるのか？</strong><br>
            プログラムから直接送信されて処理される項目は上記の3つですが、リレーショナルデータベースの共通の大原則として、データを1行ずつ厳密に区別・管理するための管理用連番キー（<code>id</code>）が絶対に1つ必要になります。そのため、自動生成する <code>id</code> ＋ 送信される3項目 ＝ <strong>合計4つのカラム（列）</strong>が必要であると逆算して確定させることができます。</p>
          </dd>
        </div>

        <div class="board-figure" style="margin-bottom: 30px;">
          <img src="./img/MySQL_TOP_PAGE3.png" alt="新規作成手順3">
        </div>

        <!-- 手順4 -->
        <div class="sub-heading">
          <span class="step-badge">手順 4</span> 各カラムの詳細パラメータ設定
        </div>
        <p>画面に展開される4つの入力行に対し、教材プログラムが内部バリデーションチェックやデータ型不整合でエラーを起こさずに完璧に連動できるよう、以下の指定値を正確に入力します。</p>

        <div class="board-dl" style="line-height: 1.7;">
          <dt>🟢 1行目：【管理用ID（自動連番）の設定】</dt>
          <dd>・名前： <code>id</code> ｜ ・タイプ： <code>INT</code> ｜ ・長さ/値： 空欄（無指定）でOK<br>
          ・<strong>A.I (オートインクリメント)</strong>： <span class="highlight-txt">チェックを入れる</span> ※ポップアップ画面が出たらそのまま「実行」を選択します。</dd>
          
          <dt>🟢 2行目：【投稿者の名前の設定】</dt>
          <dd>・名前： <code>name</code> ｜ ・タイプ： <code>VARCHAR</code><br>
          ・長さ/値： <strong><code>40</code></strong> <span style="font-size: 12px; color: #666;">（※教材コード内で「40文字以内」という文字数制限のチェックがかかっているため適合させます）</span></dd>
          
          <dt>🟢 3行目：【ひとことコメントの設定】</dt>
          <dd>・名前： <code>comment</code> ｜ ・タイプ： <code>VARCHAR</code><br>
          ・長さ/値： <strong><code>200</code></strong> <span style="font-size: 12px; color: #666;">（※教材コード内で「200文字以内」という文字数制限のチェックがかかっているため適合させます）</span></dd>
          
          <dt>🟢 4行目：【投稿日時の設定】</dt>
          <dd>・名前： <code>created_at</code> ｜ ・タイプ： <code>DATETIME</code> ｜ ・長さ/値： 空欄（無指定）でOK<br>
          <span style="color: red; font-size: 12.5px; font-weight: bold;">⚠️最重要：教材コード内では日時の項目名が「created」ではなく「created_at」と厳格に指定されています。1文字でもズレるとSQL実行エラーになるためスペルミスに絶対注意してください。</span></dd>

          <dt>🔍 「照合順序」や「NULL」の欄の扱いについて</dt>
          <dd>・<strong>照合順序</strong>： すべて空欄（無指定）のままで大丈夫です。データベース作成時に選択した文字コードルールが自動で引き継がれます。<br>
          ・<strong>NULL</strong>： すべてチェックを外した空欄のままで大丈夫です。今回の掲示板は空での投稿を禁止する必須（NOT NULL）設計になっているためです。</dd>
        </div>

        <div class="board-figure" style="margin-bottom: 30px;">
          <img src="./img/MySQL_TOP_PAGE4.png" alt="新規作成手順4">
        </div>

        <!-- 手順5 -->
        <div class="sub-heading">
          <span class="step-badge">手順 5</span> SQLのプレビュー確認と保存
        </div>
        <p>すべてのカラム設定の入力が終了したら、画面下部にある「SQLのプレビュー」をクリックして、GUI操作によって自動生成された内部のSQL文（CREATE TABLE文）を確認します。記述内容や設定値に問題がなければ、そのまま右下の「保存」ボタンをクリックしてテーブルを完成させます。</p>
        <div class="board-figure" style="margin-bottom: 10px;">
          <img src="./img/MySQL_TOP_PAGE5.png" alt="新規作成手順5確認">
        </div>
      </div>

      <!-- 作成後の構造ページについての解説 -->
      <div class="note-section">
        <h3 class="note-title">💡 作成後の「構造」ページの確認と編集</h3>
        <p>テーブル作成完了後に自動的に移行する「構造」タブ画面では、設定した内容の再確認や、後からの微調整を行うことができます。</p>

        <div class="sub-heading">鍵マークによるインデックス制約の識別</div>
        <p>カラム名の右側に<strong>金の鍵マーク</strong>が表示されている場合は「プライマリーキー（主キー）」、<strong>銀の鍵マーク</strong>が表示されている場合は「ユニーク（一意制約）」が正しく指定されている印です。これらは画面最下部の「インデックス」エリアでも一覧として確認できます。</p>

        <div class="sub-heading">データの閲覧と直接編集・修正</div>
        <p>上部メニューの「表示」タブをクリックすると、現在テーブル内に格納されているデータ（レコード）を行単位で確認できます。データを直接書き換えたい場合は、該当行の「編集」リンクをクリックして修正することが可能です。</p>
        <p style="color: red; font-weight: bold; font-size: 13.5px; margin-top: 10px;">※注意：システムの本番稼働（運用開始）が始まった後にカラムの型や名前を変更することは、処理速度の大幅な低下や、プログラム（PHPなど）側とのデータ不整合による重大なエラーの原因になるため、設計段階で入念に確認を行ってください。</p>
      </div>

      <!-- 2. 注意点・解説 -->
      <div class="note-section">
        <h3 class="note-title">⚠️ データベース設計における重要注意点</h3>

        <div class="sub-heading">1. 代表的なオープンソースデータベースの使い分け</div>
        <p>Web業界で広く利用されているRDBMS（関係型データベース）には、それぞれ設計思想による強みがあります。</p>
        <ul>
          <li><strong>MySQL（MariaDB）</strong>：シンプルな構造設計により処理速度が非常に高速。一般的なWebサイトやブログ、企業のホームページ等で多く採用。※MariaDBはMySQLと完全互換。</li>
          <li><strong>PostgreSQL</strong>：外部キーをはじめとした多様な機能、複雑なデータ処理や高い拡張性が特徴。堅牢なWebアプリケーションシステムで多く採用。</li>
        </ul>
        <p>※1つのデータベースの中には、エクセルのような表形式の「テーブル」を複数設置できます。セキュリティを高く保ちたい場合（ログイン情報と一般的な個人情報を分けるなど）は別々のデータベースに分け、データの重複をなくして整理する「正規化」を行う場合は、同一データベース内の別テーブルとして作成するのが一般的です。（※レンタルサーバーのプランによって作成可能なデータベース数やテーブル数に制限があるため注意が必要です）</p>

        <div class="sub-heading">2. カラムに指定する主要なデータ型（型とサイズの概念）</div>
        <p>テーブルの列（カラム）ごとに適切なデータ型を指定します。それぞれの特性を正しく理解しておく必要があります。</p>
        <ul>
          <li><strong>VARCHAR型（可変長文字列）</strong>：サイズ指定を行い、その数値が格納できる「最大文字数」を表します。</li>
          <li><strong>DATETIME型 / TIMESTAMP型（時間型）</strong>：日時を記録する型。<code>YYYY-MM-DD HH:MM:SS</code> の形で保存されます。DATETIMEはサーバーが設置されている国（ローカルタイム）の時間、TIMESTAMPは内部で世界標準時（UTC）として管理されます。</li>
          <li><strong>INT型 / TINYINT型（数値型）</strong>：整数を扱います。型によって格納できる容量（バイト数）が厳密に決まっています（TINYINTは1バイト、SMALLINTは2バイト、INTは4バイト、BIGINTは8バイト）。<br>
            <span style="color: #ff8c00; font-weight: bold;">※注意：数値型で長さを指定した場合、それは格納できる「データの桁数」ではなく、画面上の「表示桁数」の指定となるため、文字列型のサイズ指定とは根本的に意味が異なります。</span>
          </li>
          <li><strong>FLOAT型 / DOUBLE型（浮動小数点型）</strong>：小数点を扱います。PHPの浮動小数点は8バイトのDOUBLE型に相当するため、MySQL側でも型を「DOUBLE」に合わせることが多いです。</li>
        </ul>

        <div class="sub-heading">3. プライマリーキー（主キー）とオートインクリメント</div>
        <p>各カラム（列）ごとに、同じ値を二度と書き込めなくする「ユニーク（一意）」の制約を指定できます。ユニークを設定すると、NULL（空値）以外で重複した値を保存しようとした際にエラーとなります。</p>
        <p>検討:そして、テーブルに1つだけ必須となる最も重要なキーが<strong>プライマリーキー（主キー）</strong>です。主キーには「重複不可（ユニーク）」かつ「空値不可（NOT NULL）」の指定が必ず必要となります。また、格納された順に自動で連番を振る<strong>オートインクリメント（A.I）</strong>を指定したカラムは、MySQLの仕様により自動的にプライマリーキーに指定されます。</p>

        <div class="sub-heading">4. 日本語・絵文字を扱う場合の「照合順序」の選定</div>
        <p>MySQLでは、テーブルやカラムごとにデータの検索・並び替え（50音順など）の基準となる「照合順序」を指定します（指定がない場合は初期値 <code>utf8_general_ci</code> など）。</p>
        <ul>
          <li><strong>UTF-8 general_ci</strong>：アルファベットの大文字・小文字を区別せずに検索・並び替えを行う。</li>
          <li><strong>UTF-8 bin</strong>：バイナリ比較を行い、アルファベットの大文字・小文字を厳格に区別する。</li>
        </ul>
        <p>また、最近のサイトやアプリで必須となっている「絵文字」の投稿・保存を許可する場合、4バイトの文字コードに対応させる必要があるため、日本語環境では <strong><code>UTF-8mb4</code></strong>（照合順序は <code>utf8mb4_general_ci</code> や <code>utf8mb4_bin</code>）を選択する必要があります。</p>
      </div>

      <!-- 3. 復習ミニクイズ（共通追加スタイル quiz.css に完全適合） -->
      <div class="quiz-container">
        <h3 class="note-title" style="border-left-color: #1e3a8a;">本日の復習ミニクイズ（全5問）</h3>
        <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

        <!-- クイズ1 -->
        <div class="quiz-box">
          <p class="quiz-question">Q1. MySQLとMariaDBの関係性について、開発環境において区別して開発を行うべきですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 区別する必要はない（完全互換の同一のものとして扱ってよい）</p>
              <p style="margin-bottom: 0;">解説： MariaDBはMySQLと完全互換という形で開発が進められているため、サーバーや開発環境によって名称が異なっていても、プログラムの開発段階で区別する必要はありません。</p>
            </div>
          </details>
        </div>

        <!-- クイズ2 -->
        <div class="quiz-box">
          <p class="quiz-question">Q2. MySQLにおいて「VARCHAR型」にサイズ（長さ）を指定した場合、その数値は何を意味しますか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 格納できる「最大の文字数」</p>
              <p style="margin-bottom: 0;">解説： 可変長文字列型であるVARCHARでは、指定したサイズ数値がそのカラムに保存できる上限の文字数（サイズ）となります。整数型（INT等）のサイズ指定（表示桁数）とは意味が異なるため混同に注意しましょう。</p>
            </div>
          </details>
        </div>

        <!-- クイズ3 -->
        <div class="quiz-box">
          <p class="quiz-question">Q3. 最近のWebサイトやSNSアプリのように、テキストデータ内に「絵文字」の投稿を許可・保存したい場合、設定すべき適切な文字コード（照合順序のベース）は何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 UTF-8mb4（utf8mb4_general_ci など）</p>
              <p style="margin-bottom: 0;">解説： 絵文字は4バイトの文字コードを使用するため、従来の3バイト上限である通常のUTF-8では保存できず文字化けやエラーになります。絵文字を扱う場合は4バイト対応の <code>UTF-8mb4</code> を選択します。</p>
            </div>
          </details>
        </div>

        <!-- クイズ4 -->
        <div class="quiz-box">
          <p class="quiz-question">Q4. テーブルの特定カラムに「オートインクリメント（A.I：自動連番）」を指定した場合、MySQLの特性上、そのカラムに自動的に付与される重要な制約・キーは何ですか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 プライマリーキー（主キー）</p>
              <p style="margin-bottom: 0;">解説： オートインクリメント（自動連番）を有効にしたカラムは、データを1意に特定できる一意性と、空にしない特性を同時に満たすため、MySQLでは自動的にプライマリーキー（主キー）として扱われます。</p>
            </div>
          </details>
        </div>

        <!-- クイズ5 -->
        <div class="quiz-box">
          <p class="quiz-question">Q5. データベース構築後、実際の稼働（システム運用）が始まった後にテーブル構造やデータ型を頻繁に変更すると、どのようなリスクが発生しますか？</p>
          <details class="quiz-details">
            <summary>▶ 正解と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">【正解】 処理速度の低下や、PHP（プログラム）側との不整合によるエラーの原因になるリスク</p>
              <p style="margin-bottom: 0;">解説： 本番稼働後にデータ構造を変更すると、すでに保存されているデータの破損、インデックス再構築によるレスポンス低下、PHP側の取得ロジックとのずれによる深刻なバグを引き起こす危険性があるため、初期設計が極めて重要です。</p>
            </div>
          </details>
        </div>
      </div> <!-- .quiz-container 終了 -->

    </main>
  </div> <!-- .container 終了 -->

  <a href="#" class="top-button">▲ TOP</a>

</body>
</html>
<!-- http://localhost/study/scl1007.php -->
