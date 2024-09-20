<?php

declare(strict_types=1);

namespace Application\Services;

use Application\Commands\UpdateCarCommand;
use Domain\Model\Car;
use Domain\Model\CarRepository;

final readonly class UpdateCarService
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function handle(UpdateCarCommand $command): void
    {
        $this->carRepository->save($this->fetchAndUpdateCar($command));
    }

    private function fetchAndUpdateCar(UpdateCarCommand $command): Car
    {
        $car = $this->carRepository->findById($command->id);
        $car->vin = $command->vin;
        $car->manufacturer = $command->manufacturer;
        $car->make = $command->make;
        $car->modelYear = $command->modelYear;
        $car->colour = $command->colour;
        $car->mileage = $command->mileage;

        return $car;
    }
}
