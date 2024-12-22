<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['usuario_id'])) {
    $host = 'localhost';
    $dbname = 'ckcl_laliga';
    $user = 'ckcl_admin';
    $pass = '112233Kdoki.';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT username, foto_perfil FROM usuarios WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['usuario_id']]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            echo json_encode([
                'autenticado' => true,
                'usuario' => $usuario['username'],
                'foto_perfil' => $usuario['foto_perfil'] ? $usuario['foto_perfil'] : 'mods/mod_registro/default_avatar.png'
            ]);
        } else {
            echo json_encode(['autenticado' => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(['autenticado' => false, 'message' => 'Error al conectar con la base de datos']);
    }
} else {
    echo json_encode(['autenticado' => false]);
}
?>
