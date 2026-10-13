<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="職業訓練の「PHP・データベースの基本概論」「PHP実践」に関する第4回小テストの復習・解答解説ページです。">
  <title>小テスト4回目 復習用問題集 | ポートフォリオサイト</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* ==========================================================================
           小テスト4回目ページ専用の追加デザイン（CSS）
           ========================================================================== */
    .section-title {
      font-size: 18px;
      font-weight: bold;
      margin-top: 40px;
      margin-bottom: 15px;
      background: #f0f4f8;
      padding: 10px 15px;
      border-left: 5px solid #1e3a8a;
      border-radius: 0 4px 4px 0;
      color: #1e3a8a;
    }

    .main-content .section-title:first-of-type {
      margin-top: 20px;
    }

    .score-info {
      font-size: 15px;
      margin: 15px 0;
      font-weight: bold;
      color: #4a5568;
    }

    .question-block {
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 25px;
      margin: 20px 0;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }

    .question-text {
      font-weight: bold;
      font-size: 16px;
      color: #1e293b;
      line-height: 1.5;
      margin-bottom: 12px;
    }

    pre {
      background: #f8fafc;
      padding: 15px;
      border: 1px solid #cbd5e1;
      border-radius: 6px;
      overflow-x: auto;
      font-family: Consolas, Monaco, monospace;
      font-size: 14px;
      line-height: 1.5;
      margin: 15px 0;
      color: #334155;
    }

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

    .answer-content {
      padding: 20px;
      border-top: 1px solid #cbd5e1;
      background-color: #ffffff;
    }

    .ans-title {
      display: inline-block;
      background-color: #ef4444;
      color: white;
      padding: 2px 8px;
      border-radius: 4px;
      font-size: 13px;
      font-weight: bold;
      margin-bottom: 8px;
    }

    .ans-body {
      display: inline-block;
      font-family: Consolas, Monaco, monospace;
      font-size: 15px;
      font-weight: bold;
      color: #dc2626;
      background: #fee2e2;
      padding: 6px 12px;
      border: 1px solid #fca5a5;
      border-radius: 6px;
      margin-bottom: 15px;
      line-height: 1.5;
    }

    .commentary-title {
      display: inline-block;
      background-color: #3b82f6;
      color: white;
      padding: 2px 8px;
      border-radius: 4px;
      font-size: 13px;
      font-weight: bold;
      margin-bottom: 6px;
    }

    .commentary-text {
      font-size: 14px;
      color: #475569;
      line-height: 1.6;
    }

    .commentary-text code {
      background-color: #f1f5f9;
      color: #334155;
      padding: 2px 5px;
      border-radius: 4px;
      font-family: monospace;
      font-size: 13px;
    }

    .test-table {
      width: 100%;
      border-collapse: collapse;
      margin: 15px 0;
      font-size: 14px;
    }

    .test-table th,
    .test-table td {
      border: 1px solid #cbd5e1;
      padding: 12px 15px;
      text-align: left;
    }

    .test-table th {
      background-color: #f1f5f9;
      color: #334155;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <main class="main-content">
      <h1 style="font-size: 22px; color: #1e3a8a; margin-bottom: 5px;">小テスト4回目</h1>
      <p style="color: #666; font-size: 14px; margin-bottom: 25px;">復習用問題集（PHP・データベースの基本概論 / JavaScript総合実習）</p>

      <!-- ========================================== -->
      <!-- 分野：PHP・データベースの基本概論 / JavaScript総合実習 -->
      <!-- ========================================== -->
      <div class="section-title">【分野：PHP・データベースの基本概論】【分野：JavaScript総合実習】</div>

      <div class="question-block">
        <div class="question-text">問1. Switch case文はJavaScriptとPHPで変数の書き方以外にも違う点がある。それはなにか記述してください。</div>
        <details>
          <summary>解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">演算子（ <code>==</code> や <code>===</code> ）の判定が違う・値とその型の扱い方。</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text">JavaScriptの <code>switch</code> 文は厳密等価演算子（ <code>===</code> ）で判定されるため、値だけでなく「データ型」まで一致している必要があります。一方、PHPの <code>switch</code> 文は緩やかな比較（ <code>==</code> ）で判定されるため、文字列の <code>"5"</code> と数値の <code>5</code> が同じケース（case）として一致してしまうという挙動の違いがあります。</div>
          </div>
        </details>
      </div>

            <!-- 問2（PHPの説明 ◯×クイズ：問題の下に解答ボタンを配置するレイアウトに修正） -->
            <div class="question-block">
                <div class="score-info">問2. PHPの説明として、次の中から正しいものには◯、間違っているものには×で答えてください。</div>
                <p style="color: #666; font-size: 13px; margin-bottom: 25px;">※それぞれの問題の下にある「解答を表示」をクリックすると、◯×判定と理由が表示されます。</p>

                <!-- ○× 1問目 -->
                <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px dashed #e2e8f0;">
                    <div class="question-text">① JavaScript、PHPともにテキストエディタとブラウザがあれば、開発し動作を確認できる。</div>
                    <details style="margin-top: 10px;">
                        <summary>解答を表示</summary>
                        <div class="answer-content">
                            <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">× （間違い）</span></p>
                            <p class="commentary-text" style="margin-top: 8px;"><strong>解説：</strong>JavaScriptはブラウザのみで動きますが、PHPはApacheなどの「Webサーバー環境（XAMPPなど）」がないと動作確認できません。</p>
                        </div>
                    </details>
                </div>

                <!-- ○× 2問目 -->
                <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px dashed #e2e8f0;">
                    <div class="question-text">② JavaScript、PHPともに変数を使用する際に型を宣言することは不要である。</div>
                    <details style="margin-top: 10px;">
                        <summary>解答を表示</summary>
                        <div class="answer-content">
                            <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">× （間違い）</span></p>
                            <p class="commentary-text" style="margin-top: 8px;"><strong>解説：</strong>手書きテストの採点基準に準拠。ITの基本知識としてはどちらも自動で型が決まる「動的型付け言語」のため型宣言は不要ですが、試験のひっかけ問題用の解説になります。</p>
                        </div>
                    </details>
                </div>

                <!-- ○× 3問目 -->
                <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px dashed #e2e8f0;">
                    <div class="question-text">③ JavaScript、PHPともにHTML文書と同じフォルダ（同じ階層）に保存しなければならない。</div>
                    <details style="margin-top: 10px;">
                        <summary>解答を表示</summary>
                        <div class="answer-content">
                            <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">× （間違い）</span></p>
                            <p class="commentary-text" style="margin-top: 8px;"><strong>解説：</strong>今回のサイトで新しく作った <code>img</code> フォルダのように、フォルダ構成は管理や整理がしやすいよう自由に変更可能です。</p>
                        </div>
                    </details>
                </div>

                <!-- ○× 4問目 -->
                <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px dashed #e2e8f0;">
                    <div class="question-text">④ JavaScript、PHPともにコンパイルが不要でそのまま実行できるインタプリタ言語である。</div>
                    <details style="margin-top: 10px;">
                        <summary>解答を表示</summary>
                        <div class="answer-content">
                            <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a; font-weight: bold;">◯ （正しい）</span></p>
                            <p class="commentary-text" style="margin-top: 8px;"><strong>解説：</strong>ソースコードを事前変換せず、上から1行ずつ即座に解釈・実行するインタプリタ（スクリプト）言語で間違いありません。</p>
                        </div>
                    </details>
                </div>

                <!-- ○× 5問目 -->
                <div style="margin-bottom: 10px;">
                    <div class="question-text">⑤ JavaScriptのコンソール、PHPの表示画面にエラーと行数が表示された場合、当該行に誤りがある。</div>
                    <details style="margin-top: 10px;">
                        <summary>解答を表示</summary>
                        <div class="answer-content">
                            <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">× （間違い）</span></p>
                            <p class="commentary-text" style="margin-top: 8px;"><strong>解説：</strong>画面に表示されるエラー行数は「プログラムがパニックを起こした場所」を指します。本当の原因はその1行上のセミコロン `;` の付け忘れなどであることが非常に多いです。</p>
                        </div>
                    </details>
                </div>

            </div> 
      <!-- ========================================== -->
      <!-- 分野：PHP実践 -->
      <!-- ========================================== -->
      <div class="section-title">【分野：PHP実践】</div>

      <!-- 💡 歪みの原因だった余分な table タグを除去し、綺麗に配置し直しました -->
      <div class="question-block">
        <div class="score-info">問1. PHPにて変数として使用できるものを◯で囲み、使用できないものに×印をつけてください。</div>
        <p style="color: #666; font-size: 13px; margin-bottom: 15px;">※「解答・解説を表示」をクリックすると、◯×判定と理由が表示されます。</p>

        <table class="test-table">
          <thead>
            <tr>
              <th style="text-align: center; width: 150px;">変数名</th>
              <th>問題に挑戦する</th>
            </tr>
          </thead>
          <tbody>
            <!-- 1: $var -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$var</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a;">◯ （使用できる）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>英小文字から始まる標準的で正しい変数名です。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 2: $VAR -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$VAR</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a;">◯ （使用できる）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>英大文字から始まる変数名も使用可能です（PHPは変数名の大文字小文字を厳密に区別します）。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 3: $a&a -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$a&amp;a</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626;">× （使用できない）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>変数名に記号（ <code>&amp;</code> ）を含めることはできません。エラーになります。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 4: $_XYZ -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$_XYZ</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a;">◯ （使用できる）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>PHPの変数名は、ドルの後ろをアンダースコア（ <code>_</code> ）から始めることも認められています。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 5: $_POST -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$_POST</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a;">◯ （使用できる）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>フォームからの送信値を受け取るための、PHPに最初から用意されている特別な変数（スーパーグローバル変数）です。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 6: $var-123 -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$var-123</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626;">× （使用できない）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>変数名にハイフン（ <code>-</code> ）は使えません。プログラムに「引き算の算術演算子」だと誤解されてしまうためです。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 7: $123var -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$123var</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626;">× （使用できない）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>変数名の先頭に数字（ <code>123</code> ）を持ってくることはできないルールになっています。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- 8: $var_123 -->
            <tr>
              <td style="text-align: center; font-size: 16px;"><code>$var_123</code></td>
              <td>
                <details>
                  <summary>解答・解説を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a;">◯ （使用できる）</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>先頭以外であれば、変数名の中に数字やアンダースコア（ <code>_</code> ）を自由に組み合わせることができます。</p>
                  </div>
                </details>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- 問2 -->
      <div class="question-block">
        <div class="score-info">問2. 以下のソースを実行した後、 $aaa 、 $bbb の値を記述してください。</div>

        <p><strong>① インクリメント・デクリメント問題（後置）</strong></p>
        <pre>
$aaa = 2;
$bbb = 5;
$bbb += $aaa++;</pre>
        <details>
          <summary>①の解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">$aaa = 3 &nbsp;&nbsp; / &nbsp;&nbsp; $bbb = 7</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text"><code>$bbb += $aaa++;</code> は、「現在の $aaa（2）の値を $bbb（5）に足し算（5 + 2 = 7）」した<strong>後</strong>に、<code>$aaa</code> がインクリメントされて 3 になります。後置プラス（++）は、式全体の評価が終わった後に1増える点に注意しましょう。</div>
          </div>
        </details>

        <p style="margin-top: 25px;"><strong>② インクリメント・デクリメント問題（前置）</strong></p>
        <pre>
$aaa = 2;
$bbb = ++$aaa;</pre>
        <details>
          <summary>②の解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">$aaa = 3 &nbsp;&nbsp; / &nbsp;&nbsp; $bbb = 3</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text"><code>$bbb = ++$aaa;</code> は、先に <code>$aaa</code>（2）がインクリメントされて <code>3</code> になった<strong>後</strong>に、その値が <code>$bbb</code> に代入されます。前置プラス（++）は、代入が起きる前に1増えるため、両方とも 3 になります。</div>
          </div>
        </details>
      </div>
      <!-- 問2（PHPの説明 ◯×クイズ：解答・解説を表示するまで隠れる仕様） -->
      <div class="question-block">
        <div class="score-info">問2. PHPの説明として、次の中から正しいものには◯、間違っているものには×で答えてください。</div>
        <p style="color: #666; font-size: 13px; margin-bottom: 15px;">※「解答・解説を表示」をクリックすると、◯×判定と理由が表示されます。</p>

        <table class="test-table">
          <thead>
            <tr>
              <th>説明文</th>
              <th style="width: 150px; text-align: center;">問題に挑戦する</th>
            </tr>
          </thead>
          <tbody>
            <!-- ○×1 -->
            <tr>
              <td>JavaScript、PHPともにテキストエディタとブラウザがあれば、開発し動作を確認できる。</td>
              <td>
                <details>
                  <summary>解答を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">×</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>JavaScriptはブラウザのみで動きますが、PHPはApacheなどの「Webサーバー環境（XAMPPなど）」が必須です。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- ○×2 -->
            <tr>
              <td>JavaScript、PHPともに変数を使用する際に型を宣言することは不要である。</td>
              <td>
                <details>
                  <summary>解答を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">×</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>手書きテストの採点基準に準拠。基本情報としては動的型付け言語ですが、文脈による引っかけ問題対応です。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- ○×3 -->
            <tr>
              <td>JavaScript、PHPともにHTML文書と同じフォルダ（同じ階層）に保存しなければならない。</td>
              <td>
                <details>
                  <summary>解答を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">×</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>今回作成した <code>img</code> フォルダのように、フォルダ構成は管理しやすいよう自由に変更可能です。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- ○×4 -->
            <tr>
              <td>JavaScript、PHPともにコンパイルが不要でそのまま実行できるインタプリタ言語である。</td>
              <td>
                <details>
                  <summary>解答を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #16a34a; font-weight: bold;">◯</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>ソースコードを1行ずつ即座に解釈して実行するインタプリタ（スクリプト）言語で間違いありません。</p>
                  </div>
                </details>
              </td>
            </tr>
            <!-- ○×5 -->
            <tr>
              <td>JavaScriptのコンソール、PHPの表示画面にエラーと行数が表示された場合、当該行に誤りがある。</td>
              <td>
                <details>
                  <summary>解答を表示</summary>
                  <div class="answer-content" style="padding: 10px; border: none;">
                    <p><span class="ans-title">【判定】</span> <span class="ans-text" style="color: #dc2626; font-weight: bold;">×</span></p>
                    <p class="commentary-text" style="margin-top: 5px;"><strong>解説：</strong>エラーが検知された行の手前（セミコロンの付け忘れなど）が真の原因であることが非常に多いためです。</p>
                  </div>
                </details>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- 問3 -->
      <div class="question-block">
        <div class="question-text">問3. 他のPHPファイルを読み込むrequire、require_once、include、include_onceについて、_onceのついている命令は、2回目の読み込みを行わない命令となっているが、requireとincludeの違いは読み込もうとしたファイルが存在しないときのエラーの違いとなっている。どのように違うかエラー発生時のプログラム処理をそれぞれ記述してください。</div>
        <details>
          <summary>解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">
              <strong>require、require_onceでの処理：</strong> Fatal Error（致命的なエラー）で 処理が止まる。<br>
              <strong>include、include_onceでの処理：</strong> Warning Error（警告）で 処理が続く。
            </div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text">
              <ul>
                <li><strong>require系：</strong>ファイルがないとシステムが崩壊する致命的な場所（データベース接続など）に使用し、エラー時は即座に強制停止させます。</li>
                <li><strong>include系：</strong>ヘッダーや広告など、最悪表示されなくても全体の動作を止めずに続行させたいパーツの読み込みに使用します。</li>
              </ul>
            </div>
          </div>
        </details>
      </div>

      <!-- 問4 -->
      <div class="question-block">
        <div class="question-text">問4. 以下のプログラムは連想配列の値をすべて書き出す処理を行っている。【 】を埋めて、プログラムを完成させましょう。</div>
        <pre>
1  │ &lt;?php
2  │   $fruits_mixed = array(
3  │     'peach',
4  │     'blueberry',
5  │     'apple' =&gt; 'red',
6  │     'banana' =&gt; 'yellow',
7  │     'orange' =&gt; 'orange'
8  │   );
9  │   foreach($fruits_mixed 【  ①  】 $value):
10 │ ?&gt;
11 │     &lt;p&gt;&lt;?php echo $value; ?&gt;&lt;/p&gt;
12 │ &lt;?php 【  ②  】 ; ?&gt;</pre>
        <div style="font-size: 13px; color: #666; margin-bottom: 10px;">※②はforeach文を終了することを意味する命令文</div>

        <details>
          <summary>解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">① as &nbsp;&nbsp; / &nbsp;&nbsp; ② endforeach</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text">
              <ul>
                <li><strong>① as：</strong> <code>foreach($配列名 as $変数名)</code> の形で、配列から1データずつ変数に切り出します。</li>
                <li><strong>② endforeach：</strong> コロン記法（テンプレート構文）と呼ばれる、HTML埋め込み時に波カッコ <code>{}</code> の代わりとして使われるPHP独自の閉じタグ表記です。</li>
              </ul>
            </div>
          </div>
        </details>
      </div>

      <!-- ========================================== -->
      <!-- 分野：サーバ構築基礎 / PHP・データベースの基本概念 -->
      <!-- ========================================== -->
      <div class="section-title">【分野：サーバ構築基礎】【分野：PHP・データベースの基本概念】</div>

      <div class="question-block">
        <div class="question-text">問1. 下記の図のデータベースの型を記述しなさい。□が1つのデータになります。</div>

        <p><strong>① 二次元の表（テーブル）形式で管理する型</strong></p>
        <div style="background: #f8fafc; padding: 10px; border: 1px dashed #cbd5e1; display: inline-block; margin: 5px 0; font-family: monospace;">
          [ 縦横の格子状の表データ ]
        </div>
        <details>
          <summary>①の解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">リレーショナル型（関係型データベース / RDB）</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text">エクセルのように縦列と横行の二次元の表で関係性を表現します。現在のIT業界で最も普及しているデータベース設計の基盤です。</div>
          </div>
        </details>

        <p style="margin-top: 25px;"><strong>② 網目のようにデータが複数の親と結びつく型</strong></p>
        <div style="background: #f8fafc; padding: 10px; border: 1px dashed #cbd5e1; display: inline-block; margin: 5px 0; font-family: monospace;">
          [ 複雑に網の目で繋がったデータ構造 ]
        </div>
        <details>
          <summary>②の解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">ネットワーク型</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text">データが網の目のように複雑に絡み合う構造です。1つの子要素が複数の親要素と繋がれる「多対多」の柔軟な表現を特徴としています。</div>
          </div>
        </details>
        <p style="margin-top: 25px;"><strong>③ 木の枝分かれ（ツリー構造）のように管理する型</strong></p>
        <div style="background: #f8fafc; padding: 10px; border: 1px dashed #cbd5e1; display: inline-block; margin: 5px 0; font-family: monospace;">
          [ 1つの親から下へ枝分かれするデータ構造 ]
        </div>
        <details>
          <summary>③の解答・解説を表示</summary>
          <div class="answer-content">
            <div class="ans-title">【答え】</div><br>
            <div class="ans-body">階層型</div>
            <br>
            <div class="commentary-title">【解説】</div>
            <div class="commentary-text">パソコンのフォルダ階層や、会社の組織図のように、1つの親から複数の子へとツリー状（1対多の主従関係）に枝分かれしてデータを管理する、最も歴史の古いデータ構造です。</div>
          </div>
        </details>
      </div>

    </main>

    <!-- 右側：更新履歴（containerの中で正しく横並びにします） -->
    <?php include 'history.php'; ?>

  </div> <!-- .container -->

  <!-- 右下：トップボタン -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>