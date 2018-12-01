<?PHP

/**
 * DBへの接続処理
 * 
 */

Class DB_CONNECT
{
    const HOST = "127.0.0.1";
    const DBNAME = "blog";
    const USER = "root";
    const PASSWORD = "<fVYVyo+E4do";
    
    public $pdo;
    
    /**
     * PDO接続文の用意
     */
    public function __construct()
    {
        $host = 'host='.self::HOST;
        $dbname = 'dbname='.self::DBNAME;
        $this->pdo = new PDO("mysql:{$host};$dbname", self::USER, self::PASSWORD);
    }
}
?>