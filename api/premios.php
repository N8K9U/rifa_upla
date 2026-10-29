<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['api_autenticado']) || $_SESSION['api_autenticado'] !== true) {
    http_response_code(401);
    echo json_encode(["status" => "error", "mensaje" => "Acceso denegado. Sesion no iniciada."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $json_data = file_get_contents('premios.json');
    echo $json_data;
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "mensaje" => "Metodo no permitido"]);
}