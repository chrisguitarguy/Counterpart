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

class UtilitiesTest extends IntegrationTestCase
{
    public function testPrettifyReturnsAStringWithVariousVariableTypes()
    {
        // we know that certain types will return certain values...
        $this->assertEquals('null', prettify(null));
        $this->assertEquals('true', prettify(true));
        $this->assertEquals('false', prettify(false));
        $this->assertEquals("'yep'", prettify('yep'));

        // others, we only care they they return a string
        $this->assertInternalType('string', prettify(['one' => 'two']));
        $this->assertInternalType('string', prettify(['one', 'two']));

        $obj = new \stdClass;
        $obj->prop = new \stdClass;
        $obj->prop2 = "two";
        $obj->prop->three = "three";
        $this->assertInternalType('string', prettify($obj));
    }
}
