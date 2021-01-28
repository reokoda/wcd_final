<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問・コメント機能</title>
    </head>
    <body>
        <h1><a href="index.php">質問・コメント機能</a></h1>

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

        if(!empty($_POST["mainText"])){
            $mainText = $_POST["mainText"];
            $sql = "insert into comment (mainText) values ('$mainText')";
            $result = $mysqli -> query($sql);
            if($result){
                echo "データの登録に成功しました";
                echo "<br>";
            }
            else{
                echo "データの登録に失敗しました";
                echo "SQL文: $sql";
                echo "エラー番号: $mysqli->errno";
                echo "エラーメッセージ: $mysqli->error";
                exit();
            }
        }


        $sql = "select mainText, postedTime from comment order by postedTime";
        $result = $mysqli->query($sql);
        if($result){
            while($row = $result->fetch_assoc()){
                echo $row["postedTime"] . " - " . $row["mainText"] . "<br>";
            }
            $result->close();
        }

        ?>

        <form action="index.php" method="post">
            質問・コメントを入力<br>
            <textarea name="mainText" rows="2" cols="40"></textarea><br>
            <input type="submit" value="送信">
        </form>

        <p>
            <a href="index.php">一覧へ</a><br>
            <a href="../users/sign_in.html">サインインへ</a><br>
            <a href="../users/sign_up.html">サインアップへ</a><br>
        </p>

        <?php
            $mysqli->close();
        ?>

    </body>
</html>