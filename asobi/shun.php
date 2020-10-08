<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>天国農園</title>
    </head>
    <body>

        <?php 
        
        $tsuki = $_POST['tsuki'];

        $yasai[] = '';
        $yasai[] = 'トマト';
        $yasai[] = 'ニンジン';
        $yasai[] = 'シイタケ';
        $yasai[] = '小松菜';
        $yasai[] = 'レタス';
        $yasai[] = 'ピーマン';
        $yasai[] = 'ヒジキ';
        $yasai[] = '松茸';
        $yasai[] = 'ブロッコリー';
        $yasai[] = 'トウモロコシ';
        $yasai[] = 'エノキ';
        $yasai[] = 'オクラ';

        echo $tsuki;
        echo '月は';
        echo $yasai[$tsuki];
        echo 'がオススメです。';
        
        ?>

    </body>
</html>