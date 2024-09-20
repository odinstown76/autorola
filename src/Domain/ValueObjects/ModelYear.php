<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class ModelYear
{
    private int $modelYear;

    private function __construct(int $modelYear)
    {
        Assert::greaterThanEq($modelYear, 1885, 'Model year cannot be before the creation of the first car.');
        $this->modelYear = $modelYear;
    }

    public static function fromInt(int $modelYear): self
    {
        return new self($modelYear);
    }

    public function toInt(): int
    {
        return $this->modelYear;
    }

    public function equals(self $other): bool
    {
        return $this->modelYear === $other->modelYear;
    }
}
