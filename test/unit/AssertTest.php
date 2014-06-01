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

/**
 * Tests `Assert::assertThat` to verify its behavior
 */
class AssertTest extends TestCase
{
    public function testAssertThatWithMatchDoesNothing()
    {
        $matcher = $this->matcherReturning(true);

        Assert::assertThat($matcher, 'ignored');
    }

    public function testAssertThatWithMisMatchThrows()
    {
        $this->expectAssertionFailure();
        $matcher = $this->matcherReturning(false);

        Assert::assertThat($matcher, 'ignored');
    }

    public function testAssertThatWithDescriberAddsAdditionaMessage()
    {
        $desc = 'additional stuff';
        $matcher = new _StubAssertMatcher(false, $desc);
        $this->expectAssertionFailure($desc);

        Assert::assertThat($matcher, 'ignored');
    }

    private function matcherReturning($bool, $msg='')
    {
        $m = $this->getMock('Counterpart\\Matcher');
        $m->expects($this->atLeastOnce())
            ->method('matches')
            ->willReturn($bool);
        $m->expects($this->any())
            ->method('__toString')
            ->willReturn($msg);

        return $m;
    }

    private function expectAssertionFailure($msg='')
    {
        $this->setExpectedException(
            'Counterpart\\Exception\\AssertionFailed',
            $msg
        );
    }
}

class _StubAssertMatcher implements Matcher, Describer
{
    private $matchVal;
    private $descVal;

    public function __construct($matchVal, $descVal)
    {
        $this->matchVal = $matchVal;
        $this->descVal = $descVal;
    }

    public function matches($actual)
    {
        return $this->matchVal;
    }

    public function __toString()
    {
        return '';
    }

    public function describeMismatch($actual)
    {
        return $this->descVal;
    }
}
