<?php
$host = 'localhost'; // Cambia esto si tu base de datos no está en localhost
$db = 'mi_base_de_datos'; // Cambia esto por el nombre de tu base de datos
$user = 'tu_usuario'; // Cambia esto por tu usuario de base de datos
$pass = 'tu_contraseña'; // Cambia esto por tu contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>