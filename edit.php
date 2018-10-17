<?PHP
    require 'function.php';    
    session_start();

    $_SESSION['id'] = "";

    $db = get_dbdata();
    
    $_get_id = $_GET['id'];

    $content = get_content($db , $_get_id);

    $_SESSION['id'] = $_get_id; 
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title> <?php echo $content[0]['title']; ?> </title>
</head>

<header>

</header>

<body>
    <div>
        <form action="/manage.php" method ="post">
            <p>タイトル</p>
                <input type="text" value="<?PHP echo $content[0]['title']; ?>" name="titleUpdate">
                <br>
            <p>内容</p>
                <textarea rows ="10" value="" name="contentUpdate"><?PHP echo $content[0]['content']; ?></textarea>
                <br>
            <input type="submit" name="update" value="更新する">
            <input type="submit" name="delete" value="削除する">
        </form>
    </div>
</body>

<footer>
    <a href="/index.php">トップページ</a>
</footer>

</html>