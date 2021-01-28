<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問・コメント機能</title>
    </head>
    <body>
        <?php

        //接続用パラメータの設定
        $host = 'localhost'; //データベースが動作するホスト
        $user = 'www'; //DBユーザ名（各自が設定）
        $pass = 're12wcd'; //DBパスワード（各自が設定）
        $dbname = 'comment_db';//データベース名（各自が設定）

        // mysqliクラスのオブジェクトを作成
        $mysqli = new mysqli($host, $user, $pass, $dbname);
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        }
        else{
            $mysqli->set_charset("utf8");
        }

        $sql = "select mainText, postedTime from comment order by postedTime";

        $result = $mysqli->query($sql);
        if($result){
            while($row = $result->fetch_assoc()){
                echo $row["postedTime"] . " - " . $row["mainText"] . "<br>";
            }
            $result->close();
        }
        else{
            echo "データの登録に失敗しました";
            echo "SQL文: $sql";
            echo "エラー番号: $mysqli->errno";
            echo "エラーメッセージ: $mysqli->error";
            exit();
        }

        $mysqli->close();

        ?>
    </body>
</html>