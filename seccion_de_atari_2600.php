<?php
$titulo_pagina = 'Atari 2600';
$meta_description = 'Revive la historia del Atari 2600, la consola que popularizó los cartuchos y lanzó la era moderna del videojuego.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <div class="page-hero">
        <img src="imagenes/atari.jfif" alt="Atari 2600">
        <h2>ATARI 2600</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>El Atari 2600 fue lanzado en 1977 y es considerado el padre de los videojuegos domésticos modernos. Fue la primera consola en popularizar los cartuchos intercambiables y llevó los juegos de arcade al hogar de millones de personas.</p>
        <p>Con su joystick icónico y su paleta de colores limitada, el Atari 2600 es el origen de todo lo que amamos en los videojuegos.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/space.jpg" alt="Space Invaders">
            <div>
                <h3>SPACE INVADERS</h3>
                <p>El juego que hizo famosa a la consola. Aliens en formación, un cañón en la base y el simple objetivo de sobrevivir. Eterno desde 1978.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/pit.jpg" alt="Pitfall">
            <div>
                <h3>PITFALL!</h3>
                <p>Harry saltando por la selva en una de las primeras aventuras de plataformas. Un juego que demostró de lo que el Atari 2600 era capaz.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/pacman.jfif" alt="Pac-Man Atari">
            <div>
                <h3>PAC-MAN</h3>
                <p>El famoso comecocos llega al Atari. Aunque la versión fue criticada por sus diferencias con el arcade, vendió millones y es parte de la historia.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="seccion_de_Game_Boy_advance.php" class="btn">← GAME BOY ADVANCE</a>
            <a href="index.php" class="btn">↑ VOLVER AL INICIO</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
