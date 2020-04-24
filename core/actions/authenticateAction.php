<?php
require 'core/Load.php';
require_once 'functions.php';
require_once 'core/database/LoginRegistrationQuery.php';
require_once 'core/authenticate/Authenticate.php';

$login_registration_query = new LoginRegistrationQuery(Connection::make($config['database']));
$action = isset( $_POST['action'] ) ? $_POST['action'] : '';

if( ! $action ){
  header('Location: index.php');
}else{
  $authenticate = new Authenticate();
  
  //Login
  $login = $authenticate->login($action, $login_registration_query);
  
  //Registration
  $registration = $authenticate->registration($action, $login_registration_query);

}