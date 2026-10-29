<?php
session_start();

if (!isset($_SESSION['web_autenticado']) || $_SESSION['web_autenticado'] !== true) {
    header('Location: index.php');
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['comprobante'])) {
    $archivo = $_FILES['comprobante'];
    $carpeta_destino = 'comprobantes/';

    if (!file_exists($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }

    if ($archivo['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = basename($archivo['name']);
        $ruta_final = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($archivo['tmp_name'], $ruta_final)) {
            $mensaje = "El archivo se ha cargado correctamente: " . $nombre_archivo;
        } else {
            $mensaje = "Ocurrió un error al guardar el archivo en el servidor.";
        }
    } else {
        $mensaje = "Ocurrió un error en la carga del archivo. Código: " . $archivo['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Comprobante</title>
</head>
<body>
    <h2>Subir Comprobante de Pago</h2>
    <p><a href="panel.php">Volver al Panel</a></p>

    <?php if ($mensaje !== ''): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>

    <form action="subir_comprobante.php" method="POST" enctype="multipart/form-data">
        <label>Seleccionar archivo comprobante:</label><br><br>
        <input type="file" name="comprobante" required><br><br>
        <button type="submit">Cargar Archivo</button>
    </form>
</body>
</html>