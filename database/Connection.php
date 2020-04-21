<?php

class Connection{
  public static function make(){
    try{
      return new PDO('mysql:host=127.0.0.1;dbname=task', 'root', '1');
    }catch(PDOException $e){
      $e->getMessage();
    }
  }
}