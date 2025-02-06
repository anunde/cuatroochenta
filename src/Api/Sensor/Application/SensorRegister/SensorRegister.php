<?php

namespace Anunde\Api\Sensor\Application\SensorRegister;

use Anunde\Api\Sensor\Domain\Sensor;
use Anunde\Api\Sensor\Domain\SensorId;
use Anunde\Api\Sensor\Domain\SensorName;
use Anunde\Api\Sensor\Domain\Repository\SensorRepository;
use Anunde\Api\Sensor\Domain\SensorAlreadyExistsException;

final class SensorRegister
{
  public function __construct(
    private SensorRepository $repository,
  ) {}

  public function __invoke(SensorRegisterRequest $command): void
  {
    dd('aqui llega');
    $this->ensureSensorDoesNotExist(new SensorName($command->getName()));

    $sensor = Sensor::create(
        new SensorId($command->getId()),
        new SensorName($command->getName())
    );
    
    $this->repository->save($sensor);
  }

  private function ensureSensorDoesNotExist(SensorName $name): void
  {
    if(null !== $this->repository->findSensorByName($name)) {
      throw new SensorAlreadyExistsException(sprintf('Sensor with name <%s> already exists', $name->value()));
    }
  }
}
