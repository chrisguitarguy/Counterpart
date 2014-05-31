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
 * Checks all the implementations of `Negative` to make sure that, when wrapped
 * in a `LogicalNot` they use `negativeMessage` to generate the assertion error.
 */
class NegativeThrowsTest extends IntegrationTestCase
{
    public static function negatives()
    {
        return [
            'Callback'  => [Matchers::callback(function () { return true; }), 'ignored'],
            'StringContains' => [Matchers::stringContains('here'), 'here'],
            'MatchesRegex' => [Matchers::matchesRegex('/.*/'), 'ignored'],
            'HasProperty' => [Matchers::hasProperty('prop'), (object)['prop' => true]],
            'HasKey' => [Matchers::hasKey('k'), ['k' => true]],
            'Contains' => [Matchers::contains('one'), ['one']],
            'Anything' => [Matchers::anything(), ''],
        ];
    }

    /**
     * @dataProvider negatives
     */
    public function testLogicalNotCausesAnAssertionMessageWithNegativeDescription(Matcher $matcher, $value)
    {
        $this->setExpectedException(
            'Counterpart\\Exception\\AssertionFailed',
            $matcher->negativeMessage()
        );

        $matcher = Matchers::logicalNot($matcher);
        Assert::assertThat($matcher, $value);
    }
}
