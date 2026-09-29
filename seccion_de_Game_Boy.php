<?php
$titulo_pagina = 'Game Boy';
$meta_description = 'Historia, juegos icónicos y curiosidades de la Game Boy, la portátil que definió una generación.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <div class="page-hero">
        <img src="imagenes/Game-Boy-FL.jpg" alt="Game Boy">
        <h2>GAME BOY</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>La Game Boy fue lanzada por Nintendo en 1989 y se convirtió en la portátil más vendida de su era. Con su pantalla monocromática de 4 tonos de verde y su batería de 4 pilas AA, revolucionó los videojuegos portátiles.</p>
        <p>Vendió más de 118 millones de unidades (contando la Game Boy Color). Tetris, incluido en la caja, fue el gancho perfecto para atrapar a millones de jugadores.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/tetris.jpg" alt="Tetris">
            <div>
                <h3>TETRIS</h3>
                <p>El juego que viene con la consola. Simple, adictivo y eterno. Millones de personas aprendieron a jugar videojuegos gracias a este clásico.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/pokemon rojo.jfif" alt="Pokemon">
            <div>
                <h3>POKÉMON ROJO / AZUL</h3>
                <p>Atrapa, entrena y combate con 151 Pokémon. El fenómeno que creó una franquicia de miles de millones de dólares y una generación de entrenadores.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/metroid.jpg" alt="Metroid II">
            <div>
                <h3>METROID II: RETURN OF SAMUS</h3>
                <p>Samus en una misión solitaria para eliminar a los Metroids. Atmósfera opresiva y exploración en 8 bits en la palma de tu mano.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="seccion_de_Sega_Master_System.php" class="btn">← MASTER SYSTEM</a>
            <a href="sccion_de_Game_Boy_Color.php" class="btn">GAME BOY COLOR →</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
