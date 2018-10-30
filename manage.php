<?PHP

require 'Class/DB_CONNECT.php';
require 'Class/Auth.php';
require 'Class/Article.php';

session_start ();

$_SESSION[ 'error' ] = "";

$db = new DB_CONNECT();

$auth = new Auth( $db);
$article = new Article($db);

//更新処理
if ( isset( $_POST[ 'update' ] ) ) {

    $idUpdate = $_SESSION[ 'id' ];
    $titleUpdate = $_POST[ 'titleUpdate' ];
    $contentUpdate = $_POST[ 'contentUpdate' ];

    $updateMessage = $article->update ( $idUpdate, $titleUpdate, $contentUpdate );

}
//削除処理
if ( isset( $_POST[ 'delete' ] ) ) {

    $idDelete = $_SESSION[ 'id' ];
    $deleteMessage = $article->delete ( $idDelete );

}
//メールアドレス認証
if ( empty( $_SESSION[ 'mail' ] ) ) {

    if ( isset( $_POST[ 'login' ] ) ) {

        if ( empty( $_POST[ 'mail' ] ) ) {

            $_SESSION[ 'error' ] = "メールアドレスが入力されていません";
            header ( "Location:/login.php" );
            exit();

        } elseif ( empty( $_POST[ 'password' ] ) ) {

            $_SESSION[ 'error' ] = "パスワードが入力されていません";
            header ( "Location:/login.php" );
            exit();
        }

        $mail = $_POST[ 'mail' ];
        $password = $_POST[ 'password' ];

        $errorMessage = $auth->login ( $mail, $password );

    } else {
        header ( "Location: /login.php" );
        exit();
    }
}

//
if ( isset( $_GET[ "page" ] ) ) {

    $getPage = $_GET[ "page" ];

} else {

    $getPage = 1;

}

//記事の取得
$contents = $article->get_contents ( $getPage );
//トータルページ数の取得
$pages = $article->get_total_page ( );

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
        <div class="text-right">
            <a class="btn" href="/contribute.php">投稿する</a>
            <a class="btn" href="/index.php">ログアウト</a>
        </div>
        <div class="shadow px-2 py-3 mb-3 bg-secondary text-white text-center">
            <h1 class="display-3 mb-4">Simple is Best</h1>
            <p>プログラミングの事とか子育ての事とか</p>
        </div>
    </div>
</header>

<main>
    <div class="container">
        <div>
            <p><?PHP echo $updateMessage; ?></p>
            <p><?PHP echo $deleteMessage; ?></p>
        </div>
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
                <div class="border">
                    <h4 class="pt-3">プロフィール</h4>
                    <img class="pt-4" src="img/img3.jpg" alt="プロフィール画像" width="350" height="230" >
                    <p class="pt-4">
                        日常の物足りなさからプログラミング勉強中 <br>
                        普段は製造業で営業職として働いています <br>
                        今年第一子が産まれました！！<br>
                        
                    </p>
                </div>    
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container mt-5">
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