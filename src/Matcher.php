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

/**
 * Matchers compare two values and see if a condition is met.
 *
 * @since   1.0
 */
interface Matcher
{
    /**
     * Check to see if a matcher matches a given value.
     *
     * @since   1.0
     * @access  public
     * @param   mixed $actual
     * @return  boolean True if $actual matches a given value.
     */
    public function match($actual);

    /**
     * Returns a brief description of what was expected.
     *
     * Examples:
     *  - An array containing the key "a_key"
     *  - False
     *  - Null
     *  - An array containing the value "a value"
     *  - An array or Countable implementation with 20 items
     *
     * @since   1.0
     * @access  public
     * @return  string
     */
    public function __toString();
}
