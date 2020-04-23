<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task List</title>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

  <div class="sidebar-menu">
    <ul>
      <li><a href="index">Home</a></li>
      <li><a href="tasks">Task List</a></li>
      <li><a href="add-task">Add Task</a></li>
      <li><a href="logout">Logout</a></li>
    </ul>
  </div>

  <div class="container">

    <h1><a href="<?php echo 'index.php'; ?>">Task Manager</a></h1>
    <p>This is a simple project for managing our daily task</p>
    <!-- Add Task -->
    <h2>Add Task</h2>
    <form method="post" action="submit.php">
      <fieldset>
      <?php
        $added = $_GET['added'] ?? '';
        if( $added ){
          echo '<p>Task successfully added</p>';
        }
      ?>
        <label for="task">Task</label>
        <input type="text" name="task" id="task" placeholder="Task Details">
        <label for="date">Date</label>
        <input type="text" id="date" name="date" placeholder="Task Date">
        <input type="submit" value="Add Task" class="button-primany">
        <input type="hidden" name="action" value="add">
      </fieldset>
    </form>
  </div>

</body>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
</html>