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
use Counterpart\Exception\InvalidArgumentException;

/**
 * A matcher that checks agains the formats found in phpt tests.
 *
 * These formats are documented at http://qa.php.net/phpt_details.php but for
 * the sake of clarity, they'll be repeated here. The actual regex definitions
 * are take from the PHP core's `run-tests.php` file.
 *
 * Essentially this matcher "compiles" a format to regex that can actually be
 * used to check things.
 *
 * Format Strings:
 *
 *      - %e: A directory separator (DIRECTORY_SEPARATOR)
 *      - %s: One or more of anything (character, whitespace, etc) except the
 *        end of line character. [^\r\n]+
 *      - %S: Zero or more of anything (character, whatespace, etc) except
 *        the end of line character. [^\r\n]*
 *      - %a: One or more of anything (character, whitespace, etc) including
 *        the end of line character. .+
 *      - %A: Zero or more of anything, including the end of line character. .*
 *      - %w: Zero or more whitespace characters. \s*
 *      - %i: A signed integer value (+123, -123). [+-]?\d+
 *      - %d: An unsigned integer value. \d+
 *      - %x: One or more hexadecimal character. [0-9a-fA-F]+
 *      - %f: A floating point number. [+-]?\.?\d+\.?\d*(?:[Ee][+-]?\d+)?
 *      - %c: A single character. .
 *
 * There's also several less document and clear format strings:
 *
 *      - %unicode|string% or %string|unicode%: Matches 'string' (but is meant
 *        to match something else with PHP6?)
 *      - %binary_string_optional% and %unicode_string_optional%: Matches 'string'
 *        (but is meant to match something else with PHP6?)
 *      - %u|b% or %b|u%: replaced with nothing (but was meant to be something
 *        else for PHP6?)
 *
 * Regex can also be embedded directly if it's surrounded by `%r` characters:
 *
 *      %r[A-Z]+%r would be left alone, jsut the %r bits would be stripped out.
 *
 *
 * @since   1.2
 */
class PhptFormat implements Matcher
{
    private $format;
    private $regex = null;

    /**
     * Set the format.
     *
     * @since   1.2
     * @param   string $format
     * @throws  InvalidArgumentException if $format isn't a string
     * @return  void
     */
    public function __construct($format)
    {
        if (!is_string($format)) {
            throw new InvalidArgumentException(sprintf(
                '%s expected $format to be a string, %s given',
                get_class($this),
                gettype($format)
            ));
        }

        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function matches($actual)
    {
        if (!$this->isStringy($actual)) {
            return false;
        }

        return (bool)preg_match($this->getRegex(), (string)$actual);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return "is a string matching the phpt format {$this->format}";
    }

    private function isStringy($value)
    {
        return is_string($value) || (is_object($value) && method_exists($value, '__toString'));
    }

    private function getRegex()
    {
        if (null === $this->regex) {
            $this->regex = $this->compileRegex();
        }

        return $this->regex;
    }

    private function compileRegex()
    {
        $pattern = $this->quote($this->format);
        $pattern = str_replace([
            '%binary_string_optional%',
            '%unicode_string_optional%',
            '%string\|unicode%',
            '%unicode\|string%'
        ], 'string', $pattern);
        $pattern = str_replace(['%u\|b%', '%b\|u%'], '', $pattern);
        $pattern = str_replace('%e', '\\' . DIRECTORY_SEPARATOR, $pattern);
        $pattern = str_replace('%s', '[^\r\n]+', $pattern);
        $pattern = str_replace('%S', '[^\r\n]*', $pattern);
        $pattern = str_replace('%a', '.+', $pattern);
        $pattern = str_replace('%A', '.*', $pattern);
        $pattern = str_replace('%w', '\s*', $pattern);
        $pattern = str_replace('%i', '[+-]?\d+', $pattern);
        $pattern = str_replace('%d', '\d+', $pattern);
        $pattern = str_replace('%x', '[0-9a-fA-F]+', $pattern);
        $pattern = str_replace('%f', '[+-]?\.?\d+\.?\d*(?:[Ee][+-]?\d+)?', $pattern);
        $pattern = str_replace('%c', '.', $pattern);

        return '/^'.$pattern.'$/s';
    }

    /**
     * Taken, mostly, from PHP's `run-tests.php`. This replaces all sections
     * found by %r with raw regex and quotes everything else.
     *
     * @since   0.1
     * @param   string $format
     * @return  string
     */
    private function quote($format)
    {
        $temp = '';
        $cursor = 0;
        $length = strlen($format);
        while ($cursor < $length) {
            $start = $this->findRegex($format, $cursor);
            if (false !== $start) {
                $end = $this->findRegex($format, $start+2);
                if (false === $end) { // we didn't find an end, ignore
                    $start = $end = $length;
                }
            } else {
                $start = $end = $length;
            }

            $temp = $temp . preg_quote(substr($format, $cursor, $start-$cursor), '/');

            if ($end > $start) {
                $temp = $temp . '(' . substr($format, $start + 2, $end - $start-2) . ')';
            }
            $cursor = $end + 2;
        }

        return $temp;
    }

    private function findRegex($format, $offset)
    {
        return strpos($format, '%r', $offset);
    }
}
