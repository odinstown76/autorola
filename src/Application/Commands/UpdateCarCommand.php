<?php

declare(strict_types=1);

namespace Application\Commands;

use Domain\SimpleUuidInterFace;
use Domain\ValueObjects\Colour;
use Domain\ValueObjects\Make;
use Domain\ValueObjects\Manufacturer;
use Domain\ValueObjects\Mileage;
use Domain\ValueObjects\ModelYear;
use Domain\ValueObjects\VIN;

final class UpdateCarCommand
{
    public function __construct(
        public SimpleUuidInterFace $id,
        public VIN $vin,
        public Manufacturer $manufacturer,
        public Make $make,
        public ModelYear $modelYear,
        public Colour $colour,
        public Mileage $mileage,
    ) {
    }
}
