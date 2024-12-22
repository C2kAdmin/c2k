<?php
// mods/mod_registro/mod_registro.php
?>
<link rel="stylesheet" href="https://c2k.cl/laliga_V1.0/mods/mod_registro/mod_registro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://c2k.cl/laliga_V1.0/mods/mod_registro/mod_registro.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

<div class="mod_registro slide-up">
    <div class="mod_registro_columna">
        <h2>Formulario de Registro</h2>
        <form id="registroForm" action="https://c2k.cl/laliga_V1.0/mods/mod_registro/procesar_registro.php" method="POST" enctype="multipart/form-data">
            <div class="form-fila">
                <div class="form-grupo">
                    <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required>
                </div>
                <div class="form-grupo">
                    <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-grupo">
                    <input type="tel" id="telefono" name="telefono" placeholder="Número de Teléfono" required>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="form-grupo">
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                </div>
                <div class="form-grupo">
                    <select id="plataforma" name="plataforma" required>
                        <option value="" disabled selected>Plataforma</option>
                        <option value="PS5">PS5</option>
                        <option value="Xbox">Xbox</option>
                        <option value="PC">PC</option>
                    </select>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
                </div>
                <div class="form-grupo-boton">
                    <button type="submit">Registrarse</button>
                </div>
            </div>
        </form>
    </div>
</div>
