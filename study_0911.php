<!DOCTYPE html>
<html lang="ja">

<head>
  <title>JavaScript 基礎問題（thisの挙動・二次元配列・応用） | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <!-- 📝 クイズエリア全体を包む大きなグレーの枠 -->
      <section class="quiz-container">
        <h2 class="note-title" style="border-left-color: #1e3a8a; margin-bottom: 20px;">JavaScript 基礎問題</h2>
        <p style="margin-bottom: 20px; color: #475569; font-size: 15px;">thisの挙動・二次元配列・応用処理（全10問）</p>

        <!-- 第1問 -->
        <div class="quiz-box">
          <p class="quiz-question">第1問：イベントリスナー内での「this」の指すもの</p>
          <p>HTMLのボタン要素を取得し、クリックイベントを設定しました。以下のコードにおいて、関数内の <code>this</code> は一体何を指し示しているか説明してください。</p>
          <pre><code>const btn = document.getElementById("submit-btn");
btn.addEventListener("click", function() {
    console.log(this);
});</code></pre>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：イベントが発生した要素そのもの（この場合は、id="submit-btn" がついたボタン要素）を指します。</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>addEventListener</code> の中で通常の関数（ <code>function() {}</code> ）を使うと、その中で使われる <code>this</code> は「イベントの発生源となったHTML要素」を自動的に指すルールになっています。これを利用すると、例えば <code>this.style.color = "red";</code> と書くだけで、クリックされた要素自身の文字色を直接変更することができます。</p>
            </div>
          </details>
        </div>

        <!-- 第2問 -->
        <div class="quiz-box">
          <p class="quiz-question">第2問：this活用の注意点（アロー関数との罠）</p>
          <p>第1問のコードにおいて、関数を以下のように「アロー関数（ <code>() => {}</code> ）」に書き換えた場合、内部の <code>this</code> の挙動はどう変化するか説明してください。</p>
          <pre><code>btn.addEventListener("click", () => {
    console.log(this); // 挙動が変わる
});</code></pre>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：アロー関数内の <code>this</code> はボタン要素を指さなくなり、その関数の外側のスコープにある <code>this</code> （通常はブラウザの最上位オブジェクトである <code>window</code> ）をそのまま引き継いでしまいます。</p>
              <p>📌 <strong>解説：</strong></p>
              <p>アロー関数は「自分自身の <code>this</code> を持たない」という特殊な性質を持っています。そのため、イベントリスナー内でアロー関数を使うと、クリックされた要素を <code>this</code> で狙い撃ちすることができなくなります。イベント発生源の要素を扱いたい場合は、通常の <code>function() {}</code> を使うか、引数からイベントオブジェクトを受け取って <code>e.target</code> を使うのが鉄則です。</p>
            </div>
          </details>
        </div>

        <!-- 第3問 -->
        <div class="quiz-box">
          <p class="quiz-question">第3問：二次元配列の基本構造とデータの取り出し</p>
          <p>1週間分の曜日の並びを表現するために、以下のような二次元配列 <code>weeks</code> を作成しました。この配列から、文字列の "火" をピンポイントでコンソールに出力したい場合、どのように記述すればよいか答えてください。</p>
          <pre><code>const weeks = [
    ["日", "月", "火", "水", "木", "金", "土"], // 0番目の行
    ["日", "月", "火", "水", "木", "金", "土"]  // 1番目の行
];</code></pre>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：<code>console.log(weeks[0][2]);</code> （または <code>console.log(weeks[1][2]);</code> も可）</p>
              <p>📌 <strong>解説：</strong></p>
              <p>配列の中にさらに配列が入っている構造を「二次元配列」と呼びます。カレンダーの縦横のマス目を管理するのに非常に相性が良い構造です。データを取り出す際は、 <code>配列名[行番号][列番号]</code> の順番で指定します。JavaScriptのカウントは 0 から始まるため、最初の行（0）の中の「日(0)・月(1)・火(2)」ということで <code>weeks[0][2]</code> になります。</p>
            </div>
          </details>
        </div>

        <!-- 第4問 -->
        <div class="quiz-box">
          <p class="quiz-question">第4問：DOM操作における innerHTML の脆弱性（XSS危険性）</p>
          <p>画面を書き換える際に <code>innerHTML</code> ではなく <code>textContent</code> や <code>insertAdjacentHTML</code> を優先して使うべき理由を、「セキュリティ（脆弱性）」の観点から説明してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：innerHTMLは受け取った文字列をそのままHTMLとして解析して実行するため、ユーザーの入力欄に悪意のあるスクリプト（プログラム）を仕込まれた場合、それがブラウザ上で勝手に実行されてしまう脆弱性（XSS: クロスサイトスクリプティング）が発生する危険があるからです。</p>
              <p>📌 <strong>解説：</strong></p>
              <p>万年カレンダーのように、ユーザーが画面から「西暦」や「月」を自由に打ち込めるフォームがある場合、入力された文字をそのまま <code>innerHTML</code> で画面に流し込むのは非常に危険です。 <code>textContent</code> は万が一スクリプトが入力されても「ただの文字列（テキスト）」として安全に表示し、 <code>insertAdjacentHTML</code> は挿入位置を厳密に限定できるため、安全性が高くなります。</p>
            </div>
          </details>
        </div>
        <!-- 第5問 -->
        <div class="quiz-box">
          <p class="quiz-question">第5問：配列風オブジェクトを本物の配列に変換する方法</p>
          <p>HTMLCollectionなどの配列風オブジェクトを、本物の配列に変換して <code>forEach</code> などの便利なループ命令を使えるようにするための、JavaScriptに用意されている標準的な命令（メソッド）を記述してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：Array.from(変換したいコレクション)</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>const elements = document.getElementsByClassName("item");</code> で取得したデータはそのままでは配列のメソッドが使えませんが、 <code>const arr = Array.from(elements);</code> とすることで、本物の配列に生まれ変わり、高度なデータ操作が一気に可能になります。</p>
            </div>
          </details>
        </div>

        <!-- 第6問 -->
        <div class="quiz-box">
          <p class="quiz-question">第6問：関数の戻り値（return）の役割</p>
          <p>JavaScriptの関数において、処理の途中で <code>return</code> を記述することの役割（効果）を、次の2つの視点から簡潔に説明してください。</p>
          <p>① 関数を呼び出した側への効果<br>② その関数の内部の処理に対する効果</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <p>① 関数を呼び出した側に、計算結果などの「値（戻り値）」を返す。<br>
                ② return が実行された時点で、その関数の残りの処理をすべて無視して「関数をその場で強制終了」させる。</p>
              <p>📌 <strong>解説：</strong></p>
              <p>カレンダー作成のプログラムで、「2000年より前なら、警告を出して処理を中断する」というガード文を作る際に大活躍する仕組みです。関数の中で <code>if (year &lt; 2000) { alert("エラー"); return; }</code> と書くことで、値を返さずに関数を途中で安全にストップさせることができます。</p>
            </div>
          </details>
        </div>

        <!-- 第7問 -->
        <div class="quiz-box">
          <p class="quiz-question">第7問：ボタンの初期非表示（CSSとDOMの連動）</p>
          <p>JavaScriptを使い、特定の条件（正しい西暦と月が入力されたとき）を満たした瞬間に、前月ボタン（ <code>id="mae"</code> ）を画面に表示させるための、もっとも標準的なJavaScriptの記述を1行書いてください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：document.getElementById("mae").style.display = "block";</p>
              <p>（または "inline-block" など）</p>
              <p>📌 <strong>解説：</strong></p>
              <p>カレンダーがまだ生成されていない初期状態では、前月・次月ボタンをクリックさせないように非表示（ <code>display: none;</code> ）に設定しておくのが実務的なUI設計です。JavaScriptから <code>要素.style.display = "block"</code> とスタイルプロパティを直接書き換えることで、必要なタイミングで画面に出現させることができます。</p>
            </div>
          </details>
        </div>
        <!-- 第8問 -->
        <div class="quiz-box">
          <p class="quiz-question">第8問：フォーム入力値の取得とデータ型の罠</p>
          <p>HTMLに <code>&lt;input type="text" id="month-input"&gt;</code> という月の入力欄があります。JavaScriptで <code>const m = document.getElementById("month-input").value;</code> として値を取得したとき、変数 <code>m</code> に格納されているデータの「型（データ型）」は何ですか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：文字列型（String型）</p>
              <p>📌 <strong>解説：</strong></p>
              <p>画面の入力欄から取得した値（ <code>.value</code> ）は、たとえユーザーが半角の <code>8</code> などの数値を打ち込んでいたとしても、JavaScriptの内部では必ず「文字列の <code>"8"</code> 」として取得されてしまいます。そのまま月の日数計算（足し算など）に使うと、予期せぬ文字連結バグが起きるため、 <code>Number(m)</code> や <code>parseInt(m, 10)</code> を使って数値型に変換してから扱うのが鉄則です。</p>
            </div>
          </details>
        </div>

        <!-- 第9問 -->
        <div class="quiz-box">
          <p class="quiz-question">第9問：イベントの読み込みタイミング（DOMContentLoaded）</p>
          <p>HTMLの読み込み（解析）が完了し、DOMツリーが完全に構築された直後にJavaScriptを実行させたい場合、 <code>document.addEventListener</code> に設定すべき正しいイベントキーワード（文字列）は何ですか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解："DOMContentLoaded"</p>
              <p>📌 <strong>解説：</strong></p>
              <p>HTMLの記述よりも上に <code>&lt;script&gt;</code> タグを書いている場合、JavaScriptが動く時点ではまだ下のHTML要素（ボタンや入力欄）が生まれていないため、取得エラー（ <code>null</code> エラー）になってしまいます。 <code>"DOMContentLoaded"</code> イベントの中で処理を包むことで、ブラウザがHTMLの構造を読み込み終わるのを安全に待ってからプログラムを開始させることができます。</p>
            </div>
          </details>
        </div>

        <!-- 第10問 -->
        <div class="quiz-box">
          <p class="quiz-question">第10問：複合問題（カレンダーマス目のループ設計）</p>
          <p>変数 <code>totalDays</code> に当月の日数（例: 31）、変数 <code>startDayOfWeek</code> にその月の最初の日の曜日番号（0=日, 1=月...）が入っています。カレンダーのテーブルを作る際、日付が入らない「空白のマス（td）」を最初の曜日の数だけループで生成し、続けて「1から末日までの日付のマス（td）」を生成する、という2つの処理の流れをイメージした空のfor文の構成を2組記述してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>// ① 開始日より前の空白マスを作るループ
for (let i = 0; i &lt; startDayOfWeek; i++) {
    // 空白のtdを挿入する処理
}

// ② 1日から末日までを順番に作るループ
for (let day = 1; day &lt;= totalDays; day++) {
    // 日付入りのtdを挿入する処理
}</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>万年カレンダーの核心となるループ処理の組み立て方です。例えば、1日が「水曜日（曜日番号3）」から始まる場合、水曜日の手前（日・月・火）に3つ分の空のマス目を敷き詰める必要があります（①のループが3回まわる）。その後、1日から31日までを順番に生成していく（②のループが31回まわる）ことで、曜日と日付が完璧に一致した綺麗なカレンダーの土台が出来上がります。</p>
            </div>
          </details>
        </div>

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
<!-- http://localhost/study/study_0911.php -->