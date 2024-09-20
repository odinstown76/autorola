<?php

declare(strict_types=1);

namespace Infrastructure\Http\Requests;

use Domain\ValueObjects\Colour;
use Domain\ValueObjects\Make;
use Domain\ValueObjects\Manufacturer;
use Domain\ValueObjects\Mileage;
use Domain\ValueObjects\ModelYear;
use Domain\ValueObjects\VIN;
use Illuminate\Foundation\Http\FormRequest;

final class ManageCarRequest extends FormRequest
{
    /**
     * @return array<string, array>
     */
    public function rules(): array
    {
        return [
            'vin' => ['required', 'string', 'min:17'],
            'manufacturer' => ['required', 'string'],
            'make' => ['required', 'string'],
            'model_year' => ['required', 'int', 'min:1885'],
            'colour' => ['required', 'string'],
            'mileage' => ['required', 'int', 'min:0'],
        ];
    }

    public function getVIN(): VIN
    {
        /** @var string $vin */
        $vin = $this->input('vin');

        return VIN::fromString($vin);
    }

    public function getManufacturer(): Manufacturer
    {
        /** @var string $manufacturer */
        $manufacturer = $this->input('manufacturer');

        return Manufacturer::fromString($manufacturer);
    }

    public function getMake(): Make
    {
        /** @var string $make */
        $make = $this->input('make');

        return Make::fromString($make);
    }

    public function getModelYear(): ModelYear
    {
        /** @var int $modelYear */
        $modelYear = $this->input('model_year');

        return ModelYear::fromInt($modelYear);
    }

    public function getColour(): Colour
    {
        /** @var string $colour */
        $colour = $this->input('colour');

        return Colour::fromString($colour);
    }

    public function getMileage(): Mileage
    {
        /** @var int $mileage */
        $mileage = $this->input('mileage');

        return Mileage::fromInt($mileage);
    }
}
