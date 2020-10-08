<?php
$err_msg1="";
$err_msg2="";
$message="";
$name=( isset($_POST["name"]) === true ) ? $_POST["name"]: "";
$comment= ( isset($_POST["comment"]) === true ) ? trim($_POST["comment"]) : "";


if ( isset($_POST["send"]) === true ) {
    if ( $name === "" ) $err_msg1 = "名前を入力してね";

    if ( $comment === "" ) $err_msg2 = "コメントを入力してね";

    if ( $err_msg1 === "" && $err_msg2 === "" ) {
        $fp = fopen("nakatani.csv","a");
        fwrite( $fp , $name."\t".$comment."\n");
        $message="書き込みに成功したよ"; 
    }
}

$fp = fopen("nakatani.csv","r"); 

$Arr = array();
while( $res = fgets($fp)) {
    $tmp = explode("\t",$res);
    $arr = array(
        "name"=>$tmp[0],
        "comment"=>$tmp[1]
    );
    $Arr[]=$arr;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>旧石器時代</title>
        <link rel="stylesheet" href="./css/age1.css">
        <script src="./js/jquery-3.5.1.min.js"></script>
        <script src="./js/age1.js"></script>
    </head>
    <body>
        <header>
            <div class="header">
                <h1>旧石器時代の掲示板</h1>
            </div>
            <p>時代は全く関係ないよ・・。</P>
        </header>

        <div class="main">旧石器時代の思い出を語ってください。</div>

        <div class="message">
            <div class="in-message">
                <p style="color:red;"><?php echo $message; ?></p>
                <form method="post" action="">
                名前：<input type="text" name="name" value="<?php echo $name; ?>" >
                    <?php echo $err_msg1; ?><br>
                コメント: <textarea name="comment" rows="4" cols="40"><?php echo $comment; ?></textarea>
                    <?php echo $err_msg2; ?><br>
                <br>
                    <input type="submit" name="send" value="クリック">
                </form>
                <dl>
                    <?php foreach( $Arr as $nakatani): ?>
                    <p><span><?php echo $nakatani["name"]; ?></span>:<span><?php echo $nakatani["comment"]; ?></span></p>
                    <?php endforeach; ?>
                </dl>
            </div>
        </div>

        <footer>
            <div class="in-footer">
                <div class="footer-left">
                    <p>意見等はこちらへどうぞ！！</P>
                </div>
                <div class="footer-right">
                    <p>僕のアカウントです。</p>
                    <a href="https://twitter.com/6a4a5a3a89?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @6a4a5a3a89</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </footer>
    </body>
</html>


