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
            ['one', 'one'],
            [false, false],
            [true, true],
            [new \stdClass, new \stdClass]
        ];
    }

    /**
     * @dataProvider equalityProvider
     */
    public function testMatchesReturnsTrueForEqualValues($expected, $actual)
    {
        $this->assertTrue((new IsEqual($expected))->matches($actual));
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
}