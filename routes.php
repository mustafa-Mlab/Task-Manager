<?php

// GET Routes
$router->get('', 'controllers/index.php');
$router->get('add-task', 'controllers/add-task.php');
$router->get('logout', 'controllers/logout.php');
$router->get('status', 'controllers/status.php');
$router->get('tasks', 'controllers/tasks.php');

// POST Routes
$router->post('submit', 'submit.php');
$router->post('index', 'index.php');
$router->post('taskaction', 'core/actions/task-action.php');
$router->post('authenticate', 'core/actions/authenticateAction.php');