<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Domain\Exceptions\CarCouldNotBeFound;
use Domain\Model\CarRepository;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

final readonly class DeleteCarController
{
    public function __construct(
        private ResponseFactory $responseFactory,
        private CarRepository $carRepository,
    ) {
    }

    public function __invoke(string $carId): JsonResponse
    {
        try {
            $this->carRepository->deleteCarWithId(new SimpleUuidUsingRamsey($carId));
        } catch (CarCouldNotBeFound $e) {
            return $this->responseFactory->json($e->getMessage(), 404);
        }
        return $this->responseFactory->json(null, 200);
    }
}
