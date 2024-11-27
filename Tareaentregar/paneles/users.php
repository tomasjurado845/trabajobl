<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conectar a la base de datos
$servername = "basedatos";
$username = "root";
$password = "";
$database = "devolteca";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Validar credenciales del administrador (puedes cambiar esto para hacerlo dinámico desde la DB)
    if ($usuario === 'tomasjurado28@gmail.com' && $password === 'root') {
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php"); // Redirigir al dashboard
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

// Si el usuario ya está autenticado, redirigir al dashboard
if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form method="POST">
            <input type="text" name="usuario" required placeholder="Correo electrónico">
            <input type="password" name="password" required placeholder="Contraseña">
            <button type="submit" name="login">Iniciar Sesión</button>
        </form>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
