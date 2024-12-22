<?php
session_start();
$error = ''; // Mensaje de error para las operaciones
$success = ''; // Mensajes de éxito de las operaciones

// Suponiendo que existen scripts para manejar estos procesos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Proceso de inicio de sesión
        // login.php maneja la lógica de verificación
        include('login.php');
    } elseif (isset($_POST['register'])) {
        // Proceso de registro
        // register.php maneja la lógica de registro
        include('register.php');
    } elseif (isset($_POST['update'])) {
        // Proceso de actualización de perfil
        // update_profile.php maneja la lógica de actualización
        include('update_profile.php');
    } elseif (isset($_POST['recover'])) {
        // Proceso de recuperación de contraseña
        // recover_password.php maneja la lógica de recuperación
        include('recover_password.php');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <link rel="stylesheet" href="css/global.css">
</head>
<body>
    <div class="header">
        <h1>Mi Aplicación</h1>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
    </div>

    <!-- Formulario de registro -->
    <div id="registerForm">
        <h2>Registrarse</h2>
        <form method="POST">
            <input type="email" name="email" required placeholder="Correo electrónico">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit" name="register">Registrar</button>
        </form>
    </div>

    <!-- Formulario de inicio de sesión -->
    <div id="loginForm">
        <h2>Iniciar sesión</h2>
        <form method="POST">
            <input type="email" name="email" required placeholder="Correo electrónico">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit" name="login">Iniciar sesión</button>
        </form>
    </div>

    <!-- Formulario de actualización de perfil -->
    <div id="updateForm">
        <h2>Actualizar perfil</h2>
        <form method="POST">
            <input type="email" name="email" required placeholder="Nuevo correo electrónico">
            <input type="password" name="new_password" placeholder="Nueva contraseña">
            <button type="submit" name="update">Actualizar</button>
        </form>
    </div>

    <!-- Formulario de recuperación de contraseña -->
    <div id="recoverForm">
        <h2>Recuperar contraseña</h2>
        <form method="POST">
            <input type="email" name="email" required placeholder="Correo electrónico para recuperar">
            <button type="submit" name="recover">Recuperar</button>
        </form>
    </div>

</body>
</html>
