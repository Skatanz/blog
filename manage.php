<?PHP

require 'function.php';

session_start ();

$_SESSION[ 'error' ] = "";

$db = set_dbData ();

$auth = new Auth($db);
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
            <p><?PHP echo $updateMessage; ?></p>
            <p><?PHP echo $deleteMessage; ?></p>
        </div>

        <div>
            <?PHP foreach($contents as $row): ?>
                <div>
                    <a href="/article.php?id=<?PHP echo $row['id']; ?>">
                        <?PHP echo $row['title']; ?>
                    </a>
                </div>
            <?PHP endforeach; ?>
        </div>
    </div>
</body>

<footer>
    <div>
        <?php
            for($i=1; $i < $pages; $i++) {
                printf("<a href='?page=%d'>%dページへ</a><br />\n", $i, $i);
            }
        ?>
    </div>

    <div>
        <a href="/contribute.php">
            <p>投稿する</p>
        </a>
    </div>

    <div>
        <a href="/index.php">ログアウト</a>
    </div>
</footer>

</html>