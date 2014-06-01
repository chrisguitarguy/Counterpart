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

namespace Counterpart;

use SebastianBergmann\Exporter\Exporter;
use SebastianBergmann\Diff\Differ;

/**
 * Export a variable to a pretty string representation.
 *
 * This uses a library to do the heavy lifting.
 *
 * @since   1.0
 * @param   mixed $var
 * @return  string
 */
function prettify($var)
{
    static $exporter = null; // boooo global variables!
    if (null === $exporter) {
        $exporter = new Exporter();
    }

    return $exporter->export($var);
}

/**
 * Diff two strings and return their result.
 *
 * @since   1.3
 * @param   string $expected
 * @param   string $actual
 * @return  string The generated diff
 */
function diff($expected, $actual)
{
    static $differ = null;
    if (null === $differ) {
        $differ = new Differ('--- Expected'.PHP_EOL.'+++ Actual'.PHP_EOL);
    }

    return trim($differ->diff($expected, $actual));
}
