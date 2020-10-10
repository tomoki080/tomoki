<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>検索実行</title>
  </head>
  <body>
    <?php

      try {

        foreach($_POST as $key => $value){
          if(!$value)continue;
          if(ctype_digit($value))$value = (int)$value;  // SQLインジェクション対策
          $param[$key] = $value;
        }

        // $data は ステークホルダー用
        foreach($param as $v){
          if(is_array($v)){
            // 配列やったら、その中身をdataに入れる
            foreach($v as $array_val){
              $data[] = $array_val;
            }
          }else{
            // int型はステークホルダーにする必要がないのでdataに入れない
            if(is_int($v))continue;
            $data[] = $v;
          }
        }

        $dsn='mysql:dbname=kensaku;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM `player` ';
        if($param){
          // もしvoiceがラジオタイプじゃなくなってもいいように
          $sql .= 'WHERE ';
        }
        foreach($param as $key => $value){
          if(is_array($value)){
            $sql .= "{$key} IN ( ";
            foreach($value as $k => $v){
              $sql .= "? ";
              if(isset($value[$k + 1]))$sql .= ",";
            }
            $sql .= ") ";
          }else{
            if($key == 'level')$margin = 100;
            if($key == 'rate') $margin = 500;
            $sql .= $margin ? "{$key} BETWEEN {$value}-{$margin} AND {$value}+{$margin} " : "{$key} = ? ";
          }
          $margin = 0;
          if(next($param))$sql .= "AND ";
        }

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        unset($dbh);

        echo '<div style="text-align:center">プレイヤー一覧</div><br /><br />';
        echo '<table border="1" width="1000px" style="text-align:center">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>プレイヤーコード</td>';
        echo '<td>プレイヤーネーム</td>';
        echo '<td>レベル</td>';
        echo '<td>レート</td>';
        echo '<td>プレイタイプ</td>';
        echo '<td>行動タイプ</td>';
        echo '<td>ボイスチャット</td>';
        echo '</tr>';

        while (($rec = $stmt->fetch(PDO::FETCH_ASSOC))) {
          echo "<tr>";
          foreach($rec as $value){
            echo "<td>{$value}</td>";
          }
          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

      } catch(Exception $e) {
        echo "受け取ったパラメータの中身 => <br>";
        var_dump($param);
        echo "<br><br><br>";
        echo "<br>";
        echo($sql."<br><br>");  // sql文の内容
        echo "==dataの内容==<br>";
        foreach($data as $value){
          echo "{$value}<br>";
        }
        echo "<br><br>";
        echo($e."<br>");    // エラー内容
        echo 'サーバーに障害が発生しています。';
        echo 'しばらくお待ちください。';
        exit();
      }
      echo "受け取ったパラメータの中身 => <br>";
      var_dump($param);
      echo "<br><br><br>";
      echo "<br><br><br>";
      echo($sql."<br><br>");  // sql文の内容
      echo "==dataの内容==<br>";
      foreach($data as $value){
        echo "{$value}<br>";
      }
      echo "<br><br>";
    ?>
  </body>
</html>