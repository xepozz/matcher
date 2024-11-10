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

## Existing Matchers

- [Xepozz\Matcher\LogicMatcher](src/LogicMatcher.php)
- [Xepozz\Matcher\StringMatcher](src/StringMatcher.php)
- [Xepozz\Matcher\IntegerMatcher](src/IntegerMatcher.php)
- [Xepozz\Matcher\ObjectMatcher](src/ObjectMatcher.php)

