<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/11(金)の職業訓練授業ノートです。画像本来のサイズを取得するnaturalWidth/naturalHeight、絶対座標を割り出すgetBoundingClientRectとスクロール量の連動、画面リサイズイベント(onresize)をまとめています。">
    <title>9/11(金)職業訓練授業：高度なスライドショー制御と座標計算アルゴリズム | ポートフォリオサイト</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">

    <!-- 💡 スライドショー専用のスタイル（slider.cssの統合と埋もれ対策） -->
    <style>
        /* ヘッダーや外枠と干渉しないための親コンテナ */
        #slide-view-section {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 20px auto 35px;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        /* スライドショーの外枠（slider.css） */
        #slide {
            position: relative;
            width: 100%;
            height: 300px;
            /* スライドショーの高さ */
            overflow: hidden;
            border-radius: 8px;
            background-color: #1e293b;
        }

        /* 画像リストの並び */
        #slide ul {
            position: absolute;
            left: 0;
            top: 0;
            width: 400%;
            /* 画像4枚分を横並びにするため400% */
            height: 100%;
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            transition: left 0.5s ease-in-out;
            /* 滑らかにスライドさせるアニメーション */
        }

        #slide li {
            width: 25%;
            /* 400%の中の4分の1（1枚分） */
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* サイズの違う画像も崩さず綺麗に収める */
        }

        /* ナビゲーション矢印ボタン（絶対配置によるピンポイント制御） */
        .slide-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: rgba(30, 41, 59, 0.8);
            color: #ffffff;
            border: none;
            border-radius: 50%;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.2s;
        }

        .slide-btn:hover {
            background-color: #ff8c00;
            /* ホバー時にサイトのアクセントカラーに変身 */
        }

        #back {
            left: -10px;
        }

        #next {
            right: -10px;
        }
    </style>
</head>

<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト -->
    <div class="container">
        <main class="main-content">
            <h2>9/11(金) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                実務で役立つ動的UIの実装。画像の本来のサイズを検知するプロパティ、スクロール量に応じた要素の絶対位置計算、およびレスポンシブな画面リサイズへの追従手法を学びます。
            </p>

            <!-- 💡 【追加】授業内参考リソース一覧の上に実際の動くスライドショーを埋め込み -->
            <div id="slide-view-section">
                <p style="text-align: center; font-size: 13px; font-weight: bold; color: #1e3a8a; margin-top: 0; margin-bottom: 10px;">
                    ✨ 実技スライドショー：動作確認デモ画面
                </p>

                <div style="position: relative;">
                    <!-- 左右のコントローラーボタン -->
                    <button id="back" class="slide-btn" aria-label="前へ">◀</button>

                    <!-- スライダー本体（HTML骨組み） -->
                    <div id="slide">
                        <ul>
                            <li><img src="./slide_controll/images/chaneko.jpg" alt="茶猫（1枚目）"></li>
                            <li><img src="./slide_controll/images/chaneko2.jpg" alt="茶猫（2枚目）"></li>
                            <li><img src="./slide_controll/images/kuroneko.jpg" alt="黒猫（3枚目）"></li>
                            <li><img src="./slide_controll/images/inu2.jpg" alt="犬（4枚目）"></li>
                        </ul>
                    </div>

                    <button id="next" class="slide-btn" aria-label="次へ">▶</button>
                </div>
            </div>

            <!-- 🔗 参考リソース一覧 -->
            <div class="note-section">
                <h3 class="note-title">🔗 授業内参考リソース一覧</h3>
                <ul>
                    <li><strong>参考資料：</strong> 授業スライド（スライダー構築の設計図）</li>
                    <li><strong>モックアップ構成：</strong> <code>slider.html</code> / <code>slider.css</code> / <code>slider.js</code></li>
                </ul>
            </div>

            <!-- HTML骨組み解説 -->
            <div class="note-section">
                <h3 class="note-title">実物用のHTML骨組み</h3>
                <p>
                    JavaScript（<code>slider.js</code>）は、HTML内から特定の識別子（例：<code>#slide</code>）を見つけてスライダーシステムを自動起動させます。
                </p>
                <pre><code>&lt;!-- スライドショーの標準的なマークアップ構造 --&gt;
&lt;div id="slide"&gt;
    &lt;ul&gt;
        &lt;li&gt;&lt;img src="img/cat1.png" alt="茶猫"&gt;&lt;/li&gt;
        &lt;li&gt;&lt;img src="img/cat2.png" alt="茶猫"&gt;&lt;/li&gt;
        &lt;li&gt;&lt;img src="img/cat3.png" alt="黒猫"&gt;&lt;/li&gt;
        &lt;li&gt;&lt;img src="img/dog1.png" alt="犬"&gt;&lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;</code></pre>
            </div>

            <!-- セクション1：画像サイズチェック -->
            <div class="note-section">
                <h3 class="note-title">1. 画像ファイルの本来のサイズをチェックする命令</h3>
                <p>
                    画像ファイルは文字テキストとは異なり、ファイル自体が最初から固有の高さと幅（初期値）を持っています。
                </p>
                <p>
                    CSSの指定（<code>width: 100%;</code> など）によってブラウザ上で引き伸ばされたり縮小されたりしているサイズではなく、<strong>画像が本来持っている「元々のピクセルサイズ」</strong>をJavaScript側で正確に取得するのが <code>naturalWidth</code> と <code>naturalHeight</code> です。
                </p>

                <div class="sub-heading">基本の形</div>
                <pre><code>let imgWidth  = (取得したimg要素).naturalWidth;  /* 画像本来の横幅(px) */
let imgHeight = (取得したimg要素).naturalHeight; /* 画像本来の高さ(px) */</code></pre>

                <div class="sub-heading">授業内プログラムでの具体例（58〜59行目）</div>
                <pre><code>let width  = image[i].getElementsByTagName("img").naturalWidth;
let height = image[i].getElementsByTagName("img").naturalHeight;</code></pre>

                <p style="font-size: 14px; color: #1e3a8a; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <strong>📝 ここがポイント（実務でのアピール要素）：</strong><br>
                    世の中には「あらかじめ画像のサイズを全て同じに加工・統一しておかなけないスライドショー」が多く存在します。しかし今回のプログラムでは、このプロパティを使用することで、<strong>「入ってくる画像のサイズがバラバラであっても、システムがその都度自動計算して綺麗に動く、汎用性の高い高度な仕組み」</strong>を実現しています。
                </p>
            </div>

            <!-- セクション2：位置情報とスクロール量 -->
            <div class="note-section">
                <h3 class="note-title">2. ブラウザ内での要素位置とスクロール量の取得・連動</h3>
                <p>
                    スライドショーの「進む」「戻る」といったコントロール用の矢印ボタン（<code>#next</code>, <code>#back</code>）を <code>position: absolute;</code> を用いてスライダー枠のキワへピンポイントで配置するための座標計算ロジックです。
                </p>

                <div class="sub-heading">基本形A：現在の表示エリア（ビューポート）内の位置取得</div>
                <p><code>getBoundingClientRect()</code> を実行すると、現在見えている画面の左上角を原点（0, 0）とした、要素の四隅の距離情報オブジェクトが取得できます。</p>
                <pre><code>let clientRect = (取得した要素).getBoundingClientRect();
console.log(clientRect.left); // 現在の画面の左端からの距離
console.log(clientRect.top);  // 現在の画面の上端からの距離</code></pre>

                <div class="sub-heading">基本形B：ユーザーのスクロール量の加算による「絶対座標」の算出</div>
                <p>
                    <code>getBoundingClientRect()</code> で得られる数値は、画面がスクロールされると刻一刻と変化してしまいます。そこで、ページ全体の左上角（大原点）からの**「絶対に変わらない絶対座標」**を求めるために、現在のスクロール量を足し算（マージ）します。
                </p>
                <ul>
                    <li><strong>横方向の絶対位置：</strong> <code>window.pageXOffset</code>（または <code>window.scrollX</code>）＋ <code>clientRect.left</code></li>
                    <li><strong>縦方向の絶対位置：</strong> <code>window.pageYOffset</code>（または <code>window.scrollY</code>）＋ <code>clientRect.top</code></li>
                </ul>

                <div class="sub-heading">授業内プログラムでの具体例（110〜112行目）</div>
                <pre><code>let clientRect = slide.getBoundingClientRect();
let slide_x = window.pageXOffset + clientRect.left; // ページ最上部からの絶対横座標
let slide_y = window.pageYOffset + clientRect.top;  // ページ最上部からの絶対縦座標</code></pre>
            </div>

            <!-- セクション3：画面リサイズイベント -->
            <div class="note-section">
                <h3 class="note-title">3. 画面サイズ変更時（レスポンシブ）の追従命令</h3>
                <p>
                    PCの画面サイズが変更されたり、ブラウザの横幅（ウィンドウサイズ）が変わると、当然スライドショーが表示される位置（座標）も左右にスライドして変化します。
                </p>
                <p>
                    これにリアルタイムに追従し、ボタンの位置を自動再計算してピタッと吸い付かせるために、ウィンドウのリサイズイベント（<code>onresize</code>）をトリガーにして処理を動かします。
                </p>

                <div class="sub-heading">授業内プログラムでの具体例（131行目）</div>
                <pre><code>window.onresize = changeSet; </code></pre>
            </div>

        </main>

        <!-- 右側：更新履歴 -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 💡 【JavaScriptプログラムの制御ロジック】 -->
    <script>
        const slideList = document.querySelector("#slide ul");
        const nextBtn = document.getElementById("next");
        const backBtn = document.getElementById("back");
        const slides = document.querySelectorAll("#slide li");

        let counter = 0;
        const size = 100; // 移動率（%）

        // 次へボタンの挙動
        nextBtn.addEventListener("click", () => {
            if (counter >= slides.length - 1) {
                counter = 0; // 最後までいったら最初の画像に戻る（無限ループ対応）
            } else {
                counter++;
            }
            slideList.style.left = (-size * counter) + "%";
        });

        // ◀ 前へボタンのクリック挙動
        backBtn.addEventListener("click", () => {
            if (counter <= 0) {
                counter = slides.length - 1; // 💡 最初から前に戻ったら最後の画像へワープ
            } else {
                counter--;
            }
            slideList.style.left = (-size * counter) + "%";
        });

        // 💡 授業内容にある「リサイズへの追従」のシミュレーションイベント登録
        function changeSet() {
            console.log("画面幅が変更されました。矢印ボタンの絶対座標を安全に再計算しています。");
        }
        window.onresize = changeSet;
    </script>

    <!-- ページトップへ戻るボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>