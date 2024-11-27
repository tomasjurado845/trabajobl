<?php
session_start();

// Configuración de la base de datos
$host = 'localhost'; // Cambia si es necesario
$db = 'mi_base_de_datos'; // Nombre de tu base de datos
$user = 'root'; // Usuario de la base de datos
$pass = ''; // Contraseña de la base de datos

// Conectar a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Obtener datos de la base de datos
$posts = [];
$users = [];

try {
    // Obtener posts
    $stmt = $pdo->query("SELECT * FROM posts");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtener usuarios
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al recuperar datos: " . $e->getMessage());
}

// Notificaciones administrativas (simuladas)
$adminNotifications = [
    'Se han agregado 5 nuevos usuarios.',
    'Se han publicado 3 nuevas noticias.',
    'Revisar comentarios pendientes.'
];

// Estadísticas
$totalUsers = count($users);
$totalPosts = count($posts);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400,700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #1f1f1f;
            color: #76ff03;
        }
        .header .title {
            font-size: 24px;
            font-weight: bold;
            margin-right: auto;
        }
        .admin-panel {
            margin: 20px;
            padding: 20px;
            background-color: #1f1f1f;
            border-radius: 8px;
        }
        .admin-panel h2 {
            margin-top: 0;
            color: #76ff03;
        }
        .notification {
            background-color: #2a2a2a;
            border-radius: 8px;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Panel de Administración</div>
    </div>

    <div class="admin-panel">
        <h2>Notificaciones Administrativas</h2>
        <?php foreach ($adminNotifications as $notification): ?>
            <div class="notification">
                <?php echo htmlspecialchars($notification); ?>
            </div>
        <?php endforeach; ?>
    ```php
    </div>

    <div class="admin-panel">
        <h2>Estadísticas</h2>
        <p>Total de usuarios registrados: <?php echo $totalUsers; ?></p>
        <p>Total de noticias publicadas: <?php echo $totalPosts; ?></p>
        <!-- Puedes agregar más estadísticas aquí -->
    </div>

    <div class="admin-panel">
        <h2>Noticias Publicadas</h2>
        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p>Autor: <?php echo htmlspecialchars($post['author']); ?></p>
                    <p>Fecha: <?php echo htmlspecialchars($post['date']); ?></p>
                    <p>Imagen: <?php echo htmlspecialchars($post['image']); ?></p>
                    <p>Contenido: <?php echo htmlspecialchars($post['content']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="admin-panel">
        <h2>Usuarios Registrados</h2>
        <ul>
            <?php foreach ($users as $user): ?>
                <li>
                    <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html><?php
// Cerrar la conexión a la base de datos si es necesario
if (isset($conn)) {
    $conn->close();
}
?>