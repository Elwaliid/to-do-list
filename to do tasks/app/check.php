<?php
if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

        if(empty($id)){
            echo 'error';
        }else{
          $todo = $conn->prepare("SELECT id, checked FROM todo WHERE id=?");
          $todo->execute([$id]);
          $todos = $todo->fetch();
          $uId=$todos['id'];
          $checked = $todos['checked'];
          $uChecked = $checked? 0 : 1;
          $res = $conn->query("UPDATE todo SET checked=$uChecked WHERE id=$uId ");
          if($res){
            echo $checked;
          }else {
            echo "error";
          }
            $conn=null;
            exit();
        }
    }else
    { header("Location: ../index.php?mess=error");}