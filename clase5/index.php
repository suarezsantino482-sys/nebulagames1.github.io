<?php
declare(strict_types=1);

function clean_input(array $source, string $key): string
{
    $value = $source[$key] ?? '';
    if (!is_string($value)) {
        return '';
    }

    return trim((string) filter_var($value, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW));
}

function escape_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function text_length(string $value): int
{
    $length = preg_match_all('/./us', $value);
    return $length === false ? PHP_INT_MAX : $length;
}

$errors = [];
$successMessage = '';
$name = '';
$email = '';
$message = '';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    $name = clean_input($_POST, 'nombre');
    $email = clean_input($_POST, 'correo');
    $message = clean_input($_POST, 'mensaje');

    if ($name === '') {
        $errors[] = 'El nombre es obligatorio.';
    } elseif (text_length($name) < 3 || text_length($name) > 60) {
        $errors[] = 'El nombre debe tener entre 3 y 60 caracteres.';
    }

    if ($email === '') {
        $errors[] = 'El correo electrónico es obligatorio.';
    } elseif (strlen($email) > 254 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Ingresá un correo electrónico válido.';
    }

    if ($message === '') {
        $errors[] = 'El mensaje es obligatorio.';
    } elseif (text_length($message) < 10 || text_length($message) > 1000) {
        $errors[] = 'El mensaje debe tener entre 10 y 1000 caracteres.';
    }

    if ($errors === []) {
        $successMessage = '¡Gracias, ' . $name . '! Tu mensaje fue recibido correctamente.';
        $name = '';
        $email = '';
        $message = '';
    }
}

$searchTerm = clean_input($_GET, 'buscar');
$platform = clean_input($_GET, 'consola');
$allowedPlatforms = ['todas', 'Nintendo', 'Sega', 'Atari'];
if (!in_array($platform, $allowedPlatforms, true)) {
    $platform = 'todas';
}
$searchError = text_length($searchTerm) > 80 ? 'La búsqueda no puede superar los 80 caracteres.' : '';

$games = [
    ['titulo' => 'Super Mario World', 'consola' => 'Nintendo'],
    ['titulo' => 'The Legend of Zelda: A Link to the Past', 'consola' => 'Nintendo'],
    ['titulo' => 'Sonic the Hedgehog 2', 'consola' => 'Sega'],
    ['titulo' => 'Streets of Rage 2', 'consola' => 'Sega'],
    ['titulo' => 'Adventure', 'consola' => 'Atari'],
];

$results = $searchError === '' ? array_filter($games, static function (array $game) use ($searchTerm, $platform): bool {
    $matchesTerm = $searchTerm === '' || stripos($game['titulo'], $searchTerm) !== false;
    $matchesPlatform = $platform === 'todas' || $game['consola'] === $platform;
    return $matchesTerm && $matchesPlatform;
}) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase 5 | Formularios seguros - Nebula Games</title>
    <link rel="stylesheet" href="../estilos.css">
    <style>
        .clase5-main { max-width: 900px; margin: 36px auto; padding: 0 20px; }
        .clase5-main h2, .clase5-main h3 { color: #00ffff; }
        .clase5-main h2 { margin-bottom: 16px; }
        .clase5-main h3 { margin: 28px 0 12px; }
        .clase5-main p { margin: 10px 0; }
        .clase5-main form { max-width: 100%; margin: 16px 0; }
        .clase5-main input, .clase5-main textarea, .clase5-main select {
            width: 100%; padding: 10px; color: #e0e0ff; background: #0a0a1a;
            border: 1px solid #00ffff; font: inherit;
        }
        .clase5-main textarea { resize: vertical; }
        .clase5-main label { display: block; margin-bottom: 5px; }
        .clase5-main .form-group { margin-bottom: 16px; }
        .notice { padding: 12px 16px; margin: 16px 0; border: 2px solid; }
        .notice-success { color: #8cffb1; border-color: #8cffb1; }
        .notice-error { color: #ff9b9b; border-color: #ff6b6b; }
        .results { padding-left: 22px; }
        .results li { margin: 6px 0; }
        .method-tag { color: #ff70ff; font-weight: bold; }
        @media (max-width: 600px) {
            .clase5-main { margin: 24px auto; }
            .clase5-main form { padding: 16px; }
        }
    </style>
</head>
<body>
    <header>
        <h1>★ NEBULA GAMES ★</h1>
    </header>

    <nav aria-label="Navegación principal">
        <a href="../index.html">Inicio</a>
        <a href="index.php">Clase 5</a>
    </nav>

    <main class="clase5-main">
        <h2>FORMULARIOS Y PROCESAMIENTO SEGURO</h2>
        <p>Demostración de formularios procesados en el servidor con PHP.</p>

        <section aria-labelledby="post-title">
            <h3 id="post-title">Contacto <span class="method-tag">POST</span></h3>
            <p>Los campos obligatorios y el formato del correo se validan en el servidor.</p>

            <?php if ($successMessage !== ''): ?>
                <p class="notice notice-success" role="status"><?= escape_html($successMessage) ?></p>
            <?php endif; ?>

            <?php if ($errors !== []): ?>
                <div class="notice notice-error" role="alert">
                    <p>Revisá estos datos:</p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= escape_html($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="index.php" method="post" class="form-arcade">
                <div class="form-group">
                    <label for="nombre">Nombre / Gamertag</label>
                    <input type="text" id="nombre" name="nombre" required minlength="3" maxlength="60" value="<?= escape_html($name) ?>">
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" required maxlength="254" value="<?= escape_html($email) ?>">
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="5" required minlength="10" maxlength="1000"><?= escape_html($message) ?></textarea>
                </div>
                <button type="submit" class="btn-submit">ENVIAR MENSAJE</button>
            </form>
        </section>

        <section aria-labelledby="get-title">
            <h3 id="get-title">Buscar juegos <span class="method-tag">GET</span></h3>
            <p>La consulta viaja en la URL y filtra este catálogo de demostración.</p>
            <form action="index.php" method="get" class="form-arcade">
                <div class="form-group">
                    <label for="buscar">Nombre del juego</label>
                    <input type="search" id="buscar" name="buscar" maxlength="80" value="<?= escape_html($searchTerm) ?>">
                </div>
                <div class="form-group">
                    <label for="consola">Consola</label>
                    <select id="consola" name="consola">
                        <?php foreach ($allowedPlatforms as $option): ?>
                            <option value="<?= escape_html($option) ?>" <?= $platform === $option ? 'selected' : '' ?>><?= escape_html($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-submit">BUSCAR</button>
            </form>

            <?php if ($searchError !== ''): ?>
                <p class="notice notice-error" role="alert"><?= escape_html($searchError) ?></p>
            <?php elseif ($searchTerm !== '' || $platform !== 'todas'): ?>
                <p>Resultados para «<?= escape_html($searchTerm) ?>» (<?= escape_html($platform) ?>):</p>
                <?php if ($results === []): ?>
                    <p>No se encontraron juegos con esos filtros.</p>
                <?php else: ?>
                    <ul class="results">
                        <?php foreach ($results as $game): ?>
                            <li><?= escape_html($game['titulo']) ?> <span>(<?= escape_html($game['consola']) ?>)</span></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>© 2026 NEBULA GAMES · CLASE 5</p>
    </footer>
</body>
</html>