<?php
session_start();
require_once 'config.php';
require_once 'functions.php';
require_once 'database/Connection.php';
require_once 'database/InsertQuery.php';
require_once 'database/LoginRegistrationQuery.php';

$insert_query = new InsertQuery(Connection::make($config['database']));
$login_registration_query = new LoginRegistrationQuery(Connection::make($config['database']));
$action = isset( $_POST['action'] ) ? $_POST['action'] : '';
$statusCode = 0;
if( ! $action ){
  header('Location: index.php');
}else{
  if( 'add' == $action ){
    $task = $_POST['task'];
    $date = $_POST['date'];
    $user_id  = $_SESSION['id'];

    if( $task && $date && $user_id ){
      $task_add = $insert_query->addTask( $task, $date, $user_id );
      header('Location: tasks.php?added=true');
    }
  }elseif( 'complete' == $action ){
    $taskid = $_POST['taskid'];
    if ( $taskid ){
      $complete = $insert_query->completeTask( $taskid );
      header('Location: tasks.php');
    }
  }elseif( 'delete' == $action ){
    $taskid = $_POST['deleteid'];
    if( $taskid ){
      $delete = $insert_query->deleteTask( $taskid );
      header('Location: tasks.php');
    }
  }elseif( 'incomplete' == $action ){
    $taskid = $_POST['incompleteid'];
    if( $taskid ){
      $incomplete = $insert_query->incompleteTask($taskid);
      header('Location: tasks.php');
    }
  }elseif( 'bulkcomplete' == $action ){
    $taskids = $_POST['ids'];
    $_taskid = join(',', $taskids);
    if( $taskids ){
      $bulkcomplete = $insert_query->bulkcomplete( $_taskid );
      header('Location: tasks.php');
    }
  }elseif( 'bulkdelete' == $action ){
    $taskids = $_POST['ids'];
    $_taskid = join(',', $taskids);
    if( $taskids ){
      $bulkdelete = $insert_query->bulkdelete( $_taskid );
      header('Location: tasks.php');
    }
  }elseif( 'registration' == $action ){
    $username = $_POST['emailfield'] ?? '';
    $password = $_POST['passwordfield'] ?? '';
    if( $username && $password ){
      $hash = password_hash( $password, PASSWORD_BCRYPT );
      $registration = $login_registration_query->registration($username, $hash);
      if( !$registration->execute() ){
        $statusCode = 1;
        header("Location: index.php?status={$statusCode}");
      }else{
        $registration->execute();
        $statusCode = 3;
        header("Location: index.php?status={$statusCode}");
      }
    }else{
      $statusCode = 2;
      header("Location: index.php?status={$statusCode}");
    }
  }elseif( 'login' == $action ){
    $username = $_POST['emailfield'] ?? '';
    $password = $_POST['passwordfield'] ?? '';
    if( $username && $password ){
      $get_login_details = $login_registration_query->login($username);
      if( !empty($get_login_details) ){
        $_id = $get_login_details['id'];
        $_password = $get_login_details['password'];
        if( password_verify($password, $_password) ){
          $_SESSION['id'] = $_id;
          header("Location: tasks.php");
          die();
        }else{
          $statusCode = 4;
          header("Location: index.php?status={$statusCode}");
        }
      }else{
        $statusCode = 5;
        header("Location: index.php?status={$statusCode}");
      }
    }else{
      $statusCode = 2;
      header("Location: index.php?status={$statusCode}");
    }
  }
}