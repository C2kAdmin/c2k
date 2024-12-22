<?php
    session_start(); // Iniciamos sesión para manejar usuarios.
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <!-- Estilos Globales -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/animations.css">
    <!-- Scripts Globales -->
    <script src="js/animations.js"></script>
    <script src="js/modal.js"></script>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="menu-buttons">
            <!-- Menú para escritorio -->
            <div class="desktop-menu">
                <img src="/system_v3.5.9/imgs/logo.png" alt="Logo" class="menu-logo">
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_1/mod_1.php">Módulo 1</button>
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_2/mod_2.php">Módulo 2</button>
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_3/mod_3.php">Módulo 3</button>
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_4/mod_4.php">Módulo 4</button>
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_5/mod_5.php">Módulo 5</button>
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_6/mod_6.php">Módulo 6</button>
                <button class="menu-button desktop-menu-item" data-modulo="mods/mod_registro/mod_registro.php">Registro</button>
            </div>

            <!-- Menú móvil -->
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
                    <button class="menu-button mobile-menu-item" data-modulo="mods/mod_registro/mod_registro.php">Registro</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedor Principal -->
    <div class="container_ppal">
        <div class="left-column_ppal">
            <?php include 'mods/mod_lat_izq/mod_lat_izq.php'; ?>
        </div>
        <div class="center-column_ppal">
            <div id="contenido_dinamico">
                <!-- Carga inicial del módulo -->
                <?php include 'mods/mod_1/mod_1.php'; ?>
            </div>
        </div>
        <div class="right-column_ppal">
            <?php include 'mods/mod_lat_der/mod_lat_der.php'; ?>
        </div>
    </div>

    <!-- Pie de Página -->
    <div class="section-footer">
        <?php include 'mods/mod_footer/mod_footer.php'; ?>
    </div>
</body>
</html>
