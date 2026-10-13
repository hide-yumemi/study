<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/17(金)の職業訓練授業ノート（CSS応用編）です。list-style-typeや疑似クラスnth-childの仕組み、aタグの4つの状態制御についてまとめています。">
    <title>CSSリストマーカーの制御・疑似クラス（nth-child）とリンクの4状態 | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./scl_style.css">
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（共通CSSの2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h2>7/17(金) 職業訓練授業ノート（CSS装飾編）</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">リストマーカーの詳細設定、特定の順番を狙い撃つ疑似クラス、インラインの部分装飾とaタグの状態制御</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">1. リストマーカーの変更・制御</h3>
                <p><code>&lt;ol&gt;</code> や <code>&lt;ul&gt;</code> の箇条書きマーク（リストマーカー）は、CSSプロパティで自由に形や画像、配置をコントロールできます 。</p>
                
                <div class="sub-heading">■ マーカーの種類を変更するプロパティ</div>
                <ul>
                    <li><strong><code>list-style-type</code>：</strong> CSSであらかじめ用意されているキーワードを指定して、マーカーの見た目を変更します 。</li>
                    <li><strong><code>list-style-image</code>：</strong> <code>url("画像のパス")</code> の形で、オリジナルの画像をマーカーとして表示させます 。</li>
                </ul>
                <p>※ 指定する場所は基本的に <code>&lt;li&gt;</code> ですが、配下のliすべてに一括適用させたい場合は、親要素である <code>&lt;ul&gt;</code> や <code>&lt;ol&gt;</code> に指定することも可能です 。</p>

                <div class="sub-heading">■ 主な設定値（値のキーワード）</div>
                <ul>
                    <li><strong>ul用（順不同記号）：</strong> <code>circle</code>（白丸）、<code>square</code>（塗りつぶしの四角）、<code>none</code>（マーカーを完全に消す） 。</li>
                    <li><strong>ol用（順序連番）：</strong> <code>decimal</code>（1, 2, 3... ※標準）、<code>lower-alpha</code>（小文字アルファベット：a, b, c...）、<code>upper-alpha</code>（大文字アルファベット：A, B, C...）、<code>hiragana</code>（ひらがな：あ, い, う...）、<code>upper-roman</code>（大文字ローマ数字：I, II, III...）など 。</li>
                </ul>

                <div class="sub-heading">■ マーカーの位置を制御するプロパティ</div>
                <p><strong><code>list-style-position</code>：</strong> マーカーを文字の箱の「内側」か「外側」のどちらに配置するかを指定します 。</p>
                <ul>
                    <li><code>outside</code>（標準）：マーカーを <code>&lt;li&gt;</code> の外側に配置する 。文章が2行になっても、2行目の頭が1文字目ときれいに縦に揃います。</li>
                    <li><code>inside</code>：マーカーを <code>&lt;li&gt;</code> の文字エリアの内側に配置する 。文章が2行になった際、2行目がマーカーの真下に回り込んで表示されます。</li>
                </ul>

                <div class="sub-heading">■ 大文字ローマ数字（<code>upper-roman</code>）の実装サンプル</div>
                <pre><code>ol { list-style-type: upper-roman; }</code></pre>
                <p>【実際の表示結果】</p>
                <ol class="sample-roman">
                    <li>このリストは upper-roman が適用されています 。</li>
                    <li>大文字のローマ数字で連番が出力されます 。</li>
                    <li>見た目はこのような表示になります 。</li>
                </ol>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">2. 疑似クラス：nth-child の活用</h3>
                <p>クラス名をいちいちタグに付けなくても、「上から◯番目の要素だけデザインを変えたい」という時に非常に強力な疑似クラスです 。</p>
                <ul>
                    <li><strong><code>li:nth-child(n)</code>：</strong> 先頭から数えて <strong>n番目</strong> の子要素を指定します 。</li>
                    <li><strong><code>li:nth-last-child(n)</code>：</strong> 末尾（一番最後）から逆算して <strong>n番目</strong> の子要素を指定します 。</li>
                    <li><strong><code>li:first-child</code>：</strong> 一番最初の最初の子要素を指定（ <code>:nth-child(1)</code> と同じ意味） 。</li>
                    <li><strong><code>li:last-child</code>：</strong> 一番最後の最後の子要素を指定 。</li>
                </ul>

                <div class="sub-heading">⚠️ 注意！タグが混在している場合のカウントの仕組み</div>
                <p><code>nth-child</code> は「何番目の子要素か」という**純粋な順番の数字だけで判断**します 。そのため、親要素の中に異なるタグ（h2やpなど）が混ざって並んでいる場合、タグの種類に関係なくカウントの順番が進む点に注意が必要です 。</p>
                <pre><code>&lt;section&gt;
  &lt;h2&gt;見出し&lt;/h2&gt;  &lt;!-- sectionの中の1番目の子要素 ➔ h2:nth-child(1) --&gt;
  &lt;p&gt;文章A&lt;/p&gt;    &lt;!-- sectionの中の2番目の子要素 ➔ p:nth-child(2) --&gt;
  &lt;p&gt;文章B&lt;/p&gt;    &lt;!-- sectionの中の3番目の子要素 ➔ p:nth-child(3) --&gt;
&lt;/section&gt;</code></pre>

                <div class="sub-heading">■ 計算式（ 変数 n ）を用いた高度な指定方法</div>
                <p>カッコの中に <code>n</code> を使った数式を入れると、規則性のある行に対して自動適用させることができます 。※ n は 0 以上の整数（0, 1, 2, 3...）が順番に代入されて自動計算されます 。</p>
                <ul>
                    <li><code>:nth-child(2n)</code> ➔ <strong>偶数番目</strong>（2, 4, 6, 8...番目）の要素すべてを指定 。表の行をストライプ模様にする時に必須です。</li>
                    <li><code>:nth-child(2n-1)</code> ➔ <strong>奇数番目</strong>（1, 3, 5, 7...番目）の要素すべてを指定 。</li>
                    <li><code>:nth-child(n+5)</code> ➔ <strong>5番目以降すべて</strong> の要素を指定 。</li>
                    <li><code>:nth-child(5-n)</code> ➔ <strong>1〜5番目まで</strong> の要素を指定 。</li>
                </ul>
            </div>
            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">3. &lt;span&gt; タグによる部分装飾</h3>
                <p>文章中の一部分だけに対して、HTMLタグとしての特別な意味（見出しや段落など）を持たせずに、スタイル（見た目や色）だけをピンポイントで変更したい場合に使用するインラインタグです 。</p>
                
                <div class="sub-heading">■ 実装例：リストマーカーを「青」、文字色を「赤」にするテクニック</div>
                <p>リストマーカーと文字の色を別々に分ける際、実務でも非常によく使われる定番の記述方法です 。</p>
                
                <p><strong>【HTML】</strong></p>
                <pre><code>&lt;ul&gt;
  &lt;li&gt;&lt;span&gt;テキストあ&lt;/span&gt;&lt;/li&gt;
  &lt;li&gt;&lt;span&gt;テキストい&lt;/span&gt;&lt;/li&gt;
  &lt;li&gt;&lt;span&gt;テキストう&lt;/span&gt;&lt;/li&gt;
&lt;/ul&gt;</code></pre>

                <p><strong>【CSS】</strong></p>
                <pre><code>/* まずリスト全体の文字（および連動するマーカー）を青に指定 */
li { color: blue; }

/* その上で、spanで囲んだ内側の文字だけを赤に上書きする */
li &gt; span { color: red; }</code></pre>

                <p>【実際の表示結果イメージ】</p>
                <ul style="padding-left: 20px; margin: 10px 0; color: blue; font-weight: bold;">
                    <li><span style="color: red;">テキストあ</span></li>
                    <li><span style="color: red;">テキストい</span></li>
                    <li><span style="color: red;">テキストう</span></li>
                </ul>
            </div>

            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">4. リンク（&lt;a&gt;タグ）の状態擬似クラス</h3>
                <p>主に <code>&lt;a&gt;</code> タグ（リンク）の各種状態（ユーザーのマウス操作など）に対応して、動的に見た目・デザインを変更するための非常に重要なお作法です 。</p>
                
                <div class="sub-heading">■ &lt;a&gt;タグが持つ4つの状態（記述する順番もこの通りにするルール）</div>
                <ol>
                    <li><strong><code>a:link { ... }</code> （未訪問）：</strong> まだ一度もクリックして訪れていない状態のリンクスタイル 。</li>
                    <li><strong><code>a:visited { ... }</code> （訪問済）：</strong> すでに一度でもクリックして閲覧したことがある状態のリンクスタイル 。</li>
                    <li><strong><code>a:hover { ... }</code> （マウスオーバー）：</strong> マウスカーソルがリンクの上に重なっている瞬間の状態 。</li>
                    <li><strong><code>a:active { ... }</code> （クリックした瞬間）：</strong> マウスのボタンを押し込んでいる（ダウン状態）瞬間の状態 。</li>
                </ol>
                
                <div class="info-box">
                    <p><strong>💡 <code>:hover</code> と <code>:active</code> の拡張性:</strong><br>
                    未訪問（link）や訪問済（visited）は <code>&lt;a&gt;</code> タグ専用ですが、<strong>マウスホバー（hover）とクリックの瞬間（active）の2つは、ボタン（button）やボックス（div）など、すべての要素に対して使用可能</strong>です 。</p>
                </div>
            </div>

            <!-- セクション5 -->
            <div class="note-section">
                <h3 class="note-title">5. テキストの飾り線（text-decoration）</h3>
                <p>文字に対して下線、上線、打ち消し線などの装飾ラインを引いたり、逆に消したりするプロパティです 。</p>
                
                <div class="sub-heading">■ 主な設定値（値のキーワード）</div>
                <ul>
                    <li><strong><code>none</code> ：</strong> 飾り線を一切表示しない 。<strong>リンク（aタグ）の標準の邪魔な下線を消したい時に必須</strong>となる、実務で一番よく使う値です 。</li>
                    <li><strong><code>underline</code> ：</strong> 文字のすぐ下に <span style="text-decoration: underline; font-weight: bold; color: #1e3a8a;">下線</span> を表示します 。</li>
                    <li><strong><code>line-through</code> ：</strong> 文字の中央を貫く <span style="text-decoration: line-through; font-weight: bold; color: #dc2626;">取り消し線（中央線）</span> を表示します 。</li>
                    <li><strong><code>overline</code> ：</strong> 文字のすぐ上に <span style="text-decoration: overline; font-weight: bold; color: #1e3a8a;">上線</span> を表示します 。</li>
                </ul>
                
                <div class="alert-box" style="background-color: #f1f5f9; border-left: 4px solid #64748b; color: #334155;">
                    💡 廃止された設定（blink）：<br>
                    昔は文字をチカチカと点滅させる <code>blink</code> という値が存在しましたが、ユーザーの視覚的負担が非常に大きくUI/UXの観点から優しくないため、現在は完全廃止されています（現代のブラウザでは動作しません） 。
                </div>
            </div>

        </main>

        <!-- 右側：更新履歴（共通パーツ history.php を呼び出し、右横並びにします） -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
