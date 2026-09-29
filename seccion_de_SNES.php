<?php
$titulo_pagina = 'Super Nintendo';
$meta_description = 'Explora la Super Nintendo, una de las consolas más queridas de la historia con clásicos del 16 bits.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <div class="page-hero">
        <img src="imagenes/snes.jpg" alt="SNES">
        <h2>SUPER NINTENDO</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>La Super Nintendo Entertainment System (SNES) fue lanzada en 1990 en Japón y 1991 en América. Con sus 16 bits y su avanzado chip gráfico, llevó los videojuegos a otro nivel. Vendió más de 49 millones de unidades.</p>
        <p>Hogar de algunos de los mejores juegos de todos los tiempos: Zelda, Mario World, Donkey Kong Country y Street Fighter II.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/zelda past.jpg" alt="Zelda SNES">
            <div>
                <h3>THE LEGEND OF ZELDA: A LINK TO THE PAST</h3>
                <p>Considerado uno de los mejores juegos de la historia. Dos mundos, mazmorras épicas y una historia inolvidable.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/Super-Mario-World-SNES-EU.jpg" alt="Super Mario World">
            <div>
                <h3>SUPER MARIO WORLD</h3>
                <p>Mario en 16 bits con su dinosaurio Yoshi. Más de 70 niveles de pura diversión. El juego de lanzamiento perfecto.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/donkey.jpg" alt="Donkey Kong Country">
            <div>
                <h3>DONKEY KONG COUNTRY</h3>
                <p>Gráficos pre-renderizados que asombraron al mundo. DK y Diddy Kong en una aventura llena de barriles y junglas.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="seccion_de_NES.php" class="btn">← NINTENDO NES</a>
            <a href="seccion_de_Sega_genesis.php" class="btn">SEGA GENESIS →</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
