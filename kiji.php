<?PHP

require 'Class/DB_CONNECT.php';
require 'Class/Article.php';

session_start();

$db = new DB_CONNECT();
$article = new Article($db);

$_get_id = $_GET[ 'id' ];

$content = $article->getContent($_get_id);
$newContents = $article->getContents(1);

$edit = "";
$class = "";

if (isset($_SESSION[ 'mail' ])) {
    $edit = "編集する";
} else {
    $class="d-none";
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>SiB</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style>
        body {
                background-color:#E7E9DE;
        }
    </style>
</head>
<body>
    
<header>
    <div class="container-fluid bg-info"> 
        <div class="row">
            <div class="col-12 mx-5 my-3">
                <h3><a style="text-decoration:none; color:white;" href="/index.php">Simple is Best</a></h3>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="bg-secondary rounded mt-5 p-4">
                    <h3 class="text-white"><?PHP echo $content[0]['title']; ?></h3>
                </div>
                <div class="bg-light">
                    <div class="my-4 px-2">
                        <p> <?PHP echo $content[0]['content']; ?> </p>
                    </div>
                    <div>
                        <p class="px-2"> <?PHP echo date("Y 年 m月 d日", strtotime($content[0]['created_at'])) ?> </p>
                    </div>
                </div>
                <div>
                    <a class="btn btn-info <?PHP echo $class;?>" href="/edit.php?id=<?PHP echo $_get_id;?>"><?PHP echo $edit;?></a>
                </div>
            </div>
            <div class="col-12 col-lg-4 pt-5">
                <div class="mx-5">
                    <h5 class=" bg-secondary rounded text-white  py-2 px-2">プロフィール</h5>
                        <div class="text-center">
                            <img class="mx-auto pt-1 rounded-circle" src="img/profile.png" alt="プロフィール画像" width="200px">
                        </div>
                        <div class="text-center">
                            <h5 class="mx-auto pt-2">Yamada</h5>
                            <p class="mx-auto pt-2">
                                日常の物足りなさからプログラミング勉強中 <br>
                                普段は製造業で営業職として働いています <br>
                                今年第一子が産まれました！！<br>
                            </p>
                        </div>
                </div>
                <div class="mx-5">
                    <h5 class="bg-secondary rounded text-white mt-2 py-2 px-2">最新の投稿</h5>
                    <div class="mt-3">
                        <?PHP foreach ($newContents as $row) : ?>
                            <div class="ml-2 my-2">
                                <h4>
                                    <a href="/kiji.php?id=<?PHP echo $row['id']; ?>">
                                        <p class="text-black"> <?PHP echo $row['title']; ?> </p>
                                    </a>
                                </h4> 
                            </div>
                        <?PHP endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container-fluid mt-5 mx-3">
        <a class="btn btn-info" href="<?PHP echo $_SERVER['HTTP_REFERER']; ?> ">戻る</a>
    </div>
</footer>
</body>

</html>