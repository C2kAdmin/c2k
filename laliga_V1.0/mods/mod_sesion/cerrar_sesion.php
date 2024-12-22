<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['usuario_id'])) {
    session_destroy();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
