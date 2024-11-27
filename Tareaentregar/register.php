<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece el conjunto de caracteres a UTF-8 para soportar caracteres especiales -->
    <title>Crear Cuenta</title> <!-- Título de la página que aparecerá en la pestaña del navegador -->
    <link rel="stylesheet" href="complejos/Estilos/login_styles.css"> <!-- Enlace al archivo CSS que contiene los estilos de la página -->
    </head>
<body>
    <!-- Inicia el formulario para crear una cuenta -->
    <form method="POST" class="login-form"> <!-- Usamos el método POST para enviar datos de manera segura -->
        <h2>Crear Cuenta</h2> <!-- Título del formulario -->
        
        <!-- Sección para ingresar el nombre de usuario -->
        <div class="form-group">
            <label for="usuario">Usuario:</label> <!-- Etiqueta que describe el campo de entrada -->
            <input type="text" name="usuario" placeholder="Ingresa tu usuario" required> <!-- Campo de entrada para el usuario -->
        </div>
        
        <!-- Sección para ingresar el correo electrónico -->
        <div class="form-group">
            <label for="email">Correo electrónico:</label> <!-- Etiqueta para el campo de correo -->
            <input type="email" name="email" placeholder="Ingresa tu correo" required> <!-- Campo de entrada para el correo electrónico -->
        </div>
        
        <!-- Sección para ingresar la contraseña -->
        <div class="form-group">
            <label for="password">Contraseña:</label> <!-- Etiqueta para el campo de contraseña -->
            <input type="password" name="password" placeholder="Ingresa tu contraseña" required> <!-- Campo de entrada para la contraseña -->
        </div>
        
        <!-- Botón para enviar el formulario -->
        <button type="submit">Crear Cuenta</button> <!-- Al hacer clic en este botón, se envían los datos del formulario -->
        
        <!-- Enlace para redirigir a la página de inicio de sesión si el usuario ya tiene cuenta -->
        <p class="register-link">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p> <!-- Enlace para iniciar sesión -->
    </form>
</body>
</html>
