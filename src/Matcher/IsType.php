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
 * Check to see if a value is an internal type.
 *
 * @since   1.0
 */
class IsType implements Matcher
{
    /**
     * the type to check against.
     *
     * @since   1.0
     * @param   string
     */
    private $type;

    /**
     * Constructor. Set the type.
     *
     * @since   1.0
     * @access  public
     * @param   string $type
     * @throws  InvalidArgumentException if the funtion "is_{$type}" doesn't exist
     * @return  void
     */
    public function __construct($type)
    {
        if (!function_exists("is_{$type}")) {
            throw new InvalidArgumentException("{$type} is not a valid type");
        }
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return call_user_func("is_{$this->type}", $actual);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $prefix = in_array($this->type[0], ['a', 'i', 'o', 'u', 'e']) ? 'an' : 'a';
        return "{$prefix} {$this->type}";
    }
}
