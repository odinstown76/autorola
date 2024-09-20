<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controllers;

use Application\Commands\CreateCarCommand;
use Application\Services\CreateCarService;
use Domain\Exceptions\CarCouldNotBeCreatedOrUpdated;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\Http\Requests\ManageCarRequest;
use RuntimeException;

final readonly class CreateCarController
{
    public function __construct(
        private CreateCarService $service,
        private ResponseFactory $responseFactory,
    ) {
    }

    public function __invoke(ManageCarRequest $request): JsonResponse
    {
        try {
            $carId = $this->service->handle(new CreateCarCommand(
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

        return $this->responseFactory->json(['id' => $carId->toString()], 201);
    }
}
