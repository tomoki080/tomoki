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

                if ( isset($_POST['play']) ) {
                    $play = $_POST['play'];
                } else {
                    $play = null;
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
                    if ( $level == null ) {
                        $sql .= "rate BETWEEN {$ratemin} AND {$ratemax} ";
                    } else {
                        $sql .= "AND rate BETWEEN {$ratemin} AND {$ratemax} ";
                    }
                }
                if( $play == "両方" ) {
                    if ( $level == null && $rate == null ) {
                        $sql .= "play IN ('楽しく', '本気', '両方') ";
                    } else {
                        $sql .= "AND play IN ('楽しく', '本気', '両方') ";
                    }
                } else {
                    if ( $level == null && $rate == null ) {
                        $sql .= "play = '{$play}' ";
                    } else {
                        $sql .= "AND play = '{$play}' ";
                    }
                }
                if( isset($done1)) {
                    $sql .= "AND done IN ("; //条件分岐なし
                    foreach($done1 as $key=>$value) {
                        $sql .= "'{$value}'";// 二重で囲むと解決した(なんで)
                        $sql .= isset($done1[$key + 1]) ? ",":"";//if(isset($done1[$key+1]) ? ",":;)
                    }
                    $sql .= ")";
                }
                if ( $voice == "BOTH" ) {
                    if ( $level == null && $rate == null && $play == null && $done1 == null ) {
                        $sql .= "voice IN ('YES', 'NO') ";
                    } else {
                        $sql .= "AND voice IN ('YES' , 'NO') ";
                    }    
                } else {
                    if ( $level == null && $rate == null && $play == null && $done1 == null ) {
                        $sql .= "voice = '{$voice}' ";
                    } else {
                        $sql .= "AND voice = '{$voice}' ";
                    }
                }
                
                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                $dbh = null;

                
                $show_data = array();
                while ( $rec = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                    $show_data[] = $rec;
                }
                if ( empty($show_data) ) {
                    echo '該当するプレイヤーは存在しません。';
                } else {
                    echo '<table border="1" width="1000px">';
                    echo '<tr align="center">';
                    echo '<td>プレイヤーネーム</td>';
                    echo '<td>レベル</td>';
                    echo '<td>レート</td>';
                    echo '<td>プレイタイプ</td>';
                    echo '<td>行動タイプ</td>';
                    echo '<td>ボイスチャット</td>';
                    echo '</tr>';
                    foreach( $show_data as $vl_array ) {
                        $cut = array_slice($vl_array,1); //codeカラムをカット
                        echo '<tr align="center">';
                        foreach ( $cut as $value ) {
                            echo '<td>';
                            echo $value;
                            echo '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                }     
                  

                // 代替案
                $show_data = array();
                while( $rec = $stmt->fetch(PDO::FETCH_ASSOC) )$show_data[] = $rec;
                if(empty($show_data)){
                  echo '該当するプレイヤーは存在しません';
                }else{
                  echo '<table border="1" width="1000px">';
                  echo '<tr align="center">';
                  echo '<td>プレイヤーネーム</td>';
                  echo '<td>レベル</td>';
                  echo '<td>レート</td>';
                  echo '<td>プレイタイプ</td>';
                  echo '<td>行動タイプ</td>';
                  echo '<td>ボイスチャット</td>';
                  echo '</tr>';
                  foreach($show_data as $assoc_array){
                    echo '<tr>';
                    foreach($assoc_array as $v){
                      echo '<td>';
                      echo $v;
                      echo '</td>';
                    }
                    echo '</tr>';
                  }
                  echo '</table>';
                }

            } catch(Exception $e) {
                echo 'サーバーに障害が発生しています。';
                echo 'しばらくお待ちください。';
                echo $e;
                exit();
            }

        ?>

    </body>
</html>