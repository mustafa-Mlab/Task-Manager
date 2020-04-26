<?php

namespace TaskList\Core\Action;
use TaskList\Core\Database\{ LoginRegistrationQuery, Connection };
use TaskList\Core\Authenticate\Authenticate;

require 'core/Load.php';
require_once 'functions.php';
require "./vendor/autoload.php";

$login_registration_query = new LoginRegistrationQuery(Connection::make($config['database']));
$action = isset( $_POST['action'] ) ? $_POST['action'] : '';

if( ! $action ){
  header('Location: /');
}else{
  $authenticate = new Authenticate();
  
  //Login
  $login = $authenticate->login($action, $login_registration_query);
  
  //Registration
  $registration = $authenticate->registration($action, $login_registration_query);

}