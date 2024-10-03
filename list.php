<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

// Directorio donde se almacenan los videos
$targetDir = "uploads/";
$videos = array_diff(scandir($targetDir), array('.', '..')); // Obtiene archivos, omitiendo . y ..

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Videos Subidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Videos Subidos</h1>
    <a href="index">Volver a la Página Principal</a>
    <div>
        <?php if (empty($videos)): ?>
            <p>No hay videos subidos aún.</p>
        <?php else: ?>
            <?php foreach ($videos as $video): ?>
                <div>
                    <h3><?php echo htmlspecialchars($video); ?></h3>
                    <video width="320" height="240" controls>
                        <source src="<?php echo $targetDir . htmlspecialchars($video); ?>" type="video/<?php echo pathinfo($video, PATHINFO_EXTENSION); ?>">
                        Tu navegador no soporta el elemento de video.
                    </video>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
