<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( !$_user_id ){
  header("Location: index.php");
}

require_once 'Database/Connection.php';
require_once 'Database/IncompleteTask.php';
require_once 'Database/CompleteTask.php';

$incomplete_task = new IncompleteTask(Connection::make());
$incomplete_task_query = $incomplete_task->incomplete_task( $_user_id );

$complete_task = new CompleteTask(Connection::make());
$complete_task_query = $complete_task->complete_task( $_user_id );
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
    
    <?php
      if( !empty( $complete_task_query ) ){
        ?>
          <h4>Complete Task</h4>
          <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Task</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
        <?php
      }
      foreach( $complete_task_query as $complete_data ){
        $timespamt = strtotime( $complete_data['date'] );
        $date = date("jS M, Y", $timespamt);
        ?>
          <tr>
            <td><?php echo $complete_data['id']; ?></td>
            <td><?php echo $complete_data['task']; ?></td>
            <td><?php echo $date; ?></td>
            <td><a href="#" data-taskdelete="<?php echo $complete_data['id']; ?>" class="delete-task">Delete</a> | <a href="#" data-taskincomplete="<?php echo $complete_data['id']; ?>" class="task-incomplete">Mark incomplete</a></td>
          </tr>
        <?php
      }
    ?>
      </tbody>
    </table>
    <p>....</p>
    <?php
      if( empty($incomplete_task_query) ){
        echo '<p>No Pending Task Found</p>';
      }else{
    ?>
    <h4>Upcomming Task</h4>
      <form action="submit.php" method="post">
        <table>
          <thead>
            <tr>
              <th></th>
              <th>ID</th>
              <th>Task</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- row data from database -->
            <?php
            foreach($incomplete_task_query as $data){
            $timespamt = strtotime( $data['date'] );
            $date = date("jS M, Y", $timespamt);
            ?>
              <tr>
                <td><input type="checkbox" name="ids[]" class="label-inline" value="<?php echo $data['id']; ?>"></td>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['task']; ?></td>
                <td><?php echo $date; ?></td>
                <td><a href="#" data-taskdelete="<?php echo $data['id']; ?>" class="delete-task">Delete</a> | <a href="#" data-taskid="<?php echo $data['id'] ?>" class="task-complete">complete</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <select name="action" id="bulkaction">
          <option value="0">With Selected</option>
          <option value="bulkdelete">Delete</option>
          <option value="bulkcomplete">Mark as complete</option>
        </select>
        <input type="submit" id="bulksubmit" value="Submit" class="button-primary">
      </form>
    <?php 
      }
      // mysqli_close($connection);
    ?>
    <p>....</p>
  </div>
  <!-- complete form -->
  <form action="submit.php" method="post" id="complete-form">
    <input type="hidden" name="action" value="complete">
    <input type="hidden" name="taskid" id="complete-data">
  </form>

  <!-- Delete form -->
  <form action="submit.php" method="post" id="delete-form">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="deleteid" id="delete-data">
  </form>

  <!-- Mark incopmplete -->
  <form action="submit.php" method="post" id="inomplete-form">
    <input type="hidden" name="action" value="incomplete">
    <input type="hidden" name="incompleteid" id="incomplete-data">
  </form>

</body>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
</html>