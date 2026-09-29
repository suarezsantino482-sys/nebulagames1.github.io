<?php
$titulo_pagina = 'Sega Genesis';
$meta_description = 'Descubre la Sega Genesis, la consola que desafió a Nintendo con velocidad, estilo y clásicos como Sonic.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <div class="page-hero">
        <img src="imagenes/genesis.jpg" alt="Sega Genesis">
        <h2>SEGA GENESIS</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>La Sega Genesis (o Mega Drive) fue lanzada entre 1988 y 1989. Con su procesador Motorola 68000 de alta velocidad y su distintivo sonido Yamaha, fue la gran rival de Nintendo durante la guerra de consolas de los 90.</p>
        <p>Su lema "Sega does what Nintendon't" resumía perfectamente su filosofía: más velocidad, más actitud y juegos más agresivos.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/sonic.jpg" alt="Sonic">
            <div>
                <h3>SONIC THE HEDGEHOG</h3>
                <p>El erizo azul más veloz del mundo. Velocidad, anillos y el malvado Dr. Eggman. La mascota que le plantó cara a Mario.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/rage.jfif" alt="Streets of Rage">
            <div>
                <h3>STREETS OF RAGE 2</h3>
                <p>El beat 'em up definitivo de Genesis. Música electrónica de Yuzo Koshiro y acción frenética en las calles.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/mortal kombat.jfif" alt="Mortal Kombat">
            <div>
                <h3>MORTAL KOMBAT</h3>
                <p>La versión Genesis tenía sangre real. Fatalities, luchadores icónicos y la polémica que cambió la industria para siempre.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="seccion_de_SNES.php" class="btn">← SUPER NINTENDO</a>
            <a href="seccion_de_Sega_Master_System.php" class="btn">MASTER SYSTEM →</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
