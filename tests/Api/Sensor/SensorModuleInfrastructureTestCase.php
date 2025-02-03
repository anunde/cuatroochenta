<?php

declare(strict_types=1);

namespace Anunde\Tests\Api\Sensor;

use Anunde\Api\Sensor\Domain\Repository\SensorRepository;
use Anunde\Tests\Api\Shared\Infrastructure\Phpunit\ApiContextInfrastructureTestCase;

abstract class SensorModuleInfrastructureTestCase extends ApiContextInfrastructureTestCase
{
	protected function repository(): SensorRepository
	{
		return $this->service(SensorRepository::class);
	}
}