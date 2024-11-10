<?php

declare(strict_types=1);

namespace Xepozz\Matcher\Tests;

use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Xepozz\Matcher\IntegerMatcher;

class IntegerMatcherTest extends TestCase
{
    public function testSimple(): void
    {
        $matcher = new IntegerMatcher(0);

        $this->assertTrue($matcher->matches());
    }

    #[TestWith([3, [IntegerMatcher::class, 'withGreaterThan'], [2], true])]
    #[TestWith([3, [IntegerMatcher::class, 'withGreaterThan'], [3], false])]
    #[TestWith([3, [IntegerMatcher::class, 'withGreaterThan'], [4], false])]
    #[TestWith([3, [IntegerMatcher::class, 'withGreaterThanOrEqualsTo'], [3], true])]
    #[TestWith([3, [IntegerMatcher::class, 'withLessThan'], [2], false])]
    #[TestWith([3, [IntegerMatcher::class, 'withLessThan'], [3], false])]
    #[TestWith([3, [IntegerMatcher::class, 'withLessThan'], [4], true])]
    #[TestWith([3, [IntegerMatcher::class, 'withLessThanOrEqualsTo'], [3], true])]
    #[TestWith([3, [IntegerMatcher::class, 'withEqualsTo'], [4], false])]
    #[TestWith([3, [IntegerMatcher::class, 'withEqualsTo'], [3], true])]
    public function testWithMethod(int $value, array $method, array $args, bool $expectedResult): void
    {
        $matcher = new IntegerMatcher($value);
        $matcher = $matcher->{$method[1]}(...$args);

        $this->assertEquals($expectedResult, $matcher->matches());
    }
}