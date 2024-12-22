<?php
session_start();
require_once '../../connection/connection.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("
        SELECT nombre_usuario, correo, telefono, generacion, plataforma, pos1, pos2, pos3, imagen_perfil 
        FROM usuarios 
        WHERE id = :user_id
    ");
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../css/global.css">
</head>
<body>
    <div class="perfil-container">
        <h1>Mi Perfil</h1>
        <?php if ($user['imagen_perfil']): ?>
            <img src="../../uploads/<?php echo htmlspecialchars($user['imagen_perfil']); ?>" alt="Imagen de perfil" class="perfil-imagen">
        <?php endif; ?>
        <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($user['nombre_usuario']); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($user['correo']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['telefono']); ?></p>
        <p><strong>Generación:</strong> <?php echo htmlspecialchars($user['generacion']); ?></p>
        <p><strong>Plataforma:</strong> <?php echo htmlspecialchars($user['plataforma']); ?></p>
        <p><strong>Primera Posición:</strong> <?php echo htmlspecialchars($user['pos1']); ?></p>
        <p><strong>Segunda Posición:</strong> <?php echo htmlspecialchars($user['pos2']); ?></p>
        <p><strong>Tercera Posición:</strong> <?php echo htmlspecialchars($user['pos3']); ?></p>
        <a href="mod_editar_perfil.php" class="btn-editar">Editar Perfil</a>
    </div>
</body>
</html>
