<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuario === 'admin' && $password === '1234') {
        $_SESSION['api_autenticado'] = true;
        $_SESSION['api_usuario'] = $usuario;
        echo json_encode(["status" => "success", "mensaje" => "Sesion iniciada correctamente en API"]);
    } else {
        http_response_code(401);
        echo json_encode(["status" => "error", "mensaje" => "Credenciales incorrectas"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "mensaje" => "Metodo no permitido"]);
}