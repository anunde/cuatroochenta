<?php

declare(strict_types=1);

namespace Anunde\Tests\Api\Shared\Infrastructure\Phpunit;

use Anunde\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use Anunde\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use Doctrine\ORM\EntityManager;

use function Lambdish\Phunctional\apply;

final readonly class ApiEnvironmentArranger implements EnvironmentArranger
{
	public function __construct(private EntityManager $entityManager) {}

	public function arrange(): void
	{
		apply(new MySqlDatabaseCleaner(), [$this->entityManager]);
	}

	public function close(): void {}
}