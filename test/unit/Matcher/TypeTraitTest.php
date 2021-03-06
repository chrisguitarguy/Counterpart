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

use Counterpart\TestCase;

class TypeTraitTest extends TestCase
{
    private $typeTrait;

    public function testTypeArticleReturnsNullWithNumeric()
    {
        $this->assertNull($this->typeTrait->typeArticle('numeric'));
    }

    public function testTypeArticleReturnsAnForTypesThatStartWithVowels()
    {
        $this->assertEquals('an', $this->typeTrait->typeArticle('array'));
    }

    public function testTypeArticleReturnsAForTypesThatStartWithConsonants()
    {
        $this->assertEquals('a', $this->typeTrait->typeArticle('string'));
    }

    protected function setUp()
    {
        $this->typeTrait = $this->getObjectForTrait('Counterpart\\Matcher\\TypeTrait');
    }
}
