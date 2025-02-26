<?php
    if(!isset($_GET['codigo'])){
        header('Location: ./views/Libros.php?mensaje=error');
        exit();
    }

    include_once '../config/database.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from libros where codigo = ?;");
    $sentencia->execute([$codigo]);
    $libro = $sentencia->fetch(PDO::FETCH_OBJ);
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
                <form class="p-4" method="POST" action="../controllers/Libros/editarP.php">
                    <div class="mb-3">
                        <label class="form-label">ISBN: </label>
                        <input type="text" class="form-control" name="ISBN" required 
                        value="<?php echo $libro->isbn; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Editorial: </label>
                        <input type="text" class="form-control" name="Editorial" required 
                        value="<?php echo $libro->editorial; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genero: </label>
                        <input type="text" class="form-control" name="Genero" autofocus required
                        value="<?php echo $libro->genero; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Año: </label>
                        <input type="text" class="form-control" name="Año" required 
                        value="<?php echo $libro->año; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor: </label>
                        <input type="text" class="form-control" name="Autor" autofocus required
                        value="<?php echo $libro->autor; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $libro->codigo; ?>">
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

