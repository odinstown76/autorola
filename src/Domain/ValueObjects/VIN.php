<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class VIN
{
    private string $vin;

    private function __construct(string $vin)
    {
        // The assumption is that we are working with cars created after 1981,
        // where VIN must be 17 characters in length.
        // Prior to 1981 VIN could vary in length from 11 to 17 characters.
        // Ideally, the VIN should be validated against the ISO 3779 standard https://www.iso.org/standard/52200.html.
        // This would also allow us to deduct most details about the vehicle in question.
        // But this is beyond the scope of this assignment.
        Assert::length($vin, 17, sprintf('Provided VIN: "%s" is not valid.', $vin));

        $this->vin = $vin;
    }

    public static function fromString(string $vin): self
    {
        return new self(strtoupper($vin));
    }

    public function toString(): string
    {
        return $this->vin;
    }

    public function equals(self $other): bool
    {
        return $this->vin === $other->vin;
    }
}
