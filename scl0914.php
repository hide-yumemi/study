<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/14(月)の職業訓練授業ノートです。フロントエンドカリキュラム最終日の総合自習として、制作物のリファクタリング、クロスブラウザ検証、ポートフォリオサイトの共通パーツ化(PHP化)完了ログをまとめています。">
    <title>9/14(月)職業訓練授業：フロントエンド開発集大成・総合リファクタリング演習（自習） | ポートフォリオサイト</title>
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
            <h2>9/14(月) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                【HTML / CSS / JavaScript カリキュラム最終日】<br>
                これまでに習得した知識の総まとめとして、個別制作物のブラッシュアップおよびポートフォリオのシステム構築を完了させる総合自習演習です。
            </p>

            <!-- セクション1：自習の目的と要件定義 -->
            <div class="note-section">
                <h3 class="note-title">1. カリキュラム総仕上げにおける自習要件</h3>
                <p>
                    220時間に及ぶフロントエンド言語の授業が本日で終了します。ただコードを書くだけの段階を卒業し、実務の現場を意識した**「公開可能なWebアプリケーション・サイトとしての品質向上」**を目的として、以下のブラッシュアップに注力しました。
                </p>
                <ul>
                    <li><strong>制作物のデバッグとリファクタリング：</strong> 自作した「万年カレンダー」や「スカッシュゲーム」の衝突判定バグの修正、前日のスライドショーのレスポンシブ座標ズレの修正を徹底的に行い、コードを洗練させる。</li>
                    <li><strong>クロスブラウザ検証（動作テスト）：</strong> PCだけでなくスマートフォン表示、ChromeやSafariなど異なるブラウザ環境でもレイアウトが絶対に崩れないか、当たり判定のズレがないかを検証する。</li>
                </ul>
            </div>

            <!-- セクション2：ポートフォリオのPHP・システム化構造 -->
            <div class="note-section">
                <h3 class="note-title">2. 自己解決ログ：ポートフォリオサイトのPHP共通パーツ化の完了</h3>
                <p>
                    本日の自習成果の最大の中核として、このポートフォリオサイト全体のシステム化（PHP構造への移行）を完全に完了させました。
                </p>
                <p>
                    日々増えていく大量の授業ノートをHTMLファイルのまま量産すると、ヘッダーのメニューリンクを1箇所書き換えるだけで全てのHTMLファイルを修正しなければならないという「運用の破綻」が目に見えていました。そこで、バックエンド（PHP）のインクルード命令を用いた設計へのリニューアルを断行しました。
                </p>
                
                <div class="sub-heading">📊 実装したシステム化の構造</div>
                <ul>
                    <li><strong><code>header.php</code> の分離・共通化：</strong> サイト全体の共通ナビゲーションメニューを一元管理。同一階層での <code>./〜</code> リンク運用に最適化し、ローカル環境（Live Server）とレンタルサーバー（InfinityFree）の双方で100%確実にリンク遷移できる強固なパスを確立。</li>
                    <li><strong><code>history.php</code> の分離・サイドナビ化：</strong> 更新履歴のパーツを外部ファイル化し、全ノートページから右側に2カラムとして呼び出せるレイアウトを構築。</li>
                    <li><strong><code>scl_style.css</code> の新設による追加デザイン一括統括：</strong> 各ノートページに散らばっていた個別の <code>&lt;style&gt;</code> タグ（角丸やフォームの設定など）をすべて排除し、1つの外部CSSファイルに完全集約・スリム化。</li>
                </ul>
            </div>

            <!-- セクション3：採用面接に向けた総括 -->
            <div class="note-section">
                <h3 class="note-title">3. 実務を意識した開発者としての今後の展望</h3>
                <p>
                    IT経験ゼロ（0）の状態からスタートしましたが、この自習日をもって、静的なHTML/CSSのレイアウトはもちろん、JavaScriptを用いた「イベント駆動型プログラミング（ゲーム開発、タイマー処理、DOM操作、高度な数理アルゴリズム計算）」までを自らロジックを組んで実装する基礎体力を体得しました。
                </p>
                <p>
                    明日からは、次段階のカリキュラムである**「データベース（MySQL）およびPHP（サーバーサイドバックエンド開発）」の208時間**が始まります。
                    <br>今後は、本日完成させたこのPHP共通化サイトの土台をベースにして、実際にデータベースからデータを引っ張ってきて動的に表示させる「真のWebアプリケーション」への拡張に向けて、さらなる自主学習とノートのアップデートを継続していきます。
                </p>
            </div>

        </main>


    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
