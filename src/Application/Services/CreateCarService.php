<?php

declare(strict_types=1);

namespace Application\Services;

use Application\Commands\CreateCarCommand;
use Application\Factories\CarFactory;
use Domain\Model\CarRepository;
use Domain\SimpleUuidInterFace;

final readonly class CreateCarService
{
    public function __construct(private CarRepository $carRepository, private CarFactory $carFactory)
    {
    }

    public function handle(CreateCarCommand $command): SimpleUuidInterFace
    {
        return $this->carRepository->save(
            $this->carFactory->createCarFrom($command),
        );
    }
}
