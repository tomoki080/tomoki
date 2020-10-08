<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>承認準備</title>
    </head>
    <body>

        <?php

            $name = $_POST['name'];
            $level = $_POST['level'];
            $rate = $_POST['rate'];
            $play = $_POST['play'];
            $done = $_POST['done'];
            $voice = $_POST['voice'];

            if ( $name == '' ) {
                echo '<p style="color:red;">プレイヤーネームを入力してください。</p><br />';
            } else {
                echo 'プレイヤーネーム<br />';
                echo $name;
                echo '<br />';
            }

            if ( preg_match('/\A[0-9]+\z/',$level)==0 ) {
                echo '<p style="color:red;">プレイヤーレベルを正しく入力してください。</p><br />';
            } else {
                echo 'プレイヤーレベル<br />';
                echo $level;
                echo '<br />';
            }

            if ( preg_match('/\A[0-9]+\z/',$rate)==0 || 5000 < $rate ) {
                echo '<p style="color:red;">ランクレートを正しく入力してください。</p><br />';
            } else {
                echo 'ランクレート<br />';
                echo $rate;
                echo '<br />';
            }
            
            echo $play .'<br />';
            echo $done . '<br />';
            echo $voice . '<br />';
            
            
            if ( $name == '' || preg_match('/\A[0-9]+\z/',$level)==0 || preg_match('/\A[0-9]+\z/',$rate)==0 || 5000 < $rate ) {
                echo '<form>';
                echo '<input type="button" onclick="history.back()" value="戻る">';
                echo '</form>';
            } else {
                echo '上記の内容で確定しますか？';
                echo '<form method="post" action="add.php">';
                echo '<input type="hidden" name="name" value="'.$name.'">';
                echo '<input type="hidden" name="level" value="'.$level.'">';
                echo '<input type="hidden" name="rate" value="'.$rate.'">';
                echo '<input type="hidden" name="play" value="'.$play.'">';
                echo '<input type="hidden" name="done" value="'.$done.'">';
                echo '<input type="hidden" name="voice" value="'.$voice.'">';
                echo '<br />';
                echo '<input type="button" onclick="history.back()" value="戻る">';
                echo '<input type="submit" value="確定">';
            }

        ?>

    </body>
</html>