<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>天国農園</title>
    </head>
    <body>

        <?php

        $gakunen = $_POST['gakunen'];

        switch($gakunen) {
            
            case'1':
                $kousha = 'あなたの校舎は南校舎です。';
                break;
            case'2':
                $kousha = 'あなたの校舎は東校舎です。';
                break;
            case'3':
                $kousha = 'あなたの校舎は北校舎です。';
                break;
            default:
                $kousha = 'あなたの校舎はありません。';
                break;
        }

        echo '校舎  '.$kousha.'<br />';

        ?>

    </body>
</html>