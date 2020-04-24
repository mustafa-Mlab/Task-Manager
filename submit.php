<?php
session_start();
require 'core/Load.php';
require_once 'functions.php';
require_once 'core/database/LoginRegistrationQuery.php';

$login_registration_query = new LoginRegistrationQuery(Connection::make($config['database']));
$action = isset( $_POST['action'] ) ? $_POST['action'] : '';
$statusCode = 0;
if( ! $action ){
  header('Location: index');
}else{
  if( 'registration' == $action ){
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
          header("Location: tasks");
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