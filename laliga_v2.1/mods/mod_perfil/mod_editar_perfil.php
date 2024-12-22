<?php
session_start();
require_once '../../connection/connection.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    echo "<p>No tienes permiso para acceder a esta página. Inicia sesión primero.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener los datos del usuario
try {
    $stmt = $pdo->prepare("SELECT nombre_usuario, correo, telefono, generacion, plataforma, pos1, pos2, pos3, imagen_perfil FROM usuarios WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<p>Error: Usuario no encontrado.</p>";
        exit;
    }
} catch (PDOException $e) {
    echo "<p>Error al obtener los datos del perfil: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}

// Variables para los valores del formulario
$usuario = htmlspecialchars($user['nombre_usuario']);
$correo = htmlspecialchars($user['correo']);
$telefono = htmlspecialchars($user['telefono']);
$generacion = htmlspecialchars($user['generacion']);
$plataforma = htmlspecialchars($user['plataforma']);
$pos1 = htmlspecialchars($user['pos1']);
$pos2 = htmlspecialchars($user['pos2']);
$pos3 = htmlspecialchars($user['pos3']);
$imagen_perfil = htmlspecialchars($user['imagen_perfil']);
$imagen_url = $imagen_perfil ? "../../uploads/$imagen_perfil" : null;
?>

<div class="editar-perfil-container">
    <h2>Editar Perfil</h2>
    <form id="editarPerfilForm" method="POST" action="mods/mod_editar_perfil/procesar_editar_perfil.php" enctype="multipart/form-data">
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $correo; ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>

        <label for="generacion">Generación:</label>
        <select id="generacion" name="generacion" required>
            <option value="NextGen" <?php echo $generacion === 'NextGen' ? 'selected' : ''; ?>>NextGen</option>
            <option value="OldGen" <?php echo $generacion === 'OldGen' ? 'selected' : ''; ?>>OldGen</option>
        </select>

        <label for="plataforma">Plataforma:</label>
        <select id="plataforma" name="plataforma" required>
            <option value="PC" <?php echo $plataforma === 'PC' ? 'selected' : ''; ?>>PC</option>
            <option value="Xbox" <?php echo $plataforma === 'Xbox' ? 'selected' : ''; ?>>Xbox</option>
            <option value="PlayStation" <?php echo $plataforma === 'PlayStation' ? 'selected' : ''; ?>>PlayStation</option>
        </select>

        <label for="pos1">Primera Posición:</label>
        <select id="pos1" name="pos1" required>
            <option value="POR" <?php echo $pos1 === 'POR' ? 'selected' : ''; ?>>POR</option>
            <option value="DFC" <?php echo $pos1 === 'DFC' ? 'selected' : ''; ?>>DFC</option>
            <option value="LAT" <?php echo $pos1 === 'LAT' ? 'selected' : ''; ?>>LAT</option>
            <option value="MCD" <?php echo $pos1 === 'MCD' ? 'selected' : ''; ?>>MCD</option>
            <option value="MC" <?php echo $pos1 === 'MC' ? 'selected' : ''; ?>>MC</option>
            <option value="MCO" <?php echo $pos1 === 'MCO' ? 'selected' : ''; ?>>MCO</option>
            <option value="EXT" <?php echo $pos1 === 'EXT' ? 'selected' : ''; ?>>EXT</option>
            <option value="DC" <?php echo $pos1 === 'DC' ? 'selected' : ''; ?>>DC</option>
        </select>

        <label for="pos2">Segunda Posición:</label>
        <select id="pos2" name="pos2" required>
            <option value="POR" <?php echo $pos2 === 'POR' ? 'selected' : ''; ?>>POR</option>
            <option value="DFC" <?php echo $pos2 === 'DFC' ? 'selected' : ''; ?>>DFC</option>
            <option value="LAT" <?php echo $pos2 === 'LAT' ? 'selected' : ''; ?>>LAT</option>
            <option value="MCD" <?php echo $pos2 === 'MCD' ? 'selected' : ''; ?>>MCD</option>
            <option value="MC" <?php echo $pos2 === 'MC' ? 'selected' : ''; ?>>MC</option>
            <option value="MCO" <?php echo $pos2 === 'MCO' ? 'selected' : ''; ?>>MCO</option>
            <option value="EXT" <?php echo $pos2 === 'EXT' ? 'selected' : ''; ?>>EXT</option>
            <option value="DC" <?php echo $pos2 === 'DC' ? 'selected' : ''; ?>>DC</option>
        </select>

        <label for="pos3">Tercera Posición:</label>
        <select id="pos3" name="pos3" required>
            <option value="POR" <?php echo $pos3 === 'POR' ? 'selected' : ''; ?>>POR</option>
            <option value="DFC" <?php echo $pos3 === 'DFC' ? 'selected' : ''; ?>>DFC</option>
            <option value="LAT" <?php echo $pos3 === 'LAT' ? 'selected' : ''; ?>>LAT</option>
            <option value="MCD" <?php echo $pos3 === 'MCD' ? 'selected' : ''; ?>>MCD</option>
            <option value="MC" <?php echo $pos3 === 'MC' ? 'selected' : ''; ?>>MC</option>
            <option value="MCO" <?php echo $pos3 === 'MCO' ? 'selected' : ''; ?>>MCO</option>
            <option value="EXT" <?php echo $pos3 === 'EXT' ? 'selected' : ''; ?>>EXT</option>
            <option value="DC" <?php echo $pos3 === 'DC' ? 'selected' : ''; ?>>DC</option>
        </select>

        <label for="imagen_perfil">Imagen de Perfil:</label>
        <?php if ($imagen_url): ?>
            <img id="imagenActual" src="<?php echo $imagen_url; ?>" alt="Imagen de Perfil">
        <?php endif; ?>
        <input type="file" id="imagen_perfil" name="imagen_perfil" accept="image/*">

        <button type="submit">Guardar Cambios</button>
    </form>
</div>
