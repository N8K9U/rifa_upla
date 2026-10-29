<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';
    $captcha_res = $_POST['captcha_respuesta'] ?? '';

    $captcha_valido = isset($_SESSION['captcha_resultado']) && ((int)$captcha_res === $_SESSION['captcha_resultado']);

    if ($user === 'userupla' && $pass === 'upla123' && $captcha_valido) {
        $_SESSION['web_autenticado'] = true;
        $_SESSION['web_usuario'] = $user;
        header('Location: panel.php');
        exit;
    } else {
        $error = "Credenciales o CAPTCHA incorrectos. Intente nuevamente.";
    }
}

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$_SESSION['captcha_resultado'] = $num1 + $num2;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema Rifa UPLA</title>
</head>
<body>
    <h2>Inicio de Sesion - Sistema Web</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <div>
            <label>Usuario:</label>
            <input type="text" name="usuario" required>
        </div>
        <br>
        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <div>
            <label>CAPTCHA: ¿Cuánto es <?php echo $num1 . " + " . $num2; ?>?</label>
            <input type="number" name="captcha_respuesta" required>
        </div>
        <br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>