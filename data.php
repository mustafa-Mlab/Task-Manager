<?php

include_once "config.php";

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if( ! $connection ){
  throw new Exception("Database not connected");
}else{
  echo "Connected";
}