<!doctype html>
<html lang="en">

<head>
  <title>Sopa de Letras</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="./assets/img/juego-de-ordenador.png" />
    <link rel="stylesheet" href="./assets/css/style.css">
    

</head>

<body >
  <header>
    <!-- place navbar here -->
  </header>
  <main class="w-100 menu">

  <div class="container-fluid">
        <div class="p-4 mb-4 bg-light rounded-3 shadow-lg">
          <div class="container-fluid row">
            
            <div class="colcont">
              <form id="menu" class="contenido" action="./Controllers/redireccion.php" method="post">
                <img
                  class="mb-5"
                  src="./assets/img/palabra1.png"
                  alt=""
                  width="200"
                />
                <div class="form-floating mb-2">
                 <p class="lead">Descubre las palabras ocultas en esta sopa de letras. Puedes buscar palabras en cualquier dirección. ¡Demuestra tu habilidad para encontrar palabras en esta divertida sopa de letras!</p>
                </div>
               
                <div class="form-floating mb-2">
                    
                  <input  name="submit" value="Iniciar" src="./assets/img/boton-de-inicio.png" type="image" style="width: 4rem;">
                </div>
                <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
              </form>
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