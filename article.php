<?PHP

require 'function.php';
session_start ();

$db = set_dbData ();
$article = new Article( $db );

$_get_id = $_GET[ 'id' ];

$content = $article->get_content ( $_get_id );

if ( isset( $_SESSION[ 'mail' ] ) ) {
    $edit = "編集する";
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title> <?php echo $content[0]['title']; ?> </title>
</head>

<header>
    <div>
        <h1><?PHP echo $content[0]['title']; ?></h1>
    </div>
</header>

<body>
    <div>
        <p> <?PHP echo $content[0]['created_at']; ?></p>
    </div>
    <div>
        <p> <?PHP echo $content[0]['content']; ?> </p>
    </div>
</body>

<footer>
    <a href="/edit.php?id=<?PHP echo $_get_id;?>"><?PHP echo $edit;?></a>
    <a href="<?PHP echo $_SERVER['HTTP_REFERER']; ?> ">戻る</a>
    <a href="/index.php">トップページ</a>
</footer>

</html>