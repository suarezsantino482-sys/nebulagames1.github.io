document.addEventListener('DOMContentLoaded', () => {
    console.log('JavaScript de Nebula Games cargado correctamente.');

    const header = document.querySelector('header');
    if (header && !document.getElementById('relojArcade')) {
        const relojNuevo = document.createElement('div');
        relojNuevo.id = 'relojArcade';
        relojNuevo.className = 'reloj-arcade';
        relojNuevo.setAttribute('aria-live', 'polite');
        header.appendChild(relojNuevo);
    }

    if (header && !document.getElementById('btnTema')) {
        const btnTemaNuevo = document.createElement('button');
        btnTemaNuevo.id = 'btnTema';
        btnTemaNuevo.type = 'button';
        btnTemaNuevo.className = 'btn-tema';
        btnTemaNuevo.setAttribute('aria-label', 'Cambiar tema');
        btnTemaNuevo.textContent = '🌙 Modo oscuro';
        header.appendChild(btnTemaNuevo);
    }

    const reloj = document.getElementById('relojArcade');
    if (reloj) {
        const actualizarReloj = () => {
            const ahora = new Date();
            reloj.textContent = `📅 ${ahora.toLocaleDateString('es-AR')} | ⏰ ${ahora.toLocaleTimeString('es-AR')}`;
        };
        actualizarReloj();
        setInterval(actualizarReloj, 1000);
    }

    const btnTema = document.getElementById('btnTema');
    if (btnTema) {
        if (localStorage.getItem('nebula-tema') === 'claro') {
            document.body.classList.add('dark-mode');
            btnTema.textContent = '☀️ Modo claro';
        }

        btnTema.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const modoOscuro = document.body.classList.contains('dark-mode');
            btnTema.textContent = modoOscuro ? '☀️ Modo claro' : '🌙 Modo oscuro';
            localStorage.setItem('nebula-tema', modoOscuro ? 'claro' : 'oscuro');
        });
    }

    const toggle = document.getElementById('accordionToggle');
    const panel = document.getElementById('panelAcordeon');
    if (toggle && panel) {
        toggle.addEventListener('click', () => {
            const estaAbierto = panel.classList.toggle('open');
            toggle.setAttribute('aria-expanded', String(estaAbierto));
        });
    }

    const fotoPrincipal = document.getElementById('fotoPrincipal');
    const thumbs = Array.from(document.querySelectorAll('.gallery-thumb'));
    const btnAnterior = document.getElementById('btnAnterior');
    const btnSiguiente = document.getElementById('btnSiguiente');

    if (fotoPrincipal && thumbs.length) {
        let indexActual = 0;

        const actualizarImagen = (nuevaPosicion) => {
            indexActual = (nuevaPosicion + thumbs.length) % thumbs.length;
            const src = thumbs[indexActual].dataset.image;
            fotoPrincipal.src = src;
            fotoPrincipal.alt = thumbs[indexActual].alt;
            thumbs.forEach((thumb, index) => thumb.classList.toggle('active', index === indexActual));
        };

        thumbs.forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const posicion = thumbs.indexOf(thumb);
                actualizarImagen(posicion);
            });
        });

        btnAnterior?.addEventListener('click', () => actualizarImagen(indexActual - 1));
        btnSiguiente?.addEventListener('click', () => actualizarImagen(indexActual + 1));

        fotoPrincipal.addEventListener('click', () => {
            const modal = document.createElement('div');
            modal.className = 'img-modal';
            const img = document.createElement('img');
            img.src = fotoPrincipal.src;
            img.alt = fotoPrincipal.alt;
            modal.appendChild(img);
            modal.addEventListener('click', () => modal.remove());
            document.body.appendChild(modal);
        });
    }

    const formularios = document.querySelectorAll('form[data-validate]');

    formularios.forEach((formulario) => {
        const inputs = Array.from(formulario.querySelectorAll('input, textarea'));
        const resumen = formulario.parentElement.querySelector('.resumen-formulario') || document.getElementById('resumenFormulario');

        const mostrarError = (input, mensaje) => {
            const errorElemento = formulario.querySelector(`small[data-error-for="${input.id}"]`);
            if (errorElemento) {
                errorElemento.textContent = mensaje;
                errorElemento.style.display = mensaje ? 'block' : 'none';
            }
        };

        const limpiarError = (input) => mostrarError(input, '');

        inputs.forEach((input) => {
            input.addEventListener('input', () => limpiarError(input));
            input.addEventListener('blur', () => limpiarError(input));
        });

        formulario.addEventListener('submit', (event) => {
            event.preventDefault();
            let formularioValido = true;
            const datos = {};

            inputs.forEach((input) => {
                const nombreCampo = input.name || input.id;
                const valor = input.value.trim();
                let error = '';

                if (input.required && valor === '') {
                    error = 'Este campo es obligatorio.';
                } else if (input.type === 'email' && valor && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)) {
                    error = 'Ingresá un correo electrónico válido.';
                } else if (input.type === 'checkbox' && input.required && !input.checked) {
                    error = 'Debes aceptar este campo para continuar.';
                } else if (input.name === 'mensaje' && valor.length < 10) {
                    error = 'El mensaje debe tener al menos 10 caracteres.';
                } else if (input.name === 'nombre' && valor.length < 3) {
                    error = 'El nombre debe tener al menos 3 caracteres.';
                }

                if (error) {
                    formularioValido = false;
                    mostrarError(input, error);
                } else {
                    mostrarError(input, '');
                    datos[nombreCampo] = valor;
                }
            });

            if (!formularioValido) {
                return;
            }

            if (resumen) {
                resumen.hidden = false;
                resumen.textContent = '';
                const titulo = document.createElement('h3');
                titulo.textContent = '📋 Resumen del formulario';
                resumen.appendChild(titulo);
                [['Nombre', datos.nombre], ['Correo', datos.correo], ['Mensaje', datos.mensaje]].forEach(([etiqueta, valor]) => {
                    const parrafo = document.createElement('p');
                    parrafo.textContent = `${etiqueta}: ${valor}`;
                    resumen.appendChild(parrafo);
                });
                const exito = document.createElement('p');
                exito.className = 'resumen-exito';
                exito.textContent = '✔ Datos validados correctamente.';
                resumen.appendChild(exito);
            }

            alert(`¡Formulario enviado correctamente, ${datos.nombre}!`);
            formulario.reset();
        });
    });
});
