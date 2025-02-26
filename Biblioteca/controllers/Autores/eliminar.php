<?php 
    if(!isset($_GET['codigo'])){
        header('Location: ../../views/Autores.php?mensaje=error');
        exit();
    }

    include '../../config/database.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("DELETE FROM autores where codigo = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Autores.php?mensaje=eliminado');
    } else {
        header('Location: ../../views/Autores.php?mensaje=error');
    }
    
?>