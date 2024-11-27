<?php
session_start();
require 'db.php'; // Incluir el archivo de conexión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redirigir al login si no está autenticado
    exit;
}

// Manejo del formulario de agregar post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['usuario'])) {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $title = $_POST['title'];
        $author = $_SESSION['usuario']; // El autor es el usuario que ha iniciado sesión
        $content = $_POST['content'];
        $image = $_POST['image'];

        // Insertar el nuevo post en la base de datos
        $stmt = $pdo->prepare("INSERT INTO posts (title, author, date, image, content) VALUES (:title, :author, :date, :image, :content)");
        $stmt->execute([
            'title' => $title,
            'author' => $author,
            'date' => date('Y-m-d'),
            'image' => $image,
            'content' => $content
        ]);
    }
}

// Obtener las noticias del usuario actual
$posts = [];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE author = :author");
$stmt->execute(['author' => $_SESSION['usuario']]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
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
        .admin-panel input[type="text"],
        .admin-panel textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #76ff03;
            border-radius: 4px;
            background-color: #2a2a2a;
            color: #e0e0e0;
        }
        .admin-panel button {
            background-color: #76ff03;
            color: #121212;
            border: none;
            padding: 10px 15px;
            border-radius:  4px;
            cursor: pointer;
        }
        .admin-panel button:hover {
            background-color: #64dd17;
        }
        .post {
            background-color: #2a2a2a;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin: 20px 0;
            padding: 20px;
        }
        .post img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .post-content {
            margin-top: 10px;
        }
        .post-content h3 {
            margin: 0 0 10px;
            color: #76ff03;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Panel de Usuario</div>
    </div>

    <div class="admin-panel">
        <h2>Agregar Nueva Noticia</h2>
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <input type="text" name="title" placeholder="Título" required>
            <input type="text" name="image" placeholder="URL de la imagen" required>
            <textarea name="content" placeholder="Contenido" required></textarea>
            <button type="submit">Agregar Noticia</button>
        </form>
    </div>

    <div class="related-posts">
        <h2>Mis Noticias</h2>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                <div class="post-content">
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <div class="author">Por: <?php echo htmlspecialchars($post['author']); ?> | Fecha: <?php echo htmlspecialchars($post['date']); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>