<!DOCTYPE html>
<html lang="ja">

<head>
  <title>JavaScript 基礎問題（データ操作・型変換・配列・オブジェクト） | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <!-- 📝 クイズエリア全体を包む大きなグレーの枠 -->
      <section class="quiz-container">
        <h2 class="note-title" style="border-left-color: #1e3a8a; margin-bottom: 20px;">JavaScript 基礎問題</h2>
        <p style="margin-bottom: 20px; color: #475569; font-size: 15px;">データ操作・型変換・配列・オブジェクト（全10問）</p>

        <!-- 第1問 -->
        <div class="quiz-box">
          <p class="quiz-question">第1問：型変換（文字列から数値への計算）</p>
          <p>定数 <code>stringAge</code> を宣言し、文字列の <code>"25"</code> を代入してください。<code>stringAge</code> を本物の数値（整数）に変換し、その値に <code>5</code> を足し算した結果を <code>console.log()</code> で出力してください。（期待する出力結果：<code>30</code>）</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>const stringAge = "25";
console.log(Number(stringAge) + 5);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>文字列のまま <code>+ 5</code> を行うと、JavaScriptは文字のくっつけ算（連結）と判断して <code>"255"</code> を出力してしまいます。そのため、頭文字が大文字の <code>Number()</code> で囲うことで、安全に本物の数値へ型変換してから計算させます。</p>
            </div>
          </details>
        </div>

        <!-- 第2問 -->
        <div class="quiz-box">
          <p class="quiz-question">第2問：型変換（数値から文字列への変換と文字数）</p>
          <p>定数 <code>num</code> を宣言し、数値の <code>123</code> を代入してください。この数値を文字列の <code>"123"</code> に変換し、その文字の長さを <code>.length</code> で取得して <code>console.log()</code> で出力してください。（期待する出力結果：<code>3</code>）</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>const num = 123;
const string_num = String(num);
console.log(string_num.length);

// 【1行の短縮形】
// console.log(String(num).length);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>数値を文字列に型変換するときは、頭文字が大文字の <code>String()</code> を使います。文字列データの後ろに <code>.length</code> をくっつけることで、その文字数を調べることができます（数値データの状態では <code>.length</code> は使えません）。</p>
            </div>
          </details>
        </div>

        <!-- 第3問 -->
        <div class="quiz-box">
          <p class="quiz-question">第3問：文字列の分割（配列化）</p>
          <p>定数 <code>text</code> を宣言し、文字列の <code>"Apple,Banana,Orange"</code> を代入してください。この文字列をコンマ <code>,</code> の位置で切り離して、3つの果物の名前が入った「配列」に変換し、それを <code>console.log()</code> で出力してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>const text = "Apple,Banana,Orange";
console.log(text.split(","));</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>特定の文字（ハサミを入れる場所）を指定して配列に変換するには <code>.split("区切り文字")</code> を使います。引数の指定方法によって挙動が変わり、カッコ内を空文字 <code>.split("")</code> にすると1文字ずつバラバラになり、完全に空っぽの <code>.split()</code> にすると区切れず1つの大きな塊の配列になります。</p>
            </div>
          </details>
        </div>

        <!-- 第4問 -->
        <div class="quiz-box">
          <p class="quiz-question">第4問：文字の切り出し（slice）の範囲指定</p>
          <p>文字列 <code>"090-1234-5678"</code> から、最初の <code>"090"</code> の3文字だけを <code>slice()</code> を使って切り出すときの、正しいコードを書いてください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>let telephone = "090-1234-5678";
let num = telephone.slice(0, 3);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p><code>slice()</code> の数値指定は文字数ではなく、文字と文字の間の「仕切り線」の番号で範囲を決めます。最初の文字の手前が 0、3文字目の後ろが 3 番目の仕切りになるため <code>(0, 3)</code> になります。簡単な覚え方として、0番目（先頭）からスタートして切り出すときは、 <code>slice(0, 切り出したい文字数)</code> になると覚えると実務で迷いません。</p>
            </div>
          </details>
        </div>

        <!-- 第5問 -->
        <div class="quiz-box">
          <p class="quiz-question">第5問：ランダムな数値の生成</p>
          <p>変数 <code>rand</code> を宣言し、JavaScriptの命令（<code>Math</code> オブジェクト）を使って、0 以上 1 未満のランダムな小数を生成して代入してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>const rand = Math.random();
console.log(rand);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p><code>Math.random()</code> は、最初から「0以上1未満（1は絶対に含まない）」の小数を返すルールになっています。ゲームの乱数やランダムなID生成のベースとして頻繁に使われます。</p>
            </div>
          </details>
        </div>

        <!-- 第6問 -->
        <div class="quiz-box">
          <p class="quiz-question">第6問：配列への要素追加</p>
          <p>定数 <code>colors</code> を宣言し、 <code>["赤", "青", "黄"]</code> という配列を代入してください。配列の一番最後（「黄」の後ろ）に、新しく文字列の <code>"緑"</code> を追加してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>const colors = ["赤", "青", "黄"];
colors.push("緑");
console.log(colors);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>配列の末尾に新しく要素を付け足すときは <code>.push(追加したいもの)</code> を使います。元の配列（<code>colors</code>）自体が直接書き換わります。</p>
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
          <p class="quiz-question">第9問：オブジェクトの参照（コピーの罠）</p>
          <p>次のプログラムを実行したとき、最後に画面（コンソール）に表示される名前は何ですか？</p>
          <pre><code>let obj1 = { name: "Alice" };
let obj2 = obj1;
obj2.name = "Bob";
console.log(obj1.name);</code></pre>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解："Bob"</p>
              <p>📌 <strong>解説：</strong></p>
              <p>オブジェクト（ <code>{}</code> ）や配列を変数に入れるとき、変数の中にはデータそのものではなく「メモリ上のどこに保存されているか」という住所（参照値）が入ります。 <code>let obj2 = obj1;</code> とした時、コピーされたのは住所のメモだけです。実体（家）は1つのままであるため、 <code>obj2</code> 側から中身を書き換えると、同じ実体を指している <code>obj1</code> の中身も連動して変わってしまいます。連動させずに複製したい時は、スプレッド構文（ <code>let obj2 = { ...obj1 };</code> ）を使い中身をバラして包み直します。</p>
            </div>
          </details>
        </div>

        <!-- 第10問 -->
        <div class="quiz-box">
          <p class="quiz-question">第10問：async 関数の戻り値</p>
          <p><code>async</code> キーワードを付けて定義された関数は、呼び出されたときに何を返しますか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：Promise オブジェクト</p>
              <p>📌 <strong>解説：</strong></p>
              <p>関数内で普通に <code>return "こんにちは";</code> と文字列を返していても、 <code>async</code> がついているだけで自動的に <code>Promise</code> で包まれて返却されるルールになっています。中身のデータを取り出すには、受け取る側で <code>await</code> を使うか、 <code>.then()</code> を繋ぐ必要があります。単に実行するだけでは裏でPromiseが作られても消えてしまうため、変数に代入したり <code>console.log()</code> で囲って画面に表示させたりして利用します。</p>
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
<!-- http://localhost/study/study_0907.php -->