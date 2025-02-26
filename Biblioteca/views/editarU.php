<?php
    if(!isset($_GET['codigo'])){
        header('Location: ./views/Usuarios.php?mensaje=error');
        exit();
    }

    include_once '../config/database.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from usuario where codigo = ?;");
    $sentencia->execute([$codigo]);
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">

<head>
  <title>Editar</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="../assets/img/archivo-de-registro.png" />
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="../controllers/Usuarios/editarP.php">
                    <div class="mb-3">
                        <label class="form-label">ID: </label>
                        <input type="text" class="form-control" name="ID" required 
                        value="<?php echo $usuario->id; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User_Name: </label>
                        <input type="text" class="form-control" name="User" required 
                        value="<?php echo $usuario->user; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password: </label>
                        <input type="text" class="form-control" name="Password" autofocus required
                        value="<?php echo $usuario->password; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo: </label>
                        <input type="text" class="form-control" name="Tipo" required 
                        value="<?php echo $usuario->tipo; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $usuario->codigo; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Bootstrap JavaScript Libraries -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>

