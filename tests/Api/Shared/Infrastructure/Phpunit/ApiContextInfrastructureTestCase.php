<?php

declare(strict_types=1);

namespace Anunde\Tests\Api\Shared\Infrastructure\Phpunit;

use Anunde\Apps\Api\ApiKernel;
use Anunde\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class ApiContextInfrastructureTestCase extends InfrastructureTestCase
{
	protected function setUp(): void
	{
		parent::setUp();

		$arranger = new ApiEnvironmentArranger($this->service(EntityManager::class));

		$arranger->arrange();
	}

	protected function tearDown(): void
	{
		$arranger = new ApiEnvironmentArranger($this->service(EntityManager::class));

		$arranger->close();

		parent::tearDown();
	}

	protected function kernelClass(): string
	{
		return ApiKernel::class;
	}
}