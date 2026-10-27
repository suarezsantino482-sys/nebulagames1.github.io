<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/conexion.php';

$consoles = [];
$genres = [];
$errors = [];
$values = [
    'titulo' => '',
    'id_genero' => '',
    'id_consolas' => [],
    'anio_lanzamiento' => '',
    'descripcion' => '',
    'imagen_url' => '',
];

try {
    $consoles = load_game_options($pdo, 'consolas', 'id_consola');
    $genres = load_game_options($pdo, 'generos', 'id_genero');
} catch (PDOException $exception) {
    log_database_error($exception);
    $errors[] = 'No se pudieron cargar las consolas y géneros. Revisá la configuración de la base.';
}

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
                'INSERT INTO juegos (id_genero, titulo, anio_lanzamiento, descripcion, imagen_url)
                 VALUES (:id_genero, :titulo, :anio_lanzamiento, :descripcion, :imagen_url)'
            );
            $statement->execute([
                ':id_genero' => (int) $values['id_genero'],
                ':titulo' => $values['titulo'],
                ':anio_lanzamiento' => $values['anio_lanzamiento'] === '' ? null : (int) $values['anio_lanzamiento'],
                ':descripcion' => $values['descripcion'],
                ':imagen_url' => $values['imagen_url'] === '' ? null : $values['imagen_url'],
            ]);
            $gameId = (int) $pdo->lastInsertId();
            $consoleStatement = $pdo->prepare(
                'INSERT INTO juego_consola (id_juego, id_consola) VALUES (:id_juego, :id_consola)'
            );
            foreach ($values['id_consolas'] as $consoleId) {
                $consoleStatement->execute([
                    ':id_juego' => $gameId,
                    ':id_consola' => (int) $consoleId,
                ]);
            }
            $pdo->commit();
            set_flash('success', 'El juego se agregó correctamente al catálogo.');
            redirect_to('index.php');
        } catch (PDOException $exception) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            log_database_error($exception);
            $errors[] = 'No se pudo guardar el juego. Revisá la conexión con MySQL e intentá otra vez.';
        }
    }
}

$pageTitle = 'Agregar juego';
require __DIR__ . '/../includes/header.php';
?>
<main class="crud-main">
    <h2>AGREGAR UN JUEGO</h2>
    <p>Completá los datos del juego retro para guardarlo en el catálogo.</p>
    <?php require __DIR__ . '/../includes/form-juego.php'; ?>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
