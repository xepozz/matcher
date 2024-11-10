<?php

declare(strict_types=1);

namespace Xepozz\Matcher\Tests;

use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Xepozz\Matcher\StringMatcher;

class StringMatcherTest extends TestCase
{
    public function testSimple(): void
    {
        $matcher = new StringMatcher('foo');

        $this->assertTrue($matcher->matches());
    }

    #[TestWith(['foo', [StringMatcher::class, 'withLengthGreaterThan'], [2], true])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthGreaterThan'], [3], false])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthGreaterThan'], [4], false])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthLessThan'], [2], false])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthLessThan'], [3], false])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthLessThan'], [4], true])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthEqualsTo'], [4], false])]
    #[TestWith(['foo', [StringMatcher::class, 'withLengthEqualsTo'], [3], true])]
    public function testWithMethod(string $value, array $method, array $args, bool $expectedResult): void
    {
        $matcher = new StringMatcher($value);
        $matcher = $matcher->{$method[1]}(...$args);

        $this->assertEquals($expectedResult, $matcher->matches());
    }
}