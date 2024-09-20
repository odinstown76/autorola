<?php

declare(strict_types=1);

namespace Infrastructure\Support;

use Domain\SimpleUuidInterFace;

readonly class SimpleUuidUsingRamsey implements SimpleUuidInterFace
{
    public function __construct(private string $uuid)
    {
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public function equals(SimpleUuidInterFace $other): bool
    {
        return $this->uuid === $other->toString();
    }
}
