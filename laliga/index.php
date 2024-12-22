<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga FC25 - Página Principal</title>
    <link rel="stylesheet" href="styles.css?version=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?version=<?php echo time(); ?>" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <style>
        .iti__country-name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px; /* Ajusta el ancho según sea necesario para abreviar */
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-left">
                <h1>La Liga</h1>
            </div>
            <div class="header-right" id="usuario-info" style="display: none;">
                <img id="imagen-usuario" src="mods/mod_registro/default_avatar.png" alt="Imagen de perfil" class="miniatura">
                <p>Bienvenido, <span id="nombre-usuario"></span></p>
            </div>
        </div>
        <div class="menu-hamburguesa" id="menu-hamburguesa" onclick="abrirCerrarMenu()">
            &#9776; <!-- Icono de hamburguesa -->
        </div>
        <nav id="nav-principal">
            <ul class="menu" id="menu-principal">
                <li><a href="#" onclick="cargarModulo('tabla_posiciones.php'); return false;">Tabla de Posiciones</a></li>
                <li><a href="#" onclick="cargarModulo('jugadores_libres.php'); return false;">Jugadores Libres</a></li>
                <li><a href="#" onclick="cargarModulo('mods/mod_crear_club/mod_crear_club.php'); return false;">Crear un Club</a></li>
                <li id="editar-perfil-link" style="display: none;"><a href="#" onclick="cargarModulo('mods/mod_perfil/mod_perfil.php'); return false;">Editar Perfil</a></li>
                <li id="registro-link"><a href="#" onclick="abrirRegistro(); return false;">Registro de Usuario</a></li>
                <li id="login-link"><a href="#" onclick="abrirLogin(); return false;">Iniciar Sesión</a></li>
                <li id="logout-link" style="display: none;"><a href="#" onclick="cerrarSesion(); return false;">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="contenedor-principal">
        <div class="columna izquierda">
            <h3>Últimos Usuarios Libres</h3>
        </div>
        <div class="columna central" id="contenido-central">
            <h2>Tabla de Posiciones (Contenido por defecto)</h2>
            <p>Aquí se mostrará la tabla de posiciones por defecto.</p>
        </div>
        <div class="columna derecha">
            <h3>Últimos Fichajes</h3>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Liga FC25. Todos los derechos reservados.</p>
        <p>Desarrollado por Concepto Creativo C2k</p>
    </footer>

    <!-- Modal de Iniciar Sesión -->
    <div id="loginModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarLogin()">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" action="mods/mod_login/procesar_login.php" method="POST">
                <div class="form-grupo">
                    <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-grupo">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="form-grupo-boton">
                    <button id="loginButton" type="submit">Iniciar Sesión</button>
                </div>
                <p><a href="#" onclick="abrirRecuperarContrasena(); return false;">¿Olvidaste tu contraseña?</a></p>
            </form>
        </div>
    </div>

    <!-- Modal de Recuperar Contraseña -->
    <div id="recuperarModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarRecuperar()">&times;</span>
            <h2>Recuperar Contraseña</h2>
            <form id="recuperarForm" action="mods/mod_recuperar/procesar_recuperacion.php" method="POST">
                <div class="form-grupo">
                    <input type="email" id="recuperar-email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-grupo-boton">
                    <button type="submit">Recuperar Contraseña</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Registro -->
    <div id="registroModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarRegistro()">&times;</span>
            <h2>Registro de Usuario</h2>
            <form id="registroForm" action="mods/mod_registro/procesar_registro.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="form-grupo">
                    <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required autocomplete="new-username">
                </div>
                <div class="form-grupo">
                    <input type="email" id="email-registro" name="email" placeholder="Correo Electrónico" required autocomplete="new-email">
                </div>
                <div class="form-grupo">
                    <input type="tel" id="telefono" name="telefono" placeholder="Número de Teléfono" required>
                </div>
                <div class="form-grupo">
                    <input type="password" id="password-registro" name="password" placeholder="Contraseña" required autocomplete="new-password">
                </div>
                <div class="form-grupo">
                    <input type="password" id="confirm-password-registro" name="confirm_password" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                </div>
                <div class="form-grupo">
                    <select id="plataforma" name="plataforma" required>
                        <option value="" disabled selected>Plataforma</option>
                        <option value="PS5">PlayStation 5</option>
                        <option value="Xbox">Xbox</option>
                        <option value="PC">PC</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
                </div>
                <div class="form-grupo-boton">
                    <button type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Inicializar intlTelInput para el campo de teléfono -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.querySelector("#telefono");
            const iti = window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    fetch('https://ipinfo.io?token=your_token_here', {cache: 'reload'})
                        .then(response => response.json())
                        .then(data => {
                            const countryCode = (data && data.country) ? data.country : "cl";
                            callback(countryCode);
                        })
                        .catch(() => {
                            callback("cl");
                        });
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            // Abreviar los nombres largos de los países para que no desborden
            document.querySelectorAll('.iti__country-name').forEach(function(element) {
                if (element.textContent.length > 20) {
                    element.textContent = element.textContent.slice(0, 17) + '...';
                }
            });
        });
    </script>
</body>
</html>
