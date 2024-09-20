<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Domain\Exceptions\CarCouldNotBeFound;
use Domain\Model\CarRepository;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final readonly class GetCarController
{
    public function __construct(
        private ResponseFactory $responseFactory,
        private CarRepository $carRepository,
    ) {
    }

    public function __invoke(string $carId): JsonResponse
    {
        try {
            $car = $this->carRepository->findById(new SimpleUuidUsingRamsey($carId));
        } catch (CarCouldNotBeFound $e) {
            return $this->responseFactory->json($e->getMessage(), 404);
        }
        return $this->responseFactory->json($car->toArray(), 200);
    }
}
