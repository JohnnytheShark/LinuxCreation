<?php

  $host = "localhost";
  $port = 5432;
  $dbname = "myDatabase";
  $user = "postgres";
  $password = "newDatabase21";

  $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

  $stat = pg_connection_status($dbconn);
  if ($stat === PGSQL_CONNECTION_OK){
  echo 'liberty';
  }else {
    echo "connection failed";
  }

  if (!$dbconn){
    die("Connection Failed: ");
  }

?>
