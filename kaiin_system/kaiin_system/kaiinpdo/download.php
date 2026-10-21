<?php
//DB接続情報
$dbname = 'mysql:host=localhost;dbname=kaiin;charset=utf8';
$id = 'root';
$pw = '';

	try {
//DB取得処理
		$pdo = new PDO($dbname,$id,$pw,array(PDO::ATTR_EMULATE_PREPARES => false));
	}
	catch(PDOException $e){
		exit('データベース接続失敗。'.$e->getMessage());
	}

//SQL実行
		$sql = "SELECT * FROM `kaiin`";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

//CSV文字列生成
//CSV形式は「,」で次のセル「\r\n」で改行となる
		$csvstr = "id,ユーザーネーム,暗証番号,TEL\r\n";
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$csvstr .= $result['id'] . ",";
			$csvstr .= $result['name'] . ",";
			$csvstr .= $result['pass'] . ",";
			$csvstr .= $result['tel'] . ",";
			$csvstr .="\r\n";
		}

//CSV出力
		//ダウンロードファイル名作成
		$fileName = "data.csv";
		//ダウンロードファイル形式(MIMEタイプ)指定
		header('Content-Type: text/csv');
		//ダウンロードファイル名指定
		header('Content-Disposition: attachment; filename='.$fileName);
		//ダウンロードデータ出力
	//	echo $csvstr; //UTF8出力の場合こちらを使用
		echo mb_convert_encoding($csvstr, "SJIS", "UTF-8");// Shift-JISに変換したい場合のみ（excelはShift-JIS）
		$stmt=null;
		$pdo=null;

?>
