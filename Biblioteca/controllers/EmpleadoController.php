<?php 
    

    include '../models/Empleado.php';
    

    if(isset($_POST['Cedula'])){

      $buscar = new empleado();
      $nombre = $buscar->buscar($_POST['Cedula']);

      header('Location: ../views/Empleado.php?mensaje='. $nombre.'');
    
     }

       
 
  
   
    
?>