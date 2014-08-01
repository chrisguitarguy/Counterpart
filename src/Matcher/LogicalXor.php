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
 * Check to see if exactly one matcher matches a value
 *
 * @since   1.0
 */
class LogicalXor extends AbstractLogicalMatcher
{
    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        $results = array_map(function (Matcher $matcher) use ($actual) {
            return $matcher->matches($actual);
        }, $this->getMatchers());

        return 1 === count(array_filter($results));
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return implode(' XOR ', array_map(function (Matcher $matcher) {
            return (string)$matcher;
        }, $this->getMatchers()));
    }
}
