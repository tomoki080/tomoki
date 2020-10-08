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
        <title>地獄農園</title>
    </head>
    <body>

    <?php 
    
    try {
        
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO( $dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT code,name FROM mst_staff WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        echo 'スタッフ一覧<br /><br />';

        echo '<form method="post" action="staff_branch.php">';
        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false) {
                break;
            }
            echo '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
            echo $rec['name'];
            echo '<br />';
        }
        echo '<input type="submit" name="disp" value="参照">';
        echo '<input type="submit" name="add" value="追加">';
        echo '<input type="submit" name="edit" value="修正">';
        echo '<input type="submit" name="delete" value="削除">';
        echo '</form>';
    }

    catch (Exception $e) {
        
        echo 'ただいま障害によりご迷惑をお掛けしております。';
        exit();
    }

    ?>

    <a href="../staff_login/staff_top.php">トップメニューへ</a><br />

    </body>
</html>