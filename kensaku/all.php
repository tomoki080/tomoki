<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>プレイヤー一覧</title>
    </head>
    <body>

        <?php

            try {

                $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT * FROM player WHERE 1';
                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                $dbh = null;

                echo 'プレイヤー一覧<br /><br />';
                echo '<table border="1" width="1000px">';
                echo '<tr align="center">';
                echo '<td>プレイヤーネーム</td>';
                echo '<td>レベル</td>';
                echo '<td>レート</td>';
                echo '<td>プレイタイプ</td>';
                echo '<td>行動タイプ</td>';
                echo '<td>ボイスチャット</td>';
                echo '</tr>';
                while (true) {
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($rec==false) {
                        break;
                    }
                    echo '<tr align="center">';
                    echo '<td>'.$rec['name'].'</td>';
                    echo '<td>'.$rec['level'].'</td>';
                    echo '<td>'.$rec['rate'].'</td>';
                    echo '<td>'.$rec['play'].'</td>';
                    echo '<td>'.$rec['done'].'</td>';
                    echo '<td>'.$rec['voice'].'</td>';
                    echo '<tr>';
                }
                echo '</table>';
               
            } catch(Exception $e) {
                echo 'サーバーに障害が発生しています。';
                echo 'しばらくお待ちください。';
                exit();
            }

            echo '<a href="top.html">トップページへ</a>';

        ?>

    </body>
</html>