<?php

declare(strict_types=1);

namespace Xepozz\Matcher\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use stdClass;
use Xepozz\Matcher\ObjectMatcher;

class ObjectMatcherTest extends TestCase
{
    public function testSimple(): void
    {
        $matcher = new ObjectMatcher(new stdClass());
        $this->assertTrue($matcher->matches());

        $matcher = ObjectMatcher::of(new stdClass());
        $this->assertTrue($matcher->matches());
    }

    public function testWithInstanceOf(): void
    {
        $matcher = new ObjectMatcher(new stdClass());

        $this->assertEquals(true, $matcher->withInstanceOf(stdClass::class)->matches());
        $this->assertEquals(false, $matcher->withInstanceOf(DateTimeImmutable::class)->matches());
    }

    public function testWithHasProperty(): void
    {
        // @formatter:off
        $value = new class {
            public bool $foo;
            protected bool $bar;
            private bool $baz;
        };
        // @formatter:on

        $matcher = new ObjectMatcher($value);

        $this->assertEquals(true, $matcher->withHasProperty('foo')->matches());
        $this->assertEquals(true, $matcher->withHasProperty('bar')->matches());
        $this->assertEquals(true, $matcher->withHasProperty('baz')->matches());
        $this->assertEquals(false, $matcher->withHasProperty('matches')->matches());
    }

    public function testWithHasMethod(): void
    {
        // @formatter:off
        $value = new class {
            public function foo(){}
            protected function bar(){}
            private function baz(){}
        };
        // @formatter:on

        $matcher = new ObjectMatcher($value);

        $this->assertEquals(true, $matcher->withHasMethod('foo')->matches());
        $this->assertEquals(true, $matcher->withHasMethod('bar')->matches());
        $this->assertEquals(true, $matcher->withHasMethod('baz')->matches());
        $this->assertEquals(false, $matcher->withHasMethod('matches')->matches());
    }
}