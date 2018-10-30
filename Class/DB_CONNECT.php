<?PHP

Class DB_CONNECT
{
    const HOST = getenv('DB_HOST');
    const DBNAME = getenv('DB_DATABASE');
    const USER = getenv('DB_USERNAME');
    const PASSWORD = getenv('DB_PASSWORD');

    public $pdo;

        public function __construct()
        {
            $host = 'host='.self::HOST;
            $dbname = 'dbname='.self::DBNAME;
            $this->pdo = new PDO ("mysql:{$host};$dbname", self::USER, self::PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);        
        }
}
?>