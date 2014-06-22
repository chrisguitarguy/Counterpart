<?php
/**
 * Copyright 2014 Christopher Davis <http://christopherdavis.me>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package     Counterpart\Test
 * @copyright   2014 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/apache-2.0 Apache-2.0
 */

namespace Counterpart;

use Counterpart\Exception\AssertionFailed;

/**
 * A mess of static functions that create matchers and run them through assertions.
 *
 * @since   1.0
 */
trait Assert
{
    /**
     * Checks and $actual value against a matcher. If the matcher fails an
     * exception is thrown using the matchers textual description and the
     * provied message.
     *
     * @param   Matcher $matcher The matcher to use checking $actual
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  AssertionFailed if the matcher is not successful
     */
    public static function assertThat(Matcher $matcher, $actual, $message='')
    {
        if ($matcher->matches($actual)) {
            return;
        }

        $message = sprintf(
            'Failed asserting that %s %s%s',
            prettify($actual),
            (string)$matcher,
            $message ? "\n{$message}" : ''
        );

        if ($matcher instanceof Describer) {
            $desc = $matcher->describeMismatch($actual);
            if (Describer::DECLINE_DESCRIPTION !== $desc) {
                $message .= "\n{$desc}";
            }
        }

        throw new AssertionFailed($message);
    }

    /**
     * Assert that a value matches a user defined callback.
     *
     * @param   callable $callback The user defined callback through which actual
     *          will be run.
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message taht describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if the callback returns false
     */
    public static function assertCallback(callable $callback, $actual, $message='')
    {
        return self::assertThat(
            Matchers::callback($callback),
            $actual,
            $message
        );
    }

    /**
     * Assert that an array or traversable contains a value.
     *
     * @param   mixed $expected The value that $actual is expected to contain
     * @param   array|Traversable $actual The actual, real-world value to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual does not contain the expected value
     */
    public static function assertContains($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::contains($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that an array or traversable does not contain a value.
     *
     * @param   mixed $expected The value that $actual will not contain
     * @param   array|Traversable $actual The actual, real-world value to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual contains the expected value
     */
    public static function assertDoesNotContain($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::doesNotContain($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that an array, traversable, or Countable has the expected number
     * of elements.
     *
     * @param   int $expectedCount The number of items the actual value is expected
     *          to contain
     * @param   array|Traversable|Countable $countable The actual, real-world
     *          value to count.
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $countable does not have the expected count
     */
    public static function assertCount($expectedCount, $countable, $message='')
    {
        return self::assertThat(
            Matchers::count($expectedCount),
            $countable,
            $message
        );
    }

    /**
     * Assert that a file exists on the filesystem.
     *
     * @param   string $filename The file name to check.
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if the file does not exist
     */
    public static function assertFileExists($filename, $message='')
    {
        return self::assertThat(
            Matchers::fileExists(),
            $filename,
            $message
        );
    }

    /**
     * Assert that a number is greater than a known value.
     *
     * @param   numeric $expected The number that $actual is expected to be greater than
     * @param   numeric $actual The real-world number to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is less than or equal to $expected
     */
    public static function assertGreaterThan($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::greaterThan($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a number is greater than or equal to a known value.
     *
     * @param   numeric $expected The number that $actual is expected to be
     *          greater than or equal to
     * @param   numeric $actua The real-world number to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is less than $expected
     */
    public static function assertGreaterThanOrEqual($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::greaterThanOrEqual($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a number is less than a known value.
     *
     * @param   numeric $expected The number that $actual is expected to be less than
     * @param   numeric $actual The real-world number to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is greater than or equal to $expected
     */
    public static function assertLessThan($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::lessThan($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert than a number is less than or equal to a known value.
     *
     * @param   numeric $expected The number that $actual is expected to be less
     *          than or equal to
     * @param   numeric $actual The real-world number to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is greater than $expected
     */
    public static function assertLessThanOrEqual($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::lessThanOrEqual($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert than an array or ArrayAccess has a known key.
     *
     * @param   mixed $key The known key for which the array will be checked
     * @param   array|ArrayAccess $actual The actual, real-world value to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual does not contain $key
     */
    public static function assertArrayHasKey($key, $actual, $message='')
    {
        return self::assertThat(
            Matchers::hasKey($key),
            $actual,
            $message
        );
    }

    /**
     * Assert than an array or ArrayAccess does not have a known key.
     *
     * @param   mixed $key The known key for which the array will be checked
     * @param   array|ArrayAccess $actual The actual, real-world value to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual contains $key
     */
    public static function assertArrayDoesNotHaveKey($key, $actual, $message='')
    {
        return self::assertThat(
            Matchers::doesNotHaveKey($key),
            $actual,
            $message
        );
    }

    /**
     * Assert than an object has a known property.
     *
     * @param   string $propName The known property name for which the object
     *          will be checked
     * @param   object $object The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $object does not have a property
     *          named $propName
     */
    public static function assertObjectHasProperty($propName, $object, $message='')
    {
        return self::assertThat(
            Matchers::hasProperty($propName),
            $object,
            $message
        );
    }

    /**
     * Assert that a value is empty.
     *
     * @param   mixed $actual The actual, real-world value to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not empty
     */
    public static function assertEmpty($actual, $message='')
    {
        return self::assertThat(
            Matchers::isEmpty(),
            $actual,
            $message
        );
    }

    /**
     * Assert that a value is not empty.
     *
     * @param   mixed $actual The actual, real-world value to check
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is empty
     */
    public static function assertNotEmpty($actual, $message='')
    {
        return self::assertThat(
            Matchers::isNotEmpty(),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real-world value equals a known value. This is non-strict
     * equality.
     *
     * @param   mixed $expected The known value against which $actual will be checked
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not equal to $expected
     */
    public static function assertEquals($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isEqual($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real-world value does not equal a known value. This is
     * non-strict equality.
     *
     * @param   mixed $expected The known value against which $actual will be checked
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is equal to $expected
     */
    public static function assertNotEquals($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isNotEqual($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real-world value is identical (strictly equal) to a known
     * value.
     *
     * @param   mixed $expected The known value against which $actual will be checked
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is no identical to $expected
     */
    public static function assertIdentical($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isIdentical($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real world value is false.
     *
     * @param   mixed $actual The real world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not false
     */
    public static function assertFalse($actual, $message='')
    {
        return self::assertThat(
            Matchers::isFalse(),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real world value is true.
     *
     * @param   mixed $actual The real world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not true
     */
    public static function assertTrue($actual, $message='')
    {
        return self::assertThat(
            Matchers::isTrue(),
            $actual,
            $message
        );
    }

    /**
     * Assert that an object is an instance of a class or interface.
     *
     * @param   string $classname The class or interface against which the actual
     *          value will be checked.
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not an instance of $classname
     */
    public static function assertInstanceOf($classname, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isInstanceOf($classname),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real world value is null.
     *
     * @param   mixed $actual The real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not null
     */
    public static function assertNull($actual, $message='')
    {
        return self::assertThat(
            Matchers::isNull(),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real world value is not null.
     *
     * @param   mixed $actual The real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is null
     */
    public static function assertNotNull($actual, $message='')
    {
        return self::assertThat(
            Matchers::isNotNull(),
            $actual,
            $message
        );
    }

    /**
     * Assert that a real world value is a known, internal type.
     *
     * @param   string $typename An internal PHP type name (int, array, string, etc)
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual is not a $typename
     */
    public static function assertType($typename, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isType($typename),
            $actual,
            $message
        );
    }

    /**
     * Assert that a stringy value matches a regular expression.
     *
     * @param   string $pattern The regular expression pattern against which the
     *          actual value will be checked
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual does not match the pattern
     *          or is not a string (or stringy object)
     */
    public static function assertMatchesRegex($pattern, $actual, $message='')
    {
        return self::assertThat(
            Matchers::matchesRegex($pattern),
            $actual,
            $message
        );
    }

    /**
     * Assert that a string contains a known substring.
     *
     * @param   string $expected The known substring for which $actual will be checked
     * @param   mixed $actual The real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual does not contain the expected
     *          substring or is not a string (or stringy object)
     */
    public static function assertStringContains($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::stringContains($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a string does not contain a known substring.
     *
     * @param   string $expected The known substring for which $actual will be checked
     * @param   mixed $actual The real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual contains $expected
     */
    public static function assertStringDoesNotContain($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::stringDoesNotContain($expected),
            $actual,
            $message
        );
    }

    /**
     * Assert that a string matches a known PHPT format.
     *
     * @see     Matcher\PhptFormat
     * @param   string $format The known PHPT format against which $actual will be checked
     * @param   mixed $actual The actual, real-world value
     * @param   string $message An optional message that describes why the
     *          assertion is important.
     * @throws  Exception\AssertionFailed if $actual does not match the format or
     *          $actual is not a string (or stringy object)
     */
    public static function assertMatchesPhptFormat($format, $actual, $message='')
    {
        return self::assertThat(
            Matchers::phptFormat($format),
            $actual,
            $message
        );
    }
}
