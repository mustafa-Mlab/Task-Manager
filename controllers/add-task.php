<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( !$_user_id ){
  header("Location: index.php");
}
// Load Database
require 'core/Load.php';

require 'views/add-task.view.php';