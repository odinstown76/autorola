<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

readonly class Make
{
    private function __construct(private string $make)
    {
    }

    public static function fromString(string $make): self
    {
        return new self(ucfirst($make));
    }

    public function toString(): string
    {
        return $this->make;
    }

    public function equals(self $other): bool
    {
        return $this->make === $other->make;
    }
}
