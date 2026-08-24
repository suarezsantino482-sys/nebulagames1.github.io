/* =========================================================
   NEBULA GAMES - ARCHIVO PRINCIPAL DE JAVASCRIPT (script.js)
   ========================================================= */

// Ejecutar cuando todo el HTML haya cargado
document.addEventListener('DOMContentLoaded', () => {

    /* -----------------------------------------------------
       PUNTO 1: Mostrar mensaje o alerta al cargar
       ----------------------------------------------------- */
    // Muestra un saludo inicial si estamos en la página de inicio
    if (window.location.pathname.includes('index.html') || window.location.pathname === '/') {
        console.log("¡Bienvenido a Nebula Games!");
        // Si querés que salte la ventana emergente, descomentá la siguiente línea:
        // alert("¡Bienvenido a Nebula Games! Inserta moneda para comenzar.");
    }


    /* -----------------------------------------------------
       PUNTO 3: Fecha y hora en tiempo real
       ----------------------------------------------------- */
    const reloj = document.getElementById('relojArcade');
    
    function actualizarReloj() {
        if (reloj) {
            const ahora = new Date();
            const fecha = ahora.toLocaleDateString('es-AR');
            const hora = ahora.toLocaleTimeString('es-AR');
            reloj.textContent = `📅 ${fecha} | ⏰ ${hora}`;
        }
    }
    // Actualizar cada 1 segundo (1000ms)
    setInterval(actualizarReloj, 1000);
    actualizarReloj();


    /* -----------------------------------------------------
       PUNTO 4: Menú interactivo (Acordeón mostrar/ocultar)
       ----------------------------------------------------- */
    const btnAcordeon = document.getElementById('btnAcordeon');
    const panelAcordeon = document.getElementById('panelAcordeon');

    if (btnAcordeon && panelAcordeon) {
        btnAcordeon.addEventListener('click', () => {
            if (panelAcordeon.style.display === 'none' || panelAcordeon.style.display === '') {
                panelAcordeon.style.display = 'block';
            } else {
                panelAcordeon.style.display = 'none';
            }
        });
    }


    /* -----------------------------------------------------
       PUNTO 5: Galería de imágenes (Anterior/Siguiente y Modal)
       ----------------------------------------------------- */
    const visor = document.getElementById('visorGaleria');
    const btnAnterior = document.getElementById('btnAnterior');
    const btnSiguiente = document.getElementById('btnSiguiente');
    const modal = document.getElementById('modalImg');
    const imgGrande = document.getElementById('imgGrande');

    // Lista de rutas de tus imágenes
    const imagenes = ['imagenes/nes.jfif', 'imagenes/snes.jpg', 'imagenes/genesis.jpg'];
    let indiceGaleria = 0;

    if (visor && btnAnterior && btnSiguiente) {
        // Pasar a la siguiente imagen
        btnSiguiente.addEventListener('click', () => {
            indiceGaleria = (indiceGaleria + 1) % imagenes.length;
            visor.src = imagenes[indiceGaleria];
        });

        // Pasar a la imagen anterior
        btnAnterior.addEventListener('click', () => {
            indiceGaleria = (indiceGaleria - 1 + imagenes.length) % imagenes.length;
            visor.src = imagenes[indiceGaleria];
        });

        // Ampliar imagen al hacer clic
        visor.addEventListener('click', () => {
            if (modal && imgGrande) {
                modal.style.display = 'flex';
                imgGrande.src = visor.src;
            }
        });
    }

    // Cerrar imagen ampliada al hacer clic en el fondo
    if (modal) {
        modal.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }


    /* -----------------------------------------------------
       PUNTO 6: Cambiar el tema de la página (Modo Claro/Oscuro)
       ----------------------------------------------------- */
    const btnTema = document.getElementById('btnTema');

    if (btnTema) {
        btnTema.addEventListener('click', () => {
            document.body.classList.toggle('modo-claro');
        });
    }


    /* -----------------------------------------------------
       PUNTOS 2 y 7: Validación de Formulario y Resumen
       ----------------------------------------------------- */
    const formulario = document.getElementById('formulario-contacto') || document.querySelector('.form-arcade');
    const resumenContainer = document.getElementById('resumenInscripcion');

    if (formulario) {
        formulario.addEventListener('submit', (e) => {
            // Evitar que la página recargue o vaya a la pantalla negra
            e.preventDefault();

            // Obtener inputs
            const nombreInput = document.getElementById('nombre');
            const correoInput = document.getElementById('correo');
            const mensajeInput = document.getElementById('mensaje');

            const nombre = nombreInput ? nombreInput.value.trim() : '';
            const correo = correoInput ? correoInput.value.trim() : '';
            const mensaje = mensajeInput ? mensajeInput.value.trim() : '';

            // Validación (Punto 2)
            if (nombre.length < 3) {
                alert("❌ El nombre o GamerTag debe tener al menos 3 caracteres.");
                return;
            }

            if (!correo.includes('@') || !correo.includes('.')) {
                alert("❌ Por favor, ingresá un correo electrónico válido.");
                return;
            }

            // Mostrar Resumen (Punto 7)
            if (resumenContainer) {
                resumenContainer.style.display = 'block';
                resumenContainer.innerHTML = `
                    <div style="background: #111133; border: 2px solid #00ffff; padding: 15px; margin-bottom: 20px;">
                        <h3 style="color: #ff00ff; margin-top: 0;">📋 RESUMEN DE REGISTRO</h3>
                        <p><strong>Jugador:</strong> ${nombre}</p>
                        <p><strong>Correo:</strong> ${correo}</p>
                        <p><strong>Mensaje:</strong> ${mensaje}</p>
                        <p style="color: #00ffff; font-weight: bold;">✔ Formulario enviado con éxito.</p>
                    </div>
                `;
            }

            alert(`¡Gracias por tu mensaje, ${nombre}! El formulario fue procesado.`);
            formulario.reset();
        });
    }

});
