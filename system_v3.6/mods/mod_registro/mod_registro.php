<!-- mods/mod_registro/mod_registro.php -->
<link rel="stylesheet" href="mods/mod_registro/mod_registro.css">
<script src="mods/mod_registro/mod_registro.js"></script>

<div class="modulo-registro">
    <div class="modulo-registro-columna">
        <h2>Registro de Usuarios</h2>
        <form action="php/registro_usuario.php" method="POST">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="admin">Administrador</option>
                <option value="dt">Director Técnico</option>
                <option value="jugador">Jugador</option>
            </select>
            
            <button type="submit">Registrarse</button>
        </form>
    </div>
</div>
