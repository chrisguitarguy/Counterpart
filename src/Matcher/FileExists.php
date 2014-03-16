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
 * Check to see if a file path exists.
 *
 * @since   1.0
 */
class FileExists implements Matcher
{
    /**
     * {@inheritdoc}
     * @param   string $actual A path to a file
     */
    public function matches($actual)
    {
        // only scalar values are valid file paths (only scalar values don't
        // cause `file_exists` to complain).
        if (!is_scalar($actual)) {
            return false;
        }

        return file_exists($actual);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'is an existing file';
    }
}
