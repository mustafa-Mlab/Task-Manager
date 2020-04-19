<?php
session_start();
include_once "config.php";
print_r($_REQUEST);
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if( ! $connection ){
  throw new Exception("Database could not connected");
}else{
  $action = isset( $_POST['action'] ) ? $_POST['action'] : '';
  $statusCode = 0;
  if( ! $action ){
    header('Location: index.php');
  }else{
    if( 'add' == $action ){
      $task = $_POST['task'];
      $date = $_POST['date'];
  
      if( $task && $date ){
        $query = "INSERT INTO " . DB_TABLE . "(task,date) VALUES('{$task}','{$date}')";
        mysqli_query($connection, $query);
        header('Location: index.php?added=true');
      }
    }elseif( 'complete' == $action ){
      $taskid = $_POST['taskid'];
      if ( $taskid ){
        $query = "UPDATE tasks SET complete = 1 WHERE id = {$taskid} LIMIT 1";
        mysqli_query( $connection, $query );
      }
      header('Location: index.php');
    }elseif( 'delete' == $action ){
      $taskid = $_POST['deleteid'];
      if( $taskid ){
        $query = "DELETE FROM tasks WHERE id={$taskid} LIMIT 1";
        mysqli_query( $connection, $query );
      }
      header('Location: index.php');
    }elseif( 'incomplete' == $action ){
      $taskid = $_POST['incompleteid'];
      if( $taskid ){
        $query = "UPDATE tasks SET complete = 0 WHERE id = {$taskid} LIMIT 1";
        mysqli_query( $connection, $query );
      }
      header('Location: index.php');
    }elseif( 'bulkcomplete' == $action ){
      $taskids = $_POST['ids'];
      $_taskid = join(',', $taskids);
      if( $taskids ){
        $query = "UPDATE tasks SET complete = 1 WHERE id in ($_taskid)";
        mysqli_query( $connection, $query );
      }
      header('Location: index.php');
    }elseif( 'bulkdelete' == $action ){
      $taskids = $_POST['ids'];
      $_taskid = join(',', $taskids);
      if( $taskids ){
        $query = "DELETE FROM tasks WHERE id in ($_taskid)";
        mysqli_query( $connection, $query );
      }
      header('Location: index.php');
    }elseif( 'registration' == $action ){
      $username = $_POST['emailfield'] ?? '';
      $password = $_POST['passwordfield'] ?? '';
      if( $username && $password ){
        $hash = password_hash( $password, PASSWORD_BCRYPT );
        $query = "INSERT INTO users(email, password) VALUES('{$username}', '{$hash}')";
        mysqli_query( $connection, $query );
        if( mysqli_error( $connection ) ){
          $statusCode = 1;
        }else{
          $statusCode = 3;
        }
      }else{
        $statusCode = 2;
        header("Location: index.php?status={$statusCode}");
      }
    }elseif( 'login' == $action ){
      $username = $_POST['emailfield'] ?? '';
      $password = $_POST['passwordfield'] ?? '';
      if( $username && $password ){
        $query = "SELECT id, password FROM users WHERE email = '{$username}'";
        $result = mysqli_query( $connection, $query );
        if( mysqli_num_rows( $result ) > 0 ){
          $data = mysqli_fetch_assoc( $result );
          $_id = $data['id'];
          $_password = $data['password'];
          if( password_verify($password, $_password) ){
            $_SESSION['id'] = $_id;
            header("Location: tasks.php");
            die();
          }else{
            $statusCode = 4;
          }
        }else{
          $statusCode = 5;
        }
      }else{
        $statusCode = 2;
        header("Location: index.php?status={$statusCode}");
      }
    }
  }
}
mysqli_close( $connection );