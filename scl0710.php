<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/10(金)の職業訓練授業ノートです。headerやmainなどのセクション系タグによる正しい文書構造、引用タグ、およびテキストレベルセマンティクスについてまとめています。">
    <title>HTML5のセクション構造とテキストの意味づけ・特殊文字 | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./scl_style.css">

</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（共通CSSの2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h2>7/10(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">セクション系タグを使った正しいブロック作成、各種引用タグ、およびテキストの意味・用途に応じた使い分け</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">セクション系のタグで意味のあるブロックを作成</h3>
                <p>HTML5では、ただ画面に文字を表示するだけでなく、検索エンジンや支援技術に「ここがどういう意味のブロックか」を正確に伝えるため、適切なセクションタグで中身を囲う必要があります。</p>

                <div class="sub-heading">■ 主要なレイアウト要素</div>
                <ul>
                    <li><strong><code>&lt;header&gt;</code>：</strong> ページ上部のサイト名やロゴ、メインメニュー等が含まれる部分。<code>&lt;nav&gt;</code> を子要素として内包することもある。</li>
                    <li><strong><code>&lt;nav&gt;</code>：</strong> 主要なナビゲーションセクション（メニューリスト等）であることを示す。</li>
                    <li><strong><code>&lt;main&gt;</code>：</strong> ページの主要なオリジナルコンテンツ部を示す。原則1ページに1つだけ配置する。</li>
                    <li><strong><code>&lt;footer&gt;</code>：</strong> サイト最下部のコピーライトやサイトマップを中心としたエリア。</li>
                    <li><strong><code>&lt;article&gt;</code>：</strong> 独立した記事やブログ、ニュースなど、そこ単体で完結しているコンテンツに使用する。</li>
                    <li><strong><code>&lt;aside&gt;</code>：</strong> メインコンテンツから外れた補足情報やサイドバー、主にバナー広告エリアなどに使用する。</li>
                </ul>

                <div class="sub-heading">💡 <code>&lt;main&gt;</code> と <code>&lt;section&gt;</code> の基本ルール</div>
                <p>1つのページ内に複数の異なるトピック（章や段落）がある場合は、各々を <code>&lt;section&gt;</code> タグでセクション分けを行います。<strong>「1つのsectionタグに対し、1つの見出し（h2〜h6）が付く」</strong> のがマークアップの基本です。</p>

                <div class="sub-heading">💡 <code>body</code> 全体の幅を制限しない設計（wrapperの概念）</div>
                <p>「サイト全体の表示幅に上限（例: 1200pxなど）を持たせたい」場合、<code>&lt;body&gt;</code> タグ自体に幅（width）を直接指定することは推奨されません。ヘッダーの背景や背景色を画面横いっぱいに広げつつ、中身だけを中央寄せにするため、代わりに <code>&lt;div id="wrapper"&gt;</code> などの包み込む箱を用意して幅を制御するのが一般的です。</p>
                <pre><code>&lt;body&gt;
  &lt;div id="wrapper"&gt; &lt;!-- 全体を包む箱 --&gt;
    &lt;header&gt;
      &lt;nav&gt;メニュー&lt;/nav&gt;
    &lt;/header&gt;
    &lt;main&gt;メイン中身&lt;/main&gt;
    &lt;footer&gt;フッター&lt;/footer&gt;
  &lt;/div&gt;
&lt;/body&gt;</code></pre>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">引用を行う時に使用するタグ</h3>
                <p>他サイトや書籍などの文章を自分のWebサイトに掲載（引用）する場合は、引用の規模や文脈に応じて3つのタグを使い分けます。</p>

                <ul>
                    <li><strong><code>&lt;cite&gt;</code>：</strong> 引用元の「作品タイトル」や「書籍名・サイト名」を示すために、文の一部に対して指定する。ブラウザ上では文字が斜体（イタリック体）になる。</li>
                    <li><strong><code>&lt;q&gt;</code>：</strong> 文章内のひとかたまり（インライン）として短い引用文を挿入するときに使用する。<code>lang="ja"</code> 属性がついている場合、その国の言語に合わせた引用記号（日本語なら「」カギカッコ）が自動で付与される。</li>
                    <li><strong><code>&lt;blockquote&gt;</code>：</strong> 1つ以上の段落を丸ごとまとめて、大きなブロックとして引用するときに使用する。セクション系のタグとして扱われ、ブラウザ上では左側にインント（字下げ余白）が空いて表示される。</li>
                </ul>
            </div>
            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">テキストレベルセマンティクス（文字の意味づけ）</h3>
                <p>ブラウザの表示上はどれも同じ「太字」や「斜体」に見えても、SEO（検索エンジン対策）や音声読み上げにおいてそれぞれ異なる明確な意味（セマンティクス）を持っています。</p>

                <div class="sub-heading">■ 重要性・強調を表すタグ</div>
                <ul>
                    <li><strong><code>&lt;strong&gt;</code>：</strong> 文や単語に**重要性、緊急性、あるいは深刻であること**を示す。SEO評価に関係する。<br>
                        <span class="sample-badge">見え方</span> <strong>strong（太字）</strong>
                    </li>

                    <li><strong><code>&lt;b&gt;</code>：</strong> 特別な重要性や強調の意味は持たない。SEO評価にも関連せず、単にテキストの中でキーワードや製品名などを**視覚的に目立たせたい場合**に使う。<br>
                        <span class="sample-badge">見え方</span> <b>b（太字）</b>
                    </li>

                    <li><strong><code>&lt;em&gt;</code>：</strong> **強調する語句**に使う。ブラウザ上ではイタリック体（斜体）になり、音声読み上げソフトではこの部分が強調されて読まれることが多い。<br>
                        <span class="sample-badge">見え方</span> <em>em（斜体）</em>
                    </li>

                    <li><strong><code>&lt;i&gt;</code>：</strong> SEO評価には関連しない。通常の文章とは異なる口調や、**外来語・専門用語・書名など**の一部分を区別してイタリック体にする際に使用する。<br>
                        <span class="sample-badge">見え方</span> <i>i（斜体）</i>
                    </li>
                </ul>

                <div class="sub-heading">■ 変更履歴・修正を表すタグ</div>
                <ul>
                    <li><strong><code>&lt;del&gt;</code>：</strong> 文書から物理的・論理的に**削除（delete）されたテキスト**であることを示す。打ち消し線が入る。<br>
                        <span class="sample-badge">見え方</span> <del>del（打ち消し線）</del>
                    </li>

                    <li><strong><code>&lt;ins&gt;</code>：</strong> 挿入（insert）の略で、文書に**新しく追加・挿入されたテキスト**であることを示す。下線が入る。<br>
                        <span class="sample-badge">見え方</span> <ins>ins（下線）</ins>
                    </li>

                    <li><strong><code>&lt;s&gt;</code>：</strong> 現在は内容が変更されて**古い情報（無効な情報）になったこと**を示す。文書の誤りを修正する目的には使わず、新旧の価格表記（例：旧価格<s>200円</s>から新価格300円へ）などで <code>&lt;ins&gt;</code> と組み合わせて使うことが多い。<br>
                        <span class="sample-badge">見え方</span> <s>s（打ち消し線）</s>
                    </li>
                </ul>

                <div class="sub-heading">■ 数式・化学式などを表すタグ</div>
                <ul>
                    <li><strong><code>&lt;sup&gt;</code>：</strong> 上付き文字（Superscript）を意味する。囲んだテキストを通常の文字より小さく、少し高い位置に表示する（例：2乗の表現など）。<br>
                        <span class="sample-badge">見え方</span> 2x<sup>2</sup>
                    </li>

                    <li><strong><code>&lt;sub&gt;</code>：</strong> 下付き文字（Subscript）を意味する。囲んだテキストを通常の文字より小さく、少し低い位置に表示する（例：化学式など）。<br>
                        <span class="sample-badge">見え方</span> H<sub>2</sub>O
                    </li>
                </ul>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">特殊文字・実体参照とその他の設定</h3>
                <p>HTMLのコード内で <code>&lt;</code> や <code>&gt;</code>、<code>&amp;</code> などの記号をそのまま書くと、ブラウザが「HTMLタグの開始・終了」や「プログラムコードの始まり」と誤認して画面が崩れる原因になります。そのため、記号を表示させたい場合は以下の**「特殊文字（文字実体参照）」**を使って入力します。</p>

                <table class="lesson-table">
                    <thead>
                        <tr>
                            <th style="width: 120px; text-align: center;">画面の表示</th>
                            <th>HTMLでの記述方法（実体参照コード）</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&amp;</td>
                            <td><code>&amp;amp;</code> （アンパサンド記号）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&lt;</td>
                            <td><code>&amp;lt;</code> （小なり記号 / Less Than）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&gt;</td>
                            <td><code>&amp;gt;</code> （大なり記号 / Greater Than）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&quot;</td>
                            <td><code>&amp;quot;</code> （ダブルクォーテーション）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&copy;</td>
                            <td><code>&amp;copy;</code> （コピーライト・著作権マーク）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&reg;</td>
                            <td><code>&amp;reg;</code> （登録商標マーク / <sup>®</sup>）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">&trade;</td>
                            <td><code>&amp;trade;</code> （商標マーク / ™）</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">（半角スペース）</td>
                            <td><code>&amp;nbsp;</code> （Non-Breaking Space。HTML内での連続したスペースの空白潰れを防ぎます）</td>
                        </tr>
                    </tbody>
                </table>

                <div class="sub-heading" style="margin-top: 25px;">■ その他の便利なタグ・記号</div>
                <ul>
                    <li><strong><code>&lt;mark&gt;</code>（マーカー表示）：</strong> サイト内の検索結果画面などで、指定したキーワードを蛍光ペンのように **<mark>マーク</mark>** して目立たせるタグ。</li>
                    <li><strong><code>&lt;hr&gt;</code>（区切り線）：</strong> コンテンツの話題転換（区切り）として使用する、閉じタグのない「空要素」。</li>
                </ul>

                <p style="margin-top: 15px; font-size: 14px; color: #b91c1c; background-color: #fff1f2; padding: 12px; border-radius: 6px; border-left: 4px solid #f43f5e; font-weight: bold;">
                    ⚠️ 注意点：現代のWebコーディングでは、「画面上の見た目が同じになるタグ（bとstrong、iとemなど）」が複数存在します。これらは単なる見た目ではなく、必ず「コードの持つ意味や用途（セマンティクス）」に合わせて正しいタグを厳格に選択しましょう。
                </p>
            </div>

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>