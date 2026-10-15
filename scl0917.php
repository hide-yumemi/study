<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/17(木)の職業訓練授業ノートです。クッキーの仕組み、定数(define/const)と動的取得、データ型の罠(8進数エラー)、ダブルとシングルの違い、ヒアドキュメントとNowdocの使い分けをまとめています。">
    <title>9/17(木)職業訓練授業：クッキー・定数・データ型の詳細とヒアドキュメント | ポートフォリオサイト</title>
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

            <h2>9/17(木)職業訓練授業</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">クッキーの仕組み・定数と動的取得・データ型の罠・複数行テキストの代入・型キャスト</p>

            <!-- 1. クッキー（Cookie）の仕組み -->
            <div class="note-section">
                <h3 class="note-title">1. クッキー（Cookie）の仕組み</h3>
                <p>ユーザーがWebサイトにアクセス（HTML等のファイルを要求）した際、サーバー側はユーザーの**ブラウザ（クライアント側）に「クッキー」という小さなテキスト情報を保存**させることができます。</p>
                <p>保存されたクッキーデータは、ユーザーが再度そのサーバーへアクセスする際、ブラウザからサーバー側へ自動的に送信されます。</p>

                <div class="sub-heading"> 主な利用シーン</div>
                <ul>
                    <li><strong>ログイン状態の保持：</strong> いちいち毎回IDやパスワードを入力しなくて済むようにする。</li>
                    <li><strong>ECサイトの閲覧履歴：</strong> 閲覧した商品やカートの情報を一時的に記憶し、関連する広告の表示やおすすめ商品（レコメンド）に活用する。</li>
                </ul>
            </div>
            <!-- 2. 定数の定義と取得方法 -->
            <div class="note-section">
                <h3 class="note-title">2. 定数の定義と取得方法</h3>
                <p>PHPで値を書き換えられない「定数」を定義する方法は2種類あります。現段階の学習のような名前空間（Namespace）を大きく使用しないプログラムにおいては、動作に違いはありません。</p>
                <ul>
                    <li><code>define('定数名', 値);</code> ： 古くから使われている手法。名前空間の影響を受けません。</li>
                    <li><code>const 定数名 = 値;</code> ： クラス内や名前空間の影響を受ける現代的な手法。定数名には変数のようにな $ は付けず、すべて大文字で書くのが一般的です。</li>
                </ul>

                <div class="sub-heading"> 便利な命令：constant()関数</div>
                <p>変数に代入されている「文字列」と同じ名前を持つ定数の値を、動的に取得する命令です。いわば<strong>「可変変数の定数版」</strong> と言えます。</p>
                <pre><code>&lt;?php
define('APP_NAME', 'マイシステム');
$target = 'APP_NAME'; // $targetの中身である文字列「APP_NAME」という定数の値を取得する
echo constant($target); // 出力結果: マイシステム
?&gt;</code></pre>

                <p><strong>💡 【深掘り解説】ページ移動（リダイレクト）と絶対パスの真相</strong></p>
                <p>PHPでページを強制移動させる際、内部では <code>header("Location: URL");</code> という命令を使用します。</p>
                <ul>
                    <li><strong>従来のルール（黒板の解説）：</strong> 古いHTTP/1.1の仕様では、Locationに指定するのは「 http:// から始まる絶対パス」と厳格に決まっていました。基本に忠実で最も安全な指定方法となります。</li>
                    <li><strong>現代のルール（AIの解説）：</strong> 現代の新しい仕様ではルールが緩和され、 /next.php のような相対パスでもブラウザ側が自動変換してくれるようになったため、開発現場では短い相対パスも多く使われます。</li>
                    <li><strong>$_SERVER と __DIR__ の組み合わせ：</strong> 「現在のフォルダ内にある別ページへの絶対URLを安全に自動計算する」ための非常に実務的なテクニックです。将来サイトのドメイン（URL）が変わっても、コードを書き直さずに自動で正しい移動先URLを組み立てられるメリットがあります。</li>
                </ul>
            </div>

            <!-- 3. 各種データ型の詳細と注意点 -->
            <div class="note-section">
                <h3 class="note-title">3. 各種データ型の詳細と注意点</h3>

                <div class="sub-heading"> ① 整数型（int型）</div>
                <p>PHPでは通常の10進数のほか、 0x から始まる16進数、 0b から始まる2進数、8進数などが扱えます。</p>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠ 【超重要】先頭が「0」の数値の罠</strong><br>
                    数値の先頭に「0」をつけると、PHPはそれを10進数ではなく<strong>「8進数」</strong> として認識してしまいます。そのため、桁数を揃えたい<strong>電話番号（090...）や郵便番号（001...）などは、必ずクォーテーションで囲んで「文字列」として扱う型設計</strong>にする必要があります。
                </p>
                <p><strong>💡 補足：PHP 8以降の8進数ルールの厳格化</strong></p>
                <ul>
                    <li>現在のPHP 8.1からは、明確に <strong>0o123</strong> （または大文字のO）から始める表記が導入・推奨されています。</li>
                    <li>PHP 8.0以降では、頭に0をつけただけの数値の中に、8進数で存在しない数字（8や9）を含めた記述（例： 08 や 09 ）をすると、即座に<strong>文法エラー（Parse error）</strong> になります。</li>
                </ul>
                <p>※表現できる整数の最大値を超えた場合、PHPは自動的に<strong>浮動小数点型（float型）へ自動キャスト（型変換）</strong> するため、システムがクラッシュすることはありません。</p>
                <p><strong>⚠ 実務向けの落とし穴（自動キャストの罠）：</strong> int型からfloat型に勝手に変わると、大きい整数の正確な値が保持できなくなり、計算結果や下一桁の数字が丸まってしまうことがあります。お金やIDを扱う実務では非常に注意が必要です。</p>

                <div class="sub-heading"> ② 浮動小数点型（float型）</div>
                <p>PHPでは、 e （10のべき乗）を使用した科学的表記法も使用できます（例： 1.2e3 は 1.2 * 10の3乗 = 1200 ）。</p>
                <ul>
                    <li>var_dump() を行うと画面には float と出力されます。</li>
                    <li><strong>内部方式の歴史：</strong> 現在のPHP内部は64bit向けのより高精度な方式（double）に変更されていますが、歴史的な名残で今でも「float型」と呼ばれ続けています。<strong>「中身はdouble、名前はfloat」</strong> と覚えておきましょう。</li>
                </ul>

                <div class="sub-heading"> ③ 文字列型（string型）</div>
                <p>文字列はシングルクォーテーション（ ' ）またはダブルクォーテーション（ " ）で囲みますが、処理に大きな違いがあります。</p>

                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px; text-align: left;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; width: 25%;">囲み記号</th>
                            <th style="padding: 10px; width: 35%;">処理の特徴</th>
                            <th style="padding: 10px;">動作の例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>シングル（ ' ）</strong></td>
                            <td style="padding: 10px;">中の文字をすべて「ただの文字」として認識。速度が僅かに速い。</td>
                            <td style="padding: 10px;">'Hello \n $name'<br>➔ そのまま画面に出力される</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>ダブル（ " ）</strong></td>
                            <td style="padding: 10px;">中の変数を値に展開し、エスケープシーケンス（\n の改行など）を処理する。</td>
                            <td style="padding: 10px;">"Hello \n $name"<br>➔ 改行され、変数の中身が展開される</td>
                        </tr>
                    </tbody>
                </table>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>⚠ 【重要】変数展開の最新ルール（PHP 8.2以降の変更点）</strong><br>
                    ダブルクォーテーション内で、変数名の区切りを明示するために波括弧 {} で囲むテクニックの書き方に注意が必要です。<br>
                    ❌ <strong>非推奨（将来廃止）：</strong> <code>"Hello ${name}!"</code> （ドルマークが外に出ている）<br>
                    ⭕ <strong>現代の推奨スタイル：</strong> <code>"Hello {$name}!"</code> （ドルマークも一緒に中に入れる）<br>
                    ドルマークが外に出ている古い書き方は、 <strong>PHP 8.2から非推奨（Deprecated）の警告</strong>が出るようになり、将来のPHP 9.0などで完全に削除されます。今後は必ずドルマークを中に入れる癖をつけましょう。
                </p>
            </div>

            <!-- 4. 複数行テキストの代入（ヒアドキュメント / Nowdoc） -->
            <div class="note-section">
                <h3 class="note-title">4. 複数行テキストの代入（ヒアドキュメント / Nowdoc）</h3>

                <div class="sub-heading"> ヒアドキュメント（ダブルクォーテーション指定と同じ扱い）</div>
                <p>改行のある複数行の文字列を、そのまま1つの変数に代入する時に使用します。</p>
                <pre><code>$text = &lt;&lt;&lt;EOD
1行目のテキスト（変数 $name も展開されます）
2行目のテキスト（"ダブルクォーテーション"もそのまま文字になります）
EOD;</code></pre>
                <ul>
                    <li>「EOD」などの識別子は半角英数字とアンダースコア（ _ ）が使えますが、変数と同じく数字から始めてはいけないルールがあります。</li>
                    <li>ヒアドキュメント内の改行コードは、記述しているファイルの環境（WindowsのCRLFか、LinuxのLFか）に依存してそのまま保存されます。</li>
                </ul>

                <div class="sub-heading"> Nowdoc（シングルクォーテーション指定と同じ扱い）</div>
                <p>ヒアドキュメントと同様に複数行を変数に代入できますが、 <strong>識別子をシングルクォーテーションで囲む</strong>のが特徴です。中に入力した変数は展開されず、そのまま文字として扱われます。</p>
                <pre><code>$text = &lt;&lt;&lt;'EOD'
ここでは $name と書いても変数展開されず、そのまま「$name」と出力されます。
EOD;</code></pre>

                <div class="sub-heading"> 改行コードとWebブラウザの表示（nl2br関数）</div>
                <p>ヒアドキュメントやNowdoc内の改行、あるいはHTMLの <code>&lt;textarea&gt;</code> でユーザーが入力した改行は、そのまま画面に出力してもブラウザ上では改行されません。</p>
                <p>この改行コードの直前に、ブラウザ表示用の <code>&lt;br /&gt;</code> タグを自動で挿入してくれる命令が <strong>nl2br() 関数</strong>です。</p>
            </div>
            <!-- 5. 型キャスト（自動変換と手動変換） -->
            <div class="note-section">
                <h3 class="note-title">5. 型キャスト（自動変換と手動変換）</h3>
                <p>PHPはJavaScriptと同様に、状況に応じて自動で型を変換する**自動キャスト（暗黙の型変換）** を行います。</p>
                <ul>
                    <li><strong>自動の例：</strong> 整数型の上限値を超えたら自動で浮動小数点型になる、緩い比較（ <code>==</code> ）のときに数値の 1 と文字列の '1' を同じと判定するなど。</li>
                    <li><strong>手動の例：</strong> 明示的に型を固定して処理したい、あるいはデータベースに書き込む直前に型を安全に揃えたい場合は、変数の前に <code>(int)</code> や <code>(string)</code> を記述することで、手動で強制的に型をキャストすることができます。</li>
                </ul>
            </div>

            <!-- 🧠 復習ミニクイズ（全5問） -->
            <div class="quiz-container">
                <h3 class="note-title" style="border-left-color: #1e3a8a;">🧠 復習ミニクイズ（全5問）</h3>
                <p style="margin-bottom: 25px;">今日学習した内容の重要ポイントをクイズで確認しましょう。クリックすると正解と解説が表示されます。</p>

                <!-- クイズ1 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q1. ユーザーのブラウザにデータを一時的に保存させ、ログイン状態の保持やECサイトの閲覧履歴の追跡などに利用される仕組みは？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 クッキー（Cookie）</p>
                            <p style="margin-bottom: 0;">解説： サーバー側から指示を出して、ユーザーのブラウザ（クライアント側）にデータを保存する仕組みです。ユーザーが同じサイトの別ページを開くたびに、このクッキー情報がサーバーへ自動送信されます。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ2 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q2. PHPで「090」のような電話番号や郵便番号を数値型（int型）としてそのままプログラムに記述してはいけない理由は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 先頭に「0」をつけた数値は、10進数ではなく「8進数」として認識されてしまうため。</p>
                            <p style="margin-bottom: 0;">解説： PHPのルールでは、先頭の「0」は8進数の合図になります。さらにPHP 8.0以降では 08 や 09 のように8進数に存在しない数字が混ざると即座に文法エラー（Parse error）になるため、これらは必ずクォーテーションで囲んで「文字列型（string型）」として扱う必要があります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ3 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q3. ダブルクォーテーション内で変数名を明示する際、PHP 8.2から非推奨（将来のバージョンで削除予定）となった書き方はどっち？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 "Hello ${name}" が非推奨</p>
                            <p style="margin-bottom: 0;">解説： ドルマークを波括弧 {} の外側に出す書き方は、現在のPHP 8.2から非推奨（Deprecated）の警告が出るようになりました。今後は "Hello {$name}" のように、ドルマークも一緒に中に入れるスタイルが必須となります。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ4 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q4. ヒアドキュメント（ &lt;&lt;&lt;EOD ）とNowdoc（ &lt;&lt;&lt;'EOD' ）の最大の違いは？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 中に書いた変数を「値に展開する（ヒアドキュメント）」か、「展開せずそのまま文字として扱う（Nowdoc）」か。</p>
                            <p style="margin-bottom: 0;">解説： ヒアドキュメントはダブルクォーテーションで囲んだときと同じ挙動をしますが、識別子をシングルクォーテーションで囲むNowdocは、シングルクォーテーション指定と同様に変数を展開せず、記述されたテキストをそのまま文字として処理します。</p>
                        </div>
                    </details>
                </div>

                <!-- クイズ5 -->
                <div class="quiz-box">
                    <p class="quiz-question">Q5. ヒアドキュメントや入力フォームの &lt;textarea&gt; 内にある「改行コード」を、Webブラウザの画面上で正しく改行させるために使用する関数は？</p>
                    <details class="quiz-details">
                        <summary>▶ 正解と解説を見る</summary>
                        <div class="quiz-answer-area">
                            <p class="quiz-correct-text">【正解】 nl2br() 関数</p>
                            <p style="margin-bottom: 0;">解説： プログラム上の改行コード（ \n など）は、ブラウザ上ではただの半角スペース扱いになってしまい画面が改行されません。 nl2br($変数) を通すことで、改行コードの直前にブラウザ表示用の &lt;br /&gt; タグを自動で挿入してくれます。</p>
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