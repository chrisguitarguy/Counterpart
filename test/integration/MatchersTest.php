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
 * There are super high-level, happy-path-only integration tests to make sure
 * all the static factory methods in Matchers work.
 *
 * @since   1.0
 */
class MatchersTest extends IntegrationTestCase
{
    public function testAnythingMatchesAnything()
    {
        $anything = Matchers::anything();
        $this->assertMatcher($anything);
        $this->assertTrue($anything->matches(true));
    }

    public function testCallbackMatchesWhenCallbackReturnsTrue()
    {
        $cb = Matchers::callback(function () { return true; });
        $this->assertMatcher($cb);
        $this->assertTrue($cb->matches(1));
    }

    public function testContainsMatchesWhenGivenAnArrayContainingValue()
    {
        $ct = Matchers::contains(1);
        $this->assertMatcher($ct);
        $this->assertTrue($ct->matches([1, 2]));
    }

    public function testDoesNotContainMatchesWhenGivenAnArrayNotContaingValue()
    {
        $dct = Matchers::doesNotContain(1);
        $this->assertMatcher($dct);
        $this->assertTrue($dct->matches([2, 3]));
    }

    public function testCountMatchesWhenArrayContainsExpectedCount()
    {
        $count = Matchers::count(0);
        $this->assertMatcher($count);
        $this->assertTrue($count->matches([]));
    }

    public function testFileExistsMatchesWhenGivenAnExistingFile()
    {
        $fe = Matchers::fileExists();
        $this->assertMatcher($fe);
        $this->assertTrue($fe->matches(__FILE__));
    }

    public function testFileDoesNotExistMatchesWhenGivenANonExistentFile()
    {
        $fde = Matchers::fileDoesNotExist();
        $this->assertMatcher($fde);
        $this->assertTrue($fde->matches(__DIR__ . '/does/not/exists/at/all.txt'));
    }

    public function testGreaterThanMatchesWhenGivenANumberGreaterThanExpected()
    {
        $ge = Matchers::greaterThan(10);
        $this->assertMatcher($ge);
        $this->assertTrue($ge->matches(100));
        $this->assertFalse($ge->matches(0));
    }

    public function testGreaterThanOrEqualMatchesWhenGivenANumberGreaterThanExpected()
    {
        $gte = Matchers::greaterThanOrEqual(10);
        $this->assertMatcher($gte);
        $this->assertTrue($gte->matches(100));
        $this->assertTrue($gte->matches(10));
        $this->assertFalse($gte->matches(0));
    }

    public function testHasKeyMatchesWhenGivenAnArrayWithTheExpectedKey()
    {
        $hk = Matchers::hasKey('k');
        $this->assertMatcher($hk);
        $this->assertTrue($hk->matches(['k' => true]));
        $this->assertFalse($hk->matches([]));
    }

    public function testDoesNotHaveKeyMatchesWhenGivenAnArrayWithoutExpectedKey()
    {
        $dhk = Matchers::doesNotHaveKey('k');
        $this->assertMatcher($dhk);
        $this->assertTrue($dhk->matches([]));
        $this->assertFalse($dhk->matches(['k' => true]));
    }

    public function testHasPropertyMatchesWhenObjectHasExpectedProperty()
    {
        $cls = new \stdClass;
        $cls->prop = true;

        $hp = Matchers::hasProperty('prop');
        $this->assertMatcher($hp);
        $this->assertTrue($hp->matches($cls));
        $this->assertFalse($hp->matches(new \stdClass));
    }

    public function testDoesNotHavePropertyMatchesWhenObjectDoesNotHaveProperty()
    {
        $cls = new \stdClass;
        $cls->prop = true;

        $dhp = Matchers::doesNotHaveProperty('prop');
        $this->assertMatcher($dhp);
        $this->assertTrue($dhp->matches(new \stdClass));
        $this->assertFalse($dhp->matches($cls));
    }

    public function testIsEmptyMatchesWhenGivenEmptyValues()
    {
        $ie = Matchers::isEmpty();
        $this->assertMatcher($ie);
        $this->assertTrue($ie->matches(null));
        $this->assertTrue($ie->matches(''));
        $this->assertTrue($ie->matches(false));
        $this->assertTrue($ie->matches([]));
        $this->assertTrue($ie->matches(0));
    }

    public function testIsNotEmptyMatchesWhenGivenANonEmptyValue()
    {
        $ine = Matchers::isNotEmpty();
        $this->assertMatcher($ine);
        $this->assertTrue($ine->matches('one'));
        $this->assertTrue($ine->matches(true));
        $this->assertTrue($ine->matches(1));
        $this->assertTrue($ine->matches([1]));
    }

    public function testIsEqualMatchesWhenTwoValuesAreEqual()
    {
        $eq = Matchers::isEqual('1');
        $this->assertMatcher($eq);
        $this->assertTrue($eq->matches(1));
    }

    public function testIsNotEqualsMatchesWhenTwoValuesAreNotEqual()
    {
        $neq = Matchers::isNotEqual(1);
        $this->assertMatcher($neq);
        $this->assertTrue($neq->matches(2));
    }

    public function testIsIdenticalMatchesWhenTwoValuesAreExactlyEqual()
    {
        $iden = Matchers::isIdentical(1);
        $this->assertMatcher($iden);
        $this->assertTrue($iden->matches(1));
        $this->assertFalse($iden->matches('1'));
    }

    public function testIsNotIdenticalMatchesWhenToValuesAreNotExactlyEqual()
    {
        $ni = Matchers::isNotIdentical(1);
        $this->assertMatcher($ni);
        $this->assertTrue($ni->matches(2));
        $this->assertFalse($ni->matches(1));
    }

    public function testIsFalseMatchesWithValuesThatAreExactlyFalse()
    {
        $false = Matchers::isFalse();
        $this->assertMatcher($false);
        $this->assertTrue($false->matches(false));
        $this->assertFalse($false->matches(null));
    }

    public function testIsFlasyMatchesWhenFalsyValuesArePassed()
    {
        $falsy = Matchers::isFalsy();
        $this->assertMatcher($falsy);
        $this->assertTrue($falsy->matches('no'));
        $this->assertTrue($falsy->matches(0));
    }

    public function testIsInstanceOfMatchesWhenGivenAnAppropriateClass()
    {
        $io = Matchers::isInstanceOf(__CLASS__);
        $this->assertMatcher($io);
        $this->assertTrue($io->matches($this));
    }

    public function testIsJsonMatchesWhenGivenValidJson()
    {
        $ij = Matchers::isJson();
        $this->assertMatcher($ij);
        $this->assertTrue($ij->matches('{}'));
    }

    public function testIsNullMatchesWhenNullValuesAreGiven()
    {
        $in = Matchers::isNull();
        $this->assertMatcher($in);
        $this->assertTrue($in->matches(null));
    }

    public function testIsNotNullMatchesWhenGivenNonNullValues()
    {
        $inn = Matchers::isNotNull();
        $this->assertMatcher($inn);
        $this->assertTrue($inn->matches(''));
    }

    public function testIsTrueMatchesWhenGivenTrueBoolean()
    {
        $true = Matchers::isTrue();
        $this->assertMatcher($true);
        $this->assertTrue($true->matches(true));
    }

    public function testIsTruthyMatchesWhenGivenTruthyValues()
    {
        $truthy = Matchers::isTruthy();
        $this->assertMatcher($truthy);
        $this->assertTrue($truthy->matches('yes'));
        $this->assertTrue($truthy->matches('on'));
        $this->assertTrue($truthy->matches(1));
    }

    public function testIsTypeMatchesWhenGivenTheExpectedType()
    {
        $it = Matchers::isType('array');
        $this->assertMatcher($it);
        $this->assertTrue($it->matches([]));
        $this->assertFalse($it->matches('a string'));
    }

    public function testLessThanMatchesWhenGivenAValueLessThanExpected()
    {
        $lt = Matchers::lessThan(10);
        $this->assertMatcher($lt);
        $this->assertTrue($lt->matches(1));
        $this->assertFalse($lt->matches(10));
        $this->assertFalse($lt->matches(100));
    }

    public function testLessThanOrEqualMatchesWhenGivenAvalueEqualToOrLessThanExpected()
    {
        $lte = Matchers::lessThanOrEqual(10);
        $this->assertMatcher($lte);
        $this->assertTrue($lte->matches(1));
        $this->assertTrue($lte->matches(10));
        $this->assertFalse($lte->matches(100));
    }

    public function testMatchesRegexMatchesWhenGivenStringContainsPattern()
    {
        $re = Matchers::matchesRegex('/here/');
        $this->assertMatcher($re);
        $this->assertTrue($re->matches('here we are'));
    }

    public function testDoesNotMatchRegexMatchesWhenGivenStringDoesNotContainPattern()
    {
        $dre = Matchers::doesNotMatchRegex('/here/');
        $this->assertMatcher($dre);
        $this->assertTrue($dre->matches('nope nope nope'));
    }

    public function testStringContainsMatchesWhenStringHasNeedle()
    {
        $sc = Matchers::stringContains('here');
        $this->assertMatcher($sc);
        $this->assertTrue($sc->matches('here we are'));
    }

    public function testStringDoesNotContainMatchesWhenStringDoesNotHaveNeedle()
    {
        $sdc = Matchers::stringDoesNotContain('here');
        $this->assertMatcher($sdc);
        $this->assertTrue($sdc->matches('nope nope nope'));
    }

    public function testPhptFormatMatchesWhenFormatIsMet()
    {
        $m = Matchers::phptFormat('%d');
        $this->assertMatcher($m);
        $this->assertTrue($m->matches('123'));
    }

    public function testLogicalNotReturnsValidMatcher()
    {
        $this->assertMatcher(Matchers::logicalNot($this->createMatcher()));
    }

    public function testLogicalAndReturnsValidMatcher()
    {
        $this->assertMatcher(Matchers::logicalAnd(
            $this->createMatcher(),
            $this->createMatcher()
        ));
    }

    public function testLogicalOrReturnsValidMatcher()
    {
        $this->assertMatcher(Matchers::logicalOr(
            $this->createMatcher(),
            $this->createMatcher()
        ));
    }

    public function testLogicalXorReturnsValidMatcher()
    {
        $this->assertMatcher(Matchers::logicalXor(
            $this->createMatcher(),
            $this->createMatcher()
        ));
    }

    private function assertMatcher($object)
    {
        $this->assertInstanceOf('Counterpart\\Matcher', $object);
    }
}
