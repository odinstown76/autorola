<?php

namespace Tests\Contract;

use DateTimeImmutable;
use Domain\Exceptions\CarCouldNotBeCreatedOrUpdated;
use Domain\Exceptions\CarCouldNotBeFound;
use Domain\Model\Car;
use Domain\Model\CarRepository;
use Domain\ValueObjects\Colour;
use Domain\ValueObjects\Make;
use Domain\ValueObjects\Manufacturer;
use Domain\ValueObjects\Mileage;
use Domain\ValueObjects\ModelYear;
use Domain\ValueObjects\VIN;
use Generator;
use Infrastructure\Repositories\CarRepositoryUsesInMemory;
use Infrastructure\Support\SimpleUuidFactoryUsingRamsey;
use Infrastructure\Support\SimpleUuidUsingRamsey;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidFactory;

class CarRepositoryTest extends TestCase
{
    /** @return Generator<int, list<CarRepository>> */
    public static function carRepositories(): Generator
    {
        yield [
            new CarRepositoryUsesInMemory(
                new SimpleUuidFactoryUsingRamsey(
                    new UuidFactory()
                )
            )
        ];
    }

    /** @dataProvider carRepositories */
    public function test_it_can_persist_a_car(CarRepository $repository): void
    {
        self::assertCount(0, $repository->findAll());

        $repository->save($this->getTestCar('3b16f294-642e-4d4e-a007-95a0669a65a6'));

        $cars = $repository->findAll();
        self::assertCount(1, $cars);
        self::assertTrue(
            (new SimpleUuidUsingRamsey('3b16f294-642e-4d4e-a007-95a0669a65a6'))
                ->equals($cars[0]->id)
        );
        self::assertTrue(VIN::fromString('QWERTYUIOP78YUHJK')->equals($cars[0]->vin));
        // Repeat for all relevant properties...
    }

    /** @dataProvider carRepositories */
    public function test_it_will_throw_an_exception_when_persisting_a_car_with_an_already_existing_vin(CarRepository $repository)
    {
        $repository->save($this->getTestCar('3b16f294-642e-4d4e-a007-95a0669a65a6'));

        self::expectException(CarCouldNotBeCreatedOrUpdated::class);
        self::expectExceptionMessage('Car could not be created. Car with VIN: "QWERTYUIOP78YUHJK" already exists.');

        $repository->save($this->getTestCar('2e8b3ff6-2f73-477b-984a-f780770b6330'));
    }

    /** @dataProvider carRepositories */
    public function test_it_find_a_car_by_id(CarRepository $repository)
    {
        $repository->save($this->getTestCar('3b16f294-642e-4d4e-a007-95a0669a65a6'));

        $car = $repository->findById(new SimpleUuidUsingRamsey('3b16f294-642e-4d4e-a007-95a0669a65a6'));
        self::assertNotNull($car);
        self::assertTrue(
            (new SimpleUuidUsingRamsey('3b16f294-642e-4d4e-a007-95a0669a65a6'))
                ->equals($car->id)
        );
        self::assertTrue(VIN::fromString('QWERTYUIOP78YUHJK')->equals($car->vin));
        // Repeat for all relevant properties...
    }

    /** @dataProvider carRepositories */
    public function test_it_will_throw_an_exception_if_car_cannot_be_found_by_id(CarRepository $repository)
    {
        self::expectException(CarCouldNotBeFound::class);
        self::expectExceptionMessage('Car with id: "3b16f294-642e-4d4e-a007-95a0669a65a6" could not be found.');

        $repository->findById(new SimpleUuidUsingRamsey('3b16f294-642e-4d4e-a007-95a0669a65a6'));
    }

    /** @dataProvider carRepositories */
    public function test_it_can_update_an_existing_car(CarRepository $repository)
    {
        $repository->save($this->getTestCar('3b16f294-642e-4d4e-a007-95a0669a65a6'));

        $car = $repository->findById(new SimpleUuidUsingRamsey('3b16f294-642e-4d4e-a007-95a0669a65a6'));
        self::assertTrue(Manufacturer::fromString('Opel')->equals($car->manufacturer));
        self::assertTrue(Make::fromString('Astra')->equals($car->make));

        $car->manufacturer = Manufacturer::fromString('Audi');
        $car->make = Make::fromString('A4');
        $repository->save($car);

        $freshCar = $repository->findById(new SimpleUuidUsingRamsey('3b16f294-642e-4d4e-a007-95a0669a65a6'));
        self::assertTrue(Manufacturer::fromString('Audi')->equals($freshCar->manufacturer));
        self::assertTrue(Make::fromString('A4')->equals($freshCar->make));
    }

    private function getTestCar(string $id): Car
    {
        return new Car(
            new SimpleUuidUsingRamsey($id),
            VIN::fromString('qwertyuiop78yuhjk'),
            Manufacturer::fromString('Opel'),
            Make::fromString('Astra'),
            ModelYear::fromInt(2007),
            Colour::fromString('Silver'),
            Mileage::fromInt(167000),
            new DateTimeImmutable('2024-09-18 20:00:00'),
        );
    }
}
