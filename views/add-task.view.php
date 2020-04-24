<?php require 'parcial/header.php'; ?>
<?php require 'parcial/nav.php'; ?>

  <div class="container">
    <h1><a href="<?php echo 'index.php'; ?>">Task Manager</a></h1>
    <p class="person-name">Welcome <span>Rasel</span></p>
    <p>...</p>
    <!-- Add Task -->
    <h2>Add Task</h2>
    <form method="post" action="taskaction">
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
<?php require 'parcial/footer.php'; ?>