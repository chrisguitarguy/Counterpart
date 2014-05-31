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
use Counterpart\Negative;

/**
 * Run a value through a callback.
 *
 * @since   1.0
 */
class Callback implements Matcher, Negative
{
    /**
     * The callback that the value is to be run through
     *
     * @since   1.0
     * @var     string
     */
    private $callback;

    /**
     * Constructor. Set the callback
     *
     * @since   1.0
     * @param   string $callback
     * @return  void
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return (bool)call_user_func($this->callback, $actual);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'matches user defined callback';
    }

    /**
     * {@inheritdoc}
     */
    public function negativeMessage()
    {
        return 'does not match a user defined callback';
    }
}
