<?php
require_once __DIR__ . '/../config/env.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($meta_description)): ?>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    <title><?= htmlspecialchars($titulo_pagina, ENT_QUOTES, 'UTF-8'); ?> | <?= htmlspecialchars(APP_NAME, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>★ <?= htmlspecialchars(APP_NAME, ENT_QUOTES, 'UTF-8'); ?> ★</h1>
        <?php if ($titulo_pagina === 'Inicio'): ?>
        <button id="btnTema" type="button" class="btn-tema" aria-label="Cambiar tema">🌙 Modo oscuro</button>
        <div id="relojArcade" class="reloj-arcade" aria-live="polite"></div>
        <?php endif; ?>
    </header>