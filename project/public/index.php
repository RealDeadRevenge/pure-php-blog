<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use App\Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new App();

require_once __DIR__ . '/../routes/web.php';

$app->run();