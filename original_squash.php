<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ここでは職業訓練にて最低限のhtml/CSSの授業とjavascriptをメインとした授業一覧のぺージです。実際の授業の内容を私的にまとめた物と動作チェックを含めたソースコードをそのまま載せてます。">
    <title>オリジナルスカッシュ | ポートフォリオサイト</title>
    <link rel="stylesheet" href="style.css">

    <style>
        #gameCanvas {
            border: 2px solid black;
            background-color: gray;
            display: block;
            margin: 0 auto;
        }

        #scoreArea {
            display: flex;
            gap: 15px;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        #waku {
            text-align: center;
            margin-bottom: 15px;
        }

        #startButton {
            display: block;
            margin: 10px auto 0;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

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
            white-space: pre-wrap;
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
        <main class="main-content">

            <h1>スカッシュ</h1>

            <div id="scoreArea">
                <p>残機 : <span id="lives">3</span></p>
                <p>得点 : <span id="score">0</span></p>
            </div>

            <div id="waku">
                <canvas id="gameCanvas" width="600" height="500"></canvas>
            </div>

            <button id="startButton">ゲーム開始</button>

            <script>
                // 1.パーツの準備
                const canvas = document.getElementById("gameCanvas");
                const ctx = canvas.getContext("2d");

                // 2.ゲーム内変数の準備
                let score = 0;
                let lives = 3;

                let paddle_width = 100;
                let paddle_height = 15;
                let paddle_x = (canvas.width - paddle_width) / 2;
                let paddle_y = canvas.height - 50;

                let ball_x = canvas.width / 2;
                let ball_y = canvas.height / 2;
                let ball_radius = 10;

                let ball_dx = 2;
                let ball_dy = -2;
                let interval;

                let rightPressed = false;
                let leftPressed = false;

                function resetBallAndPaddle() {
                    ball_x = canvas.width / 2;
                    ball_y = canvas.height / 2;
                    ball_dx = 2;
                    ball_dy = -2;
                    paddle_x = (canvas.width - paddle_width) / 2;
                }

                // 3.最初の静止状態の描画 
                ctx.fillStyle = "black";
                ctx.fillRect(paddle_x, paddle_y, paddle_width, paddle_height);
                ctx.beginPath();
                ctx.fillStyle = "white";
                ctx.arc(ball_x, ball_y, ball_radius, 0, Math.PI * 2);
                ctx.fill();

                // 4.ゲームループ関数
                function draw() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    if (rightPressed) {
                        paddle_x += 7;
                        if (paddle_x + paddle_width > canvas.width) {
                            paddle_x = canvas.width - paddle_width;
                        }
                    } else if (leftPressed) {
                        paddle_x -= 7;
                        if (paddle_x < 0) {
                            paddle_x = 0;
                        }
                    }

                    // バーの描画
                    ctx.fillStyle = "black";
                    ctx.fillRect(paddle_x, paddle_y, paddle_width, paddle_height);

                    // ボールの描画
                    ctx.beginPath();
                    ctx.fillStyle = "white";
                    ctx.arc(ball_x, ball_y, ball_radius, 0, Math.PI * 2);
                    ctx.fill();

                    ball_x += ball_dx;
                    ball_y += ball_dy;

                    // 左右の壁の跳ね返り
                    if (ball_x + ball_dx > canvas.width - ball_radius || ball_x + ball_dx < ball_radius) {
                        ball_dx = -ball_dx;
                    }

                    // 天井の跳ね返り
                    if (ball_y + ball_dy < ball_radius) {
                        ball_dy = -ball_dy;
                    }
                    // バーの高さに到達したときの判定
                    else if (ball_y + ball_dy > paddle_y - ball_radius) {
                        if (ball_x > paddle_x && ball_x < paddle_x + paddle_width) {
                            ball_dy = -ball_dy;
                            score = score + 5;

                            if (score % 25 === 0) {
                                ball_dx *= 1.3;
                                ball_dy *= 1.3;
                            }
                            document.getElementById("score").textContent = score;
                        }
                        // 画面の底に落ちたときの判定
                        else if (ball_y + ball_dy > canvas.height - ball_radius) {
                            lives--;
                            document.getElementById("lives").textContent = lives;

                            if (lives > 0) {
                                resetBallAndPaddle();
                            } else {
                                clearInterval(interval);
                                alert("GAME OVER");
                                document.location.reload();
                            }
                        }
                    }
                }

                // 5.マウス操作のイベント設定
                document.addEventListener("mousemove", mouseMoveHandler);

                function mouseMoveHandler(e) {
                    const rect = canvas.getBoundingClientRect();
                    const relativeX = e.clientX - rect.left;
                    if (relativeX > 0 && relativeX < canvas.width) {
                        paddle_x = relativeX - paddle_width / 2;
                    }
                }

                // 6.キーボード操作のイベント設定
                document.addEventListener("keydown", keyDownHandler);
                document.addEventListener("keyup", keyUpHandler);

                function keyDownHandler(e) {
                    if (e.key === "Right" || e.key === "ArrowRight") {
                        rightPressed = true;
                    } else if (e.key === "Left" || e.key === "ArrowLeft") {
                        leftPressed = true;
                    }
                }

                function keyUpHandler(e) {
                    if (e.key === "Right" || e.key === "ArrowRight") {
                        rightPressed = false;
                    } else if (e.key === "Left" || e.key === "ArrowLeft") {
                        leftPressed = false;
                    }
                }

                // 7.開始ボタンのクリックイベント設定 
                document.getElementById("startButton").addEventListener("click", function() {
                    if (interval) {
                        clearInterval(interval);
                    }
                    if (lives <= 0) {
                        lives = 3;
                        score = 0;
                        document.getElementById("lives").textContent = lives;
                        document.getElementById("score").textContent = score;
                        resetBallAndPaddle();
                    }
                    interval = setInterval(draw, 10);
                });
            </script>

            <hr>

            <!-- 生コード確認エリア（コメントも緑色に装飾して再現） -->
            <div class="code-viewer-container">
                <table class="code-viewer-table">
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 1.パーツの準備</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">const canvas = document.getElementById("gameCanvas");</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">const ctx = canvas.getContext("2d");</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 2.ゲーム内変数の準備</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let score = 0;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let lives = 3; </td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let paddle_width = 100;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let paddle_height = 15;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let paddle_x = (canvas.width - paddle_width) / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let paddle_y = canvas.height - 50;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let ball_x = canvas.width / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let ball_y = canvas.height / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let ball_radius = 10;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let ball_dx = 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let ball_dy = -2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let interval;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let rightPressed = false;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">let leftPressed = false;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">function resetBallAndPaddle() {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_x = canvas.width / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_y = canvas.height / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dx = 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dy = -2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> paddle_x = (canvas.width - paddle_width) / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">}</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 3.最初の静止状態の描画 </span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">ctx.fillStyle = "black";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">ctx.fillRect(paddle_x, paddle_y, paddle_width, paddle_height);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">ctx.beginPath();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">ctx.fillStyle = "white";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">ctx.arc(ball_x, ball_y, ball_radius, 0, Math.PI * 2);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">ctx.fill();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 4.ゲームループ関数</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">function draw() {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.clearRect(0, 0, canvas.width, canvas.height);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (rightPressed) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> paddle_x += 7;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (paddle_x + paddle_width &gt; canvas.width) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> paddle_x = canvas.width - paddle_width;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> } else if (leftPressed) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> paddle_x -= 7;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (paddle_x &lt; 0) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> paddle_x = 0;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
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
                        <td class="code-line-content"> <span class="code-comment">// バーの描画</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.fillStyle = "black";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.fillRect(paddle_x, paddle_y, paddle_width, paddle_height);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> <span class="code-comment">// ボールの描画</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.beginPath();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.fillStyle = "white";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.arc(ball_x, ball_y, ball_radius, 0, Math.PI * 2);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ctx.fill();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_x += ball_dx;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_y += ball_dy;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> <span class="code-comment">// 左右の壁の跳ね返り</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (ball_x + ball_dx &gt; canvas.width - ball_radius || ball_x + ball_dx &lt; ball_radius) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dx = -ball_dx;</td>
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
                        <td class="code-line-content"> <span class="code-comment">// 天井の跳ね返り</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (ball_y + ball_dy &lt; ball_radius) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dy = -ball_dy;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> <span class="code-comment">// バーの高さに到達したときの判定</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (ball_y + ball_dy &gt; paddle_y - ball_radius) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (ball_x &gt; paddle_x &amp;&amp; ball_x &lt; paddle_x + paddle_width) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dy = -ball_dy;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> score = score + 5;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (score % 25 === 0) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dx *= 1.3;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> ball_dy *= 1.3;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> document.getElementById("score").textContent = score;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> <span class="code-comment">// 画面の底に落ちたときの判定</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (ball_y + ball_dy &gt; canvas.height - ball_radius) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> lives--; </td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> document.getElementById("lives").textContent = lives; </td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (lives &gt; 0) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> resetBallAndPaddle();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> } else {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> clearInterval(interval);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> alert("GAME OVER");</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> document.location.reload();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">}</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 5.マウス操作のイベント設定</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">document.addEventListener("mousemove", mouseMoveHandler);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">function mouseMoveHandler(e) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> const rect = canvas.getBoundingClientRect();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> const relativeX = e.clientX - rect.left;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (relativeX &gt; 0 &amp;&amp; relativeX &lt; canvas.width) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> paddle_x = relativeX - paddle_width / 2;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">}</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 6.キーボード操作のイベント設定</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">document.addEventListener("keydown", keyDownHandler);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">document.addEventListener("keyup", keyUpHandler);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">function keyDownHandler(e) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (e.key === "Right" || e.key === "ArrowRight") {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> rightPressed = true;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> } else if (e.key === "Left" || e.key === "ArrowLeft") {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> leftPressed = true;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">}</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">function keyUpHandler(e) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (e.key === "Right" || e.key === "ArrowRight") {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> rightPressed = false;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> } else if (e.key === "Left" || e.key === "ArrowLeft") {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> leftPressed = false;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">}</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"><span class="code-comment">// 7.開始ボタンのクリックイベント設定</span></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">document.getElementById("startButton").addEventListener("click", function() {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (interval) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> clearInterval(interval);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (lives &lt;= 0) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> lives = 3;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> score = 0;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> document.getElementById("lives").textContent = lives;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> document.getElementById("score").textContent = score;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> resetBallAndPaddle();</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> interval = setInterval(draw, 10);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">});</td>
                    </tr>
                </table>
            </div>

        </main>
    </div>

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>