<?php
session_start();

if (!isset($_SESSION['web_autenticado']) || $_SESSION['web_autenticado'] !== true) {
    header('Location: index.php');
    exit;
}

$participantes_validos = [
    [
        "nombre" => "Universidad",
        "apellido" => "Playa Ancha",
        "ciudad" => "Valparaiso",
        "categoria" => "Grupo A"
    ],
    [
        "nombre" => "Carlos",
        "apellido" => "Muñoz",
        "ciudad" => "Viña del Mar",
        "categoria" => "Grupo B"
    ],
    [
        "nombre" => "Ana",
        "apellido" => "Rojas",
        "ciudad" => "Quilpué",
        "categoria" => "Grupo A"
    ],
    [
        "nombre" => "Pedro",
        "apellido" => "Soto",
        "ciudad" => "Concón",
        "categoria" => "Grupo C"
    ]
];

$resultado_busqueda = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['buscar'])) {
    $b_nombre = trim($_GET['nombre'] ?? '');
    $b_apellido = trim($_GET['apellido'] ?? '');
    $b_ciudad = trim($_GET['ciudad'] ?? '');
    $b_categoria = trim($_GET['categoria'] ?? '');

    $encontrado = false;

    foreach ($participantes_validos as $p) {
        if (
            strcasecmp($p['nombre'], $b_nombre) === 0 &&
            strcasecmp($p['apellido'], $b_apellido) === 0 &&
            strcasecmp($p['ciudad'], $b_ciudad) === 0 &&
            strcasecmp($p['categoria'], $b_categoria) === 0
        ) {
            $encontrado = true;
            break;
        }
    }

    if ($encontrado) {
        $resultado_busqueda = "Participante encontrado";
    } else {
        $resultado_busqueda = "Participante no encontrado";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Participante</title>
</head>
<body>
    <h2>Búsqueda de Participantes</h2>
    <p><a href="panel.php">Volver al Panel</a></p>

    <form action="buscar.php" method="GET">
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
        </div><br>
        <div>
            <label>Apellido:</label>
            <input type="text" name="apellido" required>
        </div><br>
        <div>
            <label>Ciudad:</label>
            <input type="text" name="ciudad" required>
        </div><br>
        <div>
            <label>Categoría:</label>
            <input type="text" name="categoria" required>
        </div><br>
        <button type="submit" name="buscar" value="1">Buscar</button>
    </form>

    <?php if ($resultado_busqueda !== ''): ?>
        <h3>Resultado: <?php echo $resultado_busqueda; ?></h3>
    <?php endif; ?>
</body>
</html>