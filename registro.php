<?php
    include("code_registro.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Registro - BangBang</title>
</head>
<body>
    <div class="container-all">
        <div class="ctn-form">
            <img src="imagenes/kpop.png" alt="logo" class="logo">
            <h1 class="title">Registrarse</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="username" id="usuario">
                <span class="msg-error"><?php echo $username_error; ?></span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <span class="msg-error"><?php echo $email_error; ?></span>
                <label for="contrasena">Contraseña</label>
                <input type="password" name="password" id="contrasena">
                <span class="msg-error"><?php echo $password_error; ?></span>
                <input type="submit" value="Registrarse">
            </form>
            <span class="text-footer">¿Ya te has registrado?
                <a href="index.php">Iniciar Sesion</a>
            </span>
        </div>
        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description">BangBang - Lo mejor del kpop a solo un click</h1>
            <p class="text-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti eveniet cumque harum corporis laboriosam doloribus, explicabo dolore commodi nam! Aliquam, earum exercitationem? Explicabo enim quaerat nisi molestiae ipsam quas iusto!</p>
        </div>
    </div>
</body>
</html>