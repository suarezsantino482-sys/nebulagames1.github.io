<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/conexion.php';

$id = valid_game_id($_GET['id'] ?? null);
if ($id === null) {
    http_response_code(400);
    exit('El identificador del juego no es válido.');
}

$errors = [];
try {
    $statement = $pdo->prepare(
        'SELECT id_juego, id_genero, titulo, anio_lanzamiento, descripcion, imagen_url
         FROM juegos WHERE id_juego = :id'
    );
    $statement->execute([':id' => $id]);
    $game = $statement->fetch();
    $consoles = load_game_options($pdo, 'consolas', 'id_consola');
    $genres = load_game_options($pdo, 'generos', 'id_genero');
    $consoleStatement = $pdo->prepare(
        'SELECT id_consola FROM juego_consola WHERE id_juego = :id_juego'
    );
    $consoleStatement->execute([':id_juego' => $id]);
    $selectedConsoles = array_map('strval', $consoleStatement->fetchAll(PDO::FETCH_COLUMN));
} catch (PDOException $exception) {
    log_database_error($exception);
    http_response_code(500);
    exit('No se pudo cargar el juego para editar.');
}
if ($game === false) {
    http_response_code(404);
    exit('No se encontró el juego solicitado.');
}

$values = [
    'titulo' => (string) $game['titulo'],
    'id_genero' => (string) $game['id_genero'],
    'id_consolas' => $selectedConsoles,
    'anio_lanzamiento' => $game['anio_lanzamiento'] === null ? '' : (string) $game['anio_lanzamiento'],
    'descripcion' => (string) $game['descripcion'],
    'imagen_url' => (string) ($game['imagen_url'] ?? ''),
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $values = game_values_from_post();
    if (!valid_csrf_token()) {
        $errors[] = 'El formulario venció o no es válido. Recargá la página e intentá nuevamente.';
    } else {
        $errors = validate_game($values, $consoles, $genres);
    }

    if ($errors === []) {
        try {
            $pdo->beginTransaction();
            $statement = $pdo->prepare(
                'UPDATE juegos
                 SET id_genero = :id_genero, titulo = :titulo,
                     anio_lanzamiento = :anio_lanzamiento, descripcion = :descripcion,
                     imagen_url = :imagen_url
                 WHERE id_juego = :id_juego'
            );
            $statement->execute([
                ':id_genero' => (int) $values['id_genero'],
                ':titulo' => $values['titulo'],
                ':anio_lanzamiento' => $values['anio_lanzamiento'] === '' ? null : (int) $values['anio_lanzamiento'],
                ':descripcion' => $values['descripcion'],
                ':imagen_url' => $values['imagen_url'] === '' ? null : $values['imagen_url'],
                ':id_juego' => $id,
            ]);
            $deleteStatement = $pdo->prepare('DELETE FROM juego_consola WHERE id_juego = :id_juego');
            $deleteStatement->execute([':id_juego' => $id]);
            $consoleStatement = $pdo->prepare(
                'INSERT INTO juego_consola (id_juego, id_consola) VALUES (:id_juego, :id_consola)'
            );
            foreach ($values['id_consolas'] as $consoleId) {
                $consoleStatement->execute([
                    ':id_juego' => $id,
                    ':id_consola' => (int) $consoleId,
                ]);
            }
            $pdo->commit();
            set_flash('success', 'Los cambios del juego se guardaron correctamente.');
            redirect_to('index.php');
        } catch (PDOException $exception) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            log_database_error($exception);
            $errors[] = 'No se pudieron guardar los cambios. Revisá la conexión con MySQL e intentá otra vez.';
        }
    }
}

$pageTitle = 'Editar juego';
require __DIR__ . '/../includes/header.php';
?>
<main class="crud-main">
    <h2>EDITAR JUEGO #<?= h($id) ?></h2>
    <p>Modificá los datos del juego y guardá los cambios.</p>
    <?php require __DIR__ . '/../includes/form-juego.php'; ?>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
