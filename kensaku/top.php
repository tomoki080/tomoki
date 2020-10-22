<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>トップ</title>
    </head>
    <body>

        <?php
        if ( isset($_GET['table']) ) {
            $table = $_GET['table'];
        }

        echo 'テーブル名:';
        echo $table;
        echo '<br /><br />';

        echo '選択したい項目をクリックしてください。<br />';
        echo '<a href="all.php?table='.$table.'">全てのプレイヤーを見る</a>';
        echo '<br /><br />';
        echo '<a href="search.php?table='.$table.'">プレイヤーを探す</a>';
        echo '<br /><br />';
        echo '<a href="set.php?table='.$table.'">ユーザーを追加する</a>';
        echo '<br /><br />';
        echo '<a href="delete_table.php?table='.$table.'">テーブルを削除する</a>';

        ?>

    </body>
</html>