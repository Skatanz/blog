<?PHP
    require 'function.php';
    
    session_start();

    $_SESSION['error'] = "";

    $db = get_dbdata();

    if(isset($_POST['update'])){
        
        $idUpdate = $_SESSION['id'];
        $titleUpdate = $_POST['titleUpdate'];
        $contentUpdate = $_POST['contentUpdate'];
        
        $updateMessage = kiji_update($db, $idUpdate, $titleUpdate, $contentUpdate);

    }

    if(isset($_POST['delete'])){
        
        $idDelete = $_SESSION['id'];

        $deleteMessage = kiji_delete($db, $idDelete);

    }

    if(empty($_SESSION['mail'])){
    
        if(isset($_POST['login'])){

            if(empty($_POST['mail'])){
                        
                $_SESSION['error'] = "メールアドレスが入力されていません";
                header("Location:/login.php");
                exit();

            } elseif(empty($_POST['password'])) {
            
                $_SESSION['error'] = "パスワードが入力されていません";
                header("Location:/login.php");
                exit();
            }

                $mail = $_POST['mail'];
                $password = $_POST['password'];

                $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

               // ユーザ認証
                try {
                    //データベースへ接続
                    $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                    //sql処理の準備
                    $sql = "SELECT * FROM user_table where mail =:mail ";
                    //sqlクエリの実行
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(":mail", $mail);
                    $stmt->execute();
                    $pass = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (password_verify($password, $pass[0]['password'])){
                    
                        session_regenerate_id(true);
                        $_SESSION['mail'] = $mail;

                    } else {

                        $_SESSION['error'] = "パスワードが違います";
                        header("Location:/login.php");
                        exit();
                    }
    
                } catch (PDOException $e) {
                    $errorMessage = 'データベースエラー';
                    $errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
                }

        } else {
            header("Location: /login.php");
            exit();    
        }
    }

    $contents = get_contents($db);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブログtest</title>
</head>

<header>
    <div>
        <h1>ブログタイトル</h1>
    </div>
</header>

<body>
    <div>

        <div>
            <p><?PHP echo $updateMessage; ?></p>
            <p><?PHP echo $deleteMessage; ?></p>
        </div>

    <div>
        <?PHP foreach($contents as $row): ?>
            <div>
                <a href="/kiji.php?id=<?PHP echo $row['id']; ?>">
                    <?PHP echo $row['title']; ?>
                </a>
            </div>
        <?PHP endforeach; ?>

        <p><?PHP echo $errorMessage?></p>
    </div>
    </div>
</body>

<footer>
    <div>
        <a href="/toukou.php">
            <p>投稿する</p>
        </a>
    </div>

    <div>
        <a href="/index.php">ログアウト</a>
    </div>
</footer>

</html>