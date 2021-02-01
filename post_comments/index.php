<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>質問・コメント機能</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!-- <script src="script.js"></script> -->
        <header>
            <h1 class="heading">
                <a href="index.php">質問・コメント機能</a>
            </h1>
        </header>

        <nav>
            <ul class="nav-list">
                <li class="nav-list-item"><a href="../users/sign_in.html">サインイン</a></li>
                <li class="nav-list-item"><a href="../users/sign_out.php">サインアウト</a></li>
                <li class="nav-list-item"><a href="../users/sign_up.html">サインアップ</a></li>
            </ul>
        </nav>
        

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

            session_start();
            if(isset($_SESSION['uid'])){
                $uid = $_SESSION['uid'];
                $sql = "select userName from users where uid = '${uid}'";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
                if($result){
                    echo '<div class="check-session">ようこそ、' . $row["userName"] . 'さん。</div><hr>';
                }
            }
            else{
                echo "サインインしていません。<hr>";
                exit();
            }
        ?>
        <main>
            <form action="index.php" method="post">
                質問・コメントを入力<br>
                <textarea name="mainText" rows="4" cols="100"></textarea><br>
                <div class="submit-button">
                    <input type="submit" value="送信">
                </div>
            </form>

        <?php



            if(!empty($_POST["mainText"])){
                $mainText = $_POST["mainText"];
                $sql = "insert into comment (mainText, uid) values ('$mainText', '$uid')";
                $result = $mysqli->query($sql);
                if($result){
                }
                else{
                    echo "データの登録に失敗しました。";
                    echo "SQL文: $sql";
                    echo "エラー番号: $mysqli->errno";
                    echo "エラーメッセージ: $mysqli->error";
                    exit();
                }
            }

            echo "<hr>";


            $sql = "select comment.cid, comment.mainText, comment.postedTime, users.userName, users.uid 
                    from comment join users on comment.uid = users.uid 
                    order by postedTime desc";
            $result = $mysqli->query($sql);
            if($result){
                $i = 0;
                while($row = $result->fetch_assoc()){
                    $sql2 = 'select count(*) as good from favorites where cid = ' . $row["cid"] . '';
                    $result2 = $mysqli->query($sql2);
                    if($result2){
                        $sum_iine = $result2->fetch_assoc();
                        echo '<div id="comment-iine-count">' . $sum_iine['good'] . '件のいいね</div>';
                        
                        echo '<div class="comment-box">';
                        echo '<div class="comment-user">ユーザ名：' . $row["userName"] . '</div>';
                        echo '<div class="comment-text">' . $row["mainText"] . '</div>';
                        echo '<div class="comment-time">' . $row["postedTime"] . '</div>';
                        echo '<div class="comment-iine">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="hidden['.$i.']" value=' . $row["cid"] . '>
                                        <input type="submit" name="submit['.$i.']" value="いいね">
                                    </form>
                            </div>';
                        echo '<hr>';
                        echo '</div>';
                        $result2->close();
                    }

                    $i += 1;
                }
                // iineを受け取れたかの確認
                if(isset($_POST['submit'])){
                    $iine = key($_POST['submit']);
                    $cid_iine = $_POST['hidden'][$iine];
                    $sql3 = "insert into favorites (cid, uid) values ('$cid_iine', '$uid')";
                    $result3 = $mysqli->query($sql3);
                    $result3->close();
                }
                
                $result->close();
            }

            
            $mysqli->close();
        ?>
        </main>
        


    </body>
</html>