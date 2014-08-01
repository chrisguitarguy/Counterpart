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

class LogicalOrTest extends LogicalCombinationTestCase
{
    /**
     * @expectedException Counterpart\Exception\CounterpartException
     */
    public function testCreateWithInvalidMatcherThrowsException()
    {
        new LogicalOr([null]);
    }

    public function testMatchesReturnsTrueWhenOneMatcherReturnsTrue()
    {
        $matcherOne = $this->matcherReturning(false);
        $matcherTwo = $this->matcherReturning(true);

        $this->assertTrue((new LogicalOr([$matcherOne, $matcherTwo]))->matches('ignored'));
    }

    public function testMatchesReturnsFalseWhenAllMatchersReturnFalse()
    {
        $matcherOne = $this->matcherReturning(false);
        $matcherTwo = $this->matcherReturning(false);

        $this->assertFalse((new LogicalAnd([$matcherOne, $matcherTwo]))->matches('ignored'));
    }

    public function testToStringCombinesAllSubmatcherStrings()
    {
        $one = $this->matcherWithDescription('one desc');
        $two = $this->matcherWithDescription('two desc');
        $matcher = new LogicalOr([$one, $two]);

        $description = (string)$matcher;

        $this->assertContains('one desc', $description);
        $this->assertContains('two desc', $description);
    }
}
