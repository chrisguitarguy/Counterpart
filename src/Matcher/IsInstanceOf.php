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
 * Checks to see if an object is an instance of a given class
 *
 * @since   1.0
 */
class IsInstanceOf implements Matcher
{
    /**
     * the class name to check for
     *
     * @since   1.0
     * @access  private
     * @var     string
     */
    private $className;

    /**
     * Constructor. Set the key to look for.
     *
     * @since   1.0
     * @access  public
     * @param   string $className
     * @throws  InvalidArgumentException if $className is not a string
     * @return  void
     */
    public function __construct($className)
    {
        if (!is_string($className)) {
            throw new InvalidArgumentException(sprintf(
                '$className must be a string, got "%s"',
                gettype($className)
            ));
        }
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return $actual instanceof $this->className;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is an instance of {$this->className}";
    }
}
