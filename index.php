<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
if( $_user_id ) {
  header('Location: tasks.php');
}
include_once "functions.php";
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
  <h1 class="heading"><a href="index.php">My Tasks</a></h1>
  <p class="tagline">A Task Manager System</p>

  <div class="login-area">
    <p class="login"><a href="#" id="login">Login</a> | <a href="#" id="register">Register</a></p>
    <form action="submit.php" method="post" id="login-registration-form">
      <fieldset>
        <h2 class="login-title">LOGIN</h2>
        <label for="emailfield">Email</label>
        <input type="email" name="emailfield" placeholder="your email">
        <label for="passwordfield">Password</label>
        <input type="password" name="passwordfield" id="password" placeholder="your password">
          <?php
            $status = $_GET['status'] ?? '';
            if ( $status ){ 
            ?>
            <blockquote>
              <p><?php echo getStatus( $status ); ?></p>
            </blockquote>            
            <?php
            }
          ?>  
        <input type="hidden" id="action" name="action" value="login">
        <input type="submit" value="Submit">
      </fieldset>
    </form>
  </div>
</body>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
</html>