<?php

namespace Anunde\Api\Sensor\Domain;

use Anunde\Shared\Domain\Aggregate\AggregateRoot;

final class Sensor extends AggregateRoot
{

    public function __construct(
        private readonly SensorId $id,
        private SensorName $name,   
    ) {}

    public static function create(
        SensorId $id,
        SensorName $name
    ): self 
    {
        return new self(
            $id, 
            $name
        );
    }

    public function getId(): SensorId
    {
        return $this->id;
    }

    public function getName(): SensorName
    {
        return $this->name;
    }
}