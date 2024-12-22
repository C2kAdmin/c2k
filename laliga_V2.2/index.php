<?php
// Archivo: index.php - Ubicación: /laliga_v2.1/index.php
// Descripción: Página principal del sistema para la gestión de navegación y sesiones.

session_start();

// Verificar si el usuario está autenticado
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : null;

// Capturar el token si existe
$reset_token = isset($_GET['reset_token']) ? htmlspecialchars($_GET['reset_token']) : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Nueva</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/registro.js"></script>
    <script src="js/login.js"></script>
    <script src="js/recuperar_contrasena.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
</head>
<body>
    <!-- Encabezado -->
    <header class="header">
        <h1>Encabezado - Plantilla Nueva</h1>
        <nav class="menu-general">
            <ul>
                <li><a href="#" class="menu-link" data-target="mod_inicio">Inicio</a></li>
                <li><a href="#" class="menu-link" data-target="tabla_posiciones">Tabla de Posiciones</a></li>
                <li><a href="#" class="menu-link" data-target="estadisticas">Estadísticas</a></li>
                <li><a href="#" class="menu-link" data-target="equipos">Equipos Participantes</a></li>
                <li><a href="#" class="menu-link" data-target="jugadores_libres">Jugadores Libres</a></li>
                <li><a href="#" class="menu-link" data-target="informacion_general">Información General</a></li>
                <?php if ($is_logged_in): ?>
                    <li><a href="mods/mod_perfil/mod_perfil.php">Mi Perfil</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="#" onclick="mostrarRegistro(); return false;">Registrarse</a></li>
                    <li><a href="#" onclick="mostrarLogin(); return false;">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php if ($is_logged_in): ?>
            <p class="welcome-message">Bienvenido, <?php echo htmlspecialchars($user_name); ?>.</p>
        <?php endif; ?>
    </header>

    <!-- Mostrar notificaciones -->
    <?php
    if (isset($_SESSION['reset_success'])) {
        echo "<script>window.addEventListener('DOMContentLoaded', function() {
            mostrarNotificacion('" . addslashes($_SESSION['reset_success']) . "', 'success');
        });</script>";
        unset($_SESSION['reset_success']);
    }

    if (isset($_SESSION['reset_error'])) {
        echo "<script>window.addEventListener('DOMContentLoaded', function() {
            mostrarNotificacion('" . addslashes($_SESSION['reset_error']) . "', 'error');
        });</script>";
        unset($_SESSION['reset_error']);
    }
    ?>

    <!-- Contenedor principal -->
    <div class="main-container">
        <aside class="left-column">
            <p>Columna Izquierda - Contenido Referencial</p>
        </aside>

        <section class="center-column">
            <div id="contenido-central">
                <p>Columna Central - Contenido Principal</p>
            </div>
        </section>

        <aside class="right-column">
            <p>Columna Derecha - Contenido Referencial</p>
        </aside>
    </div>

    <!-- Pie de página -->
    <footer class="footer">
        <p>Pie de Página</p>
    </footer>

    <!-- Modal de Registro -->
    <div id="registroModal" class="modal" style="display:none;">
        <!-- Contenido del modal -->
    </div>

    <!-- Modal de Inicio de Sesión -->
    <div id="loginModal" class="modal" style="display:none;">
        <!-- Contenido del modal -->
    </div>

    <!-- Modal de Recuperación de Contraseña -->
    <div id="recuperarModal" class="modal" style="display:none;">
        <!-- Contenido del modal -->
    </div>

    <!-- Modal para Cambiar Contraseña -->
    <div id="cambiarContrasenaModal" class="modal" style="<?php echo $reset_token ? 'display: block;' : 'display: none;'; ?>">
        <!-- Contenido del modal -->
    </div>
</body>
</html>
