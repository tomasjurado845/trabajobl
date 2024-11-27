<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "devolteca";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET usuario='$usuario', password='$password' WHERE id=$id";
    $conn->query($sql);
    header("Location: usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <?php if (isset($user)): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="text" name="usuario" value="<?= $user['usuario'] ?>" required placeholder="Usuario">
            <input type="password" name="password" placeholder="Nueva Contraseña">
            <button type="submit" name="edit_user">Actualizar Usuario</button>
        </form>
        <?php else: ?>
            <p>Usuario no encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
