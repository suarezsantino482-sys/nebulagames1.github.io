<?php
$titulo_pagina = 'Blog Gamer';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&q=80&w=1200" alt="Blog">
        <h2>📰 BLOG GAMER</h2>
    </div>

    <div class="container">
        <h3 class="section-title">ARTÍCULOS RECIENTES</h3>

        <div class="article">
            <img src="imagenes/Super-Mario-World-SNES-EU.jpg" alt="Mario">
            <div class="article-body">
                <span class="tag">NINTENDO</span>
                <h3>LOS MEJORES JUEGOS DE MARIO</h3>
                <p>Los mejores clásicos de Mario incluyen joyas inmortales como Super Mario Bros. 3 (NES), aclamado por sus innovaciones, Super Mario World (SNES) con su diseño de niveles perfecto y la introducción de Yoshi, y Super Mario 64 (N64), pionero en las plataformas 3D. Otros imprescindibles incluyen Super Mario Bros. original de 1985 y Super Mario Land 2 para Game Boy.</p>
                <div class="comment-box">
                    <p>💬 "Muy buen juego. Mario World es mi favorito de todos los tiempos." — Usuario</p>
                </div>
            </div>
        </div>

        <div class="article">
            <img src="imagenes/gerraa.jfif" alt="Sonic">
            <div class="article-body">
                <span class="tag">SEGA</span>
                <h3>LA GUERRA DE CONSOLAS DE LOS 90</h3>
                <p>Nintendo vs Sega fue la batalla más épica de la historia de los videojuegos. Mario contra Sonic, 16 bits de gloria, y campañas de marketing que cambiaron la industria para siempre. ¿Quién ganó? Depende a quién le preguntes.</p>
                <div class="comment-box">
                    <p>💬 "Siempre fui team Sega. ¡Sonic era el mejor!" — Usuario</p>
                </div>
            </div>
        </div>

        <div class="article">
            <img src="imagenes/Game-Boy-FL.jpg" alt="Game Boy">
            <div class="article-body">
                <span class="tag">PORTÁTILES</span>
                <h3>POR QUÉ LA GAME BOY FUE UN FENÓMENO MUNDIAL</h3>
                <p>La pantalla verde, las pilas AA y Tetris. Una combinación tan simple que conquistó el mundo. La Game Boy demostró que la potencia no lo es todo: la portabilidad y los buenos juegos son el verdadero rey.</p>
                <div class="comment-box">
                    <p>💬 "Jugué Pokémon Rojo en el colectivo durante meses. Recuerdos inolvidables." — Usuario</p>
                </div>
            </div>
        </div>

        <a href="index.php" class="btn">← VOLVER AL INICIO</a>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
