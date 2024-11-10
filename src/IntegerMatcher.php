<?php

declare(strict_types=1);

namespace Xepozz\Matcher;

class IntegerMatcher implements MatcherInterface
{
    use MatchesTrait;

    public function __construct(private readonly int $value)
    {
    }

    public static function of(int $value): static
    {
        return new self($value);
    }

    public function withGreaterThan(int $int): static
    {
        return $this->with(fn (int $value) => $value > $int);
    }

    public function withGreaterThanOrEqualsTo(int $int): static
    {
        return $this->with(fn (int $value) => $value >= $int);
    }

    public function withLessThan(int $int): static
    {
        return $this->with(fn (int $value) => $value < $int);
    }

    public function withLessThanOrEqualsTo(int $int): static
    {
        return $this->with(fn (int $value) => $value <= $int);
    }

    public function withEqualsTo(int $int): static
    {
        return $this->with(fn (int $value) => $value === $int);
    }

    public function withEvens(): static
    {
        return $this->with(fn (int $value) => $value % 2 === 0);
    }

    public function withOdds(): static
    {
        return $this->with(fn (int $value) => $value % 2 !== 0);
    }

    public function withMultipleOf(int $number): static
    {
        return $this->with(fn (int $value) => $value % $number === 0);
    }
}