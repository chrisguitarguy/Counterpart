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

class MatchesRegexTest extends TestCase
{
    /**
     * @expectedException Counterpart\Exception\CounterpartException
     */
    public function testInvalidPatternThrowsExceptionDuringMatcherInitialization()
    {
        new MatchesRegex('#(not a valid pattern');
    }

    public function nonStringProvider()
    {
        return [
            [null],
            [false],
            [true],
            [new \stdClass],
        ];
    }

    /**
     * @dataProvider nonStringProvider
     */
    public function testMatchesReturnsFalseWithNonStringValues($actual)
    {
        $this->assertFalse((new MatchesRegex('/^$/'))->matches($actual));
    }

    public function testMatchesReturnsTrueWhenAStringMatchesTheGivenRegex()
    {
        $this->assertTrue((new MatchesRegex('/here/ui'))->matches('here is the value'));
    }

    public function testMatchesReturnsTrueWithAnObjectWithToStringMethodMatchesTheGivenRegex()
    {
        $this->assertTrue((new MatchesRegex('/object/ui'))->matches(new _MatchesRegexStringy('this is an object')));
    }
}

class _MatchesRegexStringy
{
    private $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    public function __toString()
    {
        return $this->str;
    }
}
