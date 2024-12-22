<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?><br />
<!-- mod_menu_parte1.php -->
<link rel="stylesheet" href="mods/mod_menu/styles_menu.css?<?php echo filemtime('styles_menu.css'); ?>">

<div class="menu-buttons">
    <div class="desktop-menu">
        <!-- Botones de menú para PC -->
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod1/mod1.php">Módulo 1</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod2/mod2.php">Módulo 2</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod3/mod3.php">Módulo 3</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod4/mod4.php">Módulo 4</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod5/mod5.php">Módulo 5</button>
        <button class="menu-button desktop-menu-item" data-modulo="mods/mod6/mod6.php">Módulo 6</button>
        <button class="menu-button desktop-menu-item" id="boton_desplazar">Desplazar</button>
    </div>
    <!-- Botón de menú para dispositivos móviles -->
    <div class="mobile-menu">
        <button class="menu-button" id="menu-icon">☰</button>
        <div class="mobile-menu-content" id="mobile-menu-content">
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod1/mod1.php">Módulo 1</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod2/mod2.php">Módulo 2</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod3/mod3.php">Módulo 3</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod4/mod4.php">Módulo 4</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod5/mod5.php">Módulo 5</button>
            <button class="menu-button mobile-menu-item" data-modulo="mods/mod6/mod6.php">Módulo 6</button>
            <button class="menu-button mobile-menu-item" id="boton_desplazar_movil">Desplazar</button>
        </div>
    </div>
</div>
