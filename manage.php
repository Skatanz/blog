<?PHP


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