<?php
  

    include_once '../../config/database.php';
    $cedula = $_POST["Cedula"];
    $nombre = $_POST["Nombre"];
    $nacionalidad = $_POST["Nacionalidad"];
    
    $sentencia = $bd->prepare("INSERT INTO autores(cedula,nombre,nacionalidad) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$cedula,$nombre,$nacionalidad]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Autores.php?mensaje=registrado');
    } else {
        header('Location: ../../views/Autores.php?mensaje=error');
        exit();
    }
    
?>