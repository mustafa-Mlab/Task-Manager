<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( $_user_id ) {
  header('Location: tasks.php');
}
include_once "functions.php";

require 'views/index.view.php';

?>
