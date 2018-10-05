<?PHP
    // 新規登録ユーザー情報のDBへの挿入
    $user_name = $_POST["user_name"];
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];


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
            <form action="" method="post">
            <fieldset>
            <legend> 新規登録 </legend>
                <label for=""> ユーザー名 </label>
                    <input type="text" value="" name="user_name" placeholder="名前" >
                    <br>
                <label for=""> メールアドレス </label>
                    <input type="text" value="" name="mail" placeholder="メールアドレス">
                    <br>
                <label for=""> パスワード </label>
                    <input type="text" value="" name="pass" placeholder="パスワード">
                    <br>
                <input type="submit" value="登録する">
            </form>
            </fieldset>
        </div>

        <div>
            <form action="/manage.php" method="post">
            <fieldset>
            <legend> ログイン </legend>
                <label for=""> メールアドレス </label>
                    <input type="text" value="" name="mail" placeholder="メールアドレス">
                    <br>
                <label for=""> パスワード </label> 
                    <input type="text" value="" name="pass" placeholder="パスワード">
                    <br>
                <input type="submit" value="ログイン">
            </form>
            </fieldset>
        </div>
    </div>
</body>


</html>