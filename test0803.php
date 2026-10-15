<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="職業訓練の「JavaScriptの基本制御」に向けた、HTMLタグおよびCSSプロパティの基礎知識に関する第2回小テストの復習・解答解説ページです。">
    <title>小テスト2回目 復習用問題集 | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ==========================================================================
           小テストページ専用の追加デザイン（CSS）
           ========================================================================== */
        
        /* 各分野・問い（大きな見出し）の調整 */
        .main-content h2 {
            margin-top: 40px;
            color: #1e3a8a;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 5px;
            font-size: 18px;
        }
        .main-content h2:first-of-type {
            margin-top: 20px;
        }

        /* 問題の指示文・例題ボックス */
        .example-box {
            background-color: #f8fafc;
            border-left: 4px solid #1e3a8a;
            padding: 15px;
            font-size: 14px;
            color: #334155;
            line-height: 1.6;
            margin: 15px 0;
            border-radius: 0 8px 8px 0;
        }

        /* 各問題のブロック */
        .question-block {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        /* 問題文のテキスト */
        .question-text {
            font-weight: bold;
            font-size: 15px;
            color: #1e293b;
        }

        /* 解答・解説アコーディオン（details）の装飾 */
        details {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 15px;
            background-color: #fdfdfd;
        }
        summary {
            padding: 12px 15px;
            font-weight: bold;
            color: #1e3a8a;
            cursor: pointer;
            background-color: #f1f5f9;
            transition: background 0.2s;
            outline: none;
            user-select: none;
        }
        summary:hover {
            background-color: #e2e8f0;
        }
        .answer-content {
            padding: 20px;
            border-top: 1px solid #cbd5e1;
            background-color: #ffffff;
        }

        /* 【答え】のバッジ装飾 */
        .ans-title {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin-right: 5px;
        }
        
        /* 答えの中のプログラムコード（code）の見栄え調整 */
        .answer-content code {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 3px 8px;
            border-radius: 4px;
            font-family: Consolas, Monaco, 'Andale Mono', monospace;
            font-weight: bold;
            font-size: 15px;
        }

        /* 【解説】のバッジ装飾 */
        .exp-title {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin-right: 5px;
            margin-top: 12px;
        }
        .exp-text {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin-top: 5px;
        }
        .exp-text code {
            background-color: #f1f5f9;
            color: #334155;
            padding: 2px 5px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h1 style="font-size: 22px; color: #1e3a8a; margin-bottom: 5px;">小テスト2回目</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">復習用問題集（JavaScriptの基本制御に関連するHTML/CSS基礎）</p>

            <!-- ========================================== -->
            <!-- 【分野：Javascriptの基本制御】 問1 HTMLタグ -->
            <!-- ========================================== -->
            <h2>【分野：Javascriptの基本制御】 問1. 次のHTMLタグを記述しなさい。</h2>
            <div class="example-box">
                ※問題の指示：タグの名前のみで正解とし、属性や閉じタグは書かなくていいものとする。<br>
                （例題）大見出し（見出し1）を示すタグ ➔ <strong>解答：<code>h1</code></strong> もしくは <code>&lt;h1&gt;</code>
            </div>

            <!-- Q1 -->
            <div class="question-block">
                <div class="question-text">① 文字コードやページ説明文などを設定するタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>meta</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">ページのメタ情報（文字コード指定 <code>&lt;meta charset="UTF-8"&gt;</code> や検索エンジン向けの記述など）を指定する際に使用します。</p>
                    </div>
                </details>
            </div>

            <!-- Q2 -->
            <div class="question-block">
                <div class="question-text">② 画像を貼るタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>img</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">文脈に画像を埋め込むためのタグです。必須属性として <code>src</code>（画像のパス）や <code>alt</code>（代替テキスト）を持ちます。</p>
                    </div>
                </details>
            </div>

            <!-- Q3 -->
            <div class="question-block">
                <div class="question-text">③ 段落であることを示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>p</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Paragraph（段落）の略です。文章のひとかたまりを表現するときに最も頻繁に使われます。</p>
                    </div>
                </details>
            </div>

            <!-- Q4 -->
            <div class="question-block">
                <div class="question-text">④ ページ内リンクや他サイトへのリンクを設定するタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>a</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Anchor（アンカー）の略です。<code>href</code> 属性にリンク先のURLやパーツのIDを指定して使用します。</p>
                    </div>
                </details>
            </div>

            <!-- Q5 -->
            <div class="question-block">
                <div class="question-text">⑤ ナビゲーションセクションを指定するタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>nav</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Navigationの略です。主要なナビゲーション（メニュー等）のリンクグループであることを検索エンジンや支援技術に伝えます。</p>
                    </div>
                </details>
            </div>

            <!-- Q6 -->
            <div class="question-block">
                <div class="question-text">⑥ バナー広告などサイトの内容と関係ないエリアを指定するタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">//答え】</span> <code>aside</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">本文（メインコンテンツ）とは余談・補足的な関係にある、サイドバーや広告のセクションを囲むために使用します。</p>
                    </div>
                </details>
            </div>

            <!-- Q7 -->
            <div class="question-block">
                <div class="question-text">⑦ 参考図表であることを示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>figure</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">写真、イラスト、図表、コードブロックなど、本文から参照される自己完結したコンテンツを表現します。キャプションをつける <code>figcaption</code> とよくセットで使われます。</p>
                    </div>
                </details>
            </div>

            <!-- Q8 -->
            <div class="question-block">
                <div class="question-text">⑧ 箇条書きリストを示すタグ</div>
                <details>
                    <summary>解答・を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>ul</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Unordered List（順序のないリスト）の略です。箇条書きの項目を <code>&lt;li&gt;</code> で囲んで並べます。</p>
                    </div>
                </details>
            </div>

            <!-- Q9 -->
            <div class="question-block">
                <div class="question-text">⑨ 順序付きリストを示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>ol</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Ordered List（順序のあるリスト）の略です。自動的に「1. 2. 3...」と数字の連番がつく箇条書きを表現します。</p>
                    </div>
                </details>
            </div>

            <!-- Q10 -->
            <div class="question-block">
                <div class="question-text">⑩ 説明リストを示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>dl</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Description List（定義・説明リスト）の略です。名前（<code>&lt;dt&gt;</code>）と、その値・説明（<code>&lt;dd&gt;</code>）のセットを表現します。</p>
                    </div>
                </details>
            </div>

            <!-- Q11 -->
            <div class="question-block">
                <div class="question-text">⑪ 表を作成するときに1行を示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>tr</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Table Row（表の行）の略です。テーブルの中で横一行分のデータを定義します。</p>
                    </div>
                </details>
            </div>

            <!-- Q12 -->
            <div class="question-block">
                <div class="question-text">⑫ 表のキャプションを示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>caption</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text"><code>&lt;table&gt;</code> タグの直後に配置し、表全体のタイトルや説明文（キャプション）を表示するために使用します。</p>
                    </div>
                </details>
            </div>

            <!-- Q13 -->
            <div class="question-block">
                <div class="question-text">⑬ 表のデータセルであることを示すタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>td</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">Table Data（表のデータ）の略です。表の個々の通常セルを定義します（見出し用のセルは <code>&lt;th&gt;</code> を使います）。</p>
                    </div>
                </details>
            </div>

            <!-- Q14 -->
            <div class="question-block">
                <div class="question-text">⑭ 入力フォームにおいて、部品全体を囲み属性で送信先や送信方法を指定するタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>form</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">フォーム全体の親となるタグです。<code>action</code> 属性で送信先のプログラム、<code>method</code> 属性で送信方法（GETやPOST）を指定します。</p>
                    </div>
                </details>
            </div>

            <!-- Q15 -->
            <div class="question-block">
                <div class="question-text">⑮ cssファイルやgoogleフォント使用時のフォントファイルなど外部ファイルを読み込むタグ</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>link</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">外部リソースと現在のHTML文書を関連付けるためのタグです。<code>&lt;head&gt;</code> 内で <code>rel="stylesheet"</code> や <code>href="..."</code> と共に使用します。</p>
                    </div>
                </details>
            </div>

            <!-- ========================================== -->
            <!-- 問2 CSSの記述 -->
            <!-- ========================================== -->
            <h2>問2. 次のCSSを記述しなさい。</h2>
            <div class="example-box">
                （例題）文字の下線や取り消し線を消す ➔ <strong>解答：<code>text-decoration: none;</code></strong>
            </div>

            <!-- CSS Q1 -->
            <div class="question-block">
                <div class="question-text">① 文字のサイズを「1.6rem」に指定</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>font-size: 1.6rem;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">文字サイズを変更するには <code>font-size</code> プロパティを使用します。<code>rem</code> はルート（html要素）の文字サイズを基準にした相対単位です。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q2 -->
            <div class="question-block">
                <div class="question-text">② リストのマーカー（・など）を非表示にする</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>list-style-type: none;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">リストの先頭につく記号の種類を指定するプロパティです。<code>none</code> を指定することで非表示にできます（<code>list-style: none;</code> でも正解となります）。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q3 -->
            <div class="question-block">
                <div class="question-text">③ 背景色を「r: 200, g: 200, b: 200」に指定</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>background-color: rgb(200, 200, 200);</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">背景色を指定するには <code>background-color</code> プロパティを使用します。RGB値を指定する際は <code>rgb(R, G, B)</code> の形式で記述します（<code>background: rgb(...);</code> でも可）。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q4 -->
            <div class="question-block">
                <div class="question-text">④ 枠線（1px solid black）を付ける</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>border: 1px solid black;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">要素の周囲の枠線を一括指定するプロパティです。左から「線の太さ（1px）」「線の種類（solid＝実線）」「線の色（black）」を半角スペース区切りで記述します。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q5 -->
            <div class="question-block">
                <div class="question-text">⑤ 文字色を「r: 255, g: 0, b: 0」に指定</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>color: rgb(255, 0, 0);</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">テキストの色（文字色）を変更するプロパティは <code>color</code> です。今回の値は純粋な「赤色」になります。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q6 -->
            <div class="question-block">
                <div class="question-text">⑥ テーブルなどで文字の横位置を中央寄せにする</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>text-align: center;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">ブロック要素内のテキストやインライン要素の水平方向の配置を指定します。中央揃えにするには <code>center</code> を使用します。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q7 -->
            <div class="question-block">
                <div class="question-text">⑦ 背景画像を横にのみ繰り返す</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>background-repeat: repeat-x;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">背景画像の繰り返し方法を指定するプロパティです。横方向（X軸方向）のみにループさせたい場合は <code>repeat-x</code> を指定します。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q8 -->
            <div class="question-block">
                <div class="question-text">⑧ CSSで記述する文字コードをUTF-8に指定</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>@charset "UTF-8";</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">外部CSSファイルの先頭に記述する文字コードの宣言です。この記述の後ろにはセミコロン（<code>;</code>）が必須となります。また、CSSファイルの「1行目の1文字目」から書くルールがあります。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q9 -->
            <div class="question-block">
                <div class="question-text">⑨ 文字の太さを通常（普通）にする</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>font-weight: normal;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">文字の太さを指定するプロパティです。標準的な太さに戻す、あるいは指定する場合は <code>normal</code>（数値表現では <code>400</code>）を使用します。</p>
                    </div>
                </details>
            </div>

            <!-- CSS Q10 -->
            <div class="question-block">
                <div class="question-text">⑩ 子要素を横並び等にするフレキシブルボックスを指定</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <code>display: flex;</code></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">親要素の表示形式を「Flexbox」に切り替える指定です。これを行うことで、直下の子要素が簡単に横並びになり、柔軟なレイアウト調整が可能になります。</p>
                    </div>
                </details>
            </div>

        </main>



    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>

