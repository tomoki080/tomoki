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
        <title>天国農園</title>
    </head>
    <body>

    <?php

    $pro_code = $_GET['procode'];

    try {
        $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO( $dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name,gazou FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_gazou_name = $rec['gazou'];

        $dbh = null;

        if ( $pro_gazou_name == '' ) {
            $disp_gazou = '';
        } else {
            $disp_gazou = '<img src="./gazou/'.$pro_gazou_name.'">';
        }

    } catch (Exception $e) {
        echo 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

    商品削除<br />
    <br />
    商品コード<br />
    <?php echo $pro_code; ?>
    <br />
    <br />
    商品名<br />
    <?php echo $pro_name; ?>
    <br />
    <?php echo $disp_gazou; ?>
    <br />
    この商品を削除してもよろしいですか？<br />
    <form method="post" action="pro_delete_done.php">
    <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="gazou_name" value="<?php echo $pro_gazou_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form> 

    </body>
</html>