<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>天国農園</title>
    </head>
    <body>

        <?php
        
        $mbango = $_POST['mbango'];

        $hoshi['M1'] = 'カニ星雲';
        $hoshi['M31'] = 'アンドロメダ大星雲';
        $hoshi['M42'] = 'オリオン大星雲';
        $hoshi['M45'] = 'すばる';
        $hoshi['M57'] = 'ドーナツ星雲';

        foreach ( $hoshi as $key => $val ) {
            echo $key.'は'.$val;
            echo '<br />';
        }


        echo 'あなたが選んだ星は';
        echo $hoshi[$mbango];

        ?>

    </body>
</html>