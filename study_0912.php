<!DOCTYPE html>
<html lang="ja">

<head>
  <title>DOMContentLoaded と e.target、演習問題 | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>

  <style>
    .main-content .lesson-table th,
    .main-content .lesson-table td {
      width: auto !important;
      text-align: left !important;
      vertical-align: middle;
    }

    .main-content .lesson-table td code,
    .main-content .lesson-table td strong {
      white-space: nowrap;
    }

    /* 1列目と2列目の幅を少しきれいに確保する調整 */
    .main-content .lesson-table th:nth-child(1),
    .main-content .lesson-table td:nth-child(1) {
      min-width: 140px;
    }

    .main-content .lesson-table th:nth-child(2),
    .main-content .lesson-table td:nth-child(2) {
      min-width: 140px;
    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <!-- 📝 講義ノートセクション -->
      <section class="note-section">
        <h2 class="note-title">DOMContentLoaded と e.target(演習問題)</h2>

        <!-- サブ見出し 1 -->
        <h3 class="sub-heading">1. DOMContentLoaded（ディーオーエム・コンテンツ・ローデッド）</h3>
        <p>【役割】 HTMLの読み込みがすべて終わった「瞬間」を狙ってJavaScriptを実行する命令です。</p>

        <p>
          <em>⚠ なぜ必要なの？</em><br>
          JavaScriptは通常、上から順番に実行されます。もしHTMLの「ボタン」が読み込まれるより前に、JavaScriptが「ボタンを取得せよ」と動いてしまうと、対象ボタンが見つからずエラー（<code>null</code>）になってしまいます。<br>
          この命令でコード全体を囲めば、HTMLが絶対に準備万端になってからJSが動き出すため、読み込み順によるエラーを100%防ぐことができます。
        </p>

        <p><strong>【書き方の型】</strong></p>
        <pre><code>document.addEventListener("DOMContentLoaded", () => {
    // この中に、普段書くすべての処理（要素の取得やイベント登録）を書く！
});</code></pre>

        <p><strong>■ DOMContentLoaded と window.onload の決定的な違い</strong></p>
        <p>一言でいうと「処理が動き出すタイミング（早さ）」が全く違います。</p>

        <!-- 比較テーブル（.lesson-tableを適用） -->
        <table class="lesson-table">
          <thead>
            <tr>
              <th>メソッド名</th>
              <th>発動タイミング</th>
              <th>実務でのメリット・デメリット</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><code>DOMContentLoaded</code></td>
              <td>HTMLの文字（タグ）を読み終えた瞬間</td>
              <td>画像などの重たいデータの完了を待たずに速攻で動くためユーザーを待たせない。実務の鉄則！早い反面、レイアウトが崩れてしまう事もある。</td>
            </tr>
            <tr>
              <td><code>window.onload</code></td>
              <td>HTML内の全てを読み終わった瞬間</td>
              <td>大きな画像や広告、CSSが100%終わるまで待つ。そのため体感が遅い。その反面、レイアウト崩れが100％起きずローディング演出を組むことが可能。画像の縦横サイズを正確に測ってから処理する等の特殊な場面以外は使わない。</td>
            </tr>
          </tbody>
        </table>

        <p><strong>■ JavaScriptで画像を読み込ませる時の onload の挙動</strong></p>
        <p>JS側で <code>new Image()</code> を使って新しく画像を作り出す場合、画像のダウンロードが完了した瞬間を感知するセンサーとして活躍します。</p>

        <p><strong>📊 速度のイメージまとめ</strong></p>
        <ol>
          <li>ブラウザがページを開く</li>
          <li>HTMLの文字（構造）を読み終わる ➔ <b>【ここで DOMContentLoaded が発動！】</b></li>
          <li>大きな画像や動画、広告を読み込み中...</li>
          <li>すべてのデータが100%読み終わる ➔ <b>【ここで window.onload が発動！】</b></li>
        </ol>

        <p><strong>【具体的なコードの形】</strong></p>
        <pre><code>// 1. メモリ上に新しく &lt;img&gt; タグを作る
const myImage = new Image();

// 2. 「画像データのダウンロードが終わったら動く」センサーを仕掛ける
myImage.onload = () => {
    console.log("画像の読み込みが完了しました！画面に表示します。");
    document.body.append(myImage); // ここで初めて画面に追加する
};

// 3. 画像のURLを流し込む（ここでダウンロードが始まります）
myImage.src = "https://example.com";</code></pre>

        <p><strong>【深堀りすると：画像×JS発火タイミング：4パターンの決定的な差】</strong></p>
        <p>ブラウザは画像のダウンロードが終わるまで縦横のサイズを知りません。サイズ未確定の画像が突如表示されると周囲の文字を押し下げる「レイアウト崩れ（レイアウトシフト）」が起きます。</p>

        <p><b>⚠ ① JavaScriptで後から画像を埋め込むサイト</b>（HTML側に画像がなく、JSで画像を埋め込んでいる場合）</p>
        <ul>
          <li><strong>パターンA【DOMContentLoaded ➔ img.onload】［最強（実務の王道）］</strong>：文字を読み終わった瞬間に最速でダウンロードを開始し <code>img.onload</code> で完了を待ってから <code>append()</code> するため、表示スピードは最速で、かつレイアウトも100%崩れません。</li>
          <li><strong>パターンB【window.onload ➔ img.onload】［最悪（ただ遅いだけ）］</strong>：ページ内の他の関係ないデータが「全部」終わるまで待ってからようやく目的の画像の処理を始めるため、ユーザーを無駄に待たせる遅いサイトになります。</li>
        </ul>

        <p><b>⚠ ② HTMLに最初から画像タグ（&lt;img src="..."&gt;）が書いてあるサイト</b></p>
        <ul>
          <li><strong>パターンA【DOMContentLoaded でのJS操作】［速度最速だが崩れリスクあり］</strong>：文字が終わった瞬間にJSが動くので操作性は最速ですが、HTMLの <code>&lt;img&gt;</code> タグに <code>width</code> や <code>height</code> をあらかじめ手書きしておかないと、画像表示の瞬間に画面がガタガタッと大きく揺れてレイアウトが崩れます。</li>
          <li><strong>パターンB【window.onload でのJS操作】［安全だが体感速度が遅い］</strong>：すべての画像が完全体で配置し終わってからJSが動き出すため、画面が揺れる心配はありませんが、ダウンロードが終わるまでの数秒間はJavaScriptの機能（ボタンの反応など）が一切動きません。</li>
        </ul>

        <p><strong>■ document の超重要メソッド 3選 + α</strong></p>
        <ul>
          <li><code>document.getElementById("id名")</code> ：HTMLの「id属性」を狙い撃ちして、特定の要素を1つだけ取得する。一番高速で動く実務の王道です。カッコ内はid名のみ（#は不要）。</li>
          <li><code>document.querySelectorAll(".クラス名やタグ名")</code> ：CSSのセレクタを使って、画面にある条件に合う要素を「すべて一括で」取得する。クラス名なら頭のドット（.）が必須。</li>
          <li><code>document.createElement("タグ名")</code> ：メモリの中に、新しく真っ新なHTMLの「タグ（要素）」を作り出す。これを作って文字を入れてから画面に追加（append）します。</li>
        </ul>

        <p><b>【知っておくと実務で差がつくメソッド 2選】</b></p>
        <ul>
          <li><code>document.querySelector("セレクタ名")</code> ：条件に合う要素を「最初の1つだけ」取得する。id名を持たない特定の要素をピンポイントで取りたいときに重宝します。</li>
          <li><code>document.getElementsByClassName("クラス名")</code> ：クラス名で要素をまとめて取得する古い命令。モダン開発では <code>querySelectorAll</code> の方が好まれるため、他人のコードで「読める状態」にしておけばOKです。カッコ内にドットを入れてはいけないルールなので初心者混乱の元です。</li>
        </ul>

        <!-- サブ見出し 2 -->
        <h3 class="sub-heading">2. e.target（イベント・ターゲット）</h3>
        <p>【役割】 クリックイベントなどが起きた時に、「実際に触られた（クリックされた）その要素そのもの」をピンポイントで指し示す魔法の言葉です。</p>

        <p><strong>【書き方の型】</strong></p>
        <pre><code>button.addEventListener("click", (e) => {
    console.log(e.target); // クリックされた要素が丸ごと取れる！
});</code></pre>

        <p><b>💡 ここがポイント！</b></p>
        <ul>
          <li>関数のカッコの中に「<code>e</code>」という文字を1文字入れます（eventの頭文字です）。</li>
          <li>この「<code>e</code>」の中に、クリックされた時のあらゆる情報（どこが押されたかなど）が自動で詰まります。</li>
          <li>「<code>e.target</code>」と書くことで、その情報の中から「押されたHTML要素」を取り出すことができます。</li>
        </ul>

        <p><strong>■ e.target（イベント・ターゲット）の利便性・比較</strong></p>
        <p>シチュエーション：「画面にボタンが大量に（例：1から5まで）並んでいる時」</p>

        <p><b>❌ e.target を使わない場合...（コードが超長くなる最悪の書き方）</b></p>
        <p>ボタンが5個あるので、5回ボタンを取得し、5回 <code>addEventListener</code> を書く必要があります。ボタンが100個なら100回同じことを繰り返すことになります。</p>
        <pre><code>const btn1 = document.getElementById("btn1");
btn1.addEventListener("click", () => { console.log("1が押された"); });

const btn2 = document.getElementById("btn2");
btn2.addEventListener("click", () => { console.log("2が押された"); });
// ... これをボタンの数だけ延々と書き続ける</code></pre>

        <p><b>⭕ e.target を使った場合...（たった数行で済む）</b></p>
        <p>ボタンを包んでいる「親要素（大きな箱）」に対して、たった1回だけ <code>addEventListener</code> を仕掛けます。後はJavaScriptが自動的に「実際にクリックされたのは、その中にあるどのボタンか」を <code>e.target</code> で特定してくれます。</p>
        <pre><code>// 5つのボタンを包んでいる親の箱（divなど）を1つだけ取得
const container = document.getElementById("button-container");

// 親の箱に、クリックイベントを1回だけ登録する
container.addEventListener("click", (e) => {
    // e.target を使えば、実際にクリックされたボタンの文字（1〜5）がピンポイントで取れる！
    console.log(e.target.textContent + " が押されました！");
});</code></pre>

        <p><b>【実務でよく使われる場面】</b></p>
        <ul>
          <li><strong>電卓アプリ：</strong>「0」から「9」や「＋」「ー」のボタンが並んでいるが、イベント登録は親の箱に1回だけで済む。</li>
          <li><strong>ToDoリスト：</strong>「削除ボタン」が後から何個追加されても、親要素が <code>e.target</code> で「どの削除ボタンが押されたか」を常に正しく監視できる。InstagramやX（旧Twitter）の無限スクロールでの画像追加も、この後から追加するDOM操作とイベントの仕組みの応用です。</li>
        </ul>
      </section>

      <!-- 📝 演習問題 ＆ 試験対策セクション -->
      <section class="note-section">
        <h2 class="note-title">2 演習問題 ＆ 試験対策</h2>
        <p>📝 HTMLの解析が完了した時点で処理を開始し、ID名『<code>menu-btn</code>』を持つ要素に対してクリックイベントを設定してください。当該要素がクリックされた際には、イベントオブジェクトを活用して、クリックされた要素自身のテキストコンテンツをコンソールに出力するプログラムを記述しなさい。</p>

        <!-- 💡 quiz.cssのquiz-detailsスタイルを利用した開閉アコーディオン -->
        <details class="quiz-details">
          <summary>💡 模範解答コード（クリックまたはタップで開く）</summary>
          <div class="quiz-answer-area">
            <pre><code>document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("menu-btn");
    btn.addEventListener("click", (e) => {
        console.log(e.target.textContent);
    });
});</code></pre>
          </div>
        </details>

        <p style="margin-top: 15px;"><strong>上記の問題の構文解読（パーツの名前と役割のパズル）</strong></p>
        <p>JavaScriptの基本構文は、すべて以下の4つのパーツの組み合わせでできています。動詞にあたるメソッドには <code>()</code> がつき、名詞にあたるプロパティには <code>()</code> がつきません。</p>

        <ol>
          <li>ページ全体（オブジェクト）のイベント監視（メソッド）を実行し、材料（引数）と部屋（関数）を渡す<br>➔ <code>document.addEventListener("DOMContentLoaded", () => { ... });</code></li>
          <li>要素をIDで取得（メソッド）し、臨時ボックス（変数/定数）に代入する<br>➔ <code>const btn = document.getElementById("menu-btn");</code></li>
          <li>変数に対してイベント監視（メソッド）を実行し、中に材料と部屋を渡す<br>➔ <code>btn.addEventListener("click", (e) => { ... });</code></li>
          <li>画面に出力する（メソッド）を実行し、中のデータ（プロパティ）をドットで繋いで渡す<br>➔ <code>console.log(e.target.textContent);</code></li>
        </ol>
      </section>

      <!-- ➔ トップページへ戻るリンク -->
      <p style="margin-top: 25px;">
        <a href="index.php" class="td-link">➔ トップページへ戻る</a>
      </p>
    </main>
  </div>

  <a href="#" class="top-button">▲ TOP</a>
</body>

</html>