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
use Counterpart\Exception\InvalidArgumentException;

/**
 * Check to see if a string contains a value
 *
 * @since   1.0
 */
class StringContains implements Matcher
{
    /**
     * The string to search for.
     *
     * @since   1.0
     * @var     string
     */
    private $needle;

    /**
     * Whether or not to do case insensitive matching.
     *
     * @since   1.0
     * @var     bool
     */
    private $caseInsensitive;

    /**
     * Constructor. Set the string to search for.
     *
     * @since   1.0
     * @param   string $needle
     * @param   boolean $caseInsensitive
     * @throws  CounterpartException if $needle isn't a string
     * @return  void
     */
    public function __construct($needle, $caseInsensitive=false)
    {
        if (!is_string($needle)) {
            throw new InvalidArgumentException(sprintf(
                '%s expected "$needle" to be a string, %s given',
                get_class($this),
                gettype($needle)
            ));
        }
        $this->needle = $needle;
        $this->caseInsensitive = (bool)$caseInsensitive;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (!is_string($actual)) {
            return false;
        }

        if ($this->caseInsensitive) {
            return stripos($actual, $this->needle) !== false;
        } else {
            return strpos($actual, $this->needle) !== false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is a string containing {$this->needle}";
    }
}
