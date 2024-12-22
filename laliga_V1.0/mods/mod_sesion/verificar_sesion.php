<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'autenticado' => true,
        'username' => $_SESSION['username'],
    ]);
} else {
    echo json_encode(['autenticado' => false]);
}
?>
