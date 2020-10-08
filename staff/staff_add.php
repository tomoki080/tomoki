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
        <meta charset = "utf-8">
        <title>天国農園</title>
    </head>
    <body>
        <form method="post" action="staff_add_check.php">
            スタッフを追加<br />
            <br />
            スタッフ名を入力してください。<br />
            <input type="text" name="name" style="width:200px"><br />
            パスワードを入力してください。<br />
            <input type="password" name="pass" style="width:100px"><br />
            パスワードをもう一度入力してください。<br />
            <input type="password" name="pass2" style="width:100px"><br />
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK" style="font-size:17px">
        </form>
    </body>
</html>