<?php

declare(strict_types=1);

namespace Application\Commands;

use Domain\ValueObjects\Colour;
use Domain\ValueObjects\Make;
use Domain\ValueObjects\Manufacturer;
use Domain\ValueObjects\Mileage;
use Domain\ValueObjects\ModelYear;
use Domain\ValueObjects\VIN;

final class CreateCarCommand
{
    public function __construct(
        public VIN $vin,
        public Manufacturer $manufacturer,
        public Make $make,
        public ModelYear $modelYear,
        public Colour $colour,
        public Mileage $mileage,
    ) {
    }
}
