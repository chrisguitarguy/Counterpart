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
 * Marks a matcher as being aware that it may be used within a `LogicalNot`. When
 * `LogicalNot::__toString` is called, the `negativeMessage` will be called to
 * describe the failure.
 *
 * @since    1.3
 */
interface Negative
{
    /**
     * Describe the opposite of the match. If the matcher's `__toString` method
     * returned something 'is equal to "SomeValue"' then `negativeMessage` might
     * return something like 'is not equal to "SomeValue"'.
     *
     * @since   1.3
     * @return  string
     */
    public function negativeMessage();
}
