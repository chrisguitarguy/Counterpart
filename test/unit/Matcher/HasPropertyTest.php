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

class HasPropertyTest extends TestCase
{
    public $publicProp = true;
    protected $protectedProp = true;
    private $privateProp = true;

    public function testMatchesReturnsFalseWithNonObjects()
    {
        $matcher = new HasProperty('aProp');

        $this->assertFalse($matcher->matches(null));
        $this->assertFalse($matcher->matches('a string'));
        $this->assertFalse($matcher->matches(true));
        $this->assertFalse($matcher->matches(['aProp' => true]));
    }

    public function testMatchesReturnsTrueWithPropertiesOfVariousAccessScopes()
    {
        $this->assertTrue((new HasProperty('publicProp'))->matches($this));
        $this->assertTrue((new HasProperty('protectedProp'))->matches($this));
        $this->assertTrue((new HasProperty('privateProp'))->matches($this));
    }

    public function testMatchesReturnsTrueWithNullPropertyValues()
    {
        $o = new \stdClass;
        $o->prop = null;

        $this->assertTrue((new HasProperty('prop'))->matches($o));
    }

    public function testMatchesReturnsFalseWithNonPublicPropertiesWhenAllowPrivateIsFalse()
    {
        $this->assertTrue((new HasProperty('publicProp', false))->matches($this));
        $this->assertFalse((new HasProperty('protectedProp', false))->matches($this));
        $this->assertFalse((new HasProperty('privateProp', false))->matches($this));
    }

    /**
     * @expectedException Counterpart\Exception\CounterpartException
     */
    public function testNonStringPropertyNameCausesConstructorToComplain()
    {
        new HasProperty(['this', "doesn't", 'work']);
    }
}
