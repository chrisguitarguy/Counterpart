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
use Counterpart\Exception\InvalidArgumentException;

/**
 * Check to see if a value matches one more more matchers.
 *
 * @since   1.0
 */
class LogicalAnd implements Matcher
{
    /**
     * The matchers to check against.
     *
     * @since   1.0
     * @var     Matcher[]
     */
    private $matchers = array();

    /**
     * Constructor. Set up the matchers -- check to make sure each one is a matcher.
     *
     * @since   1.0
     * @param   array $matchers
     * @throws  InvalidArgumentException if one of the $matchers is not an instance of Matcher
     * @return  void
     */
    public function __construct(array $matchers)
    {
        foreach ($matchers as $matcher) {
            if (!$matcher instanceof Matcher) {
                throw new InvalidArgumentException(sprintf(
                    '%s does not implement Matcher',
                    is_object($matcher) ? get_class($matcher) : gettype($matcher)
                ));
            }
        }

        $this->matchers = $matchers;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        foreach ($this->matchers as $matcher) {
            if (!$matcher->matches($actual)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return implode(' AND ', array_map(function ($matcher) {
            return (string)$matcher;
        }, $this->matchers));
    }
}
