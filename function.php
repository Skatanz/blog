<?PHP
    session_start();

    //データベースの情報入手して返す
    function get_dbdata()
    {

        $db['host'] = "127.0.0.1";
        $db['dbname'] = "blog";
        $db['user'] = "root";
        $db['pass'] = "<fVYVyo+E4do";

        return $db;
    }

    //新規登録画面でのデータベースへの登録処理
    function signUp($db , $mail , $password)
    {

        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // データベースへの登録処理
        try {
            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO user_table (mail, password) VALUES (?, ?)");

            $stmt->execute(array($mail, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
            
            return $signUpMessage;

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
            
            return $errorMessage;
        }
    }

    //ログイン処理
    function login($db, $mail, $password)
    {
        
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $sql = "SELECT * FROM user_table WHERE mail =:mail ";

        // ユーザ認証
        try {
            //データベースへ接続
            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            //sql処理の準備

            //sqlクエリの実行
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":mail", $mail);
            $stmt->execute();
            $pass = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (password_verify($password, $pass[0]['password'])){
             
                session_regenerate_id(true);
                $_SESSION['mail'] = $mail;

            } else {

                $_SESSION['error'] = "パスワードが違います";
                header("Location:/login.php");
                exit();
            }

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
        }
    }

    //記事のデータベースへの登録処理
    function toukou($db , $title , $content)
    {

        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // データベースへの登録処理
        try {
            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
            $stmt = $pdo->prepare("INSERT INTO content_table (title, content) VALUES (?, ?)");
            $stmt->execute(array($title,$content));
    
            $kijiUpMessage = '投稿が完了しました。';

            return $kijiUpMessage;
        
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }            
    }

    //記事取得処理
    function get_contents($db, $getPage)
    {
        
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $sql = "SELECT * FROM content_table ORDER BY created_at DESC LIMIT :start,5 ";

        // データベースからコンテンツを全件取得
        try {
            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
            $sth = $pdo->prepare($sql);
            $sth->bindValue(":start", ($getPage - 1) * 5, PDO::PARAM_INT);
            $sth->execute();
            $contents = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $contents;
        
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            $e->getMessage(); //でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }            
    }

    //ページ数取得処理
    function get_total_page($db)
    {
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $sql = "SELECT COUNT(id) FROM content_table "; // 総件数カウント用SQL

        try{

            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
            // 総件数カウント用SQLを、プリペアドステートメントで実行
            $stmt = $pdo->query($sql);
            $total = $stmt->fetchColumn();
            $pages = ceil($total / 5); // 総件数÷1ページに表示する件数 を切り上げたものが総ページ数
 
            return $pages;

        } catch (PDOException $e) {
            
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
            
            return $errorMessage;
        }
    }

    function get_content($db , $_get_id)
    {
        
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $sql = "SELECT * FROM content_table WHERE id =:id ";

        //データベースからidに対応したコンテンツを取得
        try{

            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id" , $_get_id , PDO::PARAM_INT);
            $stmt->execute();
            $content = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $content;

        } catch (PDOException $e) {
            
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
            
            return $errorMessage;
        }
    }

    //記事の更新処理
    function kiji_update($db, $idUpdate, $titleUpdate, $contentUpdate)
    {
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $sql = "UPDATE content_table SET title =:title , content =:content  WHERE id =:id ";
        
        try{

            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":title" , $titleUpdate);
            $stmt->bindValue(":content" , $contentUpdate);
            $stmt->bindValue(":id" , $idUpdate , PDO::PARAM_INT);
            $stmt->execute();

            $message = "更新しました";
            
            return $message;

        } catch (PDOException $e) {
            
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
            
            return $errorMessage;
        }
    }

    //記事の削除処理
    function kiji_delete($db, $idDelete)
    {
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        $sql = " DELETE FROM content_table WHERE id =:id ";
        
        try{

            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id" , $idDelete , PDO::PARAM_INT);
            $stmt->execute();

            $message = "削除しました";
            
            return $message;

        } catch (PDOException $e) {
            
            $errorMessage = 'データベースエラー';
            $errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
            
            return $errorMessage;
        }

    }

?>