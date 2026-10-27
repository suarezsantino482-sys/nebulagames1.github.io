<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/conexion.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Método no permitido.');
}

if (!valid_csrf_token()) {
    set_flash('error', 'La solicitud venció o no es válida. Recargá el catálogo e intentá nuevamente.');
    redirect_to('index.php');
}

$id = valid_game_id($_POST['id'] ?? null);
if ($id === null) {
    set_flash('error', 'El identificador del juego no es válido.');
    redirect_to('index.php');
}

try {
    $statement = $pdo->prepare('DELETE FROM juegos WHERE id_juego = :id_juego');
    $statement->execute([':id_juego' => $id]);
    set_flash(
        $statement->rowCount() === 1 ? 'success' : 'error',
        $statement->rowCount() === 1
            ? 'El juego se eliminó correctamente.'
            : 'No se encontró el juego para eliminar.'
    );
} catch (PDOException $exception) {
    log_database_error($exception);
    set_flash('error', 'No se pudo eliminar el juego. Revisá la conexión con MySQL e intentá otra vez.');
}

redirect_to('index.php');
