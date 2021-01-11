<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - BangBang</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="ctn-welcome">
        <img src="imagenes/kpop.png" alt="" class="logo-welcome">
        <h1 class="title-welcome">Bienvenido a <b>BangBang</b> </h1>
        <a href="cerrar_sesion.php" class="cerrar-sesion">Cerrar Sesión</a>
    </div>
</body>
</html>