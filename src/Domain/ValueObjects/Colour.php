<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

readonly class Colour
{
    private function __construct(private string $colour)
    {
    }

    public static function fromString(string $colour): self
    {
        return new self(ucfirst($colour));
    }

    public function toString(): string
    {
        return $this->colour;
    }

    public function equals(self $other): bool
    {
        return $this->colour === $other->colour;
    }
}
