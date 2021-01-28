<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ユーザ新規登録 -質問・コメント機能-</title>
    </head>
    <body>
        <h1>ユーザ新規登録画面</h1>

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

        if(!empty($_POST["userName"]) && !empty($_POST["password1"]) && !empty($_POST["password2"])){

            $userName = $_POST["userName"];
            $password1 = $_POST["password1"];
            $password2 = $_POST["password2"];

            $sql = "select * from users where userName = $userName";
            $result = $mysqli->query($sql);
            if($result->num_rows != 0){
                echo "ユーザ名「${userName}」は既に登録されているため使用できません<br>";
                exit();
            }

            if($password1 != $password2){
                echo "パスワードが一致しません<br>";
                exit();
            }

            // パスワードの暗号化
            $enc_password = password_hash($password1, PASSWORD_DEFAULT);

            $sql = "insert into users (userName, password) values ('$userName', '$enc_password')";
            $result = $mysqli->query($sql);
            if($result){
                echo "ユーザ「${userName}」の登録に成功しました<br>";
            }
            else{
                echo "データの登録に失敗しました<br>";
                echo "SQL文: $sql<br>";
                echo "エラー番号: $mysqli->errno<br>";
                echo "エラ〜メッセージ: $mysqli->error<br>";
                exit();
            }

            $mysqli->close();
        }
        else{
            echo "入力されていない項目があります<br>";
        }

        ?>
    </body>
</html>