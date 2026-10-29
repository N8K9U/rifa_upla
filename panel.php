<?php
session_start();

if (!isset($_SESSION['web_autenticado']) || $_SESSION['web_autenticado'] !== true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal</title>
</head>
<body>
    <h1>Bienvenido al Panel del Sistema de Rifa</h1>
    <p>Usuario: <strong><?php echo $_SESSION['web_usuario']; ?></strong></p>
    <hr>
    <nav>
        <ul>
            <li><a href="rifa.php">Reserva de Números de Rifa</a></li>
            <li><a href="buscar.php">Búsqueda de Participantes</a></li>
            <li><a href="subir_comprobante.php">Subir Comprobante</a></li>
            <li><a href="archivos.php">Ver Archivos Subidos</a></li>
            <li><a href="salir.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>