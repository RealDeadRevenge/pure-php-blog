<?php


/** @var App\Core\App $app */

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;

$app->get('/', [HomeController::class, 'index']);
$app->get('/category', [CategoryController::class, 'show']);
$app->get('/article', [ArticleController::class, 'show']);