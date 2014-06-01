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

namespace Counterpart;

/**
 * Matchers that implement `Describer` can give more information about the
 * differences between the expected and actual value. This might mean diffs or
 * some other form of extract information.
 *
 * @since   1.3
 */
interface Describer
{
    // describeMismatch may decline to build a description by returning this
    const DECLINE_DESCRIPTION = false;

    /**
     * Describe how $actual doesn't match the expected.
     *
     * @since   1.2
     * @param   string $actual
     * @return  string|DECLINE_DESCRIPTION
     */
    public function describeMismatch($actual);
}
