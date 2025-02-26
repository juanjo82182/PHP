<?php 
    if(!isset($_GET['codigo'])){
        header('Location: ../../views/Usuarios.php?mensaje=error');
        exit();
    }

    include '../../config/database.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("DELETE FROM usuario where codigo = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Usuarios.php?mensaje=eliminado');
    } else {
        header('Location: ../../views/Usuarios.php?mensaje=error');
    }
    
?>