<?php

declare(strict_types=1);

namespace Anunde\Tests\Shared\Domain;

use Anunde\Tests\Shared\Infrastructure\Mockery\AnundeMatcherIsSimilar;
use Anunde\Tests\Shared\Infrastructure\PhpUnit\Constraint\AnundeConstraintIsSimilar;

final class TestUtils
{
	public static function isSimilar(mixed $expected, mixed $actual): bool
	{
		$constraint = new AnundeConstraintIsSimilar($expected);

		return $constraint->evaluate($actual, '', true);
	}

	public static function assertSimilar(mixed $expected, mixed $actual): void
	{
		$constraint = new AnundeConstraintIsSimilar($expected);

		$constraint->evaluate($actual);
	}

	public static function similarTo(mixed $value, float $delta = 0.0): AnundeMatcherIsSimilar
	{
		return new AnundeMatcherIsSimilar($value, $delta);
	}
}