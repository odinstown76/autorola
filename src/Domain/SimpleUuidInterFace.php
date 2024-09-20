<?php

declare(strict_types=1);

namespace Domain;

interface SimpleUuidInterFace
{
    public function toString(): string;
    public function equals(self $other): bool;
}
