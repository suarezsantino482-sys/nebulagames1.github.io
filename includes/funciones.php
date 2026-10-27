<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function h(string|int|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function post_string(string $key): string
{
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function valid_csrf_token(): bool
{
    $submittedToken = $_POST['csrf_token'] ?? '';
    return is_string($submittedToken)
        && isset($_SESSION['csrf_token'])
        && is_string($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $submittedToken);
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function take_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return is_array($flash) && isset($flash['type'], $flash['message'])
        && is_string($flash['type']) && is_string($flash['message'])
        ? $flash
        : null;
}

function redirect_to(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function log_database_error(PDOException $exception): void
{
    error_log('Nebula Games CRUD database error: ' . $exception->getMessage());
}

function safe_game_image_src(?string $imageUrl): string
{
    if ($imageUrl === null || $imageUrl === '') {
        return '';
    }
    if (preg_match('~^imagenes/[a-zA-Z0-9._ -]+$~', $imageUrl)) {
        return '../' . $imageUrl;
    }
    if (preg_match('~^https://[a-zA-Z0-9.-]+(?::[0-9]{1,5})?(?:/[^\s]*)?$~', $imageUrl)) {
        return $imageUrl;
    }

    return '';
}

function valid_game_id(mixed $value): ?int
{
    if (!is_string($value) && !is_int($value)) {
        return null;
    }

    $id = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? null : $id;
}

function load_game_options(PDO $pdo, string $table, string $idColumn): array
{
    if (!in_array($table, ['consolas', 'generos'], true)
        || !in_array($idColumn, ['id_consola', 'id_genero'], true)) {
        throw new InvalidArgumentException('Tabla de opciones no válida.');
    }

    $statement = $pdo->prepare("SELECT {$idColumn} AS id, nombre FROM {$table} ORDER BY nombre");
    $statement->execute();
    return $statement->fetchAll();
}

function validate_game(array $values, array $consoles, array $genres): array
{
    $errors = [];

    if ($values['titulo'] === '' || mb_strlen($values['titulo']) > 150) {
        $errors[] = 'El título es obligatorio y no puede superar los 150 caracteres.';
    }
    $consoleIds = array_map(static fn(array $console): string => (string) $console['id'], $consoles);
    if ($values['id_consolas'] === []
        || array_diff($values['id_consolas'], $consoleIds) !== []) {
        $errors[] = 'Seleccioná al menos una consola válida.';
    }
    $genreIds = array_map(static fn(array $genre): string => (string) $genre['id'], $genres);
    if (!in_array($values['id_genero'], $genreIds, true)) {
        $errors[] = 'Seleccioná un género válido.';
    }
    if ($values['anio_lanzamiento'] !== '') {
        $year = filter_var($values['anio_lanzamiento'], FILTER_VALIDATE_INT);
        if ($year === false || $year < 1950 || $year > (int) date('Y')) {
            $errors[] = 'El año de lanzamiento debe estar entre 1950 y el año actual.';
        }
    }
    if (mb_strlen($values['descripcion']) > 5000) {
        $errors[] = 'La descripción no puede superar los 5000 caracteres.';
    }
    if (mb_strlen($values['imagen_url']) > 500) {
        $errors[] = 'La ruta de imagen no puede superar los 500 caracteres.';
    } elseif ($values['imagen_url'] !== ''
        && !preg_match('~^(?:imagenes/[a-zA-Z0-9._ -]+|https://[a-zA-Z0-9.-]+(?::[0-9]{1,5})?(?:/[^\s]*)?)$~', $values['imagen_url'])) {
        $errors[] = 'La imagen debe ser una ruta dentro de imagenes/ o una URL HTTPS.';
    }

    return $errors;
}

function game_values_from_post(): array
{
    return [
        'titulo' => post_string('titulo'),
        'id_genero' => post_string('id_genero'),
        'id_consolas' => isset($_POST['id_consolas']) && is_array($_POST['id_consolas'])
            ? array_values(array_unique(array_filter($_POST['id_consolas'], 'is_string')))
            : [],
        'anio_lanzamiento' => post_string('anio_lanzamiento'),
        'descripcion' => post_string('descripcion'),
        'imagen_url' => post_string('imagen_url'),
    ];
}
