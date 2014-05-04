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

class ContainsTest extends TestCase
{
    public function invalidTypeProvider()
    {
        return [
            [null],
            [false],
            ['a string'],
            [123],
            [12.0]
        ];
    }

    /**
     * @dataProvider invalidTypeProvider
     */
    public function testMatchesWithoutArrayOrTraversableReturnsFalse($tocheck)
    {
        $this->assertFalse((new Contains('test value'))->matches($tocheck));
    }

    public function testMatchesWithArrayContainingValueReturnsTrue()
    {
        $this->assertTrue((new Contains(123))->matches([234, 456, 123]));
    }

    public function testMatchesWithArrayContainingValueAndNonStrictMatchingReturnsTrue()
    {
        $this->assertTrue((new Contains(123, false))->matches(['234', '456', '123']));
    }
}
