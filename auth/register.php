<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../includes/session_bootstrap.php';
require_once __DIR__ . '/../config/conexion.php';

$errors = [];
$values = [
    'nombre' => '',
    'email' => '',
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $values['nombre'] = trim((string) ($_POST['nombre'] ?? ''));
    $values['email'] = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $passwordConfirm = (string) ($_POST['password_confirm'] ?? '');

    if ($values['nombre'] === '' || mb_strlen($values['nombre']) < 2 || mb_strlen($values['nombre']) > 80) {
        $errors[] = 'El nombre es obligatorio y debe tener entre 2 y 80 caracteres.';
    }

    if ($values['email'] === '' || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Ingresá un correo electrónico válido.';
    }

    if (mb_strlen($password) < 8 || mb_strlen($password) > 128) {
        $errors[] = 'La contraseña debe tener entre 8 y 128 caracteres.';
    }

    if ($password !== $passwordConfirm) {
        $errors[] = 'Las contraseñas no coinciden.';
    }

    if ($errors === []) {
        try {
            $exists = $pdo->prepare('SELECT 1 FROM usuarios_app WHERE email = :email LIMIT 1');
            $exists->execute([':email' => $values['email']]);
            if ($exists->fetch() !== false) {
                $errors[] = 'Ya existe un usuario registrado con ese correo electrónico.';
            }
        } catch (PDOException $exception) {
            log_database_error($exception);
            $errors[] = 'No se pudo validar el correo. Revisá la conexión con MySQL.';
        }
    }

    if ($errors === []) {
        try {
            $count = $pdo->query('SELECT COUNT(*) AS total FROM usuarios_app')->fetch();
            $rol = ((int) ($count['total'] ?? 0)) === 0 ? 'admin' : 'usuario';
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $statement = $pdo->prepare(
                'INSERT INTO usuarios_app (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)'
            );
            $statement->execute([
                ':nombre' => $values['nombre'],
                ':email' => $values['email'],
                ':password' => $passwordHash,
                ':rol' => $rol,
            ]);

            header('Location: login.php?success=registro_exitoso');
            exit;
        } catch (PDOException $exception) {
            log_database_error($exception);
            $errors[] = 'No se pudo completar el registro. Revisá la conexión con MySQL.';
        }
    }
}

$pageTitle = 'Registro';
require __DIR__ . '/../includes/header.php';
?>
<main class="crud-main">
    <h2>CREAR CUENTA EN NEBULA GAMES</h2>
    <p>Registrate para guardar tu sesión y acceder al panel del sitio.</p>

    <?php if ($errors !== []): ?>
        <div class="crud-notice crud-notice-error" role="alert">
            <ul class="crud-errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= h($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="crud-form" method="post" action="register.php">
        <div>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" maxlength="80" value="<?= h($values['nombre']) ?>" required>
        </div>

        <div>
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" maxlength="150" value="<?= h($values['email']) ?>" required>
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" minlength="8" maxlength="128" required>
        </div>

        <div>
            <label for="password_confirm">Confirmar contraseña</label>
            <input id="password_confirm" name="password_confirm" type="password" minlength="8" maxlength="128" required>
        </div>

        <div class="crud-form-actions">
            <button class="crud-button" type="submit">REGISTRARME</button>
            <a class="crud-link-button" href="login.php">YA TENGO CUENTA</a>
        </div>
    </form>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
