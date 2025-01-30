<?php

declare(strict_types=1);

namespace Anunde\Tests\Shared\Domain;

final class EmailMother
{
	public static function create(): string
	{
		return MotherCreator::random()->email;
	}
}