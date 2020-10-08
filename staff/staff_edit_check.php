<?php 
session_start();
session_regenerate_id(true);
if ( isset($_SESSION['login'])==false ) {
    echo 'ログインされていません。';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    echo $_SESSION['staff_name'];
    echo 'さんがログイン中';
    echo '<br />';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>脱獄農園</title>
    </head>
    <body>
    
    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $staff_code  = $post["code"];
    $staff_name  = $post["name"];
    $staff_pass  = $post["pass"];
    $staff_pass2 = $post["pass2"];


    if( $staff_name == '' ) {
        echo "スタッフ名が入力されていません。<br />";
    } else {
        echo "スタッフ名:";
        echo $staff_name;
        echo "<br />";
    }
    
    if( $staff_pass!=$staff_pass2 ) {
        echo "パスワードが一致しません。<br />";
    }

    if( $staff_name=='' || $staff_pass=='' || $staff_pass2=='' ) {
        echo "<form>";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "</form>";
    } else {
        $staff_pass = md5($staff_pass);
        echo "<form method='post' action='staff_edit_done.php'>";
        echo "<input type='hidden' name='code' value='".$staff_code."'>";
        echo "<input type='hidden' name='name' value='".$staff_name."'>";
        echo "<input type='hidden' name='pass' value='".$staff_pass."'>";
        echo "<br />";
        echo "<input type='button' onclick='history.back()' value='戻る'>";
        echo "<input type='submit' value='OK'>";
    }

    ?>

    </body>
</html>