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
    }

    #scoreArea {
      display: flex;
      gap: 15px;
    }

    #startButton {
      margin-top: 10px;
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include 'header.php'; ?>
  <div class="container">
    <main class="main-content">


      <h1>スカッシュ</h1>

      <div id="scoreArea">
        <p>残機</p>
        <p id="lives">2</p> <!-- 残機-->
        <p>得点</p>
        <p id="score">0</p>
      </div>

      <div id="waku">
        <!-- お好みのサイズ（例: 600x500）に広げても自動対応します -->
        <canvas id="gameCanvas" width="600" height="500"></canvas>
      </div>

      <button id="startButton">ゲーム開始</button>

      <script>
        //1.パーツの準備
        const canvas = document.getElementById("gameCanvas");
        const ctx = canvas.getContext("2d");

        //2.ゲーム内変数の準備
        let score = 0;
        let lives = 3; // ➕ 残機の初期値を設定

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

        // ➕ ボールとバーの位置を最初の状態（真ん中）に戻す関数
        function resetBallAndPaddle() {
          ball_x = canvas.width / 2;
          ball_y = canvas.height / 2;
          // スピードが上がりすぎていた場合を考慮し、初期スピード（向きは上）に戻す
          ball_dx = 2;
          ball_dy = -2;
          paddle_x = (canvas.width - paddle_width) / 2;
        }

        //3.最初の静止状態の描画 
        ctx.fillStyle = "black";
        ctx.fillRect(paddle_x, paddle_y, paddle_width, paddle_height);
        ctx.beginPath();
        ctx.fillStyle = "white";
        ctx.arc(ball_x, ball_y, ball_radius, 0, Math.PI * 2);
        ctx.fill();

        //4.ゲームループ関数
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
            // ❌ 画面の底に落ちたときの判定（残機機能つきに修正）
            else if (ball_y + ball_dy > canvas.height - ball_radius) {
              lives--; // 残機を1減らす
              document.getElementById("lives").textContent = lives; // 画面の残機表示を更新

              if (lives > 0) {
                // 💡 まだ残機があるなら、位置だけ戻してそのまま続行
                resetBallAndPaddle();
              } else {
                // 💡 残機が0になったら本当のゲームオーバー
                clearInterval(interval);
                alert("GAME OVER");
                document.location.reload();
              }
            }
          }
        }

        //5.マウス操作のイベント設定
        document.addEventListener("mousemove", mouseMoveHandler);

        function mouseMoveHandler(e) {
          const rect = canvas.getBoundingClientRect();
          const relativeX = e.clientX - rect.left;
          if (relativeX > 0 && relativeX < canvas.width) {
            paddle_x = relativeX - paddle_width / 2;
          }
        }

        //6.キーボード操作のイベント設定
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

        //7.開始ボタンのクリックイベント設定 
        document.getElementById("startButton").addEventListener("click", function() {
          if (interval) {
            clearInterval(interval);
          }
          // もし一度ゲームオーバーになった後に再度初期化する場合を考慮
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
    </main>
    <?php include 'history.php'; ?>
  </div>

  <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>