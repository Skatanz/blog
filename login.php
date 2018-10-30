<?PHP

session_start();

if ( isset( $_SESSION['mail'] ) ) {

    header("Location:/manage.php");
    exit();

}

if ( isset( $_SESSION['error']) ) {

$errorMessage = $_SESSION['error'];

}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title> ログイン </title>
    
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
    </div>
</div>
</header>

<main>
    <div class="container">

        <div>
            <p><?PHP echo $errorMessage?> </p>
        </div>
        <div class="mt-5">
            <form class="form-horizontal" action="/manage.php" method="post">
                <fieldset>
                    <legend>ログイン</legend>
                    <div class="control-group">
                        <label class="control-label" for=""> メールアドレス </label>
                        <div class="controls">
                            <input type="text" value="" name="mail" placeholder="メールアドレス">
                        </div>
                        <br>
                        <label class="control-label" for=""> パスワード </label>
                        <div class="controls">    
                            <input type="password" value="" name="password" placeholder="パスワード">
                        </div>
                        <br>
                        <div class="form-action">
                            <input class="btn-primary" type="submit" name="login" value="ログイン">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    <!--
    <div>
        <form action="/signup.php" method="post">
            <fieldset>
                <legend> 新規登録</legend>
                <label for=""> メールアドレス </label>
                <input type="email" value="" name="mail" placeholder="メールアドレス">
                <br>
                <label for=""> パスワード </label>
                <input type="password" value="" name="password" placeholder="パスワード">
                <br>
                <input type="submit" name="signUp" value="登録する">
            </fieldset>
        </form>
    </div>
    -->
    </div>
</main>
</body>


</html>