<?php
// Solo los administradores pueden ver este panel
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'tomasjurado28@gmail.com') {
    echo '<h2>Usuarios Incorrectos</h2>';
    
    // Verificar si el archivo de usuarios incorrectos existe y mostrar su contenido
    $usuarios_incorrectos = 'usuarios_incorrectos.txt';
    if (file_exists($usuarios_incorrectos)) {
        $usuarios_fallidos = file($usuarios_incorrectos, FILE_IGNORE_NEW_LINES);
        
        if (!empty($usuarios_fallidos)) {
            echo '<ul>';
            foreach ($usuarios_fallidos as $usuario_fallido) {
                echo '<li>' . htmlspecialchars($usuario_fallido) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No se encontraron usuarios incorrectos.</p>';
        }
    } else {
        echo '<p>No se han registrado usuarios incorrectos.</p>';
    }
} else {
    echo '<p>No tienes acceso a esta sección.</p>';
}
?>
