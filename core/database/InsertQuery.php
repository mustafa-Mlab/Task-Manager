<?php

namespace TaskList\Core\Database;

Class InsertQuery{
  protected $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }

  public function addTask($task, $date, $user_id){
    $statemet = $this->pdo->prepare("INSERT INTO tasks(task,date, user_id) VALUES('{$task}','{$date}', '{$user_id}')");
    return $statemet->execute();
  }

  public function completeTask($taskid){
    $statemet = $this->pdo->prepare("UPDATE tasks SET complete = 1 WHERE id = {$taskid} LIMIT 1");
    return $statemet->execute();
  }

  public function deleteTask($taskid){
    $statemet = $this->pdo->prepare("DELETE FROM tasks WHERE id={$taskid} LIMIT 1");
    return $statemet->execute();
  }

  public function incompleteTask($taskid){
    $statemet = $this->pdo->prepare("UPDATE tasks SET complete = 0 WHERE id = {$taskid} LIMIT 1");
    return $statemet->execute();
  }

  public function bulkcomplete($taskid){
    $statemet = $this->pdo->prepare("UPDATE tasks SET complete = 1 WHERE id in ($taskid)");
    return $statemet->execute();
  }

  public function bulkdelete($taskid){
    $statemet = $this->pdo->prepare("DELETE FROM tasks WHERE id in ($taskid)");
    return $statemet->execute();
  }
}