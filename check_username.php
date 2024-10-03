<?php
// check_username.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // Verificar si hay caracteres no permitidos
    if (!preg_match('/^[a-zA-Z0-9._]+$/', $username) || strlen($username) > 20) {
        echo 'invalido'; // Enviar mensaje de carácter no permitido
        exit();
    }

    // Verificar si el usuario ya existe en la base de datos
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        echo 'existe';
    } else {
        echo 'disponible';
    }
}
?>
