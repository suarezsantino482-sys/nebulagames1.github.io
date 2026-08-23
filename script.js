// 1. PRUEBA INMEDIATA: Si ves este mensaje flotante al cargar la página, el archivo JS funciona.
alert("¡JavaScript cargado correctamente en Nebula Games!");

// 2. CÓDIGO DE VALIDACIÓN Y MANEJO DEL FORMULARIO
document.addEventListener('DOMContentLoaded', function() {
    
    // Buscamos el formulario por la clase o por el ID
    const formulario = document.getElementById('formulario-contacto') || document.querySelector('.form-arcade');
    const mensajeExito = document.getElementById('mensajeExito');

    if (formulario) {
        formulario.addEventListener('submit', function(evento) {
            // DETENER la redirección a la pantalla negra (httpbin)
            evento.preventDefault();

            // Obtener los valores que escribió el usuario
            const nombreInput = document.getElementById('nombre');
            const correoInput = document.getElementById('correo');
            
            const nombre = nombreInput ? nombreInput.value.trim() : 'Gamer';
            const correo = correoInput ? correoInput.value.trim() : '';

            // Mostrar cartel en la ventana
            alert("¡Excelente " + nombre + "! Tu mensaje fue enviado con éxito.");

            // Si existe el contenedor de mensaje en la página, mostrarlo con estilo neón
            if (mensajeExito) {
                mensajeExito.style.display = 'block';
                mensajeExito.innerHTML = '✔ ¡Gracias por contactarnos, <strong>' + nombre + '</strong> (' + correo + ')! Tu mensaje ha sido registrado.';
            }

            // Limpiar los campos del formulario
            formulario.reset();
        });
    } else {
        console.log("No se encontró el formulario en esta página.");
    }
});
