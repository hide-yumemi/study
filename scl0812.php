<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="8/12(水)の職業訓練授業ノートです。基本情報処理の重要分野であるツリー構造（二分探索木）、探索・整列アルゴリズム、オブジェクト指向の本質、UML図の使い分け、疑似言語演習をまとめています。">
    <title>8/12(水)職業訓練授業：基本情報処理（アルゴリズム・オブジェクト指向・UML） | ポートフォリオサイト</title>
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
            <h2>8/12(水) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
                基本情報技術者試験の核心である「アルゴリズムの仕組み」「オブジェクト指向設計」「UMLモデリング」を体系的に学びます。
            </p>

            <!-- セクション1：木（ツリー）構造 -->
            <div class="note-section">
                <h3 class="note-title">1. 木（ツリー）構造と二分探索木</h3>
                <p>
                    データ構造の一種で、フォルダ階層のように「親は1つだが、子は複数持てる」という枝分かれした関係を表現します。
                </p>
                
                <div class="sub-heading">🌲 二分木（にぶんぎ）の基本用語</div>
                <ul>
                    <li><strong>根（ルート）：</strong> 一番上に位置する、親を持たない最初のノード（節点）。</li>
                    <li><strong>葉（リーフ）：</strong> 子を持たない、一番末端にあるノード。</li>
                    <li><strong>節（ノード）：</strong> 枝（ブランチ）で結ばれたデータそれぞれのポイント。</li>
                </ul>
                <p>
                    すべての「節」から伸びる枝が**2本以下**である木構造を **二分木** と呼びます。
                </p>

                <div class="sub-heading">分類と特徴</div>
                <ul>
                    <li><strong>完全二分木：</strong> 根から順にすべての階層が完全に、かつ左詰めでノードが埋まっている綺麗な構造。</li>
                    <li><strong>二分探索木：</strong> **「左の子 ＜ 親 ＜ 右の子」** という大小関係のルールを厳格に持たせた二分木。この性質により、データの高速な検索や追加がダイレクトに行えます。</li>
                </ul>
            </div>

            <!-- セクション2：探索・整列アルゴリズム -->
            <div class="note-section">
                <h3 class="note-title">2. 探索・整列（ソート）アルゴリズムの最適化</h3>
                <p>限られた計算資源でいかに高速に処理を行うかのアプローチです。</p>
                
                <div class="sub-heading">🔍 データを探索する3大アルゴリズム</div>
                <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14.5px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; width: 25%;">方法</th>
                            <th style="padding: 10px; text-align: left;">探し方（ロジック）と特徴</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>線形探索</strong></td>
                            <td style="padding: 10px;">先頭から1個ずつ順番に調べる。データが並んでいなくても探せるが低速。<br>
                            <code>for (let i = 0; i &lt; 配列数; i++) { if(比較) { flag = true; break; } }</code></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>二分探索</strong></td>
                            <td style="padding: 10px;">中央の値（mid）を見てデータを半分ずつ絞り込んで探す。**データがあらかじめソート（昇順・降順）されていることが大前提条件。**</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>ハッシュ法</strong></td>
                            <td style="padding: 10px;">ハッシュ関数で探したいデータの格納場所を一発で計算し、ダイレクトに見つける。最速。</td>
                        </tr>
                    </tbody>
                </table>

                <div class="sub-heading">📐 二分探索（バイナリサーチ）のトレース例</div>
                <p>要素数 1〜10 の配列において、中央の添字 <code>mid = (lo + hi) ÷ 2</code> (小数点以下切り捨て) を用いて絞り込んでいく流れです。</p>
                <ol>
                    <li><code>lo: 1, hi: 10, mid: 5</code> ➔ midの値より小さいと判明 ➔ 範囲を1〜4に絞る</li>
                    <li><code>lo: 1, hi: 4,  mid: 2</code> ➔ midの値より小さいと判明 ➔ 範囲を1〜1に絞る</li>
                    <li><code>lo: 1, hi: 1,  mid: 1</code> ➔ midの値より小さいと判明 ➔ hiが 1 - 1 = 0 になる</li>
                    <li><code>lo: 1, hi: 0</code> ➔ <code>lo &gt; hi</code> (逆転現象)となり、データが存在しないためループ終了</li>
                </ol>

                <div class="sub-heading">📊 データを整列させるアルゴリズム（基本3種 ＋ 高速3種）</div>
                <ul>
                    <li><strong>基本交換法（バブルソート）：</strong> 隣り合うデータを比較して大小が逆なら交換。 「隣と比べる！」</li>
                    <li><strong>基本選択法（選択ソート）：</strong> 未整列の範囲から最小のデータを探して先頭へ置く。 「最小を選ぶ！」</li>
                    <li><strong>基本挿入法（挿入ソート）：</strong> データを1つずつ、すでに整列済みの正しい位置に差し込む。 「正しい位置に入れる！」</li>
                    <li><strong>シェルソート：</strong> 離れたところにあるデータを一定の間隔ごとに並べ、徐々に間隔を詰める（挿入ソートの改良版）。</li>
                    <li><strong>クイックソート：</strong> 基準値（ピボット）を決めて、それより「大きいグループ」と「小さいグループ」に分けて再帰的に並べる。最速クラス。</li>
                    <li><strong>ヒープソート：</strong> 木構造（ヒープ）を利用し、最大値（または最小値）を順に取り出して整列する。</li>
                </ul>
            </div>

            <!-- セクション3：オブジェクト指向プログラミング -->
            <div class="note-section">
                <h3 class="note-title">3. オブジェクト指向プログラミングの3大要素</h3>
                <p>
                    開発を効率化し、バグの起きにくい設計をするための現代のシステム開発の根底思想です。
                </p>
                <ul>
                    <li><strong>クラス：</strong> オブジェクトを作るための「設計図」です。</li>
                    <li><strong>インスタンス：</strong> 設計図（クラス）から実際に作られた「実体（家や車など）」です。</li>
                </ul>

                <div class="sub-heading">💡 オブジェクト指向の最重要3大用語</div>
                <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 14.5px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; width: 25%;">用語</th>
                            <th style="padding: 10px; text-align: left;">一言で表すと（本質）</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>カプセル化</strong></td>
                            <td style="padding: 10px;">データ（属性）とそれを操作する処理（メソッド）を1つにまとめ、外部から直接触れないように「中身を隠す（隠蔽）」こと。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>継承（インヘリタンス）</strong></td>
                            <td style="padding: 10px;">親クラスの持っている特徴や機能を、新しく作る子クラスがそのまま「引き継ぐ」こと。再利用性を高める。</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 10px;"><strong>多態性（ポリモーフィズム）</strong></td>
                            <td style="padding: 10px;">「鳴け」と同じ命令を指示しても、オブジェクトが犬なら「ワン」、猫なら「ニャー」と、相手（クラス）によって異なる動きをすること。</td>
                        </tr>
                    </tbody>
                </table>

                <div class="sub-heading">関係性の整理（汎化・特化 と 集約・分解）</div>
                <ul>
                    <li><strong>汎化と特化（is-a関係）：</strong> 「犬は動物である」のように、細かいグループ（特化）をまとめて大きなグループ（汎化）に抽象化する関係。</li>
                    <li><strong>集約と分解（part-of関係）：</strong> 「タイヤやエンジンが集まって1台の車を構成する」のように、部品（分解）が集まって全体（集約）を作る関係。</li>
                </ul>
            </div>

            <!-- セクション4：UMLモデリング -->
            <div class="note-section">
                <h3 class="note-title">4. UML（統一モデリング言語）の主要ダイアグラム</h3>
                <p>システムの設計図や動作の流れを、誰もが共通して読めるように規格化された「図（ダイアグラム）」の規格です。</p>
                
                <div class="sub-heading">📋 試験に直結する4大代表図面</div>
                <ul>
                    <li><strong>クラス図（構造図）：</strong> クラスがどのような情報（属性）と機能（メソッド）を持ち、他のクラスとどう関係しているかを静的に表す図。</li>
                    <li><strong>ユースケース図（振る舞い図）：</strong> ユーザー（アクター）の視点から、そのシステムで「何ができるのか」という要求を表現する図。</li>
                    <li><strong>アクティビティ図（振る舞い図）：</strong> 処理がどのような順番で進むのかを表す、オブジェクト指向版のフローチャート。</li>
                    <li><strong>シーケンス図（振る舞い図）：</strong> 複数のオブジェクト間で、メッセージがどのような時系列でやり取りされるかを縦方向のタイムラインで表す図。</li>
                </ul>
            </div>

            <!-- セクション5：基本情報試験B 疑似言語演習 -->
            <div class="note-section">
                <h3 class="note-title">5. 基本情報科目B 疑似言語のアルゴリズムトレース</h3>
                <p>科目Bで頻出する、配列の要素（左右）を反転させるアルゴリズムの構造解析ログです。疑似言語特有の <code>endif;</code> や <code>endfor;</code> といった明示的なブロック構造に注意します。</p>
                
                <div class="sub-heading">🔄 配列反転（スワップ処理）の裏側のトレース</div>
                <p>配列の中身を入れ替える際、1つの変数の値をそのまま上書きすると元のデータが消滅するため、<strong>「一時退避用の変数（tmp）」</strong>を使用します。</p>
                
                <pre><code>// 要素数の半分（中央）までループを回す
for (left = 1; left &lt;= 要素数の半分; left++):
    
    // ① 右側のインデックスは後ろからカウントダウンさせる
    right = (要素数 + 1) - left;
    
    // ② 元の右側の値を tmp（一時退避場所）に逃がす
    tmp = 配列[right];
    
    // ③ 左側の値を、空いた右側の場所に代入する
    配列[right] = 配列[left];
    
    // ④ 逃がしておいた tmp（元の右側の値）を、最後に左側に代入して交換完了
    配列[left] = tmp;

endfor;</code></pre>
                <p>
                    このように、ループの周回ごとに <code>left</code> が進むにつれて <code>right</code> が後ろから手前に連動（1周目なら5番目、2周目なら4番目…）して、完璧な左右対称のスワップが実現します。
                </p>
            </div>

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
