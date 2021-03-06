<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>検索準備</title>
    </head>
    <body>

        <?php
        $table = $_GET['table'];
        ?>

        <p>探しているプレイヤーの情報を入力してください。</p>
        <form method="post" action="look.php">
            プレイヤーレベル(検索範囲:前後100):<br />
            <input type="text" name="level" placeholder="0~999" size="3px" maxlength="3"><br />
            ランクレート(検索範囲:前後500):<br />
            <input type="text" name="rate" placeholder="0~5000" size="3px" maxlength="4"><br />
            プレイタイプ:<br />
            <input type="radio" name="play" value="本気">本気<br />
            <input type="radio" name="play" value="楽しく">楽しく<br />
            <input type="radio" name="play" value="両方" checked="checked">両方<br />
            行動タイプ:<br />
            <input type="checkbox" name="done[]" value="前衛で戦う">前衛で戦う<br />
            <input type="checkbox" name="done[]" value="後衛でサポート">後衛でサポート<br />
            <input type="checkbox" name="done[]" value="自由に動き回る">自由に動き回る<br />
            <input type="checkbox" name="done[]" value="指示に従う">指示に従う<br />
            ボイスチャット:<br />
            <input type="radio" name="voice" value="YES">YES<br />
            <input type="radio" name="voice" value="NO">ON<br />
            <input type="radio" name="voice" value="BOTH" checked="checked">BOTH<br />
            <br />
            <input type="hidden" name="table" value=<?php echo $table;?>>
            <input type="submit" value="決定">
        </form>

        <a href="top.php?table=<?php echo $table;?>">トップページへ戻る</a>

    </body>
</html>