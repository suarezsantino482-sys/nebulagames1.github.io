<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../includes/session_bootstrap.php';
require_once __DIR__ . '/../config/conexion.php';

$errors = [];
$successMessage = '';
$email = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $errors[] = 'Ingresá tu correo y contraseña.';
    } else {
        try {
            $statement = $pdo->prepare(
                'SELECT id, nombre, email, password, rol FROM usuarios_app WHERE email = :email LIMIT 1'
            );
            $statement->execute([':email' => $email]);
            $user = $statement->fetch();

            if ($user !== false && password_verify($password, (string) $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = (int) $user['id'];
                $_SESSION['usuario_nombre'] = (string) $user['nombre'];
                $_SESSION['rol'] = (string) $user['rol'];

                $redirectTarget = $_SESSION['rol'] === 'admin' ? '/admin_panel.php' : '/panel.php';
                header('Location: ' . $redirectTarget);
                exit;
            }

            $errors[] = 'Correo o contraseña incorrectos.';
        } catch (PDOException $exception) {
            log_database_error($exception);
            $errors[] = 'No se pudo validar la sesión. Revisá la conexión con MySQL.';
        }
    }
}

if (isset($_GET['error']) && $_GET['error'] === 'acceso_denegado') {
    $errors[] = 'Debés iniciar sesión para acceder a esta sección.';
}

if (isset($_GET['error']) && $_GET['error'] === 'sin_permiso') {
    $errors[] = 'No tenés permisos para acceder a esa vista.';
}

if (isset($_GET['success']) && $_GET['success'] === 'registro_exitoso') {
    $successMessage = 'Registro exitoso. Ahora podés iniciar sesión.';
}

$pageTitle = 'Iniciar sesión';
require __DIR__ . '/../includes/header.php';
?>
<main class="crud-main">
    <h2>INICIAR SESIÓN</h2>
    <p>Ingresá tus credenciales para acceder al panel de Nebula Games.</p>

    <?php if ($successMessage !== ''): ?>
        <div class="crud-notice crud-notice-success" role="status">
            <p><?= h($successMessage) ?></p>
        </div>
    <?php endif; ?>

    <?php if ($errors !== []): ?>
        <div class="crud-notice crud-notice-error" role="alert">
            <ul class="crud-errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= h($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="crud-form" method="post" action="login.php">
        <div>
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" maxlength="150" value="<?= h($email) ?>" required>
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" minlength="8" maxlength="128" required>
        </div>

        <div class="crud-form-actions">
            <button class="crud-button" type="submit">INGRESAR</button>
            <a class="crud-link-button" href="register.php">REGISTRARME</a>
        </div>
    </form>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
