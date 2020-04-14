<?php
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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1><a href="<?php echo 'index.php'; ?>">Task Manager</a></h1>
    <p>This is a simple project for managing our daily task</p>
    
    <?php
      if( mysqli_num_rows( $completeTaskresult ) > 0 ){
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
      while( $complete_data = mysqli_fetch_assoc( $completeTaskresult ) ){
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
      if( mysqli_num_rows( $result ) == 0 ){
        echo '<p>No Pending Task Found</p>';
      }else{
    ?>
    <h4>Upcomming Task</h4>
      <form action="tasks.php" method="post">
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
            while( $data = mysqli_fetch_assoc( $result ) ){
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
      mysqli_close($connection);
    ?>
    <p>....</p>
    <!-- Add Task -->
    <h2>Add Task</h2>
    <form method="post" action="tasks.php">
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
  <!-- complete form -->
  <form action="tasks.php" method="post" id="complete-form">
    <input type="hidden" name="action" value="complete">
    <input type="hidden" name="taskid" id="complete-data">
  </form>

  <!-- Delete form -->
  <form action="tasks.php" method="post" id="delete-form">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="deleteid" id="delete-data">
  </form>

  <!-- Mark incopmplete -->
  <form action="tasks.php" method="post" id="inomplete-form">
    <input type="hidden" name="action" value="incomplete">
    <input type="hidden" name="incompleteid" id="incomplete-data">
  </form>

</body>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./script.js"></script>
</html>