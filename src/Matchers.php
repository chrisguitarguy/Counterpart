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

    public static function fileExists()
    {
        return new Matcher\FileExists();
    }

    public static function fileDoesNotExist()
    {
        return self::logicalNot(self::fileExists());
    }

    public static function greaterThan($expected)
    {
        return new Matcher\GreaterThan($expected);
    }

    public static function greaterThanOrEqual($expected)
    {
        return self::logicalOr(
            self::isEqual($expected),
            self::greaterThan($expected)
        );
    }

    public static function hasKey($key)
    {
        return new Matcher\HasKey($key);
    }

    public static function doesNotHaveKey($key)
    {
        return self::logicalNot(self::hasKey($key));
    }

    public static function hasProperty($prop)
    {
        return new Matcher\HasProperty($prop);
    }

    public static function doesNotHaveProperty($prop)
    {
        return self::logicalNot(self::hasProperty($prop));
    }

    public static function isEmpty()
    {
        return new Matcher\IsEmpty();
    }

    public static function isNotEmpty()
    {
        return self::logicalNot(self::isEmpty());
    }

    public static function isEqual($expected)
    {
        return new Matcher\IsEqual($expected);
    }

    public static function isNotEqual($expected)
    {
        return self::logicalNot(self::isEqual($expected));
    }

    public static function isIdentical($expected)
    {
        return new Matcher\IsEqual($expected, true);
    }

    public static function isFalse()
    {
        return new Matcher\IsFalse();
    }

    public static function isFalsy()
    {
        return new Matcher\IsFalsy();
    }

    public static function isInstanceOf($classname)
    {
        return new Matcher\IsInstanceOf($classname);
    }

    public static function isJson()
    {
        return new Matcher\IsJson();
    }

    public static function isNull()
    {
        return new Matcher\IsNull();
    }

    public static function isNotNull()
    {
        return self::logicalNot(self::isNull());
    }

    public static function isTrue()
    {
        return new Matcher\IsTrue();
    }

    public static function isTruthy()
    {
        return new Matcher\IsTruthy();
    }

    public static function isType($type)
    {
        return new Matcher\IsType($type);
    }

    public static function lessThan($expected)
    {
        return new Matcher\LessThan($expected);
    }

    public static function lessThanOrEqual($expected)
    {
        return self::logicalOr(
            self::isEqual($expected),
            self::lessThan($expected)
        );
    }

    public static function matchesRegex($pattern)
    {
        return new Matcher\MatchesRegex($pattern);
    }

    public static function doesNotMatchRegex($pattern)
    {
        return self::logicalNot(self::matchesRegex($pattern));
    }

    public static function stringContains($expected)
    {
        return new Matcher\StringContains($expected);
    }

    public static function stringDoesNotContain($expected)
    {
        return self::logicalNot(self::stringContains($expected));
    }

    public static function phptFormat($format)
    {
        return new Matcher\PhptFormat($format);
    }

    public static function logicalNot(Matcher $matcher)
    {
        return new Matcher\LogicalNot($matcher);
    }

    public static function logicalAnd(Matcher $matcher /*...*/)
    {
        return new Matcher\LogicalAnd(func_get_args());
    }

    public static function logicalOr(Matcher $matcher /*...*/)
    {
        return new Matcher\LogicalOr(func_get_args());
    }

    public static function logicalXor(Matcher $matcher /*...*/)
    {
        return new Matcher\LogicalXor(func_get_args());
    }
}
