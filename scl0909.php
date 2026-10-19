<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <meta name="description" content="9/9(水)の職業訓練授業ノートです。データベース管理システム（DBMS）の基礎、3層スキーマ構造、主キー・外部キーの特徴、SQLの各種操作、およびトランザクションのACID特性や障害管理までを1つに統合してまとめています。">
  <title>9/9(水)職業訓練授業：データベースの設計思想・SQL操作とトランザクション管理 | ポートフォリオサイト</title>
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
      <h2>9/9(水) 職業訓練授業ノート</h2>
      <p style="color: #666; font-size: 14px; margin-bottom: 35px;">
        本日はシステム開発の要となるデータベースの理論、主キー・外部キーによるリレーション設計、SQL文によるデータ操作、そしてシステムの堅牢性を担保するトランザクション管理までを一挙に学習・統合しました。
      </p>

      <!-- ==========================================
                 テーマ1：データベース管理システム（DBMS）の基礎
                 ========================================== -->
      <div class="note-section">
        <h3 class="note-title">1. データベース管理システム（DBMS）とは</h3>
        <p>
          <strong>DBMS（Database Management System）</strong>とは、複数のアプリケーションやユーザーが**データを安全、かつ効率的に保存・共同利用できるように仲介するミドルウェア（ソフトウェア）**のことです。
        </p>

        <div class="sub-heading">データ構造による主要な3つの分類</div>
        <ul>
          <li><strong>関係型（リレーショナルデータベース / RDB）：</strong> データをExcelのような「行と列からなる表（テーブル）」の形式で表現・管理する、現在世界で最も普及している方式です。</li>
          <li><strong>階層型：</strong> データを会社組織図やフォルダ階層のような「親と子」のツリー構造（1対多関係）で管理する古い方式です。</li>
          <li><strong>ネットワーク型：</strong> データの繋がりを網の目のように（多対多関係）結びつけて管理する構造です。</li>
        </ul>
      </div>

      <div class="note-section">
        <h3 class="note-title">2. リレーショナルデータベース（RDB）の重要機能</h3>
        <p>表形式のRDBを正しく設計し、データを柔軟に加工して扱うための国家試験必須の基本概念です。</p>

        <div class="sub-heading">📊 データの整理：正規化（せいきか）のステップ</div>
        <p>データの重複や矛盾（データの追加・更新・削除時に発生する異常）を徹底的に排除し、整合性を保ちながら最も効率よく管理できるようにテーブルを最適な形に分割・整理する作業を指します。</p>
        <ul>
          <li><strong>第1正規形：</strong> 表の中の「繰り返し項目」をなくし、すべてのマス（セル）に値が1つだけ入っている（原子値である）状態にする。</li>
          <li><strong>第2正規形：</strong> 主キーを構成する一部の列にだけ連動する項目（部分関数従属）を別の表に切り離す。</li>
          <li><strong>第3正規形：</strong> 主キー以外の項目に連動する項目（推移的関数従属）をさらに別の表に切り離す。</li>
        </ul>
        <p style="font-size: 13.5px; color: #e07b00; background-color: #fffbeb; padding: 10px; border-radius: 6px; border-left: 4px solid #ff8c00;">
          <strong>💡 実務的なトレレードオフ（メリット・デメリット）：</strong><br>
          正規化を限界まで進めることで、データの「冗長性の排除（同じ文字を何回も書かない）」が実現し、保守性が極めて高くなります。しかし、テーブルが細かく分かれすぎるため、データを検索する際にテーブル同士をガッチャンコと結合（JOIN）する処理の負荷が増え、<strong>データの検索・抽出速度が低下することがある</strong>というデメリットも存在します。
        </p>

        <div class="sub-heading">📐 データを加工する：3種の関係演算（かんけいえんざん）</div>
        <ul>
          <li><strong>選択（Selection）：</strong> テーブルの中から、特定の条件に合致する**「行（レコード）」**を横方向に抜き出す操作。</li>
          <li><strong>射影（Projection）：</strong> テーブルの中から、必要な**「列（フィールド）」**だけを縦方向に抜き出す操作。</li>
          <li><strong>結合（Join）：</strong> 複数の異なるテーブルを、共通する列（キー）を仲介役にして1つの表に**「くっつける」**操作。</li>
        </ul>

        <div class="sub-heading">📂 ビュー表（仮想的な表）の定義と制限</div>
        <p>実際のディスク容量を消費する本物のテーブル（基底表）から、特定の用途に必要なデータだけを一時的に寄せ集め、名前をつけて保存した<strong>「仮想的な表（導出表）」</strong>です。</p>
        <ul>
          <li><strong>定義の順番：</strong> 実体を持たないため、必ずベースとなる本物の表（基底表）が定義・作成された後にしか定義できません。</li>
          <li><strong>作成の制限：</strong> 1つの基底表に対して、ユーザーの目的に合わせて<strong>個数の制限なく、複数のビュー表を自由に定義することが可能</strong>です。</li>
          <li><strong>入れ子構造：</strong> すでに定義・作成されている<strong>ビュー表をさらに元にして、別の新しいビュー表を多層的に定義することも認められています</strong>。</li>
        </ul>
      </div>

      <div class="note-section">
        <h3 class="note-title">3. スキーマ定義と「3層スキーマ構造（ANSI/SPARC）」</h3>
        <p>
          <strong>スキーマ（Schema）</strong>とは、データベースの構造やルール、データ型の定義のことです。データの独立性を高め、システムの変更が他の領域に与える影響を最小限に抑える設計を **3層スキーマ構造** と呼びます。
        </p>

        <div class="sub-heading">2つの「データの独立性」の目的</div>
        <ul>
          <li><strong>物理的データ独立性：</strong> データを保存しているハードウェア（磁気ディスク）の容量変更や構成が変わっても、データの論理的な関係（概念スキーマ）やアプリケーションプログラム側を一切書き換える必要がないという性質。</li>
          <li><strong>論理的データ独立性：</strong> 業務の仕様変更などでデータの論理的関係（概念スキーマ）が一部書き換わっても、エンドユーザーが見る画面（外部スキーマ）やプログラム側を変更しなくてよいという性質。</li>
        </ul>

        <div class="sub-heading">アクセス経路と3層の定義の流れ</div>
        <p>ユーザーやプログラムが実際のハードディスクへアクセスする際、以下の3つの階層構造を通過して連動します。</p>

        <div style="background-color: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 15px; margin: 15px 0; font-family: monospace; font-size: 14px; line-height: 1.6;">
          <div>【最上層】 ユーザー / アプリケーションプログラム</div>
          <div style="text-align: center; color: #94a3b8;">↕</div>
          <div>【外部スキーマ】 ユーザーやプログラムから見えている世界。必要なデータだけの個別定義（ビュー表など）。</div>
          <div style="text-align: center; color: #94a3b8;">↕</div>
          <div>【概念スキーマ】 データベース全体の論理構造。データの意味や関係性の定義（実際のテーブル/物理表など）。</div>
          <div style="text-align: center; color: #94a3b8;">↕</div>
          <div>【内部スキーマ】 データをハードディスクにどう最も効率よく物理配置するかの定義（インデックスの配置など）。</div>
          <div style="text-align: center; color: #94a3b8;">↕</div>
          <div>【物理層】 ハードウェア（磁気ディスク）</div>
        </div>
      </div>
      <!-- ==========================================
                 テーマ2：データベース基礎：キー（Key）の定義と特徴
                 ========================================== -->
      <div class="note-section">
        <h3 class="note-title">4. 主キー（プライマリーキー）と外部キー（フォリキー）の厳格な規則</h3>
        <p style="font-weight: bold; color: #b91c1c; background-color: #fef2f2; padding: 10px; border-radius: 6px; border-left: 4px solid #b91c1c;">
          💡 非常に間違いやすい超重要ポイント：<br>
          「重複してはいけない（Unique）」「NULL（空）ではいけない（Not Null）」という2つの絶対制限を満たしてデータを1件に特定できるのは、主キー（プライマリーキー）だけのルールです。外部キーは、設定上データが重複しても、NULL（空）であっても全く問題ありません。
        </p>

        <div class="sub-heading">🗝️ 主キー（Primary Key / PK）</div>
        <p>テーブルの中から「これ！」と絶対に1件のレコード（行）を一意に特定するための識別子です。</p>
        <ul>
          <li><strong>重複禁止：</strong> まったく同じ値がテーブル内に2つ以上存在することはできません。</li>
          <li><strong>NULL禁止：</strong> 空っぽのデータは許されず、必ず一意なデータが入っていなければなりません。</li>
          <li><strong>複合キー（複合主キー）：</strong> 1つの列だけでは特定できない場合、2つ以上の列を組み合わせて1つの主キーとして定義することも可能です。</li>
        </ul>

        <div class="sub-heading">🔗 外部キー（Foreign Key / FK）</div>
        <p>他のテーブル（一般的には親テーブルの主キー）とデータを結びつけてリレーション（リンク）を形成するための列です。</p>
        <ul>
          <li><strong>重複OK：</strong> 例えば「営業部」に所属する社員が複数いれば、社員テーブル側の所属部署ID（外部キー）には同じ値が何回も重複して登場します。</li>
          <li><strong>NULL OK：</strong> 例えば「まだ配属先が確定していない新入社員」のように、親テーブルのどこにも繋がっていない空っぽ（NULL）の状態を保持することが認められます。</li>
          <li><strong>役割（参照整合性）：</strong> 繋ぎ先（親テーブル）に**現実に実在している値、またはNULLしか入力できないようにシステム側で制限をかける**ことで、データの矛盾を未然に防ぎます。</li>
        </ul>

        <div class="sub-heading">💻 複合キーが使える無料のPHP・DB開発環境</div>
        <p>MySQL, PostgreSQL, SQLite などの主要なリレーショナルデータベースは、すべて無料で複合キー（複合主キー含む）を扱うことができます。</p>
        <ul>
          <li><strong>XAMPP（ザンプ） / MAMP（マンプ）：</strong> 【ローカル開発環境】PCにインストールするだけで、自分のPC内に無料で「PHP」と「MySQL」のテスト環境をまるごと構築できます。実習・自主学習に最も推奨されます。</li>
          <li><strong>GitHub Codespaces / PaizaCloud：</strong> 【クラウド開発環境】ブラウザ上で動くオンライン環境。最初からPHPや各種データベースが用意されているため、手軽に練習環境が作れます。</li>
          <li><strong>シン・フリー（旧エックスサーバーフリー）：</strong> 【無料レンタルサーバー】PHPとMySQLを使ったWebサイトを、無料でインターネット上に一般公開できる国内のサーバーサービスです。</li>
        </ul>
      </div>

      <!-- ==========================================
                 テーマ3：SQLでデータベースを操作する
                 ========================================== -->
      <div class="note-section">
        <h3 class="note-title">5. SQLによるデータ操作コマンドと具体例解説</h3>
        <p>
          データベースを操作する主要な命令は「〜文」、その内部で絞り込みなどを行うキーワード（FROM, WHEREなど）は「〜句」と呼びます。
        </p>

        <table style="width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px;">
          <thead>
            <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
              <th style="padding: 8px; text-align: left; width: 25%;">SQL基本命令</th>
              <th style="padding: 8px; text-align: left;">データベース上における具体的な役割</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td><strong>CREATE</strong></td>
              <td>データベースそのものや、新しい表（テーブル）を作成・定義する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td><strong>INSERT INTO</strong></td>
              <td>テーブル内に新しいレコード（行）を追加・登録する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td><strong>SELECT</strong></td>
              <td>データの検索・抽出、ビュー表の作成など、データを「参照」する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td><strong>UPDATE</strong></td>
              <td>テーブル内の既存のデータを新しく更新（書き換え）する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td><strong>DELETE</strong></td>
              <td>テーブル内の特定のレコード（行）を削除する。</td>
            </tr>
          </tbody>
        </table>

        <div class="sub-heading">📊 実例検証用：商品（shohin）表 と 注文（chumon）表</div>
        <p>以下のデータ構成をベースにして、各種SQL文を実行した際の挙動と抽出結果のトレースです。</p>

        <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 20px;">
          <div style="flex: 1; min-width: 240px;">
            <p><strong>【商品（shohin）表】</strong></p>
            <table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: center;">
              <tr style="background-color: #e2e8f0;">
                <th>商品ID(PK)</th>
                <th>商品名</th>
                <th>価格</th>
              </tr>
              <tr>
                <td>S01</td>
                <td>リンゴ</td>
                <td>150</td>
              </tr>
              <tr>
                <td>S02</td>
                <td>バナナ</td>
                <td>100</td>
              </tr>
              <tr>
                <td>S03</td>
                <td>メロン</td>
                <td>800</td>
              </tr>
            </table>
          </div>
          <div style="flex: 1; min-width: 240px;">
            <p><strong>【注文（chumon）表】</strong></p>
            <table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: center;">
              <tr style="background-color: #e2e8f0;">
                <th>注文ID(PK)</th>
                <th>商品ID(FK)</th>
                <th>個数</th>
              </tr>
              <tr>
                <td>1</td>
                <td>S01</td>
                <td>2</td>
              </tr>
              <tr>
                <td>2</td>
                <td>S02</td>
                <td>5</td>
              </tr>
              <tr>
                <td>3</td>
                <td>S01</td>
                <td>1</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="sub-heading">🔲 ① SELECT文の基本（全行抽出）</div>
        <p>どの列を、どのテーブルから持ってくるかを指定します。</p>
        <pre><code>SELECT 商品名, 価格 FROM shohin;</code></pre>
        <p>➔ 【結果】 リンゴ(150), バナナ(100), メロン(800) の商品名と価格の列がそのまま出力される。</p>

        <div class="sub-heading">🔲 ② 特定の列を抜き出す（射影）</div>
        <pre><code>SELECT 商品名 FROM shohin;</code></pre>
        <p>➔ 【結果】 縦方向の「商品名」の列だけが綺麗に選ばれて抽出される。</p>

        <div class="sub-heading">🔲 ③ WHERE句による行の絞り込み（選択）</div>
        <pre><code>SELECT * FROM shohin WHERE 価格 = 150;</code></pre>
        <p>➔ 【結果】 価格が150円である、商品ID「S01」、商品名「リンゴ」の**横1行まるごと**が抽出される。</p>

        <div class="sub-heading">🔲 ④ 不等価比較演算子（ &lt;&gt; ）の挙動</div>
        <p>SQLの世界では、「等しくない（〜以外）」を表現する際に <strong><code>&lt;&gt;</code></strong> を用いるのが一般的です（JavaScriptの <code>!==</code> と異なるため注意）。</p>
        <pre><code>SELECT * FROM shohin WHERE 商品ID &lt;&gt; 'S01';</code></pre>
        <p>➔ 【結果】 リンゴ（S01）以外の商品である「バナナ」と「メロン」のレコードが抽出される。</p>

        <div class="sub-heading">🔲 ⑤ 論理演算子（AND / OR）による複数条件</div>
        <pre><code>SELECT * FROM shohin WHERE 価格 &gt;= 100 AND 価格 &lt;= 500;</code></pre>
        <p>➔ 【結果】 100円以上かつ500円以下に該当する「リンゴ（150）」と「バナナ（100）」が抽出される。</p>

        <div class="sub-heading">🔲 ⑥ データの並び替え（ORDER BY）</div>
        <p><code>ORDER BY 列名</code> の末尾に <code>ASC</code>（昇順：小さい順）または <code>DESC</code>（降順：大きい順）を指示します。</p>
        <pre><code>SELECT * FROM shohin ORDER BY 価格 DESC;</code></pre>
        <p>➔ 【結果】 価格が高い順（メロン ➔ リンゴ ➔ バナナ）の並び順にソートされて出力される。</p>

        <div class="sub-heading">🔲 ⑦ 集計関数（SUM, COUNTなど）による計算</div>
        <p>合算した集計データを「1つのかたまり（1マス）」として返却します。</p>
        <pre><code>SELECT SUM(個数) FROM chumon;</code></pre>
        <p>➔ 【結果】 注文表のすべての個数（2 + 5 + 1）が足し算され、合計値の **<code>8</code>** が返る。</p>

        <div class="sub-heading">🔲 ⑧ データのグループ化（GROUP BY）</div>
        <p>指定した列の同じ値（グループ）ごとに合算・集計を行います。</p>
        <pre><code>SELECT 商品ID, SUM(個数) FROM chumon GROUP BY 商品ID;</code></pre>
        <p>➔ 【結果】 商品ID「S01」は計3個、 「S02」は計5個、というグループごとの集計表が作成される。</p>

        <div class="sub-heading">🔲 ⑨ グループ化「した後の」条件絞り込み（HAVING句）</div>
        <p>注意：<code>WHERE</code> 句はグループ化を行う前の元の行に対して作動します。**グループ化した後の集計結果に対してさらに絞り込みたい場合**は、必ず <strong><code>HAVING</code></strong> 句を使用します。</p>
        <pre><code>SELECT 商品ID, SUM(個数) FROM chumon GROUP BY 商品ID HAVING SUM(個数) &gt;= 4;</code></pre>
        <p>➔ 【結果】 集計合計が4個以上である、商品ID「S02（5個）」のグループだけが厳選されて抽出される。</p>

        <div class="sub-heading">🔲 ⑩ テーブル同士の合体（INNER JOIN / 内部結合）</div>
        <p>主キーと外部キーの一致を条件条件にして、2つの異なる別々のテーブルを横方向に綺麗にドッキングさせます。</p>
        <pre><code>SELECT chumon.注文ID, shohin.商品名, chumon.個数 
FROM chumon INNER JOIN shohin ON chumon.商品ID = shohin.商品ID;</code></pre>
        <p>➔ 【結果】 注文IDに対して、商品表から引っ張ってきた「リンゴ」「バナナ」といった具体的な商品名が結合された美しいビュー表が出力される。</p>
      </div>
      <!-- ==========================================
                 テーマ4：トランザクション管理と排他制御
                 ========================================== -->
      <div class="note-section">
        <h3 class="note-title">6. トランザクションと排他制御（データの整合性を守る仕組み）</h3>
        <p>
          <strong>トランザクション</strong>とは、データベース上における「一連の処理の不可分なまとまり（流れ）」のことです。例えば、銀行振込における「自分の口座からの引き落とし」と「相手の口座への入金」は、絶対にセットで処理されなければならない1つのトランザクションです。
        </p>
        <p>
          一方、<strong>排他制御（はいたせいぎょ）</strong>とは、複数のユーザーが同時にまったく同じデータを書き換えてデータの矛盾が発生するのを防ぐため、データに鍵（ロック）をかけ、他の人が同時に使えないように制御する仕組みのことです。
        </p>

        <div class="sub-heading">🔓 2種類のロック形式の特徴</div>
        <ul>
          <li><strong>共有ロック（読込専用）：</strong> 各ユーザーがデータを「読み込む（参照する）」ことは許可しますが、他の人が「書き換える（更新する）」ことは拒否するロックです。複数人が同時に共有ロックをかけることは可能です。</li>
          <li><strong>占有ロック（読込・書込双方の拒否）：</strong> 1人のユーザーがデータを更新している最中、他のユーザーはデータを「読み込むことも、書き換えることも一切できない」ように完全に独占する強力なロックです。</li>
        </ul>
        <p style="font-size: 13.5px; color: #b91c1c; background-color: #fef2f2; padding: 10px; border-radius: 6px; margin-top: 10px;">
          ⚠️<strong>デッドロック（身動きが取れない致命的な状態）：</strong><br>
          2人のユーザーがそれぞれ別々のデータに占有ロックをかけた状態で、互いに相手がロックしているデータを書き換えようとして、解除待ちのまま永久にフリーズしてしまう（身動きが取れなくなる）現象を指します。
        </p>
      </div>

      <div class="note-section">
        <h3 class="note-title">7. トランザクション処理の「ACID特性」</h3>
        <p>信頼性の高いシステムを構築するために、トランザクション処理が必ず満たすべき4つの重要な性質の頭文字を取ったものです。</p>
        <ul>
          <li><strong>Atomicity（原子性 / 不可分性）：</strong> 処理が「すべて完全に実行される」か「まったく実行されない（最初からなかったことにする）」のどちらかしかないという特性です。中途半端に途中の処理だけが保存されることは絶対にありません。</li>
          <li><strong>Consistency（一貫性 / 整合性）：</strong> 処理の前後で、データベースのルールや整合性に矛盾が生じない特性です。例えば「残高がマイナスになってはいけない」というルールがあれば、マイナスになる振込処理は自動でエラーとなり弾かれます。</li>
          <li><strong>Isolation（隔離性 / 独立性）：</strong> 複数のトランザクションを同時に実行しても、お互いに干渉せず、まるで「1つずつ順番に実行した」のと全く同じ結果が得られるという特性です。</li>
          <li><strong>Durability（耐久性 / 永続性）：</strong> 正常に完了した処理結果は、その直後にシステム障害や停電が起きても、絶対にデータが失われることなく安全に記憶装置に保存され続けるという特性です。</li>
        </ul>
      </div>

      <div class="note-section">
        <h3 class="note-title">8. ストアドプロシージャ（高速化の技術）</h3>
        <p>
          データベースを操作する一連の複雑なSQL文の手順を1つのプログラム（関数）としてまとめ、<strong>DBMS（データベース管理システム）側にあらかじめ保存</strong>しておく技術です。
        </p>
        <p>
          クライアント（PHPなど）とデータベースサーバー間のネットワーク通信回数を劇的に減らすことができるため、処理を高速化させ、サーバー負荷を下げる大きなメリットがあります。
        </p>
      </div>

      <div class="note-section">
        <h3 class="note-title">9. データベースの障害管理と復旧アルゴリズム</h3>
        <p>予期せぬエラーやハードウェア障害から、データを元の安全な状態に戻すための重要な仕組みです。</p>

        <div class="sub-heading">✅ コミット（Commit）と ❌ ロールバック（Rollback）</div>
        <ul>
          <li><strong>コミット：</strong> トランザクション内の一連の処理がすべて正常に完了した際、データの更新を**完全に確定**させて、更新履歴（ジャーナルファイル）を保存する動作。</li>
          <li><strong>ロールバック：</strong> トランザクションの途中でエラーが発生した場合、データの矛盾を防ぐために、**処理を実行する前のまっさらな状態（元の状態）にまでデータをすべて巻き戻す**動作（原子性の担保）。</li>
        </ul>

        <div class="sub-heading">🌐 分散データベースと「2相コミット（ツーフェーズコミット）」</div>
        <p>ネットワークで離れた場所にある複数のデータベース全体でデータの一貫性を保つため、リーダー（主サイト）の呼びかけに対し、各データベースが「確約準備（第1相）」を整え、全員の準備完了を確認してから一斉に「確約（第2相：コミット）」を行うという、**2段階に分けて完全に同期をとる仕組み**です。</p>

        <div class="sub-heading">🛠️ 障害からデータを進めて復旧させる ロールフォワード</div>
        <p>ハードディスクが物理的に破損した際、過去に取っておいたバックアップデータを復元した状態から、<strong>ジャーナルファイル（更新履歴）に残っているデータを障害発生直前の状態まで時計の針を進めるように適用して復旧する方法</strong>です。</p>
      </div>

      <div class="note-section">
        <h3 class="note-title">10. 📦 3種類のバックアップ方法の徹底比較</h3>
        <p>日常のデータ運用の手軽さと、災害・障害時の復旧スピードのトレードオフをまとめた一覧表です。</p>

        <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 15px;">
          <thead>
            <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
              <th style="padding: 10px; text-align: left; width: 25%;">バックアップの種類</th>
              <th style="padding: 10px; text-align: left; width: 45%;">データの取り方（特徴）</th>
              <th style="padding: 10px; text-align: left;">障害発生からの復旧手順</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 10px;"><strong>① フルバックアップ</strong><br><small>(完全バックアップ)</small></td>
              <td style="padding: 10px;">毎回、データベース内にある**すべてのデータ**の複製を丸ごと取る方法です。容量と時間は最大になります。</td>
              <td style="padding: 10px; color: #16a34a; font-weight: bold;">直近のフルバックアップファイルを「1個」戻すだけで最速で復旧する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 10px;"><strong>② 差分バックアップ</strong></td>
              <td style="padding: 10px;">「最初のフルバックアップ」を実行した後の一定期間は、毎回**前回のフルバックアップからの変更分のみ**を重ねて取る方法です。</td>
              <td style="padding: 10px;">「最初のフルバックアップ」と「**直近（最後）の差分データ**」の計2個を使って復旧する。</td>
            </tr>
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 10px;"><strong>③ 増分バックアップ</strong></td>
              <td style="padding: 10px;">「前回のバックアップ」が何であれ、**純粋に前回の作業からの追加・変更分のみ**を毎日小分けにして取る方法です。最も容量と時間を節約できます。</td>
              <td style="padding: 10px; color: #b91c1c;">「最初のフルバックアップ」に加え、「**それ以降に小分けで取ったすべての増分データ**」を完全に古い順に繋ぎ合わせて戻すため、手間と時間がかかる。</td>
            </tr>
          </tbody>
        </table>
        <p style="margin-top: 15px; font-size: 14px; color: #555; background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 4px solid #64748b;">
          <strong>🎯 復習の重要ポイントまとめ</strong><br>
          日頃のバックアップ作業の軽さ（時間や容量の少なさ）を最優先するなら「③増分」が圧倒的に優れていますが、いざ大きな障害が起きて一刻も早く元通りにサイトを復旧させたいという復旧スピードを重視するなら「①フル」や「②差分」が圧倒的に有利になります。
        </p>
      </div>
            <p style="margin-top: 25px;">
                <a href="0706_0914.php" class="td-link">➔ 授業一覧ページへ戻る</a>
            </p>
    </main>

  </div> <!-- .container -->

  <!-- 右下：トップボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
