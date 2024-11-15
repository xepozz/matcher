<?php

declare(strict_types=1);

namespace Xepozz\Matcher;

class LogicMatcher implements MatcherInterface
{
    use MatchesTrait;

    private array $matchers = [];

    public function __construct()
    {
    }

    public static function of(): static
    {
        return new self();
    }

    public function matches(): bool
    {
        return array_reduce(
            $this->matches,
            fn (bool $carry, callable $callable) => $carry && $callable(),
            true
        );
    }

    public function or(MatcherInterface ...$matchers): static
    {
        $new = clone $this;

        return $new->with(fn () => array_reduce(
            $matchers,
            fn (bool $carry, MatcherInterface $matcher) => $carry || $matcher->matches(),
            false
        ));
    }

    public function and(MatcherInterface ...$matchers): static
    {
        $new = clone $this;

        return $new->with(fn () => array_reduce(
            $matchers,
            fn (bool $carry, MatcherInterface $matcher) => $carry && $matcher->matches(),
            true,
        ));
    }

    public function not(MatcherInterface $matcher): static
    {
        $new = clone $this;

        return $new->with(fn () => !$matcher->matches());
    }
}