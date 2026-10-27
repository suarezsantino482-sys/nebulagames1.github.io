<?php
$pageTitle = isset($pageTitle) && is_string($pageTitle) ? $pageTitle : 'Catálogo CRUD';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($pageTitle) ?> | Nebula Games</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <header>
        <h1>★ NEBULA GAMES ★</h1>
    </header>
    <nav aria-label="Navegación principal">
        <a href="../index.html">Inicio</a>
        <a href="../clase5/index.php">Clase 5</a>
        <a href="index.php">Catálogo CRUD</a>
    </nav>
