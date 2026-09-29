<?php
$titulo_pagina = 'Formulario de Contacto';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <div class="container">
        <h2>▌ FORMULARIO DE CONTACTO</h2>
        
        <!-- Contenedor donde JS mostrará el mensaje de éxito -->
        <div id="mensajeExito" style="display: none; padding: 15px; margin-bottom: 15px; background: #111133; border: 2px solid #00ffff; color: #00ffff; text-align: center;"></div>

        <form action="https://httpbin.org/post" method="POST" class="form-arcade" id="formulario-contacto" data-validate novalidate>
            
            <div class="form-group">
                <label for="nombre">🎮 TU NOMBRE / GAMERTAG:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej: NeoPixel" required minlength="3">
                <small class="error-message" data-error-for="nombre"></small>
            </div>

            <div class="form-group">
                <label for="correo">📧 CORREO ELECTRÓNICO:</label>
                <input type="email" id="correo" name="correo" placeholder="correo@dominio.com" required>
                <small class="error-message" data-error-for="correo"></small>
            </div>

            <div class="form-group">
                <label for="motivo">❓ MOTIVO DE CONTACTO:</label>
                <select id="motivo" name="motivo">
                    <option value="soporte">Reportar un error / Bug</option>
                    <option value="sugerencia">Sugerir un juego retro</option>
                    <option value="curso">Consulta sobre los Cursos</option>
                    <option value="otro">Otro motivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mensaje">✍️ MENSAJE / COMENTARIOS:</label>
                <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe aquí tu mensaje..." required minlength="10"></textarea>
                <small class="error-message" data-error-for="mensaje"></small>
            </div>

            <div class="form-group">
                <div class="row-group">
                    <input type="checkbox" id="terminos" name="terminos" required>
                    <label for="terminos">Acepto los términos de la comunidad Nebula.</label>
                </div>
            </div>

            <button type="submit" class="btn-submit">ENVIAR FORMULARIO</button>
            <button type="reset" class="btn-reset">BORRAR TODO</button>

        </form>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
