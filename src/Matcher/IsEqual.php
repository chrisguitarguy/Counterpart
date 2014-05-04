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

use Counterpart\Matcher;

/**
 * Check a value agains another with non-strict equality (the == operator)
 *
 * @since   1.0
 */
class IsEqual implements Matcher
{
    /**
     * The value to check against.
     *
     * @since   1.0
     * @var     string
     */
    private $expected;

    /**
     * Whether or not to use strict equality
     *
     * @since   1.0
     * @var     boolean
     */
    private $strict;

    /**
     * Constructor. Set expected value
     *
     * @since   1.0
     * @param   string $expected
     * @param   boolean $strict
     * @return  void
     */
    public function __construct($expected, $strict=false)
    {
        $this->expected = $expected;
        $this->strict = (bool)$strict;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if ($this->strict) {
            return $this->expected === $actual;
        } else {
            return $this->expected == $actual;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is equal to " . \Counterpart\prettify($this->expected);
    }
}
