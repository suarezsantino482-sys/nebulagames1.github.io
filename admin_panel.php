<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/funciones.php';
require_once __DIR__ . '/includes/auth_guard.php';
require_login('admin');

$titulo_pagina = 'Panel de administración';
require __DIR__ . '/includes/header.php';
?>
<main class="crud-main">
    <h2>PANEL ADMINISTRADOR</h2>
    <p>Acceso autorizado para <?= h($_SESSION['usuario_nombre']) ?>.</p>

    <div class="crud-actions">
        <a class="crud-link-button" href="admin/index.php">ADMINISTRAR CATÁLOGO</a>
        <a class="crud-link-button" href="panel.php">PANEL USUARIO</a>
        <a class="crud-link-button" href="auth/logout.php">CERRAR SESIÓN</a>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
