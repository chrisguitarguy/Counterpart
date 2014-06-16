Counterpart: Object Matching for PHP
====================================

Counterpart is a *matching* framework for PHP and is used to compare values in
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

   matchers
   logical-combinations
   custom-matchers

Links
-----

- `Github Repo <https://github.com/chrisguitarguy/Counterpart>`_
- `API Documentation <http://api.counterpartphp.org>`_

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

Logical Combinations
^^^^^^^^^^^^^^^^^^^^

Counterpart provides a set of matchers that allow users to create logical
combinations of one or more matchers.

See :doc:`logical-combinations` for more.

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

It's also passible to use a custom matcher with the ``Assert`` trait directly.
Simple paces an instance of ``Counterpart\Matcher`` as the first argument to
``Assert::assertThat``.

.. code-block:: php

    <?php
    use Counterpart\Assert;
    use Counterpart\Matcher\IsEqual;

    Assert::assertThat(new IsEqual(1), 1, "1 != 1, something is very broken");
