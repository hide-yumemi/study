<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="このページは授業で学習したdatabaseとphpをメインとした授業一覧のページです。実際の授業の内容を私的にまとめた物と、動作チェックを含めたソースコード、実際の出力結果デモ画面をそのまま載せてます。">
    <title>授業 database / php | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <main class="main-content">
            <h2>授業 database / php</h2>
            <p>日付：学校のスケジュールに合わせている為、休校などは飛ばしてます。</p>
            <p>授業内容まとめ：日付ノートを元に、AIを活用しつつ補足をいれながらマークアップしたものです。</p>
            <p>ノート：学校でのホワイトボードの記述・VScode内での記述を乗せております。（個人的なメモも載せてます）
            <p>動作確認：phpはコードが隠れてしまう為,必要に応じて生コードを見せたりプログラムの動作確認を行います</p>
            <table class="lesson-table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>授業内容まとめ</th>
                        <th>ノート</th>
                        <th>動作確認</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-date">09/15</td>
                        <td><a href="scl0915.php" class="td-link">XAMPP環境構築とdate関数応用</a></td>
                        <td><a href="scl0915_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0915_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/16</td>
                        <td><a href="scl0916.php" class="td-link">変数・乱数・データ型とエラー深刻度</a></td>
                        <td><a href="scl0916_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0916_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/17</td>
                        <td><a href="scl0917.php" class="td-link">クッキー・定数とヒアドキュメント</a></td>
                        <td><a href="scl0917_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0917_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/24</td>
                        <td><a href="scl0924.php" class="td-link">文字列連結の罠と配列の高度な操作</a></td>
                        <td><a href="scl0924_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0924_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <!-- 24.25は同一ファイルで使用したのでリンクが一部同じである。 -->
                    <tr>
                        <td class="td-date">09/25</td>
                        <td><a href="scl0925.php" class="td-link">代替構文（コロン構文）とswitch文</a></td>
                        <td><a href="scl0924_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0924_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/28</td>
                        <td><a href="scl0928.php" class="td-link">関数の引数設定・型指定と可変関数</a></td>
                        <td><a href="scl0928_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0928_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/29</td>
                        <td><a href="scl0929.php" class="td-link">スーパーグローバル変数とセキュリティ対策</a></td>
                        <td><a href="scl0929_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0929_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/30</td>
                        <td><a href="scl0930.php" class="td-link">選択系コントロールの処理とテキストエリア改行制御</a></td>
                        <td><a href="scl0930_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl0930_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">09/30</td>
                        <td><a href="scl0930_kadai.php" class="td-link">課題：送受信入力フォームの作成</a></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/02</td>
                        <td><a href="scl0930_kadai_Anser.php" class="td-link">課題の解答</a></td>
                        <td></td>
                        <td><a href="scl0930_kadai_Anser_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/02</td>
                        <td><a href="scl1002.php" class="td-link">$_FILESによるファイルアップロードとサーバー側ファイル操作</a></td>
                        <td><a href="scl1002_lecture.php" target="_blank" class="td-link">授業の記述</a></td>
                        <td>座学のみ</td>
                    </tr>
                    <tr>
                        <td class="td-date">10/05</td>
                        <td><a href="scl1005.php" class="td-link">$_FILESによるファイルアップロード技術</a></td>
                        <td><a href="scl1005.txt" class="td-link" target="_blank" class="td-link">授業の記述</a></td>
                        <td><a href="scl1005_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/06</td>
                        <td><a href="scl1006.php" class="td-link">入力フォームとファイル受信処理・フラグ管理技術</a></td>
                        <td><a href="scl1006.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl1006_run.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/07</td>
                        <td>
                            <a href="scl1007.php" class="td-link">⓵【教材解説】phpMyAdmin操作など</a>
                            （準備必須：<a href="oneline_bbs.zip" download class="td-link">先生の用意した教材</a>）
                        </td>
                        <td><a href="scl1007.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="./oneline_bbs/bbs.php" class="td-link">動作確認</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/08</td>
                        <td><a href="scl1008.php" class="td-link">⓶【教材bbs】MySQLデータベースの基礎とphpMyAdmin操作技術</a></td>
                        <td><a href="scl1008.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl_bbs_code.php" class="td-link">bbsコード</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/09</td>
                        <td><a href="scl1009.php" class="td-link">⓷【教材bbs】MySQLi接続とプリペアドステートメント（書き込み・挿入編）</a></td>
                        <td><a href="scl1009.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl_bbs_code.php" class="td-link">bbsコード</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/13</td>
                        <td><a href="scl1013.php" class="td-link">⓸【教材bbs2】SELECT文によるデータ全件取得とあいまい検索・ソート処理</a></td>
                        <td><a href="scl1013.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl_bbs2_code.php" class="td-link">bbs2コード</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/14</td>
                        <td style="text-align: left; padding-left: 15px;">講師お休みの為、特別授業でグルーピング。プログラムの楽しさを伝えるには？</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/16</td>
                        <td><a href="scl1016.php" class="td-link">⓹【教材bb2】PDO拡張機能の導入とtry-catch例外処理・静的接続のセキュリティ</a></td>
                        <td><a href="scl1016.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl_bbs2_code.php" class="td-link">bbs2コード</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/19</td>
                        <td><a href="scl1019.php" class="td-link">PDOでのデータ取得と掲示板拡張準備</a></td>
                        <td><a href="scl1019.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="" class="td-link"></a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/20</td>
                        <td>課題：ひとこと掲示板（bbs/bbs2）に写真投稿を拡張の実施</a></td>
                        <td><a href="scl1020.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl1020_run.php" class="td-link">写真bbs2</a></td>
                    </tr>
                    <tr>
                        <td class="td-date">10/21</td>
                        <td><a href="scl1021.php" class="td-link"></a></td>
                        <td><a href="scl1021.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td><a href="scl1021_seiki_code.php" class="td-link">教材生コード</a></td>
                    </tr>
                    <tr>
                        <td class=" td-date">10/22</td>
                        <td><a href="scl1022.php" class="td-link"></a></td>
                        <td><a href="scl1022.txt" class="td-link" target="_blank">ホワイトボード</a></td>
                        <td>教材</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>

</html>