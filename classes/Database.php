<?php
class Database
{
  public function getConn()
  {
    $db_name = 'tictac';
    $db_host = 'localhost';
    $db_user = 'ttt_www';
    $db_pass = 'TY.N*nMIXFYw]3Io';

    $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

    return new PDO($dsn, $db_user, $db_pass);
  }
}
?>
