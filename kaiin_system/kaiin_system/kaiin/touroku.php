<?php
$flag = 0; //エラーカウント
if ($_SERVER['REQUEST_METHOD'] !== 'POST'):
	$flag++;
endif;
if (!(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['tel']))):
	$flag++;
endif;
if ($flag !== 0):
	exit("正しくアクセスしてください");
endif;

$link = mysqli_connect("localhost", "root", "");
if (!$link):
	exit("データベースに接続できません" . mysqli_connect_error());
endif;

mysqli_select_db($link, "kaiin");
mysqli_set_charset($link, "utf8");

$errors = array();
//正規表現による入力チェック
if (preg_match("/^[a-zA-Z0-9]{2,20}$/", $_POST['name'])):
	//ユニークなnameカラムを一致条件とした取得
	//ユーザーの入力値を使用するのでプリペアドステートメントで実行
	$stmt = mysqli_prepare($link, "SELECT `name` FROM `kaiin` WHERE `name`=?");
	mysqli_stmt_bind_param($stmt, 's', $_POST['name']);
	$result = mysqli_stmt_execute($stmt);
	if (!$result):
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		exit("サーバーエラー");
	endif;
	//プリペアドステートメントを使用したmysqliのSELECT結果取得
	//phpからSELECT結果をfetchで取れるようにする
	//mysqli_stmt_store_result($stmt);

	//fetchを行ったときにデータを受け取る変数を指定する
	//第１にプリペアドステートメント変数、第２以降にカラム順に受け取る変数
	//今回のテーブルで SELECT * FROM `kaiin` だった場合
	//mysqli_stmt_bind_result($stmt,$id,$name,$pass,$tel);
	//で`id`が$id、`name`が$name、`pass`が$pass、`tel`が$telに代入される

	//受け取る変数を指定後にfetch命令で１行ずつ取り出す
	//mysqli_stmt_fetch($stmt);

	//取得した行数の確認
	//mysqli_stmt_num_rows($stmt)

	mysqli_stmt_store_result($stmt);
	//１件あればnameカラムに同一name登録済み
	if (mysqli_stmt_num_rows($stmt) != 0):
		$errors["name"] = "同じ名前が既に存在します";
	endif;
	mysqli_stmt_close($stmt);
	$name = $_POST["name"];
else:
	$errors[] = "ユーザーネームを正しく入力して下さい";
endif;

if (preg_match("/^[a-zA-Z0-9]{6,12}$/", $_POST['pass'])):
	$pass = $_POST['pass'];
else:
	$errors[] = "パスワードを正しく入力して下さい";
endif;

if (preg_match("/^0[1-9][0-9]{8,9}$/", $_POST["tel"])):
	$tel = $_POST["tel"];
else:
	$errors["tel"] = "TELを正しく入力してください";
endif;

if (count($errors) === 0):
	$stmt = mysqli_prepare($link, 'INSERT INTO `kaiin` (`name`,`pass`,`tel`) VALUES (?,?,?)');
	mysqli_stmt_bind_param($stmt, 'sss', $name, $pass, $tel);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
endif;
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>登録</title>
</head>

<body>
	<?php if (count($errors)): ?>
		<ul class="error_list">
			<?php foreach ($errors as $error): ?>
				<li>
					<?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?>
				</li>
			<?php endforeach; ?>
			<li><a href="kaiinntouroku.html">登録画面に戻る</a></li>
		</ul>
	<?php else: ?>
		<p>登録完了しました</p>
	<?php endif; ?>
</body>

</html>