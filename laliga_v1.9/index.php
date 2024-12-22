<?php
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
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarRegistro()">&times;</span>
            <h2>Registro de Usuario</h2>
            <form id="registroForm" method="POST" enctype="multipart/form-data" action="procesar_registro.php" autocomplete="off">
                <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required>
                <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                <input type="tel" id="telefono" name="telefono" placeholder="Número de Teléfono" required>
                <input type="hidden" id="pais" name="pais">
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                </div>
                <select id="generacion" name="generacion" required>
                    <option value="">Seleccione Generación</option>
                    <option value="NextGen">NextGen</option>
                    <option value="OldGen">OldGen</option>
                </select>
                <select id="plataforma" name="plataforma" required>
                    <option value="">Seleccione Plataforma</option>
                    <option value="PC">PC</option>
                    <option value="Xbox">Xbox</option>
                    <option value="PlayStation">PlayStation</option>
                </select>
                <select id="pos1" name="pos1" required>
                    <option value="">Primera Posición</option>
                    <option value="POR">POR</option>
                    <option value="DFC">DFC</option>
                    <option value="LAT">LAT</option>
                    <option value="MCD">MCD</option>
                    <option value="MC">MC</option>
                    <option value="MCO">MCO</option>
                    <option value="EXT">EXT</option>
                    <option value="DC">DC</option>
                </select>
                <select id="pos2" name="pos2" required>
                    <option value="">Segunda Posición</option>
                    <option value="POR">POR</option>
                    <option value="DFC">DFC</option>
                    <option value="LAT">LAT</option>
                    <option value="MCD">MCD</option>
                    <option value="MC">MC</option>
                    <option value="MCO">MCO</option>
                    <option value="EXT">EXT</option>
                    <option value="DC">DC</option>
                </select>
                <select id="pos3" name="pos3" required>
                    <option value="">Tercera Posición</option>
                    <option value="POR">POR</option>
                    <option value="DFC">DFC</option>
                    <option value="LAT">LAT</option>
                    <option value="MCD">MCD</option>
                    <option value="MC">MC</option>
                    <option value="MCO">MCO</option>
                    <option value="EXT">EXT</option>
                    <option value="DC">DC</option>
                </select>
                <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>

    <!-- Modal de Inicio de Sesión -->
    <div id="loginModal" class="modal" style="display:none;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarLogin()">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" method="POST">
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
                <p><a href="#" onclick="mostrarRecuperar(); return false;">¿Olvidaste tu contraseña?</a></p>
            </form>
        </div>
    </div>

    <!-- Modal de Recuperación de Contraseña -->
    <div id="recuperarModal" class="modal" style="display:none;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarRecuperar()">&times;</span>
            <h2>Recuperar Contraseña</h2>
            <form id="recuperarForm" method="POST">
                <input type="email" id="correo_recuperar" name="correo" placeholder="Correo Electrónico" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <!-- Modal para Cambiar Contraseña -->
    <div id="cambiarContrasenaModal" class="modal" style="<?php echo $reset_token ? 'display: block;' : 'display: none;'; ?>">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarCambiarContrasena()">&times;</span>
            <h2>Restablecer Contraseña</h2>
            <form id="cambiarContrasenaForm" method="POST" action="procesar_reset_password.php" class="form-styled">
                <input type="hidden" name="reset_token" id="reset_token" value="<?php echo htmlspecialchars($reset_token); ?>">
                <input type="password" name="nueva_contrasena" placeholder="Nueva Contraseña" required>
                <input type="password" name="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
                <button type="submit">Restablecer</button>
            </form>
        </div>
    </div>
</body>
</html>