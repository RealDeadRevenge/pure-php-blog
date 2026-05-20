<?php

declare(strict_types=1);

use Database\Seeders\DatabaseSeeder;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

(new DatabaseSeeder())->run();

echo 'Database seeding completed' . PHP_EOL;