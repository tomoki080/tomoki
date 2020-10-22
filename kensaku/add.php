<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>完了</title>
    </head>
    <body>

        <?php

            try {

                $name = $_POST['name'];
                $level = $_POST['level'];
                $rate = $_POST['rate'];
                $play = $_POST['play'];
                $done = $_POST['done'];
                $voice = $_POST['voice'];

                $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'INSERT INTO player (name,level,rate,play,done,voice) VALUES (?,?,?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $data[] = $name;
                $data[] = $level;
                $data[] = $rate;
                $data[] = $play;
                $data[] = $done;
                $data[] = $voice;
                $stmt->execute($data);

                $dbh = null;

                echo $name;
                echo ' さんを追加しました。';

            } catch(Exception $e) {
                echo 'サーバーに障害が発生しています。';
                echo 'しばらくお待ちください。';
                exit();
            }

        ?>

        <a href="top.php">トップページに行く。</a>

    </body>
</html>