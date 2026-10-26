<!DOCTYPE html>
<html lang="ja">

<head>
  <title>JavaScript 基礎問題（ループ・条件分岐・配列操作） | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <!-- 📝 クイズエリア全体を包む大きなグレーの枠 -->
      <section class="quiz-container">
        <h2 class="note-title" style="border-left-color: #1e3a8a; margin-bottom: 20px;">JavaScript 基礎問題</h2>
        <p style="margin-bottom: 20px; color: #475569; font-size: 15px;">ループ・条件分岐・配列操作（全10問）</p>

        <!-- 第1問 -->
        <div class="quiz-box">
          <p class="quiz-question">第1問：for文による規則的なループ</p>
          <p><code>for</code>文を使って、コンソール（<code>console.log</code>）に 1 から 31 までの数字を順番に出力するループ処理を記述してください。（カレンダーの日付を順番に出力していく基礎となる処理です）</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>for (let i = 1; i <= 31; i++) {
    console.log(i);
}</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>JavaScriptの最も王道なループ処理である <code>for</code>文 の基本構造です。カッコ内は <code>(初期化式; 条件式; 変化式)</code> で構成され、セミコロン <code>;</code> で区切ります。変数 <code>i</code> が 1 からスタートし、31以下である間、1ずつ増えながら（ <code>i++</code> ）波カッコ内の処理を繰り返します。</p>
            </div>
          </details>
        </div>

        <!-- 第2問 -->
        <div class="quiz-box">
          <p class="quiz-question">第2問：うるう年の判定ロジック</p>
          <p>変数 <code>year</code> に西暦（例: 2024）が入っています。うるう年の条件「4で割り切れて、かつ100で割り切れない。または、400で割り切れる」を判定し、うるう年なら "うるう年です"、そうでないなら "平年です" と出力する条件式（if-else文）を記述してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0) {
    console.log("うるう年です");
} else {
    console.log("平年です");
}</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>カレンダー作成において2月の日数を決めるための必須ロジックです。「AかつB」を表す論理演算子 <code>&&</code> と、「AまたはB」を表す <code>||</code> を組み合わせて判定します。余りを求める <code>%</code> を使い、割り切れる（余りが0）かどうかをチェックしています。</p>
            </div>
          </details>
        </div>

        <!-- 第3問 -->
        <div class="quiz-box">
          <p class="quiz-question">第3問：各月の日数を割り出す分岐</p>
          <p>変数 <code>month</code> に月（1〜12の数値）が入っています。switch-case文を使って、大の月（1, 3, 5, 7, 8, 10, 12月）なら変数 <code>days</code> に <code>31</code> を代入し、小の月（4, 6, 9, 11月）なら <code>30</code> を代入する処理を効率よく記述してください。（※2月は除外して考えて構いません）</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>let days;
switch (month) {
    case 1: case 3: case 5: case 7: case 8: case 10: case 12:
        days = 31;
        break;
    case 4: case 6: case 9: case 11:
        days = 30;
        break;
}</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>switch-case文では、処理が同じになる条件を <code>case 1: case 3:</code> のように横や縦に並べて「まとめて記述（フォールスルーの応用）」することができます。このように書くことで、何度も同じ代入処理を書く必要がなくなり、綺麗なコードになります。</p>
            </div>
          </details>
        </div>

        <!-- 第4問 -->
        <div class="quiz-box">
          <p class="quiz-question">第4問：do-while文の性質</p>
          <p>while文とdo-while文の決定的な違いについて、「処理が実行される回数」の視点から簡単に説明してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <p>while文は最初から条件が合わないと一度も実行されませんが、do-while文は条件に関わらず「必ず最低1回は最初に対象の処理が実行される」という違いがあります。</p>
              <p>📌 <strong>解説：</strong></p>
              <p>while文はループの「最初」に条件判定を行うのに対し、do-while文はループの「最後（後判定）」に条件チェックを行います。そのため、たとえ最初から条件式が <code>false</code> であっても、 <code>do</code> の中身が一度だけ実行されるのが特徴です。</p>
            </div>
          </details>
        </div>
        <!-- 第5問 -->
        <div class="quiz-box">
          <p class="quiz-question">第5問：alertによるポップアップ警告</p>
          <p>万年カレンダーの入力フォームで、ユーザーが「2000年より前の年」を入力したときに、ブラウザに「2000年以降を指定してください」という警告メッセージのポップアップ画面を表示させる命令を記述してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>alert("2000年以降を指定してください");</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>ユーザーに対して強制的にメッセージを通知し、確認を促すためのブラウザ組み込み命令が <code>alert()</code> です。カッコの中に表示したい文字列をクォーテーションで囲んで渡します。OKボタンが押されるまで次の処理は一時停止します。</p>
            </div>
          </details>
        </div>

        <!-- 第6問 -->
        <div class="quiz-box">
          <p class="quiz-question">第6問：要素の動的取得と静的取得の違い</p>
          <p>JavaScriptでHTML要素を取得する際、 <code>getElementById</code> に代表される「動的（ライブ）取得」と、 <code>querySelector</code> に代表される「静的（スタティック）取得」の根本的な違いを説明してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <p>動的取得は、取得した後にHTML要素（子要素の数など）が変化すると、JavaScript側のデータも自動的に最新の状態に更新されます。一方、静的取得は、データを作成した瞬間の状態のまま固定され、後からHTMLが変化しても自動更新されません。</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>getElementById</code> や <code>getElementsByClassName</code> などで取得したオブジェクト（HTMLCollectionなど）は生きており、HTMLの増減に追従します。しかし、 <code>querySelector</code> や <code>querySelectorAll</code> で取得したオブジェクト（NodeList）は、いわばその瞬間のスナップショット（写真）であるため、後から要素を追加・削除しても中身が自動で書き換わることはありません。</p>
            </div>
          </details>
        </div>

        <!-- 第7問 -->
        <div class="quiz-box">
          <p class="quiz-question">第7問：HTMLコレクション（HTMLCollection）の特徴</p>
          <p><code>getElementsByClassName</code> などで複数の要素を一括取得した際、戻り値となる「HTMLCollection（HTMLコレクション）」のデータ型について、配列（Array）との最大の違いは何ですか？</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <p>HTMLCollectionは「配列に似たデータ構造（配列風オブジェクト）」であり、本物の配列ではないため、配列専用の便利なメソッド（ <code>push()</code> , <code>map()</code> , <code>filter()</code> など）を直接使うことができません。</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>length</code> プロパティを持っていたり、 <code>[0]</code> や <code>[1]</code> のように添字で中身を取り出せる点は配列と共通していますが、本物の配列ではありません。もし配列のメソッドを使いたい場合は、 <code>Array.from(コレクション)</code> などの命令を使って一度本物の配列に変換してあげる必要があります。</p>
            </div>
          </details>
        </div>
        <!-- 第8問 -->
        <div class="quiz-box">
          <p class="quiz-question">第8問：insertAdjacentHTMLによる要素の挿入</p>
          <p>HTML上に <code>&lt;div id="calendar-body"&gt;&lt;/div&gt;</code> があります。JavaScriptで要素を取得し、この要素の「最初の子要素として（開始タグのすぐ後ろに）」 <code>&lt;p&gt;新しい行&lt;/p&gt;</code> というHTML文字列を直接挿入するコードを、 <code>insertAdjacentHTML</code> を使って記述してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const body = document.getElementById("calendar-body");
body.insertAdjacentHTML("afterbegin", "&lt;p&gt;新しい行&lt;/p&gt;");</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>カレンダーのマス目（trやtdなど）を文字列のループ処理で一気に組み立てて流し込む際、非常によく使われる重要な命令です。要素のどこに差し込むかを指定する第一引数には、以下の4つのキーワードのいずれかを指定します。</p>
              <ul>
                <li><code>"beforebegin"</code> ：要素の直前（外側）</li>
                <li><code>"afterbegin"</code> ：要素内の先頭（内側の一番上）★ 今回の正解</li>
                <li><code>"beforeend"</code> ：要素内の末尾（内側の一番下 / appendに相当）</li>
                <li><code>"afterend"</code> ：要素の直後（外側）</li>
              </ul>
            </div>
          </details>
        </div>

        <!-- 第9問 -->
        <div class="quiz-box">
          <p class="quiz-question">第9問：classList.add によるクラスの追加</p>
          <p>HTML上に <code>&lt;div id="box"&gt;&lt;/div&gt;</code> があります。この要素が元々持っているクラス設定を消さずに、新しく <code>"active"</code> というクラス名「だけ」を追加するコードを、 <code>classList</code> を使って記述してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const box = document.getElementById("box");
box.classList.add("active");</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p><code>box.className = "active"</code> と書くと、その要素が元々持っていた他のクラスが全て消えて（上書きされて）しまいます。既存のクラスを維持したまま、特定のクラスを追加したい場合は <code>classList.add("クラス名")</code> を使うのが実務およびテストでの鉄則です。カレンダーの「土曜日や日曜日の色付け」を部分的に追加する際などに重宝します。</p>
            </div>
          </details>
        </div>

        <!-- 第10問 -->
        <div class="quiz-box">
          <p class="quiz-question">第10問：classList.remove と toggle の使い分け</p>
          <p>要素から特定のクラスを完全に削除する命令（①）と、クラスがついていれば消し、ついていなければ付けるという切り替えを行う命令（②）を、それぞれ <code>classList</code> を使って記述してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <p>① 削除： <code>要素.classList.remove("クラス名");</code><br>
              ② 切り替え： <code>要素.classList.toggle("クラス名");</code></p>
              <p>📌 <strong>解説：</strong></p>
              <p>万年カレンダーの課題で、エラーが起きた時にだけエラー表示用のクラス（ <code>display: block;</code> などが効くクラス）を制御したい場合に必須の命令です。完全に消し去りたいときは <code>remove</code> 、クリックするたびに状態を反転（スイッチのような動作）させたいときは <code>toggle</code> を使用します。</p>
            </div>
          </details>
        </div>

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
