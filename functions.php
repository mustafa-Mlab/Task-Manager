<?php

function getStatus( $statusCode = 0 ){
  $status = [
      '0' => '',
      '1' => 'Duplicate Email Address',
      '2' => 'Username or Password Empty',
      '3' => 'Registration successfully completed',
      '4' => 'username and password didn\'t match',
      '5' => 'user dosen\'t exist'
  ];
  return $status[$statusCode];
}