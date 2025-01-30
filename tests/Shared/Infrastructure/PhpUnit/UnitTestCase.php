<?php

declare(strict_types=1);

namespace Anunde\Tests\Shared\Infrastructure\PhpUnit;

use Anunde\Tests\Shared\Domain\TestUtils;
use Anunde\Tests\Shared\Infrastructure\Mockery\AnundeMatcherIsSimilar;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{

	protected function mock(string $className): MockInterface
	{
		return Mockery::mock($className);
	}

	protected function similarTo(mixed $value, float $delta = 0.0): AnundeMatcherIsSimilar
	{
		return TestUtils::similarTo($value, $delta);
	}
}
