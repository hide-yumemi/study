<!DOCTYPE html>
<html lang="ja">

<head>
  <title>JavaScript 配列化 ＆ 非破壊メソッド | ポートフォリオサイト</title>
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

      <section class="note-section">
        <h2 class="note-title">JavaScript 基礎（配列化 ＆ 非破壊メソッド）</h2>
        <p>ブラウザの「デベロッパーツール（F12）」のコンソールを開くと、実際の出力を確認できます！</p>

        <p>
          <em>⚠ 超重要ルール：元の変数は傷つかない！（非破壊メソッド）</em><br>
          <code>split()</code> や <code>Array.from()</code>
          を使っても、元のデータ（文字列など）は書き換わりません。これらはすべて<b>非破壊的メソッド</b>であり、あくまで「その瞬間にバラバラにした新しい配列」をコピーとして作り出しているだけです。
        </p>

        <h3 class="sub-heading">1. 決定的な違い：相手にできるデータが違う</h3>
        <p>「文字をバラバラにする」用途だけならどちらでも代用できますが、実務では明確な役割の違いがあります。</p>
        <ul>
          <li><code>split()</code> は<strong>「文字列」</strong>専用の命令</li>
          <li><code>Array.from()</code> は<strong>「配列に似たデータ（HTML要素など）」</strong>専用の命令</li>
        </ul>

        <p><strong>HTML要素を扱うときの実務例：</strong></p>
        <p><code>document.querySelectorAll("li")</code> などで取得したHTML要素の集まりは、配列のようで配列ではない「NodeList」というデータです。これには
          <code>split</code> は使えません。
        </p>
        <pre><code>// 画面上のすべての &lt;li&gt; タグを取得
const liElements = document.querySelectorAll("li");

// ❌ エラー！liElementsは文字列ではないので、splitは存在しません。
liElements.split("");

// ⭕ 大正解！これで本物の配列に変換され、配列用の便利な命令が使えるようになります。
const liArray = Array.from(liElements);</code></pre>

        <h3 class="sub-heading">2. 【要注意】スペースの有無で激変する split() の挙動</h3>
        <p>カッコの中の「半角スペース」の有無で、切り分けるルールが完全に変わります。ここが一番の勘違いポイントです。元のデータが <code>"WEB DESIGN"</code> の場合の挙動は以下の通りです。
        </p>

        <table class="lesson-table">
          <thead>
            <tr>
              <th>書き方</th>
              <th>カッコの中身</th>
              <th>どう切り分ける？</th>
              <th>出力結果</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><code>text.split("")</code></td>
              <td>"" （空白なし）</td>
              <td>文字の隙間で区切るため、<strong>1文字ずつ</strong>バラバラになる</td>
              <td><code>["W", "E", "B", " ", "D", "E", "S", "I", "G", "N"]</code></td>
            </tr>
            <tr>
              <td><code>text.split(" ")</code></td>
              <td>" " （半角スペース1個）</td>
              <td><strong>スペースがある場所</strong>で区切る（単語ごと）</td>
              <td><code>["WEB", "DESIGN"]</code></td>
            </tr>
            <tr>
              <td><code>text.split()</code></td>
              <td>完全に空っぽ</td>
              <td>区切る場所が不明なため、<strong>丸ごと1つの塊</strong>のままになる</td>
              <td><code>["WEB DESIGN"]</code></td>
            </tr>
          </tbody>
        </table>

        <h3 class="sub-heading">3. 文字列を「配列化」する3つの非破壊アプローチ</h3>
        <p>文字列を配列にする方法は、<code>split</code> や <code>Array.from</code> 以外にもう1つモダンな王道手法があります。すべて元の文字列を傷つけません。</p>
        <dl class="board-dl">
          <dt>手法①：Array.from(b)</dt>
          <dd>引数に渡した文字列を、自動的に1文字ずつバラバラの配列にします（非破壊）。</dd>
          <dt>手法②：b.split("")</dt>
          <dd>空文字を区切り線にして、1文字ずつバラバラにします（非破壊）。</dd>
          <dt>手法③：[...b] （スプレッド構文）</dt>
          <dd>現在の実務・モダン開発で非常によく使われます。文字の前にドットを3つ書くだけで一瞬で配列化できます。</dd>
        </dl>
        <pre><code>const b = "123";
const arr = [...b]; // 結果: ["1", "2", "3"] （元のbは傷つかない）</code></pre>

        <h3 class="sub-heading">4. 実務で必須の「非破壊 vs 破壊的」メソッド一覧</h3>
        <p>JavaScriptの文字列操作は<strong>100%すべて非破壊</strong>ですが、配列の操作には元のデータを書き換えてしまう「破壊的メソッド」が存在するため、使い分けが鉄則です。</p>

        <p><strong>💡 安全：実務で推奨される「非破壊メソッド」</strong></p>
        <ul>
          <li><code>map()</code> ：配列の要素を1つずつ加工して、<strong>新しい配列</strong>を作る。</li>
          <li><code>filter()</code> ：条件に合う要素だけを抽出して、<strong>新しい配列</strong>を作る。</li>
          <li><code>slice()</code> ：配列の一部を安全に切り抜いて、<strong>新しい配列</strong>を作る。</li>
          <li><code>concat()</code> ：配列と配列をドッキングして、<strong>新しい配列</strong>を作る。</li>
          <li><code>replace()</code> / <code>replaceAll()</code> ：（文字列用）一部の文字を置き換えた<strong>新しい文字列</strong>を返す。
          </li>
        </ul>

        <p><strong>⚠ 危険：元のデータを直接書き換える「破壊的メソッド」</strong></p>
        <p>これらを実行すると、元の変数の中身が直接傷つき、書き換わってしまいます。バグの原因になりやすいため注意が必要です。</p>
        <ul>
          <li><code>push()</code> / <code>pop()</code> ：配列の末尾に対して要素を追加・削除する.</li>
          <li><code>shift()</code> / <code>unshift()</code> ：配列の先頭に対して要素を削除・追加する.</li>
          <li><code>splice()</code> ：配列の途中の要素を直接書き換え・削除する。※<code>slice</code>と混同注意！</li>
          <li><code>sort()</code> ：配列の順番を強制的に並び替える。</li>
          <li><code>reverse()</code> ：配列の順番をひっくり返す。</li>
        </ul>

        <h3 class="sub-heading">5. 覚えておくべき3つの注意点・落とし穴</h3>
        <ul>
          <li><strong>落とし穴 1：ただの「数値」に使うとエラー、または空っぽになる</strong><br><code>split()</code> や
            <code>Array.from()</code> は、ただの数値（<code>123</code> など）には使えません。必ず <code>String()</code>
            などで文字列に変換してから使いましょう。
          </li>
          <li><strong>落とし穴 2：サロゲートペア（絵文字など）の文字化け問題</strong><br><code>split("")</code>
            は、絵文字や一部の特殊な漢字（サロゲートペア）をパカッと割ると、文字化け（バグ）を起こします。絵文字が含まれる可能性がある場合は、安全な <code>Array.from()</code> か
            スプレッド構文<code>[...]</code> を使うのがプロの鉄則です。</li>
          <li><strong>落とし穴 3：大文字・小文字を絶対に間違えない</strong><br><code>Array.from()</code>
            の「A」は、必ず<strong>大文字</strong>です。小文字で <code>array.from()</code> と書くとエラーになります。</li>
        </ul>

        <h3 class="sub-heading">6. どう使い分ける？（全体のまとめ）</h3>
        <ul>
          <li><strong>カンマやスラッシュなどの特定の文字で区切りたい：</strong> ➔ <code>split(",")</code> や <code>split("/")</code>
            を使う。</li>
          <li><strong>半角スペースで区切って単語ごとに分けたい：</strong> ➔ <code>split(" ")</code> を使う。</li>
          <li><strong>単純に普通の文字を1文字ずつバラバラにしたい：</strong> ➔ <code>split("")</code> や <code>[...文字列]</code> でOK。
          </li>
          <li><strong>HTMLの要素を本物の配列に変えたい / 絵文字を安全にバラバラにしたい：</strong> ➔ <code>Array.from()</code> を使う。</li>
        </ul>
      </section>

      <!-- ← 前へ戻る（リンク先へ） -->
      <p style="margin-top: 25px;">
        <a href="study_index.php" class="td-link">←前のページへ</a>
      </p>
    </main>
  </div>

  <a href="#" class="top-button">▲ TOP</a>
</body>

</html>