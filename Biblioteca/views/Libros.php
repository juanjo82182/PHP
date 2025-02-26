<?php
    include_once "../config/database.php";
    $sentencia = $bd -> query("select * from libros");
    $libro = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="en">

<head>
  <title>Libros</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/img/libro-abierto.png" />
</head>

<body>
  <header>
      <input type="button" onclick="javascript:window.location='Administrador.php'" name="volver atrás" value="volver atrás">
      <br>
      <br>
      <h1 style="text-align: center;">Datos de Libros</h1>
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
               <form id="Libro" class="contenido" method="POST" action="../controllers/Libros/registrar.php" style="text-align: center;" >
                <p>Agregar Libro</p>
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="ISBN"
                    placeholder="ISBN"
                    required
                  />
                  <label for="ISBN">ISBN</label>
                </div>
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="Editorial"
                    placeholder="Editorial"
                    required
                  />
                  <label for="Editorial">Editorial</label>
                </div>
                <div class="form-floating mb-2 ">
                  <input
                    type="text"
                    class="form-control"
                    name="Genero"
                    placeholder="Genero"
                  />
                  <label for="Genero">Genero</label>
                </div>
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="Año"
                    placeholder="Año de Publicacion"
                    required
                  />
                  <label for="Año">Año de Publicacion</label>
                </div>
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="Autor"
                    placeholder="Nombre Completo"
                    required
                  />
                  <label for="Autor">Autor</label>
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
                    Lista de Libros
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ISBN</th>
                                <th scope="col">Editorial</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Año</th>
                                <th scope="col">Autor</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                             
                            <?php 
                                foreach($libro as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->codigo; ?></td>
                                <td><?php echo $dato->isbn; ?></td>
                                <td><?php echo $dato->editorial; ?></td>
                                <td><?php echo $dato->genero; ?></td>
                                <td><?php echo $dato->año; ?></td>
                                <td><?php echo $dato->autor; ?></td>
                                <td><a class="text-success" href="editarL.php?codigo=<?php echo $dato->codigo; ?>"><img src="../assets/img/archivo-de-registro.png" style="width: 2rem;"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="../controllers/Libros/eliminar.php?codigo=<?php echo $dato->codigo; ?>"><img src="../assets/img/borrar.png" style="width: 2rem;"></i></a></td>
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
