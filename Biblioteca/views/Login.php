<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <title>Biblioteca</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link rel="shortcut icon" href="../assets/img/libro-digital.png" />
    <link href="../assets/css/Login.css" rel="stylesheet" />
  </head>
  <body>
    <main class="w-100 menu">

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

      <div class="container-fluid">
        <div class="p-4 mb-4 bg-light rounded-3 shadow-lg">
          <div class="container-fluid row">
            <div class="col-md-5 info">
              <h1 class="fw-bold mb-3">
                Biblioteca  Virtual
              </h1>
              <br>
              <br>
              <ul class="fs-5">
                <li>
                  Control efectivo de las actividades de la biblioteca.
                </li>
                <br>
                <li>
                  Integración de nuevas tecnologías y herramientas de vanguardia.
                </li>
                <br>
                <li>
                  Ayuda a incrementar la efectividad en las busquedas 
                </li>
                <br>
                <li>
                  Disponibilidad de mayor y mejor información para los usuarios en tiempo real.
                </li>
              </ul>
            </div>

            <div class="col-md-7">
              <form id="login" class="contenido" method="POST" action="../controllers/LoginController.php">
                <img
                  class="mb-5"
                  src="../assets/img/pila-de-libros.png"
                  alt=""
                  width="200"
                />
                <div class="form-floating mb-2">
                  <input
                    type="text"
                    class="form-control"
                    name="user-name"
                    placeholder="Usuario"
                    required
                  />
                  <label for="user-name">Nombre de Usuario</label>
                </div>
                <div class="form-floating mb-2">
                  <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Contraseña"
                    required
                  />
                  <label for="anio">Contraseña</label>
                </div>
                <button
                  class="w-100 btn btn-lg btn-primary mt-2 mb-4"
                  type="submit"
                  value="valor"
                  name="validar"
                >
                  Iniciar sesión
                </button>
               
                <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
   
  </body>
</html>

