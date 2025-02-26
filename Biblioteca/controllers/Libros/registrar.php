<?php
  

    include_once '../../config/database.php';
    $isbn = $_POST['ISBN'];
    $editorial = $_POST['Editorial'];
    $genero = $_POST['Genero'];
    $año = $_POST['Año'];
    $autor = $_POST['Autor'];
    
    $sentencia = $bd->prepare("INSERT INTO libros(isbn,editorial,genero,año,autor) VALUES (?,?,?,?,?);");
    $resultado = $sentencia->execute([$isbn, $editorial, $genero, $año, $autor]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Libros.php?mensaje=registrado');
    } else {
        header('Location: ../../views/Libros.php?mensaje=error');
        exit();
    }
    
?>