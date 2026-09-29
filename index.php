<?php
$titulo_pagina = 'Inicio';
$meta_description = 'Revive la nostalgia en Nebula Games. Descubre la historia de las consolas clásicas como la Super Nintendo, Sega Genesis y Atari, y juega a los mejores videojuegos retro gratis de los 80 y 90.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <main>
        <div class="hero">
            <img src="imagenes/retro.jpg" alt="Fondo de pantalla estilo arcade retro con luces de neón">
            <div class="hero-text">
                <h2>INSERTA MONEDA PARA COMENZAR</h2>
                <p>El mejor arcade retro de la web. Consolas clásicas, guías, blog y cursos.</p>
                <a href="la_seccion_para_poder_jugar.php" class="btn">▶ JUGAR AHORA</a>
            </div>
        </div>

        <div class="container">
            <section class="seo-text-block">
                <h2>▌ HISTORIA Y PASIÓN POR LOS VIDEOJUEGOS RETRO</h2>
                <p>Bienvenido a Nebula Games, la plataforma definitiva diseñada para los amantes del retrogaming y los sistemas arcade de salón. Nuestro objetivo principal es rescatar y preservar la historia dorada del entretenimiento digital, ofreciendo un catálogo interactivo con información técnica, curiosidades y guías detalladas sobre las <strong>consolas clásicas</strong> que marcaron un antes y un después en las infancias de millones de jugadores durante las décadas de los 80 y 90.</p>
                <p>Si alguna vez te has preguntado <strong>cómo jugar juegos de sega genesis en pc</strong> o cuáles son los <strong>mejores juegos de super nintendo de la historia</strong>, has llegado al rincón web indicado. Aquí exploramos desde el impacto cultural de los procesadores de 8 bits hasta la evolución gráfica tridimensional. Creemos firmemente que comprender el pasado de los videojuegos es fundamental para apreciar las obras maestras contemporáneas de la industria actual.</p>
                <p>En este espacio no solo recordamos la nostalgia técnica de los cartuchos y los microchips de sonido icónicos, sino que también te damos acceso a herramientas de aprendizaje dedicadas. A través de nuestra sección especializada, vas a poder interactuar de forma directa, leer análisis en nuestro blog de noticias retro y sumarte a nuestra comunidad mediante el formulario de contacto para debatir sobre trucos de software o mecánicas de emulación. ¡Prepara tus reflejos, selecciona tu sistema favorito aquí abajo y vuelve a disfrutar de la verdadera jugabilidad arcade sin salir de tu navegador!</p>
            </section>

            <div class="accordion-wrapper">
                <button id="accordionToggle" type="button" class="accordion-toggle" aria-expanded="false">📜 Ver reglas de la comunidad</button>
                <div id="panelAcordeon" class="accordion-panel">
                    <p>1. Respetar a los demás jugadores.<br>2. Prohibido el uso de cheats no autorizados.<br>3. ¡Disfrutá del contenido retro!</p>
                </div>
            </div>

            <section class="gallery-section" aria-label="Galería de imágenes">
                <h2 class="catalog-title">▌ GALERÍA RETRO</h2>
                <div class="gallery-main">
                    <button id="btnAnterior" type="button" class="gallery-btn" aria-label="Imagen anterior">◀</button>
                    <img id="fotoPrincipal" src="imagenes/nes.jfif" alt="Imagen principal de la galería retro" class="gallery-image">
                    <button id="btnSiguiente" type="button" class="gallery-btn" aria-label="Siguiente imagen">▶</button>
                </div>
                <div class="gallery-thumbs">
                    <img class="gallery-thumb active" src="imagenes/nes.jfif" alt="Miniatura de NES" data-image="imagenes/nes.jfif">
                    <img class="gallery-thumb" src="imagenes/snes.jpg" alt="Miniatura de SNES" data-image="imagenes/snes.jpg">
                    <img class="gallery-thumb" src="imagenes/genesis.jpg" alt="Miniatura de Genesis" data-image="imagenes/genesis.jpg">
                    <img class="gallery-thumb" src="imagenes/atari.jfif" alt="Miniatura de Atari" data-image="imagenes/atari.jfif">
                </div>
            </section>

            <h2 class="catalog-title">▌ EXPLORA POR CONSOLA</h2>
            <div class="grid">
                <a href="seccion_de_NES.php" class="card">
                    <img src="imagenes/nes.jfif" alt="Consola de mesa Nintendo Entertainment System original de ocho bits">
                    <h3>NINTENDO NES</h3>
                </a>
                <a href="seccion_de_SNES.php" class="card">
                    <img src="imagenes/snes.jpg" alt="Consola Super Nintendo de 16 bits en su caja original">
                    <h3>SUPER NINTENDO</h3>
                </a>
                <a href="seccion_de_Sega_genesis.php" class="card">
                    <img src="imagenes/genesis.jpg" alt="Consola Sega Genesis con su característico control de tres botones">
                    <h3>SEGA GENESIS</h3>
                </a>
                <a href="seccion_de_Sega_Master_System.php" class="card">
                    <img src="imagenes/Sega-Master-System-Set.jpg" alt="Consola Sega Master System con su joystick de palanca">
                    <h3>SEGA MASTER SYSTEM</h3>
                </a>
                <a href="seccion_de_Game_Boy.php" class="card">
                    <img src="imagenes/Game-Boy-FL.jpg" alt="Consola portátil Game Boy clásica de pantalla verde">
                    <h3>GAME BOY</h3>
                </a>
                <a href="sccion_de_Game_Boy_Color.php" class="card">
                    <img src="imagenes/game boy color.jpg" alt="Consola portátil Game Boy Color de color violeta transparente">
                    <h3>GAME BOY COLOR</h3>
                </a>
                <a href="seccion_de_Game_Boy_advance.php" class="card">
                    <img src="imagenes/advance.jfif" alt="Consola portátil Game Boy Advance en posición horizontal">
                    <h3>GAME BOY ADVANCE</h3>
                </a>
                <a href="seccion_de_atari_2600.php" class="card">
                    <img src="imagenes/atari.jfif" alt="Consola clásica Atari 2600 con acabado de madera y palanca de mando">
                    <h3>ATARI 2600</h3>
                </a>
            </div>
        </div>
    </main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
