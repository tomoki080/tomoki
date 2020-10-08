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
        <title>やり直せ</title>
        <style type="text/css">
            <!-- a{font-size:30px;}  -->
        </style>
    </head>
    <body>

        <p style="font-size:50px;text-align:center;color:green;">スタッフ選んでないやろ？？？？？</P>
        <a href="staff_list.php">戻る</a>

    </body>
</html>