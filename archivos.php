<?php
session_start();

if (!isset($_SESSION['web_autenticado']) || $_SESSION['web_autenticado'] !== true) {
    header('Location: index.php');
    exit;
}

$carpeta = 'comprobantes/';
$archivos = [];

if (is_dir($carpeta)) {
    $contenido = scandir($carpeta);
    foreach ($contenido as $item) {
        if ($item !== '.' && $item !== '..') {
            $archivos[] = $item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Archivos Subidos</title>
</head>
<body>
    <h2>Listado de Comprobantes Cargados</h2>
    <p><a href="panel.php">Volver al Panel</a></p>

    <?php if (empty($archivos)): ?>
        <p>No hay archivos cargados en la carpeta.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($archivos as $arc): ?>
                <li>
                    <a href="comprobantes/<?php echo $arc; ?>" target="_blank">
                        <?php echo $arc; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>