<?PHP
    require 'function.php';
    
    session_start();

    $_SESSION['error'] = "";


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

                $db = dbdata();
                $mail = $_POST['mail'];
                $password = $_POST['password'];

                $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

               // ユーザ認証
                try {
                    //データベースへ接続
                    $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                    //sql処理の準備
                    $sql = "SELECT * FROM user_table where mail = $mail";
                    //sqlクエリの実行
                    $stmt = $pdo->query($sql);

                    if (password_verify($password, $stmt['password'])){
                    
                        session_regenerate_id(true);
                        $_SESSION['mail'] = $mail;

                    } else {

                        $_SESSION['error'] = "パスワードが違います";
                        header("Location:/login.php");
                        exit();
                    }
    
                } catch (PDOException $e) {
                    $errorMessage = 'データベースエラー';
                    //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
                }

        } else {
            header("Location: /login.php");
            exit();    
        }
    }

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
            <a href="/toukou.php">
                <p>投稿する</p>
            </a>
        </div>


        <div>
            <a href="">
                <p> <?php echo $sql->title; ?> </p>
            </a>
            <a href="">編集する</a>
        </div>

        <div>
            <a href="">
                <p> <?php "2記事目タイトル" ?> </p>
            </a>
        </div>

        <div>
            <a href="">
                <p> <?php "3記事目タイトル" ?> </p>
            </a>
        </div>

        <div>
            <a href="">
                <p> <?php "4記事目タイトル" ?> </p>
            </a>
        </div>

        <div>
            <a href="">
                <p> <?php "5記事目タイトル" ?> </p>
            </a>
        </div>    
    </div>
</body>

<footer>
    <div>
        <a href="/index.php">ログアウト</a>
    </div>
</footer>

</html>