<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="9/1(火)の職業訓練授業ノートです。JavaScriptのsetTimeoutとsetIntervalの内部挙動の違い、タイマー多重発火の防止対策、万年カレンダーの曜日算出アルゴリズム、Dateオブジェクトの応用をまとめています。">
    <title>9/1(火)職業訓練授業：タイマー処理のメカニズムとカレンダー生成アルゴリズム | ポートフォリオサイト</title>
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
            <h2>9/1(火) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                9月スタート。時間経過を制御する2つのタイマー命令の特性と、Webアプリケーションの実践的なロジックであるカレンダー生成のアルゴリズムを深く解剖します。
            </p>

            <!-- セクション1：setTimeout -->
            <div class="note-section">
                <h3 class="note-title">1. setTimeout による指定時間後の処理と「再帰反復」の罠</h3>
                <p>
                    指定した時間が経過した後に、**1度だけ**特定の処理を実行させる命令です（1000ミリ秒 ＝ 1秒）。
                </p>
<pre><code>// 構文
window.setTimeout(関数名, 時間(ミリ秒));</code></pre>

                <div class="sub-heading">🔄 自己呼び出し（再帰）による繰り返し処理の構築</div>
                <p>実行する関数の中で、自分自身を再び <code>setTimeout</code> で呼び出す構造（再帰呼び出し）にすることで、疑似的な繰り返し処理を作ることができます。タイマーを止めたい場合は <code>clearTimeout(タイムID);</code> を実行します。</p>
<pre><code>let timeId;
function loop() {
    // 繰り返し実行したい処理
    timeId = setTimeout(loop, 1000); // 💡 自分の処理が終わった後に、1秒後に自分を予約する
}</code></pre>

                <div class="sub-heading">⚠️ タイムライン検証：なぜ処理時間によって全体の時間がズレるのか？</div>
                <p>
                    <code>setTimeout</code> の再帰呼び出しは、<strong>「前の処理が完全に終わってから、次の待機時間がスタートする」</strong> という特性を持っています。そのため、PCの負荷や関数の重さ（処理時間）によって、実行回数を重ねるごとに開始時間が後ろへ後ろへと累積して遅れてしまいます。
                </p>
                
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: center;">実行回数</th>
                            <th style="padding: 10px; text-align: center;">プログラムの処理時間</th>
                            <th style="padding: 10px; text-align: center;">設定待機時間</th>
                            <th style="padding: 10px; text-align: left;">スタートからの累計経過時間（発火タイミング）</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px; text-align: center;">1回目</td>
                            <td style="padding: 10px; text-align: center; color: #64748b;">500 ms</td>
                            <td style="padding: 10px; text-align: center;">1000 ms</td>
                            <td style="padding: 10px;">➔ <strong>1500 ms 後</strong> に1回目が終了、2回目の待機スタート</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px; text-align: center;">2回目</td>
                            <td style="padding: 10px; text-align: center; color: #64748b;">200 ms</td>
                            <td style="padding: 10px; text-align: center;">1000 ms</td>
                            <td style="padding: 10px;">➔ <strong>2700 ms 後</strong> (1500 + 200 + 1000)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px; text-align: center;">3回目</td>
                            <td style="padding: 10px; text-align: center; color: #64748b;">400 ms</td>
                            <td style="padding: 10px; text-align: center;">1000 ms</td>
                            <td style="padding: 10px; color: #b91c1c; font-weight: bold;">➔ 4100 ms 後 (2700 + 400 + 1000)</td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    このように、3周の処理だけで本来3000ms（3秒）間隔であってほしいはずが、**計4100ms（4.1秒）までズレ込んでしまう**ため、時計やストップウォッチのような正確な時間周期が求められる用途には絶対に向きません。
                </p>
            </div>

            <!-- セクション2：setInterval -->
            <div class="note-section">
                <h3 class="note-title">2. setInterval による正確なインターバル（周期）処理</h3>
                <p>
                    処理自体の実行時間に関わらず、**「指定した時間の間隔（一定の周期）ごと」に機械的に処理を強制開始させる**繰り返し命令です。
                </p>
                <ul>
                    <li>1回命令を出すだけで勝手にループするため、<strong>関数内での自己呼び出し（再帰）は完全に不要</strong>です。</li>
                    <li>時計、カウントダウンタイマー、アクションゲームの描画ループなど、正確な時間管理が必要なシステムに採用されます。</li>
                </ul>
<pre><code>// タイマーの開始（IDを変数に保持し、clearInterval(timeId); で停止する）
let timeId = setInterval(関数名, 1000); </code></pre>

                <p class="note" style="font-size: 13.5px; color: #b91c1c; background-color: #fff5f5; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    ⚠️<strong>実務での防衛策：タイマーの「多重発火」によるフリーズバグ</strong><br>
                    タイマー起動処理をボタンのクリックイベント（<code>onclick</code>）にそのまま設定した場合、ユーザーがボタンを連打すると、**裏側でタイマーが何重にも同時に重なって暴走起動してしまう重篤なバグ**が発生します。<br><br>
                    プロの現場では、ボタンが押された瞬間に <code>clearInterval(timeId);</code> を実行して「古いタイマーを一旦確実に消去してから新しいタイマーを動かす」か、あるいは起動中は開始ボタンに <strong><code>disabled = true;</code></strong> 属性を付与して物理的に連打させないUI設計を施すことが必須義務となっています。
                </p>
            </div>

            <!-- セクション3：万年カレンダーの数理アルゴリズム -->
            <div class="note-section">
                <h3 class="note-title">3. 万年カレンダーの設計と構造算出アルゴリズム</h3>
                <p>
                    ポートフォリオの作品制作（カレンダー生成）のベースとなる、JavaScriptの便利機能に依存しない純粋な論理数学計算によるカレンダー構築ロジックの解析です。
                </p>
                <div class="sub-heading">💡 カレンダーを出力するための2大絶対条件</div>
                <ol>
                    <li>その月の **「1日」が何曜日** からスタートするか</li>
                    <li>その月が **「何日まで（末日）」** 存在するか（2月の平年28日・うるう年29日の個別判定含む）</li>
                </ol>

                <div class="sub-heading">📋 指定年月「1日」の曜日を導き出す4ステップ</div>
                <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 8px; text-align: center; width: 20%;">手順</th>
                            <th style="padding: 8px; text-align: left;">処理・判定の算術ロジック</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center; font-weight: bold;">1. 基準年の設定</td>
                            <td style="padding: 8px;">あらかじめ「1月1日の曜日」が確定している過去の特定の年（例: 1600年や2026年など）をプログラムの【原点（基準年）】として設定する。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center; font-weight: bold;">2. 年数によるズレ</td>
                            <td style="padding: 8px;">地球の公転周期上、平年（365日）が経過すると翌年の曜日は「1つ」進み、うるう年（366日）を跨ぐと「2つ」進む。
                            <br>➔ <strong>（経過年数） ＋ （その間を通過したうるう年の総回数）</strong> を計算し、年単位の曜日のズレを算出する。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center; font-weight: bold;">3. 月数によるズレ</td>
                            <td style="padding: 8px;">指定された年の「1月1日」から、ターゲットである「指定月の1日」までの**経過日数（配列等から各月の末日を足し算）**を求め、ステップ2のズレに全て合算する。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 8px; text-align: center; font-weight: bold;">4. 曜日の確定</td>
                            <td style="padding: 8px;">算出した「総合計のズレ日数」を **<code>7</code> で割った余り（<code>%</code> 演算子）** を出す。
                            <br>その余りの数値（0〜6）の分だけ基準年の曜日からカレンダーのインデックスをシフトさせることで、任意の年月の1日の曜日が寸分の狂いもなく確定する。</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- セクション4：実務での補足情報 -->
            <div class="note-section">
                <h3 class="note-title">4. フロントエンド実務におけるタイマー・カレンダーの近代手法</h3>
                
                <div class="sub-heading">✨ 実務スタンダード：JavaScript標準の「Dateオブジェクト」</div>
                <p>
                    上記の数理計算はアルゴリズム的思考力を鍛える訓練には最適ですが、実務の現場では、ブラウザに標準搭載されている <strong><code>Date</code> オブジェクト</strong> を使用することで、曜日やうるう年の判定を含めた末日の算出をわずか数行で処理するのが主流です。
                </p>
<pre><code>// ① 任意の年月の「1日」の曜日番号をダイレクトに取得（日〜土 ➔ 0〜6）
let date = new Date(2026, 9, 1); // 💡 月は0から始まるため、9は「10月」を意味します
console.log(date.getDay());     // ➔ 10月1日の曜日が出力される

// ② 【プロの裏ワザ】任意の年月の「末日（最終日）」をピンポイントで取得する
// 日にちの引数に「0」を指定すると、ブラウザはその月の前月の最終日（末日）へと自動補正します
let lastDate = new Date(2026, 10, 0); // 11月（10）の0日目 ➔ つまり10月の末日
console.log(lastDate.getDate());      // ➔ 「31」が出力される（うるう年の2月なら自動で29になる）</code></pre>

                <div class="sub-heading">✨ カレンダー描画時の属性変化（DOM操作）</div>
                <p>
                    自動生成されたカレンダーのマス目（<code>&lt;td&gt;</code>）に対し、JavaScriptの属性操作・クラス操作を組み合わせることで、デザインを動的に反映させます。
                </p>
<pre><code>// 曜日や当日に応じて、CSSクラスを動的にアドオンする
cell.setAttribute("class", "sunday"); // 日曜日のマスに赤文字用CSSクラスを適用
cell.classList.add("today");          // 今日の日付のマスに背景色の装飾クラスを追加</code></pre>
            </div>

        </main>


    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
