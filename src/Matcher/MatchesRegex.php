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
use Counterpart\Negative;
use Counterpart\Exception\InvalidArgumentException;

/**
 * Match a scalar (or object with a __toString method) against a regular
 * expression.
 *
 * @since   1.0
 */
class MatchesRegex implements Matcher, Negative
{
    use StringyTrait;

    /**
     * The regex pattern to match agains.
     *
     * @sinct   1.0
     * @var     string
     */
    private $regexPattern;

    /**
     * Constructor. Validates the regex pattern, then sets it.
     *
     * @since   1.0
     * @param   string $pattern
     * @throws  InvalidArgumentException
     * @see     http://stackoverflow.com/a/12941133/1031898 for info about validating the regex
     * @return  void
     */
    public function __construct($pattern)
    {
        if (false === @preg_match($pattern, null)) {
            $err = error_get_last();
            throw new InvalidArgumentException(sprintf(
                'Invalid regular expression "%s" -- %s',
                $pattern,
                isset($err['message']) ? $err['message'] : 'unknown error'
            ));
        }

        $this->regexPattern = $pattern;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (!$this->isStringy($actual)) {
            return false;
        }

        return (bool)preg_match($this->regexPattern, (string)$actual);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "matches the regular expression {$this->regexPattern}";
    }

    /**
     * {@inheritdoc}
     */
    public function negativeMessage()
    {
        return "does not match the regular expression {$this->regexPattern}";
    }
}
