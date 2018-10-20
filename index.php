<?PHP

require 'function.php';

session_start ();

$db = set_dbData ();

$auth = new Auth( $db );
$article = new Article( $db );

$auth->logout();

$getPage = isset( $_GET[ "page" ] ) ? $_GET[ "page" ] : 1;

$contents = $article->get_contents ( $getPage );
$pages = $article->get_total_page ( );

?>

<!DOCTYPE html>
<html lang="ja">

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
        <?PHP foreach($contents as $row): ?>
            <div>
                <a href="/article.php?id=<?PHP echo $row['id']; ?>">
                    <?PHP echo $row['title']; ?>
                </a>
            </div>
        <?PHP endforeach; ?>
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
        <a href="/login.php">管理者ログイン</a>
    </div>
</footer>

</html>