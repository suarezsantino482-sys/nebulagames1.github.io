<?php
$values = $values ?? [
    'titulo' => '',
    'id_genero' => '',
    'id_consolas' => [],
    'anio_lanzamiento' => '',
    'descripcion' => '',
    'imagen_url' => '',
];
$consoles = $consoles ?? [];
$genres = $genres ?? [];
$errors = $errors ?? [];
$submitLabel = $submitLabel ?? 'GUARDAR JUEGO';
?>
<?php if ($errors !== []): ?>
    <div class="crud-notice crud-notice-error" role="alert">
        <p>Revisá los siguientes datos:</p>
        <ul class="crud-errors">
            <?php foreach ($errors as $error): ?>
                <li><?= h($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form class="crud-form" method="post">
    <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
    <div>
        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="150" required value="<?= h($values['titulo']) ?>">
    </div>
    <div>
        <span class="crud-field-label">Consolas</span>
        <?php if ($consoles === []): ?>
            <p class="crud-notice crud-notice-error">No hay consolas cargadas en la base de datos.</p>
        <?php endif; ?>
        <div class="crud-checkboxes">
            <?php foreach ($consoles as $console): ?>
                <label>
                    <input type="checkbox" name="id_consolas[]" value="<?= h($console['id']) ?>" <?= in_array((string) $console['id'], $values['id_consolas'], true) ? 'checked' : '' ?>>
                    <?= h($console['nombre']) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <label for="genero">Género</label>
        <select id="genero" name="id_genero" required>
            <option value="">Seleccioná un género</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= h($genre['id']) ?>" <?= $values['id_genero'] === (string) $genre['id'] ? 'selected' : '' ?>><?= h($genre['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <?php if ($genres === []): ?>
            <p class="crud-notice crud-notice-error">No hay géneros cargados en la base de datos.</p>
        <?php endif; ?>
    </div>
    <div>
        <label for="anio_lanzamiento">Año de lanzamiento (opcional)</label>
        <input id="anio_lanzamiento" name="anio_lanzamiento" type="number" min="1950" max="<?= h(date('Y')) ?>" value="<?= h($values['anio_lanzamiento']) ?>">
    </div>
    <div>
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" maxlength="5000"><?= h($values['descripcion']) ?></textarea>
    </div>
    <div>
        <label for="imagen_url">Imagen (ruta relativa en imagenes/ o URL HTTPS, opcional)</label>
        <input id="imagen_url" name="imagen_url" type="text" maxlength="500" value="<?= h($values['imagen_url']) ?>">
    </div>
    <div class="crud-form-actions">
        <button class="crud-button" type="submit"><?= h($submitLabel) ?></button>
        <a class="crud-link-button" href="index.php">CANCELAR</a>
    </div>
</form>
