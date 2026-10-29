<?php
session_start();

if (!isset($_SESSION['web_autenticado']) || $_SESSION['web_autenticado'] !== true) {
    header('Location: index.php');
    exit;
}

$precio_unitario = 2000;

if (!isset($_SESSION['numeros_reservados'])) {
    $_SESSION['numeros_reservados'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] === 'agregar') {
            $_SESSION['numeros_reservados']++;
        } elseif ($_POST['accion'] === 'quitar') {
            if ($_SESSION['numeros_reservados'] > 0) {
                $_SESSION['numeros_reservados']--;
            }
        }
    }
}

$cantidad = $_SESSION['numeros_reservados'];
$total = $cantidad * $precio_unitario;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Rifa</title>
</head>
<body>
    <h2>Reserva de Números de Rifa</h2>
    <p><a href="panel.php">Volver al Panel</a></p>
    
    <p><strong>Precio por número:</strong> $<?php echo number_format($precio_unitario, 0, ',', '.'); ?></p>
    <p><strong>Cantidad de números reservados:</strong> <?php echo $cantidad; ?></p>
    <p><strong>Total a pagar:</strong> $<?php echo number_format($total, 0, ',', '.'); ?></p>

    <form action="rifa.php" method="POST">
        <button type="submit" name="accion" value="agregar">Agregar Número (+1)</button>
        <button type="submit" name="accion" value="quitar">Quitar Número (-1)</button>
    </form>
</body>
</html>