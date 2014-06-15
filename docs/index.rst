Counterpart: Object Matching for PHP
====================================

Counter part is a *matching* framework for PHP and is used to compare values in
an object oriented way.

Some example use cases:

#. A testing framework could use Counterpart's matchers and ``Assert`` class for
   assertions.
#. A mock object library could use Counterpart to match argument expectations.
#. A validation library could use Counterpart to check that values match
   expectations.

Contents:

.. toctree::
   :maxdepth: 2

Quickstart
----------

Counterpart can be installed via composer, just add it it to your ``composer.json``.

.. code-block:: json

    {
        "name": "somevendor/someproject",
        "require": {
            "counterpart/counterpart": "~1.4"
        }
    }

Then simply ``composer install`` or ``composer update``.

Counterpart provides two traits full of static factory and helper methods.

- ``Counterpart\Matchers``
- ``Counterpart\Assert``

Matchers
^^^^^^^^

The ``Counterpart\Matchers`` trait comes with a set of static factory methods
to make using matchers easy.

.. code-block:: php

    <?php

    use Counterpart\Matchers;

    $matcher = Matchers::hasKey('a_key');
    $matcher->matches(['a_key' => '']); // true
    echo $matcher; // "is an array or ArrayAccess with the key a_key"

Every matcher object implements ``Counterpart\Matcher`` whose ``match`` method
does all the heavy lifting. The matcher interface also includes a ``__toString``
method which will return a textual description of what's being looked for.

Negating Matchers
^^^^^^^^^^^^^^^^^

A matcher can be negated with ``logicalNot``.

.. code-block:: php

    <?php
    use Counterpart\Matchers;

    $matcher = Matchers::logicNot(Matchers::hasKey('a_key'));
    $matcher->matches(['a_key' => '']); // false
    echo $matcher; // "is an array or ArrayAccess without the key a_key"

There are a fair amount negative matcher factories already set up. The above
could be more simply written.

.. code-block:: php

    <?php
    use Counterpart\Matchers;

    $matcher = Matchers::doesNotHaveKey('a_key'));
    $matcher->matches(['a_key' => '']); // false
    echo $matcher; // "is an array or ArrayAccess without the key a_key"


Combining Matchers
^^^^^^^^^^^^^^^^^^

Counterpart provides a set of grouping matchers to allow a combination of
one or more matchers.

Logical And
"""""""""""

``logicalAnd`` can be used to combine one or more matchers with an ``AND``
or conjuction. When all sub-matchers match a value, ``LogicalAnd`` will return
``true``. Checking to see if a value is in a range is a great example of this.

.. code-block:: php

    <?php
    use Counterpart\Matchers;

    $matcher = Matchers::logicalAnd(
        Matchers::greaterThan(10),
        Matchers::lessThan(100)
    );
    $matcher->matches(11); // true
    $matchers->matches(101); // false

Logical Or
""""""""""

``logicalOr`` can be used to combine one or more matchers with an ``OR`` or
disjunction. If at least one sub-matcher matches the value, ``LogicalOr`` will
also match. Checking that a value is greater than or equal to another is a great
example of this.

.. code-block:: php

    <?php
    use Counterpart\Matchers;

    // same as Matchers::greaterThanOrEqual(10);
    $matcher = Matchers::logicalOr(
        Matchers::equalTo(10),
        Matchers::greaterThan(10)
    );
    $matcher->matches(10); // true
    $matcher->matches(20); // true
    $matcher->matches(9); // false

Logical Xor
"""""""""""

``logicalXor`` can be used to combine one or more matchers with an ``XOR``.
``LogicalXor`` will return true if one and only one of the sub-matchers matches.
The above greater than or equal to example could be written using ``logicalXor``.

.. code-block:: php

    <?php
    use Counterpart\Matchers;

    $matcher = Matchers::logicalXor(
        Matchers::equalTo(10),
        Matchers::greaterThan(10)
    );
    $matcher->matches(10); // true
    $matcher->matches(20); // true
    $matcher->matches(9); // false

Assertions
^^^^^^^^^^

The ``Counterpart\Assert`` trait provides assertions: matchers wrapped up in a
helper that throws a ``Counterpart\Exception\AssertionFailed`` exception when
the matcher fails.

.. code-block:: php

    <?php
    use Counterpart\Assert;

    Assert::assertEquals(10, 10, "two values that are equal are not matching as equal, something is wrong");
    Assert::assertFileExists(__FILE__);
