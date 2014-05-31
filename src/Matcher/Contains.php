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

use Counterpart\Matcher;
use Counterpart\Negative;
use Counterpart\Exception\InvalidArgumentException;

/**
 * Check to see if an array or traversable-implementating-object contains
 * a value.
 *
 * @since   1.0
 */
class Contains implements Matcher, Negative
{
    /**
     * The value to search for.
     *
     * @since   1.0
     * @var     mixed
     */
    private $expected;

    /**
     * Whether or not to do strict checking (== vs ===, basically).
     *
     * @since   1.0
     * @var     boolean
     */
    private $strict;

    /**
     * Constructor. Set up the expected value and whether or not strict checking
     * is enabled.
     *
     * @since   1.0
     * @param   mixed $expected
     * @param   boolean $strict
     * @return  void
     */
    public function __construct($expected, $strict=true)
    {
        $this->expected = $expected;
        $this->strict = (bool)$strict;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (!is_array($actual) && !$actual instanceof \Traversable) {
            return false; // can't do anything
        }

        if ($actual instanceof \Traversable) {
            $actual = iterator_to_array($actual);
        }

        return in_array($this->expected, $actual, $this->strict);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'is an array or Traversable containing '.$this->prettyExpected();
    }

    /**
     * {@inheritdoc}
     */
    public function negativeMessage()
    {
        return 'is an array or Traversable that does not contain '.$this->prettyExpected();
    }

    private function prettyExpected()
    {
        return \Counterpart\prettify($this->expected);
    }
}
