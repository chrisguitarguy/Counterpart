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
 * Check the value to see if it's greater than another value.
 *
 * @since   1.0
 */
class GreaterThan implements Matcher
{
    /**
     * The value to check against.
     *
     * @since   1.0
     * @access  private
     * @var     string
     */
    private $expected;

    /**
     * Constructor. Set expected value
     *
     * @since   1.0
     * @access  public
     * @param   string $expected
     * @return  void
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return $actual > $this->expected;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is greater than " . \Counterpart\prettify($this->expected);
    }
}
