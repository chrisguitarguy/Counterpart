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

class IsInstanceOfTest extends TestCase
{
    public function testMatchesReturnsTrueWithClassAndSubclass()
    {
        $matcher = new IsInstanceOf('Exception');
        $this->assertTrue($matcher->matches(new \Exception()));
        $this->assertTrue($matcher->matches(new \RuntimeException()));
    }

    public function testMatchesReturnsTrueWithInterfaceImplementation()
    {
        $matcher = new IsInstanceOf('ArrayAccess');
        $this->assertTrue($matcher->matches(new \ArrayObject()));
        $this->assertTrue($matcher->matches(new \SplObjectStorage()));
    }

    public function testMatchesReturnsFalseWithMismatchedInstancesAndScalars()
    {
        $matcher = new IsInstanceOf('ArrayAccess');

        $this->assertFalse($matcher->matches(new \Exception()));
        $this->assertFalse($matcher->matches(null));
        $this->assertFalse($matcher->matches('a string'));
        $this->assertFalse($matcher->matches(false));
    }

    /**
     * @expectedException Counterpart\Exception\CounterpartException
     */
    public function testNonStringCausesConstructorToComplain()
    {
        new IsInstanceOf(null);
    }
}
