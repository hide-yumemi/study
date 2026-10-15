<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="職業訓練の「安全衛生」「コンピュータ・ネットワーク概論」「プロジェクトマネジメント」の分野に関する、第1回小テストの復習・解答解説ページです。">
    <title>小テスト1回目 | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ==========================================================================
           小テストページ専用の追加デザイン（CSS）
           ========================================================================== */
        
        /* 各分野（大きな見出し）の調整 */
        .main-content h2 {
            margin-top: 40px;
            color: #1e3a8a;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 5px;
            font-size: 18px;
        }
        .main-content h2:first-of-type {
            margin-top: 20px;
        }

        /* 問題全体のブロック */
        .question-block {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        /* 引用・問題の前提条件となるボックス */
        .quote-box {
            background-color: #f8fafc;
            border-left: 4px solid #64748b;
            padding: 15px;
            font-size: 14px;
            color: #334155;
            line-height: 1.6;
            margin-bottom: 15px;
            border-radius: 0 8px 8px 0;
        }

        /* 問題文のテキスト */
        .question-text {
            font-weight: bold;
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 15px;
        }

        /* 解答・解説ボタン（details）の装飾 */
        details {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 15px;
            background-color: #fdfdfd;
        }
        summary {
            padding: 12px 15px;
            font-weight: bold;
            color: #1e3a8a;
            cursor: pointer;
            background-color: #f1f5f9;
            transition: background 0.2s;
            outline: none;
            user-select: none;
        }
        summary:hover {
            background-color: #e2e8f0;
        }
        /* 開いたときの中身の余白 */
        .answer-content {
            padding: 20px;
            border-top: 1px solid #cbd5e1;
            background-color: #ffffff;
        }

        /* 【答え】のバッジ装飾 */
        .ans-title {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin-right: 5px;
        }
        .ans-text {
            font-size: 16px;
            font-weight: bold;
            color: #ef4444;
        }

        /* 【解説】のバッジ装飾 */
        .exp-title {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            margin-right: 5px;
            margin-top: 15px;
        }
        .exp-text {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin-top: 5px;
        }

        /* 解答コンテンツ内の箇条書きを綺麗にする設定 */
        .answer-content ul {
            padding-left: 20px;
            margin-top: 10px;
        }
        .answer-content li {
            margin-bottom: 8px;
            font-size: 14px;
            color: #334155;
        }

        /* ==========================================================================
           小テスト内専用：テーブル（表）のデザイン調整
           （他のページのメインテーブルとデザインを分離させます）
           ========================================================================== */
        .test-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 14px;
        }
        .test-table th, 
        .test-table td {
            border: 1px solid #cbd5e1;
            padding: 10px 12px;
            text-align: center;
        }
        .test-table th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: bold;
        }
        .test-table td {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <!-- 共通ヘッダーの読み込み -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h1 style="font-size: 22px; color: #1e3a8a; margin-bottom: 5px;">小テスト1回目</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">復習用問題集（基本情報処理）</p>

            <!-- ========================================== -->
            <!-- 分野：安全衛生 -->
            <!-- ========================================== -->
            <h2>【分野：安全衛生】</h2>

            <!-- Q1 -->
            <div class="question-block">
                <div class="quote-box">
                    <strong>次を読んで問いに答えなさい。</strong><br>
                    「情報機器作業における労働衛生管理のためのガイドライン」とは、作業者の健康状態に応じた適切な措置を講ずることができるよう、作業者の健康管理を行うことを目的とし、作業者が情報機器作業を支障なく行うことができるよう支援するために事業者が講ずべき措置等について示したものであり、従前のVDT作業におけるガイドラインを2019年に改定したものである。
                </div>

                <div class="question-text">Q1. このガイドラインを策定した省はどこか。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <span class="ans-text">厚生労働省</span></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">労働環境の安全や健康を守るためのガイドラインであるため、厚生労働省が策定・管理しています。</p>
                    </div>
                </details>
            </div>

            <!-- Q2 -->
            <div class="question-block">
                <div class="question-text">Q2. 情報機器（VDT機器）としてディスプレイ以外のものを一つ挙げなさい。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答えの例】</span> <span class="ans-text">タブレット（または キーボード、マウス など）</span></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">VDT（Visual Display Terminals）機器には、画面表示装置だけでなく、それらを操作・連動させる入力機器や情報端末全般が含まれます。</p>
                    </div>
                </details>
            </div>

            <!-- Q3 -->
            <div class="question-block">
                <div class="question-text">Q3. このガイドラインにおいて、書類及びキーボード面の照度は何ルクス以上とされているか。</div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span> <span class="ans-text">300ルクス以上</span></p>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">ガイドラインでは、画面を見やすくし眼精疲労を防ぐため、書類やキーボード面は「300ルクス以上」、ディスプレイ画面上の照度は「500ルクス以下」が望ましいとされています。</p>
                    </div>
                </details>
            </div>


            <!-- ========================================== -->
            <!-- 分野：コンピュータ・ネットワーク概論・アルゴリズム概論 -->
            <!-- ========================================== -->
            <h2>【分野：コンピュータ・ネットワーク概論・アルゴリズム概論】</h2>

            <!-- Q4 -->
            <div class="question-block">
                <div class="question-text">Q4. 以下の進数変換の空白を埋めなさい。</div>
                
                <table class="test-table">
                    <thead>
                        <tr>
                            <th>10進数</th>
                            <th>2進数</th>
                            <th>16進数</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>18</td>
                            <td>10010</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 A ）</td>
                            <td>1010011</td>
                            <td>53</td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 B ）</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 C ）</td>
                        </tr>
                        <tr>
                            <td>39</td>
                            <td>100111</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 D ）</td>
                        </tr>
                        <tr>
                            <td>47</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 E ）</td>
                            <td>2F</td>
                        </tr>
                    </tbody>
                </table>

                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span></p>
                        <ul>
                            <li><strong>空欄 A :</strong> <span class="ans-text">83</span> （2進数 1010011 / 16進数 53 の10進数）</li>
                            <li><strong>空欄 B :</strong> <span class="ans-text">10000</span> （16の2進数）</li>
                            <li><strong>空欄 C :</strong> <span class="ans-text">10</span> （16の16進数）</li>
                            <li><strong>空欄 D :</strong> <span class="ans-text">27</span> （39の16進数）</li>
                            <li><strong>空欄 E :</strong> <span class="ans-text">101111</span> （47の2進数）</li>
                        </ul>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">
                            <strong>16進数「53」の変換:</strong> 5 &times; 16 + 3 = 80 + 3 = 83。2進数の <code>1010011</code> も 64 + 16 + 2 + 1 = 83 となり、10進数では <code>83</code> になります。<br>
                            <strong>16の変換:</strong> 16は2の4乗（2<sup>4</sup>）なので、2進数では1の後に0が4つ並ぶ <code>10000</code>。16進数では基数そのものになるため桁が上がり <code>10</code> になります。<br>
                            <strong>39の変換:</strong> 39を16で割ると「2 余り 7」なので、16進数では <code>27</code> になります。<br>
                            <strong>47の変換:</strong> 47は「32 + 8 + 4 + 2 + 1」なので、2進数では <code>101111</code> になります（16進数 <code>2F</code> の <code>2</code>=<code>0010</code>、<code>F</code>=<code>1111</code> から繋げても導けます）。
                        </p>
                    </div>
                </details>
            </div>

            <!-- Q5 -->
            <div class="question-block">
                <div class="question-text">Q5. コンピュータの五大装置すべてとその代表的な機器（部品）を1つずつ答えなさい。</div>
                
                <table class="test-table">
                    <thead>
                        <tr>
                            <th>装置名</th>
                            <th>代表的な機器（部品）の例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>制御装置</strong></td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 A ）</td>
                        </tr>
                        <tr>
                            <td><strong>演算装置</strong></td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 B ）</td>
                        </tr>
                        <tr>
                            <td><strong>記憶装置</strong></td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 C ）</td>
                        </tr>
                        <tr>
                            <td><strong>入力装置</strong></td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 D ）</td>
                        </tr>
                        <tr>
                            <td><strong>出力装置</strong></td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 E ）</td>
                        </tr>
                    </tbody>
                </table>

                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span></p>
                        <ul>
                            <li><strong>空欄 A :</strong> <span class="ans-text">CPU</span></li>
                            <li><strong>空欄 B :</strong> <span class="ans-text">CPU / ALU（算術論理演算装置）</span></li>
                            <li><strong>空欄 C :</strong> <span class="ans-text">メモリ（主記憶装置） / HDD・SSD（補助記憶装置）</span></li>
                            <li><strong>空欄 D :</strong> <span class="ans-text">マウス / キーボード / タブレット</span></li>
                            <li><strong>空欄 E :</strong> <span class="ans-text">ディスプレイ / プリンタ</span></li>
                        </ul>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">制御装置と演算装置の機能は、現代のコンピュータではどちらも「CPU（中央処理装置）」の中に組み込まれています。その中で、実際に四則演算や論理演算を専門に行う回路モジュールのことを <strong>ALU（Arithmetic Logic Unit：算術論理演算装置）</strong> と呼びます。</p>
                    </div>
                </details>
            </div>

            <!-- Q6 -->
            <div class="question-block">
                <div class="question-text">Q6. OSI基本参照モデルの表の空欄（第1層、第3層、第7層）を答えなさい。</div>
                
                <table class="test-table">
                    <thead>
                        <tr>
                            <th>層</th>
                            <th>層名</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>第7層</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 A ）</td>
                        </tr>
                        <tr>
                            <td>第6層</td>
                            <td>プレゼンテーション層</td>
                        </tr>
                        <tr>
                            <td>第5層</td>
                            <td>セッション層</td>
                        </tr>
                        <tr>
                            <td>第4層</td>
                            <td>トランスポート層</td>
                        </tr>
                        <tr>
                            <td>第3層</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 B ）</td>
                        </tr>
                        <tr>
                            <td>第2層</td>
                            <td>データリンク層</td>
                        </tr>
                        <tr>
                            <td>第1層</td>
                            <td style="color: #0284c7; font-weight: bold;">（ 空欄 C ）</td>
                        </tr>
                    </tbody>
                </table>

                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答え】</span></p>
                        <ul>
                            <li><strong>空欄 A (第7層):</strong> <span class="ans-text">アプリケーション層</span></li>
                            <li><strong>空欄 B (第3層):</strong> <span class="ans-text">ネットワーク層</span></li>
                            <li><strong>空欄 C (第1層):</strong> <span class="ans-text">物理層</span></li>
                        </ul>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">OSI基本参照モデルは通信機能を7つの階層に分けたモデルです。下位から「物理、データリンク、ネットワーク、トランスポート、セッション、プレゼンテーション、アプリケーション」の順で並んでいます。</p>
                    </div>
                </details>
            </div>


            <!-- ========================================== -->
            <!-- 分野：プロジェクトマネジメント -->
            <!-- ========================================== -->
            <h2>【分野：プロジェクトマネジメント】</h2>

            <!-- Q7 -->
            <div class="question-block">
                <div class="question-text">
                    Q7. プロジェクトマネジメントの技法を体系的にまとめたものをPMBOK（ピンボック）といいます。<br>
                    この手法は従来の3つの管理（品質・コスト・納期）ではなく10の分野に分けた管理手法となります。コストと品質以外で、残りの8つの管理のうち4つを答えなさい。
                </div>
                <details>
                    <summary>解答・解説を表示</summary>
                    <div class="answer-content">
                        <p><span class="ans-title">【答えの例（以下のいずれか4つ）】</span></p>
                        <ul>
                            <li><span class="ans-text">コミュニケーション・マネジメント</span></li>
                            <li><span class="ans-text">リスク・マネジメント</span></li>
                            <li><span class="ans-text">資源・マネジメント</span></li>
                            <li><span class="ans-text">スコープ・マネジメント</span></li>
                            <li>スケジュール・マネジメント（旧：タイム・マネジメント）</li>
                            <li>統合マネジメント</li>
                            <li>調達マネジメント</li>
                            <li>ステークホルダー・マネジメント</li>
                        </ul>
                        <p><span class="exp-title">【解説】</span></p>
                        <p class="exp-text">PMBOKではプロジェクト全体の要素をカバーするために10の知識エリア（管理分野）を定めています。実際のテスト解答では「コミュニケーション」「リスク」「資源」「スコープ」の4つが主に挙げられます。</p>
                    </div>
                </details>
            </div>

        </main>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
