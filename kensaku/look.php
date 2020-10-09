<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>検索実行</title>
    </head>
    <body>

        <?php

            try {

                $voice = $_POST['voice'];
                $level = $_POST['level'];
                $rate = $_POST['rate'];

                if ( $level == "" ) {
                    $level = null;
                } 
                    
                if ( $rate == "" ) {
                    $rate = null;
                }

                if ( isset($_POST['play']) && is_array($_POST['play']) ) {
                    $play1 = $_POST['play'];//この変数は配列
                } elseif (isset($_POST['play'])) {
                    $paly1 = $_POST['play'];
                } else {
                    $play1 = null;
                }
                
                if ( isset($_POST['done']) && is_array($_POST['done']) ) {
                    $done1 = $_POST['done'];//この変数は配列
                } elseif ( isset($_POST['done']) ) {
                    $done1 = $_POST['done'];
                } else {
                    $done1 = null;
                }

                $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT * FROM player WHERE ';
                if( isset($level)) {
                    if ( $level < 100 ) {
                        $levelmin = 0;
                        $levelmax = $level + 100;
                    } elseif ( 899 < $level ) {
                        $levelmin = $level - 100;
                        $levelmax = 999;
                    } else {
                        $levelmin = $level - 100;
                        $levelmax = $level + 100;
                    }
                    $sql .= "level BETWEEN {$levelmin} AND {$levelmax} ";
                }
                if ( isset($rate)) {
                    if ( $rate < 500 ) {
                        $ratemin = 0;
                        $ratemax = $rate + 500;
                    } elseif ( 4499 < $level ) {
                        $ratemin = $rate - 500;
                        $ratemax = 5000;
                    } else {
                        $ratemin = $rate - 500;
                        $ratemax = $rate + 500;
                    }
                    $sql .= "AND rate BETWEEN {$ratemin} AND {$ratemax} ";
                }
                if( isset($play1) ) {
                    $sql .= "AND play IN (";
                    foreach( $play1 as $key=>$value ) {
                        $sql .= "$value";
                        $sql .= isset($play1[$key + 1]) ? ",":"";//if(isset($play1[$key+1]) ? ",":;)
                    }
                    $sql .= ")";
                }
                if( isset($done1)) {
                    $sql .= "AND done IN (";
                    foreach( $done1 as $key=>$value ) {
                        $sql .= "$value";
                        $sql .= isset($done1[$key + 1]) ? ",":"";//if(isset($done1[$key+1]) ? ",":;)
                    }
                    $sql .= ")";
                }
                if ( $voice == "BOTH" ) {
                    if ( $level == null && $rate == null && $play1 == null && $done1 == null ) {
                        $sql .= "voice IN ('YES', 'NO') ";
                    } else {
                        $sql .= "AND voice IN ('YES', 'NO')";
                    }    
                } else {
                    if ( $level == null && $rate == null && $play1 == null && $done1 == null ) {
                        $sql .= "voice = {$voice}";
                    } else {
                        $sql .= "AND voice = {$voice}";
                    }
                }
                
                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                $dbh = null;

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

        ?>

    </body>
</html>