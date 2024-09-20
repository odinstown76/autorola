<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Application\Commands\UpdateCarCommand;
use Application\Services\UpdateCarService;
use Domain\Exceptions\CarCouldNotBeCreatedOrUpdated;
use Infrastructure\Http\Requests\ManageCarRequest;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use RuntimeException;

readonly class UpdateCarController
{
    public function __construct(
        private UpdateCarService $service,
        private ResponseFactory $responseFactory,
    ) {
    }

    public function __invoke(string $carId, ManageCarRequest $request): JsonResponse
    {
        try {
            $this->service->handle(new UpdateCarCommand(
                new SimpleUuidUsingRamsey($carId),
                $request->getVIN(),
                $request->getManufacturer(),
                $request->getMake(),
                $request->getModelYear(),
                $request->getColour(),
                $request->getMileage(),
            ));
        } catch (CarCouldNotBeCreatedOrUpdated $e) {
            return $this->responseFactory->json($e->getMessage(), 409);
        } catch (RuntimeException) {
            return $this->responseFactory->json('Car could not be created. An unknown error occurred.', 500);
        }

        return $this->responseFactory->json(['id' => $carId], 201);
    }
}
