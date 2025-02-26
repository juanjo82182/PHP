<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: ../../views/Libros.php?mensaje=error');
    }

    include '../../config/database.php';
    $codigo = $_POST['codigo'];
    $isbn = $_POST['ISBN'];
    $editorial = $_POST['Editorial'];
    $genero = $_POST['Genero'];
    $año = $_POST['Año'];
    $autor = $_POST['Autor'];

    $sentencia = $bd->prepare("UPDATE libros SET isbn = ?, editorial = ?, genero = ? , año = ? , autor = ?  where codigo = ?;");
    $resultado = $sentencia->execute([$isbn, $editorial, $genero, $año, $autor, $codigo]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Libros.php?mensaje=editado');
    } else {
        header('Location: ../../views/Libros.php?mensaje=error');
        exit();
    }
    
?>
