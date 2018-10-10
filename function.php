<?PHP

    //データベースの情報入手して返す
    function dbdata(){

        $db['host'] = "127.0.0.1";
        $db['dbname'] = "blog";
        $db['user'] = "root";
        $db['pass'] = "<fVYVyo+E4do";

        return $db;
    }

    //新規登録画面でのデータベースへの登録処理
    function signUp($db , $mail , $password){

        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // データベースへの登録処理
        try {
            $pdo = new PDO($dsn, $db['user'] , $db['pass'] , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO user_table (mail, password) VALUES (?, ?)");

            $stmt->execute(array($mail, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
            
            return $signUpMessage;

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
            
            return $errorMessage;
        }
    }

    //記事のデータベースへの登録処理
    function toukou($title , $content){

        $dsn = sprintf('mysql: host=127.0.0.1; dbname=blog; charset=utf8', 'root' , '<fVYVyo+E4do');

        try {
            $pdo = new PDO($dsn, 'root' , '<fVYVyo+E4do' , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    
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


?>