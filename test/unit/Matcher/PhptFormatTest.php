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

use Counterpart\TestCase;

class PhptFormatTest extends TestCase
{
    /**
     * @expectedException Counterpart\Exception\CounterpartException
     */
    public function testConstructorWithNonStringThrowsException()
    {
        new PhptFormat(['an', 'array']);
    }

    public function testRawRegexEmbeddedInFormatIsNotIgnored()
    {
        $m = new PhptFormat('here %r[A-Z]+%r');
        $this->assertTrue($m->matches('here A'));
        $this->assertTrue($m->matches('here AZD'));
        $this->assertFalse($m->matches('here azd'));

        $m = new PhptFormat('here %r[A-Z]+%r we %r[1-9]+%r');
        $this->assertTrue($m->matches('here AZD we 234'));
        $this->assertTrue($m->matches('here A we 2'));
        $this->assertFalse($m->matches('here a we 2'));
    }

    public function replacementProvider()
    {
        return [
            'directory_sep'         => ['%e', DIRECTORY_SEPARATOR],
            'one_or_more_chars'     => ['%s', 'abcd'],
            'zero_or_more_chars'    => ['%S', ''],
            'one_or_more_any'       => ['%a', "here\n"],
            'zero_or_more_any'      => ['%A', ''],
            'zero_or_more_white'    => ['%w', " \t"],
            'signed_int_pos'        => ['%i', '+123'],
            'signed_int_neg'        => ['%i', '-123'],
            'signed_int_nosign'     => ['%i', '123'],
            'hexadecimal'           => ['%x', '09FA'],
            'floating_point'        => ['%f', '-1.0'],
            'floating_point_2'      => ['%f', '.10'],
            'unicode_string_opt'    => ['%unicode_string_optional%', 'string'],
            'binary_string_opt'     => ['%binary_string_optional%', 'string'],
            'u|b'                   => ['%u|b%', ''],
            'b|u'                   => ['%b|u%', ''],
            'unicode|string'        => ['%unicode|string%', 'string'],
            'string|unicode'        => ['%string|unicode%', 'string'],
        ];
    }

    /**
     * @dataProvider replacementProvider
     */
    public function testReplacementPatternsMatchAsExpected($format, $shouldMatch)
    {
        $m = new PhptFormat($format);

        $this->assertTrue($m->matches($shouldMatch));
    }
}
