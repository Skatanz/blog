<?PHP
    // ログイン情報が間違っていないか確認
    $mail = $_POST["mail"];
    //$user = "SELECT FROM user_table WHERE mail = $mail"
    $user_id= $user->id;

    //$sql = " SELECT FROM kiji_table WHERE user_id = $user_id; "

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