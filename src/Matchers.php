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

/**
 * A mess of static, factory methods for creating matchers.
 *
 * @since   1.0
 */
final class Matchers
{
    /**
     * Create a new IsType matcher.
     *
     * @since   1.0
     * @access  public
     * @param   string $type
     * @return  Matcher
     */
    public static function isType($type)
    {
        return new Matcher\IsType($type);
    }

    /**
     * Same as Mactchers::isType('null')
     *
     * @since   1.0
     * @access  public
     * @return  Matcher
     */
    public static function isNull()
    {
        return self::isType('null');
    }

    /**
     * Same as Matcher::not(Matcher::isNull())
     *
     * @since   1.0
     * @access  public
     * @return  Matcher
     */
    public static function isNotNull()
    {
        return self::not(self::isNull());
    }

    /**
     * Create a LogicalNot for a given matcher
     *
     * @since   1.0
     * @access  public
     * @return  Matcher
     */
    public static function not(Matcher $matcher)
    {
        return new Matcher\LogicalNot($matcher);
    }

    // @codeCoverageIgnoreStart
    private function __construct() { }
    // @codeCoverageIgnoreEnd
}
