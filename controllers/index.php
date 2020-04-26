<?php

namespace TaskList\Controller;

session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( $_user_id ) {
  header('Location: tasks');
}
include_once "functions.php";

require 'views/index.view.php';

?>
