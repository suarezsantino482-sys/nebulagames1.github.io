/* =========================================================
   1. MENSAJE DE BIENVENIDA
   ========================================================= */
window.addEventListener('DOMContentLoaded', () => {
    console.log("¡Bienvenido a Nebula Games! Carga completa.");
    // Si querés que salte la ventana emergente, descomentá la siguiente línea:
    // alert("¡Bienvenido a Nebula Games! Inserta moneda para comenzar.");
});

/* =========================================================
   2 y 7. VALIDACIÓN DE FORMULARIO CON ERRORES Y RESUMEN
   ========================================================= */
const formulario = document.getElementById('miFormulario');

if (formulario) {
    formulario.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita que la página se recargue
        
        // Obtener campos
        const nombre = document.getElementById('nombre');
        const email = document.getElementById('email');
        const errorNombre = document.getElementById('errorNombre');
        const errorEmail = document.getElementById('errorEmail');
        const resumen = document.getElementById('resumenDatos');
        
        let valido = true;
        
        // Limpiar errores previos
        errorNombre.textContent = '';
        errorEmail.textContent = '';

        // Validar nombre no vacío
        if (nombre.value.trim() === '') {
            errorNombre.textContent = '❌ Por favor, ingresá tu nombre o Gamer Tag.';
            valido = false;
        }

        // Validar formato de Email mediante Expresión Regular
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(email.value)) {
            errorEmail.textContent = '❌ Ingresá un correo electrónico válido (ej: usuario@mail.com).';
            valido = false;
        }

        // Si pasa las validaciones, mostrar resumen (Punto 7)
        if (valido) {
            resumen.innerHTML = `
                <div style="background: #111133; border: 2px solid #00ffff; padding: 15px; margin-top: 15px;">
                    <h4 style="color: #ff00ff;">📋 Resumen de la inscripción:</h4>
                    <p><strong>Jugador:</strong> ${nombre.value}</p>
                    <p><strong>Contacto:</strong> ${email.value}</p>
                    <p style="color: #00ffff;">¡Registro completado con éxito!</p>
                </div>
            `;
        }
    });
}

/* =========================================================
   3. FECHA Y HORA EN TIEMPO REAL
   ========================================================= */
function actualizarReloj() {
    const contenedorReloj = document.getElementById('relojArcade');
    if (contenedorReloj) {
        const ahora = new Date();
        const fecha = ahora.toLocaleDateString('es-AR');
        const hora = ahora.toLocaleTimeString('es-AR');
        contenedorReloj.textContent = `📅 ${fecha} | ⏰ ${hora}`;
    }
}
// Actualiza la hora cada 1 segundo (1000 ms)
setInterval(actualizarReloj, 1000);
actualizarReloj(); // Ejecutar al instante

/* =========================================================
   4. MENÚ INTERACTIVO (MOSTRAR / OCULTAR SECCIÓN)
   ========================================================= */
function alternarSeccion(idSeccion) {
    const seccion = document.getElementById(idSeccion);
    if (seccion) {
        if (seccion.style.display === 'none' || seccion.style.display === '') {
            seccion.style.display = 'block';
        } else {
            seccion.style.display = 'none';
        }
    }
}

/* =========================================================
   5. GALERÍA DE IMÁGENES (SIGUIENTE / ANTERIOR Y AMPLIAR)
   ========================================================= */
const imagenesGaleria = [
    'imagenes/nes.jfif',
    'imagenes/snes.jpg',
    'imagenes/genesis.jpg'
];
let indiceActual = 0;

function cambiarImagen(direccion) {
    const visor = document.getElementById('visorGaleria');
    if (!visor) return;

    indiceActual += direccion;
    
    // Bucle para que no se pase de los límites
    if (indiceActual < 0) indiceActual = imagenesGaleria.length - 1;
    if (indiceActual >= imagenesGaleria.length) indiceActual = 0;

    visor.src = imagenesGaleria[indiceActual];
}

function ampliarImagen(elementoImg) {
    const modal = document.getElementById('modalImagen');
    const imgAmpliada = document.getElementById('imgAmpliada');
    if (modal && imgAmpliada) {
        modal.style.display = 'flex';
        imgAmpliada.src = elementoImg.src;
    }
}

function cerrarModal() {
    const modal = document.getElementById('modalImagen');
    if (modal) modal.style.display = 'none';
}

/* =========================================================
   6. CAMBIAR TEMA (MODO CLARO / MODO OSCURO)
   ========================================================= */
function alternarModoOscuro() {
    // Alterna la clase 'modo-claro' en el elemento body
    document.body.classList.toggle('modo-claro');
}