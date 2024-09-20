<?php

declare(strict_types=1);

namespace Application\Factories;

use Application\Commands\CreateCarCommand;
use Domain\Model\Car;
use Domain\Model\CarRepository;
use DateTimeImmutable;

readonly class CarFactory
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function createCarFrom(CreateCarCommand $command): Car
    {
        return new Car(
            $this->carRepository->nextIdentity(),
            $command->vin,
            $command->manufacturer,
            $command->make,
            $command->modelYear,
            $command->colour,
            $command->mileage,
            new DateTimeImmutable(),
        );
    }
}
