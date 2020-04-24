<?php
require 'core/Load.php';
require_once 'core/database/InsertQuery.php';
require_once 'core/Tasks/TaskAction.php';

// Connection make and insert
$insert_query = new InsertQuery(Connection::make($config['database']));

// Getting the form action
$action = isset( $_POST['action'] ) ? $_POST['action'] : '';

// New boject create for Taskaction
$add_action = new TaskAction;

// New task add
$insert_task = $add_action->AddTask($action, $insert_query);

// mark Task as a complete
$complete_task = $add_action->compleTask($action, $insert_query);

// Remove Task
$delete_task = $add_action->deleteTask($action, $insert_query);

// Mark as incomplete task
$incomplete_task = $add_action->incompleteTask($action, $insert_query);

// Bulk Complete
$bulk_complete = $add_action->bulkComplete($action, $insert_query);

// Bulk Remove
$bulk_remove = $add_action->bulkDelete($action, $insert_query);