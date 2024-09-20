<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class Mileage
{
    private int $mileage;

    private function __construct(int $mileage)
    {
        Assert::greaterThanEq($mileage, 0, 'Mileage cannot be negative.');
        $this->mileage = $mileage;
    }

    public static function fromInt(int $mileage): self
    {
        return new self($mileage);
    }

    public function toInt(): int
    {
        return $this->mileage;
    }

    public function equals(self $other): bool
    {
        return $this->mileage === $other->mileage;
    }
}
