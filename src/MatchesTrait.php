<?php

declare(strict_types=1);

namespace Xepozz\Matcher;

trait MatchesTrait
{
    /**
     * @var callable[]
     */
    protected array $matches = [];

    public function with(callable $callable): static
    {
        $new = clone $this;
        $new->matches[] = $callable;

        return $new;
    }

    public function matches(): bool
    {
        return array_reduce(
            $this->matches,
            fn (bool $carry, callable $callable) => $carry && $callable($this->value),
            true
        );
    }
}