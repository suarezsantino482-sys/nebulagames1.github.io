<?php
$titulo_pagina = 'Sega Master System';
$meta_description = 'La Sega Master System, una consola de 8 bits que dejó una huella enorme en Europa, Brasil y la cultura retro.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

    <div class="page-hero">
        <img src="imagenes/Sega-Master-System-Set.jpg" alt="Sega Master System">
        <h2>SEGA MASTER SYSTEM</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>La Sega Master System fue lanzada en 1985 como el rival directo de la NES. Con 8 bits y gráficos superiores en muchos aspectos, tuvo un gran éxito en Europa y Brasil, donde sigue siendo popular hasta hoy.</p>
        <p>Aunque perdió la guerra de consolas contra Nintendo en América y Japón, la Master System dejó un legado enorme con juegos de gran calidad.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/kid.jpg" alt="Alex Kidd">
            <div>
                <h3>ALEX KIDD IN MIRACLE WORLD</h3>
                <p>La mascota original de Sega antes de Sonic. Un rey diminuto que destruye bloques con sus puños y juega al Piedra-Papel-Tijeras.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/star.jpg" alt="Phantasy Star">
            <div>
                <h3>PHANTASY STAR</h3>
                <p>Un RPG épico para 8 bits con batallas en primera persona y una protagonista femenina. Adelantado a su tiempo.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/wonder.jpg" alt="Wonder Boy">
            <div>
                <h3>WONDER BOY IN MONSTER LAND</h3>
                <p>Acción y RPG mezclados en una aventura mágica. Uno de los mejores juegos de la consola con mecánicas que siguen influyendo hoy.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="seccion_de_Sega_genesis.php" class="btn">← SEGA GENESIS</a>
            <a href="seccion_de_Game_Boy.php" class="btn">GAME BOY →</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
