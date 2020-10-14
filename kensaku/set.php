<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ユーザー作成</title>
    </head>
    <body>

        <?php

        try {

            $table = $_POST['table'];
            
            $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $sql = 'INSERT INTO '.$table.'(name,level,rate,play,done,voice) VALUES (?,?,?,?,?,?)';
            $stmt = $dbh->prepare($sql);

            $namber = rand(0,9999);
            $math_p = rand(1,3);
            $math_d = rand(1,4);
            $math_v = rand(1,3);

            $data[] = "player$namber";
            $data[] = rand(0,999);
            $data[] = rand(0,5000);

            switch ($math_p) {
                case 1:
                    $data[] = "両方";
                    break;
                case 2:
                    $data[] = "楽しく";
                    break;
                case 3:
                    $data[] = "本気";
                    break;
            }
            switch ($math_d) {
                case 1:
                    $data[] = '前衛で戦う';
                    break;
                case 2:
                    $data[] = '後衛でサポート';
                    break;
                case 3:
                    $data[] = '自由に動き回る';
                    break;
                case 4:
                    $data[] = '指示に従う';
                    break;
            }
            switch ($math_v) {
                case 1:
                    $data[] = "YES";
                    break;
                case 2:
                    $data[] = "NO";
                    break;
                case 3:
                    $data[] = "BOTH";
                    break;
            }

            $stmt->execute($data);

            $dbh = null;

            echo 'ユーザーの作成が完了しました。<br />';
            echo '<a href="top.html">トップメニューへ</a><br />';
            echo 'この画面で、F5でリロードしてください。<br />';
            echo 'その際、フォームの再送信もしてください。<br />';
            echo 'PHPでリロードをするとエラーになってしまいます。<br />';
            echo '手間がかかるとは思いますが、ご容赦ください。<br />';
            echo 'リロードした回数だけプレイヤーが増えます。<br />';



        } catch ( Exception $e ) {
            echo 'サーバーにエラーが生じています。<br />';
            echo '以下のエラーメッセージを表示します。';
            echo $e;
            exit();
        }

        ?>

    </body>
</html>