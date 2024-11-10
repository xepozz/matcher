<?php

declare(strict_types=1);

namespace Xepozz\Matcher;

interface MatcherInterface
{
    public function matches(): bool;
}