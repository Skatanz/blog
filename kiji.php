<?PHP

require 'Class/DB_CONNECT.php';
require 'Class/Article.php';

session_start ();

$db = new DB_CONNECT();
$article = new Article( $db );

$_get_id = $_GET[ 'id' ];

$content = $article->get_content ( $_get_id );
$newContents = $article->get_contents ( 1 );

if ( isset( $_SESSION[ 'mail' ] ) ) {
    $edit = "編集する";
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title> <?php echo $content[0]['title']; ?> </title>

<!-- CSS Bootstrap　-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>

<body>
    
<header>
    <div class="container"> 
        <div class="text-right mt-2">
            <a class="btn btn-info" href="/index.php">TOP</a>
        </div>
    </div>
</header>

<main>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bg-secondary rounded mt-5 p-4">
                    <h4 class="text-white"><?PHP echo $content[0]['title']; ?></h4>
                </div>

                <div class="my-4 px-2">
                    <p> <?PHP echo $content[0]['content']; ?> </p>
                </div>
                <div>
                    <p class="px-2"> <?PHP echo date( "Y 年 m月 d日" , strtotime($content[0]['created_at']) ) ?> </p>
                </div>
            </div>
            <div class="col-4 pt-5">
                <div class="border">
                    <h5 class=" bg-secondary rounded text-white py-2 px-2">プロフィール</h5>
                        <img class="pt-1" src="img/img3.jpg" alt="プロフィール画像" width="350" height="230" >
                        <h5 class="pt-2">Yamada</h5>
                        <p class="pt-2">
                            日常の物足りなさからプログラミング勉強中 <br>
                            普段は製造業で営業職として働いています <br>
                            今年第一子が産まれました！！<br>
                        </p>
                </div>
                <div>
                    <h5 class=" bg-secondary rounded text-white mt-2 py-2 px-2">最新の投稿</h5>
                        <?PHP foreach($newContents as $row): ?>
                        <a href="/kiji.php?id=<?PHP echo $row['id']; ?>">
                            <div class="border">
                                <p class="text-black"> <?PHP echo $row['title']; ?> </p> 
                            </div>
                        </a>
                        <?PHP endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <a href="/edit.php?id=<?PHP echo $_get_id;?>"><?PHP echo $edit;?></a>
        <a href="<?PHP echo $_SERVER['HTTP_REFERER']; ?> ">戻る</a>
    </div>
</footer>
</body>

</html>