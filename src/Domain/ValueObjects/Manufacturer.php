<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

readonly class Manufacturer
{
    private function __construct(private string $manufacturer)
    {
    }

    public static function fromString(string $manufacturer): self
    {
        return new self(ucfirst($manufacturer));
    }

    public function toString(): string
    {
        return $this->manufacturer;
    }

    public function equals(self $other): bool
    {
        return $this->manufacturer === $other->manufacturer;
    }
}
