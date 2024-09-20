<?php

declare(strict_types=1);

namespace Domain\Model;

use Domain\SimpleUuidInterFace;

interface CarRepository
{
    public function save(Car $car): SimpleUuidInterFace;
    public function nextIdentity(): SimpleUuidInterFace;
    public function findById(SimpleUuidInterFace $carId): Car;
    /** @return list<Car> */
    public function findAll(): array;
    public function deleteCarWithId(SimpleUuidInterFace $carId): void;
}
