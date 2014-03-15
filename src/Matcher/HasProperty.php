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
 * Checks to see if an object has a given property
 *
 * @since   1.0
 */
class HasProperty implements Matcher
{
    /**
     * the property to check for.
     *
     * @since   1.0
     * @access  private
     * @var     string
     */
    private $propertyName;

    /**
     * Constructor. Set the key to look for.
     *
     * @since   1.0
     * @access  public
     * @param   string $propertyName
     * @throws  InvalidArgumentException if the property name isn't a string
     * @return  void
     */
    public function __construct($propertyName)
    {
        if (!is_string($propertyName)) {
            throw new InvalidArgumentException(sprintf(
                '$propertyName must be a string, got "%s"',
                gettype($propertyName)
            ));
        }
        $this->propertyName = $propertyName;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (!is_object($actual)) {
            return false;
        }

        // we use reflection here because null public properties would cause
        // isset to be false and private props would make PHP complain.
        $ref = new \ReflectionObject($actual);

        // XXX should this be allowed to check non-public properties?
        // seems like it would break encapsulation a bit.
        return $ref->hasProperty($this->propertyName);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is an object with the property {$this->propertyName}";
    }
}
