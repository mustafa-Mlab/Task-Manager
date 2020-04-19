<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
echo $_user_id;
if( !$_user_id ){
  header("Location: index.php");
}
require_once 'config.php';
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if( ! $connection ){
  throw new Exception("Database not connected");
}
$query = "SELECT * FROM tasks WHERE complete = 0 ORDER BY date";
$result = mysqli_query( $connection, $query );

$completeTaskQuery = "SELECT * FROM tasks WHERE complete = 1 ORDER BY date";
$completeTaskresult = mysqli_query( $connection, $completeTaskQuery );
?>
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
      <li><a href="index.php">Home</a></li>
      <li><a href="tasks.php">Task List</a></li>
      <li><a href="add-task.php">Add Task</a></li>
      <li><a href="logout.php">Logout</a></li>
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