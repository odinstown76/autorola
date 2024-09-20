<?php

declare(strict_types=1);

use Infrastructure\Http\Controllers\CreateCarController;
use Infrastructure\Http\Controllers\DeleteCarController;
use Infrastructure\Http\Controllers\GetCarController;
use Infrastructure\Http\Controllers\ListCarsController;
use Infrastructure\Http\Controllers\UpdateCarController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router->middleware([])->prefix('cars')->group(static function (Router $router): void {
    $router->post('/', CreateCarController::class);
    $router->get('/', ListCarsController::class);
    $router->get('/{carId}', GetCarController::class);
    $router->patch('/{carId}', UpdateCarController::class);
    $router->delete('/{carId}', DeleteCarController::class);
});
