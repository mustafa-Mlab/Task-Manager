<?php

class Connection {
  public static function make($config){
    try{
      return new PDO(
        $config['host'] .';dbname='. $config['name'],
        $config['username'],
        $config['password'],
        $config['option']
      );
    }catch(PDOException $e){
      $e->getMessage();
    }
  }
}