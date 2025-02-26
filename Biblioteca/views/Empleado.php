<?php
    if(isset($_GET['mensaje'])  != ''){
    include_once '../config/database.php';

    $nombre= $_GET['mensaje'];

    $sentencia = $bd->query("select * from libros where autor = '$nombre' ");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

?>
<!doctype html>
<html lang="en">

<head>
  <title>Empleados</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/img/agente.png" />
</head>

<body>
  <header>
    <!-- place navbar here -->
    <a class="text-success" href="Login.php"><img src="../assets/img/salida-de-emergencia.png" style="width: 4rem;margin-left:1250px;"></i></a>
    <br>
      <br>
      <h1 style="text-align: center;">Busqueda de Libros</h1>
      <br>
      <br>
  </header>
  <main>
  <div class="container">
        <div class="row">
          <div class="col">
            <div class="card" style="width: 18rem;">
               <form id="empleado" class="contenido" method="POST" action="../controllers/EmpleadoController.php" style="text-align: center;" >
                <p>Reporte de Autores</p>
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="Cedula"
                    placeholder="Cedula"
                    required
                  />
                  <label for="Cedula">Cedula</label>
                </div>
                
                <input type="hidden" name="oculto" value="1">
                <button
                  class="w-50 btn btn-lg btn-primary mt-2 mb-4"
                  type="submit"
                  value="Buscar"
                  name="Buscar"
                >
                  Buscar
                </button>
               
              </form>
              </div>
            </div>  
              <!-- Tabla de Libros -->
         <div class="col order-1">  
            
              <div class="card" style="width: 50rem;">
                <div class="card-header">
                    Lista de Autores y libros
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Editorial</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Año</th>
                            </tr>

                            <?php 
                                if(isset($_GET['mensaje'])  != ''){
                                foreach($persona as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->codigo; ?></td>
                                <td><?php echo $dato->autor; ?></td>
                                <td><?php echo $dato->isbn; ?></td>
                                <td><?php echo $dato->editorial; ?></td>
                                <td><?php echo $dato->genero; ?></td>
                                <td><?php echo $dato->año; ?></td>
                                
                            <?php 
                                }
                              }
                            ?>
                             
                           
                            
                          
                    </table>

                    
                </div>
        </div>
      </div> 
     </div>  
    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
