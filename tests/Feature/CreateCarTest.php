<?php

namespace Tests\Feature;

use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateCarTest extends TestCase
{
    public function test_it_can_create_a_car()
    {
        $response = $this->postJson('/api/cars',
            [
                "vin" => "qwertyuiopålkjhgf",
                "manufacturer" => "Opel",
                "make" => "Astra",
                "model_year" => 2007,
                "colour" => "Silver",
                "mileage" => 167000,
            ])
            ->assertStatus(201)
            ->assertSee('id');

        self::assertTrue(Uuid::isValid($response->json()['id']));
    }
}
