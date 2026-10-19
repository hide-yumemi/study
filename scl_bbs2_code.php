<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>教材bbs2.php 生コード表示 | ポートフォリオサイト</title>
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
            <h2 style="color: #1e3a8a; border-bottom: 2px solid #1e3a8a; padding-bottom: 8px;">教材 bbs2.php (PDO版) 生コード確認</h2>
            <p style="font-size: 13px; color: #666; margin-bottom: 15px;">※コメントアウト（緑色の行）も含め、実際のソースコードを忠実に再現しています。</p>
            
            <div class="code-viewer-container">
                <table class="code-viewer-table">
                    <!-- 1行目〜20行目 -->
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;?php</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content"><span class="code-comment">//DB接続情報</span></td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">if (\$_SERVER['SERVER_NAME'] === 'localhost') {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$dbname = 'mysql:host=localhost;dbname=oneline_bbs;charset=utf8';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$id = 'root';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$pw = '';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">} else {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$dbname = 'mysql:host=://infinityfree.com;dbname=if0_42505591_bbs;charset=utf8';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$id = 'if0_42505591';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$pw = 'Cvp0m9xHZOUL8pZ';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">}</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content"></td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">try {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    <span class="code-comment">//DB取得処理</span></td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$pdo = new PDO(\$dbname, \$id, \$pw, array(PDO::ATTR_EMULATE_PREPARES =&gt; false));</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">} catch (PDOException \$e) {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    exit('データベース接続失敗。' . \$e-&gt;getMessage());</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">}</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">\$errors = array();</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">if (\$_SERVER["REQUEST_METHOD"] === "POST") {</td></tr>
                    <!-- 21行目〜51行目 -->
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$name = null;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    if (!isset(\$_POST["name"]) || !strlen(\$_POST["name"])) {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$errors["name"] = "名前を入力してください";</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    } else if (strlen(\$_POST["name"]) &gt; 40) {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$errors["name"] = "名前は４０文字以内で入力してください";</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    } else {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$name = \$_POST["name"];</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    }</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$comment = null;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    if (!isset(\$_POST["comment"]) || !strlen(\$_POST["comment"])) {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$errors["comment"] = "ひとことを入力してください";</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    } else if (strlen(\$_POST["comment"]) &gt; 200) {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$errors["comment"] = "ひとことは２００文字以内で入力してください";</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    } else {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$comment = \$_POST["comment"];</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    }</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$date = date('Y-m-d H:i:s');</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    if (count(\$errors) === 0) {</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$sql = 'INSERT INTO `post` (`name`,`comment`,`created_at`) VALUES (:name,:comment,:created_at)';</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$stmt = \$pdo-&gt;prepare(\$sql);</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$stmt-&gt;bindParam(':name', \$name);</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$stmt-&gt;bindParam(':comment', \$comment);</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$stmt-&gt;bindParam(':created_at', \$date);</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$stmt-&gt;execute();</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        \$stmt = null;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        header("Location: http://" . \$_SERVER['HTTP_HOST'] . \$_SERVER['REQUEST_URI']);</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    }</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">}</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">?&gt;</td></tr>
                    <!-- 52行目〜75行目 -->
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;!DOCTYPE html&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;html lang="ja"&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;head&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;meta charset="UTF-8"&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;title&gt;ひとこと掲示板&lt;/title&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;/head&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;body&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;h1&gt;ひとこと掲示板&lt;/h1&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;form action="bbs2.php" method="post"&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        &lt;?php if (count(\$errors)): ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">            &lt;ul&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                &lt;?php foreach (\$errors as \$error): ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                    &lt;li&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                        &lt;?php echo htmlspecialchars(\$error, ENT_QUOTES, "UTF-8") ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                    &lt;/li&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                &lt;?php endforeach; ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">            &lt;/ul&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        &lt;?php endif; ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        名前：&lt;input type="text" name="name"&gt;&lt;br&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        ひとこと：&lt;input type="text" name="comment"&gt;&lt;br&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        &lt;input type="submit" name="submit" value="追加"&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;/form&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;?php</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$stmt = \$pdo-&gt;prepare("SELECT * FROM `post` ORDER BY `created_at` DESC");</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$result = \$stmt-&gt;execute();</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    echo \$stmt-&gt;fetchColumn();</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    ?&gt;</td></tr>
                    <!-- 76行目〜96行目（末尾まで） -->
                    <tr><td class="code-line-num"></td><td class="code-line-content">    </td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;?php if (\$result !== false): ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        &lt;ul&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">            &lt;?php while (\$result = \$stmt-&gt;fetch(PDO::FETCH_ASSOC)): ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                &lt;li&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                    &lt;?php echo htmlspecialchars(\$result["name"], ENT_QUOTES, "UTF-8"); ?&gt;:</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                    &lt;?php echo htmlspecialchars(\$result["comment"], ENT_QUOTES, "UTF-8"); ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                    -&lt;?php echo htmlspecialchars(\$result["created_at"], ENT_QUOTES, "UTF-8"); ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">                &lt;/li&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">            &lt;?php endwhile; ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">        &lt;/ul&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;?php endif ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    &lt;?php</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$stmt = null;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    \$pdo = null;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">    ?&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;/body&gt;</td></tr>
                    <tr><td class="code-line-num"></td><td class="code-line-content">&lt;/html&gt;</td></tr>
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
