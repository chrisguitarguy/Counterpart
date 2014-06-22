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

/**
 * A mess of static, factory methods for creating matchers.
 *
 * @since   1.0
 */
trait Matchers
{
    /**
     * Create and return a new anything matcher.
     *
     * @return  Matcher\Anything
     */
    public static function anything()
    {
        return new Matcher\Anything();
    }

    /**
     * Create and return a new Callback matcher.
     *
     * @param   callable $callback The callback through which the actual value
     *          will be run.
     * @return  Matcher\Callback
     */
    public static function callback(callable $callback)
    {
        return new Matcher\Callback($callback);
    }

    /**
     * Creates and returns a new Contains matcher.
     *
     * @param   mixed $expected The value to look for in the array or Traversable
     * @return  Matcher\Contains
     */
    public static function contains($expected)
    {
        return new Matcher\Contains($expected);
    }

    /**
     * Creates and returns a new Contains wrapped in a LogicalNot.
     *
     * @param   mixed $expected The value to look for in the array or Traversable
     * @return  Matcher\LogicalNot
     */
    public static function doesNotContain($expected)
    {
        return self::logicalNot(self::contains($expected));
    }

    /**
     * Creates and returns a new Count matcher.
     *
     * @param   int $expectedCount The expected value to be returned from `count`
     * @return  Matcher\Count
     */
    public static function count($expectedCount)
    {
        return new Matcher\Count($expectedCount);
    }

    /**
     * Create and return a new FileExists matcher.
     *
     * @return  Matcher\FileExists
     */
    public static function fileExists()
    {
        return new Matcher\FileExists();
    }

    /**
     * Create and return a new FileExists matcher wrapped in a LogicalNot.
     *
     * @return  Matcher\LogicalNot
     */
    public static function fileDoesNotExist()
    {
        return self::logicalNot(self::fileExists());
    }

    /**
     * Create and return a new GreaterThan matcher.
     *
     * @param   numeric $expected A number the real value is meant to be greater than
     * @return  Matcher\GreaterThan
     */
    public static function greaterThan($expected)
    {
        return new Matcher\GreaterThan($expected);
    }

    /**
     * Retturn and Equal and GreaterThan matcher combined with a LogicalOr
     *
     * @param   numeric $expected A number the real value is meant to be greater
     *          than or equal to
     * @return  Matcher\LogicalOr
     */
    public static function greaterThanOrEqual($expected)
    {
        return self::logicalOr(
            self::isEqual($expected),
            self::greaterThan($expected)
        );
    }

    /**
     * Create and return a new HasKey matcher.
     *
     * @param   mixed $key The key for which the real array or ArrayAccess will
     *          be checked
     * @return  Matcher\HasKey
     */
    public static function hasKey($key)
    {
        return new Matcher\HasKey($key);
    }

    /**
     * Create and return a new HasKey matcher wrapped in a LogicalNot
     *
     * @param   mixed $key The key for which the real array will be checked
     * @return  Matcher\LogicalNot
     */
    public static function doesNotHaveKey($key)
    {
        return self::logicalNot(self::hasKey($key));
    }

    /**
     * Create and return an new HasProperty matcher
     *
     * @param   string $prop The property name for which the object will be checked
     * @return  Matcher\HasProperty
     */
    public static function hasProperty($prop)
    {
        return new Matcher\HasProperty($prop);
    }

    /**
     * Creates and returns a new HasProperty matcher wrapped in a LogicalNot
     *
     * @param   string $prop The propery name for which the object will be checked
     * @return  Matcher\LogicalNot
     */
    public static function doesNotHaveProperty($prop)
    {
        return self::logicalNot(self::hasProperty($prop));
    }

    /**
     * Creates and returns an new IsEmpty matcher.
     *
     * @return  Matcher\IsEmpty
     */
    public static function isEmpty()
    {
        return new Matcher\IsEmpty();
    }

    /**
     * Creates and returns a new IsEmpty matcher wrapped in a LogicalNot
     *
     * @return  Matcher\LogicalNot
     */
    public static function isNotEmpty()
    {
        return self::logicalNot(self::isEmpty());
    }

    /**
     * Creates and returns a new IsEqual matcher with non-strict equality checking.
     *
     * @param   mixed $expected The value against which the actual value will be
     *          checked.
     * @return  Matcher\IsEqual
     */
    public static function isEqual($expected)
    {
        return new Matcher\IsEqual($expected);
    }

    /**
     * Creates and returns a new IsEqual matcher with non-strict equality checking
     * wrapped in a LogicalNot.
     *
     * @param   mixed $expected The value against which the actual value will be
     *          checked.
     * @return  Matcher\LogicalNot
     */
    public static function isNotEqual($expected)
    {
        return self::logicalNot(self::isEqual($expected));
    }

    /**
     * Create an return a new IsEqual with strict equality checking.
     *
     * @param   mixed $expected The value against which the actual value will be
     *          checked.
     * @return  Matcher\IsEqual
     */
    public static function isIdentical($expected)
    {
        return new Matcher\IsEqual($expected, true);
    }

    /**
     * Create and return a new IsFalse matcher.
     *
     * @return  Matcher\IsFalse
     */
    public static function isFalse()
    {
        return new Matcher\IsFalse();
    }

    /**
     * Create and return a new IsFalsy matcher.
     *
     * @return  Matcher\IsFalsy
     */
    public static function isFalsy()
    {
        return new Matcher\IsFalsy();
    }

    /**
     * Create and return a new IsInstanceOf matcher.
     *
     * @param   string $classname The name of the class against which the actual
     *          value will be checked.
     * @return  Matcher\IsInstanceOf
     */
    public static function isInstanceOf($classname)
    {
        return new Matcher\IsInstanceOf($classname);
    }

    /**
     * Create and return a new IsJson matcher.
     *
     * @return  Matcher\IsJson
     */
    public static function isJson()
    {
        return new Matcher\IsJson();
    }

    /**
     * Create and return a new IsNull matcher.
     *
     * @return  Matcher\IsNull
     */
    public static function isNull()
    {
        return new Matcher\IsNull();
    }

    /**
     * Create and return a new IsNull matcher wrapped in a logical not
     *
     * @return  Matcher\LogicalNot
     */
    public static function isNotNull()
    {
        return self::logicalNot(self::isNull());
    }

    /**
     * Create and return a new IsTrue matcher.
     *
     * @return  Matcher\IsTrue
     */
    public static function isTrue()
    {
        return new Matcher\IsTrue();
    }

    /**
     * Create and return a new IsTruthy matcher.
     *
     * @return  Matcher\IsTruthy
     */
    public static function isTruthy()
    {
        return new Matcher\IsTruthy();
    }

    /**
     * Create and return a new IsType matcher.
     *
     * @param   string $type The internal type name against which the real value
     *          will be checked.
     * @return  Matcher\IsType
     */
    public static function isType($type)
    {
        return new Matcher\IsType($type);
    }

    /**
     * Create and return a new LessThan matcher.
     *
     * @param   numeric $expected A number the actual value is meant to be less than
     * @return  Matcher\LessThan
     */
    public static function lessThan($expected)
    {
        return new Matcher\LessThan($expected);
    }

    /**
     * Create and return a new LessThan and IsEqual matcher combined with a LogicalOr.
     *
     * @param   numeric $expected A number the actual value is meant to be less
     *          than or equal to.
     * @return  Matcher\LogicalOr
     */
    public static function lessThanOrEqual($expected)
    {
        return self::logicalOr(
            self::isEqual($expected),
            self::lessThan($expected)
        );
    }

    /**
     * Create and return a new MatchesRegex matcher.
     *
     * @param   string $pattern The regular expression pattern against which the
     *          real value will be checked
     * @return  Matcher\MatchesRegex
     */
    public static function matchesRegex($pattern)
    {
        return new Matcher\MatchesRegex($pattern);
    }

    /**
     * Create and returning and new MatchesRegex matcher wrapped in a LogicalNot.
     *
     * @param   string $pattern The regular expression pattern against which the
     *          real value will be checked
     * @return  Matcher\LogicalNot
     */
    public static function doesNotMatchRegex($pattern)
    {
        return self::logicalNot(self::matchesRegex($pattern));
    }

    /**
     * Create and return a new StringContains matcher.
     *
     * @param   string $expected A string the real value is expected to contain
     * @return  Matcher\StringContains
     */
    public static function stringContains($expected)
    {
        return new Matcher\StringContains($expected);
    }

    /**
     * Create and return a new StringContains matcher wrapped in a LogicalNot.
     *
     * @param   string $expected A string the real value is not expected to contain
     * @return  Matcher\LogicalNot
     */
    public static function stringDoesNotContain($expected)
    {
        return self::logicalNot(self::stringContains($expected));
    }

    /**
     * Create and return a new PhptFormat matcher.
     *
     * @param   string $format a valid PHPT format string.
     * @return  Matcher\PhptFormat
     */
    public static function phptFormat($format)
    {
        return new Matcher\PhptFormat($format);
    }

    /**
     * Create and return a new LogicalNot matcher.
     *
     * @param   Matcher $matcher The matcher to wrap in a LogicalNot
     * @return  Matcher\LogicalNot
     */
    public static function logicalNot(Matcher $matcher)
    {
        return new Matcher\LogicalNot($matcher);
    }

    /**
     * Create and return a new LogicalAnd matcher that combines the one or more
     * matchers passed in to the function.
     *
     * @param   Matcher $matcher... One or more matchers to wrap up.
     * @return  Matcher\LogicalAnd
     */
    public static function logicalAnd(Matcher $matcher /*...*/)
    {
        return new Matcher\LogicalAnd(func_get_args());
    }

    /**
     * Create and return a new LogicalOr matcher that combines the one or more
     * matchers passed in to the function.
     *
     * @param   Matcher $matcher... One or more matchers to wrap up.
     * @return  Matcher\LogicalOr
     */
    public static function logicalOr(Matcher $matcher /*...*/)
    {
        return new Matcher\LogicalOr(func_get_args());
    }

    /**
     * Create and return a new LogicalXor matcher that combines the one or more
     * matchers passed in to the function.
     *
     * @param   Matcher $matcher... One or more matchers to wrap up.
     * @return  Matcher\LogicalXor
     */
    public static function logicalXor(Matcher $matcher /*...*/)
    {
        return new Matcher\LogicalXor(func_get_args());
    }
}
