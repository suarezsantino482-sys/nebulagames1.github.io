<?php
$titulo_pagina = 'Game Boy Advance';
$meta_description = 'Explora la Game Boy Advance, la portátil de 32 bits que llevó a la SNES a tu bolsillo y redefinió la era portátil.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <div class="page-hero">
        <img src="imagenes/advance.jfif" alt="Game Boy Advance">
        <h2>GAME BOY ADVANCE</h2>
    </div>

    <div class="container">
        <h3 class="section-title">SOBRE LA CONSOLA</h3>
        <p>La Game Boy Advance llegó en 2001 con 32 bits de potencia, pantalla horizontal y una biblioteca de juegos increíble. Era como tener una Super Nintendo en el bolsillo, literalmente, ya que muchos ports de SNES fueron portados a la GBA.</p>
        <p>Con más de 81 millones de unidades vendidas, la GBA es considerada la cima de las portátiles retro de Nintendo antes de la era DS.</p>

        <h3 class="section-title">JUEGOS ICÓNICOS</h3>

        <div class="game-card">
            <img src="imagenes/pokemon esmeralda.jpg" alt="Pokemon Esmeralda">
            <div>
                <h3>POKÉMON ESMERALDA</h3>
                <p>La versión definitiva de la tercera generación. La Batalla Frontera, el mejor post-game de Pokémon de todos los tiempos y gráficos que sacaron el máximo de la GBA.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/mettroi 2.jpg" alt="Metroid Fusion">
            <div>
                <h3>METROID FUSION</h3>
                <p>Samus atrapada en una estación espacial infestada de parásitos. Atmósfera de terror, narración magistral y acción Metroidvania en estado puro.</p>
            </div>
        </div>

        <div class="game-card">
            <img src="imagenes/GBA_Fire_Emblem_Box.jpg" alt="Fire Emblem">
            <div>
                <h3>FIRE EMBLEM</h3>
                <p>El debut occidental de la saga de estrategia táctica. Personajes que mueren de verdad y no regresan. Difícil, adictivo y emotivo.</p>
            </div>
        </div>

        <div class="nav-btns">
            <a href="sccion_de_Game_Boy_Color.php" class="btn">← GAME BOY COLOR</a>
            <a href="seccion_de_atari_2600.php" class="btn">ATARI 2600 →</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
