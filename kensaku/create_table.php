<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>テーブル作成</title>
    </head>
    <body>

        <form method="post" action="create_table.php">
            <p>テーブルの作成を行います。</p>
            <input type="text" name="name" pattern="^[0-9A-Za-z]+$">
            <input type="submit" value="作成">
        </form>

        <?php 

        try {

            if ( isset($_POST['name']) ) {

                $table = $_POST['name'];

                $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'CREATE TABLE '.$table. '(
                    code INT(11) AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(10) NOT NULL,
                    level INT(3) NOT NULL,
                    rate INT(4) NOT NULL,
                    play VARCHAR(3) NOT NULL,
                    done VARCHAR(8) NOT NULL,
                    voice VARCHAR(4) NOT NULL
                ) engine=innodb default charset=utf8 collate=utf8_unicode_ci';

                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                $dbh = null;
                    
                if ( $stmt ) {
                    echo 'テーブルの作成が完了しました。<br />';
                    echo 'テーブル名:'.$table.'<br /><br />';
                    echo '<form method="post" action="set.php">';
                    echo '<input type="hidden" name="table" value="'.$table.'">';
                    echo '<input type="submit" value="次へ">';
                    echo '</form>';
                }    

            }



        } catch (Exception $e) {
            echo 'サーバーにエラーが生じています。<br />';
            echo '以下のエラーメッセージを表示します。';
            echo $e;
            exit();
        }

        ?>

    </body>
</html>