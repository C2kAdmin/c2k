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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        exit;
    }

    // Verificar si el token es válido
    $sql = "SELECT * FROM recuperaciones WHERE token = ? AND expira > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);
    $recuperacion = $stmt->fetch();

    if ($recuperacion) {
        $email = $recuperacion['email'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Actualizar la contraseña
        $sql = "UPDATE usuarios SET password = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$passwordHash, $email]);

        // Eliminar el registro de recuperación
        $sql = "DELETE FROM recuperaciones WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        echo "<script>alert('Contraseña restablecida correctamente.'); window.location.href = '/laliga/index.html';</script>";
    } else {
        echo "<script>alert('El enlace ha expirado o no es válido.'); window.history.back();</script>";
    }
}
?>
