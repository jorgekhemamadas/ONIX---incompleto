<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["video"]["name"]);
        $uploadOk = 1;
        $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Verifica si el archivo es un video
        $allowedTypes = array("mp4", "avi", "mov", "wmv");
        if (!in_array($videoFileType, $allowedTypes)) {
            echo "Solo se permiten archivos de video MP4, AVI, MOV y WMV.";
            $uploadOk = 0;
        }

        // Verifica si $uploadOk es 0 por un error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
                echo "El video ha sido subido exitosamente.";
            } else {
                echo "Error al subir el video.";
            }
        }
    } else {
        echo "Error en la carga del archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Video</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Subir Video</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="video" required>
        <input type="submit" value="Subir Video">
    </form>
    <a href="index.php">Volver a la Página Principal</a>
</body>
</html>
