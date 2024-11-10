# Matcher

A way to match values against a pattern.

[![Latest Stable Version](https://poser.pugx.org/xepozz/matcher/v/stable.svg)](https://packagist.org/packages/xepozz/matcher)
[![Total Downloads](https://poser.pugx.org/xepozz/matcher/downloads.svg)](https://packagist.org/packages/xepozz/matcher)
[![phpunit](https://github.com/xepozz/matcher/workflows/PHPUnit/badge.svg)](https://github.com/xepozz/matcher/actions)
[![codecov](https://codecov.io/gh/xepozz/matcher/branch/master/graph/badge.svg?token=UREXAOUHTJ)](https://codecov.io/gh/xepozz/matcher)

## Installation

```bash
composer require xepozz/matcher
```

## Usage

### Basic concept

A matcher is an object that is filled with a value and callbacks that will be called if the value matches the pattern.

### Basic example

```php
use Xepozz\Matcher\StringMatcher;

/**
 * Each with* method returns a new instance of the matcher with the added condition.
 * So that means that the original matcher is not changed and you must use the returned instance.
 */
$matcher = (new StringMatcher('foo')) // or StringMatcher::of('foo')
    ->withLengthGreaterThan(2)
    ->withLengthLessThan(10)
    ->withContains('fo')
    ->withEndsWith('oo')
    ->withStartsWith('fo')
    ->with(function (string $value) {
        return $value === 'foo'; // callback for any custom checks
    });

$matcher->matches(); // true
```

### Combining matchers

```php
use Xepozz\Matcher\LogicMatcher;use Xepozz\Matcher\StringMatcher;

$logicMatcher = new LogicMatcher();
$stringMatcher = new StringMatcher('bar');

$stringMatcher->matches(); // true
$logicMatcher->not($stringMatcher)
    ->matches(); // false

$stringMatcher->matches(); // true
$logicMatcher->or($logicMatcher->not($stringMatcher), $stringMatcher)
    ->matches(); // true

$logicMatcher->or($logicMatcher->not($stringMatcher), $logicMatcher->not($stringMatcher))
    ->matches(); // false

$logicMatcher->and($stringMatcher, $logicMatcher->not($stringMatcher))
    ->matches(); // false

```

## Existing Matchers

- [Xepozz\Matcher\LogicMatcher](src/LogicMatcher.php)
- [Xepozz\Matcher\StringMatcher](src/StringMatcher.php)
- [Xepozz\Matcher\IntegerMatcher](src/IntegerMatcher.php)
- [Xepozz\Matcher\ObjectMatcher](src/ObjectMatcher.php)

