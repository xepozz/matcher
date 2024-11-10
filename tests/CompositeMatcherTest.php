<?php

declare(strict_types=1);

namespace Xepozz\Matcher\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Matcher\LogicMatcher;
use Xepozz\Matcher\StringMatcher;

class CompositeMatcherTest extends TestCase
{
    public function testComplex(): void
    {
        $matcher = LogicMatcher::of()
            ->and(
                StringMatcher::of('foo')
                    ->withLengthEqualsTo(3),
                LogicMatcher::of()
                    ->or(
                        StringMatcher::of('hello')
                            ->withLengthEqualsTo(0),
                        LogicMatcher::of()
                            ->and(
                                StringMatcher::of('hello')
                                    ->withLengthGreaterThan(3),
                                StringMatcher::of('hello')
                                    ->withLengthLessThan(10),
                            ),
                    ),
            );

        $this->assertTrue($matcher->matches());
    }
}