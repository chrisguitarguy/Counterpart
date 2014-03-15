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

class HasKeyTest extends TestCase
{
    public function testHasKeyWithNonArrayAlwaysReturnsFalse()
    {
        $matcher = new HasKey('one');

        $this->assertFalse($matcher->matches('not an array'));
        $this->assertFalse($matcher->matches(null));
        $this->assertFalse($matcher->matches(false));
    }

    public function testHasKeyWithArrayMatchesAsExpected()
    {
        $matcher = new HasKey('one');

        $this->assertTrue($matcher->matches(['one' => true]));
        $this->assertTrue($matcher->matches(['one' => null]));
        $this->assertFalse($matcher->matches(['two' => null]));
        $this->assertFalse($matcher->matches([]));
    }

    public function testHasKeyArrayAccessImplementation()
    {
        $aa = new \ArrayObject(['one' => true]);

        $this->assertTrue((new HasKey('one'))->matches($aa));
        $this->assertFalse((new HasKey('two'))->matches($aa));
    }
}
