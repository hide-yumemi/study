<?php
$flag = 0;
if ($_SERVER['REQUEST_METHOD'] !== 'POST'):
	$flag++;
endif;
if (!(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['tel']))):
	$flag++;
endif;
if ($flag !== 0):
	exit("正しくアクセスしてください");
endif;

$dbname = 'mysql:host=localhost;dbname=kaiin;charset=utf8';
$id = 'root';
$pw = '';

try {
	$pdo = new PDO($dbname, $id, $pw, array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
	exit('データベース接続失敗。' . $e->getMessage());
}

$errors = array();

if (preg_match("/^[a-zA-Z0-9]{2,20}$/", $_POST['name'])):
	$sql = 'SELECT COUNT(*) FROM `kaiin` WHERE `name`=:name';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $_POST["name"]);
	$stmt->execute();
	$count = $stmt->fetchColumn();
	if ($count): //１件あれば登録済み
		$errors["name"] = "このユーザーネームは登録済です";
	else:
		$name = $_POST["name"];
	endif;
	$stmt = null;
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
	$sql = 'INSERT INTO `kaiin` (`name`,`pass`,`tel`) VALUES (:name,:pass,:tel)';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':pass', $pass);
	$stmt->bindParam(':tel', $tel);
	$stmt->execute();
	$stmt = null;
endif;
$pdo = null;
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
