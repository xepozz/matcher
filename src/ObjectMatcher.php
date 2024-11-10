<?php

declare(strict_types=1);

namespace Xepozz\Matcher;

class ObjectMatcher implements MatcherInterface
{
    use MatchesTrait;

    public function __construct(private readonly object $value)
    {
    }

    public static function of(object $value): static
    {
        return new self($value);
    }

    public function withInstanceOf(string $class): static
    {
        return $this->with(fn (object $value) => $value instanceof $class);
    }

    public function withHasProperty(string $property): static
    {
        return $this->with(fn (object $value) => property_exists($value, $property));
    }

    public function withHasMethod(string $property): static
    {
        return $this->with(fn (object $value) => method_exists($value, $property));
    }
}