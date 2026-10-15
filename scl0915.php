<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/15(火)の職業訓練授業ノートです。PHPの基本的な仕組み、WEBサーバー、XAMPPによる開発環境構築、php.iniの設定手順をまとめています。">
    <title>9/15(火)職業訓練授業：PHPの仕組みと開発環境構築 | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">
    <!-- 💡 新設したクイズ専用の外部CSSを読み込み -->
    <link rel="stylesheet" href="quiz.css">
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            
            <h2>9/15(火)職業訓練授業</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">PHPの基本的な仕組み・WEBサーバー・環境構築（XAMPP）</p>

            <!-- 1. 基本的な仕組み -->
            <div class="note-section">
                <h3 class="note-title">1. 基本的な仕組み（サーバーサイド・スクリプトの挙動）</h3>
                <p>WebサーバーにPHPを実行できるプログラムが導入されている場合、 http://~ で要求された ~.php ファイル内のPHPブロックを実行し、その**実行結果のみを要求元（ブラウザ）へ送信**します。</p>
                
                <pre><code>&lt;?php // ここに処理を記述します ?&gt;</code></pre>
                
                <p>サーバー側にPHPを認識するプログラムが必要なため、レンタルサーバーが対応しているか等を事前に調べる必要があります。</p>

                <p><strong>💡 補足：現代のレンタルサーバー事情</strong></p>
                <ul>
                    <li><strong>標準対応の広まり：</strong> エックスサーバー、ロリポップ、ConoHa WINGなど現代の主要なレンタルサーバーのほとんどは標準でPHPに対応しています。</li>
                    <li><strong>バージョンの依存：</strong> PHPには 7.4、8.0、8.1、8.2、8.3 などのバージョンがあり、新旧のコードの互換性に注意が必要です。</li>
                    <li><strong>データベースの必須性：</strong> WordPressの運用やユーザー情報の保存にはデータベースが必須となるため、作成できる上限数などの確認が必要です。</li>
                </ul>
            </div>

            <!-- 2. WEBサーバープログラム -->
            <div class="note-section">
                <h3 class="note-title">2. WEBサーバープログラム</h3>
                <p>代表的なWebサーバープログラムとして <strong>Apache（アパッチ）</strong> があります。</p>
                
                <div class="sub-heading"> Apacheの特徴</div>
                <ul>
                    <li>オープンソースプログラム（無料で公開されているプログラム）</li>
                    <li>PHP実行プログラムの処理と相性が良い（速度が速い）</li>
                    <li>MySQL（データベース）が使用可能</li>
                    <li>二次配布も許可されている</li>
                </ul>

                <p><strong>💡 補足：現代のサーバー駆動方式・最新トレンド</strong></p>
                <ul>
                    <li><strong>Apacheの特徴（モジュール方式）：</strong> PHPをサーバー内部で直接合体させて動かす「モジュール方式（ mod_php ）」があり、古くから高速動作の理由とされてしてきました。現在は「PHP-FPM」という独立した高速化プログラムとの組み合わせが一般的です。</li>
                    <li><strong>現代のWebサーバー（Nginx / LiteSpeed）：</strong> 大量の同時アクセスに強い <strong>Nginx（エンジンエックス）</strong> や、ApacheとNginxのいいとこ取りをした <strong>LiteSpeed（ライトスピード）</strong> という高速なサーバーソフトも普及しています。</li>
                </ul>
            </div>

            <!-- 3. PHP・MySQL開発環境の構築 -->
            <div class="note-section">
                <h3 class="note-title">3. PHP・MySQL開発環境の構築</h3>
                <p>ローカル開発（自分のPC内）で必要なプログラムを導入し、仮想サーバーを用意します。</p>
                <ul>
                    <li><strong>Apache：</strong> パソコンのHDD（SSD）内にサーバープログラムを設置</li>
                    <li><strong>PHP：</strong> 実行プログラム</li>
                    <li><strong>MySQL：</strong> データベースプログラム</li>
                </ul>

                <p><strong>💡 補足：オールインワンソフトとは？</strong></p>
                <p>PC内にローカル開発環境を構築するには、必要なプログラムを一括で導入できるパッケージソフトを使うのが一般的です。これらは「LAMP」や「WAMP」「MAMP」などと呼ばれます。</p>
                <ul>
                    <li><strong>XAMPP（ザンプ）：</strong> 主にWindows向け（X:クロスプラットフォーム、A:Apache、M:MySQL/MariaDB、P:PHP、P:Perl）</li>
                    <li><strong>MAMP（マンプ）：</strong> Mac向け（Windows版もあり）</li>
                    <li><strong>LAMP（ランプ）：</strong> Linux向け</li>
                </ul>
            </div>

            <!-- 4. XAMPPのインストール＆設定 -->
            <div class="note-section">
                <h3 class="note-title">4. XAMPPのインストール＆設定</h3>
                
                <div class="sub-heading"> ステップ1：VS Codeの拡張機能を導入</div>
                <p>まずはVS Codeに以下の2つの拡張機能をインストールします。</p>
                <ul>
                    <li><strong>PHP Debug</strong> ： デバッグ（不具合の調査）を行うための機能</li>
                    <li><strong>PHP Intelephense</strong> ： コードの自動補完やエラーチェックをしてくれる機能</li>
                </ul>

                <div class="sub-heading"> ステップ2：XAMPPの初期設定と管理者実行</div>
                <p>公式ページからインストーラーをダウンロードして実行します。保存場所は一般的にCドライブ（ C:\xampp ）です。インストール後、日本語の文字化け防止と、タイムゾーンを日本時間（東京）にする設定を行います。</p>

                <p><strong>⚠ 重要：管理者として実行と設定手順</strong></p>
                <ol>
                    <li>XAMPPコントロールパネルを一度閉じ、アイコンを<strong>右クリック</strong>して<strong>「管理者として実行」</strong> で再起動します。</li>
                    <li>画面左側の「Service」列にある赤色の「×」マークをクリックし、確認画面で「Yes」を選択して緑色のチェックマークに変えます。</li>
                    <li>右隣の「Start」ボタンを押し、ポート番号が表示されて背景が緑色になれば準備完了です。（他のアプリと競合してエラーが出た場合は原因となるソフトを一度終了します）</li>
                    <li>設定ファイル（ C:\xampp\php\php.ini ）をテキストエディタで開き、以下を修正します。</li>
                </ol>

                <p><strong>【変更箇所1】文字化け防止（Ctrl + Fで検索）</strong></p>
                <p>（変更前） <code>;mbstring.language = Japanese</code></p>
                <p>（変更後） <code>mbstring.language = Japanese</code> ※先頭のセミコロン「;」を消して有効化</p>

                <p><strong>【変更箇所2】日本時間に設定</strong></p>
                <p>（変更前） <code>date.timezone=Europe/Berlin</code></p>
                <p>（変更後） <code>date.timezone="Asia/Tokyo"</code></p>

                <p>設定完了後、Apache chimneysとMySQLを一度「Stop」してから再度「Start」ボタンを押して再起動（リスタート）させます。ブラウザのURL欄に http://localhost と入力してアクセスできたら完了です。</p>

                <p><strong>💡 localhost（htdocsフォルダ）について</strong></p>
                <p>C:\xampp\htdocs フォルダが仮想のWebサーバーとして機能します。作成したPHPプログラムはこのフォルダ内に保存し、ブラウザから http://localhost/ファイル名.php でアクセスして実行します。</p>
            </div>

            <!-- 5. 基本的な構文と日時フォーマット -->
            <div class="note-section">
                <h3 class="note-title">5. 基本的な構文と日時フォーマット</h3>
                
                <div class="sub-heading"> echo文による画面出力</div>
                <p>echo ~; と記述すると、「~」の部分を画面に書き出します。</p>
                
                <pre><code>&lt;!-- PHP側（記述するコード） --&gt;
&lt;p&gt;&lt;?php echo "テスト"; ?&gt;&lt;/p&gt;</code></pre>

                <div class="sub-heading"> サーバーの現在の時刻を取得（date関数）</div>
                <p>date("フォーマット文字列") を使用し、特定のアルファベットを指定して日時を取得します。</p>
                
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px; text-align: left;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 8px; width: 15%;">分類</th>
                            <th style="padding: 8px; width: 10%;">文字</th>
                            <th style="padding: 8px;">意味・出力例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td rowspan="2" style="padding: 8px; font-weight: bold; background-color: #fafafa;">年</td>
                            <td style="padding: 8px; text-align: center;">Y</td>
                            <td style="padding: 8px;">西暦4桁（例：2026）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center;">y</td>
                            <td style="padding: 8px;">西暦下2桁（例：26）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td rowspan="2" style="padding: 8px; font-weight: bold; background-color: #fafafa;">月</td>
                            <td style="padding: 8px; text-align: center;">m</td>
                            <td style="padding: 8px;">月（先頭に0がつく2桁。01〜12）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center;">n</td>
                            <td style="padding: 8px;">月（先頭に0がつかない1〜2桁。1〜12）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td rowspan="2" style="padding: 8px; font-weight: bold; background-color: #fafafa;">日</td>
                            <td style="padding: 8px; text-align: center;">d</td>
                            <td style="padding: 8px;">日（先頭に0がつく2桁。01〜31）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center;">j</td>
                            <td style="padding: 8px;">日（先頭に0がつかない1〜2桁。1〜31）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td rowspan="4" style="padding: 8px; font-weight: bold; background-color: #fafafa;">時</td>
                            <td style="padding: 8px; text-align: center;">H</td>
                            <td style="padding: 8px;">24時間表記：00〜23（2桁固定）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center;">h</td>
                            <td style="padding: 8px;">12時間表記：01〜12（2桁固定）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center;">G</td>
                            <td style="padding: 8px;">24時間表記：0〜23（0埋めなし）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center;">g</td>
                            <td style="padding: 8px;">12時間表記：1〜12（0埋めなし）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; font-weight: bold; background-color: #fafafa;">分</td>
                            <td style="padding: 8px; text-align: center;">i</td>
                            <td style="padding: 8px;">分：00〜59（2桁固定） <strong>※minuteのmではないので注意！</strong></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; font-weight: bold; background-color: #fafafa;">秒</td>
                            <td style="padding: 8px; text-align: center;">s</td>
                            <td style="padding: 8px;">秒：00〜59（2桁固定）</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; font-weight: bold; background-color: #fafafa;">曜日</td>
                            <td style="padding: 8px; text-align: center;">w</td>
                            <td style="padding: 8px;">曜日を数値で取得（0:日、1:月、2:火、3:水、4:木、5:金、6:土）</td>
                        </tr>
                    </tbody>
                </table>

                <div class="sub-heading"> 実践テクニックコード</div>
<pre><code>// 1. 基本的な日時表示
&lt;?php echo date("Y年m月d日 H時i分s秒"); ?&gt;

// 2. 配列と組み合わせた日本語の曜日表示
&lt;?php
$week = ["日", "月", "火", "水", "木", "金", "土"];
$w_num = date("w"); // 数値（0〜6）で出力される
echo "今日は" . $week[$w_num] . "曜日です"; // 文字列連結演算子「.」を使用
?&gt;

// 3. MySQLのdatetime型に合わせる場合（実務で頻出）
&lt;?php echo date("Y-m-d H:i:s"); ?&gt;</code></pre>
            </div>

            <!-- 6. データベース (MySQL / phpMyAdmin) -->
            <div class="note-section">
                <h3 class="note-title">6. データベース (MySQL / phpMyAdmin)</h3>
                <p>MySQL（データベース）の管理画面は今後非常によく使うため、ブラウザにお気に入り登録（ブックマーク）しておきましょう。</p>
                <p>💻 <strong>管理画面URL：</strong> <a href="http://localhost/phpmyadmin/" target="_blank">http://localhost/phpmyadmin/</a></p>
                
                <div class="sub-heading"> 管理画面メインメニューの機能解説</div>
                
                <p><strong>① 基本操作・管理グループ</strong></p>
                <ul>
                    <li><strong>データベース：</strong> 新しい「データ倉庫」を作成したり、一覧やデータサイズを確認するときに使います。</li>
                    <li><strong>SQL：</strong> 命令文（SQL文）を直接入力して実行できます。複雑なデータ検索やテストで使用します。</li>
                    <li><strong>ユーザアカウント：</strong> 接続ユーザーの追加や権限設定ができます。初期は最高権限の root ユーザーが登録されています。</li>
                </ul>

                <p><strong>② 保存・バックアップグループ</strong></p>
                <ul>
                    <li><strong>エクスポート：</strong> データを丸ごと .sql などのファイル形式でダウンロード保存（バックアップ）します。</li>
                    <li><strong>インポート：</strong> 手元にある .sql ファイルを読み込んでデータを復元させたり、外部のデータを取り込みます。</li>
                </ul>

                <p><strong>③ 設定・カスタマイズグループ</strong></p>
                <ul>
                    <li><strong>設定：</strong> phpMyAdmin自体のテーマ（見た目）や言語、表示件数を変更します。</li>
                    <li><strong>文字セット：</strong> 日本語や絵文字を正しく扱うための utf8mb4 など、文字化けを防ぐルールを確認できます。</li>
                </ul>

                <p><strong>④ 状態・システム監視グループ</strong> ※初期はほとんど使いません</p>
                <ul>
                    <li><strong>状態 (Status) / レプリケーション：</strong> アクセス件数の監視や、2つのデータベースを連動させて自動複製する設定を行います。</li>
                    <li><strong>変数 / エンジン / プラグイン：</strong> MySQLの上限値設定や、データ保存方式（安全重視の InnoDB など）の確認を行います。</li>
                </ul>
            </div>

            <!-- 🧠 復習ミニクイズ（全5問） -->
            <!-- 💡 quiz.cssのクラス指定に変更し、元の見栄えと開閉枠を完全再現しました -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. PHPで書かれたプログラム（.php）がブラウザに表示されるまでに、サーバー側で行われている挙動として正しいものは？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】サーバー側でファイル内のPHPブロックを実行し、その「実行結果（HTMLなど）」だけをブラウザへ送信している。</p>
                            <p style="margin-bottom: 0;">解説：ブラウザはPHPコードを直接解釈できません。サーバーが事前にプログラムを実行し、最終的な結果（テキストやHTMLタグ）だけをブラウザに返しています。ブラウザ側でソース表示をしても、PHPのコード自体は見えません。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. XAMPPを起動してPHPを動かす際、作成したPHPファイルは必ずどのフォルダの中に保存しなければならない？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】htdocs フォルダ（一般的なパスは C:\xampp\htdocs ）</p>
                            <p style="margin-bottom: 0;">解説：XAMPPにおいて、この htdocs フォルダが仮想Webサーバーの公開領域（ルートディレクトリ）として機能します。ここに保存したファイルにのみ、ブラウザから http://localhost/〜 でアクセスして実行できます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. PHPの date() 関数で「分」を取得したいとき、ダブルクォーテーション内に指定する正しいアルファベットは？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】i （小文字のアイ）</p>
                            <p style="margin-bottom: 0;">解説：最高に間違えやすいポイントです。「月」を意味するアルファベットが m (month) で既に使われているため、分（minute）には2文字目の i が割り当てられています。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. XAMPPの初期設定で、文字化け防止とタイムゾーンを日本時間（東京）に合わせるために編集したファイルの名称は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】php.ini （一般的なパスは C:\xampp\php\php.ini ）</p>
                            <p style="margin-bottom: 0;">解説：PHP全体の環境をカスタマイズするための最重要設定ファイルです。 mbstring.language = Japanese のコメント（分頭のセミコロン）を解除し、 date.timezone = "Asia/Tokyo" に書き換えて最適化しました。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. データベース管理画面（phpMyAdmin）において、既存データを丸ごと「.sql」形式で手元に保存（バックアップ）したい時に使用するメニューは？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】エクスポート (Export)</p>
                            <p style="margin-bottom: 0;">解説：データを外部へ書き出して保存する機能を「エクスポート」と呼びます。逆に、手元にあるバックアップファイルを読み込んでデータベースに復元・復旧させる機能は「インポート」と呼びます。</p>
                        </div>
                    </details>
                </div>
            </div> <!-- .quiz-container 終了 -->

        </main>

        <!-- 右側：共通更新履歴の呼び出し -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
