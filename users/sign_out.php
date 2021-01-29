<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>サインアウト</title>
    </head>
    <body>
        
        <?php
            session_start();
            $_SESSION = array();
            session_destroy();
        ?>
        <h1>サインアウトしました。</h1>
        <p>
            <a href="../post_comments/index.php">一覧へ</a><br>
            <a href="../users/sign_in.html">サインインへ</a><br>
        </p>
    </body>
</html>