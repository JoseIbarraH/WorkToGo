document.getElementById('imagen').addEventListener('change', function(event) {
    const archivo = event.target.files[0]; // Obtiene el archivo seleccionado por el usuario

    if (archivo) {
        const lector = new FileReader(); // Crea un FileReader para leer el archivo

        lector.onload = function(e) {
            const vistaPrevia = document.getElementById('vistaPrevia');
            vistaPrevia.src = e.target.result; // Establece el resultado de la lectura como la fuente de la imagen
        };

        lector.readAsDataURL(archivo); // Lee el archivo como una URL de datos
    }
});
