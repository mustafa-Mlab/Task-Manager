<?php require 'parcial/header.php'; ?>
  <div class="logo-wrapper">
    <h1 class="heading"><a href="">My Tasks</a></h1>
    <p class="tagline">A Task Manager System</p>
  </div>

  <div class="login-area">
    <p class="login"><a href="#" id="login">Login</a> | <a href="#" id="register">Register</a></p>
    <form action="submit.php" method="post" id="login-registration-form">
      <fieldset>
        <h2 class="login-title">LOGIN</h2>
        <!-- <label for="name">Name</label>
        <input type="text" name="name" placeholder="your name"> -->
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
<?php require 'parcial/footer.php'; ?>