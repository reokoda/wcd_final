<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問・コメント機能</title>
    </head>
    <body>
        <h1>質問・コメント機能</h1>

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
            $comment = $_POST["mainText"];
            echo "入力した質問・コメント";
            echo "<br>";
            echo "${mainText}";
            echo "<hr>";

            $sql = "insert into comment (mainText) values ('$mainText')";
            $result = $mysqli -> query($sql);
            if($result){
                echo "データの登録に成功しました";
            }
            else{
                echo "データの登録に失敗しました";
                echo "SQL文: $sql";
                echo "エラー番号: $mysqli->errno";
                echo "エラーメッセージ: $mysqli->error";
                exit();
            }

            $mysqli->close();
        }
        else{
            echo "テキストが入力されていません";
        }

        ?>


        <p><a href="index.php">一覧へ</a><p>
    </body>
</html>
