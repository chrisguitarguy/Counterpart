# Counterpart

[![Build Status](https://travis-ci.org/chrisguitarguy/Counterpart.svg?branch=master)](https://travis-ci.org/chrisguitarguy/Counterpart)

Counterpart is an object matching framework for PHP inspired by [PHPUnit](http://phpunit.de/)'s
constraints and [Hamcrest](http://hamcrest.org/).

## Where to Use?

As part of a testing framework or someplace you'd need to assert a given value
matches some expected constraint.

## Examples

Two classes act as factories and are, by the far, the easiest way to get
started.

You can see some pretty high-level usage of of the `Assert` and `Matchers` API.

#### Creating Matchers

```php
use Counterpart\Matchers;

$isTrue = Matchers::isTrue();
$isTrue->matches(false); // false
$isTrue->matches(true); // true
```

#### Assertions

All of the `assert*` methods in `Counterpart\Assert` will throw a
`Counterpart\Exception\AssertionFailed` exception.

```php
use Counterpart\Assert;

Assert::assertMatchesRegex(
    '/here/',
    'nope nope nope',
    "some message about business results here so you understand why it's important"
);
```

## Creating Custom Matchers

One of the strengths of Counterpart is that it's very easy to create new, custom
`Matcher` implementations. Doing so let's you clarify your business logic and
create more readable code.

For example: let's say we needed to assert that the value returned from a number
between 1 and 100.

This could be done with a `LogicalAnd` matcher and a few other matchers.

```php
use Counterpart\Assert;
use Counterpart\Matchers;

Assert::assertThat(
    Matchers::logicalAnd(
        Matchers::isType('integer'),
        Matchers::greaterThanOrEqual(1),
        Matchers::lessThanOrEqual(100)
    )
    $theRealNumber
);
```

There's absolutely nothing wrong with that. It's a bit wordy, especially if you
have to write it out a lot. And if you do have to write it a lot, there's a good
chance it's because it's part of some core business logic. Maybe you hit an API
that only accepts values between 1 and 100.

This is great use case for a custom matcher.

```php
use Counterpart\Matcher;
use Counterpart\Assert;

class ValidApiValueMatcher implements Matcher
{
    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return is_int($actual) && $actual >= 1 && $actual <= 100;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'is a valid API value: an integer between 1 and 100';
    }
}

Assert::assertThat(new ValidApiValueMatcher(), $theActualValue);
```

This is now a nicely self contained, reusable piece of code, the name of which
reinforces it's purpose.

## License

Apache 2.0 -- please see the LICENSE file.
