/* =========================================================
   NEBULA GAMES - SCRIPT INTEGRAL CON AUTOCREACIÓN DE ELEMENTOS
   ========================================================= */

document.addEventListener('DOMContentLoaded', () => {
    
    // -----------------------------------------------------
    // PUNTO 1: MENSAJE O ALERTA AL CARGAR
    // -----------------------------------------------------
    console.log("¡JavaScript de Nebula Games iniciado correctamente!");
    alert("¡Bienvenido a Nebula Games! El sistema JS se ha cargado con éxito.");

    // -----------------------------------------------------
    // PUNTO 3: FECHA Y HORA EN TIEMPO REAL
    // -----------------------------------------------------
    let reloj = document.getElementById('relojArcade');
    if (!reloj) {
        reloj = document.createElement('div');
        reloj.id = 'relojArcade';
        reloj.style.cssText = "text-align: center; color: #00ffff; font-family: monospace; font-size: 1.2rem; padding: 10px; background: #050510; border-bottom: 2px solid #00ffff;";
        document.body.insertBefore(reloj, document.body.firstChild);
    }

    function actualizarReloj() {
        const ahora = new Date();
        reloj.textContent = `📅 ${ahora.toLocaleDateString('es-AR')} | ⏰ ${ahora.toLocaleTimeString('es-AR')}`;
    }
    setInterval(actualizarReloj, 1000);
    actualizarReloj();

    // -----------------------------------------------------
    // PUNTO 6: CAMBIAR EL TEMA DE LA PÁGINA (MODO CLARO / OSCURO)
    // -----------------------------------------------------
    let btnTema = document.getElementById('btnTema');
    if (!btnTema) {
        btnTema = document.createElement('button');
        btnTema.id = 'btnTema';
        btnTema.textContent = '🌓 Cambiar Tema (Claro/Oscuro)';
        btnTema.style.cssText = "position: fixed; top: 10px; right: 10px; z-index: 9999; background: #ff00ff; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 5px; font-weight: bold;";
        document.body.appendChild(btnTema);
    }

    btnTema.addEventListener('click', () => {
        document.body.classList.toggle('modo-claro');
        if (document.body.classList.contains('modo-claro')) {
            document.body.style.backgroundColor = '#e0e0e0';
            document.body.style.color = '#111111';
        } else {
            document.body.style.backgroundColor = '';
            document.body.style.color = '';
        }
    });

    // -----------------------------------------------------
    // PUNTO 4: MENÚ INTERACTIVO (ACORDEÓN DESPLEGABLE)
    // -----------------------------------------------------
    let panelAcordeon = document.getElementById('panelAcordeon');
    if (!panelAcordeon) {
        const contenedorAcordeon = document.createElement('div');
        contenedorAcordeon.style.cssText = "text-align: center; margin: 20px auto; max-width: 600px;";
        
        const btnAcordeon = document.createElement('button');
        btnAcordeon.textContent = "📜 Ver Reglas de la Comunidad (Acordeón)";
        btnAcordeon.style.cssText = "background: #111133; color: #00ffff; border: 2px solid #00ffff; padding: 10px 15px; cursor: pointer; width: 100%; font-weight: bold;";
        
        panelAcordeon = document.createElement('div');
        panelAcordeon.id = 'panelAcordeon';
        panelAcordeon.style.cssText = "display: none; background: #050510; border: 1px solid #ff00ff; padding: 15px; color: white; text-align: left;";
        panelAcordeon.innerHTML = "<p>1. Respetar a los demás jugadores.<br>2. Prohibido el uso de cheats no autorizados.<br>3. ¡Disfrutá del contenido retro!</p>";
        
        btnAcordeon.addEventListener('click', () => {
            panelAcordeon.style.display = (panelAcordeon.style.display === 'none') ? 'block' : 'none';
        });

        contenedorAcordeon.appendChild(btnAcordeon);
        contenedorAcordeon.appendChild(panelAcordeon);
        
        const main = document.querySelector('main') || document.body;
        main.appendChild(contenedorAcordeon);
    }

    // -----------------------------------------------------
    // PUNTO 5: GALERÍA DE IMÁGENES INTERACTIVA CON MODAL
    // -----------------------------------------------------
    let visor = document.getElementById('visorGaleria');
    if (!visor) {
        const galeriaSec = document.createElement('section');
        galeriaSec.style.cssText = "text-align: center; margin: 30px auto; max-width: 400px; background: #111133; padding: 15px; border: 2px solid #ff00ff;";
        galeriaSec.innerHTML = `<h3 style="color:#00ffff; margin-top:0;">🖼️ GALERÍA INTERACTIVA</h3>`;

        visor = document.createElement('img');
        visor.id = 'visorGaleria';
        visor.src = 'imagenes/nes.jfif';
        visor.style.cssText = "width: 100%; height: 200px; object-fit: cover; cursor: pointer; border: 1px solid #00ffff;";

        const controles = document.createElement('div');
        controles.style.marginTop = "10px";

        const btnPrev = document.createElement('button');
        btnPrev.textContent = "◀ Anterior";
        btnPrev.style.cssText = "background: #ff00ff; color: white; border: none; padding: 5px 15px; margin-right: 10px; cursor: pointer;";

        const btnNext = document.createElement('button');
        btnNext.textContent = "Siguiente ▶";
        btnNext.style.cssText = "background: #ff00ff; color: white; border: none; padding: 5px 15px; cursor: pointer;";

        controles.appendChild(btnPrev);
        controles.appendChild(btnNext);
        galeriaSec.appendChild(visor);
        galeriaSec.appendChild(controles);

        const main = document.querySelector('main') || document.body;
        main.appendChild(galeriaSec);

        // Lógica de imágenes
        const imagenes = ['imagenes/nes.jfif', 'imagenes/snes.jpg', 'imagenes/genesis.jpg'];
        let idx = 0;

        btnNext.addEventListener('click', () => {
            idx = (idx + 1) % imagenes.length;
            visor.src = imagenes[idx];
        });

        btnPrev.addEventListener('click', () => {
            idx = (idx - 1 + imagenes.length) % imagenes.length;
            visor.src = imagenes[idx];
        });

        // Modal para ampliar
        const modal = document.createElement('div');
        modal.style.cssText = "display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.9); justify-content: center; align-items: center; z-index: 10000;";
        const imgModal = document.createElement('img');
        imgModal.style.cssText = "max-width: 80%; max-height: 80%; border: 3px solid #00ffff;";
        modal.appendChild(imgModal);
        document.body.appendChild(modal);

        visor.addEventListener('click', () => {
            modal.style.display = 'flex';
            imgModal.src = visor.src;
        });

        modal.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    // -----------------------------------------------------
    // PUNTOS 2 Y 7: VALIDACIÓN DE FORMULARIO Y RESUMEN DE DATOS
    // -----------------------------------------------------
    const formulario = document.getElementById('formulario-contacto') || document.querySelector('form');

    if (formulario) {
        // Crear contenedor para el resumen del punto 7
        let resumen = document.getElementById('resumenInscripcion');
        if (!resumen) {
            resumen = document.createElement('div');
            resumen.id = 'resumenInscripcion';
            resumen.style.cssText = "display: none; background: #050510; border: 2px solid #00ffff; padding: 15px; margin-bottom: 20px; color: white;";
            formulario.parentNode.insertBefore(resumen, formulario);
        }

        formulario.addEventListener('submit', (e) => {
            e.preventDefault(); // Detiene el envío predeterminado

            const nombreInput = document.getElementById('nombre') || formulario.querySelector('input[type="text"]');
            const correoInput = document.getElementById('correo') || formulario.querySelector('input[type="email"]');
            const mensajeInput = document.getElementById('mensaje') || formulario.querySelector('textarea');

            const nombre = nombreInput ? nombreInput.value.trim() : '';
            const correo = correoInput ? correoInput.value.trim() : '';
            const mensaje = mensajeInput ? mensajeInput.value.trim() : '';

            // Punto 2: Validación
            if (nombre.length < 3) {
                alert("❌ Error: El nombre debe tener al menos 3 caracteres.");
                return;
            }

            if (!correo.includes('@') || !correo.includes('.')) {
                alert("❌ Error: Ingresá un correo electrónico válido.");
                return;
            }

            // Punto 7: Mostrar resumen
            resumen.style.display = 'block';
            resumen.innerHTML = `
                <h3 style="color: #ff00ff; margin-top: 0;">📋 RESUMEN DE DATOS ENVIADOS</h3>
                <p><strong>Jugador:</strong> ${nombre}</p>
                <p><strong>Correo:</strong> ${correo}</p>
                <p><strong>Mensaje:</strong> ${mensaje}</p>
                <p style="color: #00ffff; font-weight: bold;">✔ Formulario validado correctamente.</p>
            `;

            alert(`¡Formulario procesado con éxito para ${nombre}!`);
            formulario.reset();
        });
    }
});
