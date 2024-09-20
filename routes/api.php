<?php

declare(strict_types=1);

use Infrastructure\Http\Controllers\CreateCarController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router->middleware([])->prefix('cars')->group(static function (Router $router): void {
    $router->post('/', CreateCarController::class);
});
