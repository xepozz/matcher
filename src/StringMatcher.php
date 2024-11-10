<?php

declare(strict_types=1);

namespace Xepozz\Matcher;

use Stringable;

class StringMatcher implements MatcherInterface
{
    use MatchesTrait;

    public function __construct(private readonly string|Stringable $value)
    {
    }

    public static function of(string|Stringable $value): static
    {
        return new self($value);
    }

    public function withLengthGreaterThan(int $int): static
    {
        return $this->with(function (string $value) use ($int) {
            return strlen($value) > $int;
        });
    }

    public function withLengthLessThan(int $int): static
    {
        return $this->with(function (string $value) use ($int) {
            return strlen($value) < $int;
        });
    }

    public function withLengthEqualsTo(int $int): static
    {
        return $this->with(function (string $value) use ($int) {
            return strlen($value) === $int;
        });
    }
}