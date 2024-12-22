<?php
// mods/mod_sesion/mod_login.php
?>
<link rel="stylesheet" href="https://c2k.cl/laliga_V1.0/mods/mod_sesion/mod_login.css">
<script src="https://c2k.cl/laliga_V1.0/mods/mod_sesion/mod_login.js"></script>

<div class="mod_login">
    <h2>Inicio de Sesión</h2>
    <form id="sesionForm">
        <div class="form-grupo">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-grupo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-grupo-boton">
            <button type="submit">Iniciar Sesión</button>
        </div>
    </form>
</div>
