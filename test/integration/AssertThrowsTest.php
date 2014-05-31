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
 * @package     Counterpart
 * @copyright   2014 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/apache-2.0 Apache-2.0
 */

namespace Counterpart;

/**
 * Tests all the paths where Assert::assert* will throw exceptions
 */
class AssertThrowsTest extends IntegrationTestCase
{
    public function testAssertThanThrowsAssertionFailedWhenMatcherDoesNotMatch()
    {
        $matcher = $this->matcherReturning(false);
        Assert::assertThat($matcher, true, 'this should throw');
    }

    public function testAssertCallbackThrowsWhenUserDefinedCallbackReturnsFalse()
    {
        Assert::assertCallback(function () {
            return false;
        }, 'ignored');
    }

    public function testAssertContainsThrowsWhenArrayDoesNotContainExpected()
    {
        Assert::assertContains(123, [234, 455], 'this should throw');
    }

    public function testAssertDoesNotContainsThrowsWhenArrayDoesContainExpected()
    {
        Assert::assertDoesNotContain(123, [123, 234], 'this should throw');
    }

    public function testAssertCountThrowsWhenCountsDoesNotMatchExpected()
    {
        Assert::assertCount(100, [], 'should throw');
    }

    public function testAssertFileExistsThrowsWithNonExistentFile()
    {
        Assert::assertFileExists(__DIR__ . '/does/not/exist/at/all.txt');
    }

    public function testAssertGreaterThanThrowsWithNumberSmallerThanExpected()
    {
        Assert::assertGreaterThan(10, 10);
    }

    public function testAssertGreaterThanOrEqualThrowsWhenGivenASmallerValue()
    {
        Assert::assertGreaterThanOrEqual(10, 9);
    }

    public function testAssertLessThanThrowsWhenGivenANumberBiggerThanExpected()
    {
        Assert::assertLessThan(10, 10);
    }

    public function testAssertLessThanOrEqualsThrowsWhenGivenANumberBiggerThanExpected()
    {
        Assert::assertLessThanOrEqual(10, 100);
    }

    public function testAssertArrayHasKeyThrowsWhenGivenArrayWithoutExpectedKey()
    {
        Assert::assertArrayHasKey('one', []);
    }

    public function testAssertArrayDoesNotHaveKeyThrowsWhenGivenAnArrayWithExpectedKey()
    {
        Assert::assertArrayDoesNotHaveKey('one', ['one' => 2]);
    }

    public function testAssertObjectHasPropertyThrowsWhenGivenObjectWithoutExpectedProperty()
    {
        Assert::assertObjectHasProperty('one', new \stdClass);
    }

    public function testAssertEmptyThrowsWhenGivenANonEmptyValue()
    {
        Assert::assertEmpty(['not', 'empty']);
    }

    public function testAssertNotEmptyThrowsWhenGivenAnemptyValue()
    {
        Assert::assertNotEmpty([]);
    }

    public function testAssertEqualsThrowsWhenValuesAreNotEqual()
    {
        Assert::assertEquals(1, 2);
    }

    public function testAssertNotEqualsThrowsWhenValuesAreEqual()
    {
        Assert::assertNotEquals(1, 1);
    }

    public function testAssertIdenticalThrowsWhenValuesAreNotIdentical()
    {
        Assert::assertIdentical(new \stdClass, new \stdClass);
    }

    public static function testAssertFalseThrowsWhenValueIsNotFalse()
    {
        Assert::assertFalse(true);
    }

    public static function testAssertTrueThrowsWhenValueIsNotTrue()
    {
        Assert::assertTrue(false);
    }

    public function testAssertInstanceOfThrowsWhenGivenAnInvalidInstance()
    {
        Assert::assertInstanceOf(__CLASS__, new \stdClass);
    }

    public function testAssertNullThrowsWhenGivenANonNullValue()
    {
        Assert::assertNull('not null');
    }

    public function testAssertNotNullThrowsWhenGivenANullValue()
    {
        Assert::assertNotNull(null);
    }

    public function testAssertTypeThrowsWhenGivenAMismatchedType()
    {
        Assert::assertType('array', 'not an array');
    }

    public function testAssertMatchesRegexThrowsWhenAPatternDoesntMatch()
    {
        Assert::assertMatchesRegex('/here/', 'nope nope nope');
    }

    public function testAssertStringContainsWhenValueDoesNotContainNeedle()
    {
        Assert::assertStringContains('here', 'nope nope nope');
    }

    public function testAssertStringDoesNotContainThrowsWhenValueContainsNeedle()
    {
        Assert::assertStringDoesNotContain('here', 'here we are');
    }

    public function testAssertMatchesPhptFormatThrowsWhenValueDoesNotMatch()
    {
        Assert::assertMatchesPhptFormat('%d', 'not an integer');
    }

    protected function setUp()
    {
        $this->setExpectedException('Counterpart\\Exception\\AssertionFailed');
    }
}
