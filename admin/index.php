<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../config/conexion.php';

$search = isset($_GET['buscar']) && is_string($_GET['buscar']) ? trim($_GET['buscar']) : '';
$console = isset($_GET['consola']) && is_string($_GET['consola']) ? trim($_GET['consola']) : '';
$genre = isset($_GET['genero']) && is_string($_GET['genero']) ? trim($_GET['genero']) : '';
$consoles = [];
$genres = [];
$errors = [];
$games = [];
$flash = take_flash();

if (mb_strlen($search) > 120) {
    $errors[] = 'La búsqueda no puede superar los 120 caracteres.';
    $search = mb_substr($search, 0, 120);
}
try {
    $consoles = load_game_options($pdo, 'consolas', 'id_consola');
    $genres = load_game_options($pdo, 'generos', 'id_genero');
    $consoleIds = array_map(static fn(array $option): string => (string) $option['id'], $consoles);
    $genreIds = array_map(static fn(array $option): string => (string) $option['id'], $genres);
    if ($console !== '' && !in_array($console, $consoleIds, true)) {
        $errors[] = 'El filtro de consola no es válido.';
        $console = '';
    }
    if ($genre !== '' && !in_array($genre, $genreIds, true)) {
        $errors[] = 'El filtro de género no es válido.';
        $genre = '';
    }

    $conditions = [];
    $parameters = [];
    if ($search !== '') {
        $conditions[] = '(j.titulo LIKE :titulo OR j.descripcion LIKE :descripcion OR g.nombre LIKE :genero)';
        $parameters[':titulo'] = '%' . $search . '%';
        $parameters[':descripcion'] = '%' . $search . '%';
        $parameters[':genero'] = '%' . $search . '%';
    }
    if ($console !== '') {
        $conditions[] = 'EXISTS (SELECT 1 FROM juego_consola filtro_jc WHERE filtro_jc.id_juego = j.id_juego AND filtro_jc.id_consola = :consola)';
        $parameters[':consola'] = $console;
    }
    if ($genre !== '') {
        $conditions[] = 'j.id_genero = :id_genero';
        $parameters[':id_genero'] = $genre;
    }
    $sql = 'SELECT j.id_juego, j.titulo, j.anio_lanzamiento, j.descripcion, j.imagen_url,
                   g.nombre AS genero,
                   GROUP_CONCAT(DISTINCT c.nombre ORDER BY c.nombre SEPARATOR ", ") AS consolas
            FROM juegos j
            INNER JOIN generos g ON g.id_genero = j.id_genero
            LEFT JOIN juego_consola jc ON jc.id_juego = j.id_juego
            LEFT JOIN consolas c ON c.id_consola = jc.id_consola';
    if ($conditions !== []) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }
    $sql .= ' GROUP BY j.id_juego ORDER BY j.id_juego DESC';
    $statement = $pdo->prepare($sql);
    $statement->execute($parameters);
    $games = $statement->fetchAll();
} catch (PDOException $exception) {
    log_database_error($exception);
    http_response_code(500);
    $errors[] = 'No se pudo cargar el catálogo. Revisá la conexión y el esquema schema.sql.';
}

$pageTitle = 'Catálogo de juegos';
require __DIR__ . '/../includes/header.php';
?>
<main class="crud-main">
    <h2>CATÁLOGO RETRO · CRUD</h2>
    <p>Administrá los juegos de Nebula Games. Los cambios se guardan en MySQL.</p>

    <?php if ($flash !== null): ?>
        <p class="crud-notice crud-notice-<?= h($flash['type']) ?>" role="status"><?= h($flash['message']) ?></p>
    <?php endif; ?>
    <?php foreach ($errors as $error): ?>
        <p class="crud-notice crud-notice-error" role="alert"><?= h($error) ?></p>
    <?php endforeach; ?>

    <div class="crud-actions">
        <a class="crud-link-button" href="crear.php">AGREGAR JUEGO</a>
        <a class="crud-link-button" href="../index.html">VOLVER AL SITIO</a>
    </div>

    <form class="crud-search" method="get" action="index.php">
        <div>
            <label for="buscar">Buscar título o género</label>
            <input id="buscar" name="buscar" type="search" maxlength="120" value="<?= h($search) ?>">
        </div>
        <div>
            <label for="filtro-consola">Consola</label>
            <select id="filtro-consola" name="consola">
                <option value="">Todas</option>
                <?php foreach ($consoles as $option): ?>
                    <option value="<?= h($option['id']) ?>" <?= $console === (string) $option['id'] ? 'selected' : '' ?>><?= h($option['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="filtro-genero">Género</label>
            <select id="filtro-genero" name="genero">
                <option value="">Todos</option>
                <?php foreach ($genres as $option): ?>
                    <option value="<?= h($option['id']) ?>" <?= $genre === (string) $option['id'] ? 'selected' : '' ?>><?= h($option['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="crud-button" type="submit">FILTRAR</button>
    </form>

    <?php if ($games === []): ?>
        <p class="crud-panel">Todavía no hay juegos para mostrar con estos filtros. Agregá el primer registro.</p>
    <?php else: ?>
        <div class="crud-table-wrap">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Género</th>
                        <th>Consolas</th>
                        <th>Año</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $game): ?>
                        <?php $imageSrc = safe_game_image_src($game['imagen_url']); ?>
                        <tr>
                            <td><?= h($game['id_juego']) ?></td>
                            <td><?= h($game['titulo']) ?></td>
                            <td><?= h($game['genero']) ?></td>
                            <td><?= h($game['consolas'] ?? '—') ?></td>
                            <td><?= h($game['anio_lanzamiento'] ?? '—') ?></td>
                            <td><?= h($game['descripcion']) ?></td>
                            <td>
                                <?php if ($imageSrc !== ''): ?>
                                    <img src="<?= h($imageSrc) ?>" alt="Imagen de <?= h($game['titulo']) ?>" width="90">
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="crud-actions">
                                    <a class="crud-link-button" href="editar.php?id=<?= h($game['id_juego']) ?>">EDITAR</a>
                                    <form class="crud-inline-form" method="post" action="eliminar.php">
                                        <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
                                        <input type="hidden" name="id" value="<?= h($game['id_juego']) ?>">
                                        <button class="crud-button crud-button-danger" type="submit">ELIMINAR</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
