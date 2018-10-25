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



?>