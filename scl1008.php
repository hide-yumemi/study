<!DOCTYPE html>
<html lang="ja">

<head>
    <title>10/08(水)職業訓練授業：MySQLデータベースの基礎とphpMyAdmin操作技術 | ポートフォリオサイト</title>
    <?php include 'meta.php'; ?>
    <!-- クイズ専用CSSを読み込み -->
    <link rel="stylesheet" href="quiz.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <main class="main-content">

            <h1>10/08(水)職業訓練授業</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">MySQLデータベースの基礎概念、カラムのデータ型、照合順序の設定とphpMyAdmin操作</p>

            <!-- 1. データベースの基礎と代表的なRDBMS -->
            <div class="note-section">
                <h3 class="note-title">1. データベースの基礎と代表的なRDBMS</h3>
                <p>データベース（DB）は、大量のデータを効率的に管理・蓄積するためのシステムです。現在のWeb開発では、データをエクセルのような行と列の「表」形式で管理する<b>関係型データベース（RDB）</b>が広く使われています。</p>

                <div class="sub-heading">1-1. MySQL と MariaDB の関係</div>
                <p>授業で使用する <b>MariaDB</b> は、オープンソースで最も有名な <b>MySQL</b> から派生して生まれたデータベースであり、事実上の完全互換システムです。同一のものと考えて問題ないため、開発現場において明確に区別して設計を分ける必要はありません。</p>

                <div class="sub-heading">1-2. 代表的なデータベースの使い分け</div>
                <ul>
                    <li><strong>MySQL (MariaDB)：</strong> シンプルな構造設計により、読み込みや処理速度が非常に高速。一般的な<b>Webサイト</b>やブログ、CMS（WordPressなど）に最適です。</li>
                    <li><strong>PostgreSQL：</strong> データの整合性を保つ「外部キー」などの高度な機能を豊富に搭載。複雑なトランザクションを必要とする業務系の<b>Webアプリケーション</b>でよく採用されます。</li>
                </ul>
                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fef2f2; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠️ レンタルサーバー選定の注意点：</strong> サーバーのプランによって、作成できる「データベースの最大数」や「設置可能なテーブル数」に制限が設けられていることがあります。将来的に複数のWebサイトやポートフォリオを同一サーバーで運用する場合は、あらかじめプランの制限を確認しておく必要があります。
                </p>
            </div>

            <!-- 2. テーブルの構造とMySQLの主要なデータ型 -->
            <div class="note-section">
                <h3 class="note-title">2. テーブルの構造とMySQLの主要なデータ型</h3>
                <p>1つのデータベース内には複数の<b>テーブル（表）</b>を設置でき、データは1件ごとに「行（レコード）」単位で書き込まれます。列部分は「カラム（項目）」と呼ばれ、カラムごとに適切なデータ型とサイズを定義します。</p>

                <div class="sub-heading">2-1. 文字列型</div>
                <ul>
                    <li><strong>varchar型（可変長文字列）：</strong> 格納する最大文字数（サイズ）を指定します。実際のデータ量に合わせて保存容量が変動するため効率的です。半角も全角も同様に1文字としてカウントされます。</li>
                </ul>

                <div class="sub-heading">2-2. 時間型</div>
                <ul>
                    <li><strong>datetime型：</strong> <code>YYYY-MM-DD HH:MM:SS</code> の形式。サーバーが設置されている国（ローカルタイム）の現在日時をそのまま保存します。</li>
                    <li><strong>timestamp型：</strong> 保存形式はdatetimeと同じですが、内部的にUTC（世界標準時）として扱われ、時差を考慮する必要があるグローバルなシステムで使用されます。</li>
                </ul>

                <div class="sub-heading">2-3. 数値型（整数・浮動小数点）</div>
                <p>整数型は、割り当てられるメモリ（バイト数）によって格納できる最大値が厳密に決まっています。</p>
                <ul>
                    <li><code>TINYINT型</code>：1バイト ／ <code>SMALLINT型</code>：2バイト ／ <code>INT型</code>：4バイト ／ <code>BIGINT型</code>：8バイト</li>
                    <li><strong>浮動小数点（小数型）：</strong> <code>FLOAT型</code>（4バイト）と <code>DOUBLE型</code>（8バイト）があります。<b>PHPの小数は内部的にDOUBLE型</b>であるため、誤差を防ぐためにMySQL側も <code>DOUBLE型</code> を選択するのが一般的です。</li>
                </ul>
                <p style="font-size: 13.5px; color: #666; background-color: #f8fafc; padding: 10px; border-radius: 6px;">
                    ※数値型でサイズ（長さ）を指定した場合、格納できる桁数ではなく「画面上での表示桁数」の指定になるという違いがあります。
                </p>
            </div>

            <!-- 3. インデックス・主キーと照合順序 -->
            <div class="note-section">
                <h3 class="note-title">3. インデックス・主キーと照合順序</h3>
                <p>データベースの検索速度を向上させ、データの重複を防ぐために、カラムに対して特殊な制約（インデックス）や文字の並び順ルール（照合順序）を設定します。</p>

                <div class="sub-heading">3-1. プライマリーキー（主キー）とオートインクリメント</div>
                <p>テーブル内に必ず1つ設定しなければならない、行を確実に1意に識別するためのカラムです。「重複してはいけない（ユニーク）」かつ「空欄は不可（NOT NULL）」という絶対ルールがあります。</p>
                <p>MySQLでは、自動的に連番を書き込む <b>A.I（オートインクリメント）</b>を設定したカラムは、自動的にプライマリーキーとして紐付けられます。</p>

                <div class="sub-heading">3-2. 照合順序と絵文字対応（utf8mb4）</div>
                <p>文字の検索や並び替え（50音順など）の基準を定義する設定です。日本語環境では以下の指定が基本となります。</p>
                <ul>
                    <li><code>utf8_general_ci</code>：アルファベットの大文字・小文字を区別せずに検索・ソートする。</li>
                    <li><code>utf8_bin</code>：アルファベットの大文字・小文字を厳密に区別する。</li>
                </ul>
                <p>近年のWebサイトやアプリで必須となっている<b>「絵文字」を許可する場合、4バイトの文字コードに対応した <code>utf8mb4</code> を選択する必要があります。</b>この場合の照合順序は <code>utf8mb4_general_ci</code> や <code>utf8mb4_bin</code> となります。</p>
            </div>

            <!-- 4. phpMyAdminによるGUI操作手順 -->
            <div class="note-section">
                <h3 class="note-title">4. phpMyAdminによるGUI操作手順</h3>
                <p>コマンド（SQL文）を入力することなく、ブラウザ上の視覚的なUIでMySQLを管理できるツールです。</p>

                <div class="sub-heading">4-1. 新規データベースとテーブルの作成の流れ</div>
                <ol>
                    <li>phpMyAdminトップの左メニュー「新規作成」から、データベース名を入力し、照合順序（基本は <code>utf8mb4_general_ci</code>）を選んで作成します。</li>
                    <li>作成したDB内で、テーブル名とカラム数（列の数）を入力して構造定義画面へ進みます。</li>
                    <li>各カラムの「名前」「タイプ（型）」「長さ（varcharの最大値）」を入力します。
                        <ul>
                            <li><strong>NULLの制御：</strong> チェックを入れると「NULL（空文字）を許可」になり、外すと「NOT NULL（必須入力）」になります。</li>
                            <li><strong>主キーの設定：</strong> ID用のカラムの「A.I」にチェックを入れると、自動的にインデックスが「PRIMARY」に設定されます。</li>
                        </ul>
                    </li>
                    <li>保存前に画面下部の「SQLのプレビュー」をクリックすると、ツールが裏側で自動生成した生のCREATE TABLEクエリを確認できます。問題がなければ「保存」でテーブルが完成します。</li>
                </ol>
                <p class="note" style="font-size: 13.5px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>💡 実務の鉄則：</strong> システムが稼働し始めた後にカラム名や型を変更することは不可能ではありませんが、処理速度の低下や、PHP側の変数受け取りとのズレによる重大なシステムエラーの原因になりかねません。最初の設計段階で型とサイズを緻密に決めておくことが極めて重要です。
                </p>
            </div>

            <!-- クイズエリア -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 本日の復習ミニクイズ</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <div class="quiz-box">
                    <p class="quiz-question">Q1. MySQLとMariaDBの違いについて、開発を行う上での正しい認識はどれですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 MariaDBはMySQLの完全互換として開発されているため、開発において同一のものとして扱って問題ない。</p>
                            <p style="margin-bottom: 0;">解説： サーバー環境によって表記が異なる場合がありますが、PHPから接続してデータを操作する際のSQL構文や挙動は全く同じです。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q2. 近年のWebシステムにおいて、従来の「utf8」ではなく「utf8mb4」という文字コードをデータベースやテーブルに指定する主な目的は何ですか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 スマホなどで使われる「絵文字」のような、4バイトのデータサイズを持つ文字を正しく保存・表示できるようにするため。</p>
                            <p style="margin-bottom: 0;">解説： 従来の通常のutf8は最大3バイトまでの対応のため、絵文字をそのまま登録しようとするとエラーになるか文字化けしてしまいます。そのため、現代のWebサイト開発ではutf8mb4が標準となっています。</p>
                        </div>
                    </details>
                </div>

                <div class="quiz-box">
                    <p class="quiz-question">Q3. テーブルを作成する際、ID（連番）カラムに対して「A.I（オートインクリメント）」を設定すると、インデックス設定はどうなりますか？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 自動的にそのテーブルの唯一の「プライマリーキー（主キー）」として登録される。</p>
                            <p style="margin-bottom: 0;">解説： オートインクリメントは格納順に重複のない連番を自動的に書き込む仕組みであるため、必然的に主キーの条件（ユニーク・NOT NULL）を満たすことになり、MySQL側で自動設定されます。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

            <p style="margin-top: 25px;">
                <a href="0915_1119.php" class="link-board">➔ 授業一覧ページへ戻る</a>
            </p>

        </main>
    </div> <!-- .container 終了 -->

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
