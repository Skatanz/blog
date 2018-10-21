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

<!-- CSS Bootstrap　-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


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