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
        <meta charset="uft-8">
        <title>天国農園</title>
    </head>
    <body>

        ショップ管理トップメニュー<br />
        <br />
        <a href="../staff/staff_list.php">スタッフ管理</a>
        <br />
        <a href="../product/pro_list.php">商品管理</a>
        <br />
        <a href="staff_logout.php">ログアウト</a>

    </body>
<html>