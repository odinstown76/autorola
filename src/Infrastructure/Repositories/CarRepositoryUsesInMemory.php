<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Exceptions\CarCouldNotBeCreatedOrUpdated;
use Domain\Exceptions\CarCouldNotBeFound;
use Domain\Model\Car;
use Domain\Model\CarRepository;
use Domain\SimpleUuidFactory;
use Domain\SimpleUuidInterFace;
use RuntimeException;
use Throwable;

final class CarRepositoryUsesInMemory implements CarRepository
{
    /**
     * @var array<string, Car>
     */
    private array $cars = [];

    public function __construct(private readonly SimpleUuidFactory $uuidFactory)
    {
    }

    public function nextIdentity(): SimpleUuidInterFace
    {
        return $this->uuidFactory->make();
    }

    public function save(Car $car): SimpleUuidInterFace
    {
        $this->validateUniqueVIN($car);
        try {
            $this->cars[$car->id->toString()] = $car;
        } catch (Throwable) {
            throw new RuntimeException();
        }

        return $car->id;
    }

    public function findById(SimpleUuidInterFace $carId): Car
    {
        if (!array_key_exists($carId->toString(), $this->cars)) {
            throw CarCouldNotBeFound::withId($carId);
        }

        return $this->cars[$carId->toString()];
    }

    /**
     * @return list<Car>
     */
    public function findAll(): array
    {
        return array_values($this->cars);
    }

    public function deleteCarWithId(SimpleUuidInterFace $carId): void
    {
        if (!array_key_exists($carId->toString(), $this->cars)) {
            throw CarCouldNotBeFound::withId($carId);
        }

        unset($this->cars[$carId->toString()]);
    }

    private function validateUniqueVIN(Car $car): void
    {
        $duplicateVIN = array_values(array_filter(
            $this->cars,
            static fn(Car $persistedCar) => $persistedCar->vin->equals($car->vin),
        ));
        if (count($duplicateVIN) !== 0 && !$car->id->equals($duplicateVIN[0]->id)) {
            throw CarCouldNotBeCreatedOrUpdated::forAlreadyExistingVIN($car->vin);
        }
    }
}
