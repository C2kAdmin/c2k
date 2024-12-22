<?php
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

// Procesar el restablecimiento de la contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        // Verificar si el token es válido
        $sql = "SELECT * FROM recuperaciones WHERE token = ? AND expira > NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token]);
        $recuperacion = $stmt->fetch();

        if ($recuperacion) {
            // Actualizar la contraseña del usuario
            $email = $recuperacion['email'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE usuarios SET password = ? WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$passwordHash, $email]);

            // Eliminar el token de recuperación usado
            $sql = "DELETE FROM recuperaciones WHERE token = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$token]);

            echo "<script>alert('Contraseña restablecida exitosamente.'); window.location.href = '/laliga/index.html';</script>";
        } else {
            echo "<script>alert('El enlace de recuperación no es válido o ha expirado.'); window.location.href = '/laliga/index.html';</script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
    }
}
?>
