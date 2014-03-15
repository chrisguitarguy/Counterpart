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
 * Checks to see if an array (or ArrayAccess implementation) has a given key.
 *
 * @since   1.0
 */
class HasKey implements Matcher
{
    /**
     * the key to check for.
     *
     * @since   1.0
     * @access  private
     * @var     mixed Probably a scalar
     */
    private $key;

    /**
     * Constructor. Set the key to look for.
     *
     * @since   1.0
     * @access  public
     * @param   mixed $key
     * @return  void
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (is_array($actual)) {
            return array_key_exists($this->key, $actual);
        }

        if ($actual instanceof \ArrayAccess) {
            return isset($actual[$this->key]);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is an array or ArrayAccess implementation with the key " . \Counterpart\prettify($this->key);
    }
}
