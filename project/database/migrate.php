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

$files = glob(__DIR__ . '/migrations/*.sql');
sort($files);

foreach ($files as $file) {
    $migration = basename($file);

    $statement = $pdo->prepare('SELECT COUNT(*) FROM migrations WHERE migration = :migration');
    $statement->execute([
        'migration' => $migration
    ]);

    if ((int) $statement->fetchColumn() > 0) {
        echo "Skipped: {$migration}" . PHP_EOL;
        continue;
    }

    $pdo->exec(file_get_contents($file));

    $statement = $pdo->prepare('INSERT INTO migrations (migration) VALUES (:migration)');
    $statement->execute([
        'migration' => $migration
    ]);

    echo "Migrated: {$migration}" . PHP_EOL;
}