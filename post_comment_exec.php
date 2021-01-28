<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問・コメント機能</title>
    </head>
    <body>
        <h1>質問・コメント機能</h1>

        <?php

        $comment = $_POST["comment"];
        echo "質問・コメント";
        echo "<br>\n";
        echo "${comment}";
        ?>

    </body>
</html>
