<?PHP
    require 'function.php';    

    $db = dbdata();

    


?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title> <?php "タイトル" ?> </title>
</head>

<header>
    <div>
        <h1>ブログタイトル</h1>
    </div>
</header>

<body>
    <div>
        <h2> <?php "タイトル" ?> </h2>
        <div>
            <pre> <?php "" ?> </pre>
            <?php phpinfo(); ?>
        </div>
    </div>
</body>


</html>