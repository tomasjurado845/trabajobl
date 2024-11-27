// config.js

// Cambiar tema de la página (oscuro o claro)
function changeTheme() {
    const currentTheme = document.body.getAttribute("data-theme");
    document.body.setAttribute("data-theme", currentTheme === "dark" ? "light" : "dark");
}

// Configurar notificaciones (puedes ampliar esto más según tus necesidades)
function configureNotifications() {
    const notificationsEnabled = confirm("¿Quieres habilitar las notificaciones?");
    if (notificationsEnabled) {
        alert("Las notificaciones están habilitadas.");
    } else {
        alert("Las notificaciones están deshabilitadas.");
    }
}

// Función para gestionar administradores
function manageAdmins() {
    alert("Gestionando administradores...");
    // Aquí podrías abrir una ventana modal para agregar/eliminar administradores
}

// Editar página
function editPage() {
    alert("Entrando al editor de página...");
    // Aquí puedes permitir la edición del contenido de la página
}
