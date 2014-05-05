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

final class Assert
{
    public static function assertThat(Matcher $matcher, $actual, $message='')
    {
        if (!$matcher->matches($actual)) {
            throw new Exception\AssertionFailed(sprintf(
                'Failed asserting that %s %s%s',
                prettify($actual),
                (string)$matcher,
                $message ? "\n\t{$message}" : ''
            ));
        }
    }

    public static function assertContains($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::contains($expected),
            $actual,
            $message
        );
    }

    public static function assertDoesNotContain($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::doesNotContain($expected),
            $actual,
            $message
        );
    }

    public static function assertCount($expectedCount, $countable, $message='')
    {
        return self::assertThat(
            Matchers::count($expectedCount),
            $countable,
            $message
        );
    }

    public static function assertFileExists($filename, $message='')
    {
        return self::assertThat(
            Matchers::fileExists(),
            $filename,
            $message
        );
    }

    public static function assertGreaterThan($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::greaterThan($expected),
            $actual,
            $message
        );
    }

    public static function assertGreaterThanOrEqual($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::greaterThanOrEqual($expected),
            $actual,
            $message
        );
    }

    public static function assertLessThan($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::lessThan($expected),
            $actual,
            $message
        );
    }

    public static function assertLessThanOrEqual($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::lessThanOrEqual($expected),
            $actual,
            $message
        );
    }

    public static function assertArrayHasKey($key, $actual, $message='')
    {
        return self::assertThat(
            Matchers::hasKey($key),
            $actual,
            $message
        );
    }

    public static function assertObjectHasProperty($propName, $object, $message='')
    {
        return self::assertThat(
            Matchers::hasProperty($propName),
            $object,
            $message
        );
    }

    public static function assertEmpty($actual, $message='')
    {
        return self::assertThat(
            Matchers::isEmpty(),
            $actual,
            $message
        );
    }

    public static function assertNotEmpty($actual, $message='')
    {
        return self::assertThat(
            Matchers::isNotEmpty(),
            $actual,
            $message
        );
    }

    public static function assertEquals($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isEqual($expected),
            $actual,
            $message
        );
    }

    public static function assertIdentical($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isIdentical($expected),
            $actual,
            $message
        );
    }

    public static function assertFalse($actual, $message='')
    {
        return self::assertThat(
            Matchers::isFalse(),
            $actual,
            $message
        );
    }

    public static function assertTrue($actual, $message='')
    {
        return self::assertThat(
            Matchers::isTrue(),
            $actual,
            $message
        );
    }

    public static function assertInstanceOf($classname, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isInstanceOf($classname),
            $actual,
            $message
        );
    }

    public static function assertNull($actual, $message='')
    {
        return self::assertThat(
            Matchers::isNull(),
            $actual,
            $message
        );
    }

    public static function assertNotNull($actual, $message='')
    {
        return self::assertThat(
            Matchers::isNotNull(),
            $actual,
            $message
        );
    }

    public static function assertType($typename, $actual, $message='')
    {
        return self::assertThat(
            Matchers::isType($typename),
            $actual,
            $message
        );
    }

    public static function assertMatchesRegex($pattern, $actual, $message='')
    {
        return self::assertThat(
            Matchers::matchesRegex($pattern),
            $actual,
            $message
        );
    }

    public static function assertStringContains($expected, $actual, $message='')
    {
        return self::assertThat(
            Matchers::stringContains($expected),
            $actual,
            $message
        );
    }

    // @codeCoverageIgnoreStart
    private function __construct() { }
    // @codeCoverageIgnoreEnd
}
