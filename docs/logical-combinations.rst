Logical Combinations
====================

Counterpart provides a set of matchers that allow users to create logical
combinations of one or more matchers.

Logical Not (Negating Matchers)
-------------------------------

A matcher can be negated with ``LogicalNot``.

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


Logical And
-----------

``LogicalAnd`` can be used to combine one or more matchers with an ``AND``
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
----------

``LogicalOr`` can be used to combine one or more matchers with an ``OR`` or
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
-----------

``LogicalXor`` can be used to combine one or more matchers with an ``XOR``.
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
