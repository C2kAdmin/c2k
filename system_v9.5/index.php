<?php
session_start();

// Verificar si el usuario está autenticado
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : null;
$user_phone = $is_logged_in ? $_SESSION['user_phone'] : '';
$user_country = $is_logged_in ? $_SESSION['user_country'] : 'us'; // Usamos 'us' como default
$user_image = $is_logged_in && !empty($_SESSION['imagen_perfil']) ? $_SESSION['imagen_perfil'] : 'path_to_default_image.jpg';

// Capturar el token si existe
$reset_token = isset($_GET['reset_token']) ? htmlspecialchars($_GET['reset_token']) : null;

// Asegúrate de que las rutas de los scripts y los enlaces estén correctos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
    <script src="js/animations.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/registro.js"></script>
    <script src="js/login.js"></script>
    <script src="js/recuperar_contrasena.js"></script>
    <script src="js/perfil.js"></script>
</head>
<body>
    <!-- Resto del cuerpo de tu HTML -->
</body>
</html>

<body>
    <div class="header">
        <div class="menu-buttons">
    <div class="desktop-menu">
        <!-- Imagen para el menú en PC -->
        <img src="/system_v3.5.9/imgs/logo.png" alt="Logo" class="menu-logo">
        <!-- Botones de menú para PC -->
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod_1/mod_1.php">Módulo 1</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod_2/mod_2.php">Módulo 2</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod_3/mod_3.php">Módulo 3</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod_4/mod_4.php">Módulo 4</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod_5/mod_5.php">Módulo 5</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod_6/mod_6.php">Módulo 6</button>
        <button class="menu-button desktop-menu-item" id="boton_desplazar">Desplazar</button>
		<?php if ($is_logged_in): ?>
	<button class="menu-button" onclick="mostrarActualizarPerfil(); return false;">Actualizar Perfil</button>

    <button class="menu-button mobile-menu-item" onclick="window.location.href='cerrar_sesion.php';">Cerrar Sesión</button>
<?php else: ?>
    <button class="menu-button mobile-menu-item" id="linkRegistrar" onclick="mostrarRegistro(); return false;">Registrarse</button>
    <button class="menu-button mobile-menu-item" id="linkIniciarSesion" onclick="mostrarLogin(); return false;">Iniciar Sesión</button>
<?php endif; ?>

<?php if ($is_logged_in): ?>
    <div class="user-welcome">
        <?php if (!empty($_SESSION['imagen_perfil'])): ?>
            <img src="<?php echo htmlspecialchars($_SESSION['imagen_perfil']); ?>" alt="Perfil" class="profile-pic" style="height: 50px; width: 50px; border-radius: 50%;">
        <?php else: ?>
            <img src="path_to_default_image.jpg" alt="Default Profile Picture" style="height: 50px; width: 50px; border-radius: 50%;">
        <?php endif; ?>
        <p class="welcome-message">Bienvenido, <?php echo htmlspecialchars($user_name); ?></p>
    </div>
<?php endif; ?>



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

    </div>
    <!-- Botón de menú para dispositivos móviles -->
    <div class="mobile-menu">
        <div class="mobile-header">
            <button class="menu-button" id="menu-icon">☰</button>
            <img src="/system_v3.5.9/imgs/logo.png" alt="Logo" class="menu-logo-mobile">
        </div>
        <div class="mobile-menu-content" id="mobile-menu-content">
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod_1/mod_1.php">Módulo 1</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod_2/mod_2.php">Módulo 2</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod_3/mod_3.php">Módulo 3</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod_4/mod_4.php">Módulo 4</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod_5/mod_5.php">Módulo 5</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod_6/mod_6.php">Módulo 6</button>
            <button class="menu-button mobile-menu-item" id="boton_desplazar_movil">Desplazar</button>
			<?php if ($is_logged_in): ?>
			<button class="menu-button" onclick="mostrarActualizarPerfil(); return false;">Actualizar Perfil</button>

    <button class="menu-button mobile-menu-item" onclick="window.location.href='cerrar_sesion.php';">Cerrar Sesión</button>
<?php else: ?>
    <button class="menu-button mobile-menu-item" id="linkRegistrar" onclick="mostrarRegistro(); return false;">Registrarse</button>
    <button class="menu-button mobile-menu-item" id="linkIniciarSesion" onclick="mostrarLogin(); return false;">Iniciar Sesión</button>
<?php endif; ?>

<?php if ($is_logged_in): ?>
    <div class="user-welcome">
        <?php if (!empty($_SESSION['imagen_perfil'])): ?>
            <img src="<?php echo htmlspecialchars($_SESSION['imagen_perfil']); ?>" alt="Perfil" class="profile-pic" style="height: 50px; width: 50px; border-radius: 50%;">
        <?php else: ?>
            <img src="path_to_default_image.jpg" alt="Default Profile Picture" style="height: 50px; width: 50px; border-radius: 50%;">
        <?php endif; ?>
        <p class="welcome-message">Bienvenido, <?php echo htmlspecialchars($user_name); ?></p>
    </div>
<?php endif; ?>


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

        </div>
    </div>
</div>

        
    </div>
    <div class="container_ppal">
        <div class="left-column_ppal">
            <?php include 'mods/mod_lat_izq/mod_lat_izq.php'; ?>
        </div>
        
        <div class="center-column_ppal">
            <a id="contenido_ancla"></a>
            <div id="contenido_dinamico">
                <?php include 'mods/mod_1/mod_1.php'; ?>
            </div>
        </div>
        

        <div class="right-column_ppal">
            <?php include 'mods/mod_lat_der/mod_lat_der.php'; ?>
        </div>
    </div>
    <div class="container_secund">
        <div class="left-column_secun">
            <?php include 'mods/mod_flot_izq/mod_flot_izq.php'; ?>
        </div>
        
        <div class="center-column_secun">
            <?php include 'mods/mod_youtube/mod_youtube.php'; ?>
            <?php include 'mods/mod_googlemaps/mod_googlemaps.php'; ?>
        </div>
        
        <div class="right-column_secun">
            <!-- Contenido de la columna derecha secundaria -->
        </div>
    </div>
    <div class="section_ppal1">
        <!-- Contenido de la columna derecha secundaria -->
    </div>
    <div class="section_ppal2">
        <?php include 'mods/mod_contacto/mod_contacto.php'; ?>
    </div>
    <div class="section-footer">
        <?php include 'mods/mod_footer/mod_footer.php'; ?>
    </div>
    
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
                    <option value="DFC">DFC</option
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
	
	<!-- Modal de Actualización de Perfil -->
<div id="actualizarPerfilModal" class="modal" style="display:none;">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarActualizarPerfil()">&times;</span>
        <h2>Actualizar Perfil</h2>
        <form id="actualizarPerfilForm" method="POST" enctype="multipart/form-data" action="procesar_actualizar_perfil.php">
            <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required value="<?php echo htmlspecialchars($user_name); ?>">
            <input type="tel" id="telefono" name="telefono" required> <!-- Asegúrate de tener $user_phone disponible -->
            <img id="profile_pic_preview" src="<?php echo htmlspecialchars($user_image); ?>" alt="Profile Picture" style="height: 100px; width: 100px; border-radius: 50%;">
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" onchange="previewImage();">
            <button type="submit">Actualizar Perfil</button>
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