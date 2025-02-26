<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: ../../views/Autores.php?mensaje=error');
    }

    include '../../config/database.php';
    $codigo = $_POST['codigo'];
    $cedula = $_POST['Cedula'];
    $nombre = $_POST['Nombre'];
    $nacionalidad = $_POST['Nacionalidad'];

    $sentencia = $bd->prepare("UPDATE autores SET cedula = ?, nombre = ?, nacionalidad = ? where codigo = ?;");
    $resultado = $sentencia->execute([$cedula, $nombre, $nacionalidad, $codigo]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Autores.php?mensaje=editado');
    } else {
        header('Location: ../../views/Autores.php?mensaje=error');
        exit();
    }
    
?>
