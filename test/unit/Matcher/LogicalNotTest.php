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

class LogicalNotTest extends LogicalCombinationTestCase
{
    public function testLogicalNotNegatesWhateverItsMatcherSends()
    {
        $matcher = $this->matcherReturning(true);
        $matcher2 = $this->matcherReturning(false);

        $this->assertFalse((new LogicalNot($matcher))->matches("ignored"));
        $this->assertTrue((new LogicalNot($matcher2))->matches("ignored"));
    }

    public function testToStringReplacesIsWithIsNot()
    {
        $matcher = $this->getMock('Counterpart\\Matcher');
        $matcher->expects($this->atLeastOnce())
            ->method('__toString')
            ->willReturn('is something');

        $not = new LogicalNot($matcher);
        $this->assertEquals('is not something', (string)$not);
    }

    public function testToStringCallsNegativeMessageWhenANegativeInterfaceIsFound()
    {
        $msg = 'does not match';
        $matcher = new _NegMatcherStub($msg);

        $not = new LogicalNot($matcher);
        $this->assertEquals($msg, (string)$not);
    }
}

// can't seem to get PHPUnit to stub multple interfaces
class _NegMatcherStub implements \Counterpart\Matcher, \Counterpart\Negative
{
    private $msg;

    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function negativeMessage()
    {
        return $this->msg;
    }

    public function matches($actual)
    {
        return true;
    }

    public function __toString()
    {
        return 'always matches';
    }
}

