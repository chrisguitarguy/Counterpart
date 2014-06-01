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

/**
 * Provides some utilities for dealing with internal types.
 *
 * @since   1.3
 */
trait TypeTrait
{
    /**
     * Get the appropriate article prefix for a type. (a or an)
     *
     * @since   1.3
     * @param   $typeName
     * @return  string|null Null if the type requires no prefix (ala numeric)
     */
    public function typeArticle($type)
    {
        if ('numeric' === $type) {
            return null;
        }

        return in_array($type[0], ['a', 'i', 'o', 'u', 'e']) ? 'an' : 'a';
    }
}
