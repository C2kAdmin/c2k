<div class="mod_registro">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <link rel="stylesheet" href="mods/mod_registro/mod_registro.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
    <script src="mods/mod_registro/mod_registro.js" defer></script>

    <h2>Registro de Usuario</h2>

    <form id="form_registro" method="POST" action="javascript:void(0);" enctype="multipart/form-data">
        <div class="form-row">
            <input type="text" id="username" name="username" placeholder="Nombre de Usuario" value="kdoki13" required>
            <input type="email" id="email" name="email" placeholder="Correo Electrónico" value="conceptocreativoc2k@gmail.com" required>
            <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" value="+56993064795" required>
            <input type="hidden" id="pais" name="pais" value="Chile">
        </div>
        <div class="form-row">
            <input type="password" id="password" name="password" placeholder="Contraseña" value="asdasd" required>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" value="asdasd" required>
        </div>
        <div class="form-row">
            <select id="generacion" name="generacion" required>
                <option value="NextGen" selected>NextGen</option>
                <option value="OldGen">OldGen</option>
            </select>
            <select id="plataforma" name="plataforma" required>
                <option value="PC" selected>PC</option>
                <option value="Xbox">Xbox</option>
                <option value="PlayStation">PlayStation</option>
            </select>
        </div>
        <div class="form-row">
            <select id="pos1" name="pos1" required>
                <option value="Delantero" selected>Delantero</option>
                <option value="Mediocampista">Mediocampista</option>
                <option value="Defensor">Defensor</option>
                <option value="Arquero">Arquero</option>
            </select>
            <select id="pos2" name="pos2" required>
                <option value="Mediocampista" selected>Mediocampista</option>
                <option value="Delantero">Delantero</option>
                <option value="Defensor">Defensor</option>
                <option value="Arquero">Arquero</option>
            </select>
            <select id="pos3" name="pos3" required>
                <option value="Defensor" selected>Defensor</option>
                <option value="Delantero">Delantero</option>
                <option value="Mediocampista">Mediocampista</option>
                <option value="Arquero">Arquero</option>
            </select>
        </div>
        <div class="form-row">
            <input type="file" id="imagen_perfil" name="imagen_perfil" accept="image/*">
        </div>
        <div class="form-row">
            <button type="submit">Registrarse</button>
        </div>
    </form>
</div>
