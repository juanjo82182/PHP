<?php 

include_once '../models/Login.php';
    

    if(isset($_POST['user-name']) && isset($_POST['password'])){

      $buscar = new login();
      $tipo = $buscar->verificar($_POST['user-name'],$_POST['password']);

      if( $tipo == 1){

        header('Location: ../views/Administrador.php');
      }
      
      if($tipo == 2){

        header('Location: ../views/Empleado.php');
      }

      if($tipo == 0){
        header('Location: ../views/Login.php?mensaje=error');
      }
      
     }


?>