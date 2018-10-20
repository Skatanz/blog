<?PHP

require 'function.php';

//データベースの情報入手
$db = set_dbData ();
$article = new Article( $db );


if ( isset( $_POST[ 'signUp' ] ) ) {

    $mail = $_POST[ 'mail' ];
    $password = $_POST[ 'password' ];

    $signUpMessage = $article->signUp ( $mail, $password );
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title> <?php "タイトル" ?> </title>
</head>

<header>
    <div>
        <h2>新規登録完了</h2>
    </div>
</header>

<body>
    <div>
        <h2><?PHP echo $signUpMessage ?></h2>
    </div>

    <div>
        <a href="/login.php">ログイン画面に戻る</a>
    </div>
</body>


</html>