<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ユーザ認証 -質問・コメント機能-</title>
    </head>
    <body>
        <h1>ユーザ認証画面</h1>

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

        if(!empty($_POST["userName"]) && !empty($_POST["password"])){

            $userName = $_POST["userName"];
            $password = $_POST["password"];

            $sql = "select password from users where userName = '$userName'";
            $result = $mysqli->query($sql);
            if($result->num_rows == 0){
                echo "ユーザ名「${userName}」は登録されていません<br>";
                exit();
            }

            $row = $result->fetch_assoc();
            $db_enc_passwd = $row["password"];

            if(password_verify($password, $db_enc_passwd)){
                echo "ユーザ「${userName}」が正しく認証されました<br>";
            }
            else{
                echo "ユーザ「${userName}」を認証できませんでした。パスワードが一致しません<br>";
                exit();
            }

            $result->close();
            $mysqli->close();
        }
        else{
            echo "入力されていない項目があります<br>";
        }

        ?>
    </body>
</html>