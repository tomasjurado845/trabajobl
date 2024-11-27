<?php
session_start();
require 'db.php'; // Incluir el archivo de conexión

$usuarios_incorrectos = 'usuarios_incorrectos.txt'; 
$intentos_maximos = 10; 
$tiempo_bloqueo = 300; 
$usuario_bloqueado = 'usuario_bloqueado.txt'; 

// Verificar si el usuario está bloqueado
if (file_exists($usuario_bloqueado) && time() - filemtime($usuario_bloqueado) < $tiempo_bloqueo) {
    die('Tu cuenta está bloqueada. Intenta nuevamente más tarde.'); // Bloquear acceso si está bloqueado
}

// Si se reciben datos de un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Comprobamos si ya existen intentos fallidos en el archivo
    if (file_exists($usuarios_incorrectos)) {
        $intentos_fallidos = count(file($usuarios_incorrectos)); // Contar los intentos fallidos
    } else {
        $intentos_fallidos = 0; // Inicializar si el archivo no existe
    }

    // Consultar la base de datos para obtener el usuario
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario'] = $usuario; // Iniciar sesión si las credenciales son correctas

        // Redirigir según el usuario
        if ($usuario === 'tomasjurado28@gmail.com') {
            header('Location: paneles/dashboard.php?section=admin'); // Redirigir a dashboard
            exit();
        } elseif ($usuario === 'rodotel1373@gmail.com') {
            header('Location: paneles/panel.php?section=admin'); // Redirigir a panel
            exit();
        }
    } else {
        // Guardar intento de inicio de sesión fallido
        $registro_fallido = date('Y-m-d H:i:s') . " - Usuario: " . $usuario . "\n";
        file_put_contents($usuarios_incorrectos, $registro_fallido, FILE_APPEND); // Agregar a archivo

        // Comprobar si se ha superado el límite de intentos
        if ($intentos_fallidos >= $intentos_maximos) {
            file_put_contents($usuario_bloqueado, "Usuario: $usuario bloqueado\n"); // Bloquear usuario
            die('Tu cuenta ha sido bloqueada debido a múltiples intentos fallidos.'); // Mensaje de bloqueo
        }

        echo '<p class="error">Usuario o contraseña incorrectos.</p>'; // Mensaje de error
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="Complejos/Estilos/login_styles.css">
</head>
<body>
    <form method ="POST">
        <h2>Iniciar Sesión</h2>
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" placeholder="Ingresa tu correo" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>