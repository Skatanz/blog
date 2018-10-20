<?PHP

session_start ();

/**
 * データベースの情報入手して返す
 * @return mixed
 */
function set_dbData ()
{

    $db[ 'host' ] = "127.0.0.1";
    $db[ 'dbname' ] = "blog";
    $db[ 'user' ] = "root";
    $db[ 'pass' ] = "<fVYVyo+E4do";

    return $db;
}


Class Auth
{
    private $db;
    private $dsn;
    private $pdo;

    /**
     * Auth constructor.
     * @param $db
     */
    public function __construct ( $db )
    {
        $this->db = $db;
        $this->dsn = sprintf ( 'mysql: host=%s; dbname=%s; charset=utf8', $db[ 'host' ], $db[ 'dbname' ] );
        $this->pdo = new PDO( $this->dsn, $this->db[ 'user' ], $this->db[ 'pass' ],
                              array ( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
    }

    /**
     * 新規登録画面でのデータベースへの登録処理
     * @param $db
     * @param $mail
     * @param $password
     * @return string
     */

    function signUp ( $mail, $password )
    {

        // データベースへの登録処理
        try {

            $stmt = $this->pdo->prepare ( "INSERT INTO user_table (mail, password) VALUES (?, ?)" );

            $stmt->execute ( array ( $mail, password_hash ( $password, PASSWORD_DEFAULT ) ) );  // パスワードのハッシュ化を行う
            $userid = $this->pdo->lastinsertid ();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。あなたの登録IDは ' . $userid . ' です。パスワードは ' . $password . ' です。';  // ログイン時に使用するIDとパスワード

            return $signUpMessage;

        } catch ( PDOException $e ) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }
    }

    /**
     * ログイン処理
     * @param $db
     * @param $mail
     * @param $password
     */
    function login ( $mail, $password )
    {

        $sql = "SELECT * FROM user_table WHERE mail =:mail ";

        try {

            //sqlクエリの実行
            $stmt = $this->pdo->prepare ( $sql );
            $stmt->bindValue ( ":mail", $mail );
            $stmt->execute ();
            $pass = $stmt->fetchAll ( PDO::FETCH_ASSOC );

            if ( password_verify ( $password, $pass[ 0 ][ 'password' ] ) ) {

                session_regenerate_id ( true );
                $_SESSION[ 'mail' ] = $mail;

            } else {

                $_SESSION[ 'error' ] = "パスワードが違います";
                header ( "Location:/login.php" );
                exit();
            }

        } catch ( PDOException $e ) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
        }
    }

    function logout()
    {
        //ログアウト処理
        $_SESSION = array ();
        // 最終的に、セッションを破壊する
        session_destroy ();
    }
}

Class Article
{

    private $db;
    private $dsn;
    private $pdo;

    /**
     * Auth constructor.
     * @param $db
     */
    public function __construct ( $db )
    {
        $this->db = $db;
        $this->dsn = sprintf ( 'mysql: host=%s; dbname=%s; charset=utf8', $db[ 'host' ], $db[ 'dbname' ] );
        $this->pdo = new PDO( $this->dsn, $this->db[ 'user' ], $this->db[ 'pass' ],
                              array ( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
    }

    /**
     * 記事のデータベースへの登録処理
     * @param $db
     * @param $title
     * @param $content
     * @return string
     */

    function contribute ( $title, $content )
    {

        // データベースへの登録処理
        try {

            $stmt = $this->pdo->prepare ( "INSERT INTO content_table (title, content) VALUES (?, ?)" );
            $stmt->execute ( array ( $title, $content ) );

            $artUpMessage = '投稿が完了しました。';

            return $artUpMessage;

        } catch ( PDOException $e ) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }
    }

    /**
     * 記事一覧取得処理
     * @param $getPage
     * @return array|string
     */
    function get_contents ( $getPage )
    {
        $sql = "SELECT * FROM content_table ORDER BY created_at DESC LIMIT :start,5 ";

        // データベースからコンテンツを全件取得
        try {

            $stmt = $this->pdo->prepare ( $sql );
            $stmt->bindValue ( ":start", ( $getPage - 1 ) * 5, PDO::PARAM_INT );
            $stmt->execute ();
            $contents = $stmt->fetchAll ( PDO::FETCH_ASSOC );

            return $contents;

        } catch ( PDOException $e ) {
            $errorMessage = 'データベースエラー';
            //$e->getMessage (); //でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }
    }

    /**
     * ページ数取得処理
     * @return float|string
     */
    function get_total_page ()
    {
        $sql = "SELECT COUNT(id) FROM content_table "; // 総件数カウント用SQL

        try {

            // 総件数カウント用SQLを、プリペアドステートメントで実行
            $stmt = $this->pdo->query ( $sql );
            $total = $stmt->fetchColumn ();
            $pages = ceil ( $total / 5 ); // 総件数÷1ページに表示する件数 を切り上げたものが総ページ数

            return $pages;

        } catch ( PDOException $e ) {

            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }
    }

    /**
     * 記事の内容取得処理
     * @param $_get_id
     * @return array|string
     */
    function get_content ( $_get_id )
    {
        $sql = "SELECT * FROM content_table WHERE id =:id ";

        //データベースからidに対応したコンテンツを取得
        try {

            $stmt = $this->pdo->prepare ( $sql );
            $stmt->bindValue ( ":id", $_get_id, PDO::PARAM_INT );
            $stmt->execute ();
            $content = $stmt->fetchAll ( PDO::FETCH_ASSOC );

            return $content;

        } catch ( PDOException $e ) {

            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }
    }

    /**
     * 記事の更新処理
     * @param $idUpdate
     * @param $titleUpdate
     * @param $contentUpdate
     * @return string
     */

    function update ( $idUpdate, $titleUpdate, $contentUpdate )
    {
        $sql = "UPDATE content_table SET title =:title , content =:content  WHERE id =:id ";

        try {

            $stmt = $this->pdo->prepare ( $sql );
            $stmt->bindValue ( ":title", $titleUpdate );
            $stmt->bindValue ( ":content", $contentUpdate );
            $stmt->bindValue ( ":id", $idUpdate, PDO::PARAM_INT );
            $stmt->execute ();

            $message = "更新しました";

            return $message;

        } catch ( PDOException $e ) {

            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }
    }

    /**
     * 記事の削除処理
     * @param $idDelete
     * @return string
     */
    function delete ( $idDelete )
    {
        $sql = " DELETE FROM content_table WHERE id =:id ";

        try {

            $stmt = $this->pdo->prepare ( $sql );
            $stmt->bindValue ( ":id", $idDelete, PDO::PARAM_INT );
            $stmt->execute ();

            $message = "削除しました";

            return $message;

        } catch ( PDOException $e ) {

            $errorMessage = 'データベースエラー';
            //$errorMessage = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

            return $errorMessage;
        }

    }
}
?>