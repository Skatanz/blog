<?PHP
    session_start();

    if(isset($_SESSION['mail'])){
        
        header("Location:/manage.php");
        exit();

    }

    $errorMessage = $_SESSION['error'];
    
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title> <?php "タイトル" ?> </title>
</head>

<header>
    <div>
        <h2>ログイン画面</h2>
    </div>
</header>

<body>
    <div>

        <div>
            <p><?PHP echo $errorMessage ?></p>
            <form action="/manage.php" method="post">
            <fieldset>
            <legend> ログイン </legend>
                <label for=""> メールアドレス </label>
                    <input type="text" value="" name="mail" placeholder="メールアドレス">
                    <br>
                <label for=""> パスワード </label> 
                    <input type="text" value="" name="password" placeholder="パスワード">
                    <br>
                <input type="submit" name="login" value="ログイン">
            </form>
            </fieldset>
        </div>

        <div>
            <form action="/signup.php" method="post">
            <fieldset>
            <legend> 新規登録 </legend>
                <label for=""> メールアドレス </label>
                    <input type="text" value="" name="mail" placeholder="メールアドレス">
                    <br>
                <label for=""> パスワード </label>
                    <input type="text" value="" name="password" placeholder="パスワード">
                    <br>
                <input type="submit" name="signUp" value="登録する">
            </form>
            </fieldset>
        </div>

    </div>
</body>


</html>