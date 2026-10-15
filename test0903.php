<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="職業訓練の「JavaScriptのDOM制御」「イベント制御」「総合実習」に関する第3回小テストの復習・解答解説ページです。">
    <title>小テスト3回目 復習用問題集 | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ==========================================================================
           小テスト3回目ページ専用の追加デザイン（CSS）
           ========================================================================== */
        
        /* 各分野（大きな見出し）の調整 */
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 15px;
            background: #f0f4f8;
            padding: 10px 15px;
            border-left: 5px solid #1e3a8a;
            border-radius: 0 4px 4px 0;
            color: #1e3a8a;
        }
        .main-content .section-title:first-of-type {
            margin-top: 20px;
        }

        /* 点数情報・問いのアナウンス */
        .score-info {
            font-size: 15px;
            margin: 15px 0;
            font-weight: bold;
            color: #4a5568;
        }

        /* 各問題のブロック */
        .question-block {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        /* 問題文のテキスト */
        .question-text {
            font-weight: bold;
            font-size: 16px;
            color: #1e293b;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        /* プログラムコードのブロック表示（pre） */
        pre {
            background: #f8fafc;
            padding: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            overflow-x: auto;
            font-family: Consolas, Monaco, 'Andale Mono', monospace;
            font-size: 14px;
            line-height: 1.5;
            margin: 15px 0;
            color: #334155;
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
            margin-bottom: 8px;
        }
        
        /* 答えのプログラムコード（インライン表示） */
        .ans-body {
            display: inline-block;
            font-family: Consolas, Monaco, monospace;
            font-size: 16px;
            font-weight: bold;
            color: #dc2626;
            background: #fee2e2;
            padding: 6px 12px;
            border: 1px solid #fca5a5;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        /* 【解説】のバッジ装飾 */
        .commentary-title {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .commentary-text {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
        }
        .commentary-text code {
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
            <h1 style="font-size: 22px; color: #1e3a8a; margin-bottom: 5px;">小テスト3回目</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">復習用問題集（JavaScriptのDOM制御・イベント制御・総合実習）</p>

            <!-- ========================================== -->
            <!-- 分野：DOM制御 問1 -->
            <!-- ========================================== -->
            <div class="section-title">【分野：JavaScriptのDOM制御】</div>
            <div class="score-info">問1. 次の命令文を記述してください。（各7点 計35点）</div>

            <!-- Q1-1 -->
            <div class="question-block">
                <div class="question-text">① id「tbl」を定数名「Tbl」で取得した要素の開始タグの前に、変数名「tuika」に代入されている文章を挿入する。（タグと文章が変数名tuikaに代入されている）</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">Tbl.insertAdjacentHTML("beforebegin", tuika);</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">指定した位置に直接HTML文字列を挿入するには <code>insertAdjacentHTML()</code> メソッドを使用します。要素の「開始タグの前」に挿入する場合は、第一引数に <code>"beforebegin"</code> を文字列指定します。</div>
                    </div>
                </details>
            </div>

            <!-- Q1-2 -->
            <div class="question-block">
                <div class="question-text">② HTMLでつけられたid属性「add」を定数名「Add」で取得する。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">const Add = document.getElementById("add");</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">特定のid属性を持つ要素を1つ取得するには <code>document.getElementById()</code> を使用します。JavaScriptの命名規則（キャメルケース）により、Elementの「E」やId of「I」は大文字になるため、タイポに注意が必要です。定数への代入なので <code>const</code> を先頭につけます。</div>
                    </div>
                </details>
            </div>

            <!-- Q1-3 -->
            <div class="question-block">
                <div class="question-text">③ id「mes」を定数名Mesで取得した要素 &lt;input type="text" id="mes"&gt; に変数名「messege」の内容を表示する。（value属性を指定する）</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">Mes.value = messege;</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">input要素（入力フォームやボタンなど）の入力値や表示内容を操作・変更する際は、<code>innerHTML</code> ではなく <code>value</code> 属性に対して値を代入します。</div>
                    </div>
                </details>
            </div>

            <!-- Q1-4 -->
            <div class="question-block">
                <div class="question-text">④ id「text」を定数名「Text」で取得済みの状態で、この要素のstyle属性を変更し、文字色を「red」にする。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">Text.style.color = "red";</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">JavaScriptから要素のCSSスタイルを直接変更するには、<code>要素名.style.プロパティ名</code> の形式をとります。文字色の指定は <code>color</code> なので、<code>style.color</code> に対して値を文字列として代入します。</div>
                    </div>
                </details>
            </div>

            <!-- Q1-5 -->
            <div class="question-block">
                <div class="question-text">⑤ id「img」を定数名「Gazou」で取得済みの状態で、このsrc属性を「image.jpg」に変更し画像を入れ替える。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">Gazou.src = "image.jpg";</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">img要素などのHTML属性（src、href、altなど）は、取得した要素オブジェクトのプロパティ（<code>要素名.属性名</code>）として直接アクセスし、値を上書き・変更することができます。</div>
                    </div>
                </details>
            </div>

            <!-- ========================================== -->
            <!-- 分野：DOM制御 問2 -->
            <!-- ========================================== -->
            <div class="score-info" style="margin-top:35px;">問2. 次の入力前・入力表示ボタンクリック後を元に【 】を埋めて、プログラムを完成ましょう。（各6点 計24点）</div>

            <div class="question-block">
                <p style="margin-top:0; font-size:13px; color:#666;">※①の3か所はすべて同じものが入ります</p>
                <pre>
1  │ &lt;!DOCTYPE html&gt;
2  │ &lt;html lang="ja"&gt;
3  │   &lt;head&gt;
4  │     &lt;meta charset="UTF-8"&gt;
5  │     &lt;title&gt;JavaScriptのDOM制御&lt;/title&gt;
6  │   &lt;/head&gt;
7  │   &lt;body&gt;
8  │     &lt;h1&gt;innerHTML&lt;/h1&gt;
9  │     &lt;input type="text" id="namae"&gt;
10 │     &lt;input type="button" id="btn" value="表示"&gt;
11 │     &lt;p id="msg"&gt;お名前を入力してください&lt;/p&gt;
12 │     &lt;script&gt;
13 │       const Btn = 【  ①  】("btn");
14 │       function disp() {
15 │         const Msg = 【  ①  】("msg");
16 │         const Namae = 【  ①  】("namae");
17 │         Msg.【  ②  】 = "ようこそ" + Namae.value + "さん";
18 │       }
19 │       Btn.【  ③  】("click", 【  ④  】);
20 │     </script>
21 │   </body>
22 │ </html></pre>

            <div style="margin-top: 15px; font-size: 14px; background-color: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #cbd5e1;">
                <strong>ヒント（役割一覧）：</strong><br>
                ① idによる要素の取得 / ② 段落内の文章を変更（上書き） / ③ イベントの追加（作成） / ④ イベント発火で実行する関数指定
            </div>

            <!-- 穴埋めQ1～Q4の個別アコーディオン -->
            <div style="margin-top: 20px;">
                <div style="margin-bottom: 12px;">
                    <details>
                        <summary>【 ① 】の解答・解説を表示</summary>
                        <div class="answer-content">
                            <div class="ans-title">【答え】</div><br>
                            <div class="ans-body">document.getElementById</div>
                            <br><div class="commentary-title">【解説】</div>
                            <div class="commentary-text">HTML内の要素を、割り当てられたid名（"btn"、"msg"、"namae"）をキーにしてJavaScript側に取得するための基本命令（メソッド）です。</div>
                        </div>
                    </details>
                </div>

                <div style="margin-bottom: 12px;">
                    <details>
                        <summary>【 ② 】の解答・解説を表示</summary>
                        <div class="answer-content">
                            <div class="ans-title">【答え】</div><br>
                            <div class="ans-body">innerHTML</div>
                            <br><div class="commentary-title">【解説】</div>
                            <div class="commentary-text">pタグなどの要素に囲まれた中身のテキストやHTML構造を書き換えるプロパティです。ここでは「お名前を入力してください」という文字を「ようこそ〜さん」に上書きしています。</div>
                        </div>
                    </details>
                </div>

                <div style="margin-bottom: 12px;">
                    <details>
                        <summary>【 ③ 】の解答・解説を表示</summary>
                        <div class="answer-content">
                            <div class="ans-title">【答え】</div><br>
                            <div class="ans-body">addEventListener</div>
                            <br><div class="commentary-title">【解説】</div>
                            <div class="commentary-text">対象の要素に対して「特定の操作（クリックなど）がされたらこの処理を動かす」というイベントリスナーを登録（追加）するためのメソッドです。</div>
                        </div>
                    </details>
                </div>

                <div style="margin-bottom: 12px;">
                    <details>
                        <summary>【 ④ 】の解答・解説を表示</summary>
                        <div class="answer-content">
                            <div class="ans-title">【答え】</div><br>
                            <div class="ans-body">disp</div>
                            <br><div class="commentary-title">【解説】</div>
                            <div class="commentary-text">14行目で定義している <code>function disp() { ... }</code> という関数を指定します。<code>addEventListener</code> 内で引数として関数を渡す際は、カッコ <code>()</code> を付けずに<strong>関数名のみ</strong>を記述するルールに注意しましょう。</div>
                        </div>
                    </details>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- 分野：イベント制御 問1 -->
            <!-- ========================================== -->
            <div class="section-title">【分野：JavaScriptのイベント制御】</div>
            <div class="score-info">問1. 次のイベント発火タイミングの指定を例のように記述してください。（各7点 計21点）</div>
            <div style="font-size:13px; margin-bottom:15px; padding-left:10px; color:#555;">
                例）リンクされているものは関係なくhtmlが準備できたら発火 &nbsp;&nbsp; ➔ &nbsp;&nbsp; <strong>解答： document.ready もしくは document.addEventListener("ready", 関数名)</strong>
            </div>

            <!-- Q2-1 -->
            <div class="question-block">
                <div class="question-text">① リンクされている外部ファイル（css等）や画像等のダウンロードが完了し表示が終わったら発火</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">window.onload</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">HTMLだけでなく、スタイルシート、画像、サブフレームなど、すべてのリソースが完全に読み込まれたタイミングを検知するイベントプロパティです。<code>window.addEventListener("load", 関数名)</code> でも同様の処理が可能です。</div>
                    </div>
                </details>
            </div>

            <!-- Q2-2 -->
            <div class="question-block">
                <div class="question-text">② 定数名：Btnで取得済みのid属性がbtnのボタンがクリックされたら発火</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">Btn.onclick</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">要素がクリックされたときに発生するイベント処理を割り当てるプロパティです。<code>Btn.onclick = 関数名;</code> の形で使われます。</div>
                    </div>
                </details>
            </div>

            <!-- Q2-3 -->
            <div class="question-block">
                <div class="question-text">③ ブラウザ上で右クリックをした時に発火</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">window.oncontextmenu</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text">右クリック（またはMacでの二本指タップなど）によってコンテキストメニューが開かれようとした瞬間に発生するイベントです。このイベント内で <code>event.preventDefault()</code> を呼び出すと、ブラウザ標準の右クリックメニューを非表示にすることができます。</div>
                    </div>
                </details>
            </div>

            <!-- ========================================== -->
            <!-- 分野：イベント制御 問2 -->
            <!-- ========================================== -->
            <div class="score-info" style="margin-top:35px;">問2. setTimeoutとsetIntervalはともに関数により関数を実行するが、以下のように記述した命令を実行した場合どのようなタイミングで関数名:dispが実行されていくでしょうか。（各5点 計10点）</div>

            <!-- Q3-1 -->
            <div class="question-block">
                <div class="question-text">① <code>setTimeout(disp, 2000);</code></div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">2000ミリ秒（2秒）後に、1回だけ処理する。</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text"><code>setTimeout</code> はタイマー処理を行うメソッドで、指定した時間が経過した後に<strong>一度だけ</strong>登録された関数を実行します（単位はミリ秒なので、2000 = 2秒になります）。</div>
                    </div>
                </details>
            </div>

            <!-- Q3-2 -->
            <div class="question-block">
                <div class="question-text">② <code>setInterval(disp, 2000);</code></div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div><br>
                        <div class="ans-body">2000ミリ秒（2秒）ごとに、同じ処理を繰り返す。</div>
                        <br><div class="commentary-title">【解説】</div>
                        <div class="commentary-text"><code>setInterval</code> は、指定された時間（間隔）が経過するたびに、登録された関数を<strong>定期的・永続的に繰り返し</strong>実行します。止める場合は <code>clearInterval</code> を用いる必要があります。</div>
                    </div>
                </details>
            </div>

            <!-- ========================================== -->
            <!-- 分野：総合実習 -->
            <!-- ========================================== -->
            <div class="section-title">【分野：JavaScript総合実習】</div>
            <div class="score-info">問1. 次のプログラムを作成してください。（10点）</div>

            <div class="question-block">
                <div class="question-text">変数名numに代入されている数値が偶数なら「偶数」、奇数なら「奇数」とコンソールに出力（表示）するプログラムを作成してください。num以外の変数等を使用する場合は定義して使用してください。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <div class="ans-title">【答え】</div>
                        <pre>
if (num % 2 === 0) {
  console.log("偶数");
} else {
  console.log("奇数");
}</pre>
                        <div class="commentary-title">【解説】</div>
                        <div class="commentary-text">
                            数値が偶数か奇数かを判定するには、<code>%</code>（剰余演算子）を使って「2で割ったときの余り」を計算します。<br>
                            ・余りが <code>0</code> であれば <strong>偶数</strong><br>
                            ・それ以外（余りが1）であれば <strong>奇数</strong><br>
                            となるため、<code>if / else</code> 構文を用いて条件分岐を記述します。コンソールへの出力には <code>console.log()</code> を使用します。
                        </div>
                    </div>
                </details>
            </div>

        </main>



    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
