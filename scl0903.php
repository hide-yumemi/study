<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/3(木)の職業訓練授業ノートです。自作万年カレンダー課題の答え合わせと、先生の解答例から学ぶコードの最適化（リファクタリング）、実務におけるバグを減らす設計手法をまとめています。">
    <title>9/3(木)職業訓練授業：万年カレンダー課題の解答解説とコード最適化レビュー | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            <h2>9/3(木) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                万年カレンダー制作課題の総仕上げ。自身のロジックと先生の洗練された解答例を比較し、実務に耐えうる「堅牢で美しいコード」へのアプローチを学びます。
            </p>

            <!-- セクション1：課題レビューと先生の解答例へのアクセス -->
            <div class="note-section">
                <h3 class="note-title">1. 万年カレンダー課題の解答解説レビュー</h3>
                <p>
                    2日間にわたり設計・実装を進めてきた「2026年以降の万年カレンダー作成課題」が終了し、本日は先生による模範解答のコードレビューが行われました。
                </p>
                <p>
                    プログラムは「動けば合格」ではなく、後からの仕様変更に耐えられるか（メンテナンス性）、誰が見ても理解しやすいか（可読性）が重要視されます。授業内で提示された洗練されたプログラムソースは、以下の特設リンクより直接コードの検証・確認が可能です。
                </p>
                
                <div style="margin: 20px 0;">
                    <a href="./mannen/mannen.html" target="_blank" class="td-link" style="font-size: 16px; font-weight: bold; background-color: #f1f5f9; padding: 12px 20px; border-radius: 8px; border: 1px solid #cbd5e1; display: inline-block;">
                        👉 講師の解答例・実技検証コードはこちら
                    </a>
                </div>
            </div>

            <!-- セクション2：解答例から学ぶプロの設計思想 -->
            <div class="note-section">
                <h3 class="note-title">2. 模範解答から紐解くコード最適化（リファクタリング）のポイント</h3>
                <p>
                    我々受講生が力技で書きがちな長い条件分岐（<code>if-else</code> の連続）に対し、先生のコードは驚くほどシンプルに整理されていました。特に実務で役立つ設計思想は以下の通りです。
                </p>
                
                <div class="sub-heading">① マジックナンバーを排除したデータ設計（配列の活用）</div>
                <p>
                    各月の末日（31日や30日）を変数やif文で個別に管理するのではなく、<code>const monthDays = [31, 28, 31, 30, ...];</code> のように一連の配列データとして最初から定義しておくことで、<code>monthDays[month - 1]</code> というわずか1行の指定で対象月の末日をダイレクトに引き出す手法が解説されました。これにより、コードの行数が劇的に削減されます。
                </p>

                <div class="sub-heading">② 2重ループによるテーブル出力の安全性</div>
                <p>
                    カレンダーの縦（週＝行）と横（曜日＝列）を制御する2重の <code>for</code> 文において、日付カウンターが対象月の末日を超えた瞬間に <code>&lt;td&gt;&lt;/td&gt;</code>（空枠）を出力させ、次の行のループ処理を適切に <code>break</code> させる境界値処理の美しさは、無限ループバグを未然に防ぐプロならではの堅牢な書き方でした。
                </p>
            </div>

            <!-- セクション3：実務で必須となる「エラーハンドリング」 -->
            <div class="note-section">
                <h3 class="note-title">3. 実務で差がつく例外処理（エラーハンドリング）の重要性</h3>
                <p>
                    自習段階では見落としがちですが、ユーザーは開発者が想定していない操作を必ず行います。先生の解説では、プログラムのクラッシュ（停止）を防ぐための「防衛コード（バリデーション）」の重要性が強調されました。
                </p>
                <ul>
                    <li><strong>空欄・文字列の入力拒否：</strong> 年月の入力欄に文字（あ、abcなど）が入力されたり、空欄のままボタンが押された場合、計算を即座に中断（<code>return;</code>）し、ユーザーに警告を促す処理。</li>
                    <li><strong>範囲外データの制御：</strong> 今回の要件である「2026年以降」に反して「2025」や「-50」などの不正な数値が入力された際、計算を走らせずにエラーメッセージを画面に出力する安全設計。</li>
                </ul>
                <p style="margin-top: 15px; font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
                    <strong>🔍 ポートフォリオとしての魅せ方（自己考察）</strong><br>
                    万年カレンダーのロジックを1から組み立てた経験、そして「先生の模範解答を分析して自身のコードを洗練させる（リファクタリングを行う）」というプロセスをノートに記録しておくことは、面接において「客観的に自分のコードを見直し、技術力を向上させる自走力がある」という強烈なアピール材料になります。
                </p>
            </div>

        </main>


    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
