<?PHP

require 'Class/DB_CONNECT.php';
require 'Class/Article.php';

//データベースの情報入手
$db = new DB_CONNECT();
$article = new Article( $db );


if ( isset( $_POST['signUp'] ) ) {

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $signUpMessage = $article->signUp($mail, $password);
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