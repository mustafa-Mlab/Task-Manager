<?php require 'parcial/header.php'; ?>
<?php require 'parcial/nav.php'; ?>

  <div class="container">
    <h1><a href="<?php echo '/'; ?>">Task Manager</a></h1>
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
        $timespamt = strtotime( $complete_data->date );
        $date = date("jS M, Y", $timespamt);
        ?>
          <tr>
            <td><?php echo $complete_data->id; ?></td>
            <td><?php echo $complete_data->task; ?></td>
            <td><?php echo $date; ?></td>
            <td><a href="#" data-taskdelete="<?php echo $complete_data->id; ?>" class="delete-task">Delete</a> | <a href="#" data-taskincomplete="<?php echo $complete_data->id; ?>" class="task-incomplete">Mark incomplete</a></td>
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
            $timespamt = strtotime( $data->date );
            $date = date("jS M, Y", $timespamt);
            ?>
              <tr>
                <td><input type="checkbox" name="ids[]" class="label-inline" value="<?php echo $data->id; ?>"></td>
                <td><?php echo $data->id; ?></td>
                <td><?php echo $data->task; ?></td>
                <td><?php echo $date; ?></td>
                <td><a href="#" data-taskdelete="<?php echo $data->id; ?>" class="delete-task">Delete</a> | <a href="#" data-taskid="<?php echo $data->id; ?>" class="task-complete">complete</a></td>
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

<?php require 'parcial/footer.php'; ?>