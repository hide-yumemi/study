<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex,nofollow">
  <title>教材regex.php 生コード表示 | ポートフォリオサイト</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* VSCode風のダークテーマ・コード表示用スタイル */
    .code-viewer-container {
      background-color: #1e1e1e;
      color: #d4d4d4;
      font-family: 'Consolas', 'Courier New', monospace;
      font-size: 14px;
      line-height: 20px;
      padding: 20px;
      border-radius: 8px;
      overflow-x: auto;
      margin: 20px 0;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .code-viewer-table {
      border-collapse: collapse;
      width: 100%;
    }

    .code-viewer-table tr {
      counter-increment: line-number;
    }

    /* 行番号のエリア（コピーされない設定） */
    .code-line-num {
      width: 40px;
      text-align: right;
      padding-right: 15px;
      color: #858585;
      user-select: none;
      -webkit-user-select: none;
      border-right: 1px solid #3c3c3c;
      vertical-align: top;
    }

    .code-line-num::before {
      content: counter(line-number);
    }

    /* コード本文のエリア */
    .code-line-content {
      padding-left: 15px;
      white-space: pre;
      vertical-align: top;
      text-align: left;
    }

    /* 🟢 コメントアウト行をVSCode風の緑色にするスタイル */
    .code-comment {
      color: #6a9955;
      font-style: italic;
    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <main class="main-content" style="background-color: #f5f5f5;">
      <h2 style="color: #1e3a8a; border-bottom: 2px solid #1e3a8a; padding-bottom: 8px;">教材 正規表現チェック 生コード確認</h2>
      <p style="font-size: 13px; color: #666; margin-bottom: 15px;">※左側の行番号はコピペ時に選択されません。コメント（緑色の行）も忠実に再現しています。</p>

      <div class="code-viewer-container">
        <table class="code-viewer-table">
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;!DOCTYPE html&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;html lang="ja"&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;head&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> &lt;meta charset="UTF-8"&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> &lt;title&gt;正規表現チェック&lt;/title&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;/head&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;body&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> &lt;?php</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> <span class="code-comment">//メールアドレスチェック例</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> <span class="code-comment">// \$mailmatch="/^[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+\.[a-zA-Z0-9\._-]+$/"; 修正</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> \$mailmatch = "/^[a-zA-Z0-9]+[a-zA-Z0-9\._\-]*@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9\._\-]+$/"; <span class="code-comment">//ハイフンをエスケープし忘れてた為、教材修正</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> \$email = "aaa@aa,aa";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> if (preg_match(\$mailmatch, \$email)) {</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> echo "&lt;p&gt;メールはマッチした&lt;/p&gt;";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> } else {</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> echo "&lt;p&gt;メールはマッチしなかった&lt;/p&gt;";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> }</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> <span class="code-comment">//全角文字チェック例</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> \$wordmatch = "/^[ぁ-んァ-ヶー々一-龠０-９]+$/u";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> \$word = "あア言葉１２佐々木";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> if (preg_match(\$wordmatch, \$word)) {</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> echo "&lt;p&gt;文字はマッチした&lt;/p&gt;";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> } else {</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> echo "&lt;p&gt;文字はマッチしなかった&lt;/p&gt;";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> }</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> <span class="code-comment">//パスワードチェック例(小文字英、大文字英、数字の３種必須)</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> \$pass = "aaaa1234";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> if (preg_match("/^[a-zA-Z0-9]{8,12}$/", \$pass) &amp;&amp; preg_match("/[a-z]+/", \$pass) &amp;&amp; preg_match("/[A-Z]+/", \$pass) &amp;&amp; preg_match("/[0-9]+/", \$pass)) {</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> echo "&lt;p&gt;パスはマッチした&lt;/p&gt;";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> } else {</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> echo "&lt;p&gt;パスはマッチしなかった&lt;/p&gt;";</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> }</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> <span class="code-comment">/*</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">正規表現チェックについて</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">preg_match()関数を使用し、</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">第一引数にマッチ指定</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">第二引数に確認する文字列</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">マッチ指定は全体を/～/で囲む</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">その時、全角文字を指定するときは/の後に文字コード指定(utf-8ならu)</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">開始の/の後に^を付けると確認する文字列の１文字目から</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">つけないと頭に関係ない文字があってもtrue判定になる</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">終了の/の前に\$を付けると確認する文字列の最後の文字まで</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">つけないと後ろに関係ない文字があってもtrue判定になる</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">文字数について</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">+　直前の指定文字が１字以上</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">*　直前の指定文字が０字以上</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">{m}　直前の指定文字がm字</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">{m,}　直前の指定文字がm字以上</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">{m,n}　直前の指定文字がm字からn字</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">文字種の指定について</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">（-が～の意味）</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">a-z　半角小文字英字</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">A-Z　半角大文字英字</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">0-9　半角数字</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">０-９　全角数字</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">ぁ-ん　全角ひらがな</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">ァ-ヶ　全角カタカナ</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">一-龠　全角漢字（常用漢字）「々」や「ー（音引き）」は入らない</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment"></span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">記号などは個々に指定</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">複数の中のどれかの時は[]で囲む</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">[]の中の１文字目に^を付けると否定になる</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">例)[^0-9]は半角数字以外となる</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"><span class="code-comment">*/</span></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"> ?&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;/body&gt;</td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content"></td>
          </tr>
          <tr>
            <td class="code-line-num"></td>
            <td class="code-line-content">&lt;/html&gt;</td>
          </tr>
        </table>
      </div> <!-- .code-viewer-container 終了 -->

      <p style="margin-top: 25px;">
        <a href="0915_1119.php" class="td-link">➔ 授業一覧ページへ戻る</a>
      </p>
    </main>
  </div> <!-- .container 終了 -->
  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>
</body>

</html>