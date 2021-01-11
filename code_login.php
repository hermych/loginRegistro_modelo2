<?php
    //1. Inicializamos la sesion
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("location: bienevenida.php");
        exit;
    }

    require_once "conexion.php";

    $email = $password = "";
    $email_error = $password_error = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //CODIGO PARA QUE VERIFIQUE SI EL INPUT DE EMAIL ESTÁ EN BLANCO
        if(empty(trim($_POST["email"]))){
            $email_error = "Por favor, ingresar correo";
        }else{
            $email = trim($_POST["email"]);
        }

        //CODIGO PARA QUE VERIFIQUE SI EL INPUT DE EMAIL ESTÁ EN BLANCO
        if(empty(trim($_POST["password"]))){
            $password_error = "Por favor, ingresar contraseña";
        }else{
            $password = trim($_POST["password"]);
        }

        //VALIDAR CREDENCIALES
        if(empty($email_error) && empty($password_error)){
            $sql = "SELECT id, usuario, email, clave FROM usuarios WHERE email = ?";
            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = $email;

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                }
                //VERIFICAR FILA POR FILA SI ESE USUARIO EXISTE
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $usuario, $email, $hashed_password);
                    //SI LO ENCUENTRA ENTONCES----
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            //ALMACENAR LOS DATOS EN VARIABLES DE SESION (SI LA SESION ESTA INICIADA NO DEBE PERMITIRME ENTRAR AL LOGIN)
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            header("location: bienvenido.php");
                        }else{
                            $password_error = "La contraseña no es correcta";
                        }
                    }
                }else{
                    $email_error = "No se encontro cuenta con este correo";
                }
            }else{
                echo "UPS! Algo salio mal, intentalo mas tarde";
            }
        }
        mysqli_close($conexion);
    }
?>