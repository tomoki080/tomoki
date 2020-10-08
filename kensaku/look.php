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

                if ( isset($_POST['level']) ) {
                    $level = $_POST['level'];
                }

                if ( isset($_POST['rate']) ) {
                    $rate = $_POST['rate'];
                }

                if ( isset($_POST['play']) || is_array($_POST['play']) ) {
                    $play1 = $_POST['play'];//この変数は配列
                } else {
                    $play = '';
                }
                
                if ( isset($_POST['done']) || is_array($_POST['done']) ) {
                    $done1 = $_POST['done'];//この変数は配列
                } else {
                    $done = '';
                }

                function levelRange($int,$min,$max,$math) {
                    if ( $math<100 ) {
                        $min = 0;
                        $max = $math + 100;
                        return ( $min<$int && $int<$max );
                    } elseif ( 899<$math ) {
                        $max = 999;
                        $min = $math - 100;
                        return ( $min<$int && $int<$max );
                    } else {
                        $min = $math - 100;
                        $max = $math + 100;
                        return ( $min<$int && $int<$max );
                    }
                }
                function rateRange($int,$min,$max,$math) {
                    if ( $math<500 ) {
                        $min = 0;
                        $max = $math + 500;
                        return ( $min<$int && $int<$max );
                    } elseif ( 4500<$math ) {
                        $max = 5000;
                        $min = $math - 500;
                        return ( $min<$int && $int<$max );
                    } else {
                        $min = $math - 500;
                        $max = $math + 500;
                        return ( $min<$int && $int<$max );
                    }
                }
                


                







                $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT * FROM player WHERE';
                if($level){
                    $sql += "level = {$level}";
                }
                if($rate){
                    $sql += "rate = {$rate}";
                }
                if($done) {
                    $sql += "done IN (";
                    foreach( $done as $key=>$value ) {
                        $sql += "$value";
                        $sql += isset($done[$key + 1]) ? ",":"";//if(isset($done[$key+1]) ? ",":;)
                    }
                    $sql += ")";
                }
                




                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                $dbh = null;

                while (true) {
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($rec==false) {
                        break;
                    }
                    if ( in_array($rec['play'],$play1) ) {
                        echo $rec['play'];
                    }
                    if ( in_array($rec['done'],$done1) ) {
                        echo $rec['done'];
                    }
                    if ( in_array($rec['play'],$play1) && in_array($rec['done'],$done1) ) {
                        echo $rec['name'];
                        echo $rec['level'];
                        echo $rec['rate'];
                        echo $rec['play'];
                        echo $rec['done'];
                        echo $rec['voice'];
                    }


                }
               
            } catch(Exception $e) {
                echo 'サーバーに障害が発生しています。';
                echo 'しばらくお待ちください。';
                exit();
            }

        ?>

    </body>
</html>