// helpers.js

// Función para mostrar un mensaje de error
function showError(message) {
    alert("Error: " + message);
}

// Función para mostrar un mensaje de éxito
function showSuccess(message) {
    alert("Éxito: " + message);
}

// Función para realizar una petición Ajax (simulada aquí con setTimeout)
function sendAjaxRequest(url, data, successCallback, errorCallback) {
    setTimeout(() => {
        const success = Math.random() > 0.2; // Simulamos el éxito con una probabilidad del 80%
        if (success) {
            successCallback({ message: "Datos enviados correctamente." });
        } else {
            errorCallback({ message: "Ocurrió un error al enviar los datos." });
        }
    }, 1000);
}

// Función para actualizar la interfaz de usuario
function updateUI(content) {
    document.querySelector('.dynamic-content').innerHTML = content;
}
