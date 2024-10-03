<?php
// index.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

// Conexión a la base de datos
require 'db.php';

// Obtener el nombre de usuario
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$username = $user ? $user['username'] : 'Usuario';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a ONIX</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #1f1f1f;
        }

        .welcome {
            font-size: 18px;
            color: #007bff;
        }

        .menu-toggle {
            font-size: 30px;
            cursor: pointer;
            color: #fff;
        }

        .menu {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 250px;
            height: 100%;
            background-color: #1f1f1f;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            z-index: 1000;
        }

        .menu.active {
            display: block;
        }

        .menu .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .menu .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .menu .username {
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
        }

        .menu a {
            display: block;
            margin: 20px 0;
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }

        .menu a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="welcome">Bienvenido a ONIX, <?php echo htmlspecialchars($username); ?></div>
        <div class="menu-toggle" onclick="toggleMenu()">|||</div>
    </header>

    <div class="menu" id="menu">
        <div class="logo-container">
            <img src="logo.png" alt="ONIX Logo" class="logo">
            <div class="username"><?php echo htmlspecialchars($username); ?></div>
        </div>
        <a href="index">Home</a>
        <a href="upload">Upload</a>
        <a href="list">Galería</a>
        <a href="logout">Cerrar Sesión</a>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
