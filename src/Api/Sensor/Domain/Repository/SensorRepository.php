<?php

namespace Anunde\Api\Sensor\Domain\Repository;

use Anunde\Api\Sensor\Domain\Sensor;
use Anunde\Api\Sensor\Domain\SensorName;

interface SensorRepository
{   
    public function save(Sensor $sensor): void;
    
    public function findSensorByName(SensorName $name): ?Sensor;
}