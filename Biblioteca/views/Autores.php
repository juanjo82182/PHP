<?php
    include_once "../config/database.php";
    $sentencia = $bd -> query("select * from autores");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="en">

<head>
  <title>Autores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/img/editor.png" />
</head>

<body>
  <header>
      <input type="button" onclick="javascript:window.location='Administrador.php'" name="volver atrás" value="volver atrás">
      <br>
      <br>
      <h1 style="text-align: center;">Datos de Autores</h1>
      <br>
      <br>
  </header>
  <main>
     <!-- inicio alerta -->
     <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->
       <!-- Formulario para agregar autor-->
       <div class="container">
        <div class="row">
          <div class="col">
            <div class="card" style="width: 18rem;">
               <form id="Autor" class="contenido" method="POST" action="../controllers/Autores/registrar.php" style="text-align: center;" >
                <p>Agregar Autor</p>
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
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="Nombre"
                    placeholder="Nombre Completo"
                    required
                  />
                  <label for="Nombre">Nombre Completo</label>
                </div>
                <div class="form-floating mb-2 ">
                  <input
                    type="text"
                    class="form-control"
                    name="Nacionalidad"
                    placeholder="Nacionalidad"
                    required
                  />
                  <label for="Nacionalidad">Nacionalidad</label>
                </div>
                <input type="hidden" name="oculto" value="1">
                <button
                  class="w-50 btn btn-lg btn-primary mt-2 mb-4"
                  type="submit"
                  value="Registrar"
                  name="Registrar"
                >
                  Registrar
                </button>
               
              </form>
              </div>
            </div>  
              <!-- Tabla de Autores -->
         <div class="col order-1">  
            
              <div class="card" style="width: 50rem;">
                <div class="card-header">
                    Lista de Autores
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Nacionalidad</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                             
                            <?php 
                                foreach($persona as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->codigo; ?></td>
                                <td><?php echo $dato->cedula; ?></td>
                                <td><?php echo $dato->nombre; ?></td>
                                <td><?php echo $dato->nacionalidad; ?></td>
                                <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->codigo; ?>"><img src="../assets/img/archivo-de-registro.png" style="width: 2rem;"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="../controllers/Autores/eliminar.php?codigo=<?php echo $dato->codigo; ?>"><img src="../assets/img/borrar.png" style="width: 2rem;"></i></a></td>
                            </tr>

                            <?php 
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
