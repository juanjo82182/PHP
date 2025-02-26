<?php 
class login{
     

    public function verificar($user,$password){
        include '../config/database.php';

        $sentencia = $bd -> query("select * from usuario");
        $usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
        $tipo = 0;
           
             foreach($usuario as $dato){ 
                                
               if($dato->user == $user && $dato->password == $password ){
     
                  if($dato->tipo == 'administrador'){
                    $tipo = 1;
                  }
                  else{
                    $tipo = 2;
                  }
               }
               
              
              

              
    } 
    return $tipo;
    }

}

?>