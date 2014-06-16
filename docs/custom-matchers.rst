Custom Matchers
===============

One of the goals of Counterpart is to make it easy to create custom matchers. The
``Counterpart\Matcher`` interface only contains two methods: ``matches`` and
``__toString``.

Let's make a custom matcher that checks to see if a value is in a range.

.. code-block:: php

    <?php
    namespace Acme\CounterpartExample;

    use Counterpart\Matcher;

    /**
     * Matches a value if its between $min and $max
     */
    class RangeMatcher implements Matcher
    {
        private $min;
        private $max;

        public function __construct($min, $max)
        {
            $this->min = $min;
            $this->max = $max;
        }

        /**
         * Matches checks an actual value against the expectations.
         */
        public function matches($actual)
        {
            return $actual > $this->min && $actual < $this->max;
        }

        /**
         * This should return a textual description of the what the matcher
         * is trying to accomplish.
         */
        public function __toString()
        {
            return sprintf('is a value between %d and %d', $this->min, $this->max);
        }
    }

Better Negation Messages
------------------------

By default Counterpart's :doc:`LogicalNot <logical-combinations>` will replace
the starting *is* in a matchers description with *is not*. That's not always so
great for generating a negation error message.

For a more customized negative message, a matcher can implement ``Counterpart\Negative``.

.. code-block:: php

    <?php
    namespace Acme\CounterpartExample;

    use Counterpart\Matcher;
    use Counterpart\Negative;

    /**
     * Matches a value if its between $min and $max
     */
    class RangeMatcher implements Matcher, Negative
    {
        // all the stuff above

        /**
         * `LogicalNot` will call this this to generate a nice negative message.
         */
        public function negativeMessage()
        {
            // this is what Counterpart would have done anyway
            return sprintf('is not a value between %d and %d', $this->min, $this->max);
        }
    }

Mismatch Descriptions
---------------------

When Counterpart does assertions it will call a matchers ``__toString`` method
as part of the error description. Sometimes this isn't enough -- sometimes it
doesn't provide enough context for the user or developer to take action.

Custom matchers may implement ``Counterpart\Describer`` to generate a more thorough
description of a mismatch.

.. code-block:: php

    <?php
    namespace Acme\CounterpartExample;

    use Counterpart\Matcher;
    use Counterpart\Negative;
    use Counterpart\Describer;

    /**
     * Matches a value if its between $min and $max
     */
    class RangeMatcher implements Matcher, Negative, Describer
    {
        // all the stuff above

        /**
         * `Counterpart\Assert::assertThat` will call this method to to generate
         * a more thorough error description.
         */
        public function describeMismatch($actual)
        {
            if ($actual < $this->min) {
                return 'the value was below the minimum';
            }

            if ($actual > $this->max) {
                return 'the value was above the maximum';
            }

            // the method doesn't know what to do, so decline to do anything.
            return Describer::DECLINE_DESCRIPTION;
        }
    }

Using Custom Matchers for Assertions
------------------------------------

Simply pass an instance of the custom matcher as the first argument to
``Counterpart\Assert::assertThat``.

.. code-block:: php

    <?php
    use Counterpart\Assert;
    use Acme\CounterpartExample\RangeMatcher;

    $actualValue = 9;
    Assert::assertThat(new RangeMatcher(1, 10), $actualValue);
