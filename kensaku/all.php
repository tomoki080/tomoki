<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>プレイヤー一覧</title>
    </head>
    <body>

        <?php

            try {

                $table = $_GET['table'];
                
                $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT * FROM '.$table.' WHERE 1';
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
                $show_data[] = array();
                while ( $rec = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    $show_data[] = $rec;
                }    
                foreach ( $show_data as $vl_array ) {
                    $cut = array_slice($vl_array,1);
                    echo '<tr align="center">';
                    foreach ( $cut as $value ) {
                        echo '<td>';
                        echo $value;
                        echo '</td>';
                    }
                    echo '</tr>';
                }   
                echo '</table>';
               
            } catch(Exception $e) {
                echo 'サーバーに障害が発生しています。';
                echo 'しばらくお待ちください。';
                exit();
            }
            
            echo '<br />';
            echo '<a href="top.php?table='.$table.'">トップページへ</a>';

        ?>

    </body>
</html>