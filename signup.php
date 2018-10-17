<?PHP
    require 'function.php';
    
    //データベースの情報入手
    $db = get_dbdata();

    if (isset($_POST['signUp'])) {

        $mail = $_POST['mail'];
        $password = $_POST['password'];

        $signUpMessage = signUp($db , $mail , $password);
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