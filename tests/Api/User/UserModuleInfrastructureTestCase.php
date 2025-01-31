<?php

declare(strict_types=1);

namespace Anunde\Tests\Api\User;

use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Tests\Api\Shared\Infrastructure\Phpunit\ApiContextInfrastructureTestCase;

abstract class UserModuleInfrastructureTestCase extends ApiContextInfrastructureTestCase
{
	protected function repository(): IUserRepository
	{
		return $this->service(IUserRepository::class);
	}
}