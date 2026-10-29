<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['api_autenticado']) || $_SESSION['api_autenticado'] !== true) {
    http_response_code(401);
    echo json_encode(["status" => "error", "mensaje" => "Acceso denegado. Sesion no iniciada."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $numero_rifa = $_POST['numero_rifa'] ?? '';

    if (empty($nombre) || empty($apellido) || empty($numero_rifa)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "mensaje" => "Todos los campos son obligatorios"]);
        exit;
    }

    $json_data = file_get_contents('participantes.json');
    $participantes = json_decode($json_data, true);

    $nuevo_id = 1;
    if (!empty($participantes)) {
        $ultimo = end($participantes);
        $nuevo_id = $ultimo['id'] + 1;
    }

    $nuevo_participante = [
        "id" => $nuevo_id,
        "nombre" => $nombre,
        "apellido" => $apellido,
        "numero_rifa" => (int)$numero_rifa
    ];

    $participantes[] = $nuevo_participante;
    file_put_contents('participantes.json', json_encode($participantes, JSON_PRETTY_PRINT));

    echo json_encode(["status" => "success", "mensaje" => "Participante registrado exitosamente", "data" => $nuevo_participante]);
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "mensaje" => "Metodo no permitido"]);
}