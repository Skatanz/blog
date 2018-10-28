<?PHP

session_start ();

/**
 * データベースの情報入手して返す
 * @return mixed
 */
function set_dbData ()

{

    $db[ 'host' ] = getenv('DB_HOST');
    $db[ 'dbname' ] = getenv('DB_DATABASE');
    $db[ 'user' ] = getenv('DB_USERNAME');
    $db[ 'pass' ] = getenv('DB_PASSWORD');

    return $db;
}




?>