<?php
  

    include_once '../../config/database.php';
    $id = $_POST['ID'];
    $user = $_POST['User'];
    $pass = $_POST['Password'];
    $tipo = $_POST['Tipo'];
    
    $sentencia = $bd->prepare("INSERT INTO usuario(id,user,password,tipo) VALUES (?,?,?,?);");
    $resultado = $sentencia->execute([$id, $user, $pass, $tipo]);

    if ($resultado === TRUE) {
        header('Location: ../../views/Usuarios.php?mensaje=registrado');
    } else {
        header('Location: ../../views/Usuarios.php?mensaje=error');
        exit();
    }
    
?>