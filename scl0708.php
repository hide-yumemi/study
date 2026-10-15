<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/8(水)の職業訓練授業ノートです。ul/ol/dlの3種類のリストの使い分けと、img・figure・figcaptionタグを用いた正しい画像・参照データの扱い方についてまとめています。">
    <title>Webにおける3種類のリストと画像・参照データの扱い方 | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./scl_style.css">
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            <h2>7/8(水) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">Webサイト制作における3種類のリストの使い分けと、画像・参照データを意味づけするHTML設計</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">Webのリストは3種類ある</h3>
                <p>HTMLで箇条書きや項目一覧を表現するリストタグは3つの種類があり、用途によって厳格に使い分けます。</p>

                <div class="sub-heading">① <code>&lt;ul&gt;</code>（順不同リスト）</div>
                <p>並び順に意味を持たない、並列な箇取りのリストを表現します。子要素（中身）には必ず <code>&lt;li&gt;</code> 〜 <code>&lt;/li&gt;</code> を使用します。</p>
                <ul>
                    <li>サイト内の主要ページへのナビゲーションリンクの集まりは、このulリストを使って作成するのが世界基準です。</li>
                    <li>サイト上部に「TOP ＞ メニュー ＞ 各ページ」のように現在地を示す案内表示を<strong>「パンくずリスト」</strong>と呼び、これもulリストで構築します。</li>
                </ul>
                <pre><code>&lt;h1&gt;〇〇株式会社&lt;/h1&gt;
&lt;ul&gt;
  &lt;li&gt;&lt;a href="index.html"&gt;トップページ&lt;/a&gt;
  &lt;li&gt;&lt;a href="about.html"&gt;会社概要&lt;/a&gt;
  &lt;li&gt;&lt;a href="contact.html"&gt;お問い合わせ&lt;/a&gt;
&lt;/ul&gt;</code></pre>

                <div class="sub-heading">② <code>&lt;ol&gt;</code>（順序付きリスト）</div>
                <p>ランキングや作業手順など、「1. 2. 3...」や「A. B. C...」といった数字・記号の並び順（順序）に意味があるリストに使用します。子要素はulと同様に <code>&lt;li&gt;</code> です。</p>
                <ul>
                    <li><code>start属性</code> を使用することで、任意の数字からカウントを始めることができます（例: 5➔6➔7 など）。</li>
                    <li>記述例: <code>&lt;ol start="99"&gt;</code> と書くと、99番、100番、101番...というリストを作れます。</li>
                </ul>
                <pre><code>&lt;h1&gt;好きなアニメランキング&lt;/h1&gt;
&lt;ol&gt;
  &lt;li&gt;ハンターハンター&lt;/li&gt;
  &lt;li&gt;ドラゴンボール&lt;/li&gt;
  &lt;li&gt;NARUTO&lt;/li&gt;
&lt;/ol&gt;</code></pre>

                <div class="sub-heading">③ <code>&lt;dl&gt;</code>（説明・定義リスト）</div>
                <p>「項目・用語（ <code>&lt;dt&gt;</code> ）」と「その説明文・回答（ <code>&lt;dd&gt;</code> ）」をセットにして並べる特別なリストです。「Q&A（よくある質問）」や「会社概要のプロフィール欄（代表者名：〇〇 など）」に最適です。</p>
                <ul>
                    <li><code>&lt;dt&gt;</code> と <code>&lt;dd&gt;</code> の中には、複数の要素をひとまとめにする <code>&lt;div&gt;</code> などのブロック要素（フローコンテンツ）を組み込んで綺麗にレイアウトを囲うことも認められています。</li>
                </ul>
                <pre><code>&lt;h1&gt;Q&amp;A&lt;/h1&gt;
&lt;dl class="board-dl"&gt;
  &lt;dt&gt;質問：送料はかかりますか？&lt;/dt&gt;
  &lt;dd&gt;回答：送料は無料です。&lt;/dd&gt;
&lt;/dl&gt;</code></pre>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">画像や動画などのテキスト以外のコンテンツ</h3>
                <p>Webサイトに画像を埋め込む際、その画像が「ただの飾り（装飾）」なのか「本文の一部（重要な参照データ）」なのかでマークアップを切り替えます。</p>

                <div class="sub-heading">■ <code>&lt;img&gt;</code> 単体での配置</div>
                <p><code>&lt;img src="画像の場所" alt="説明文" width="幅" height="height"&gt;</code></p>
                <ul>
                    <li>主にデザインの一部やバナー広告など、本文から直接参照されない単体の画像として扱います。</li>
                    <li>HTML上では、画像は「巨大な1つの文字」として認識されます。</li>
                    <li><strong><code>src</code> 属性：</strong> 画像ファイルが置いてある場所を示すパスを記述。</li>
                    <li><strong><code>alt</code> 属性：</strong> 画像の内容を説明する文字。音声読み上げソフトや、電波が悪くて画像が表示できない場合の代替テキストになります。</li>
                    <li><strong><code>width</code> / <code>height</code> 属性：</strong> 画像の横幅と高さをピクセル単位で指定します。</li>
                </ul>

                <div class="sub-heading">■ <code>&lt;figure&gt;</code> と <code>&lt;figcaption&gt;</code> による意味づけ</div>
                <p>教科書に出てくる「図1」や「参考写真」のように、本文から直接「下のデータ画像にある通り〜」と言言及・参照される重要なビジュアルコンテンツを表現する時に使用します。</p>
                <ul>
                    <li>参照用の独立したかたまりであることを示すため、全体を <code>&lt;figure&gt;</code> タグで囲います。</li>
                    <li><code>alt</code> 属性とは別に、画像の下（または上）に <code>&lt;figcaption&gt;</code> タグを用いて、図の正式な説明文（キャプション）を付け足すのが原則的なルールです。</li>
                </ul>

                <figure class="board-figure">
                    <img src="img/img7.jpg" alt="売上グラフデータ">
                    <figcaption class="board-figcaption">会社の売上に関したデータです</figcaption>
                </figure>
            </div>

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>