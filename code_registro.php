<?php
    //Primero necesitamos incluir la conexion(archivo) a la base de datos
    require_once("conexion.php");

    //Definir e inicializar variables con valores vacios
    $username = $email = $password = "";
    $username_error = $email_error = $password_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //VALIDANDO INPUT DE NOMBRE DE USUARIO
        if(empty(trim($_POST["username"]))){
            $username_error = "Por favor, ingrese su usuario";
        }else{
            //prepara una declaracion de seleccion
            $sql = "SELECT id FROM usuarios WHERE usuario = ?";
            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = trim($_POST["username"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_error = "¡Este usuario ya existe!";
                    }else{
                        $username = trim($_POST["username"]);
                    }
                }else{
                    echo "Ups! Algo salio mal, intentalo mas tarde";
                }
            }
        }
        
        //VALIDANDO INPUT DE EMAIL
        if(empty(trim($_POST["email"]))){
            $email_error = "Por favor, ingrese un email";
        }else{
            //prepara una declaracion de seleccion
            $sql = "SELECT id FROM usuarios WHERE email = ?";

            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = trim($_POST["email"]);

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_error = "¡Este email ya existe!";
                    }else{
                        $email = trim($_POST["email"]);
                    }
                }else{
                    echo "Ups! Algo salio mal, intentalo mas tarde";
                }
            }
        }

        //VALIDANDO INPUT DE CONTRASEÑA
        if(empty(trim($_POST["password"]))){
            $password_error = "Por favor, ingresa una contraseña";
        }elseif(strlen(trim($_POST["password"])) < 4 ){
            $password_error = "La contraseña debe de tener mas de 4 caracteres";
        }else{
            $password = trim($_POST["password"]);
        }

        //COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE  INSERTAR LOS DATOS EN LA BASE DE DATOS
        if(empty($username_error) && empty($email_error) && empty($password_error)){
            
            //preparando el stmt
            $sql = "INSERT INTO usuarios (usuario, email, clave) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

                //ESTABLECIENDO PARAMETROS
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); //Encriptando contraseña

                if(mysqli_stmt_execute($stmt)){
                    header("location: index.php");
                }else{
                    echo "Algo salio mal, intentalo luego";
                }
            }
        }

        mysqli_close($conexion);
    }
?>