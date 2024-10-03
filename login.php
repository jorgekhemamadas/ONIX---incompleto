<?php
// login.php
require 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index");
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ONIX</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            margin: 0;
            background-color: #121212;
        }
        .header-text {
            font-family: 'Inter', sans-serif;
            font-size: 25px;
            color: #007bff;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        .container {
            max-width: 200px;
            width: 300%;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            background-color: transparent;
            color: #fff;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }
        .logo-container {
            width: 70px; /* Ajusta según el tamaño que desees */
            height: 70px; /* Asegúrate que sea igual para mantener la forma circular */
            border-radius: 50%; /* Hace que el contenedor sea circular */
            overflow: hidden; /* Oculta cualquier parte de la imagen que sobresalga */
            box-shadow: 0 4px 10px rgba(0.6, 0.7, 0.8, 0.9); /* Sombra alrededor del contenedor */
            display: flex; /* Centra la imagen */
            align-items: center;
            justify-content: center;
            margin: 40px 0 40px;
        }

        .logo {
            width: 100%; /* Asegura que la imagen ocupe todo el contenedor */
            height: auto; /* Mantiene la proporción de la imagen */
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="logo.png" alt="Logo" class="logo">
    </div>
    <h1 class="header-text">Inicia Sesión en ONIX</h1>
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login" method="post">
            <input type="text" name="username" placeholder="Usuario" required maxlength="20">
            <input type="password" name="password" placeholder="Contraseña" required maxlength="30">
            <input type="submit" value="Ingresar">
        </form>
        <a href="register" class="register-link">Registrarse</a>
    </div>
</body>
</html>
<style>
ul.list-style-none {
    list-style: none;
    padding-left: 0; /* Asegúrate de eliminar cualquier padding */
    margin-left: 0;  /* Asegúrate de eliminar cualquier margen que pueda generar espacio */
}
</style>
<nav aria-label="Social Media Links" class="mt-3 mt-md-0">
  <ul class="list-style-none d-flex flex-items-center lh-condensed-ultra" style="display: flex; gap: 15px;">

    <!-- GitHub Logo -->
    <li>
      <a href="https://github.com/jorgekhemamadas" class="footer-social-icon d-block Link--outlineOffset" aria-label="GitHub">
        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 16 16" width="20" aria-hidden="true" class="d-block">
          <path fill="currentColor" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
        </svg>
      </a>
    </li>

    <!-- Instagram Logo -->
    <li>
      <a href="https://instagram.com/jorgekhemamadas_" class="footer-social-icon d-block Link--outlineOffset" aria-label="Instagram">
        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20" aria-hidden="true" class="d-block">
          <path fill="currentColor" d="M12 0C8.7 0 8.3 0 7.1.1 6 0 5 0 3.8.1 1.6.1 0 1.6 0 3.8c0 1.1.1 2.1.1 3.3C0 8.3 0 8.7 0 12c0 3.3.4 3.7.1 4.9-.1 1.1-.1 2.1-.1 3.3C0 22.4 1.6 24 3.8 24c1.1 0 2.1-.1 3.3-.1 1.2 0 1.6.1 4.9.1 3.3 0 3.7-.4 4.9-.1 1.1-.1 2.1-.1 3.3-.1 2.2 0 3.8-1.6 3.8-3.8 0-1.1-.1-2.1-.1-3.3-.1-1.2-.1-1.6-.1-4.9 0-3.3.4-3.7-.1-4.9-.1-1.1-.1-2.1-.1-3.3C24 1.6 22.4 0 20.2 0c-1.1 0-2.1.1-3.3.1-1.2 0-1.6-.1-4.9-.1zM12 5.9c3.4 0 6.1 2.8 6.1 6.1 0 3.4-2.8 6.1-6.1 6.1-3.4 0-6.1-2.8-6.1-6.1 0-3.4 2.8-6.1 6.1-6.1zM18.7 4c.7 0 1.2.6 1.2 1.2 0 .7-.6 1.2-1.2 1.2-.7 0-1.2-.6-1.2-1.2 0-.7.6-1.2 1.2-1.2z"></path>
        </svg>
      </a>
    </li>

  </ul>
</nav>

