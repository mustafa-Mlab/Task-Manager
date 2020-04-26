<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( !$_user_id ){
  header("Location: /");
}
// Load Database
require 'core/Load.php';

require_once 'core/Database/IncompleteTask.php';
require_once 'core/Database/CompleteTask.php';
require_once 'core/tasks/CompleteTask.php';
require_once 'core/tasks/IncompleteTask.php';

$incomplete_task = new IncompleteTask(Connection::make($config['database']));
$incomplete_task_query = $incomplete_task->incomplete_task( $_user_id );

$complete_task = new CompleteTask(Connection::make($config['database']));
$complete_task_query = $complete_task->complete_task( $_user_id );
require 'views/tasks.view.php';