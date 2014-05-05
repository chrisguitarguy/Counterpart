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

use Counterpart\Exception\InvalidArgumentException;
use Counterpart\Matcher;

/**
 * Check and array, instance of Countable, or an iterator for a count of values.
 *
 * If an iterator is passed in, it may be consumed by the end of the match.
 *
 * @since   1.0
 */
class Count implements Matcher
{
    /**
     * The value to check against.
     *
     * @since   1.0
     * @access  private
     * @var     int
     */
    private $expectedCount;

    /**
     * Constructor. Set expected count
     *
     * @since   1.0
     * @access  public
     * @param   string $expectedCount
     * @return  void
     */
    public function __construct($expectedCount)
    {
        $this->expectedCount = $expectedCount;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return $this->expectedCount === $this->getCount($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "has a count of " . \Counterpart\prettify($this->expectedCount);
    }

    private function getCount($actual)
    {
        if (is_array($actual) || $actual instanceof \Countable) {
            return count($actual);
        }

        if ($actual instanceof \Traversable) {
            return iterator_count($actual);
        }

        return false;
    }
}
