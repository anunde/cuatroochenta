<?php

namespace App\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
        $this->isValid($this->value());

        return $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    private function isValid(string $value): void
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("Value can't be empty", 400);
        }

        if (!\is_string($value)) {
            throw new \InvalidArgumentException(\sprintf('%s does not allow the value %s.', static::class, $value), 400);
        }
    }
}