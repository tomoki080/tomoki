<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ユーザー作成</title>
    </head>
    <body>

        <?php

        try {

            if ( isset($_GET['table']) ) {
                $table = $_GET['table'];
            }
            
            $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'DROP TABLE IF EXISTS '.$table;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            echo $table;
            echo 'テーブルの削除が完了しました。<br />';
            echo '<a href="create_table.php">新しいテーブルを作成する。</a>';

            
        } catch ( Exception $e ) {
            echo 'サーバーにエラーが生じています。<br />';
            echo '以下のエラーメッセージを表示します。';
            echo $e;
            exit();
        }

        ?>

    </body>
</html>