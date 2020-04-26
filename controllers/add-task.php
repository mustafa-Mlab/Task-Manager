<?php

namespace TaskList\Controller;

session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( !$_user_id ){
  header("Location: /");
}
// Load Database
require 'core/Load.php';

require 'views/add-task.view.php';