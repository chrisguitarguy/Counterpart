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

/**
 * Check to see if a string is valid JSON
 *
 * @since   1.0
 */
class IsJson implements Matcher
{
    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (!is_string($actual)) {
            return false;
        }

        json_decode($actual);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'is valid json';
    }
}
