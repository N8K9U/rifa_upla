<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['api_autenticado']) || $_SESSION['api_autenticado'] !== true) {
    http_response_code(401);
    echo json_encode(["status" => "error", "mensaje" => "Acceso denegado. Sesion no iniciada."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $numero_rifa = $_POST['numero_rifa'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(["status" => "error", "mensaje" => "Se requiere el ID del participante"]);
        exit;
    }

    $json_data = file_get_contents('participantes.json');
    $participantes = json_decode($json_data, true);
    $encontrado = false;

    foreach ($participantes as &$p) {
        if ($p['id'] == $id) {
            if ($nombre !== null) $p['nombre'] = $nombre;
            if ($apellido !== null) $p['apellido'] = $apellido;
            if ($numero_rifa !== null) $p['numero_rifa'] = (int)$numero_rifa;
            $encontrado = true;
            break;
        }
    }

    if ($encontrado) {
        file_put_contents('participantes.json', json_encode($participantes, JSON_PRETTY_PRINT));
        echo json_encode(["status" => "success", "mensaje" => "Participante actualizado correctamente"]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "mensaje" => "Participante no encontrado"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "mensaje" => "Metodo no permitido"]);
}