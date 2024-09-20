<?php

declare(strict_types=1);

namespace Domain\Model;

use Domain\SimpleUuidInterFace;
use Domain\ValueObjects\Colour;
use Domain\ValueObjects\Make;
use Domain\ValueObjects\Manufacturer;
use Domain\ValueObjects\Mileage;
use Domain\ValueObjects\ModelYear;
use Domain\ValueObjects\VIN;
use DateTimeImmutable;

class Car
{
    public function __construct(
        public SimpleUuidInterFace $id,
        public VIN $vin,
        public Manufacturer $manufacturer,
        public Make $make,
        public ModelYear $modelYear,
        public Colour $colour,
        public Mileage $mileage,
        public DateTimeImmutable $createdAt,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'vin' => $this->vin->toString(),
            'manufacturer' => $this->manufacturer->toString(),
            'make' => $this->make->toString(),
            'modelYear' => $this->modelYear->toInt(),
            'colour' => $this->colour->toString(),
            'mileage' => $this->mileage->toInt(),
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
