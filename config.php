<?php

$config =  [
  'database'   => [
    'name'     => 'task',
    'username' => 'root',
    'password' => 1,
    'host'     => 'mysql: host = 127.0.0.1',
    'option'   => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ]
];