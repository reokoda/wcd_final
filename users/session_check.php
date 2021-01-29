<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>セッションチェック</title>
    </head>
    <body>
        <?php
        session_start();

        if(isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            echo "サインイン済みです。ユーザIDは${uid}です<br>";
        }
        else{
            echo "サインインしていません<br>";
        }
        ?>
    </body>
</html>