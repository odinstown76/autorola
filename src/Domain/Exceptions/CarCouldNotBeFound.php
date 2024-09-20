<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use Domain\SimpleUuidInterFace;
use RuntimeException;

final class CarCouldNotBeFound extends RuntimeException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function withId(SimpleUuidInterFace $carId): self
    {
        return new self(
            sprintf('Car with id: "%s" could not be found.', $carId->toString()),
        );
    }
}
