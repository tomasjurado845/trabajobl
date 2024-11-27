// fileManager.js

// Función para manejar la carga de archivos
function handleFileUpload(fileInput, previewId) {
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = document.getElementById(previewId);
            preview.src = event.target.result; // Mostrar imagen subida como vista previa
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    } else {
        alert("No se seleccionó ningún archivo.");
    }
}

// Función para eliminar archivo
function removeFile(previewId) {
    const preview = document.getElementById(previewId);
    preview.src = "";  // Limpiar la imagen de vista previa
    preview.style.display = "none";
}
