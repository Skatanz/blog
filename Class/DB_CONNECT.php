<?PHP

Class DB_CONNECT
{
    public $host;
    public $dbname;
    public $pdo;

        public function __construct()
        {
            $this->host = 'host='.getenv('DB_HOST');
            $this->dbname = 'dbname='.getenv('DB_DATABASE');
            $this->pdo = new PDO ("mysql:{$this->host};$this->dbname", getenv('DB_USERNAME'), getenv('DB_PASSWORD'), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);        
        }
}
?>