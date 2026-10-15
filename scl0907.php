<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="9/7(月)の職業訓練授業ノートです。JavaScriptにおける再帰関数の仕組み（階乗計算）や、二分探索木の絶対ルール、Classを用いたデータ構造の組み立てと巡回アルゴリズムをまとめています。">
  <title>9/7(月)職業訓練授業：再帰関数と二分探索木のアルゴリズム | ポートフォリオサイト</title>
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
      <h2>9/7(月) 職業訓練授業ノート</h2>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
        プログラムの高度な制御を司る「再帰関数」の設計方法と、データを高速に探索・整理するための構造体「二分探索木」の仕組みを深く学びます。
      </p>

      <!-- セクション1：再帰関数 -->
      <div class="note-section">
        <h3 class="note-title">1. 再帰関数（自己呼び出し）の実行メカニズム</h3>
        <p>
          <strong>再帰関数（さいきかんすう）</strong>とは、関数ブロックの内部で、さらに**自分自身を呼び出す（自己呼び出し）** 処理を繰り返す仕組みのことです。
        </p>
        <p>
          再帰を設計する際は、処理を終了させて呼び出し元へ戻していく条件（<strong>ストッパー / ベースケース</strong>）を必ず最優先で備える必要があります。これがないと無限に自分を呼び出し続け、パソコンのメモリ上限（コールスタック領域）を迎えてプログラムが強制終了（スタックオーバーフロー）してしまいます。
        </p>

        <div class="sub-heading">📐 代表的な形（数学の階乗 n! を表現したもの）</div>
        <pre><code>function factorial(n) {
    // 【ストッパー / ベースケース】
    if (n &lt;= 1) {
        return 1;
    } else {
        // 自分自身を呼び出し、計算を一時停止してメモリに積み上げていく
        return n * factorial(n - 1);
    }
}
// 実行例
console.log(factorial(5)); // 結果: 120 (5! = 5 × 4 × 3 × 2 × 1)</code></pre>

        <p style="font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b; margin-top: 15px;">
          <strong>💡 階乗（かいじょう）数学ルールと防衛コード</strong><br>
          正の整数を対象とし、1から指定した値まで全ての整数を掛け合わせた答えを求める計算（記号は「!」）です。数学の例外ルールとして「0! = 1」と定義されているため、上記の <code>n &lt;= 1</code> の判定で正しく動作します。
          <br>ただし、引数 <code>n</code> にマイナスの値（-5など）が渡されるとストッパーをすり抜けてフリーズするため、実務では関数開始直後にマイナス値を弾く例外チェックを挟むのが一般的です。
        </p>
      </div>

      <!-- セクション2：二分探索木の概念 -->
      <div class="note-section">
        <h3 class="note-title">2. 二分探索木（Binary Search Tree）の絶対ルール</h3>
        <p>
          データを格納する際、通常の「配列」のままだと、1万件のデータから1つの目的データを探すのに最悪1万回のチェック（線形探索）が必要となり処理が低速化します。
        </p>
        <p>
          これに対し、**二分探索木**のルールに従ってデータを魔法の本棚のように配置すると、1万件の中からでも、最高でわずか<strong>13回</strong>のチェックを行うだけで目的のデータへダイレクトに到達できます。
        </p>

        <div class="sub-heading">🌟 データの配置を決める「1つの絶対ルール」</div>
        <p>親ノード（基準となる節点）から見て、ぶら下がる子データは必ず以下の大小関係で枝分かれを繰り返します。</p>
        <ul>
          <li>親の<strong>左側</strong>にぶら下がるデータ ➔ 自分より**「小さい（若い・五十音順で手前）」**</li>
          <li>親の<strong>右側</strong>にぶら下がるデータ ➔ 自分より**「大きい（後ろ・五十音順で後ろ）」**</li>
        </ul>

        <!-- 概念図ブロック -->
        <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 15px; margin: 15px 0; font-family: monospace; font-size: 14.5px; text-align: center; line-height: 1.5;">
          <div style="color: #1e3a8a; font-weight: bold;">[50] (根：ルート)</div>
          <div style="margin: 5px 0;">/ &nbsp; \</div>
          <div>[30] (左：50より小) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [70] (右：50より大)</div>
          <div style="margin: 5px 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; /</div>
          <div style="color: #ff8c00; font-weight: bold;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[60] (新要素：50より大きく、70より小さい)</div>
        </div>
      </div>

      <!-- セクション3：JavaScriptでの表現（2つのアプローチ） -->
      <div class="note-section">
        <h3 class="note-title">3. プログラムによる表現（国家試験向け・実務向けの2手法）</h3>
        <p>二分探索木をコードで表現する場合、開発目的やターゲット環境に応じてアプローチを切り替えます。</p>

        <div class="sub-heading">アプローチA：【国家試験・資格向け】3つの配列で表現する</div>
        <p>オブジェクト指向（Class）を習得する前や、基本情報技術者試験などの「疑似言語問題」のデータ構造のトレース対策に直結する手法です。インデックス（要素番号）でデータのリンク関係を表現します。</p>
        <pre><code>// インデックス番号:    0          1         2         3
let node =  ["さき", "あやか", "はるか", "あや"];
let left =  [   1,       3,       -1,      -1]; // 左の子（-1は「子なし」を示す）
let right = [   2,      -1,       -1,      -1]; // 右の子</code></pre>

        <div class="sub-heading">アプローチB：【実践・モダン実務向け】ClassとObjectで表現する</div>
        <p>実際のフロントエンド・バックエンドの実務開発で用いられる、メモリ上のポインタ（参照）の仕組みを完全に活用した美しいオブジェクト表現です。</p>
        <pre><code>class TreeNode {
    constructor(value) {
        this.value = value;
        this.left = null;  // 左の子への参照リンク（初期状態は空）
        this.right = null; // 右の子への参照リンク（初期状態は空）
    }
}
// データのインスタンス化と組み立て
const root = new TreeNode(50);
root.left = new TreeNode(30);
root.right = new TreeNode(70);</code></pre>
      </div>

      <!-- セクション4：巡回（ウォーク） -->
      <div class="note-section">
        <h3 class="note-title">4. 核心アルゴリズム：木の中を歩く「巡回（Walk）」の順序制御</h3>
        <p>
          再帰関数を使って木構造の中を探索（巡回）する際、ノードの「どの位置」を通過したタイミングでデータを処理（画面出力など）するかによって、取り出せるデータの規則性がガラッと変化します。
        </p>

        <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px;">
          <thead>
            <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
              <th style="padding: 10px; text-align: left; width: 25%;">巡回アルゴリズム名</th>
              <th style="padding: 10px; text-align: left;">処理を実行するタイミングと特徴</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 10px;"><strong>先行順（プリオーダー）</strong></td>
              <td style="padding: 10px;">ノードの**「左側（侵入時）」**を通過した瞬間にデータを処理する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 10px;"><strong>間順（インオーダー）</strong></td>
              <td style="padding: 10px; color: #1e3a8a; font-weight: bold;">ノードの「真下（底）」を通過した瞬間にデータを処理する。<br>➔ これを実行すると、データが必ず「数値順（または五十音順）」に綺麗に整列されて出力されるという、二分探索木最大の醍醐味となるアルゴリズム。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 10px;"><strong>後行順（ポストオーダー）</strong></td>
              <td style="padding: 10px;">ノードの**「右側（脱出時）」**を通過した瞬間にデータを処理する。</td>
            </tr>
          </tbody>
        </table>

        <div class="sub-heading">🔄 応用課題：逆インオーダーアルゴリズム（五十音の逆順出力）</div>
        <p>
          「真下を通過する際、通常（左から右）とは異なり、<strong>『右の子 ➔ 自分（出力） ➔ 左の子』</strong> の順で再帰を逆回りに呼び出す」というロジックを組むことで、データを**高い方から低い方（五十音の逆順）へ降順ソート**して出力させることができます。
        </p>
      </div>

    </main>

  </div> <!-- .container -->

  <!-- 右下：トップボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>