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

class LogicalNotTest extends TestCase
{
    public function testLogicalNotNegatesWhateverItsMatcherSends()
    {
        $matcher = $this->getMock('Counterpart\\Matcher');
        $matcher->expects($this->once())
            ->method('matches')
            ->willReturn(true);
        $matcher2 = $this->getMock('Counterpart\\Matcher');
        $matcher2->expects($this->once())
            ->method('matches')
            ->willReturn(false);

        $this->assertFalse(Matchers::not($matcher)->matches("ignored"));
        $this->assertTrue(Matchers::not($matcher2)->matches("ignored"));
    }

    public function testConvenienceMethodsMatchAsExpected()
    {
        $this->assertTrue(Matchers::isNotNull()->matches(''));
        $this->assertFalse(Matchers::isNotNull()->matches(null));
    }
}
