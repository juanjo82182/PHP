<?php 


class empleado{


    public function buscar($cedula){
        include '../config/database.php';

        $sentencia = $bd -> query("select * from autores");
        $autor = $sentencia->fetchAll(PDO::FETCH_OBJ);
           
             foreach($autor as $dato){ 
                                
               if($dato->cedula == $cedula ){
    
                $nombre = $dato->nombre;
               }  
    } 

     return $nombre;
    }

}

?>