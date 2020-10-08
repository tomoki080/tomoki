<?php 
session_start();
session_regenerate_id(true);
if ( isset($_SESSION['member_login'])==false ) {
    echo 'ようこそゲスト様 ';
    echo '<a href="../member_login.html">会員ログイン</a>';
    echo '<br />';
} else {
    echo 'ようこそ';
    echo $_SESSION['member_name'];
    echo '様';
    echo '<a href="member_logout.php">ログアウト</a>';
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
    
    try {
        
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO( $dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        echo '商品一覧<br /><br />';

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false) {
                break;
            }

            echo '<a href="shop_product.php?procode='.$rec['code'].'">';
            echo $rec['name'].'---';
            echo $rec['price'].'円';
            echo '</a>';
            echo '<br />';
        }
        echo '<br />';
        echo '<a href="shop_cartlook.php">カートを見る</a><br />';

    } catch (Exception $e) {
        
        echo 'ただいま障害によりご迷惑をお掛けしております。';
        exit();
    }

    ?>

    

    </body>
</html>