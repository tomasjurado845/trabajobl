<?php
// Incluir el archivo de login.php para manejar la autenticación y la conexión
include("login.php");

// Verificamos si la sesión está iniciada, si no, redirigimos al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir a la página de login si no ha iniciado sesión
    exit();
}

// Verificar la conexión a la base de datos
if (!$conx) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta a la base de datos para obtener todos los usuarios
$resultado = $conx->query("SELECT * FROM usuarios");

if (!$resultado) {
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #e9f5e9;
        }
        h1 {
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #a5d6a7;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
        }
        a:hover {
            text-decoration: underline;
        }
        .add-user {
            color: #4CAF50;
            font-size: 18px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Listado de Usuarios</h1>

    <!-- Enlace para agregar nuevo usuario -->
    <a href="nuevo.php" class="add-user">Agregar nuevo Usuario</a>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = $resultado->fetch_object()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($fila->id); ?></td>
                <td><?php echo htmlspecialchars($fila->email); // Cambiado de "usuario" a "email" ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $fila->id; ?>">Editar</a> |
                    <a href="eliminar.php?id=<?php echo $fila->id; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
