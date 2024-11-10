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
        return $this->with(fn (string $value) => strlen($value) > $int);
    }

    public function withLengthGreaterThanOrEqualsTo(int $int): static
    {
        return $this->with(fn (string $value) => strlen($value) >= $int);
    }

    public function withLengthLessThan(int $int): static
    {
        return $this->with(fn (string $value) => strlen($value) < $int);
    }

    /**
     * @param callable(string): bool $matcher
     */
    public function withLengthMatcher(callable $matcher): static
    {
        return $this->with(fn (string $value) => $matcher(strlen($value)));
    }

    public function withLengthLessThanOrEqualsTo(int $int): static
    {
        return $this->with(fn (string $value) => strlen($value) <= $int);
    }

    public function withLengthEqualsTo(int $int): static
    {
        return $this->with(fn (string $value) => strlen($value) === $int);
    }

    public function withStartsWith(string|Stringable $prefix): static
    {
        return $this->with(fn (string $value) => str_starts_with($value, $prefix));
    }

    public function withEndsWith(string|Stringable $prefix): static
    {
        return $this->with(fn (string $value) => str_ends_with($value, $prefix));
    }

    public function withContains(string|Stringable $prefix): static
    {
        return $this->with(fn (string $value) => str_contains($value, $prefix));
    }
}