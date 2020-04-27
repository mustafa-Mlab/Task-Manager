<?php

namespace TaskList\Core\Authenticate;

class Authenticate {
  // public $user_id = 0;
  public $statusCode = 0;
  public function __construct(){
    session_start();
    // $this->user_id = $_SESSION['id'];
  }

  // login
  public function login( $action, $login_registration_query ){
    if('login' == $action){
      $username = $_POST['emailfield'] ?? '';
      $password = $_POST['passwordfield'] ?? '';
      if( $username && $password ){
        $get_login_details = $login_registration_query->login($username);
        if( !empty( $get_login_details ) ){
          $_id = $get_login_details['id'];
          $_password = $get_login_details['password'];
          if( password_verify($password, $_password) ){
            $_SESSION['id'] = $_id;
            header("Location: tasks");
            die();
          }else{
            $statusCode = $this->statusCode = 4; // username and password didn't match
            header("Location: /?status={$statusCode}");
          }
        }else{
          $statusCode = $this->statusCode = 5; // user dosen't exist
          header("Location: /?status={$statusCode}");
        }
      }else{
        $statusCode = $this->statusCode = 2; // Username or Password Empty
        header("Location: /?status={$statusCode}");
      }
    }
  }

  // Registration
  public function registration( $action, $login_registration_query ){
    if( 'registration' == $action ){
      $username = $_POST['emailfield'] ?? '';
      $password = $_POST['passwordfield'] ?? '';
      if( $username && $password ){
        $hash = password_hash( $password, PASSWORD_BCRYPT );
        $fetch_username = $login_registration_query->getEmail( $username );
        var_dump($fetch_username);
        if( $fetch_username == false ){
          $login_registration_query->registration($username, $hash);
          $statusCode = $this->statusCode = 3; // Registration successfully completed
          header("Location: /?status={$statusCode}");
        }else{
          $statusCode = $this->statusCode = 1; // Duplicate Email Address
          header("Location: /?status={$statusCode}");
        }
      }
    }
  }

}