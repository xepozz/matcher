<?php

declare(strict_types=1);

namespace Xepozz\Matcher\Tests;

use PHPUnit\Framework\TestCase;
use Xepozz\Matcher\LogicMatcher;

class LogicMatcherTest extends TestCase
{
    public function testSimple(): void
    {
        $matcher = new LogicMatcher();

        $this->assertTrue($matcher->matches());
    }

    public function testNot(): void
    {
        $matcher = new LogicMatcher();
        $matcher = $matcher->not($matcher);

        $this->assertEquals(false, $matcher->matches());
    }

    public function testNotNot(): void
    {
        $matcher = new LogicMatcher();
        $matcher = $matcher->not($matcher->not($matcher));

        $this->assertEquals(true, $matcher->matches());
    }

    public function testOr(): void
    {
        $matcher = new LogicMatcher();
        $matcher = $matcher->or($matcher, $matcher);

        $this->assertEquals(true, $matcher->matches());
    }

    public function testOrNot(): void
    {
        $matcher = new LogicMatcher();
        $matcher = $matcher->or($matcher->not($matcher), $matcher->not($matcher));

        $this->assertEquals(false, $matcher->matches());
    }

    public function testAnd(): void
    {
        $matcher = new LogicMatcher();
        $matcher = $matcher->and($matcher, $matcher);

        $this->assertEquals(true, $matcher->matches());
    }

    public function testAndNot(): void
    {
        $matcher = new LogicMatcher();
        $matcher = $matcher->and($matcher->not($matcher), $matcher->not($matcher));

        $this->assertEquals(false, $matcher->matches());
    }
}