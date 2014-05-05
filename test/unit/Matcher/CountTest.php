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

class _CountIteratorAgStub implements \IteratorAggregate
{
    private $it;

    public function __construct(\Iterator $it)
    {
        $this->it = $it;
    }

    public function getIterator()
    {
        return $this->it;
    }
}

class _CountIteratorStub implements \Iterator
{
    private $store;

    public function __construct(array $store)
    {
        $this->store = $store;
    }

    public function current()
    {
        return current($this->store);
    }

    public function key()
    {
        return key($this->store);
    }

    public function next()
    {
        next($this->store);
    }

    public function rewind()
    {
        reset($this->store);
    }

    public function valid()
    {
        return null !== $this->key();
    }
}

class CountTest extends TestCase
{
    public function testNonArrayTraversableOrCountableReturnsFalse()
    {
        $this->assertFalse((new Count(1))->matches('not an array'));
    }

    public function countProvider()
    {
        return [
            [['one']],
            [new \ArrayIterator(['one'])],
            [new _CountIteratorAgStub(new \ArrayIterator(['one']))],
            [new _CountIteratorStub(['one'])],
        ];
    }

    /**
     * @dataProvider countProvider
     */
    public function testMatchesReturnsTrueWhenCountEqualsExpected($countable)
    {
        $this->assertTrue((new Count(1))->matches($countable));
    }

    /**
     * @dataProvider countProvider
     */
    public function testMatchesReturnsFalseWhenCountDoesNotEqualExpected($countable)
    {
        $this->assertFalse((new Count(2))->matches($countable));
    }
}
