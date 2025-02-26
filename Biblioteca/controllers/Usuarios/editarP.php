<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: ../../views/Usuarios.php?mensaje=error');
    }

    include '../../config/database.php';
    $codigo = $_POST['codigo'];
    $id = $_POST['ID'];
    $user = $_POST['User'];
    $pass = $_POST['Password'];
    $tipo = $_POST['Tipo'];
    

    $sentencia = $bd->prepare("UPDATE usuario SET id = ?, user = ?, password = ? , tipo = ?   where codigo = ?;");
    $resultado = $sentencia->execute([$id, $user, $pass, $tipo, $codigo]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Usuarios.php?mensaje=editado');
    } else {
        header('Location: ../../views/Usuarios.php?mensaje=error');
        exit();
    }
    
?>
