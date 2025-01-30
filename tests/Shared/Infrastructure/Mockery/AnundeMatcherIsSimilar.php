<?php

declare(strict_types=1);

namespace Anunde\Tests\Shared\Infrastructure\Mockery;

use Anunde\Tests\Shared\Infrastructure\PhpUnit\Constraint\AnundeConstraintIsSimilar;
use Mockery\Matcher\MatcherInterface;
use Stringable;

final readonly class AnundeMatcherIsSimilar implements Stringable, MatcherInterface
{
	private AnundeConstraintIsSimilar $constraint;

	public function __construct(mixed $value, float $delta = 0.0)
	{
		$this->constraint = new AnundeConstraintIsSimilar($value, $delta);
	}

	public function match(&$actual): bool
	{
		return $this->constraint->evaluate($actual, '', true);
	}

	public function __toString(): string
	{
		return 'Is similar';
	}
}