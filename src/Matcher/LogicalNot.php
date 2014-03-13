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
 * Test a matcher and negates it.
 *
 * @since   1.0
 */
class LogicalNot implements Matcher
{
    /**
     * The matcher to negate.
     *
     * @since   1.0
     * @access  private
     * @param   Matcher
     */
    private $matcher;

    /**
     * Constructor. Set up the matcher.
     *
     * @since   1.0
     * @access  public
     * @param   Matcher
     * @return  void
     */
    public function __construct(Matcher $matcher)
    {
        $this->matcher = $matcher;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($value)
    {
        return !$this->matcher->matches($value);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "not {$this->matcher}";
    }
}
