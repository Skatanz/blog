<?php

/**
 * データベース認証に関する処理
 * 
 * @param str $pdo
 */

Class Auth
{
    public $pdo;

    /**
     * コンストラクタ
     * $pdoにPDO文を代入
     * 
     * @param str $db
     */
    public function __construct($db)
    {
        $this->pdo = $db->pdo;
    }

    /**
     * 新規登録画面でのデータベースへの登録処理
     * 
     * @param str $mail
     * @param str $password
     * @return str $message
     */
    function signUp($mail, $password)
    {

        // データベースへの登録処理
        try {

            $stmt = $this->pdo->prepare("INSERT INTO user_table (mail, password) VALUES (?, ?)");

            $stmt->execute([$mail, password_hash($password, PASSWORD_DEFAULT)]);  // パスワードのハッシュ化を行う
            $userid = $this->pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $message = '登録が完了しました。あなたの登録IDは ' . $userid . ' です。パスワードは ' . $password . ' です。';  // ログイン時に使用するIDとパスワード

            return $message;

        } catch ( PDOException $e ) {
            $message = 'データベースエラー';
            //$message = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）

            return $message;
        }
    }

    /**
     * ログイン処理
     * @param str $mail
     * @param str $password
     * @return str $message
     */
    function login($mail, $password)
    {
        $sql = "SELECT * FROM user_table WHERE mail =:mail ";

        try {

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":mail", $mail);
            $stmt->execute();
            $pass = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (password_verify($password, $pass[ 0 ]['password']) ) {

                session_regenerate_id(true);
                $_SESSION['mail'] = $mail;

            } else {

                $_SESSION['error'] = "パスワードが違います";
                header("Location:/login.php");
                exit();
            }

        } catch ( PDOException $e ) {
            $message = 'データベースエラー';
            //$message = $e->getMessage(); // でエラー内容を参照可能（デバッグ時のみ表示）
        }
    }

    /**
     * ログアウト処理
     */
    function logout()
    {
        $_SESSION = array();
        // セッションを破壊する
        session_destroy();
    }
}

?>