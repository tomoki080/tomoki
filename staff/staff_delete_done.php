<?php 
session_start();
session_regenerate_id(true);
if ( isset($_SESSION['login'])==false ) {
    echo 'ログインされていません。';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    echo $_SESSION['staff_name'];
    echo 'さんがログイン中';
    echo '<br />';
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>仏教農園</title>
	</head>
	<body>

	<?php

	try
	{
    
    $staff_code=$_POST['code'];

	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql='DELETE FROM mst_staff WHERE code=?';
	$stmt=$dbh->prepare($sql);
    $data[]=$staff_code;
	$stmt->execute($data);

	$dbh=null;

	}
	catch (Exception $e)
	{
		print 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}

	?>

    削除しました。<br />
    <br />
	<a href="staff_list.php">戻る</a>

	</body>
</html>