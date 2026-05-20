<?php

declare(strict_types=1);

use App\Core\Database;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$pdo = Database::connect();

$pdo->exec("
    CREATE TABLE IF NOT EXISTS migrations (
        ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

$statement = $pdo->query('SELECT migration FROM migrations ORDER BY id DESC LIMIT 1');
$lastMigration = $statement->fetchColumn();

if (! $lastMigration) {
    echo 'Nothing to rollback' . PHP_EOL;
    exit;
}

$rollbackFile = __DIR__ . '/rollbacks/' . $lastMigration;

if (! file_exists($rollbackFile)) {
    echo "Rollback file not found: {$lastMigration}" . PHP_EOL;
    exit(1);
}

$pdo->exec(file_get_contents($rollbackFile));

$statement = $pdo->prepare('DELETE FROM migrations WHERE migration = :migration');
$statement->execute([
    'migration' => $lastMigration
]);

echo "Rolled back: {$lastMigration}" . PHP_EOL;