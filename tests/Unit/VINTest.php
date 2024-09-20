<?php


use Domain\ValueObjects\VIN;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

class VINTest extends TestCase
{

    public function test_a_vin_must_not_have_less_than_17_characters()
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Provided VIN: "TOO_FEW_ARGUMENT" is not valid.');
        VIN::fromString('too_few_argument');
    }

    public function test_a_vin_must_not_have_more_than_17_characters()
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Provided VIN: "TOO_MANY_ARGUMENTS" is not valid.');
        VIN::fromString('too_many_arguments');
    }

    public function test_a_vin_with_17_characters_can_be_created()
    {
        $vin = VIN::fromString('correct_arguments');
        self::assertSame('CORRECT_ARGUMENTS', $vin->toString());
    }
}
