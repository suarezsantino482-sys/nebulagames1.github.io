<?php
declare(strict_types=1);

$host = getenv('DB_HOST') ?: '127.0.0.1';
$database = getenv('DB_NAME') ?: 'nebula_games';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $host, $database);
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $exception) {
    error_log('Nebula Games database connection failed: ' . $exception->getMessage());
    http_response_code(500);
    exit('No se pudo conectar con la base de datos. Verificá la configuración de MySQL.');
}
