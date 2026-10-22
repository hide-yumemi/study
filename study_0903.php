<!DOCTYPE html>
<html lang="ja">

<head>
  <title>JavaScript 基礎問題（全10問） | ポートフォリオサイト</title>
  <?php include 'meta.php'; ?>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">

      <!-- 📝 クイズエリア全体を包む大きなグレーの枠 -->
      <section class="quiz-container">
        <h2 class="note-title" style="border-left-color: #1e3a8a; margin-bottom: 20px;">JavaScript 基礎問題</h2>
        <p style="margin-bottom: 20px; color: #475569; font-size: 15px;">JavaScriptの基本ルールと制御構文（全10問）</p>

        <!-- 第1問 -->
        <div class="quiz-box">
          <p class="quiz-question">第1問：定数の再代入</p>
          <p><code>const</code> で宣言された変数に、後から別の値を再代入しようとした場合、JavaScriptではどうなりますか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：TypeError（タイプエラー / 型エラー）が発生する。</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>const</code>（定数）は「一度入れた値を変更してはいけない」という強力なルールを持っています。このルールを破ろうとすると、<code>TypeError: Assignment to constant variable.</code> というエラーが発生します。存在しない（定義されていない）変数を呼び出そうとしたときに発生する「ReferenceError」とは明確に区別されます。</p>
            </div>
          </details>
        </div>

        <!-- 第2問 -->
        <div class="quiz-box">
          <p class="quiz-question">第2問：typeof null</p>
          <p>JavaScriptにおいて、<code>typeof null</code> を実行した際に返される文字列は何ですか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解："object"</p>
              <p>📌 <strong>解説：</strong></p>
              <p>本質的に <code>null</code> は独立した型ですが、1995年のJavaScript誕生初期の内部コードに仕様上の歴史的なバグがあり、<code>"object"</code> と判定される仕様になってしまいました。世界中の膨大なプログラムがこの挙動を前提に書かれているため、現在も修正されていません。そのため、実務でオブジェクト判定を行う際は <code>if (data !== null && typeof data === "object")</code> のように、あらかじめ <code>null</code> を除外する対策が必須です。</p>
            </div>
          </details>
        </div>

        <!-- 第3問 -->
        <div class="quiz-box">
          <p class="quiz-question">第3問：ブロックスコープ</p>
          <p><code>let</code> を使ってブロック（<code>{}</code> 内）で宣言した変数は、ブロックの外から参照しようとするとどうなりますか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：ReferenceError（リファレンスエラー）が発生する。</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>let</code> や <code>const</code> で宣言した変数は、「囲まれている波カッコ <code>{}</code> の中」だけで有効であるという「ブロックスコープ」のルールがあります。そのため、ブロックの外側から呼び出すと存在しない扱いになりエラーになります。昔使われていた <code>var</code> にはこのブロックスコープがなかったため、<code>{}</code> の外からでも読めてしまい、予期せぬバグの原因になっていました。</p>
            </div>
          </details>
        </div>

        <!-- 第4問 -->
        <div class="quiz-box">
          <p class="quiz-question">第4問：var の巻き上げ</p>
          <p>次のプログラムを実行したとき、コンソールには何が表示されますか？</p>
          <pre><code>console.log(x);
var x = 10;</code></pre>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：undefined（未定義）が表示される。</p>
              <p>📌 <strong>解説：</strong></p>
              <p><code>var</code> の宣言部分（<code>var x;</code>）だけがプログラムの一番上に持ち上げられる「ホイスティング（巻き上げ）」という現象が起きます。ただし、値を代入する部分（<code>= 10;</code>）はその場に残るため、実行時点では中身が空っぽ（<code>undefined</code>）と判定されます。なお、<code>let</code> や <code>const</code> の場合は巻き上げが起きない（アクセスできない領域になる）ため、宣言前に使うと <code>ReferenceError</code> になり、バグを未然に防いでくれます。</p>
            </div>
          </details>
        </div>

        <!-- 第5問 -->
        <div class="quiz-box">
          <p class="quiz-question">第5問：比較演算子の違い</p>
          <p>「<code>5 === "5"</code>」（イコール3つ）と「<code>5 == "5"</code>」（イコール2つ）を行ったとき、それぞれの結果はどうなりますか？</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：5 === "5" は false、5 == "5" は true</p>
              <p>📌 <strong>解説：</strong></p>
              <p>イコール3つの「厳密等価演算子」は、値だけでなくデータ型（数値か文字列か）まで厳しくチェックするため <code>false</code> になります。一方、イコール2つの「緩い等価演算子」は、JavaScriptが自動で型を合わせる「暗黙の型変換」を行ってから比較するため、文字列の <code>"5"</code> が数値の <code>5</code> に変換されて <code>true</code> になります。自動変換はプログラマーの予想外の挙動を生みバグの元になるため、実務では原則として <code>===</code> のみを使うのが鉄則です。</p>
            </div>
          </details>
        </div>

        <!-- 第6問 -->
        <div class="quiz-box">
          <p class="quiz-question">第6問：switch文による条件分岐</p>
          <p>変数 <code>day</code> の値が 1 なら"月曜日"、2なら"火曜日"、それ以外なら"その他の曜日"と出力する <code>switch</code> 文を作ってください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>switch (day) {
    case 1:
        console.log("月曜日");
        break;
    case 2:
        console.log("火曜日");
        break;
    default:
        console.log("その他の曜日");
}</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p><code>switch()</code> のカッコの中には条件式ではなく、主役となる変数名だけを入れます。各 <code>case</code> の最後にある <code>break;</code> を書き忘れると、条件に合致した後、下の処理まで続けて実行されてしまう（フォールスルー）ため必須です。どれにも当てはまらないときは <code>default:</code> へ進みます。</p>
            </div>
          </details>
        </div>

        <!-- 第7問 -->
        <div class="quiz-box">
          <p class="quiz-question">第7問：while文によるカウントダウン</p>
          <p><code>while</code> 文を使って、コンソールに 3、2、1 と順番にカウントダウンして出力するループ処理を作ってください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>let count = 3;
while (count > 0) {
    console.log(count);
    count--;
}</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p><code>while</code> のカッコ内には「条件式」しか入れられないため、カウント用変数の準備はループの手前（外側）で行っておく必要があります。また、波カッコ内の最後で必ず数字を減らす処理（<code>count--</code>）を記述しないと、条件が常に満たされ続け、ブラウザがフリーズする「無限ループ」に陥るため注意が必要です。</p>
            </div>
          </details>
        </div>

        <!-- 第8問 -->
        <div class="quiz-box">
          <p class="quiz-question">第8問：三項演算子の実践（基礎）</p>
          <p>変数 <code>age</code> に 18 を代入し、三項演算子を使って20以上なら "大人"、未満なら "子供" を変数 <code>result</code> に代入して出力してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>let age = 18;
const result = age >= 20 ? "大人" : "子供";
console.log(result);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>三項演算子は <code>条件式 ? 正しいとき : 正しくないとき</code> の形になります。区切りにはコンマではなくコロン（<code>:</code>）を使うのがルールです。<code>console.log(age >= 20 ? "大人" : "子供");</code> のように、実行関数の中に直接入れ込んでも動作します。</p>
            </div>
          </details>
        </div>

        <!-- 第9問 -->
        <div class="quiz-box">
          <p class="quiz-question">第9問：三項演算子の実践（インライン記述）</p>
          <p>定数 <code>userAge</code> に 65 を代入し、<code>console.log()</code> のカッコの中に直接三項演算子を書いて、65以上なら "割引あり"、そうでないなら "割引なし" と出力させてください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>const userAge = 65;
console.log(userAge >= 65 ? "割引あり" : "割引なし");</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>三項演算子はそれ自体が計算結果（値）を返す性質を持つため、変数への一次代入を挟まず、<code>console.log()</code> などの実行カッコの中に直接入れ込んで書く（インライン記述）ことができます。全体の行を終わらせるセミコロン（<code>;</code>）はカッコのすぐ外に置きます。</p>
            </div>
          </details>
        </div>

        <!-- 第10問 -->
        <div class="quiz-box">
          <p class="quiz-question">第10問：偶数・奇数チェック</p>
          <p>変数 <code>num</code> に好きな数値を代入し、三項演算子を使って偶数なら "偶数です"、奇数なら "奇数です" と出力してください。</p>

          <details class="quiz-details">
            <summary>💡 解答と解説を見る</summary>
            <div class="quiz-answer-area">
              <p class="quiz-correct-text">⭕ 正解：</p>
              <pre><code>let num = 7;
const result = num % 2 === 0 ? "偶数です" : "奇数です";
console.log(result);</code></pre>
              <p>📌 <strong>解説：</strong></p>
              <p>2で割った余りを求めるには <code>%</code> 演算子を使用します。厳密等価演算子 <code>===</code> を使用して、余りが「数値の0」であることを正確にチェックするのがポイントです。変数に入れる文字は「データ（単語）」としてシンプルに保ち、出力時に加工するアプローチは実務的で綺麗な書き方です。</p>
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
<!-- http://localhost/study/study_0903.php -->