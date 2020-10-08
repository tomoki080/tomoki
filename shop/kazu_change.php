<?php 

    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $max = $post['max'];
    for ( $i=0; $i<$max; $i++ ) {
        if ( preg_match('/\A[0-9]+\z/',$post['kazu'.$i]) == 0 ) {
            echo '数量に謝りがあります。<br />';
            echo '<a href="shop_list.php">商品一覧へ戻る</a>';
            exit();
        }
        if ( $post['kazu'.$i]<1 || 10<$post['kazu'.$i] ) {
            echo '数量は必ず1つ以上、10個までです。';
            echo '<a href="shop_list.php">商品一覧へ戻る</a>';
            exit();
        }
        
        $kazu[] = $post['kazu'.$i];

    }

    $cart = $_SESSION['cart'];

    for ( $i=$max; 0<=$i; $i-- ) {
        if ( isset($_POST['sakujo'.$i]) == true ) {
            array_splice($cart,$i,1);
            array_splice($kazu,$i,1);
        }
    }

    $_SESSION['cart'] = $cart;
    $_SESSION['kazu'] = $kazu;

    header('Location:shop_cartlook.php');
    exit();

?>