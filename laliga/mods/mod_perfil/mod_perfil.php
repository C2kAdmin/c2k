<?php
// mods/mod_perfil/mod_perfil.php

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$pass = '112233Kdoki.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Verificar si el usuario está autenticado y obtener la información
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Error: No has iniciado sesión.</p>";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT username, email, telefono, plataforma, foto_perfil FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<p>Error: Usuario no encontrado.</p>";
    exit;
}
?>

<!-- Modal de Editar Perfil -->
<div id="perfilModal" class="modal" style="display: flex;">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarPerfil()">&times;</span>
        <h2>Editar Perfil</h2>
        <form id="perfilForm" action="mods/mod_perfil/procesar_perfil.php" method="POST" enctype="multipart/form-data">
            <div class="form-grupo">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($usuario['username']); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" readonly>
            </div>
            <div class="form-grupo">
                <label for="telefono">Número de Teléfono</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
            </div>
            <div class="form-grupo">
                <label for="plataforma">Plataforma</label>
                <select id="plataforma" name="plataforma" required>
                    <option value="PS5" <?php echo $usuario['plataforma'] == 'PS5' ? 'selected' : ''; ?>>PlayStation 5</option>
                    <option value="Xbox" <?php echo $usuario['plataforma'] == 'Xbox' ? 'selected' : ''; ?>>Xbox</option>
                    <option value="PC" <?php echo $usuario['plataforma'] == 'PC' ? 'selected' : ''; ?>>PC</option>
                </select>
            </div>
            <div class="form-grupo">
                <label for="foto_perfil_actual">Imagen de Perfil Actual</label>
                <img src="<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Imagen de perfil" class="miniatura">
            </div>
            <div class="form-grupo">
                <label for="foto_perfil">Cambiar Imagen de Perfil</label>
                <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
            </div>
            <div class="form-grupo-boton">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
        <div class="form-grupo-boton">
            <button id="eliminarCuentaButton">Eliminar Cuenta</button>
        </div>
    </div>
</div>

<script>
// Función para cerrar el modal de perfil
function cerrarPerfil() {
    $('#perfilModal').hide();
}

// Ejecutar cerrarPerfil cuando el documento esté listo
$(document).ready(function() {
    $('#eliminarCuentaButton').click(function() {
        if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
            $.ajax({
                url: 'mods/mod_perfil/eliminar_cuenta.php',
                type: 'POST',
                data: JSON.stringify({ email: $('#email').val() }),
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        alert('Cuenta eliminada exitosamente.');
                        window.location.href = '/index.php';
                    } else {
                        alert('Error al eliminar la cuenta: ' + response.message);
                    }
                },
                error: function() {
                    console.error('Error al intentar eliminar la cuenta.');
                    alert('Error al intentar eliminar la cuenta.');
                }
            });
        }
    });
});
</script>

<style>
/* Estilos del modal (similares al de registro e inicio de sesión) */
.modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-contenido {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    position: relative;
}

.cerrar {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 1.2em;
    cursor: pointer;
}
</style>
