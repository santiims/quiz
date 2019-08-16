<?php

use Illuminate\Support\Arr;
use Quiz\Controllers\NotFoundController;
use Quiz\Route;

require_once '../vendor/autoload.php';
require_once '../src/bootstrap.php';
require_once '../src/functions.php';

/**
 * @var Route[] $routes
 */
$routes = require_once '../src/routes.php';

$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

$route = Arr::get($routes, $path, new Route(NotFoundController::class));
$route->handle();