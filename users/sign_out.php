<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>サインアウト</title>
        <link rel="stylesheet" href="../post_comments/style.css">
    </head>
    <body>
        <header>
            <h1 class="heading">
                <a href="../post_comments/index.php">質問・コメント機能</a>
            </h1>
        </header>

        <main>
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
        </main>
    </body>
</html>