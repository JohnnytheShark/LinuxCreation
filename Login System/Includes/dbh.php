<?php

  $host = "localhost";
  $port = 5432;
  $dbname = "myDatabase";
  $user = "johnny";
  $password = "newDatabase21";

  $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
/*
  $stat = pg_connection_status($dbconn);
  if ($stat === PGSQL_CONNECTION_OK){
      echo 'liberty';
    }else {
    echo "connection failed";
    }

    if (!$dbconn){
    die("Connection Failed: ");
  }
*/
if(!$dbconn){
  die("Connection Failed");
  echo "Connection Failed";
}
?>
