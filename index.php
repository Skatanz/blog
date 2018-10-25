<?PHP

require 'function.php';
require 'Class/Auth.php';
require 'Class/Article.php';

session_start ();

$db = set_dbData ();

$auth = new Auth( $db );
$article = new Article( $db );

$auth->logout();

$getPage = isset( $_GET[ "page" ] ) ? $_GET[ "page" ] : 1;

$contents = $article->get_contents ( $getPage );
$newContents = $article->get_contents ( 1 );
$pages = $article->get_total_page ( );

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

</head>
<body>

<header>
    <div class="container"> 
        <div class="text-right mb-2">
            <a class="btn btn-info" href="/index.php">TOP</a>
            <a class="btn btn-info" href="/login.php">ログイン</a>
        </div>
        <div class="shadow px-2 py-3 mb-3 bg-secondary text-white text-center">
            <h1 class="display-3 mb-4">Simple is Best</h1>
            <p>プログラミングの事とか子育ての事とか</p>
        </div>
    </div>
</header>

<main>
    <div class="container">
        <div class="row">
            <div class="col-8 pt-5">
                <?PHP foreach($contents as $row): ?>
                    <div class="row border border-dark shadow mx-3 mb-5 p-3">
                        <div class="col-8">
                            <h3 class="border-bottom mb-4"> <?PHP echo $row['title']; ?> </h3>
                            <p> <?PHP echo strip_tags( mb_strimwidth ( $row['content'], 0 , 70 , "...") ); ?> </p>
                            <a href="/kiji.php?id=<?PHP echo $row['id']; ?>">続きを読む</a>
                        </div>
                        <div class="col-4">
                            <p class=""> <?PHP echo date( "Y 年 m月 d日" , strtotime($row['created_at']) ) ?> </p>
                        </div>
                    </div>
                <?PHP endforeach; ?>
            </div>
            <div class="col-4 pt-5">
                <div>
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
                    <h5 class="bg-secondary rounded text-white mt-2 py-2 px-2">最新の投稿</h5>
                        <?PHP foreach($newContents as $row): ?>
                            <div class="my-2">
                                <a href="/kiji.php?id=<?PHP echo $row['id']; ?>">
                                    <p class="text-black"> <?PHP echo $row['title']; ?> </p>
                                </a> 
                            </div>
                        <?PHP endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container mt-2">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href='?page=<?PHP echo ($getPage - 1);?>'aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php for($i=1; $i < $pages; $i++): ?> 
                    <li class="page-item"><a class="page-link" href='?page=<?PHP echo $i;?>'><?PHP echo $i;?></a></li>
                <?PHP endfor; ?>
                <li class="page-item">
                    <a class="page-link" href='?page=<?PHP echo ($getPage + 1);?>' aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</footer>

</body>

</html>