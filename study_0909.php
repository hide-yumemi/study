<!DOCTYPE html>
<html lang="ja">

<head>
  <title>JavaScript 基礎問題（関数・DOM操作・応用処理） | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <!-- 📝 クイズエリア全体を包む大きなグレーの枠 -->
      <section class="quiz-container">
        <h2 class="note-title" style="border-left-color: #1e3a8a; margin-bottom: 20px;">JavaScript 基礎問題</h2>
        <p style="margin-bottom: 20px; color: #475569; font-size: 15px;">関数・DOM操作・応用処理（全11問）</p>

        <!-- 第1問 -->
        <div class="quiz-box">
          <p class="quiz-question">第1問：アロー関数への書き換え</p>
          <p>次の関数をアロー関数に書き換えてください。</p>
<pre><code>const greeting = function(name) {
    return "こんにちは、" + name + "さん";
};</code></pre>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const greeting = (name) => "こんにちは、" + name + "さん";

// またはテンプレートリテラルを使用した場合
// const greeting = name => `こんにちは、${name}さん`;</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>変換ルールは、① <code>function</code> という文字を消す、② 引数のカッコの後ろに <code>=></code> 矢印を合体させる、の2ステップです。引数を記述した時点で、その関数内専用の臨時変数（自動受け取りボックス）が作られます。</p>
            </div>
          </details>
        </div>

        <!-- 第2問 -->
        <div class="quiz-box">
          <p class="quiz-question">第2問：アロー関数 sayAge の作成</p>
          <p>引数として年齢（<code>age</code>）を受け取ると、「〇〇才です！」という文字を合体させて返すアロー関数 <code>sayAge</code> を作成してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const sayAge = (age) => `${age}才です！`;</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>アロー関数は、波カッコ <code>{}</code> を省略して1行で書くと、右側の計算結果を自動的に <code>return</code>（返却）するというルールを持っています。また、バッククォート（ <code>`</code> ）の中に <code>${変数}</code> を入れる「テンプレートリテラル」を使うことで、従来の <code>+</code> で繋ぐ方法に比べて劇的にスッキリ記述できます。</p>
            </div>
          </details>
        </div>

        <!-- 第3問 -->
        <div class="quiz-box">
          <p class="quiz-question">第3問：アロー関数の短縮形 formatPrice</p>
          <p>定数 <code>price</code> を宣言し、数値の <code>1500</code> を代入してください。アロー関数を使って、引数として受け取った数値に「円」という文字を合体させて返す関数 <code>formatPrice</code> を作成してください（※1行の省略形で記述してください）。最後に、作成した関数に <code>price</code> を渡して実行し、その結果を <code>console.log()</code> で出力してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const price = 1500;
const formatPrice = num => `${num}円`;
console.log(formatPrice(price));</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>引数が1つの場合は、引数を囲む丸カッコ <code>()</code> も省略可能です（ <code>num =></code> ）。1行省略形（波カッコとreturnの省略）とテンプレートリテラルを組み合わせることで、関数定義を非常にコンパクトに記述できます。</p>
            </div>
          </details>
        </div>

        <!-- 第4問 -->
        <div class="quiz-box">
          <p class="quiz-question">第4問：DOM操作（文字の書き換え）</p>
          <p>HTMLにある <code>&lt;p id="text"&gt;こんにちは&lt;/p&gt;</code> という文字を、JavaScriptで「さようなら」に書き換える正しい命令は？</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>document.getElementById("text").textContent = "さようなら";</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>id名の <code>"text"</code> をクォーテーションで囲まないと変数扱いになりエラーになります。要素を取得した後の設定プロパティである <code>textContent</code> （Cは大文字）は関数ではないため、 <code>()</code> ではなく <code>=</code> を使って文字列を上書き代入します。</p>
            </div>
          </details>
        </div>
        <!-- 第5問 -->
        <div class="quiz-box">
          <p class="quiz-question">第5問：フォームの入力値取得</p>
          <p>HTMLに <code>id="email"</code> という入力欄（ <code>&lt;input&gt;</code> タグ）があります。定数 <code>emailInput</code> を宣言し、要素を取得して代入してください。その後、入力欄に現在打ち込まれている「中身の文字列」を取得し、 <code>console.log()</code> で出力してください。</p>
<pre><code>&lt;input type="email" id="email" value="test@example.com"&gt;</code></pre>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const emailInput = document.getElementById("email");
console.log(emailInput.value);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>pタグなどの通常のHTML要素のテキストを扱うときは <code>textContent</code> を使いますが、フォーム要素（inputやtextarea）に入力された現在の値を取得するときは <code>.value</code> プロパティを使用するルールになっています。</p>
            </div>
          </details>
        </div>

        <!-- 第6問 -->
        <div class="quiz-box">
          <p class="quiz-question">第6問：要素の作成と追加</p>
          <p>定数 <code>newDiv</code> を宣言し、新しく <code>div</code> タグ（要素）を作成して代入してください。その <code>newDiv</code> の中に文字の "Hello" を設定してください。最後に、すでに画面にある親要素（変数 <code>board</code> ）の一番最後の子要素として <code>newDiv</code> を追加してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const newDiv = document.createElement("div");
newDiv.textContent = "Hello";
board.append(newDiv);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>JavaScript側で新しくHTMLタグを生成するには <code>document.createElement("タグ名")</code> を使用します。作成しただけでは画面に表示されないため、指定した親要素の末尾に <code>.append()</code> や <code>.appendChild()</code> を使って結合（差し込み）を行います。</p>
            </div>
          </details>
        </div>

        <!-- 第7問 -->
        <div class="quiz-box">
          <p class="quiz-question">第7問：map メソッド</p>
          <p>配列の各要素に対してコールバック関数を実行し、その結果から新しい配列を作成・返却するメソッドは？</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：map() メソッド</p>
<pre><code>const numbers =;
const doubled = numbers.map(num => num * 2); // [2, 4, 6]</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>元の配列を壊さずに（イミュータブル）、中身を同じ数だけ一斉に加工した新しい配列を作ります。元の配列の「要素の数」を維持したまま、中身を一斉にリフォームするイメージです。ただの繰り返し処理である <code>forEach</code> や、条件に合うものだけの絞り込みを行う <code>filter</code> と使い分けます。</p>
            </div>
          </details>
        </div>

        <!-- 第8問 -->
        <div class="quiz-box">
          <p class="quiz-question">第8問：filter メソッド</p>
          <p>配列から、特定の条件に合う要素「だけ」を狙い撃ちして取り出して、新しい配列を作るメソッドはどれですか？</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：filter() メソッド</p>
              <p>📌 <strong>解説：</strong></p>
              <p>各要素に対して <code>true</code>（残す）か <code>false</code>（捨てる）かを判定し、条件に合うものだけを絞り込んで新しい配列を生成します。もし一致する要素が1つもない場合は、エラーやnullになるのではなく、「空っぽの配列（ <code>[]</code> ）」が返ってきます。そのため、データが見つかったかどうかの判定は <code>if (result.length > 0)</code> のように配列の長さで行うのが鉄則です。</p>
            </div>
          </details>
        </div>
        <!-- 第9問 -->
        <div class="quiz-box">
          <p class="quiz-question">第9問：属性の操作（setAttribute）</p>
          <p>HTMLに <code>id="submit-btn"</code> というボタン要素があります。定数 <code>btn</code> を宣言してこの要素を取得し、JavaScriptからこのボタンをクリックできない状態（<code>disabled</code> 属性を付与）にするコードを記述してください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>const btn = document.getElementById("submit-btn");
btn.setAttribute("disabled", "true");</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>クラス（<code>classList</code>）以外の、HTMLタグが持つあらゆる属性（ボタンの無効化 <code>disabled</code>、画像のパス <code>src</code>、リンク先 <code>href</code> など）を後から追加・変更するときは <code>.setAttribute("属性名", "値")</code> を使用します。<code>innerHTML</code> などは悪意のあるスクリプトを埋め込まれる脆弱性（XSS）の危険があるため、属性や文字を変更する際は <code>setAttribute</code> や <code>textContent</code> をピンポイントで使い分けるのが実務での鉄則です。</p>
            </div>
          </details>
        </div>

        <!-- 第10問 -->
        <div class="quiz-box">
          <p class="quiz-question">第10問：イベントリスナー</p>
          <p>画面にあるボタン（変数 <code>button</code>）がクリックされたときに特定の処理（関数）を実行させたい場合の命令は？</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
<pre><code>button.addEventListener("click", () => { ... });</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>先頭に add がつき、Lが大文字になる <code>addEventListener</code> を使います。構造は <code>( "①どんな操作を待つか", ②動かす関数 )</code> となっており、カッコの中にコンマで区切って2つの材料を並べます。第一引数の <code>"click"</code> は自分で決めた言葉ではなく、JavaScriptのルールであらかじめ決まっているイベントキーワード（文字列データ）です。</p>
            </div>
          </details>
        </div>

        <!-- 第11問 -->
        <div class="quiz-box">
          <p class="quiz-question">第11問：タイマー処理（setTimeout と setInterval の違い）</p>
          <p>「3秒後に一度だけ処理を実行したい場合」と、「3秒ごとに周期的に処理を繰り返したい場合」に使用するJavaScriptのタイマー命令をそれぞれ順に答えてください。</p>
          
          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <p>一度だけ実行： <code>setTimeout(関数, 3000);</code><br>
              定期的に実行： <code>setInterval(関数, 3000);</code></p>
              <p>📌 <strong>解説：</strong></p>
              <p>第二引数に渡す時間の単位は「ミリ秒（1秒 = 1000ミリ秒）」で指定するため、3秒の場合は <code>3000</code> と記述します。なお、 <code>setInterval</code> は時間的なズレが蓄積しやすいため、実務で厳密なタイマー（時計アプリなど）を作る際は、 <code>setTimeout</code> の処理の最後で自分自身をもう一度呼び出す「自己呼び出し型（再帰呼出）」にする方がズレを制御しやすく推奨されます。</p>
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
