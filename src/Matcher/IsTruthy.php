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
 * Check a value to see if it's "truthy".
 *
 * In other words: run a value through `filter_var` with FILTER_VALIDATE_BOOLEAN
 *
 * Truthy values are "on", "true", 1, "yes", and an actual `true`.
 *
 * @since   1.0
 */
class IsTruthy implements Matcher
{
    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        return filter_var($actual, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'is truthy';
    }
}
