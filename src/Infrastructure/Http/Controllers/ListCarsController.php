<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Domain\Model\Car;
use Domain\Model\CarRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final readonly class ListCarsController
{
    public function __construct(
        private ResponseFactory $responseFactory,
        private CarRepository $carRepository,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $cars = $this->carRepository->findAll();

        return $this->responseFactory->json(
            array_map(
                static fn (Car $car) => $car->toArray(),
                $cars,
            ),
            200,
        );
    }
}
