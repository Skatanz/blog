<?PHP
    require 'function.php';

    session_start();

    $_SESSION = array();

    // 最終的に、セッションを破壊する
    session_destroy();

    $db = get_dbdata();
    $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
    
    if(isset($_GET["page"])){

        $_get_page = $_GET["page"];
        $_get_query = $_GET["q"];

    } else {

        $_get_page = 0;
        $_get_query = 0;
        
    }

    $contents = get_contents($db);

    $csql = "SELECT COUNT(*) FROM content_table WHERE id =:q "; // 総件数カウント用SQL
    $ssql = "SELECT * FROM content_table WHERE id =:q  ORDER BY 'id' LIMIT :start, 10"; // データ抽出用SQL
    

    try{

        $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        // データ抽出用SQLを、プリペアドステートメントで実行
        $ssth = $pdo->prepare($ssql);
        $ssth->bindValue(":q", $_get_query, PDO::PARAM_INT);
        $ssth->bindValue(":start", $_get_page * 10, PDO::PARAM_INT);
        $ssth->execute();
        $data = $ssth->fetchAll(PDO::FETCH_ASSOC);

        // 総件数カウント用SQLを、プリペアドステートメントで実行
        $csth = $pdo->prepare($csql);
        $csth->bindValue(":q", $_get_query, PDO::PARAM_INT);
        $csth->execute();
        $total = $csth->fetchColumn(PDO::FETCH_ASSOC);

        $pages = ceil($total / 10); // 総件数÷1ページに表示する件数 を切り上げたものが総ページ数
    
    } catch (PDOException $e) {
        
        $errorMessage = 'データベースエラー';
        $errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

    }

    

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
                <a href="/kiji.php?id=<?PHP echo $row['id']; ?>">
                    <?PHP echo $row['title']; ?>
                </a>
            </div>
        <?PHP endforeach; ?>

        <p><?PHP echo $errorMessage?></p>
    </div>
</body>

<footer>
    <div>
        <a href="/login.php">管理者ログイン</a>
    </div>
</footer>

</html>