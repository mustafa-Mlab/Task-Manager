<?php

namespace TaskList\Core\Database;
use PDO;

class IncompleteTask {
  protected $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }

  public function incomplete_task($user_id){
    $statemant = $this->pdo->prepare("SELECT * FROM tasks WHERE complete = 0 AND user_id = {$user_id} ORDER BY date");
    $statemant->execute();
    return $statemant->fetchAll(PDO::FETCH_CLASS, 'TaskList\Core\Tasks\IncompleteTask');
  }
}