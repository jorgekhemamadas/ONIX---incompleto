<?php
// db.php
$host = 'localhost';
$db = 'video_website';
$user = 'root'; // Usuario root de MariaDB
$pass = ''; // Deja la contraseña vacía si no tienes una configurada

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
