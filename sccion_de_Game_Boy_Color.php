<?php
$titulo_pagina = 'Game Boy Color';
$meta_description = 'Descubre la Game Boy Color, la portátil a color que dio nueva vida a los clásicos de Nintendo y a la era Pokémon.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <div class="page-hero">
        <img src="imagenes/game boy color.jpg" alt="Game Boy Color">
        <h2>GAME BOY COLOR</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>La Game Boy Color fue lanzada en 1998 como la evolución directa de la Game Boy original. Con una pantalla a color de 32,768 colores posibles, dio nueva vida a los juegos de Game Boy y trajo títulos exclusivos increíbles.</p>
        <p>Compatible con todos los juegos originales de Game Boy, la GBC fue el puente perfecto entre la era monocromática y el futuro a color de las portátiles de Nintendo.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/pokemon oro.jfif" alt="Pokemon Gold Silver">
            <div>
                <h3>POKÉMON ORO / PLATA</h3>
                <p>Dos regiones, 251 Pokémon y un reloj interno real. Considerados los mejores juegos de Pokémon de todos los tiempos por muchos fans.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/zelda ages.jfif" alt="Zelda Oracle">
            <div>
                <h3>THE LEGEND OF ZELDA: ORACLE OF AGES</h3>
                <p>Link viaja en el tiempo para salvar el mundo. Puzzles ingeniosos y un mundo rico en colores que lucía espectacular en la GBC.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/Dragonwarrior1.jpg" alt="Dragon Warrior Monsters">
            <div>
                <h3>DRAGON WARRIOR MONSTERS</h3>
                <p>Captura y cría monstruos en este RPG que compitió directamente con Pokémon. Una joya escondida de la Game Boy Color.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="seccion_de_Game_Boy.php" class="btn">← GAME BOY</a>
            <a href="seccion_de_Game_Boy_advance.php" class="btn">GAME BOY ADVANCE →</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
