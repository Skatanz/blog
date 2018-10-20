<?PHP
    require 'function.php';
    
    session_start();

    $_SESSION['error'] = "";

    $db = get_dbdata();

    if(isset($_POST['update'])){
        
        $idUpdate = $_SESSION['id'];
        $titleUpdate = $_POST['titleUpdate'];
        $contentUpdate = $_POST['contentUpdate'];
        
        $updateMessage = art_update($db, $idUpdate, $titleUpdate, $contentUpdate);

    }

    if(isset($_POST['delete'])){
        
        $idDelete = $_SESSION['id'];

        $deleteMessage = art_delete($db, $idDelete);

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

                $errorMessage = login($db, $mail, $password);

        } else {
            header("Location: /login.php");
            exit();    
        }
    }

    if(isset($_GET["page"])){

        $getPage = $_GET["page"];

    } else {

        $getPage = 1;
        
    }

    $contents = get_contents($db, $getPage);
    $pages = get_total_page($db);

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
                    <a href="/article.php?id=<?PHP echo $row['id']; ?>">
                        <?PHP echo $row['title']; ?>
                    </a>
                </div>
            <?PHP endforeach; ?>
        </div>
    </div>
</body>

<footer>
    <div>
        <?php
            for($i=1; $i < $pages; $i++) {
                printf("<a href='?page=%d'>%dページへ</a><br />\n", $i, $i);
            }
        ?>
    </div>

    <div>
        <a href="/contribute.php">
            <p>投稿する</p>
        </a>
    </div>

    <div>
        <a href="/index.php">ログアウト</a>
    </div>
</footer>

</html>