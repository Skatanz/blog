<?PHP

require 'function.php';

session_start ();

if ( isset( $_POST[ 'contribute' ] ) ) {

    //データベースの情報入手
    $db = get_dbdata ();

    $title = $_POST[ 'title' ];
    $content = $_POST[ 'content' ];

    $Message = contribute ( $db, $title, $content );
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブログタイトル</title>
</head>

<header>
    <div>
        <h1>投稿画面</h1>
    </div>
</header>

<body>
    <div>
        <div>
            <p><?PHP echo $Message ?></p>
        </div>

        <div>
            <form action="" method ="post">
                <p>タイトル</p>
                    <input type="text" value="" name="title">
                    <br>
                <p>内容</p>
                    <textarea rows ="10" value="" name="content"></textarea>
                    <br>
                <input type="submit" name="contribute" value="投稿する">
            </form>
        </div>
    </div>
</body>

<footer>
    <div>
        <a href="/manage.php">管理画面へ戻る</a>
        <a href="/index.php">ログアウト</a>
    </div>
</footer>

</html>