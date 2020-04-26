<?php

namespace TaskList\Core\Tasks;

class TaskAction {
  public $user_id = 0;

  public function __construct() {
    session_start();
    $this->user_id = $_SESSION['id'];
  }
  
  // AddTask
  public function AddTask( $action, $insert_query ){
    if( 'add' == $action ){
      $task = $_POST['task'];
      $date = $_POST['date'];
      $user_id  = $_SESSION['id'];
  
      if( $task && $date && $user_id ){
        $insert_query->addTask( $task, $date, $user_id );
        header('Location: tasks?added=true');
      }
    }
  }

  // Mark task as complete
  public function compleTask( $action, $insert_query ){
    if( 'complete' == $action ){
    $taskid = $_POST['taskid'];
      if ( $taskid ){
        $insert_query->completeTask( $taskid );
        header('Location: tasks');
      }
    }
  }

  // Delete Task
  public function deleteTask($action, $insert_query){
    if( 'delete' == $action ){
      $taskid = $_POST['deleteid'];
      if( $taskid ){
        $insert_query->deleteTask( $taskid );
        header('Location: tasks');
      }
    }
  }

  // Mark as incomplete
  public function incompleteTask($action, $insert_query){
    if( 'incomplete' == $action ){
      $taskid = $_POST['incompleteid'];
      if( $taskid ){
        $insert_query->incompleteTask($taskid);
        header('Location: tasks');
      }
    }
  }

  // bulk complete
  public function bulkComplete($action, $insert_query){
    if( 'bulkcomplete' == $action ){
      $taskids = $_POST['ids'];
      $_taskid = join(',', $taskids);
      if( $taskids ){
        $bulkcomplete = $insert_query->bulkcomplete( $_taskid );
        header('Location: tasks');
      }
    }
  }

  // Bulk Remove
  public function bulkDelete($action, $insert_query){
    if( 'bulkdelete' == $action ){
      $taskids = $_POST['ids'];
      $_taskid = join(',', $taskids);
      if( $taskids ){
        $bulkdelete = $insert_query->bulkdelete( $_taskid );
        header('Location: tasks');
      }
    }
  }
  
}