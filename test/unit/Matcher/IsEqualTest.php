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

namespace Counterpart\Matcher;

use Counterpart\TestCase;

class IsEqualTest extends TestCase
{
    public function equalityProvider()
    {
        return [
            [null, ''],
            [false, ''],
            [true, 'non empty string'],
            [new \stdClass, new \stdClass]
        ];
    }

    public function exactEqualityProvider()
    {
        $cls = new \stdClass;
        return [
            [false, false],
            [true, true],
            [null, null],
            [12, 12],
            ['one', 'one'],
            [1.0, 1.0],
            [$cls, $cls],
        ];
    }

    /**
     * @dataProvider equalityProvider
     */
    public function testMatchesReturnsTrueForEqualValues($expected, $actual)
    {
        $this->assertTrue((new IsEqual($expected))->matches($actual));
    }

    /**
     * @dataProvider exactEqualityProvider
     */
    public function testMatchesReturnsTrueForExactlyEqualValue($expected, $actual)
    {
        $this->assertTrue((new IsEqual($expected))->matches($actual));
    }

    /**
     * @dataProvider exactEqualityProvider
     */
    public function testMatchesWithStrictReturnsTrueOnlyForExactlyEqualsItems($expected, $actual)
    {
        $this->assertTrue((new IsEqual($expected, true))->matches($actual));
    }

    /**
     * @dataProvider equalityProvider
     */
    public function testMatchesWithStrictReturnsFalseForFuzzyEqualValues($expected, $actual)
    {
        $this->assertFalse((new IsEqual($expected, true))->matches($actual));
    }

    public function inequalityProvider()
    {
        $ob = new \stdClass;
        $ob->prop = true;

        return [
            [false, 'not empty'],
            ['one', 'two'],
            [false, true],
            [new \stdClass, $ob]
        ];
    }

    /**
     * @dataProvider inequalityProvider
     */
    public function testMatchesReturnsFalseForNotEqualValues($expected, $actual)
    {
        $this->assertFalse((new IsEqual($expected))->matches($actual));
    }

    /**
     * @dataProvider inequalityProvider
     */
    public function testMatchesWithStrictReturnsFalseForNotEqualValues($expected, $actual)
    {
        $this->assertFalse((new IsEqual($expected, true))->matches($actual));
    }

    public function testDescribeMismatchWithDifferingTypesTellsUser()
    {
        $eq = new IsEqual('a string', true);

        $this->assertContains('not a string', $eq->describeMismatch(['an', 'array']));
    }

    public function testBooleanTypeWithDescribeMismatchStillTellsUserAboutTypeDifference()
    {
        $eq = new IsEqual(false);
        $this->assertContains('not a bool', $eq->describeMismatch(['an', 'array']));
    }

    public function testDescribeMismatchWithTypeStringsGeneratesADiff()
    {
        $eq = new IsEqual('one');

        $diff = $eq->describeMismatch('two');
        $this->assertContains('--- Expected', $diff);
        $this->assertContains('+++ Actual', $diff);
    }

    public function testDescribeMismatchWithMatchingTypesAndNoStringsDeclinesDescription()
    {
        $eq = new IsEqual(false);

        $this->assertEquals(\Counterpart\Describer::DECLINE_DESCRIPTION, $eq->describeMismatch(true));
    }
}
