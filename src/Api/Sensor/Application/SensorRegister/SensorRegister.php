<?php

namespace Anunde\Api\Sensor\Application\SensorRegister;

use Anunde\Api\Sensor\Domain\Repository\SensorRepository;
use Anunde\Api\Sensor\Domain\Sensor;
use Anunde\Api\Sensor\Domain\SensorId;
use Anunde\Api\Sensor\Domain\SensorName;

final class SensorRegister
{
  public function __construct(
    private SensorRepository $repository,
  ) {}

  public function __invoke(SensorRegisterRequest $command): void
  {
    $sensor = Sensor::create(
        new SensorId($command->getId()),
        new SensorName($command->getName())
    );
    
    $this->repository->save($sensor);
  }
}
