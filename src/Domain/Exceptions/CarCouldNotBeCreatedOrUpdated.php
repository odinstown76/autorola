<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use Domain\ValueObjects\VIN;
use RuntimeException;

final class CarCouldNotBeCreatedOrUpdated extends RuntimeException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function forAlreadyExistingVIN(VIN $vin): self
    {
        return new self(
            sprintf('Car could not be created. Car with VIN: "%s" already exists.', $vin->toString()),
        );
    }
}
