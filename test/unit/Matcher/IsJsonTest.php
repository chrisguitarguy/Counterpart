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

namespace Counterpart\Matcher;

use Counterpart\TestCase;

class IsJsonTest extends TestCase
{
    public function nonStringProvider()
    {
        return [
            [null],
            [false],
            [true],
            [123],
            [12.0],
            [new \stdClass],
        ];
    }

    /**
     * @dataProvider nonStringProvider
     */
    public function testMatchesReturnsFalseWithNonStringValues($actual)
    {
        $this->assertFalse((new IsJson())->matches($actual));
    }

    public function testMatchesReturnsFalseWithInvalidJson()
    {
        $this->assertFalse((new IsJson())->matches('{"not": "valid json"'));
    }

    public function testMatchesReturnsTrueWithValidJson()
    {
        $this->assertTrue((new IsJson())->matches('{"is": "valid json"}'));
    }
}
