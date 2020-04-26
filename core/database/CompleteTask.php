<?php

namespace TaskList\Core\Database;
use PDO;
class CompleteTask {
  protected $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }

  public function complete_task($user_id){
    $statement = $this->pdo->prepare("SELECT * FROM tasks WHERE complete = 1 AND user_id = {$user_id} ORDER BY date");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS, 'TaskList\Core\Tasks\CompleteTask');
  }
}