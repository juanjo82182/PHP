<?php 

  // Redireccionar a otra página
header("Location: ../Client/Cliente.php");


// Ejecutar script de Python para crear un socket
exec("python Servidor.py > /dev/null 2>&1 &");

?>