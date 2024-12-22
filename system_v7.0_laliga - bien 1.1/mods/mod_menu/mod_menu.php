<!-- mods/mod_menu/mod_menu.php -->
<link rel="stylesheet" href="mods/mod_menu/mod_menu.css">
<script src="mods/mod_menu/mod_menu.js"></script>

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
		<button class="menu-button" data-modulo="mods/mod_registro/mod_registro.php">Registro</button>
        <button class="menu-button desktop-menu-item" id="boton_desplazar">Desplazar</button>
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
			<button class="menu-button mobile-menu-item" data-modulo="mods/mod_registro/mod_registro.php">Registro</button>
            <button class="menu-button mobile-menu-item" id="boton_desplazar_movil">Desplazar</button>
        </div>
    </div>
</div>
