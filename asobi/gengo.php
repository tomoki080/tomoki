<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>天国農園</title>
    </head>
    <body>

        <?php 

        require_once('../common/common.php');
        
        $seireki = $_POST['seireki'];

        $wareki = gengo($seireki);
        echo $wareki;
        
        ?>

    </body>
</html>