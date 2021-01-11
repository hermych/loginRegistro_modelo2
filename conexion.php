<?php
    define('DB_SERVIDOR', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','login_tuto');

    $conexion = mysqli_connect(DB_SERVIDOR, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($conexion === false){
        die("Error en la conexion " . mysqli_connect_error());
    }
?>